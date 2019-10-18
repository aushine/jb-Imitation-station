<?php
$thumbs = array("thumb1.png","thumb2.png",
                "thumb3.png", "thumb4.png",
                "thumb5.png","thumb6.png",
                "thumb7.jpg","thumb8.jpg",
                "thumb9.jpg", "thumb10.jpg"
);

function getPostViews($postID){
    $count = get_post_meta($postID,'views', true);
    if($count==''){
        delete_post_meta($postID,'views');
        add_post_meta($postID,'views', '0');
        return "0";
    }
    return $count.'';
}
// setPostViews(get_the_ID()); echo number_format(getPostViews(get_the_ID()));
function setPostViews($postID) {
    $count = get_post_meta($postID,'views', true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID,'views');
        add_post_meta($postID,'views', '0');
    }else{
        $count++;
        update_post_meta($postID,'views', $count);
    }
}

function get_all_category(){
    //调用此方法可以获取到网站系统中所有的分类id和名字
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    return $categorys;
}

function timeago($ptime){
    $ptime = strtotime($ptime);
    $etime = time()-$ptime;
    if($etime<1) return __('刚刚','moedog');
    $interval = array(
        12*30*24*60*60 => __(' 年前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        30*24*60*60 => __(' 个月前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        7*24*60*60 => __(' 周前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        24*60*60 => __(' 天前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        60*60 => __(' 小时前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        60 => __(' 分钟前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
        1 => __(' 秒前','moedog').' ('.date(__('m月d日','moedog'),$ptime).')',
    );
    foreach($interval as $secs=>$str){
        $d=$etime/$secs;
        if($d>=1){
            $r=round($d);
            return$r.$str;
        }
    };
}
function lerm_replace_avatar( $avatar ) {
    $regexp      = '/https?.*?\/avatar\//i';//
    $replacement = 'https://cn.gravatar.com/avatar/';
    $avatar      = preg_replace( $regexp, $replacement, $avatar );
    return $avatar;
}
function add_admin_css(){
    wp_enqueue_style("commen",get_template_directory_uri()."/inc/inc/css/optionsframework.css");
    wp_enqueue_style("commen",get_template_directory_uri()."/css/commen.css");
}
add_action("after_setup_theme","lerm_replace_avatar");
// add_action("admin_menu","register_jbxi_option");
add_action("admin_init","add_admin_css");
