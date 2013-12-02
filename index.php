<?php
/**
 * The main template file.
 */
?>
<?php get_header(); ?>

	<?php 
		if ( have_posts() ) : 
			while ( have_posts() ) : 
				the_post(); 
	?>
		<section id="welcome" class="group plx-block">
			<h1 class="section-header">
				Hi! I'm Foysal
			</h1>
			<header class="main">
				<h2>
					I'm a Web Developer, Programmer and a Dreamer.<br/>
					I have most of my recent works, skillset and contact information
					listed here. Use the navigation bar to find the info you’re looking for 
				</h2>		
			</header>
		</section><!-- #welcome ends-->

		<section id="works" class="group plx-block">
			<h1 class="section-header">WORKS</h1>
			<?php
				$work_tags = get_terms( 'work-tag', array( 'hide_empty' => 0 ) );
			?>
			<div class="works-wrapper group">
				<nav class="work-filters">
					<ul class="group">
						<?php 
							foreach ($work_tags as $tag) {
								echo '<li data-filter=".'. $tag->slug .'">'. $tag->name .'</li>';
							}
						?>
					</ul>
				</nav>
				<div class="main">
					<div class="wrap">
						<?php 
							$works = new WP_Query( array('post_type' => 'work') );
							if( $works->have_posts() ):
								while( $works->have_posts() ):
									$works->the_post();

									$tags_slug = '';
									$tags_name = '';
									$item_tags = get_the_terms( get_the_ID(), 'work-tag' );

									foreach ($item_tags as $tag) {
										$tags_slug .= ' '.$tag->slug;
										$tags_name .= $tag->name.', ';
									}
						?>
						<article class="work-item <?php echo get_post_meta( get_the_ID(), 'wpcf-items-color', true ).$tags_slug; ?>">
							<div class="item-desc">
								<div class="group">
									<h2 class="label">project</h2>
									<p><?php the_title(); ?></p>
								</div>
								<br/>
								<br/>
								<div class="group">
									<h2 class="label">tags</h2>
									<p><?php echo substr($tags_name, 0, -2); ?></p>
								</div>
							</div>
							<figure class="item-img" data-uri="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( array(290, 230) ); ?>
							</figure>
						</article>
						<?php endwhile; endif; wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</section><!-- #works ends-->
	
		<section id="skills" class="group plx-block">
			<h1 class="section-header">SKILLS</h1>
			
			<div class="main">
				<div class="skills-wrapper">					
					<?php echo do_shortcode('[skills color="orange" category="frameworks"]'); ?>
					<?php echo do_shortcode('[skills color="blue" category="languages"]'); ?>
					<?php echo do_shortcode('[skills color="orange" category="cms"]'); ?>
				</div>
			</div>
		</section><!-- #skills ends-->

		<section id="testimonials" class="group plx-block">
			<h1 class="section-header">testimonials</h1>
			<div class="main">
				<?php echo do_shortcode('[testimonials]'); ?>
			</div>
		</section><!-- #testimonials ends-->

		<section id="contact" class="group plx-block">
			<h1 class="section-header">contact</h1>
			<div class="main">
			<div class="contact-wrapper group">
				<div class="one-third left">
					<header class="box-header group orange">
						<h2>Note:</h2>
					</header>
					<p>
						Feel free to connect with me using any of the social mediums listed below.
						Or you could just send me a message using the contact form.
						Either way I'll make sure to reply you back ASAP.
						If you're interested in discussing about any project, please make sure to state so
						in your email.
						Thanks.
					</p>
					<ul class="social-icons">
						<li>
							<a href="https://twitter.com/BdgeeksFoysal">
								<i class="icon-twitter icon-2x"></i>
							</a>
						</li>
						<li>
							<a href="https://gplus.to/foysal">
								<i class="icon-google-plus icon-2x"></i>
							</a>
						</li>
						<li>
							<a href="https://github.com/BdgeeksFoysal">
								<i class="icon-github icon-2x"></i>
							</a>
						</li>
						<li>
							<a href="http://it.linkedin.com/pub/foysal-ahamed/55/903/173">
								<i class="icon-linkedin icon-2x"></i>
							</a>
						</li>
					</ul>
				</div>
				<div class="two-third right">
					<header class="box-header group blue">
						<h2>Write a Message:</h2>
					</header>
					<form action="" id="contact_form" class="group">
						<div class="input-row group">
							<label for="name">name</label>
							<input type="text" name="name" id="name">
						</div>
						<div class="input-row group">
							<label for="email">email</label>
							<input type="text" name="email" id="email">
						</div>
						<div class="input-row group">
							<label for="message" id="submit_form">send message</label>
							<textarea name="message" id="message"></textarea>
						</div>
					</form>
				</div>
			</div>
			</div>
		</section><!-- #contact ends-->

		<section id="companies" class="group plx-block">
			<div class="bg"></div>
			<h1 class="section-header">worked with-</h1>
			<div class="companies-wrapper group">
				<ul class="group logo-list">
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/tryoz-logo.png"></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/princeps-logo.png"></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/evo-logo.png"></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/adobe-logo.png"></li>
				</ul>
			</div>
		</section><!-- #companies ends-->
		
		<section id="map" class="full">
			<div class="full" id="map_canvas"></div>
		</section>

		<section id="meet" class="group plx-block">
			<h1 class="section-header">meet</h1>
			
			<div class="main">
			<div class="meet-wrapper group">
				<div class="one-third left">
					<header class="box-header group orange">
						<h2>Note:</h2>
					</header>
					<p>
						If You're interested to meet me in person or have me speak at an event,
						I'm available for you in the following areas marked on the map. <br/>
						<strong>But please consider that my availability isn't promised so make sure
						to contact me before arranging anything at your expense.</strong>
					</p>
				</div>
			</div>
		</div>
		</section><!-- #meet ends-->

		<section id="thanks" class="group plx-block">
			<div class="bg"></div>
			<h1 class="section-header">thanks!</h1>
			<div class="kitten group">
				<div class="kitten-img">
					<img src="http://placekitten.com/480/480">
				</div>
				<p>Thanks for taking the time to know about me, now here's a kitten for you.</p>
			</div>
		</section>
	<?php endwhile; ?>

	<?php else : ?>

	<?php endif; ?>
<?php get_footer(); ?>