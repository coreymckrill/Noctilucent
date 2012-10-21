<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
    <link rel="dns-prefetch" href="<?php echo noctilucent_get_protocol(); ?>//ajax.googleapis.com" />
	
    <?php // Use the .htaccess and remove these lines to avoid edge case issues.
          // More info: h5bp.com/i/378 ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
    <?php // Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons ?>
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
    
    <meta name="viewport" content="width=device-width" />
    <!--[if IE]><meta http-equiv="imagetoolbar" content="false" /><![endif]-->
    
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php do_action( 'noctilucent_before_header' );
		// noctilucent_chromeframe
	?>

	<header id="header-banner" role="banner">
		<?php do_action( 'noctilucent_prepend_to_header' ); ?>
		<hgroup>
			<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a></h1>
			<p class="blog-description"><?php bloginfo( 'description' ); ?></p>
		</hgroup>
		<?php do_action( 'noctilucent_append_to_header' ); ?>
	</header>
	
	<?php do_action( 'noctilucent_after_header' );
	   // noctilucent_insert_primary_nav
	?>
	
    <div id="main" role="main">