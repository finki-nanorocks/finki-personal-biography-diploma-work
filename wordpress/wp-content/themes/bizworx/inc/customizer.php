<?php

function bizworx_customize_register( $wp_customize ) {
	
	$wp_customize->get_section( 'header_image' )->panel = 'bizworx_header_panel';
    $wp_customize->get_section( 'header_image' )->priority = '13';
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->get_section( 'colors' )->title = __('General', 'bizworx');
	$wp_customize->get_section( 'colors' )->panel = 'bizworx_colors_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
	
	//Divider
    class bizworx_Divider extends WP_Customize_Control {
         public function render_content() {
            echo '<hr style="margin: 15px 0;border-top: 1px dashed #919191;" />';
         }
    }
    //Titles
    class bizworx_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="margin-top: 30px; padding: 5px; color: #fff; text-transform: uppercase; background: #0085BA; border-bottom: 3px solid #006799;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	//___General___//
    $wp_customize->add_section(
        'bizworx_general',
        array(
            'title' => __('General', 'bizworx'),
            'priority' => 8,
        )
    );
    //Top padding
    $wp_customize->add_setting(
        'wrapper_top_padding',
        array(
            'default' => __('80','bizworx'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_top_padding',
        array(
            'label'         => __( 'Top padding for page content', 'bizworx' ),
            'section'       => 'bizworx_general',
            'type'          => 'number',
            'description'   => __('Space between the header and the page content', 'bizworx'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
            ),            
        )
    );
    //Bottom padding
    $wp_customize->add_setting(
        'wrapper_bottom_padding',
        array(
            'default' => __('100','bizworx'),
            'sanitize_callback' => 'absint',
        )
    );
    $wp_customize->add_control(
        'wrapper_bottom_padding',
        array(
            'label'         => __( 'Bottom padding for page content', 'bizworx' ),
            'section'       => 'bizworx_general',
            'type'          => 'number',
            'description'   => __('Space between the footer and the page content', 'bizworx'),       
            'priority'      => 10,
            'input_attrs' => array(
                'min'   => 0,
                'max'   => 160,
                'step'  => 1,
            ),            
        )
    );
	
	//___Header section___//
    $wp_customize->add_panel( 'bizworx_header_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Header section', 'bizworx'),
    ) );
	//___Header type___//
    $wp_customize->add_section(
        'bizworx_header_type',
        array(
            'title'         => __('Header type', 'bizworx'),
            'priority'      => 10,
            'panel'         => 'bizworx_header_panel', 
            'description'   => __('You can select your header type from here.', 'bizworx'),
        )
    );
	

    //Front page
    $wp_customize->add_setting(
        'front_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'bizworx_sanitize_header_type',
        )
    );
    $wp_customize->add_control(
        'front_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Front page header type', 'bizworx'),
            'section'     => 'bizworx_header_type',
            'description' => __('Select the header type for your front page', 'bizworx'),
            'choices' => array(
                'image'     => __('Image', 'bizworx'),
                'core-video'=> __('Video', 'bizworx'),
            ),
        )
    );
    //Site
    $wp_customize->add_setting(
        'site_header_type',
        array(
            'default'           => 'image',
            'sanitize_callback' => 'bizworx_sanitize_header_type',
        )
    );
    $wp_customize->add_control(
        'site_header_type',
        array(
            'type'        => 'radio',
            'label'       => __('Site header type', 'bizworx'),
            'section'     => 'bizworx_header_type',
            'description' => __('Select the header type for all pages except the front page', 'bizworx'),
            'choices' => array(
                'image'     => __('Image', 'bizworx'),
                'core-video'=> __('Video', 'bizworx'),
            ),
        )
    );
	
	//___Menu style___//
    $wp_customize->add_section(
        'bizworx_menu_style',
        array(
            'title'         => __('Menu style', 'bizworx'),
            'priority'      => 15,
            'panel'         => 'bizworx_header_panel', 
        )
    );
    //Sticky menu
    $wp_customize->add_setting(
        'sticky_menu',
        array(
            'default'           => 'sticky',
            'sanitize_callback' => 'bizworx_sanitize_menu',
        )
    );
    $wp_customize->add_control(
        'sticky_menu',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __('Sticky menu', 'bizworx'),
            'section' => 'bizworx_menu_style',
            'choices' => array(
                'sticky'   => __('Sticky', 'bizworx'),
                'static'   => __('Static', 'bizworx'),
            ),
        )
    );
	
	//___Colors___//
    $wp_customize->add_panel( 'bizworx_colors_panel', array(
        'priority'       => 19,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Colors', 'bizworx'),
    ) );
    $wp_customize->add_section(
        'colors_header',
        array(
            'title'         => __('Header', 'bizworx'),
            'priority'      => 11,
            'panel'         => 'bizworx_colors_panel',
        )
    );
	$wp_customize->add_section(
        'colors_footer',
        array(
            'title'         => __('Footer', 'bizworx'),
            'priority'      => 13,
            'panel'         => 'bizworx_colors_panel',
        )
    );  
	
	//Primary color
	$wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#e64e4e',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'primary_color',
            array(
                'label'         => __('Primary color', 'bizworx'),
                'section'       => 'colors',
                'settings'      => 'primary_color',
                'priority'      => 11
            )
        )
    );
	//Body text
	$wp_customize->add_setting(
        'body_text_color',
        array(
            'default'           => '#47425d',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'body_text_color',
            array(
                'label'         => __('Body text color', 'bizworx'),
                'section'       => 'colors',
                'settings'      => 'body_text_color',
                'priority'      => 12
            )
        )
    );
	  
	//Site title
    $wp_customize->add_setting(
        'site_title_color',
        array(
            'default'           => '#eeeeee',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_title_color',
            array(
                'label' => __('Site title', 'bizworx'),
                'section' => 'colors_header',
                'settings' => 'site_title_color',
                'priority' => 12
            )
        )
    );
    //Site desc
    $wp_customize->add_setting(
        'site_desc_color',
        array(
            'default'           => '#eeeeee',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'site_desc_color',
            array(
                'label' => __('Site description', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 13
            )
        )
    );
	//Header banner text
    $wp_customize->add_setting(
        'banner_text_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'banner_text_color',
            array(
                'label' => __('Header banner text', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 14
            )
        )
    );
	//Menu bg
    $wp_customize->add_setting(
        'menu_bg_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_bg_color',
            array(
                'label' => __('Menu background', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 15
            )
        )
    );
	//Top level menu items
    $wp_customize->add_setting(
        'top_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'top_items_color',
            array(
                'label' => __('Top level menu items', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 15
            )
        )
    );
    //Menu items hover
    $wp_customize->add_setting(
        'menu_items_hover',
        array(
            'default'           => '#e64e4e',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'menu_items_hover',
            array(
                'label' => __('Menu items hover', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 15
            )
        )
    );    
    //Sub menu items color
    $wp_customize->add_setting(
        'submenu_items_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_items_color',
            array(
                'label' => __('Sub-menu items', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 16
            )
        )
    );
    //Sub menu background
    $wp_customize->add_setting(
        'submenu_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'submenu_background',
            array(
                'label' => __('Sub-menu background', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 17
            )
        )
    );
    //Mobile menu
    $wp_customize->add_setting(
        'mobile_menu_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'mobile_menu_color',
            array(
                'label' => __('Mobile menu button', 'bizworx'),
                'section' => 'colors_header',
                'priority' => 17
            )
        )
    );
	
	//Footer widget area
    $wp_customize->add_setting(
        'footer_widgets_background',
        array(
            'default'           => '#252525',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_background',
            array(
                'label' => __('Footer widget area background', 'bizworx'),
                'section' => 'colors_footer',
                'priority' => 22
            )
        )
    );
    //Footer widget color
    $wp_customize->add_setting(
        'footer_widgets_color',
        array(
            'default'           => '#767676',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_widgets_color',
            array(
                'label' => __('Footer widget area color', 'bizworx'),
                'section' => 'colors_footer',
                'priority' => 23
            )
        )
    );
    //Footer background
    $wp_customize->add_setting(
        'footer_background',
        array(
            'default'           => '#1c1c1c',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_background',
            array(
                'label' => __('Footer background', 'bizworx'),
                'section' => 'colors_footer',
                'priority' => 24
            )
        )
    );
    //Footer color
    $wp_customize->add_setting(
        'footer_color',
        array(
            'default'           => '#666666',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_color',
            array(
                'label' => __('Footer color', 'bizworx'),
                'section' => 'colors_footer',
                'priority' => 25
            )
        )
    );
	
	//___Header Background___//
    $wp_customize->add_section(
        'bizworx_background',
        array(
            'title'         => __('Header Background', 'bizworx'),
            'description'   => __('You can add image for the header background.', 'bizworx'),
            'priority'      => 11,
            'panel'         => 'bizworx_header_panel',
        )
    );	
	$wp_customize->add_setting(
        'background_image_1',
        array(
            'default' => get_stylesheet_directory_uri() . '/images/1.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'background_image_1',
            array(
               'label'          => __( 'Upload your image for the background', 'bizworx' ),
               'type'           => 'image',
               'section'        => 'bizworx_background',
               'settings'       => 'background_image_1',
               'priority'       => 1,
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'header_title_1',
        array(
            'default' => __('Edit theme in customizer', 'bizworx'),
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
        'header_title_1',
        array(
            'label' => __( 'Title for the background image', 'bizworx' ),
            'section' => 'bizworx_background',
            'type' => 'text',
            'priority' => 2
        )
    );
    //Subtitle
    $wp_customize->add_setting(
        'header_subtitle_1',
        array(
            'default' => __('This text can be changed in customizer', 'bizworx'),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
        'header_subtitle_1',
        array(
            'label' => __( 'Subtitle for the background image', 'bizworx' ),
            'section' => 'bizworx_background',
            'type' => 'text',
            'priority' => 3
        )
    );
	//Button
    $wp_customize->add_setting(
        'banner_button',
        array(
            'default' => __('Button', 'bizworx'),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
        'banner_button',
        array(
            'label' => __( 'Text on the button', 'bizworx' ),
            'section' => 'bizworx_background',
            'type' => 'text',
            'priority' => 3
        )
    );
	//Button URL
    $wp_customize->add_setting(
        'banner_button_url',
        array(
            'default' => __('#','bizworx'),
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        'banner_button_url',
        array(
            'label' => __( 'URL for the banner button', 'bizworx' ),
            'section' => 'bizworx_background',
            'type' => 'text',
            'priority' => 3
        )
    );
	//Header background size
    $wp_customize->add_setting(
        'header_bg_size',
        array(
            'default'           => 'cover',
			'sanitize_callback' => 'bizworx_sanitize_bg_size',
        )
    );
    $wp_customize->add_control(
        'header_bg_size',
        array(
            'type' => 'radio',
            'priority'    => 4,
            'label' => __('Header background size', 'bizworx'),
            'section' => 'bizworx_background',
            'choices' => array(
                'cover'     => __('Cover', 'bizworx'),
                'contain'   => __('Contain', 'bizworx'),
            ),
        )
    );
	//Header height
    $wp_customize->add_setting(
        'header_height',
        array(
            'default'           => __('600', 'bizworx'),
			'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'header_height', array(
        'type'        => 'number',
        'priority'    => 5,
        'section'     => 'bizworx_background',
        'label'       => __('Header height [default: 600px]', 'bizworx'),
        'input_attrs' => array(
            'min'   => 250,
            'max'   => 1000,
            'step'  => 5,
        ),
    ) );
	
	
	//___Blog options___//
    $wp_customize->add_section(
        'blog_options',
        array(
            'title' => __('Blog options', 'bizworx'),
            'priority' => 13,
        )
    ); 
	// Blog layout
    $wp_customize->add_setting('bizworx_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new bizworx_Info( $wp_customize, 'layout', array(
        'label' => __('Layout', 'bizworx'),
        'section' => 'blog_options',
        'settings' => 'bizworx_options[info]',
        'priority' => 10
        ) )
    );    
    $wp_customize->add_setting(
        'blog_layout',
        array(
            'default'           => 'classic',
			'sanitize_callback' => 'bizworx_sanitize_blog_layout',
        )
    );
    $wp_customize->add_control(
        'blog_layout',
        array(
            'type'      => 'radio',
            'label'     => __('Blog layout', 'bizworx'),
            'section'   => 'blog_options',
            'priority'  => 11,
            'choices'   => array(
                'classic'           => __( 'Classic', 'bizworx' ),
                'fullwidth'         => __( 'Full width (no sidebar)', 'bizworx' )
            ),
        )
    ); 
    //Full width singles
    $wp_customize->add_setting(
        'fullwidth_single',
        array(
            'default' => 0,
            'sanitize_callback' => 'bizworx_sanitize_checkbox',
        )       
    );
    $wp_customize->add_control(
        'fullwidth_single',
        array(
            'type'      => 'checkbox',
            'label'     => __('Full width single posts?', 'bizworx'),
            'section'   => 'blog_options',
            'priority'  => 12,
        )
    );
    //Content/excerpt
    $wp_customize->add_setting('bizworx_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new bizworx_Info( $wp_customize, 'content', array(
        'label' => __('Content/excerpt', 'bizworx'),
        'section' => 'blog_options',
        'settings' => 'bizworx_options[info]',
        'priority' => 13
        ) )
    );          
    //Full content posts
    $wp_customize->add_setting(
      'full_content_home',
      array(
        'default' => 0,
        'sanitize_callback' => 'bizworx_sanitize_checkbox',     
      )   
    );
    $wp_customize->add_control(
        'full_content_home',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display full content of blog posts on post page', 'bizworx'),
            'section' => 'blog_options',
            'priority' => 14,
        )
    );
    $wp_customize->add_setting(
      'full_content_archives',
      array(
        'default' => 0,
        'sanitize_callback' => 'bizworx_sanitize_checkbox',     
      )   
    );
    $wp_customize->add_control(
        'full_content_archives',
        array(
            'type' => 'checkbox',
            'label' => __('Check this box to display full content of blog posts on all archives.', 'bizworx'),
            'section' => 'blog_options',
            'priority' => 15,
        )
    );    
    //Excerpt
    $wp_customize->add_setting(
        'exc_lenght',
        array(
            'default'           => '55',
			'sanitize_callback' => 'absint',
        )       
    );
    $wp_customize->add_control( 'exc_lenght', array(
        'type'        => 'number',
        'priority'    => 16,
        'section'     => 'blog_options',
        'label'       => __('Excerpt lenght', 'bizworx'),
        'description' => __('Choose your excerpt length. Default: 55 words', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
        ),
    ) );
	
	
	//___Footer___//
    $wp_customize->add_section(
        'bizworx_footer',
        array(
            'title'         => __('Footer', 'bizworx'),
            'priority'      => 18,
        )
    );
	
    //Front page
    $wp_customize->add_setting(
        'footer_widget_areas',
        array(
            'default'           => '3',
			'sanitize_callback' => 'bizworx_sanitize_widget_area',
        )
    );
    $wp_customize->add_control(
        'footer_widget_areas',
        array(
            'type'        => 'radio',
            'label'       => __('Footer widget area', 'bizworx'),
            'section'     => 'bizworx_footer',
            'description' => __('Choose the number of widgets you want to display in footer. After that, go to Appearance > Widgets and add your widgets.', 'bizworx'),
            'choices' => array(
                '1'     => __('One', 'bizworx'),
                '2'     => __('Two', 'bizworx'),
                '3'     => __('Three', 'bizworx'),
                '4'     => __('Four', 'bizworx')
            ),
        )
    );
	
	//___Extraa Options___//
    $wp_customize->add_panel( 'bizworx_extraa_panel', array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Extraa Options', 'bizworx'),
    ) );
    
	//___Fonts___//
    $wp_customize->add_section(
        'bizworx_fonts',
        array(
            'title' => __('Fonts', 'bizworx'),
            'priority' => 15,
            'description' => __('you can check all google fonts here: google.com/fonts', 'bizworx'),
        )
    );
    //Body fonts title
    $wp_customize->add_setting('bizworx_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new bizworx_Info( $wp_customize, 'body_fonts', array(
        'label' => __('Body fonts', 'bizworx'),
        'section' => 'bizworx_fonts',
        'settings' => 'bizworx_options[info]',
        'priority' => 10
        ) )
    );    
    //Body fonts
    $wp_customize->add_setting(
        'body_font_name',
        array(
            'default' => 'Poppins:400,600',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );
    $wp_customize->add_control(
        'body_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'bizworx' ),
            'section' => 'bizworx_fonts',
            'type' => 'text',
            'priority' => 11
        )
    );
    //Body fonts family
    $wp_customize->add_setting(
        'body_font_family',
        array(
            'default' => '\'Poppins\', sans-serif',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );
    $wp_customize->add_control(
        'body_font_family',
        array(
            'label' => __( 'Font family', 'bizworx' ),
            'section' => 'bizworx_fonts',
            'type' => 'text',
            'priority' => 12
        )
    );
    //Headings fonts title
    $wp_customize->add_setting('bizworx_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new bizworx_Info( $wp_customize, 'headings_fonts', array(
        'label' => __('Headings fonts', 'bizworx'),
        'section' => 'bizworx_fonts',
        'settings' => 'bizworx_options[info]',
        'priority' => 13
        ) )
    );      
    //Headings fonts
    $wp_customize->add_setting(
        'headings_font_name',
        array(
            'default' => 'Ubuntu:400,400i,500,500i',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );
    $wp_customize->add_control(
        'headings_font_name',
        array(
            'label' => __( 'Font name/style/sets', 'bizworx' ),
            'section' => 'bizworx_fonts',
            'type' => 'text',
            'priority' => 14
        )
    );
    //Headings fonts family
    $wp_customize->add_setting(
        'headings_font_family',
        array(
            'default' => '\'Ubuntu\', sans-serif',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );
    $wp_customize->add_control(
        'headings_font_family',
        array(
            'label' => __( 'Font family', 'bizworx' ),
            'section' => 'bizworx_fonts',
            'type' => 'text',
            'priority' => 15
        )
    );
	
    //Font sizes title
    $wp_customize->add_setting('bizworx_options[info]', array(
            'type'              => 'info_control',
            'sanitize_callback' => 'esc_attr',            
        )
    );
    $wp_customize->add_control( new bizworx_Info( $wp_customize, 'font_sizes', array(
        'label' => __('Font sizes', 'bizworx'),
        'section' => 'bizworx_fonts',
        'settings' => 'bizworx_options[info]',
        'priority' => 16
        ) )
    );
    // Site title
    $wp_customize->add_setting(
        'site_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'site_title_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'bizworx_fonts',
        'label'       => __('Site title', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 
    // Site description
    $wp_customize->add_setting(
        'site_desc_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
        )       
    );
    $wp_customize->add_control( 'site_desc_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'bizworx_fonts',
        'label'       => __('Site description', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );  
    // Nav menu
    $wp_customize->add_setting(
        'menu_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )       
    );
    $wp_customize->add_control( 'menu_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'bizworx_fonts',
        'label'       => __('Menu items', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 50,
            'step'  => 1,
        ),
    ) );           
    //H1 size
    $wp_customize->add_setting(
        'h1_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '52',
        )       
    );
    $wp_customize->add_control( 'h1_size', array(
        'type'        => 'number',
        'priority'    => 17,
        'section'     => 'bizworx_fonts',
        'label'       => __('H1 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H2 size
    $wp_customize->add_setting(
        'h2_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '42',
        )       
    );
    $wp_customize->add_control( 'h2_size', array(
        'type'        => 'number',
        'priority'    => 18,
        'section'     => 'bizworx_fonts',
        'label'       => __('H2 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H3 size
    $wp_customize->add_setting(
        'h3_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '32',
        )       
    );
    $wp_customize->add_control( 'h3_size', array(
        'type'        => 'number',
        'priority'    => 19,
        'section'     => 'bizworx_fonts',
        'label'       => __('H3 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H4 size
    $wp_customize->add_setting(
        'h4_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '25',
        )       
    );
    $wp_customize->add_control( 'h4_size', array(
        'type'        => 'number',
        'priority'    => 20,
        'section'     => 'bizworx_fonts',
        'label'       => __('H4 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H5 size
    $wp_customize->add_setting(
        'h5_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )       
    );
    $wp_customize->add_control( 'h5_size', array(
        'type'        => 'number',
        'priority'    => 21,
        'section'     => 'bizworx_fonts',
        'label'       => __('H5 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //H6 size
    $wp_customize->add_setting(
        'h6_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'h6_size', array(
        'type'        => 'number',
        'priority'    => 22,
        'section'     => 'bizworx_fonts',
        'label'       => __('H6 font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 60,
            'step'  => 1,
        ),
    ) );
    //Body
    $wp_customize->add_setting(
        'body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16',
        )       
    );
    $wp_customize->add_control( 'body_size', array(
        'type'        => 'number',
        'priority'    => 23,
        'section'     => 'bizworx_fonts',
        'label'       => __('Body font size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 24,
            'step'  => 1,
        ),
    ) );
    // Single post tiles
    $wp_customize->add_setting(
        'single_post_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '36',
        )       
    );
    $wp_customize->add_control( 'single_post_title_size', array(
        'type'        => 'number',
        'priority'    => 24,
        'section'     => 'bizworx_fonts',
        'label'       => __('Single post title size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) ); 



    // Slide title size
    $wp_customize->add_setting(
        'banner_title_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '68',
        )       
    );
    $wp_customize->add_control( 'banner_title_size', array(
        'type'        => 'number',
        'priority'    => 25,
        'section'     => 'bizworx_fonts',
        'label'       => __('Banner title size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) );
    // Subtitle size
    $wp_customize->add_setting(
        'banner_subtitle_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '18',
        )       
    );
    $wp_customize->add_control( 'banner_subtitle_size', array(
        'type'        => 'number',
        'priority'    => 26,
        'section'     => 'bizworx_fonts',
        'label'       => __('Banner subtitle size', 'bizworx'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 90,
            'step'  => 1,
        ),
    ) );
}
	
add_action( 'customize_register', 'bizworx_customize_register' );

/**
 * Sanitize callback functions
 */
//Header type

function bizworx_sanitize_header_type( $value ){
	$valid = array(
        'image'     => __('Image', 'bizworx'),
        'core-video'=> __('Video', 'bizworx'),
	);
	
	return ( array_key_exists( $value, $valid ) ? $value : '' );
	
}

function bizworx_sanitize_menu( $value ){
	$valid = array(
		'sticky'   => __('Sticky', 'bizworx'),
		'static'   => __('Static', 'bizworx'),
	);
	return ( array_key_exists( $value, $valid ) ? $value : '' );
}

function bizworx_sanitize_bg_size( $value ){
	$valid = array(
		'cover'     => __('Cover', 'bizworx'),
		'contain'   => __('Contain', 'bizworx'),
	);
	return ( array_key_exists( $value, $valid ) ? $value : '' );
}

function bizworx_sanitize_blog_layout( $value ){
	$valid = array(
		'classic'           => __( 'Classic', 'bizworx' ),
		'fullwidth'         => __( 'Full width (no sidebar)', 'bizworx' )
	);
	return ( array_key_exists( $value, $valid ) ? $value : '' );
}

function bizworx_sanitize_checkbox( $value ) {
	//returns true if checkbox is checked
    return ( $value == 1 ? 1 : '' );
}

function bizworx_sanitize_widget_area($value){
	$valid = array(
		'1'     => __('One', 'bizworx'),
		'2'     => __('Two', 'bizworx'),
		'3'     => __('Three', 'bizworx'),
		'4'     => __('Four', 'bizworx')
	);
	return ( array_key_exists( $value, $valid ) ? $value : '' );
}

function bizworx_sanitize_wc_content(){
	$valid = array(
		'left'    => __('Left', 'bizworx'),
		'right'     => __('Right', 'bizworx'),
	);
	return ( array_key_exists( $value, $valid ) ? $value : '' );
}

function bizworx_sanitize_image( $input ){
 
    /* default output */
    $value = '';
 
    /* check file type */
    $filetype = wp_check_filetype( $input );
    $mime_type = $filetype['type'];
 
    /* only mime type "image" allowed */
    if ( strpos( $mime_type, 'image' ) !== false ){
        $value = $input;
    }
 
    return $value;
}