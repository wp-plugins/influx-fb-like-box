<?php/*Plugin Name: Influx Entrepreneur FB Like BoxPlugin URI: http://influxentrepreneur.infoDescription: Display your Facebook Fan Page without the hassle. Simply add your fan page url and your doneVersion: 3.0Author: Influx EntrepreneurAuthor URI: https://www.facebook.com/influxentrepreneurs	License: GPL2*/class wp_my_plugin extends WP_Widget {	// constructor	function wp_my_plugin() {	parent::WP_Widget(false, $name = __('Influx FB Like Box', 'wp_widget_plugin') );	}	// widget form creationfunction form($instance) {// Check valuesif( $instance) {     $title = esc_attr($instance['title']);     $text = esc_attr($instance['text']);     $width = esc_attr($instance['width']);     $height = esc_attr($instance['height']);     $face = esc_attr($instance['face']);	 $hidecover = esc_attr($instance['hidecover']);	 $showpost = esc_attr($instance['showpost']);} else {     $title = '';     $text = '';     $width = '';     $height = '';     $face = '';	 $hidecover = '';	 $showpost = '';}?><p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p><p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Facebook page url:', 'wp_widget_plugin'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" placeholder="Ex: http://www.facebook.com/influxentrepreneurs" /></p><p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'wp_widget_plugin'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" placeholder="Ex min px: 300" /></p><p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('height:', 'wp_widget_plugin'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" placeholder="Ex min px: 400" /></p><p><input id="<?php echo $this->get_field_id('face'); ?>" name="<?php echo $this->get_field_name('face'); ?>" type="checkbox" value="1" <?php checked( '1', $face ); ?> /><label for="<?php echo $this->get_field_id('face'); ?>"><?php _e('Show Faces', 'wp_widget_plugin'); ?></label><input id="<?php echo $this->get_field_id('hidecover'); ?>" name="<?php echo $this->get_field_name('hidecover'); ?>" type="checkbox" value="1" <?php checked( '1', $hidecover ); ?> /><label for="<?php echo $this->get_field_id('hidecover'); ?>"><?php _e('Hide Cover', 'wp_widget_plugin'); ?></label></p><p><input id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="checkbox" value="1" <?php checked( '1', $showpost ); ?> /><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Show Post', 'wp_widget_plugin'); ?></label></p><p><label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode:', 'wp_widget_plugin'); ?></label><?phpif ($face == 1){ $faces = 'true'; } else { $faces = 'false'; }if ($hidecover == 1){ $hidecover = 'true'; } else { $hidecover = 'false'; }if ($showpost == 1){ $showposts = 'true'; } else { $showposts = 'false'; }?><textarea  rows="4" cols="50" class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" readonly><?php echo '[influxfb-likebox-like-box url="'.$text.'" width="'.$width.'" height="'.$height.'" faces="'.$faces.'" hidecover="'.$hidecover.'" posts="'.$showposts.'"]'; ?></textarea></p><?php}	// update widgetfunction update($new_instance, $old_instance) {      $instance = $old_instance;      // Fields      $instance['title'] = strip_tags($new_instance['title']);      $instance['text'] = strip_tags($new_instance['text']);      $instance['width'] = strip_tags($new_instance['width']);      $instance['height'] = strip_tags($new_instance['height']);	  $instance['face'] = strip_tags($new_instance['face']);	  $instance['hidecover'] = strip_tags($new_instance['hidecover']);	  $instance['showpost'] = strip_tags($new_instance['showpost']);     return $instance;}	// display widgetfunction widget($args, $instance) {   extract( $args );   // these are the widget options   $title = apply_filters('widget_title', $instance['title']);   $text = $instance['text'];   $width = $instance['width'];   $height = $instance['height'];   $face = $instance['face'];   $hidecover = $instance['hidecover'];   $showpost = $instance['showpost'];   echo $before_widget;   // Display the widget   echo '<div class="widget-text wp_widget_plugin_box">';   // Check if title is set   if ( $title ) {      echo $before_title . $title . $after_title;   }      // Check if text is set   if( $text ) {	   if( $face == '1' ) { $face = 'true'; } else {$face = 'false';}	   if( $hidecover == '1' ) { $hidecover = 'true'; } else {$hidecover = 'false';}	   if( $showpost == '1' ) { $showpost = 'true'; } else {$showpost = 'false';}      echo '<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>'.'<div class="fb-page" data-href="'.$text.'" data-width="'.$width.'" data-height="'.$height.'" data-hide-cover="'.$hidecover.'" data-show-facepile="'.$face.'" data-show-posts="'.$showpost.'"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>';   }   echo '</div>';   echo $after_widget;}}// register widgetadd_action('widgets_init', create_function('', 'return register_widget("wp_my_plugin");'));function influxfb_like__box_functiona($atts){   extract(shortcode_atts(array(	  'url' => 'www.facebook.com/influxentrepreneurs',	  'width' => '380',	  'height' => '400',	  'faces' => 'true',	  'hidecover' => 'false',	  'posts' => 'true',   ), $atts));   $return_string = '<div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>';   $return_string .= '<div class="fb-page" data-href="'.$url.'" data-width="'.$width.'" data-height="'.$height.'" data-hide-cover="'.$hidecover.'" data-show-facepile="'.$faces.'" data-show-posts="'.$posts.'"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>';   if ($width) {              }   wp_reset_query();   return $return_string;}function influxfb_likebox_shortcodess(){   add_shortcode('influxfb-likebox-like-box', 'influxfb_like__box_functiona');}add_action( 'init', 'influxfb_likebox_shortcodess');?>