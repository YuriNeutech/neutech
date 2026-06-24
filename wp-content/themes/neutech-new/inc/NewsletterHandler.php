<?php

namespace CleanTheme;

use WP_REST_Request;
use WP_REST_Response;
use WP_Error;
use GFAPI;

class NewsletterHandler {

    const NAMESPACE = 'cleantheme/v1';
    const ROUTE     = '/subscribe';

    const FORM_ID  = 1;
    const EMAIL_ID = '1'; 

    const BEEHIIV_API_KEY        = 'NzxSwfxAnSogKXbxXf4oElQ999MC10FHPw8ZNk8GDieklYIJRtW5YFhEq5j0epaU';
    const BEEHIIV_PUBLICATION_ID = 'pub_136d1e54-adca-46ba-a179-9e3abee95d9d';

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route(self::NAMESPACE, self::ROUTE, [
            'methods'             => 'POST',
            'callback'            => [$this, 'handle_subscription'],
            'permission_callback' => [$this, 'check_permission'],
        ]);
    }

    public function check_permission() {
        return true; 
    }

    public function handle_subscription(WP_REST_Request $request) {
        $params = $request->get_json_params();
        $email  = sanitize_email($params['email'] ?? '');

        if (!is_email($email)) {
            return new WP_Error(
                'invalid_email', 
                __('Invalid email', 'cleantheme'), 
                ['status' => 400]
            );
        }

        $entry_id = null;

        if (class_exists('GFAPI')) {
            $entry = [
                'form_id'      => self::FORM_ID,
                self::EMAIL_ID => $email,
                'status'       => 'active',
                'source_url'   => $request->get_header('referer') ?: get_site_url(),
            ];

            $entry_id = GFAPI::add_entry($entry);

            if (is_wp_error($entry_id)) {
                return new WP_Error(
                    'gf_save_error', 
                    __('Error saving entry', 'cleantheme'), 
                    ['status' => 500]
                );
            }
        }

        $beehiiv_url = "https://api.beehiiv.com/v2/publications/" . self::BEEHIIV_PUBLICATION_ID . "/subscriptions";
        
        $beehiiv_body = wp_json_encode([
            'email'               => $email,
            'reactivate_existing' => false,
            'send_welcome_email'  => true,
            'utm_source'          => 'cleantheme_website'
        ]);

        $response = wp_remote_post($beehiiv_url, [
            'headers' => [
                'Authorization' => 'Bearer ' . self::BEEHIIV_API_KEY,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
            'body'    => $beehiiv_body,
            'timeout' => 15
        ]);

        if (is_wp_error($response)) {
            return new WP_Error(
                'beehiiv_connection_error', 
                __('API connection failed', 'cleantheme'), 
                ['status' => 500]
            );
        }

        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code !== 201 && $response_code !== 200) {
            $response_body = json_decode(wp_remote_retrieve_body($response), true);
            $error_msg     = $response_body['message'] ?? __('Subscription failed', 'cleantheme');
            
            return new WP_Error(
                'beehiiv_api_error', 
                $error_msg, 
                ['status' => $response_code]
            );
        }

        return new WP_REST_Response([
            'status'   => 'success',
            'entry_id' => $entry_id,
            'message'  => __('Subscription successful', 'cleantheme')
        ], 200);
    }
}