<?php if(!(is_page()||is_single())):?>
<li class="clearfix">
<?php endif;?>
    <h3>

        <?php if(is_sticky()):?>
            <span style="color:red;">【置顶】</span>
        <?php endif;?>

        <?php the_title()?></h3>
    <?php if(!(is_page()||is_single())):?>
    <div class="post_thumbnail pull-left"><span></span><a href="<?php the_permalink()?>"><img class="img-responsive" src="
                        <?php if(has_post_thumbnail()):?>
                            <?php the_post_thumbnail()?>
                            <?php else:?>
                            <?php   global $thumbs;
                echo bloginfo("template_url")."/static/image/".$thumbs[array_rand($thumbs)]; ?>
                                <?php endif?>" alt=""></a></div>
    <?php endif;?>

        <?php
        if(is_page()||is_single()){
            echo get_the_content();
        }else{
            echo "<p class=\"posts_erect pull-left\">".get_the_excerpt()."</p>";
        }
        ?>

<?php if(!(is_page()||is_single())):?>
    <p class="post_info">
        <i class="pull-left">
            <a href=""><img class="img-responsive" src="<?php echo bloginfo("template_url")."/static/image/photo.png"?>" alt=""></a>
        </i>
        <span class="post_date pull-left"><?php the_time("Y-m-d")?></span>【<?php
        $categories = get_the_category();
        $output = "";
        $outflag = 0;
        if($categories){
            foreach($categories as $category){
                $outflag?$output.=",":$outflag = 1;
                $output.='<a href="'.get_category_link($category->term_id).'">'."<b style=\"color:#096;\">".$category->cat_name."</b>"."</a>";

            }}
        echo $output;
        ?>】</p>
    <a href="<?php the_permalink()?>" class="view_more">查看全文</a>
</li>
<?php endif;?>

