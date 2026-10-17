<?php
namespace CleanTheme;

/** Refuse cached submissions without repeating an external effect. */
class NewsletterHandler {
    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route('cleantheme/v1', '/subscribe', [
            'methods' => 'POST',
            'callback' => [$this, 'handle_subscription'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function handle_subscription($request) {
        return new \WP_REST_Response([
            'error' => 'newsletter_form_moved',
            'retryable' => false,
            'message' => 'This form has moved. Your email is still on this page. Reload to use the current form, or email info@neutech.co.',
        ], 409);
    }
}
