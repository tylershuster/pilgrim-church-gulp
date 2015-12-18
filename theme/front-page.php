<?php
get_header();

if( have_posts() ): while( have_posts() ): the_post();

	the_content();


	echo "<div class='home__widgets'>";

		echo do_shortcode('[latest_sermons]');

		echo do_shortcode('[upcoming_events]');

	echo "</div>";


endwhile; endif;

get_footer();
 ?>