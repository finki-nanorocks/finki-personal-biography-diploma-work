<?php

//Converts hex colors to rgba for the menu background color
function bizworx_hex2rgba($color, $opacity = false) {

        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        $rgb =  array_map('hexdec', $hex);
        //$opacity = 0.9;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        return $output;
}

function bizworx_custom_styles($custom) {
	
	//Menu style
	$sticky_menu = get_theme_mod('sticky_menu','sticky');
	if ($sticky_menu == 'static') {
		$custom .= ".site-header.fixed { position: absolute;}"."\n";
	}
	
	//Fonts
	$body_fonts = get_theme_mod('body_font_family');	
	$headings_fonts = get_theme_mod('headings_font_family');
	if ( $body_fonts !='' ) {
		$custom .= "body, #site-navigation ul ul a { font-family:" . esc_attr( $body_fonts ) . "!important;}"."\n";
	}
	if ( $headings_fonts !='' ) {
		$custom .= "h1, h2, h3, h4, h5, h6, #site-navigation ul li a, .portfolio-info, .roll-testimonials .name, .type-team .team-content .name, .type-team .team-thumb .team-pop .name, .roll-tabs .menu-tab li a, .roll-testimonials .name, .roll-project .project-filter li a, #secondary .widget_recent_entries li a, .banner-button, button, .woocommerce .cart_totals .button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { font-family:" . esc_attr ( $headings_fonts ) . ";}"."\n";
	}
	
	//Site title
    $site_title_size = get_theme_mod( 'site_title_size', '32' );
    if ($site_title_size) {
        $custom .= ".site-title { font-size:" . intval ( esc_attr ( $site_title_size ) ) . "px; }"."\n";
    }
	//Site description
    $site_desc_size = get_theme_mod( 'site_desc_size', '16' );
    if ($site_desc_size) {
        $custom .= ".site-description { font-size:" . intval ( esc_attr ( $site_desc_size ) ) . "px; }"."\n";
    }
	//Menu
    $menu_size = get_theme_mod( 'menu_size', '14' );
    if ($menu_size) {
        $custom .= "#site-navigation ul li a { font-size:" . intval ( esc_attr ( $menu_size ) ) . "px; }"."\n";
		$custom .= ".nav-cart .cart-count { top:calc(-" . intval ( esc_attr ( $menu_size ) ) . "px - 5px); }"."\n";
    }    	    	
	//H1 size
	$h1_size = get_theme_mod( 'h1_size','52' );
	if ($h1_size) {
		$custom .= "h1 { font-size:" . intval ( esc_attr ( $h1_size ) ) . "px; }"."\n";
	}
    //H2 size
    $h2_size = get_theme_mod( 'h2_size','42' );
    if ($h2_size) {
        $custom .= "h2 { font-size:" . intval ( esc_attr ( $h2_size ) ) . "px; }"."\n";
    }
    //H3 size
    $h3_size = get_theme_mod( 'h3_size','32' );
    if ($h3_size) {
        $custom .= "h3 { font-size:" . intval ( esc_attr ( $h3_size ) ) . "px; }"."\n";
    }
    //H4 size
    $h4_size = get_theme_mod( 'h4_size','25' );
    if ($h4_size) {
        $custom .= "h4 { font-size:" . intval ( esc_attr ( $h4_size ) ) . "px; }"."\n";
    }
    //H5 size
    $h5_size = get_theme_mod( 'h5_size','20' );
    if ($h5_size) {
        $custom .= "h5 { font-size:" . intval ( esc_attr ( $h5_size ) ) . "px; }"."\n";
    }
    //H6 size
    $h6_size = get_theme_mod( 'h6_size','18' );
    if ($h6_size) {
        $custom .= "h6 { font-size:" . intval ( esc_attr ($h6_size ) ) . "px; }"."\n";
    }
    //Body size
    $body_size = get_theme_mod( 'body_size', '16' );
    if ($body_size) {
        $custom .= "body { font-size:" . intval ( esc_attr ( $body_size ) ) . "px; }"."\n";
    }
    //Single post title
    $single_post_title_size = get_theme_mod( 'single_post_title_size', '36' );
    if ($single_post_title_size) {
        $custom .= ".single .hentry .title-post { font-size:" . intval ( esc_attr ( $single_post_title_size ) ) . "px; }"."\n";
    }
    $banner_title_size = get_theme_mod( 'banner_title_size', '68' );
    if ($banner_title_size) {
        $custom .= ".header-content .maintitle, .slider-content .maintitle { font-size:" . intval ( esc_attr ( $banner_title_size ) ) . "px; }"."\n";
    }
    $banner_subtitle_size = get_theme_mod( 'banner_subtitle_size', '18' );
    if ($banner_subtitle_size) {
        $custom .= ".header-content .subtitle, .slider-content .subtitle { font-size:" . intval (  esc_attr ( $banner_subtitle_size ) ) . "px; }"."\n";
    }
	
	//__COLORS
	//Primary color
	$primary_color = get_theme_mod( 'primary_color', '#e64e4e' );
	if ( $primary_color != '#d65050' ) {
	$custom .= ".facts-section.style2 .roll-counter i,.type-team.type-b.style2 .team-thumb .team-social li:hover a,.portfolio-section.style2 .project-filter li a:hover,.timeline-section.style2 .timeline .icon .fa::before, .style1 .plan-icon, .style3 .plan-icon, .type-team.type-b .team-social li a,#site-navigation ul li a:hover, .type-team .team-content .name,.type-team .team-thumb .team-pop .team-social li:hover a,.roll-infomation li.address:before,.roll-infomation li.phone:before,.roll-infomation li.email:before,.banner-button.border,.banner-button:hover,.roll-icon-list .icon i,.roll-icon-list .content h3 a:hover,.roll-icon-box.white .content h3 a,.roll-icon-box .icon i,.roll-icon-box .content h3 a:hover,.switcher-container .switcher-icon a:focus,.go-top:hover,.hentry .meta-post a:hover,#site-navigation > ul > li > a.active, #site-navigation > ul > li > a:hover, button:hover, input[type=\"button\"]:hover,.woocommerce .cart_totals .button:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, .text-color, .social-menu-widget a, .social-menu-widget a:hover, .archive .team-social li a, a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .single .meta-post a, .header-contact .fa,.social-navigation li a:hover,.timeline-section.style2 .timeline-date,.default-testimonials .client-info .client .client-name,.style1 .client-info .client .client-name { color:" . esc_attr ( $primary_color ) . "}"."\n";
	$custom .= ".type-team.type-b.style2 .avatar::after,.project-filter li a.active,.project-filter li a:hover,.woocommerce #respond input#submit,.woocommerce button.button,.woocommerce input.button,.woocommerce .cart_totals .button,.project-filter li.active,.project-filter li:hover,.preloader .pre-bounce1, .preloader .pre-bounce2,.type-team .team-thumb .team-pop,.roll-progress .progress-animate,.roll-socials li a:hover,.roll-project .project-item .project-pop,.roll-project .project-filter li.active,.roll-project .project-filter li:hover,.banner-button.light:hover,.banner-button.border:hover,.banner-button,.roll-icon-box.white .icon,.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span, .bottom .socials li:hover a,.sidebar .widget:before,.blog-pagination ul li.active,.blog-pagination ul li:hover a,.content-area .hentry:after,.text-slider .maintitle:after,.error-wrap #search-submit:hover,#site-navigation .sub-menu li:hover > a,#site-navigation ul li ul:after, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"],.panel-grid-cell .widget-title:after,.social-section.style2 .social-menu-widget li a:hover,.cart-amount,.footer-contact .widget-title:after,.fp-contact .fa,.reply,.pricing-section .plan-item.featured-plan .plan-header,.go-top, .woocommerce .woocommerce-mini-cart-item .remove_from_cart_button, .woocommerce-mini-cart__buttons .button, .nav-cart .cart-count { background-color:" . esc_attr ( $primary_color ) . "}"."\n";
	$custom .= ".owl-theme .owl-controls .owl-page:hover span,.owl-theme .owl-controls .owl-page.active span,.type-team.type-b .team-social li a,.roll-socials li a:hover,.roll-socials li a,.banner-button.light:hover,.banner-button.border,.banner-button,.roll-icon-list .icon,.roll-icon-box .icon,.comment .comment-detail,.widget-tags .tag-list a:hover,.blog-pagination ul li,.hentry blockquote,.error-wrap #search-submit:hover,textarea:focus,input[type=\"text\"]:focus,input[type=\"password\"]:focus,input[type=\"datetime\"]:focus,input[type=\"datetime-local\"]:focus,input[type=\"date\"]:focus,input[type=\"month\"]:focus,input[type=\"time\"]:focus,input[type=\"week\"]:focus,input[type=\"number\"]:focus,input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"search\"]:focus,input[type=\"tel\"]:focus,input[type=\"color\"]:focus, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .archive .team-social li a,.latest-news-wrapper.carousel.style2 .meta-post a:hover { border-color:" . esc_attr ( $primary_color ) . "}"."\n";
	}
	//Body text color
	$body_text = get_theme_mod( 'body_text_color', '#47425d' );
	$custom .= "body { color:" . esc_attr ( $body_text ) . "}"."\n";
	
	//Menu background
	$menu_bg_color = get_theme_mod( 'menu_bg_color', '#000000' );
	$rgba = bizworx_hex2rgba($menu_bg_color, 0.9);
	$custom .= ".site-header.float-header { background-color:" . esc_attr ( $rgba ) . ";}" . "\n";
	$custom .= "@media only screen and (max-width: 1024px) { .site-header { background-color:" . esc_attr ( $menu_bg_color ) . ";}}" . "\n";
	
	//Site title
	$site_title = get_theme_mod( 'site_title_color', '#eeeeee' );
	$custom .= ".site-title a, .site-title a:hover { color:" . esc_attr ( $site_title ) . "}"."\n";
	//Site desc
	$site_desc = get_theme_mod( 'site_desc_color', '#eeeeee' );
	$custom .= ".site-description { color:" . esc_attr ( $site_desc ) . "}"."\n";
	
	//Top level menu items color
	$top_items_color = get_theme_mod( 'top_items_color', '#ffffff' );
	$custom .= "#site-navigation ul li a, #site-navigation ul li::before { color:" . esc_attr ( $top_items_color ) . "}"."\n";
	//Sub menu items color
	$submenu_items_color = get_theme_mod( 'submenu_items_color', '#ffffff' );
	$custom .= "#site-navigation ul ul li a { color:" . esc_attr ( $submenu_items_color ) . "}"."\n";
	//Sub menu background
	$submenu_background = get_theme_mod( 'submenu_background', '#1c1c1c' );
	$custom .= "#site-navigation ul ul li a { background:" . esc_attr ( $submenu_background ) . "}"."\n";
	//Footer widget area background
	$footer_widgets_background = get_theme_mod( 'footer_widgets_background', '#252525' );
	$custom .= ".footer-widgets { background-color:" . esc_attr ( $footer_widgets_background ) . "}"."\n";	
	//Footer widget area color
	$footer_widgets_color = get_theme_mod( 'footer_widgets_color', '#767676' );
	if ( $footer_widgets_color != '#767676' ) {
		$custom .= "#sidebar-footer,#sidebar-footer a,.footer-widgets .widget-title { color:" . esc_attr ($footer_widgets_color ) . "}"."\n";	
	}
	//Footer background
	$footer_background = get_theme_mod( 'footer_background', '#1c1c1c' );
	$custom .= ".site-footer { background-color:" . esc_attr ( $footer_background ) . "}"."\n";	
	//Footer color
	$footer_color = get_theme_mod( 'footer_color', '#666666' );
	$custom .= ".site-footer,.site-footer a { color:" . esc_attr ( $footer_color ) . "}"."\n";
	
	//Header banner text
	$banner_text = get_theme_mod( 'banner_text_color', '#ffffff' );
	$custom .= ".header-content .maintitle, .slider-content .maintitle, .header-content .subtitle, .slider-content .subtitle { color:" . esc_attr ( $banner_text ) . "}"."\n";
	
	//Header background
	$header_bg_image = get_theme_mod('background_image_1', get_stylesheet_directory_uri() . '/images/1.jpg');
	$header_bg_size = get_theme_mod('header_bg_size', 'cover');
	$header_bg_height = get_theme_mod('header_height', '600');
	
	$custom .= ".header-background { background: url(" . esc_attr ( $header_bg_image ) . "); background-size: " . esc_attr ( $header_bg_size ) . "; height: " . esc_attr ( $header_bg_height ) . "px; }"."\n";
	
	//Page wrapper padding
	$pg_top_padding = get_theme_mod( 'wrapper_top_padding', '83' );
	$pg_bottom_padding = get_theme_mod( 'wrapper_bottom_padding', '100' );
	$custom .= ".page-wrap { padding-top:" . intval( esc_attr( $pg_top_padding ) ) . "px;}"."\n";	
	$custom .= ".page-wrap { padding-bottom:" . intval( esc_attr ( $pg_bottom_padding ) ) . "px;}"."\n";
	
	//Small screens font sizes
    $custom .= "@media only screen and (max-width: 780px) { 
    	h1 { font-size: 32px;}
		h2 { font-size: 28px;}
		h3 { font-size: 22px;}
		h4 { font-size: 18px;}
		h5 { font-size: 16px;}
		h6 { font-size: 14px;}
    }" . "\n";    
    $custom .= "@media only screen and (max-width: 767px) { 
    	.header-content .maintitle, .slider-content .maintitle { font-size: 32px;}
    }" . "\n"; 
    $custom .= "@media only screen and (max-width: 479px) { 
    	.header-content .maintitle, .slider-content .maintitle { font-size: 20px;}
		.header-content .subtitle, .slider-content .subtitle { font-size: 18px; }    	
    }" . "\n";
	
	//Wc shop page sidebar
	if(get_theme_mod('wc_content_location')){
		$wc_content_location = get_theme_mod('wc_content_location', 'right');
		$custom .= ".woocommerce .content-area, .woocommerce-cart .content-area, .woocommerce-checkout .content-area {float: ".esc_attr ( $wc_content_location ) .";}";
	}
	
	
	//Output all the styles
	wp_add_inline_style( 'bizworx-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'bizworx_custom_styles' );