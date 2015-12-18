<?php

$menu_args = array(
	'theme_location' => 'footer',
	'menu' => 'footer',
	'menu_id' => '',
	'echo' => true,
	'walker' => ''
);
 ?>

</main>

<iframe class="site__map" width='100%' height='500px' frameBorder='0' src=''></iframe>

<footer class="site__body__footer">
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
			<?php dynamic_sidebar( 'footer' ); ?>
	<?php endif; ?>
	<nav class="footer__nav"><span class="footer__copyright"><img src="https://licensebuttons.net/p/mark/1.0/80x15.png"></span><?php wp_nav_menu( $menu_args ); ?></nav>
</footer>


<?php wp_footer(); ?>

</body>
<script type="text/javascript">
	// jQuery(document).ready(function($) {
	// 	  var dropcaps = document.querySelectorAll(".big-cap");
	// 	  window.Dropcap.layout(dropcaps, 2);
	// });
</script>
</html>