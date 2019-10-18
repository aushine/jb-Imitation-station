<!DOCTYPE html>
<html <?php language_attributes()?>>
<head>
    <meta charset="<?php bloginfo("charset")?>">
    <title><? bloginfo("name") ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo bloginfo("template_url")."/css/bootstrap.min.css"?>">
    <link rel="stylesheet" href="<?php echo bloginfo("template_url")."/css/font-awesome/css/font-awesome.css"?>">
    <link rel="stylesheet" href="<?php echo bloginfo("template_url")."/style.css"?>">
    <?php wp_head()?>
</head>
<body>
<header>
    <div class="nav main-nav">
        <div class="container">
            <div class="color_trim"><div class="colorBar"><div class="ColorBar"></div><div class="ColorBar"></div></div></div>
            <nav class="top_nav_bar" id="top_nav_bar">
                <h1><a href="<?php bloginfo("url")?>"><?php bloginfo("name")?> <span>| <small style="color:#fff"><?php bloginfo("description") ?></small></span></a></h1>
                <?php $args = array("theme_location"=>"primary","menu_class"=>"navi")?>
                <?php wp_nav_menu($args)?>
                <div class="search-box">
                    <label for="search_input"><i class="fa fa-search fa-1x" aria-hidden="true"></i></label>
                    <form method="get" action="" >
                        <input type="text" name="s" id="search_input" placeholder="Search...">
                    </form>
                </div>
            </nav>

        </div><!--container end-->
        <div class="mobile_navi">
            <div class="mobile_nav">
            </div>
            <?php $args = array("theme_location"=>"primary","menu_class"=>"left_navi")?>
            <?php wp_nav_menu($args)?>
        </div>
    </div><!--main-nav end-->
    <div class="place_hold"></div>
</header>