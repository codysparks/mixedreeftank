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

</body>
</html>
