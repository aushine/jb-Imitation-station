<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'theme-textdomain'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'theme-textdomain' ),
		'two' => __( 'Two', 'theme-textdomain' ),
		'three' => __( 'Three', 'theme-textdomain' ),
		'four' => __( 'Four', 'theme-textdomain' ),
		'five' => __( 'Five', 'theme-textdomain' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'theme-textdomain' ),
		'two' => __( 'Pancake', 'theme-textdomain' ),
		'three' => __( 'Omelette', 'theme-textdomain' ),
		'four' => __( 'Crepe', 'theme-textdomain' ),
		'five' => __( 'Waffle', 'theme-textdomain' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
    /*parmer
    "name" =>'', //选项的名称
    "desc" =>'', //介绍
     "id" =>'', //必填，唯一标示
     "std" =>'', //元素默认值
      "class" =>'', //该类型元素class
      "type" =>'', //表单元素类型
      "settings"=>'' //仅当调用编辑器时使用
    */
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __( '基本设置', 'theme-今夕' ),
		'type' => 'heading'
	);

    $options[] = array(
        'name' => __( '顶部设置', 'theme-今夕' ),
        'type' => 'heading'
    );
    $options[] = array(
        'name' => __( '轮播图片-1', 'theme-今夕' ),
        'desc' => "",
        'type' => 'upload',
        'id' => "slide_img1"
    );
    $options[] = array(
        'name' => __( '轮播链接-1', 'theme-今夕' ),
        'desc' => "可为空",
        'type' => 'text',
        'id' => "slide_url1"
    );
    $options[] = array(
        'name' => __( '轮播图片-2', 'theme-今夕' ),
        'desc' => "",
        'type' => 'upload',
        'id' => "slide_img2"
    );
    $options[] = array(
        'name' => __( '轮播链接-2', 'theme-今夕' ),
        'desc' => "可为空",
        'type' => 'text',
        'id' => "slide_url2"
    );
    $options[] = array(
        'name' => __( '轮播图片-3', 'theme-今夕' ),
        'desc' => "",
        'type' => 'upload',
        'id' => "slide_img3"
    );
    $options[] = array(
        'name' => __( '轮播链接-3', 'theme-今夕' ),
        'desc' => "可为空",
        'type' => 'text',
        'id' => "slide_url3"
    );
    $options[] = array(
        'name' => __( '轮播图片-4', 'theme-今夕' ),
        'desc' => "",
        'type' => 'upload',
        'id' => "slide_img4"
    );
    $options[] = array(
        'name' => __( '轮播链接-4', 'theme-今夕' ),
        'desc' => "可为空",
        'type' => 'text',
        'id' => "slide_url4"
    );

    $options[] = array(
        'name' => __( '置于顶部的链接1', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick1"
    );
    $options[] = array(
        'name' => __( '置于顶部的链接文本1', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick_text1"
    );
    $options[] = array(
        'name' => __( '置于顶部的链接图片1', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick_img1"
    );
    $options[] = array(
        'name' => __( '置于顶部的链接2', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick2"
    );
    $options[] = array(
        'name' => __( '置于顶部的链接文本2', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick_text2"
    );
    $options[] = array(
        'name' => __( '置于顶部的链接图片2', 'theme-今夕' ),
        'desc' => "",
        'type' => 'text',
        'id' => "stick_img2"
    );
	/*$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	$options[] = array(
		'name' => __( 'Default Text Editor', 'theme-textdomain' ),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'theme-textdomain' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);*/

	return $options;
}