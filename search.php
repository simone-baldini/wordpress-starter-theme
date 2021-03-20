<?php get_template_part( 'templates/page', 'header' ); ?>

<?php if ( ! have_posts() ) { ?>
	<div class="alert alert-warning">
		<?php _e( 'Sorry, no results were found.', 'sage' ); ?>
	</div>
	<?php get_search_form(); ?>
<?php } ?>

<?php
while ( have_posts() ) {
	the_post();
	get_template_part( 'templates/content', 'search' );
}
?>

<?php the_posts_navigation(); ?>
