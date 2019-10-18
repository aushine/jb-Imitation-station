<?php get_header()?>
<div class="container content">
    <div class="page_box">
        <article>
            <?php setPostViews(get_the_ID());
                // echo number_format(getPostViews(get_the_ID()));
            ?>
            <?php if(have_posts()):?>
                <?php while(have_posts()): the_post()?>
                    <?php get_template_part("content") ?>
                <?php endwhile;?>
            <? endif;?>

        </article>
    </div>
</div>
<?php get_footer()?>
