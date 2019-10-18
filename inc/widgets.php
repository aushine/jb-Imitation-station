<?php

function init_widgets($id){
    register_Sidebar(array(
        "name" => __("侧边栏","theme-今夕"),
        "id" => "side_bar",
        "before_widget" => "",
        "after_widget" => ""
    ));
    register_sidebar(array(
        "name" => __("中部展示区域","theme-今夕"),
        "id" => "category_show",
        "before_widget" => "<div class='center_widget'>",
        "after_widget" => "</div>"
    ));

}
add_action("widgets_init", "init_widgets");
add_action('admin_notices', 'shapeSpace_custom_admin_notice');

function remove_default_widget(){
    // 移出默认的小工具
    // unregister_widget('WP_Widget_Custom_HTML');
    unregister_widget('WP_Widget_Media_Gallery');
    unregister_widget('WP_Widget_Media_Audio');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Media_Image');
    unregister_widget('WP_Widget_Media_Video');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Text');
}
add_action('widgets_init','remove_default_widget');

class jbxi_widget_agentReco extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_ad',
            'name'       => __('广告位','今夕'),
            'description'=> __('今夕主题特色组件 - 广告位','今夕')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){


    }
    function update($new_instance,$old_instance){
        return $new_instance;
    }
    function form($instance){
        @$aurl = esc_attr($instance['aurl']);
        @$imgurl = esc_attr($instance['imgurl']); ?>
        <p>
            <label for="<?php echo $this->get_field_id('aurl'); ?>"><?php _e('链接：','moedog'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('aurl'); ?>" name="<?php echo $this->get_field_name('aurl'); ?>" type="text" value="<?php echo $aurl; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('imgurl'); ?>"><?php _e('图片：','moedog'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('imgurl'); ?>" name="<?php echo $this->get_field_name('imgurl'); ?>" type="text" value="<?php echo $imgurl; ?>" />
            </label>
        </p>
        <?php
    }

}
class jbxi_widget_click_ranking extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_click_ranking',
            'name'       => __("点击排行-侧边",'今夕'),
            'description'=> __('今夕主题特色组件 - 点击排行','今夕')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){
        $title = $instance["title"];
        $rank0_img = $instance["rank0_img"];
        $post_views = array();
        $flag = 0;
        ?>
        <div class="click_ranking">
            <span class="tb_head"><?php echo $title;?></span>
            <?php query_posts("");?>
                <?while (have_posts()):the_post()?>
                    <?php
                    //获取到了所有文章的id然后把id和元数据浏览数组合成键值对排序
                    $post_ID = get_the_ID();
                    $post_views["$post_ID"] = getPostViews($post_ID)?>
                <?php endwhile;?>

                <?php
                arsort($post_views);
                // print_r($post_views);
                foreach($post_views as $key=>$val){
                    if($flag==8){break;}
                    if($flag==0){
                        ?>
                        <div class="rank_0">
                            <a href="<?php echo get_the_permalink($key)?>"><i class="mask"></i><img class="img-responsive" src="<?php echo $rank0_img?$rank0_img:bloginfo("template_url")."/static/image/thumb3.png"?>" alt=""><span><?php echo get_the_title($key);?></span></a>
                        </div>
            <ul>
                        <?php
                        $flag+=1;
                        continue;
                    }
                    ?>
                    <li><i></i><a href="<?php echo get_the_permalink($key)?>"><?php echo get_the_title($key);?></a></li>

                    <?php
                    $flag+=1;
                }
                ;?>
            </ul>

        </div><!--click_ranking end-->


        <?php
        wp_reset_query();

    }
    function update($new_instance,$old_instance){
        return $new_instance;
    }
    function form($instance){
        $title = $instance["title"];
        $rank0_img = $instance["rank0_img"];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title")?>">标题:
            <input class="widefat" id="<?php echo $this->get_field_id("title")?>" name="<?php echo $this->get_field_name("title")?>" value="<?php echo $title?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("rank0_img")?>">最高点击栏封面(留空取特色图片):
                <input class="widefat" id="<?php echo $this->get_field_id("rank0_img")?>" name="<?php echo $this->get_field_name("rank0_img")?>" value="<?php echo $rank0_img?>">
            </label>
        </p>
        <?php
    }

}
class jbxi_widget_name_card extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_name_card',
            'name'       => __('名片-侧边','今夕'),
            'description'=> __('今夕主题特色组件 - 名片','moedog')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){
        @$title = $instance["title"];
        @$name = $instance["name"];
        @$job = $instance["job"];
        @$live = $instance["live"];
        @$Email = $instance["email"];
        @$Email_me_link = $instance["Email_me_link"];
        @$qi_e = $instance["qi_e"];
        @$wechat = $instance["wechat"];
        ?>
        <div class="name_card">
            <h3><?php echo $title?></h3>
            <p>昵称: <?php echo $name?></p>
            <p>职业: <?php echo $job?></p>
            <p>居住地: <?php echo $live?></p>
            <p>Email: <?php echo $Email?></p>
            <ul class="social list-inline">
                <li class="home_link"><a href="<?php bloginfo("url");?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="E-mail_link"><a href="<?php echo $Email_me_link?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                <li class="QQ_link"><a href="<?php echo "http://api.brhsm.cn/qqlt.php?qq=".$qi_e;?>"><i class="fa fa-qq" aria-hidden="true"></i></a></li>
                <li class="wechat"><a href="#"><i class="fa fa-weixin" aria-hidden="true"></i></a><img src="<?php echo $wechat ?>" alt=""></li>
            </ul>
        </div><!--name_card end-->
        <?php

    }
    function update($new_instance,$old_instance){

        return $new_instance;

    }
    function form($instance){
        @$title = $instance["title"];
        @$name = $instance["name"];
        @$job = $instance["job"];
        @$live = $instance["live"];
        @$Email = $instance["email"];
        @$Email_me_link = $instance["Email_me_link"];
        @$qi_e = $instance["qi_e"];
        @$wechat = $instance["wechat"];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id("title")?>"><?php _e("标题:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("title")?>" name="<?php echo $this->get_field_name("title")?>" value="<?php echo $title?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("name")?>"><?php _e("昵称:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("name")?>" name="<?php echo $this->get_field_name("name")?>" value="<?php echo $name?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("job")?>"><?php _e("职业:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("job")?>" name="<?php echo $this->get_field_name("job")?>" value="<?php echo $job?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("live")?>"><?php _e("居住地:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("live")?>" name="<?php echo $this->get_field_name("live")?>" value="<?php echo $live?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("email")?>"><?php _e("邮件地址:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("email")?>" name="<?php echo $this->get_field_name("email")?>" value="<?php echo $Email?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("Email_me_link")?>"><?php _e("邮我链接:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("Email_me_link")?>" name="<?php echo $this->get_field_name("Email_me_link")?>" value="<?php echo $Email_me_link?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("qi_e")?>"><?php _e("QQ号码:","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("qi_e")?>" name="<?php echo $this->get_field_name("qi_e")?>" value="<?php echo $qi_e?>">
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("wechat")?>"><?php _e("威信二维码(外链):","theme-今夕")?>
                <input type="text" id="<?php echo $this->get_field_id("wechat")?>" name="<?php echo $this->get_field_name("wechat")?>" value="<?php echo $wechat?>">
            </label>
        </p>
        <?php

    }

}
class jbxi_widget_newest_post extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_newest_post',
            'name'       => __("最新文章-侧边",'今夕'),
            'description'=> __('今夕主题特色组件 - 最新文章','今夕')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){
        $title = $instance["title"];
        $posts = get_posts( 'numberposts=4&offset=0' );
        ?>
        <div class="newest_post">
            <span class="tb_head"><?php echo $title;?></span>
            <ul>
                <?php if($posts):foreach ($posts as $post): setup_postdata( $post );?>
                    <li><a href="<?php echo get_the_permalink($post->ID)?>"><?php echo strip_tags($post->post_title) ?></a></li>
                <?php endforeach;endif;?>
            </ul>
        </div><!--newest_post end-->

        <?php
        wp_reset_query();
    }
    function update($new_instance,$old_instance){
        return $new_instance;
    }
    function form($instance){
        $title = $instance["title"];
        ?>
        <label for="<?php echo $this->get_field_id("title")?>">标题:
            <input class="widefat" id="<?php echo $this->get_field_id("title")?>" name="<?php echo $this->get_field_name("title")?>" value="<?php echo $title?>">

        </label>
        <?php
    }

}

class jbxi_widget_ad extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_ad',
            'name'       => __('广告位','今夕'),
            'description'=> __('今夕主题特色组件 - 广告位','今夕')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){
        extract($args);
        $aurl = $instance['aurl']?$instance['aurl']:'';
        $imgurl = $instance['imgurl']?$instance['imgurl']:'';

        if(!empty($imgurl)){ ?>
        <div class="center_ad">
            <a href="<?php echo $aurl; ?>" target="_blank">
                <img class="carousel-inner img-responsive img-rounded" src="<?php echo $imgurl; ?>" />
                </a>
        </div>    <?php
        }

    }
    function update($new_instance,$old_instance){
        return $new_instance;
    }
    function form($instance){
        @$aurl = esc_attr($instance['aurl']);
        @$imgurl = esc_attr($instance['imgurl']); ?>
        <p>
            <label for="<?php echo $this->get_field_id('aurl'); ?>"><?php _e('链接：','moedog'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('aurl'); ?>" name="<?php echo $this->get_field_name('aurl'); ?>" type="text" value="<?php echo $aurl; ?>" />
            </label>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('imgurl'); ?>"><?php _e('图片：','moedog'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('imgurl'); ?>" name="<?php echo $this->get_field_name('imgurl'); ?>" type="text" value="<?php echo $imgurl; ?>" />
        </label>
        </p>
        <?php
    }

}

class jbxi_widget_cat_show extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'name'       => __('分类展示-中部','今夕何夕'),
            'description'=> __('今夕主题特色组件 - 分类展示 - 建议展示的分类至少七篇文章时启用','今夕何夕')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args, $instance){
        // $aurl = $instance['aurl']?$instance['aurl']:'';
        $cat1 = $instance["cat1"]?$instance['cat1']:'1失败';
        $cat2 = $instance["cat2"]?$instance['cat2']:'2失败';
        $cat3 = $instance["cat3"]?$instance['cat3']:'3失败';
        $cat4 = $instance["cat4"]?$instance['cat4']:'4失败';

        extract($args);

        ?>
        <div class="classify">
            <div class="category_btn clearfix">
                <ul class="clearfix">
                    <?php echo "<li class='underline'>".get_term($cat1,'category')->name."</li>"?>
                    <?php echo "<li>".get_term($cat2,'category')->name."</li>"?>
                    <?php echo "<li>".get_term($cat3,'category')->name."</li>"?>
                    <?php echo "<li>".get_term($cat4,'category')->name."</li>"?>
                </ul>
            </div>
            <div class="reco_content clearfix">
                <?php if($cat1):?>
                <?php query_posts( "cat=$cat1&posts_per_page=7" );?>
                <div class="posts clearfix show">
                    <ul class="reco_img clearfix">
                        <?php the_post()?><li><a href="<?php echo get_the_permalink()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                    echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>
                                " alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                        <?php the_post()?><li><a href="<?php echo get_the_permalink()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php
                                    global $thumbs;
                                    echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>
                                " alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                    </ul>
                    <ul class="reco_post">
                        <?php while(have_posts()):?>
                            <?php the_post()?>
                            <li><i></i><a href="<?php the_permalink()?>"><?php the_title()?></a><p><?php echo get_the_excerpt()?></p></li>
                        <?php endwhile;?>
                    </ul>

                   <?php wp_reset_query(); ?>
                </div>
                <?php endif;?>
                <?php if($cat2):?>
                    <?php query_posts( "cat=$cat2&posts_per_page=7" );?>
                    <div class="posts clearfix">
                        <ul class="reco_img clearfix">
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                        </ul>
                        <ul class="reco_post">
                            <?php while(have_posts()):?>
                                <?php the_post()?>
                                <li><i></i><a href="<?php the_permalink()?>"><?php the_title()?></a><p><?php echo get_the_excerpt()?></p></li>
                            <?php endwhile;?>
                        </ul>

                        <?php wp_reset_query(); ?>
                    </div>
                <?php endif;?>
                <?php if($cat3):?>
                    <?php query_posts( "cat=$cat3&posts_per_page=7" );?>
                    <div class="posts clearfix">
                        <ul class="reco_img clearfix">
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                        </ul>
                        <ul class="reco_post">
                            <?php while(have_posts()):?>
                                <?php the_post()?>
                                <li><i></i><a href="<?php the_permalink()?>"><?php the_title()?></a><p><?php echo get_the_excerpt()?></p></li>
                            <?php endwhile;?>
                        </ul>

                        <?php wp_reset_query(); ?>
                    </div>
                <?php endif;?>
                <?php if($cat4):?>
                    <?php query_posts( "cat=$cat4&posts_per_page=7" );?>
                    <div class="posts clearfix">
                        <ul class="reco_img clearfix">
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                            <?php the_post()?><li><a href="<?php the_title()?>"><img class="img-responsive" src="<?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                                        echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""><span><?php echo get_the_title()?></span></a><i class="mask"></i></li>
                        </ul>
                        <ul class="reco_post">
                            <?php while(have_posts()):?>
                                <?php the_post()?>
                                <li><i></i><a href="<?php the_permalink()?>"><?php the_title()?></a><p><?php echo get_the_excerpt()?></p></li>
                            <?php endwhile;?>
                        </ul>

                        <?php wp_reset_query(); ?>
                    </div>
                <?php endif;?>
            </div>
        </div>

        <?php
    }
    function update($new_instance,$old_instance){

        $instance = $old_instance;
        $instance["cat1"] = strip_tags($new_instance["cat1"]);
        $instance["cat2"] = strip_tags($new_instance["cat2"]);
        $instance["cat3"] = strip_tags($new_instance["cat3"]);
        $instance["cat4"] = strip_tags($new_instance["cat4"]);

        return $instance;

    }
    function form($instance){
        global $wpdb;
        // $instance = wp_parse_args()
        $all_categoryies = get_all_category();
        @$cat1 = esc_attr($instance["cat1"]);
        @$cat2 = esc_attr($instance["cat2"]);
        @$cat3 = esc_attr($instance["cat3"]);
        @$cat4 = esc_attr($instance["cat4"]);
         ?>
        <p>
            <label for='<?php echo $this->get_field_id("cat1"); ?>'><?php _e('展示分类1：','今夕'); ?>
                <select name="<?php echo $this->get_field_name("cat1"); ?>" id='<?php echo $this->get_field_id("cat1"); ?>'>
                    <?php
                    foreach ($all_categoryies as $category){
                        $res = "";

                        $res .= "<option value='".$category->term_id."'";
                        if($cat1 == $category->term_id){$res.= "selected";}
                        $res .= ">".$category->name."</option>";

                        echo $res;
                    }
                    ?>
                </select>
            </label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("cat2"); ?>'><?php _e('展示分类2：','今夕'); ?>
                <select name="<?php echo $this->get_field_name("cat2"); ?>" id='<?php echo $this->get_field_id("cat2"); ?>'>
                    <?php
                    foreach ($all_categoryies as $category){
                        $res = "";

                        $res .= "<option value='".$category->term_id."'";
                        if($cat2 == $category->term_id){$res.= "selected";}
                        $res .= ">".$category->name."</option>";

                        echo $res;
                    }
                    ?>
                </select>
            </label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("cat3"); ?>'><?php _e('展示分类3：','今夕'); ?>
                <select name="<?php echo $this->get_field_name("cat3"); ?>" id='<?php echo $this->get_field_id("cat3"); ?>'>
                    <?php
                    foreach ($all_categoryies as $category){
                        $res = "";

                        $res .= "<option value='".$category->term_id."'";
                        if($cat3 == $category->term_id){$res.= "selected";}
                        $res .= ">".$category->name."</option>";

                        echo $res;
                    }
                    ?>
                </select>
            </label>
        </p>
        <p>
            <label for='<?php echo $this->get_field_id("cat4"); ?>'><?php _e('展示分类4：','今夕'); ?>
                <select name="<?php echo $this->get_field_name("cat4"); ?>" id='<?php echo $this->get_field_id("cat4"); ?>'>
                    <?php
                    foreach ($all_categoryies as $category){
                        $res = "";

                        $res .= "<option value='".$category->term_id."'";
                        if($cat4 == $category->term_id){$res.= "selected";}
                        $res .= ">".$category->name."</option>";

                        echo $res;}
                    ?>
                </select>
            </label>
        </p>

        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" /><?php
    }
}

class jbxi_widget_special_reco extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname'  => 'jbxi_widget_special_reco',
            'name'       => __('特别推荐-中部','今夕'),
            'description'=> __('今夕主题特色组件 - 特别推荐','moedog')
        );
        parent::__construct(false,false,$widget_ops);
    }
    function widget($args,$instance){
        $post1 = $instance["post1"]?url_to_postid($instance["post1"]):"";
        $post2 = $instance["post2"]?url_to_postid($instance["post2"]):"";
        $post3 = $instance["post3"]?url_to_postid($instance["post3"]):"";
        $post4 = $instance["post4"]?url_to_postid($instance["post4"]):"";
        $post5 = $instance["post5"]?url_to_postid($instance["post5"]):"";
        $post6 = $instance["post6"]?url_to_postid($instance["post6"]):"";
        $category1 = $instance["category1"]?$instance["category1"]:"";
        $category2 = $instance["category2"]?$instance["category2"]:"";
        $category3 = $instance["category3"]?$instance["category3"]:"";
        $category4 = $instance["category4"]?$instance["category4"]:"";
        ?>
        <div class="special_reco">
            <span class="clearfix special_reco_navi tb_head">
                <h2 class="pull-left inline-block">特别推荐</h2>
                <ul class="have_child_cate pull-right">
                    <a href="<?php echo get_category_link($category1)?>"><?php echo get_cat_name($category1);?></a>
                    <a href="<?php echo get_category_link($category2)?>"><?php echo get_cat_name($category2);?></a>
                    <a href="<?php echo get_category_link($category3)?>"><?php echo get_cat_name($category3);?></a>
                    <a href="<?php echo get_category_link($category4)?>"><?php echo get_cat_name($category4);?></a>
                </ul>
            </span>
            <div class="special_reco_con clearfix">
                <ul class="special_reco_posts">
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post1)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post1), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post1);?></b><span><?php echo get_the_excerpt($post1);?></span><a href="<?php echo get_the_permalink($post1)?>">+查看全文</a></li>
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post2)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post2), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post2);?></b><span><?php echo get_the_excerpt($post2);?></span><a href="<?php echo get_the_permalink($post2)?>">+查看全文</a></li>
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post3)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post3), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post3);?></b><span><?php echo get_the_excerpt($post3);?></span><a href="<?php echo get_the_permalink($post3)?>">+查看全文</a></li>
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post4)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post4), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post4);?></b><span><?php echo get_the_excerpt($post4);?></span><a href="<?php echo get_the_permalink($post4)?>">+查看全文</a></li>
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post5)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post5), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post5);?></b><span><?php echo get_the_excerpt($post5);?></span><a href="<?php echo get_the_permalink($post5)?>">+查看全文</a></li>
                    <li><i><a href="#"><img src="<?php echo get_post_thumbnail_id($post6)?str_replace("-150x150","",wp_get_attachment_image_src(get_post_thumbnail_id($post6), 'thumbnail')[0]):bloginfo("template_url")."/static/image/thumb1.png"?>" alt=""></a></i><b><?php echo get_the_title($post6);?></b><span><?php echo get_the_excerpt($post6);?></span><a href="<?php echo get_the_permalink($post6)?>">+查看全文</a></li>
                </ul>
            </div>
        </div>


        <?php
    }
    function update($new_instance,$old_instance){
        $instance = $old_instance;
        $instance["post1"] = strip_tags($new_instance["post1"]);
        $instance["post2"] = strip_tags($new_instance["post2"]);
        $instance["post3"] = strip_tags($new_instance["post3"]);
        $instance["post4"] = strip_tags($new_instance["post4"]);
        $instance["post5"] = strip_tags($new_instance["post5"]);
        $instance["post6"] = strip_tags($new_instance["post6"]);
        $instance["category1"] =strip_tags($new_instance["category1"]);
        $instance["category2"] =strip_tags($new_instance["category2"]);
        $instance["category3"] =strip_tags($new_instance["category3"]);
        $instance["category4"] =strip_tags($new_instance["category4"]);

        return $instance;
    }
    function form($instance){
        $all_categoryies = get_all_category();
        @$post1 = $instance["post1"];
        @$post2 = $instance["post2"];
        @$post3 = $instance["post3"];
        @$post4 = $instance["post4"];
        @$post5 = $instance["post5"];
        @$post6 = $instance["post6"];
        @$category1 = $instance["category1"];
        @$category2 = $instance["category2"];
        @$category3 = $instance["category3"];
        @$category4 = $instance["category4"];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('post1'); ?>"><?php _e('推荐文章1(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post1'); ?>" name="<?php echo $this->get_field_name('post1'); ?>" type="text" value="<?php echo $post1; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post2'); ?>"><?php _e('推荐文章2(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post2'); ?>" name="<?php echo $this->get_field_name('post2'); ?>" type="text" value="<?php echo $post2; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post3'); ?>"><?php _e('推荐文章3(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post3'); ?>" name="<?php echo $this->get_field_name('post3'); ?>" type="text" value="<?php echo $post3; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post4'); ?>"><?php _e('推荐文章4(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post4'); ?>" name="<?php echo $this->get_field_name('post4'); ?>" type="text" value="<?php echo $post4; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post5'); ?>"><?php _e('推荐文章5(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post5'); ?>" name="<?php echo $this->get_field_name('post5'); ?>" type="text" value="<?php echo $post5; ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post6'); ?>"><?php _e('推荐文章6(填入文章链接)：','今夕'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('post6'); ?>" name="<?php echo $this->get_field_name('post6'); ?>" type="text" value="<?php echo $post6; ?>" />
            </label>
        </p>
        <label for='<?php echo $this->get_field_id("category1"); ?>'><?php _e('推荐分类1：','今夕'); ?>
            <select name="<?php echo $this->get_field_name("category1"); ?>" id='<?php echo $this->get_field_id("category1"); ?>'>
                <?php
                foreach ($all_categoryies as $category){
                    $res = "";

                    $res .= "<option value='".$category->term_id."'";
                    if($category1 == $category->term_id){$res.= "selected";}
                    $res .= ">".$category->name."</option>";

                    echo $res;
                }
                ?>
            </select>
        </label>
        <label for='<?php echo $this->get_field_id("category2"); ?>'><?php _e('推荐分类2：','今夕'); ?>
            <select name="<?php echo $this->get_field_name("category2"); ?>" id='<?php echo $this->get_field_id("category2"); ?>'>
                <?php
                foreach ($all_categoryies as $category){
                    $res = "";

                    $res .= "<option value='".$category->term_id."'";
                    if($category2 == $category->term_id){$res.= "selected";}
                    $res .= ">".$category->name."</option>";

                    echo $res;
                }
                ?>
            </select>
        </label>
        <br />
        <label for='<?php echo $this->get_field_id("category3"); ?>'><?php _e('推荐分类3：','今夕'); ?>
            <select name="<?php echo $this->get_field_name("category3"); ?>" id='<?php echo $this->get_field_id("category3"); ?>'>
                <?php
                foreach ($all_categoryies as $category){
                    $res = "";

                    $res .= "<option value='".$category->term_id."'";
                    if($category3 == $category->term_id){$res.= "selected";}
                    $res .= ">".$category->name."</option>";

                    echo $res;
                }
                ?>
            </select>
        </label>
        <label for='<?php echo $this->get_field_id("category4"); ?>'><?php _e('推荐分类4：','今夕'); ?>
            <select name="<?php echo $this->get_field_name("category4"); ?>" id='<?php echo $this->get_field_id("category4"); ?>'>
                <?php
                foreach ($all_categoryies as $category){
                    $res = "";

                    $res .= "<option value='".$category->term_id."'";
                    if($category4 == $category->term_id){$res.= "selected";}
                    $res .= ">".$category->name."</option>";

                    echo $res;
                }
                ?>
            </select>
        </label>
        <?php
    }

}


function jbxi_register_widget(){
    register_widget("jbxi_widget_ad");
    register_widget("jbxi_widget_cat_show");
    register_widget("jbxi_widget_special_reco");
    register_widget("jbxi_widget_name_card");
    register_widget("jbxi_widget_newest_post");
    register_widget("jbxi_widget_click_ranking");
}

add_action("widgets_init","jbxi_register_widget");