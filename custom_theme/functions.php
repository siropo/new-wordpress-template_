<?

//=============Register sidebars ============//
 // The first sidebar
 if(function_exists('register_sidebar'))
	  register_sidebar(array(
		'name' => 'Sidebar', 
		'description' => __( 'Sidebar 1' ),
		'before_widget' => '<div class="sidebar-content">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><h3>',
		'after_title'   => '</h3></div>' ,
 ));
 

// Register menus
register_nav_menus( array(
	'first-navi-menu' => 'First navigation'
));
//------------------------------------

//enable theme support thumbnails images
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'cat_last', 190, 190, true );

//------------------------------------

//**===================================================**//

//Limit Text 
function the_text_shorten($len,$rep='...', $func_text) {
	if ($func_text == "excerpt") {
		$title = get_the_excerpt('','',false);
	} else if ($func_text == "title") {
		$title = the_title('','',false);
	}
	$shortened_title = textLimit($title, $len, $rep);
	print $shortened_title;
}

//shorten without cutting full words (Thank You Serzh 'http://us2.php.net/manual/en/function.substr.php#83585')
function textLimit($string, $length, $replacer) {
	if(strlen($string) > $length)
	return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
	return $string;
}


// Remove id and class from menus
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}
//------------------------------------

//**======= Print breadcrumb ==============**//
function the_breadcrumb() {
	if (!is_home()) {
		echo '<div class="breadcrumb"><a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a>/ ";
		if (is_category() || is_single()) {
			the_category(', ');
			if (is_single()) {
				echo "/ ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
		echo "</div>";
	}
}

?>