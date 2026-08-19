<?php
namespace CleanTheme\Fields;
use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\TagsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProjectsSliderFields {
    public function get_fields() {

        // --- MAIN SECTION FIELDS --- 
        $projects_slider_fields = new FieldsBuilder('projects_slider_section', array(
            'title' => 'We Specialize Section',
            'style' => 'seamless',
        ));

        $projects_slider_fields
            ->setLocation('block', '==', 'acf/projects-slider-section')
            ->addMessage('specialize_instructions', FieldHelpers::get_block_header('We Specialize Section', ''), FieldHelpers::get_header_args());

        $projects_slider_fields->addGroup('heading', array(
            'label' => 'Heading'
        ))->addText('section_title', array(
            'label' => 'Section Title',
            'required' => 0,
        ))->endGroup();

        $projects_slider_fields->addGroup('header', array(
            'label' => 'Header'
        ))
            ->addText('tags_title', array(
                'label' => 'Tags Title',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addTextarea('header_text', array(
                'label' => 'Header Text',
                'new_lines' => 'wpautop',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addFields(TagsBlock::getFields())
        ->endGroup();

        $projects_slider_fields->addGroup('text_near_slider',  array(
            'label' => 'Text near slider'
        ))
            ->addText('slider_title', array(
                'label' => 'Slider Title',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addText('slider_tag', array(
                'label' => 'Slider Tag',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addTextarea('slider_text', array(
                'label' => 'Slider Text',
                'new_lines' => 'wpautop',
                'required' => 1,
            ))
        ->endGroup();


        $projects_slider_fields->addRepeater('slides', array(
            'label' => 'Slider',
            'layout' => 'block',
            'button_label' => 'Add Slide',
            'min' => 1
        ))
            ->addText('project_title', array(
                'label' => 'Project Title',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addTextarea('description', array(
                'label' => 'Project Description',
                'new_lines' => 'wpautop',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addImage('image', array(
                'label' => ' Project Image',
                'required' => 1,
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'wrapper' => ['width' => '50%']
            ))
            ->addUrl('project_link', array(
                'label' => 'Project Link',
                'wrapper' => ['width' => '50%']
            ))
        ->endRepeater();

        $projects_slider_fields->addFields(ActionsCircleFields::getFields());

            
        return $projects_slider_fields->build();
    }
}