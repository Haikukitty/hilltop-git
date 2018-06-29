<?php

/*
 * Plugin Name: Divi Popup Builder
 * Plugin URI:  http://www.sean-barton.co.uk
 * Description: A plugin to add a module to create and trigger modal windows
 * Author:      Sean Barton - Tortoise IT
 * Version:     1.8
 * Author URI:  http://www.sean-barton.co.uk
 *
 *
 * Changelog
 *
 * < V1.4
 * - Initial Release
 *
 * V1.5
 * - Fixed responsive text size/line height issues
 * - Added more configuration options in advanced design settings across all modules
 *
 * V1.6
 * - Better support for video popup types
 * - More trigger styles/CSS
 * - Support added for px and % sizing 
 *
 * V1.7 (08/02/18)
 * - Moved init hook to builder ready to avoid conflicts
 * - Moved editable fields to new builder groups for a better experience
 * - Added new triggers - exit intent, scroll % and on blur of input element
 * - Added new responsive styling options (tablet and mobile width/height settings)
 * - Renamed module from Modal / Popup Builder to just Popup Builder
 * - Added Licensing/Auto Update
 * - Added 'Theme Style' skin which picks up accent color from the theme and uses a more modern style
 *
 * V1.8 (05/04/18)
 * - Added URL parameter for page load option
 * - Fixed iframe when used in class/id trigger
 *
 *
 */

$sb_dpb_enqueued_ei = false;
$sb_dpb_enqueued_sd = false;

//constants
define('SB_DPB_VERSION', '1.8');
define('SB_DPB_STORE_URL', 'https://elegantmarketplace.com');
define('SB_DPB_ITEM_NAME', 'DIVI POPUP MODAL Module');
define('SB_DPB_AUTHOR_NAME', 'Sean Barton');
define('SB_DPB_ITEM_ID', 50225);
define('SB_DPB_FILE', __FILE__);

require_once('includes/emp-licensing.php');

add_action('plugins_loaded', 'sb_dpb_init');

function sb_dpb_init()
{
    add_action('et_builder_ready', 'sb_dpb_theme_setup', 9999);
    add_action('wp_head', 'sb_dpb_wp_head', 9999);
    add_action('admin_head', 'sb_dpb_admin_head', 9999);
    add_action('admin_menu', 'sb_dpb_submenu');
    add_action('wp_enqueue_scripts', 'sb_dpb_enqueue', 9999);
}

function sb_dpb_wp_head() {

    if ($style_id = get_post_meta(get_the_ID(), 'sb_dbp_enqueue_style_id', true)) {
        if ($style_id == 'theme-style') {
            $divi = get_option('et_divi');
            $bg = (isset($divi['accent_color']) ? $divi['accent_color']:'#2ea3f2 ');

            //[accent_color] => #2ea3f2
            echo '<style>
                #cboxOverlay{ background-color: ' . $bg . '; }
            </style>';
        }
    }
}

function sb_dpb_submenu()
{
    add_submenu_page(
        'plugins.php',
        'Divi Popup Module',
        'Divi Popup Module',
        'manage_options',
        'sb_dpb',
        'sb_dpb_submenu_cb');
}

function sb_dpb_submenu_cb()
{

    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Divi Popup Module</h2>';

    echo '<div id="poststuff">';

    echo '<div id="post-body" class="metabox-holder columns-2">';

    echo '<form method="POST">';

    sb_dpb_license_page();

    echo '</form>';

    echo '</div>';
    echo '</div>';

    echo '</div>';
}

function sb_dpb_enqueue()
{
    wp_enqueue_script('jquery');
    wp_enqueue_style('sb_dpb_custom_css', plugins_url('/style.css', __FILE__));

    if ($file = get_post_meta(get_the_ID(), 'sb_dbp_enqueue_style', true)) {
        wp_enqueue_style('sb_dpb_colorbox_css', $file);
    }

    wp_enqueue_script('sb_dpb_colorbox_js', plugins_url('/colorbox/jquery.colorbox-min.js', __FILE__));
}

function sb_dpb_box_start($title)
{
    return '<div class="postbox">
                    <h2 class="hndle">' . $title . '</h2>
                    <div class="inside">';
}

function sb_dpb_box_end()
{
    return '    </div>
                </div>';
}

function sb_dpb_admin_head()
{

    if (!isset($_GET['post_type']) || $_GET['post_type'] != 'et_pb_layout') {
        //return; //we will only purge the cache on the layouts page
    }

    $prop_to_remove = array(
        'et_pb_templates_et_pb_popup_builder'
    );

    $js_prop_to_remove = 'var sb_ls_remove = ["' . implode('","', $prop_to_remove) . '"];';

    echo '<script>
	
	' . $js_prop_to_remove . '
	
	for (var prop in localStorage) {
	    if (sb_ls_remove.indexOf(prop) != -1) {
		//console.log("found "+prop);
		console.log(localStorage.removeItem(prop));	
	    }
	}
	
	</script>';
}

function sb_dpb_theme_setup()
{

    if (class_exists('ET_Builder_Module')) {

        class et_pb_popup_builder extends ET_Builder_Module
        {
            function init()
            {
                $this->name = __('Popup Builder', 'et_builder');
                $this->slug = 'et_pb_popup_builder';

                $this->whitelisted_fields = array(
                    'module_id',
                    'module_class',
                    'title',
                    'modal_style',
                    'content',
                    'popup_source',
                    'popup_wysiwyg',
                    'video_url',
                    'image_url',
                    'image_size',
                    'iframe_url',
                    'divi_layout',
                    'trigger_condition',
                    'trigger_image_url',
                    'trigger_image_size',
                    'trigger_content',
                    'trigger_button_text',
                    'trigger_button_align',
                    'trigger_button_text_colour',
                    'trigger_page_load_delay',
                    'trigger_page_load_qs_key',
                    'trigger_page_load_qs_val',
                    'trigger_scroll_delay',
                    'trigger_class_id',
                    'trigger_blur_class_id',
                    'modal_width',
                    'modal_height',
                    'tablet_modal_width',
                    'tablet_modal_height',
                    'mobile_modal_width',
                    'mobile_modal_height',
                    'tablet_sizes',
                    'mobile_sizes',
                );

                $this->fields_defaults = array();
                $this->main_css_element = '%%order_class%%';

                $this->options_toggles = array(
                    'general' => array(
                        'toggles' => array(
                            'main_settings' => esc_html__('Main Settings', 'et_builder'),
                        ),
                    ),
                );

                $this->advanced_options = array(
                    'fonts' => array(
                        'text' => array(
                            'label' => esc_html__('Text', 'et_builder'),
                            'css' => array(
                                'main' => "{$this->main_css_element} p",
                            ),
                            'font_size' => array('default' => '14px'),
                            'line_height' => array('default' => '1.5em'),
                        ),
                        'trigger_text' => array(
                            'label' => esc_html__('Trigger Button', 'et_builder'),
                            'css' => array(
                                'main' => "{$this->main_css_element} .trigger_sb_divi_modal .sb_pb_modal_button"
                            ),
                            'font_size' => array('default' => '14px'),
                            'line_height' => array('default' => '1.5em'),
                        ),
                        'headings' => array(
                            'label' => esc_html__('Headings', 'et_builder'),
                            'css' => array(
                                'main' => "{$this->main_css_element} h1, {$this->main_css_element} h2, {$this->main_css_element} h1 a, {$this->main_css_element} h2 a, {$this->main_css_element} h3, {$this->main_css_element} h4",
                            ),
                            'font_size' => array('default' => '30px'),
                            'line_height' => array('default' => '1.5em'),
                        ),
                    ),
                    'button' => array(
                        'button' => array(
                            'label' => esc_html__( 'Button', 'et_builder' ),
                            'css' => array(
                                'main' => $this->main_css_element . ' .et_pb_button.et_pb_button sb_pb_modal_button',
                                'plugin_main' => "{$this->main_css_element}.et_pb_module",
                            ),
                        ),
                    ),
                    'background' => array(
                        'settings' => array(
                            'color' => 'alpha',
                        ),
                    ),
                    'border' => array(),
                    'custom_margin_padding' => array(
                        'css' => array(
                            'important' => 'all',
                        ),
                    ),
                );

            }

            function get_fields()
            {
                $source_options = array(
                    'video' => 'Video'
                , 'image' => 'Image'
                , 'content_editor' => 'Content/Editor'
                , 'layout' => 'Layout'
                , 'iframe' => 'iFrame'
                );

                $image_options = array();
                $sizes = get_intermediate_image_sizes();

                foreach ($sizes as $size) {
                    $image_options[$size] = $size;
                }

                $layout_query = array(
                    'post_type' => 'et_pb_layout'
                , 'posts_per_page' => -1
                , 'meta_query' => array(
                        array(
                            'key' => '_et_pb_predefined_layout',
                            'compare' => 'NOT EXISTS',
                        ),
                    )
                );

                $layout_options = array();
                $layouts = get_posts($layout_query);

                foreach ($layouts as $layout) {
                    $layout_options[$layout->ID] = $layout->post_title;
                }

                $trigger_options = array(
                    'button' => 'Button'
                , 'image' => 'Image'
                , 'class_id' => 'Class/ID of ANY other module'
                , 'onblur' => 'On Blur (Class/ID of input element)'
                , 'scroll_delay' => 'Scroll Delay (%)'
                , 'exit_intent' => 'When the user leaves the page (or closes the window)'
                , 'page_load' => 'At Page Load (after X seconds and/or based on querystring parameters)'
                );

                $modal_style_options = array(
                    'theme-style' => 'Theme Style'
                , '1' => 'Style 1'
                , '2' => 'Style 2'
                , '3' => 'Style 3'
                , '4' => 'Style 4'
                , '5' => 'Style 5'
                );

                $fields = array(

                    'title' => array(
                        'label' => __('Title', 'et_builder'),
                        'type' => 'text',
                        'description' => __('Optional heading to show on the front end', 'et_builder'),
                        'toggle_slug' => 'main_settings',
                    ),
                    'popup_source' => array(
                        'label' => __('Popup Source', 'et_builder'),
                        'type' => 'select',
                        'options' => $source_options,
                        'toggle_slug' => 'main_settings',
                        'affects' => array(
                            '#et_pb_video_url',
                            '#et_pb_image_url',
                            '#et_pb_image_size',
                            '#et_pb_divi_layout',
                            '#et_pb_iframe_url',
                        ),
                        'description' => __('Pick where your popup/modal will come from.', 'et_builder'),
                    ),
                    'video_url' => array(
                        'label' => __('Video URL', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'video',
                        'description' => __('The URL of the video to show in the popup.', 'et_builder'),
                    ),
                    'image_url' => array(
                        'label' => __('Image URL', 'et_builder'),
                        'type' => 'upload',
                        'upload_button_text' => esc_attr__('Upload an image', 'et_builder'),
                        'choose_text' => esc_attr__('Choose a Modal Image', 'et_builder'),
                        'update_text' => esc_attr__('Set As Modal Image', 'et_builder'),
                        'depends_show_if' => 'image',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The URL of the image to show in the popup.', 'et_builder'),
                    ),
                    /*'image_size' => array(
                            'label'           => __( 'Image Size', 'et_builder' ),
                            'type'            => 'select',
                            'options'         => $image_options,
                            'depends_show_if'   => 'image',
                            'description'       => __( 'Pick a size for the image to pop up at. If there is no size you like in the list consider using the free <a href="https://wordpress.org/plugins/simple-image-sizes/" target="_blank">Simple Image Sizes</a> plugin where you can define your own.', 'et_builder' ),
                    ),*/
                    'iframe_url' => array(
                        'label' => __('iFrame URL', 'et_builder'),
                        'type' => 'text',
                        'depends_show_if' => 'iframe',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The URL of the page to show in the popup.', 'et_builder'),
                    ),
                    'divi_layout' => array(
                        'label' => __('Divi Layout', 'et_builder'),
                        'type' => 'select',
                        'options' => $layout_options,
                        'depends_show_if' => 'layout',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The layout to use for the modal.', 'et_builder'),
                    ),
                    'popup_wysiwyg' => array(
                        'label' => __('Popup Content', 'et_builder'),
                        'type' => 'tiny_mce',
                        'toggle_slug' => 'main_settings',
                        //'depends_show_if'   => 'content_editor',
                        'description' => __('The content to show within the modal window. Only relevat when the popup source is set to content/editor', 'et_builder'),
                    ),
                    'trigger_condition' => array(
                        'label' => __('Trigger Type', 'et_builder'),
                        'type' => 'select',
                        'toggle_slug' => 'main_settings',
                        'options' => $trigger_options,
                        'affects' => array(
                            '#et_pb_trigger_image_url',
                            '#et_pb_trigger_image_size',
                            '#et_pb_trigger_button_text',
                            '#et_pb_trigger_button_align',
                            '#et_pb_trigger_button_text_colour',
                            '#et_pb_trigger_page_load_delay',
                            '#et_pb_trigger_page_load_qs_key',
                            '#et_pb_trigger_page_load_qs_val',
                            '#et_pb_trigger_scroll_delay',
                            '#et_pb_trigger_class_id',
                            '#et_pb_trigger_blur_class_id',
                            //'#et_pb_trigger_content',
                        ),
                        'description' => __('What causes the popup to trigger?', 'et_builder'),
                    ),
                    'trigger_image_url' => array(
                        'label' => __('Trigger Image', 'et_builder'),
                        'type' => 'upload',
                        'toggle_slug' => 'main_settings',
                        'upload_button_text' => esc_attr__('Upload an image', 'et_builder'),
                        'choose_text' => esc_attr__('Choose a Trigger Image', 'et_builder'),
                        'update_text' => esc_attr__('Set As Trigger Image', 'et_builder'),
                        'depends_show_if' => 'image',
                        'description' => __('What image will trigger the modal?', 'et_builder'),
                    ),
                    /*'trigger_image_size' => array(
                            'label'           => __( 'Trigger Image Size', 'et_builder' ),
                            'type'            => 'select',
                            'options'         => $image_options,
                            'depends_show_if'   => 'image',
                            'description'       => __( 'Pick a predefined image size for this trigger', 'et_builder' ),
                        ),*/
                    'trigger_scroll_delay' => array(
                        'label' => __('Trigger after scrolling by how far (%)?', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'scroll_delay',
                        'description' => __('If the popup is to be triggered by a scroll delay then how far should the user need to scroll (as a %) before the modal triggers? Enter a whole number which will be interpreted as a percentage.', 'et_builder'),
                    ),
                    'trigger_page_load_delay' => array(
                        'label' => __('Trigger after a delay?', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'page_load',
                        'description' => __('If the popup is to be triggered at page load then should it be instant (on document ready) or after a number of seconds. Enter a whole number in seconds.', 'et_builder'),
                    ),
                    'trigger_page_load_qs_key' => array(
                        'label' => __('Querystring Key', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'page_load',
                        'description' => __('Should the presence of a querystring parameter trigger the popup (yourdomain.com/?test=1 where the key is "test"). Using this without a value will trigger with ANY value.', 'et_builder'),
                    ),
                    'trigger_page_load_qs_val' => array(
                        'label' => __('Querystring Value', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'page_load',
                        'description' => __('This goes with "Querystring Key" above. This requires BOTH the KEY and VALUE to be defined and match to trigger the popup. (yourdomain.com/?test=foo where key is test and value is foo).', 'et_builder'),
                    ),
                    'trigger_class_id' => array(
                        'label' => __('Class / ID', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'class_id',
                        'description' => __('Enter a CSS class or ID. Making sure to prefix . or # respectively. Advanced users only', 'et_builder'),
                    ),
                    'trigger_blur_class_id' => array(
                        'label' => __('Blur Class / ID', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'blur_class_id',
                        'description' => __('Blur is when a user clicks out of an input field (in a form). Enter a CSS class or ID. Making sure to prefix . or # respectively.', 'et_builder'),
                    ),
                    'trigger_button_text' => array(
                        'label' => __('Button Text', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'button',
                        'description' => __('What should the trigger button say?', 'et_builder'),
                    ),
                    'trigger_button_align' => array(
                        'label' => esc_html__('Button Alignment', 'et_builder'),
                        'type' => 'select',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'button',
                        'options' => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
                        'description' => esc_html__('This will control how your button is aligned.', 'et_builder'),
                    ),
                    'trigger_button_text_colour' => array(
                        'label' => __('Button Background Colour', 'et_builder'),
                        'type' => 'color-alpha',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'button',
                        'description' => __('What background colour should the trigger button have?', 'et_builder'),
                    ),
                    /*'trigger_content' => array(
                        'label'           => __( 'Content', 'et_builder' ),
                        'type'            => 'tiny_mce',
                        //'depends_show_if'   => 'content_editor',
                        'description'     => __( 'Use this as you see fit. Clicking anyone within the content will trigger the modal. Only use this when the trigger type is content/editor', 'et_builder' ),
                    ),*/
                    'modal_style' => array(
                        'label' => __('Popup Style', 'et_builder'),
                        'type' => 'select',
                        'toggle_slug' => 'main_settings',
                        'options' => $modal_style_options,
                        'description' => __('The style of the popup. Pick one of four styles. Click the following links for examples. <a target="_blank" href="' . plugins_url('/colorbox/example1/index.html', __FILE__) . '">Style 1</a>, <a target="_blank" href="' . plugins_url('/colorbox/example2/index.html', __FILE__) . '">Style 2</a>, <a target="_blank" href="' . plugins_url('/colorbox/example3/index.html', __FILE__) . '">Style 3</a>, <a target="_blank" href="' . plugins_url('/colorbox/example4/index.html', __FILE__) . '">Style 4</a>, <a target="_blank" href="' . plugins_url('/colorbox/example5/index.html', __FILE__) . '">Style 5</a>.', 'et_builder'),
                    ),
                    /*'masonry_tile_background_color' => array(
                        'label' => esc_html__('Grid Tile Background Color', 'et_builder'),
                        'type' => 'color-alpha',
                        'custom_color' => true,
                        'tab_slug' => 'advanced',
                        'toggle_slug' => 'main_settings',
                        'depends_show_if' => 'off',
                    ),*/
                    'modal_width' => array(
                        'label' => __('Popup Width', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The width in % of the modal window. Defaults to 80%.', 'et_builder'),
                    ),
                    'modal_height' => array(
                        'label' => __('Popup Height', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The height in % of the modal window. Defaults to 80%.', 'et_builder'),
                    ),
                    'tablet_sizes' => array(
                        'label' => __('Set Tablet Popup Size?', 'et_builder'),
                        'type' => 'yes_no_button',
                        'options' => array(
                            'off' => esc_html__('No', 'et_builder'),
                            'on' => esc_html__('Yes', 'et_builder'),
                        ),
                        'toggle_slug' => 'main_settings',
                        'affects' => array(
                            '#et_pb_tablet_modal_width',
                            '#et_pb_tablet_modal_height',
                        ),
                        'description' => __('Set the size of the modal window when viewed on a tablet.', 'et_builder'),
                    ),
                    'tablet_modal_width' => array(
                        'label' => __('Tablet Popup Width', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The width in % of the modal window on a tablet. Defaults to 80%.', 'et_builder'),
                    ),
                    'tablet_modal_height' => array(
                        'label' => __('Tablet Popup Height', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The height in % of the modal window on a tablet. Defaults to 80%.', 'et_builder'),
                    ),
                    'mobile_sizes' => array(
                        'label' => __('Set Mobile Popup Size?', 'et_builder'),
                        'type' => 'yes_no_button',
                        'options' => array(
                            'off' => esc_html__('No', 'et_builder'),
                            'on' => esc_html__('Yes', 'et_builder'),
                        ),
                        'toggle_slug' => 'main_settings',
                        'affects' => array(
                            '#et_pb_mobile_modal_width',
                            '#et_pb_mobile_modal_height',
                        ),
                        'description' => __('Set the size of the modal window when viewed on a mobile.', 'et_builder'),
                    ),
                    'mobile_modal_width' => array(
                        'label' => __('Mobile Popup Width', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The width in % of the modal window on a mobile. Defaults to 80%.', 'et_builder'),
                    ),
                    'mobile_modal_height' => array(
                        'label' => __('Mobile Popup Height', 'et_builder'),
                        'type' => 'text',
                        'toggle_slug' => 'main_settings',
                        'description' => __('The height in % of the modal window on a mobile. Defaults to 80%.', 'et_builder'),
                    ),
                    'admin_label' => array(
                        'label' => __('Admin Label', 'et_builder'),
                        'type' => 'text',
                        'option_category' => 'configuration',
                        'tab_slug' => 'custom_css',
                        'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
                    ),
                    'module_id' => array(
                        'label' => __('CSS ID', 'et_builder'),
                        'type' => 'text',
                        'option_category' => 'configuration',
                        'tab_slug' => 'custom_css',
                        'option_class' => 'et_pb_custom_css_regular',
                    ),
                    'module_class' => array(
                        'label' => __('CSS Class', 'et_builder'),
                        'type' => 'text',
                        'option_category' => 'configuration',
                        'tab_slug' => 'custom_css',
                        'option_class' => 'et_pb_custom_css_regular',
                    ),
                );
                return $fields;
            }

            function shortcode_callback($atts, $content = null, $function_name)
            {
                global $sb_dpb_enqueued_ei, $sb_dpb_enqueued_sd;
                if (is_admin()) {
                    return;
                }

                $module_id = $this->shortcode_atts['module_id'];
                $unique_id = 'sb_divi_modal_' . uniqid();
                $module_class = $this->shortcode_atts['module_class'];
                $button_colour = $this->shortcode_atts['trigger_button_text_colour'];
                $button_align = $this->shortcode_atts['trigger_button_align'];
                $trigger_page_load_delay = $this->shortcode_atts['trigger_page_load_delay'];
                $trigger_scroll_delay = $this->shortcode_atts['trigger_scroll_delay'];
                $trigger_page_load_qs_key = $this->shortcode_atts['trigger_page_load_qs_key'];
                $trigger_page_load_qs_val = $this->shortcode_atts['trigger_page_load_qs_val'];
                $trigger_class_id = $this->shortcode_atts['trigger_class_id'];
                $trigger_blur_class_id = $this->shortcode_atts['trigger_blur_class_id'];
                $title = $this->shortcode_atts['title'];

                $tablet_sizes = @$this->shortcode_atts['tablet_sizes'];
                $tablet_modal_width = @$this->shortcode_atts['tablet_modal_width'];
                $tablet_modal_height = @$this->shortcode_atts['tablet_modal_height'];
                $mobile_sizes = @$this->shortcode_atts['mobile_sizes'];
                $mobile_modal_width = @$this->shortcode_atts['mobile_modal_width'];
                $mobile_modal_height = @$this->shortcode_atts['mobile_modal_height'];

                $width = $this->shortcode_atts['modal_width'];
                $height = $this->shortcode_atts['modal_height'];

                $module_class = ET_Builder_Element::add_module_order_class($module_class, $function_name);

                if ('' !== $button_colour && $this->shortcode_atts['trigger_condition'] == 'button') {
                    ET_Builder_Element::set_style($function_name, array(
                        'selector' => '%%order_class%% .sb_pb_modal_button',
                        'declaration' => sprintf(
                            'background-color: %1$s;',
                            esc_html($button_colour)
                        ),
                    ));
                }
                if ('' !== $button_align && $this->shortcode_atts['trigger_condition'] == 'button') {
                    ET_Builder_Element::set_style($function_name, array(
                        'selector' => '%%order_class%% .trigger_' . $unique_id,
                        'declaration' => sprintf(
                            'text-align: %1$s;',
                            esc_html($button_align)
                        ),
                    ));
                }

                if ($this->shortcode_atts['modal_style']) {
                    update_post_meta(get_the_ID(), 'sb_dbp_enqueue_style', plugins_url('/colorbox/example' . $this->shortcode_atts['modal_style'] . '/colorbox.css', __FILE__));
                    update_post_meta(get_the_ID(), 'sb_dbp_enqueue_style_id', $this->shortcode_atts['modal_style']);
                }

                //desktop
                if ($width && strpos($width, '%') === false) {
                    if ($width <= 100) {
                        $width .= '%';
                    }
                }
                if ($height && strpos($height, '%') === false) {
                    if ($height <= 100) {
                        $height .= '%';
                    }
                }
                if (!$width) {
                    $width = '80%';
                }

                //tablet
                if ($tablet_modal_width && strpos($tablet_modal_width, '%') === false) {
                    if ($tablet_modal_width <= 100) {
                        $tablet_modal_width .= '%';
                    }
                }
                if ($tablet_modal_height && strpos($tablet_modal_height, '%') === false) {
                    if ($tablet_modal_height <= 100) {
                        $tablet_modal_height .= '%';
                    }
                }
                if (!$tablet_modal_width) {
                    $tablet_modal_width = '80%';
                }

                //mobile
                if ($mobile_modal_width && strpos($mobile_modal_width, '%') === false) {
                    if ($mobile_modal_width <= 100) {
                        $mobile_modal_width .= '%';
                    }
                }
                if ($mobile_modal_height && strpos($mobile_modal_height, '%') === false) {
                    if ($mobile_modal_height <= 100) {
                        $mobile_modal_height .= '%';
                    }
                }
                if (!$mobile_modal_width) {
                    $mobile_modal_width = '80%';
                }
                //////

                if ($this->shortcode_atts['popup_source'] != 'video') {
                    if (!$height) {
                        $height = '80%';
                    }
                }

                //////////////////////////////////////////////////////////////////////

                $content = '';

                //echo '<pre>';
                //print_r($this->shortcode_atts);
                //echo '</pre>';

                if ($title) {
                    $content .= '<h2 itemprop="name" class="et_pb_popup_builder_label">' . $title . '</h2>';
                }

                $additional_args = array();
                $inline_content = '';
                $trigger_content = '';

                if ($width) {
                    $additional_args['mwidth'] = 'maxWidth: "' . $width . '"';
                }

                if ($this->shortcode_atts['modal_height']) {
                    $additional_args['mheight'] = 'maxHeight: "' . $height . '"';
                }

                switch ($this->shortcode_atts['popup_source']) {
                    case 'image':
                        $trigger_content .= '<a class="trigger_sb_divi_modal trigger_' . $unique_id . '" href="' . $this->shortcode_atts['image_url'] . '">';

                        break;
                    case 'video':
                        $trigger_content .= '<a class="trigger_sb_divi_modal trigger_' . $unique_id . '">';
                        $inline_content = wp_oembed_get(do_shortcode($this->shortcode_atts['video_url']));
                        $additional_args[] = 'href: "#' . $unique_id . '"';
                        $additional_args[] = 'inline: true';
                        $additional_args[] = 'innerWidth: "' . $width . '"';

                        break;
                    case 'iframe':
                        $trigger_content .= '<a class="trigger_sb_divi_modal trigger_' . $unique_id . '" href="' . $this->shortcode_atts['iframe_url'] . '">';
                        $additional_args[] = 'iframe: true';
                        $additional_args[] = 'href: "' . $this->shortcode_atts['iframe_url'] . '"';
                        $additional_args[] = 'width: "' . $width . '%"';
                        $additional_args[] = 'height: "' . $height . '%"';

                        break;
                    case 'content_editor':
                        $trigger_content .= '<a class="trigger_sb_divi_modal trigger_' . $unique_id . '"">';
                        $inline_content = do_shortcode($this->shortcode_content);
                        $additional_args[] = 'href: "#' . $unique_id . '"';
                        $additional_args[] = 'inline: true';
                        $additional_args[] = 'width: "' . $width . '%"';

                        break;
                    case 'layout':
                        $trigger_content .= '<a class="trigger_sb_divi_modal  trigger_' . $unique_id . '"">';
                        $inline_content = '<div class="et-main-area">' . do_shortcode('[et_pb_section global_module="' . $this->shortcode_atts['divi_layout'] . '"][/et_pb_section]') . '</div>';
                        $additional_args[] = 'href: "#' . $unique_id . '"';
                        $additional_args[] = 'inline: true';
                        $additional_args[] = 'width: "' . $width . '%"';
                        $additional_args[] = 'height: "' . $height . '%"';

                        break;
                }

                switch ($this->shortcode_atts['trigger_condition']) {
                    case 'image':
                        $trigger_content .= '<img src="' . $this->shortcode_atts['trigger_image_url'] . '" />';

                        break;

                    //case 'wysiwyg':
                    //$trigger_content .= '<div class="sb_pb_content">' . apply_filters('the_content', $this->shortcode_content) . '</div>';
                    //break;

                    case 'button':
                        $trigger_content .= '<span class="et_pb_button sb_pb_modal_button">' . $this->shortcode_atts['trigger_button_text'] . '</span>';
                        break;

                    case 'scroll_delay':
                    case 'exit_intent':
                    case 'on_blur':
                    case 'page_load':
                    case 'class_id':
                        $trigger_content = ''; //there is no trigger so let's clear it as it would have been set above
                        break;

                }

                if ($trigger_content) {
                    $trigger_content .= '</a>';
                }

                $trigger_content = apply_filters('sb_divi_pb_custom_trigger', $trigger_content, $unique_id, $module_id);

                $content .= $trigger_content; //append the trigger

                $trigger_id = '.trigger_' . $unique_id;
                if ($this->shortcode_atts['trigger_condition'] == 'class_id' && $trigger_class_id) {
                    $trigger_id = $trigger_class_id;
                } else if ($this->shortcode_atts['trigger_condition'] == 'on_blur' && $trigger_blur_class_id) {
                    $trigger_id = $trigger_blur_class_id;
                }

                $additional_args[] = 'onComplete: function(){ sb_dpb_' . $unique_id . '_check_responsive(); }';
                $args = '{ ' . implode(', ', $additional_args) . ' }';

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $content .= '<script>
                    function sb_dpb_' . $unique_id . '_check_responsive() {
					        var sb_dpb_window_width = jQuery( window ).width();
					        
						    if (sb_dpb_window_width <= 550) {';

                if ($mobile_sizes == 'on') {
                    $content .= 'jQuery.colorbox.resize({width:"' . $mobile_modal_width . '", height:"' . $mobile_modal_height . '"});';
                } else {
                    $content .= 'jQuery.colorbox.resize({width:"90%", maxHeight:"70%"});';
                }

                if ($tablet_sizes == 'on') {
                    $content .= '} else if (sb_dpb_window_width > 550 && sb_dpb_window_width < 981) {
                                    jQuery.colorbox.resize({width:"' . $tablet_modal_width . '", height:"' . $tablet_modal_height . '"});';
                }

                $content .= ' 
						    } else {
                                jQuery.colorbox.resize(' . $args . ');
                            }
			        }';

                $colorbox_trigger = '';

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                if ($this->shortcode_atts['trigger_condition'] == 'page_load') {
                    if (
                        !$trigger_page_load_qs_key ||
                        ($trigger_page_load_qs_key && !$trigger_page_load_qs_val && isset($_GET[$trigger_page_load_qs_key])) ||
                        ($trigger_page_load_qs_key && $trigger_page_load_qs_val && isset($_GET[$trigger_page_load_qs_key]) && $_GET[$trigger_page_load_qs_key] == $trigger_page_load_qs_val)
                    ) {
                        $trigger_page_load_delay *= 1000;

                        $colorbox_trigger .= 'jQuery(document).ready(function() {
                                                jQuery.colorbox(' . $args . ');
					                     });';

                        if ($trigger_page_load_delay) {
                            $content .= 'setTimeout(function() {' . $colorbox_trigger . '}, ' . $trigger_page_load_delay . ');';
                        } else {
                            $content .= $colorbox_trigger;
                        }
                    }

                } else if ($this->shortcode_atts['trigger_condition'] == 'exit_intent') {

                    if (!$sb_dpb_enqueued_ei) {
                        $colorbox_trigger .= 'var s = document.createElement("script");
                                          s.type = "text/javascript";
                                          s.src = "' . plugins_url('/includes/js/jquery.exitintent.min.js', __FILE__) . '";
                                          jQuery("head").append(s);';
                        $sb_dpb_enqueued_ei = true;
                    }

                    $colorbox_trigger .= 'jQuery(document).ready(function() {
                                                jQuery.exitIntent("enable");
                     
                                                jQuery(document).bind("exitintent", function() {
                                                    jQuery.colorbox(' . $args . ');
                                                });
					                      });';

                    $content .= $colorbox_trigger;

                } else if ($this->shortcode_atts['trigger_condition'] == 'scroll_delay') {
                    $colorbox_trigger .= 'jQuery(document).ready(function() {
                                                var sb_dpb_timer_' . $unique_id . ';
                                                var sb_dpb_shown_' . $unique_id . ' = 0;
                                                var sb_dpb_body_height_' . $unique_id . ' = jQuery("body").height();
                                                var sb_dpb_window_height_' . $unique_id . ' = jQuery(window).height();
                                                var sb_dpb_trigger_height_' . $unique_id . ' = ' . ($trigger_scroll_delay / 100) . ' * sb_dpb_body_height_' . $unique_id . ';
                                                
                                                jQuery(window).scroll(function() {
                                                    if(sb_dpb_timer_' . $unique_id . ') {
                                                        window.clearTimeout(sb_dpb_timer_' . $unique_id . ');
                                                    }
                        
                                                    sb_dpb_timer_' . $unique_id . ' = window.setTimeout(function() {
                                                            if (sb_dpb_shown_' . $unique_id . ' == 0) {
                                                                var sb_dpb_y_' . $unique_id . ' = jQuery(window).scrollTop() + (sb_dpb_window_height_' . $unique_id . '/2);
                                                                
                                                                if (sb_dpb_y_' . $unique_id . ' > sb_dpb_trigger_height_' . $unique_id . ') {
                                                                    sb_dpb_shown_' . $unique_id . ' = 1;
                                                                    jQuery.colorbox(' . $args . ');
                                                                }
                                                                
                                                            }
                                                    }, 100);
                                                });
                                            });';

                    $content .= $colorbox_trigger;

                } else if ($this->shortcode_atts['trigger_condition'] == 'on_blur') {
                    $content .= 'jQuery(document).ready(function() {
                                    jQuery("' . $trigger_id . '").blur(function() { 
                                        colorbox(' . $args . '); 
                                    });
                                 });';

                } else {

                    $content .= 'jQuery(document).ready(function() {
                                    jQuery("' . $trigger_id . '").colorbox(' . $args . ');
                                 });';
                }

                $content .= 'jQuery(document).ready(function() {
                                jQuery( window ).resize(function() { //repeat for resize
                                    sb_dpb_' . $unique_id . '_check_responsive();
                                });
                             });';

                $content .= '</script>';

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $content .= '<div style="display:none;">
					    <div class="sb_divi_modal" id="' . $unique_id . '">
						<div class="container-' . $this->shortcode_atts['popup_source'] . '">
						    ' . $inline_content . '
						</div>
					    </div>
				    </div>';

                //////////////////////////////////////////////////////////////////////

                if (in_array($this->shortcode_atts['trigger_condition'], array('page_load', 'class_id', 'scroll_delay', 'exit_intent', 'on_blur'))) {
                    $output = $content;
                } else {
                    $output = '<div ' . ('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : '') . ' class="clearfix ' . ('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : '') . ' ' . esc_attr(' et_pb_module') . '">' . $content . '</div>';
                }

                return $output;
            }
        }

        new et_pb_popup_builder;
    }
}

?>