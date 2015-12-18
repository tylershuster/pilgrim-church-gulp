<?php

get_header(); ?>

<?php


if( have_posts() ): while( have_posts() ): the_post();
	?>

		<article <?php post_class(); ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<date><?php the_date('F j\<\s\u\p\>S\<\/\s\u\p\>, Y'); ?></date>
		</article>

<?php endwhile;
the_posts_pagination(array(
    'mid_size' => 3,
    'prev_text' => __( '&laquo;', 'pilgrim' ),
    'next_text' => __( '&raquo;', 'pilgrim' ),
));
endif;



get_footer();
 ?>