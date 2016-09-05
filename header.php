<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php bloginfo( "name" ); ?> <?php wp_title(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="MobileOptimized" content="width" />
        <meta name="HandheldFriendly" content="True"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
		<!--[if lt IE 9]><script src="<?php bloginfo( "stylesheet_directory" ); ?>/js/html5shiv.js"></script><![endif]-->
        <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
        <div id="main-content">
            <nav id="topmenu">
                <?php wp_nav_menu(array( 'theme_location' => 'primary', 'container' => '')); ?>
            </nav>
            <nav id="mobile_topmenu"></nav>