<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php bloginfo('name'); wp_title(); ?></title>
    <meta name="description" content="Use no more than 255 characters">
    <meta name="keywords" content="12 unique search terms separated by a comma and space">
    <meta name="copyright" content="Copyright YourCompany - 2008">
    <meta name="author" content="Author: Your Name/Company">
    <meta name="email" content="Email: suppport@yoursite.com">
    
    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="1 Day">
    <meta name="expires" content="never">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

    

</head>

<body>
<div id="wrap">


<div id="header" >
<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><strong><?php bloginfo('description'); ?></strong><br/></p>
</div>
<img id="frontphoto" src="<?php bloginfo('template_directory'); ?>/img/front.jpg" width="760" height="175" alt="" />


<div id="leftside">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Main Sidebar') ) : else : ?>

<h2 class="hide">Main menu:</h2>
<ul class="page">
<?php if (is_page()) { $highlight = "page_item"; } else {$highlight = "page_item current_page_item"; } ?>
<li class="<?php echo $highlight; ?>"><a href="<?php bloginfo('url'); ?>">Home</a></li>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>

<?php endif; ?>

</div>