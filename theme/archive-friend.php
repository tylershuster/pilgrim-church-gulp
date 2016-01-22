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


get_header(); ?>

<?php if( is_user_logged_in() ): ?>

	<p>You can find more about each member by clicking their names.</p>

	<input type="text" name="filter_members" value="" placeholder="Type here to search">

	<?php if( $wp_query->have_posts() ): ?>

		<ul id='directory'>

		<?php foreach( $wp_query->posts as $post ): setup_postdata( $post ); ?>

		<li><a href='<?php echo get_the_permalink(); ?>'>

			<?php if( has_post_thumbnail() ): ?>

				<?php the_post_thumbnail( 'directory_thumbnail' ); ?>

			<?php else: ?>

				<img src='<?php echo get_stylesheet_directory_uri(); ?>/assets/img/heart.png' />

			<?php endif; ?>

			<?php the_title(); ?>

		</a></li>

		<?php endforeach; ?>

		</ul>

	<?php endif; ?>



	<script type="application/javascript">

	jQuery(document).ready(function($) {

		$('input[name=filter_members]').fastLiveFilter('#directory');

	});

	</script>

	<script type="text/javascript">
	/**
* fastLiveFilter jQuery plugin 1.0.3
*
* Copyright (c) 2011, Anthony Bush
* License: <http://www.opensource.org/licenses/bsd-license.php>
* Project Website: http://anthonybush.com/projects/jquery_fast_live_filter/
**/

jQuery.fn.fastLiveFilter = function(list, options) {
// Options: input, list, timeout, callback
options = options || {};
list = jQuery(list);
var input = this;
var lastFilter = '';
var timeout = options.timeout || 0;
var callback = options.callback || function() {};

var keyTimeout;

// NOTE: because we cache lis & len here, users would need to re-init the plugin
// if they modify the list in the DOM later.  This doesn't give us that much speed
// boost, so perhaps it's not worth putting it here.
var lis = list.children();
var len = lis.length;
var oldDisplay = len > 0 ? lis[0].style.display : "block";
callback(len); // do a one-time callback on initialization to make sure everything's in sync

input.change(function() {
	// var startTime = new Date().getTime();
	var filter = input.val().toLowerCase();
	var li, innerText;
	var numShown = 0;
	for (var i = 0; i < len; i++) {
		li = lis[i];
		innerText = !options.selector ?
			(li.textContent || li.innerText || "") :
			$(li).find(options.selector).text();

		if (innerText.toLowerCase().indexOf(filter) >= 0) {
			if (li.style.display == "none") {
				li.style.display = oldDisplay;
			}
			numShown++;
		} else {
			if (li.style.display != "none") {
				li.style.display = "none";
			}
		}
	}
	callback(numShown);
	// var endTime = new Date().getTime();
	// console.log('Search for ' + filter + ' took: ' + (endTime - startTime) + ' (' + numShown + ' results)');
	return false;
}).keydown(function() {
	clearTimeout(keyTimeout);
	keyTimeout = setTimeout(function() {
		if( input.val() === lastFilter ) return;
		lastFilter = input.val();
		input.change();
	}, timeout);
});
return this; // maintain jQuery chainability
}

	</script>

<?php else: ?>

	Sorry, you must be logged into access this page. Please click <a href="<?php echo get_bloginfo('url'); ?>/login">here</a> to log in or register.

<?php endif; ?>

<?php get_footer(); ?>
