<?php

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

require get_template_directory()."/inc/myfunctions.php";
require get_template_directory()."/inc/widgets.php";

function jbxi_theme_support(){
    //注册菜单栏
    register_nav_menus(array(
       "primary" => __("顶部菜单")
    ));
    add_theme_support("post-thumbnails");
}
function set_excerpt_length(){
    return 220;//设置摘要函数 the_excerpt()显示的文字数
}

add_filter("excerpt_length","set_excerpt_length");
add_action("after_setup_theme", "jbxi_theme_support");
add_filter('pre_option_link_manager_enabled','__return_true');
function shapeSpace_custom_admin_notice() { ?>

    <div class="notice notice-info">
        <p><?php _e('你好, 欢迎使用的的主题, 主题名为:今夕何夕', 'shapeSpace'); ?>
            欢迎访问我的博客<a target="_blank" href="https://www.sixjiang.cn">主页</a>
            本主题仅为仿站练习, 原作者为<a target="_blank" href="http://jxhx2.yangqq.com/">扬青</a>女士
        </p>
    </div>

<?php }

