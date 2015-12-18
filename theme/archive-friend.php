<?php

global $wp_query;
$wp_query->set('posts_per_page', 1000);
$wp_query->set('orderby', 'name');
$wp_query->set('order','ASC');
$wp_query->query($wp_query->query_vars);

function last_name_sort( $a, $b ) {

	$a_parts = explode( " ", $a->post_title );

	$b_parts = explode( " ", $b->post_title );

	$a_lastname = array_pop( $a_parts );

	$b_lastname = array_pop( $b_parts );

	$comparison = strcasecmp( $a_lastname, $b_lastname );

	if( $comparison == 0 ) return 0;

	return $comparison < 0 ? -1 : 1;

}

uasort( $wp_query->posts, 'last_name_sort' );

get_header();

if( is_user_logged_in() ):

	echo "<p>You can find more about each member by clicking their names.</p>";

	if( $wp_query->have_posts() ):

		echo "<ul id='directory'>";

		foreach( $wp_query->posts as $post ): setup_postdata( $post );

		echo "<li><a href='" . get_the_permalink() . "'>";

			if( has_post_thumbnail() ):
				the_post_thumbnail( 'directory_thumbnail' );
			else:
				echo "<img src='" . get_stylesheet_directory_uri() . "/assets/img/heart.png' />";
			endif;

			the_title();
		echo "</a></li>";

		endforeach;

		echo "</ul>";

	endif;

else:

	echo "Sorry, you must be logged into access this page";

endif;

get_footer();
 ?>
