<?php

get_header(); ?>

<div class="sermon__subscribe"><a href="itpc://<?php echo str_replace( 'http://', '', get_bloginfo('url') ); ?>/feed/pilgrim-sermons">subscribe with iTunes</a> | <a href="<?php echo get_bloginfo('url'); ?>/feed/pilgrim-sermons">RSS Link</a></div>

<?php

$upload_dir = wp_upload_dir();

if( have_posts() ): while( have_posts() ): the_post();

	$downloadurl = get_post_meta( get_the_ID(), 'recording-url', true );

	$downloadfilename = str_replace( $upload_dir['baseurl'] . "/", '', $downloadurl );

	$downloadfilename = str_replace( '-', ' ', $downloadfilename );

	?>

		<article <?php post_class(); ?>>
			<h2>&ldquo;<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>&rdquo;&nbsp;<small>(<a href="<?php echo $downloadurl; ?>" download="<?php echo $downloadfilename; ?>">download</a>)</small></h2>
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