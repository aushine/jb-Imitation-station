<?php get_header() ?>
<div class="container content">
        <div class="main block">
    <?php if(is_home()):?>
            <div class="banner_slide">
                <ul class="slide_con clearfix">
                    <li class="slide" style="display:block"><a href="<?php echo jbxi_options("slide_url1")?jbxi_options("slide_url1"):"#"?>"><img class="img-responsive" src="<?php echo jbxi_options("slide_img1")?jbxi_options("slide_img1"):bloginfo("template_url")."/static/image/thumb1.png" ?>" alt=""></a></li>
                    <li class="slide"><a href="<?php echo jbxi_options("slide_url1")?jbxi_options("slide_url2"):"#"?>"><img class="img-responsive" src="<?php echo jbxi_options("slide_img2")?jbxi_options("slide_img2"):bloginfo("template_url")."/static/image/thumb2.png" ?>" alt=""></a></li>
                    <li class="slide"><a href="<?php echo jbxi_options("slide_url1")?jbxi_options("slide_url3"):"#"?>"><img class="img-responsive" src="<?php echo jbxi_options("slide_img3")?jbxi_options("slide_img3"):bloginfo("template_url")."/static/image/thumb3.png" ?>" alt=""></a></li>
                    <li class="slide"><a href="<?php echo jbxi_options("slide_url1")?jbxi_options("slide_url4"):"#"?>"><img class="img-responsive" src="<?php echo jbxi_options("slide_img4")?jbxi_options("slide_img4"):bloginfo("template_url")."/static/image/thumb7.jpg" ?>" alt=""></a></li>
                </ul>
                <ul class="points clearfix"></ul>
                <div class="left_btn" id="left_btn"><i class="fa fa-angle-left fa-4x" aria-hidden="true"></i></div>
                <div class="right_btn" id="right_btn"><i class="fa fa-angle-right fa-4x" aria-hidden="true"></i></div>
            </div>
            <ul class="reco">
                <li><i class="mask"></i><a href="<?php echo jbxi_options("stick1")?>"><img class="img-responsive" src="<?php echo jbxi_options("stick_img1")?jbxi_options("stick_img1"):bloginfo('template_url')."/static/image/thumb8.jpg"?>" alt=""><span><?php echo jbxi_options("stick_text1")?jbxi_options("stick_text1"):"" ?></span></a></li>
                <li><i class="mask"></i><a href="<?php echo jbxi_options("stick2")?>"><img class="img-responsive" src="<?php echo jbxi_options("stick_img2")?jbxi_options("stick_img2"):bloginfo('template_url')."/static/image/thumb9.jpg"?>" alt=""><span><?php echo jbxi_options("stick_text2")?jbxi_options("stick_text2"):"" ?></span></a></li>
            </ul>
            <div class="clv"></div>
            <?php if(is_active_sidebar("category_show")):?>
                <?php dynamic_sidebar("category_show")?>
            <?php endif;?>
            <div class="clv"></div>


        <?php endif;?><!--/ is_home()-->
        <ul class="new_posts">
            <div class="tb_head"><span>最新文章</span></div>
            <?php if(have_posts()):?>
            <?php while(have_posts()):?>
            <?php the_post()?>

                    <?php get_template_part("content")?>

                <?php endwhile;?>
            <?php endif;?>
        </ul>
        </div> <!--main_block end-->
        <div class="sider">
            <?php if(is_active_sidebar("side_bar")):?>
                <?php dynamic_sidebar("side_bar")?>
            <?php endif;?>
        </div>
        <div class="sider">
            <div class="agent_reco">
                <span class="tb_head">站长推荐</span>
                <div class="top_reco"><i class="mask"></i><a href=""><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb3.png"?>" alt=""><span>置顶推荐文章长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></div>
                <ul class="normal_reco">
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章1长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章2长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章3长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章4长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章5长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章6长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                    <li class="clearfix"><a href="#"><i><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/thumb2.png"?>" alt=""></i><span>文章7长标题长标题长标题长标题长标题长标题长标题长标题长标题长标题</span></a></li>
                </ul>
            </div><!--agent_reco end-->
            <div class="sider_ad">
                <div>
                    <a href="#"><img class="img-responsive" src="https://www.sixjiang.cn/wp-content/uploads/2019/07/shiro.gif"?>" alt=""></a>
                </div>
            </div><!--sider_ad end-->
            <div class="random_posts">
                <span class="tb_head">猜你喜欢</span>
                <ul>
                    <li><a href="#">随机文章1长长长长长长长长长长长长长长长长长长长长长长长</a></li>
                    <li><a href="#">随机文章2</a></li>
                    <li><a href="#">随机文章3</a></li>
                    <li><a href="#">随机文章4</a></li>
                    <li><a href="#">随机文章5</a></li>
                    <li><a href="#">随机文章6</a></li>
                    <li><a href="#">随机文章7</a></li>
                    <li><a href="#">随机文章8</a></li>
                    <li><a href="#">随机文章9</a></li>
                </ul>
            </div><!--random_posts end-->
            <div class="sider_ad">
                <div>
                    <a href="#"><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/QQ_qr.png"?>" alt=""></a>
                </div>
            </div>

            <div class="site_infomation">
                <span class="tb_head">站点信息</span>
                <div>
                    <li><b>建站时间: </b><span> 2019-10-10</span><br /></li>
                    <li><b>网站系统: </b><span> wordpress</span><br /></li>
                    <li><b>文章统计: </b><span><a href="#"> 99</a>篇文章</span><br /></li>
                    <li><b>标签统计: </b><span><a href="#"> 标签云</a></span><br /></li>
                </div>
            </div><!--site_infomation end-->
            <div class="links">
                <span class="tb_head">友链(每次刷新随机排序)</span>
                <div>
                    <a href="#">链接1长长长长长长长长长长长长长长</a>
                    <a href="#">链接2</a>
                    <a href="#">链接3</a>
                    <a href="#">链接4</a>
                    <a href="#">链接5</a>
                    <a href="#">链接6</a>
                </div>
            </div>
        </div> <!--sider end-->
    </div> <!--container end-->
<?php get_footer()?>