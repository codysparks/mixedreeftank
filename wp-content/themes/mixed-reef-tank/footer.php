<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mixed_Reef_Tank
 */

?>

	<div id="before_footer"><img src="/wp-content/themes/mixed-reef-tank/img/wave.svg" alt="Footer Design" /></div>
	
	<footer id="colophon" class="site-footer">
		<div class="content-wrapper">
			<div class="columns">
				<div class="column">
					<p><strong>Mixed Reef Tank</strong></p>

					<p>With over a decade of experience in saltwater aquariums, find expert articles in fish care and coral health.</p>
				</div>

				<div class="column">
					<p><strong>Learn</strong></p>
					
				<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'menu-2',
						'menu_class'     => 'footer-menu',
					));
				?>
				</div>

				<div class="column">
					<p><strong>Resources</strong></p>

					<?php
				
					wp_nav_menu(array(
						'theme_location' => 'menu-3',
						'menu_id'        => 'menu-3',
						'menu_class'     => 'footer-menu',
					));
				?>
				</div>
			</div>

			<hr>
			<p class="copyright"><em>Copyright <?= date('Y'); ?> · All rights reserved</em></p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5FJHM7M9');</script>
<!-- End Google Tag Manager -->
 <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FJHM7M9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
 
</body>
</html>
