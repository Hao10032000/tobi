<?php 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;


class themesflat_options_elementor {
	public function __construct(){	
        add_action('elementor/documents/register_controls', [$this, 'themesflat_elementor_register_options'], 10);
    }

    public function themesflat_elementor_register_options($element){
        $post_id = $element->get_id();
        $post_type = get_post_type($post_id);

        if ( $post_type == 'project' ) {
            $this->themesflat_options_page_project($element);
        }
    }

    public function themesflat_options_page_project($element) {

        // TF Project
        $element->start_controls_section(
            'themesflat_header_options',
            [
                'label' => esc_html__('TF Project', 'proty'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
            );

        $element->add_control(
			'image_project',
			[
				'label' => esc_html__( 'Choose Image Pagetitle', 'tobi' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
       
        $element->add_control(
			'description_project',
			[
				'label' => esc_html__( 'Description Pagetitle', 'tobi' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,					
				'label_block' => true,
			]
		);

        $element->end_controls_section();
    }

}

new themesflat_options_elementor();
