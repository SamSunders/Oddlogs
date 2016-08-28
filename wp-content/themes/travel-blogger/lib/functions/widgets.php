<?php

/**
 * Content output for TravelBlogger Theme custom widget
 *
 * @since TravelBlogger Theme 1.0
 */
function exp_widget_content( $category , $number ) {
	global $cat;
	if ($category == 'exp_widget_feature') {
		$wp_query = query_posts(array('showposts'=>$number,'meta_key'=>$category, 'post__not_in' => get_option( 'sticky_posts' ) ));
	} else {
		$category = strtolower($category);
		$id = get_cat_ID( $category);
		$wp_query = query_posts(array('showposts'=>$number,'cat'=>$id, 'post__not_in' => get_option( 'sticky_posts' ) ));
	}
	$count_posts = count($wp_query);
	$i=1;	
	if (have_posts()) {
		while (have_posts()) : the_post(); ?>
			<div class="listing">
					<?php
					$thumb = exp_get_meta_image('widget-thumbnail');
					if(!empty($thumb)) {echo '<a href="'.get_permalink().'"><img src="'.$thumb.'" class="attachment-widget-thumbnail" /></a>'; }
					?>
					<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?> </a></h2>
					<p><?php exp_custom_excerpt(get_the_excerpt(),'80'); ?><a href="<?php the_permalink();?>">read more</a></p>
			</div>
			<?php				
			if ($i == $count_posts && $category != 'exp_widget_feature') { echo '<p class="read_more"><a href="'.get_category_link($id).'">browse '.$category.'</a></p>'; }
			$i++;
		endwhile;
	} else { ?>
		<div class="listing">
			<?php _e('No posts found.', 'travelblogger') ?>
		</div>
	<?php }
	wp_reset_query();
}

/**
 * Register widgetized areas, including sidebars.
 *
 * @since Back MyBook 1.0
 * @uses register_sidebar 
 */
function travelblogger_widgets_init() {
	// Area 1, located at the top right of the layout.
	register_sidebar( array(
		'name' => __( 'Primary Sidebar', 'travelblogger' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'travelblogger' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located at the top right of the layout. Empty by default.
	register_sidebar( array(
		'name' => __( 'Seconday Sidebar', 'travelblogger' ),
		'id' => 'right-primary-widget-area',
		'description' => __( 'This sidebar only displays in the three column layout set up.', 'travelblogger' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running travelblogger_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'travelblogger_widgets_init' );


// Set sepcial widget to display customized data in sidebars.
class List_Content extends WP_Widget {
	function List_Content() {
		$widget_options = array('description' => 'This widget displays latest content with thumbnails from a selected category.', 'classname' => 'widget-listing');
		parent::WP_Widget(false, 'TB Theme Latest Content', $widget_options);
	}
function form($instance) {
		// outputs the options form on admin
				$instance = wp_parse_args((array) $instance, array('title' => __('', 'widget-listing'), 'cat_name' => 'Uncategorized', 'n_posts' => 5));
				$title = esc_attr($instance['title']);
				$cat_name = esc_attr($instance['cat_name']);
				$n_posts = intval($instance['n_posts']);
				$categories = &get_categories('type=post&orderby=name&hide_empty=0');
		?>		 
		 
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'widget-listing'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
		<br/>
		 <label for="<?php echo $this->get_field_id('cat_name'); ?>"><?php _e('Category Name', 'widget-listing'); ?>
		 </label>
			<select name="<?php echo $this->get_field_name('cat_name'); ?>" id="<?php echo $this->get_field_id('cat_name'); ?>" class="widefat">
				<?php											
					if ($categories) {
						foreach ($categories as $category) {
							if ($category->cat_name == $cat_name )  { $selected = ' selected'; } else {$selected = '';}
							echo '<option value="' . $category->cat_name . '"' . $selected . '>' . $category->cat_name . '</option>' . "\n";
						}
					}
				?>
			</select>				 
		 <br/>
		<label for="<?php echo $this->get_field_id('n_posts'); ?>"><?php _e('Numer of Posts to Display', 'widget-listing'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('n_posts'); ?>" name="<?php echo $this->get_field_name('n_posts'); ?>" type="text" value="<?php echo $n_posts; ?>" /></label>
		<br/>

	<?php }
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat_name'] = strip_tags($new_instance['cat_name']);
		$instance['n_posts'] = intval($new_instance['n_posts']);
		return $instance;
	}
function widget($args, $instance) {
		// outputs the content of the widget
		extract($args, EXTR_SKIP);
		$title = esc_attr($instance['title']);
		$cat_name = esc_attr($instance['cat_name']);
		$n_posts = $instance['n_posts'];
		echo $before_widget.$before_title.$title.$after_title;
		exp_widget_content($cat_name,$n_posts);
		echo $after_widget;
	}
}
register_widget('List_Content');
//EOF Special widget

// Set sepcial widget to display featured posts in sidebars.
class Feature_Content extends WP_Widget {
	function Feature_Content() {
		$widget_options = array('description' => 'This widget displays featured content with thumbnails.', 'classname' => 'widget-listing');
		parent::WP_Widget(false, 'TB Theme Featured Content', $widget_options);
	}
function form($instance) {
		// outputs the options form on admin
				$instance = wp_parse_args((array) $instance, array('title' => __('', 'widget-listing'), 'cat_name' => 'exp_widget_feature', 'n_posts' => 5));
				$title = esc_attr($instance['title']);
				$cat_name = esc_attr($instance['cat_name']);
				$n_posts = intval($instance['n_posts']);
		?>		 
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'widget-listing'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('n_posts'); ?>"><?php _e('Numer of Posts to Display', 'widget-listing'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('n_posts'); ?>" name="<?php echo $this->get_field_name('n_posts'); ?>" type="text" value="<?php echo $n_posts; ?>" />
		</p>
		<input type="hidden" name="<?php echo $this->get_field_name('cat_name'); ?>" value="exp_widget_feature" />

	<?php }
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cat_name'] = strip_tags($new_instance['cat_name']);
		$instance['n_posts'] = intval($new_instance['n_posts']);
		return $instance;
	}
function widget($args, $instance) {
		// outputs the content of the widget
		extract($args, EXTR_SKIP);
		$title = esc_attr($instance['title']);
		$cat_name = esc_attr($instance['cat_name']);
		$n_posts = $instance['n_posts'];
		echo $before_widget.$before_title.$title.$after_title;
		exp_widget_content($cat_name,$n_posts);
		echo $after_widget;
	}
}
register_widget('Feature_Content');
//EOF Feature posts widget


//Custom widget to Google Map locations.
class Exp_Google_Maps extends WP_Widget {
	function Exp_Google_Maps() {
		$widget_options = array('description' => 'Displays multiple map points from Posts where you have inserted locations.', 'classname' => 'widget-google-maps');
		parent::WP_Widget(false, 'TB Global Google Map', $widget_options);
	}
	function form($instance) {
		// outputs the options form on admin
		$instance = wp_parse_args((array) $instance, array('title' => __('My Map Locations', 'widget-links'),'height' => __('300', 'widget-links'),'loc_limit' => __('20', 'widget-links')) );
		$title = esc_attr($instance['title']);
		$height = esc_attr($instance['height']);
		$loc_limit = intval($instance['loc_limit']);
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Set title for map widget:', 'widget-listing'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('loc_limit'); ?>"><?php _e('Set the number of latest locations to display below:', 'widget-listing'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('loc_limit'); ?>" name="<?php echo $this->get_field_name('loc_limit'); ?>" type="text" value="<?php echo $loc_limit; ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height of Map (optional):', 'widget-listing'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
		
	<?php }
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['loc_limit'] = intval($new_instance['loc_limit']);
		return $instance;
	}
	function widget($args, $instance) {
		// outputs the content of the widget
		extract($args, EXTR_SKIP);
		$title = esc_attr($instance['title']);
		$height = esc_attr($instance['height']);
		$loc_limit = intval($instance['loc_limit']);
		echo $before_widget;
		echo exp_google_maps_widget($title,'',$height,'map_widget',$loc_limit);
		echo $after_widget;
	}
}
register_widget('Exp_Google_Maps');
//EOF  Google Map Custom widget


// Displays google maps in widget for multiple locations
function exp_google_maps_widget($title='',$width='',$height='300',$instance='map_canvas', $limit='10') {
	
	$nonce = wp_create_nonce('exp_gmaps_ajax');
    $ajax_url = admin_url('admin-ajax.php');
	
	$gmap = '<script type="text/javascript">jQuery(document).ready(
		jQuery.ajax({
		     type : "get",
		     dataType : "xml",
		     url : "'.$ajax_url.'",
		     data : {action: "exp_get_map_locations", limit : "'.$limit.'", nonce: "'.$nonce.'"},
		     success: function(response) {
		        load_gmap(response, "'.$instance.'");
		     },
			 error: function(response) {
		 		jQuery("#'.$instance.'").attr("style","padding:20px;");
		 		jQuery("#'.$instance.'").html("Sorry, no locations found.");
		     }
		})
	) </script>';
	$gmap .= '<h3>'.$title.'</h3>';
	$gmap .= '<div class="map-canvas">';
		if($width) $width = 'width:'.$width.'px; ';
		$gmap .= '<div id="'.$instance.'" style="'.$width.'height:'.$height.'px;" class="rounded"></div>';
	$gmap .= '</div>';
	
	return $gmap;
}

// Displays google maps in posts
function exp_google_maps_post($width='',$height='325',$instance='map_canvas') {
	global $post;

	$location = (array) get_post_meta($post->ID,'exp_post_geo_address',true);
	
	if(!empty($location['lat']) && is_single()) {
		$gmap = '<script type="text/javascript">jQuery(document).ready( function() { exp_render_gmap("'.$location['address'].'","'.$location['lat'].'","'.$location['lng'].'","'.$instance.'"); }); </script>';
		$gmap.= '<div class="map-canvas">';
			if($width) $width = 'width:'.$width.'px; ';
			$gmap .= '<div id="'.$instance.'" style="'.$width.'height:'.$height.'px;"></div>';
		$gmap .= '</div>';
		
		return $gmap;
	}
}

// Google maps shortcode
function geo_address_post_func( $atts,$content=null ) {
	extract( shortcode_atts( array(
		'height' => '325',
		'width' => ''
	), $atts ) );

	return exp_google_maps_post($width,$height,'map_shortcode');
}
add_shortcode( 'tb_google_map', 'geo_address_post_func' );


function exp_get_map_locations() {
	global $wpdb;

	// Verify  
	if ( !isset($_GET['nonce']) || !wp_verify_nonce( $_GET['nonce'], 'exp_gmaps_ajax' ) ) {  
		return 'Nothing to Display';
	}
	
	$limit = $_GET['limit'];

	function parseToXML($htmlStr)  {
		$xmlStr=str_replace('<','&lt;',$htmlStr); 
		$xmlStr=str_replace('>','&gt;',$xmlStr); 
		$xmlStr=str_replace('"','&quot;',$xmlStr); 
		$xmlStr=str_replace("'",'&#39;',$xmlStr); 
		$xmlStr=str_replace("&",'&amp;',$xmlStr); 
		return $xmlStr; 
	}

	$query = sprintf("
	    SELECT wposts.*,wpostmeta.*
	    FROM %s wposts, %s wpostmeta
	    WHERE wposts.ID = wpostmeta.post_id 
	    AND wpostmeta.meta_key = 'exp_post_geo_address'
	    AND wposts.post_status = 'publish' 
	    AND wposts.post_type = 'post'
	    ORDER BY wposts.post_date DESC
	    LIMIT %s
	 ",
	mysql_real_escape_string($wpdb->posts),
	mysql_real_escape_string($wpdb->postmeta),
	mysql_real_escape_string($limit)
	);
	$locations = $wpdb->get_results($query, OBJECT);

	if (!$locations) {
	  die('Invalid query: ' . mysql_error());
	}

	header("Content-type: text/xml");

	// Start XML file, echo parent node
	echo '<markers>';

	// Iterate through the rows, printing XML nodes for each
	foreach ($locations as $location){
		$geo_data = maybe_unserialize($location->meta_value);
		if(!is_array($geo_data))
			continue;
	
		echo '<marker ';
		echo 'lat="' . parseToXML($geo_data['lat']) . '" ';
		echo 'lng="' . parseToXML($geo_data['lng']) . '" ';
		echo 'address="' . parseToXML($geo_data['address']) . '" ';
		echo 'permalink="' . parseToXML(get_permalink($location->ID)) . '" ';
		echo '/>';
	}

	// End XML file
	echo '</markers>';
	
	exit();
}
add_action( 'wp_ajax_exp_get_map_locations', 'exp_get_map_locations' );
add_action( 'wp_ajax_nopriv_exp_get_map_locations', 'exp_get_map_locations' );

?>