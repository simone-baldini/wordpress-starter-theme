<article <?php post_class( 'mb-5' ); ?>>
	<header>
		<?php if ( has_post_thumbnail() ) { ?>
			<img src="<?php the_post_thumbnail_url( null, 'large' ); ?>" class="img-fluid" alt="" title=""/>
		<?php } ?>
	</header>
	<section class="p-3 mt-2">
		<?php get_template_part( 'templates/entry-meta' ); ?>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'Read more' ); ?></a>
		</div>
	</section>
	<?php get_template_part( 'templates/entry-tags' ); ?>
</article>
