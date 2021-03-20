<header>
	<section class="container d-flex align-items-center py-2">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

		<nav class="navbar navbar-expand-lg navbar-light">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
				if ( has_nav_menu( 'primary_navigation' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'primary_navigation',
							'menu_class'      => 'nav justify-content-between flex-column flex-lg-row w-100',
							'container_class' => 'container w-100',
							'link_before'     => '<span>',
							'link_after'      => '</span>',
						)
					);
				}
				?>
			</div>
		</nav>
	</section>
</header>

