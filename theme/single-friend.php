<?php
get_header();

if( is_user_logged_in() ):

	if( have_posts() ): while( have_posts() ): the_post(); ?>

		<h1><?php the_title(); ?></h1>

		<?php the_post_thumbnail('medium'); ?>

		<p><?php the_content(); ?></p>

	<?php endwhile; endif;

else:

	echo "Sorry, you must be logged into access this page";

endif;

get_footer();
 ?>