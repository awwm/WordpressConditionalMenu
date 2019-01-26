<?php
/*
Plugin Name: AWWM Conditional Menu
Plugin URI:  https://github.com/awwm
Description: Extend menu functionality at Ascend - Premium wordpress theme
Version:     1.0.0
Author:      Abdul Wahab
Author URI:  https://www.freelancer.com/u/wahab1983pk
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_action('kadence_after_above_header', 'header_add_conditional_menu', 40);

function header_add_conditional_menu() {

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";     
$uri_path = parse_url($actual_link, PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

 if (is_category( )) {

$catVar = $uri_segments[2];
$catVarChild = $uri_segments[3];

$category = get_term_by('slug', $catVar, 'category' );
$categoryChild = get_term_by('slug', $catVarChild, 'category' );

$args = array(
  'taxonomy'     => 'category',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 1,
  'title_li'     => '',
  'show_option_none' => '',
  'parent'     => $category->term_id
);
$argsChild = array(
  'taxonomy'     => 'category',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 1,
  'title_li'     => '',
  'show_option_none' => '',
  'parent'     => $categoryChild->term_id
);

if (!empty($catVar)) {
?>
	<div class="outside-second">	
		<div class="second-navclass" data-sticky="none">
			<div class="second-nav-container container">
		        <nav class="nav-second clearfix">
		            <ul id="menu-sub_sammlung" class="sf-menu sf-menu-normal sf-js-enabled" style="touch-action: pan-y;">
				<?php wp_list_categories( $args ); ?>
			     </ul> 
			</nav>
		    </div>
		</div>
	</div>
<?php } 
  if (!empty($catVarChild)) { ?>
	<div class="container custom-nav-container">
		<ul id="menu-sub_rueckschau_ausstellungen" class="ebene-drei-class">
			<?php wp_list_categories( $argsChild ); ?>
		</ul>
	</div>
<?php
}
}
 if (is_shop( ) || is_product_category ()) {
$catProductVar = $uri_segments[1];
$catProductVarChild = $uri_segments[2];

$categoryProduct = get_term_by('slug', $catProductVar, 'product_cat' );
$categoryProductChild = get_term_by('slug', $catProductVarChild, 'product_cat' );

$argsProduct = array(
  'taxonomy'     => 'product_cat',
  'orderby'      => 'name',
  'show_count'   => 0,
  'pad_counts'   => 0,
  'hierarchical' => 0,
  'title_li'     => '',
  'show_option_none' => ''
);
$argsProductChild = array(
  'taxonomy'     => 'product_cat',
  'orderby'      => 'name',
  'title_li'     => '',
  'show_option_none' => '',
  'child_of'     => $categoryProductChild->term_id
);
if (!empty($catProductVar)) {
$all_categories = get_categories( $argsProduct );
?>
	<div class="outside-second">	
		<div class="second-navclass" data-sticky="none">
			<div class="second-nav-container container">
		        <nav class="nav-second clearfix">
		            <ul id="menu-sub_sammlung" class="sf-menu sf-menu-normal sf-js-enabled" style="touch-action: pan-y;">
				<?php
				 foreach ($all_categories as $cat) {
    				if($cat->category_parent == 0) {
        			$category_id = $cat->term_id;       
        			echo '<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';

           				}       
				}
				 ?>
			     </ul> 
			</nav>
		    </div>
		</div>
	</div>
<?php } 
  if (!empty($catProductVarChild)) { ?>
	<div class="container custom-nav-container">
		<ul id="menu-sub_rueckschau_ausstellungen" class="ebene-drei-class">
			<?php wp_list_categories( $argsProductChild ); ?>
		</ul>
	</div>
<?php
}
}
}
