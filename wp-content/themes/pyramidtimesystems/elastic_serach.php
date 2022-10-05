<?php
/*
Template Name: Elastic Serach
*/

get_header();


$recent_args = array(
	'post_type'=> 'post',
	'ep_integrate'   => true,
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
);      

$recent_posts = new WP_Query( $recent_args );

if(!empty($recent_posts)):
	while($recent_posts->have_posts()):
		$recent_posts->the_post();

		echo "<h1>".get_the_title()."</h1>";
	endwhile;
else:
		echo "<h1>Result not found.</h1>";
endif;	
wp_reset_postdata();


// echo "<pre>";
// print_r($recent_posts);
// echo "</pre>";


get_footer();
?>