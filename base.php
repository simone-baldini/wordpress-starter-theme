<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>
		<script>
			document.body.style.display = "none";
			document.getElementById("theme/css-css").addEventListener("load", function() {
				document.body.style.display = "block";
			});
		</script>
		<?php
			do_action( 'get_header' );
			get_template_part( 'templates/header' );
		?>
		<main class="main">
			<?php require \SimoneBaldini\WordPressStarterTheme\Wrapper\template_path(); ?>
		</main>
		<?php
			do_action( 'get_footer' );
			get_template_part( 'templates/footer' );
			wp_footer();
		?>
	</body>
</html>
