<?php
get_header();

if( have_posts() ): while( have_posts() ): the_post();

	the_content();

endwhile; endif;


echo "<div class='home__widgets'>";

echo do_shortcode('[latest_sermons]');

echo do_shortcode('[upcoming_events]');

echo "</div>";

//
// $json = file_get_contents("http://calapi.inadiutorium.cz/api/v0/en/calendars/default/today");
//
// $json = json_decode( $json );

?>

<style media="screen">
	.home__liturgical-info {
		border-color: <?php //echo $json->celebrations[0]->colour; ?>
	}
</style>

<?php

// echo "<div class='home__liturgical-info'>";
//
// 	echo "We are in the " . ordinal( $json->season_week ) . " week of " . $json->season . "!";
//
// echo "</div>";

get_footer();
 ?>
