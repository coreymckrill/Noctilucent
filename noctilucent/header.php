<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    
	<meta charset="utf-8" />
	
    <link rel="dns-prefetch" href="<?php echo noctilucent_get_protocol(); ?>//ajax.googleapis.com" />
	
    <?php // Use the .htaccess and remove these lines to avoid edge case issues.
          // More info: h5bp.com/i/378 ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
    <?php // Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons ?>
    
    <title><?php wp_title( '&laquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
    <meta name="description" content="" />
    
    <meta name="viewport" content="width=device-width" />
    <!--[if IE]><meta http-equiv="imagetoolbar" content="false" /><![endif]-->
    
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php // Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
		  // chromium.org/developers/how-tos/chrome-frame-getting-started ?>
	<!--[if lt IE 7]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <div id="container">
        <header>
            <hgroup>
				<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a></h1>
				<p id="description"><?php bloginfo( 'description' ); ?></p>
			</hgroup>
            <?php
            wp_nav_menu( array(
                'container'         => 'nav',
                'container_id'      => 'nav-primary',
                'theme_location'    => 'primary',
				'fallback_cb'       => false
            ) );
            ?>

        </header>
        <div id="main" role="main">