<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>
<!DOCTYPE HTML>

<html lang="en">

<head>

<!-- ================================================================================= META: META == -->

	<meta charset="UTF-8" />
	<meta name="generator" content="Habari" />
	
<!-- ================================================================================= META: SEO == -->
	
	<title>
	   <?php 
	       if ($request->display_entry && isset($post)) { 
	           echo "{$post->title} - "; 
	       } 
	   ?>
	   <?php Options::out( 'title' ) ?>
    </title>

<!-- ================================================================================= FONTS == -->

    <link 
        href="http://fonts.googleapis.com/css?family=Sansita+One" 
        rel="stylesheet"
        media="all" />
        
    <link 
        href="http://fonts.googleapis.com/css?family=Open+Sans"
        rel="stylesheet" 
        media="all" />
    
<!-- ================================================================================= STYLES == -->

	<link 
        href="<?php Site::out_url( 'theme' ); ?>/_assets/css/global.css"
	   rel="stylesheet" 
	   media="all" />
	
<!-- ================================================================================= OTHER == -->

	<link rel="Shortcut Icon" href="<?php Site::out_url( 'theme' ); ?>/favicon.ico" />
	
<!-- ================================================================================= CMS: HEADER == -->

	<?php $theme->header(); ?>
	
</head>

<!-- ================================================================================= BODYCLASS == -->

<body class="<?php $theme->body_class(); ?>">

<!--










          This section has been intentionally left blank.










-->

	<div id="wrapper" class="container">
	
		<header id="masthead">
		
			<hgroup id="branding">
				<h1><a href="<?php Site::out_url( 'habari'); ?>" title="<?php Options::out( 'title' ); ?>"> <?php Options::out( 'title' ); ?></a></h1>
				<h2 class=""><?php Options::out( 'tagline' ); ?></h2>
			</hgroup>
			
        	<nav id="nav">
            	<ul>
            		<li><a href="<?php Site::out_url( 'habari' ); ?>"><?php _e('Home'); ?></a></li>
            		<?php foreach($pages as $page): ?>
                    <li>
                        <a href="<?php echo $page->permalink; ?>" title="<?php echo $page->title; ?>"><?php echo $page->title; ?></a>
                    </li>
            		<?php endforeach; ?>
            	</ul>
        	</nav>

		</header><!-- End #masthead -->
