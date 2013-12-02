<?php
/**
 * Template Name: Work Page
 */
?>

<?php get_header('works'); ?>

	<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
				the_post(); 
	?>
	
	<div id="work_preview" class="group">
		<div id="work_preview_container">
			<div class="work-slides">
				<?php 
					echo types_render_field( "slider-image", array( "alt" => get_the_title(), "proportional" => "true" ) );
				?>
			</div>
			<div class="work-slides-data">
				<div class="slides-data-info group">
					<div class="slide-title group">
						<i class="icon-briefcase icon-2x"></i>
						<h2><?php the_title(); ?></h2>
					</div>

					<div class="slide-tags group">
						<i class="icon-tags icon-2x"></i>
						<ul class="tags">
						<?php
							$item_tags = get_the_terms( get_the_ID(), 'work-tag' );

							foreach ($item_tags as $tag) {
								echo '<li>'. $tag->name. '</li>';
							}
						?>
						</ul>
					</div>

					<div class="slide-desc group">
						<i class="icon-edit icon-2x"></i>
						<p>
							<?php the_content(); ?>
						</p>
					</div>

					<div class="slide-social group">
						<i class="icon-share icon-2x"></i>
						<ul class="social-icons">
							<li><i class="icon-facebook icon-2x"></i></li>
							<li><i class="icon-twitter icon-2x"></i></li>
							<li><i class="icon-google-plus icon-2x"></i></li>
						</ul>
					</div>
				</div>
				<div class="group work-slide-nav">
					<a id="slide_nav_left" class="alignleft"><i class="icon-chevron-sign-left icon-3x"></i></a>
					<a id="slide_nav_right" class="alignright"><i class="icon-chevron-sign-right icon-3x"></i></a>
				</div>
			</div>
			<div class="hide-work-preview"><i class="icon-chevron-sign-down icon-3x"></i></div>
		</div>
	</div>
	<?php endwhile; ?>

	<?php else : ?>

	<?php endif; ?>

<?php get_footer(); ?>