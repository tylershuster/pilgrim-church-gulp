<?php
get_header();

if( have_posts() ): while( have_posts() ): the_post();

	$downloadurl = get_post_meta( get_the_ID(), 'recording-url', true );

	$downloadfilename = str_replace( $upload_dir['baseurl'] . "/", '', $downloadurl );

	$downloadfilename = str_replace( '-', ' ', $downloadfilename );
	?>

	<h1>&ldquo;<?php the_title(); ?>&rdquo;</h1>
	<h2><?php the_date('F j\<\s\u\p\>S\<\/\s\u\p\>, Y') ?></h2>

	<audio controls class="recording" id="<?php echo get_the_ID(); ?>">
	 <source src="<?php echo $downloadurl; ?>" type='audio/mp3'>
	 <p>Your user agent does not support playing audio.</p>
	</audio>

	<a href="<?php echo $downloadurl; ?>" download="<?php echo $downloadfilename; ?>">Click here to download</a>

	<?php the_content();

endwhile; endif;

get_footer();
 ?>