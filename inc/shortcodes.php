<?php
	/*half column shortcode*/
	add_shortcode("half-col", "half_col_style");
	
	function half_col_style($atts, $cont){
		$pos = (isset($atts['pos']) && !empty($atts['pos'])) ? $atts['pos'] : "left";
		
		return '<div class="half group '.$pos.'">'.do_shortcode($cont).'</div>';
	}

	/* shortcode for the skill meters*/
	add_shortcode( 'skill-meter', 'skill_meter_sc_cb' );

	function skill_meter_sc_cb($atts, $cont){
		extract( shortcode_atts( array(
			'value' => '100',
			'color' => 'blue',
			'width'	=> '200',
		), $atts ) );

		switch ($color) {
			case 'blue':
				$color = '#0076a3';
				break;
			case 'orange':
				$color = '#fc0000';
				break;
			default:
				$color = '#0076a3';
				break;
		}

		$ret = '<li>
			<input 
				type="text" 
				value="'. $value .'" 
				class="skill-meter" 
				data-skin="tron" 
				data-thickness=".2"
				data-fgColor="'. $color .'"
				data-width="'. $width .'"
				data-readOnly="true">
			<h4 class="skill-caption">
				<span>'. $cont .'</span>
			</h4>
		</li>';

		return $ret;
	}


	/*shortcode to display skills*/
	add_shortcode( 'skills', 'skills_sc_cb' );

	function skills_sc_cb( $atts, $cont ){
		$ret = '';

		extract( shortcode_atts( array(
			'category'  => 'none',
			'color'		=> 'blue'
		), $atts ) );

		if( $category == 'none' ){
			$cats = get_terms( 'skill-category', array( 'hide_empty' => 0 ) );
		}else{
			$cats = get_terms( array('skill-category'), array( 'hide_empty' => 0, 'slug' => $category ) );
		}

		foreach ($cats as $cat) {
			$ret .= '<article class="skill-item group">
						<header class="box-header group '. $color .'">
							<h2>'. $cat->name .'</h2>
						</header>
						<ul class="'. $color .' skills-list group">';
			$args = array(
				'post_type' => 'skill',
				'tax_query' => array(
					array(
						'taxonomy' => 'skill-category',
						'field' => 'slug',
						'terms' => $cat->slug
					)
				)
			);

			$skills = new WP_Query($args);

			if( $skills->have_posts() ){
				while ( $skills->have_posts() ) {
					$skills->the_post();
					$level = get_post_meta(get_the_ID(), 'cfa_skill_level', TRUE);
					$color = get_post_meta(get_the_ID(), 'cfa_skill_colopicker', TRUE);

					$ret .= '<li>
								<input 
									type="text" 
									value="'. $level .'" 
									class="skill-meter" 
									data-skin="tron" 
									data-thickness=".2"
									data-fgColor="'. $color .'"
									data-width="200"
									data-readOnly="true">
								<h4 class="skill-caption">
									<span>'. get_the_title() .'</span>
								</h4>
							</li>';
				}
			}

			$ret .= '</ul>
					</article>';
		}

		wp_reset_query();
		return $ret;
	}


	/*shortcode to display skills*/
	add_shortcode( 'testimonials', 'testimonials_sc_cb' );

	function testimonials_sc_cb( $atts, $cont ){
		$ret = '
			<div class="testimonials-wrapper group">
				<article>
					<ul class="testimonial-items">
			';

		$items = new WP_Query(array('post_type' => 'testimonial'));

		if( $items->have_posts() ){
			while ( $items->have_posts() ) {
				$items->the_post();

				$ret .= '
					<li>
						<p class="testimonial-comment">'. get_the_content() .'</p>
						<div class="credentials">
							<a class="client-img">'. types_render_field( "client-img", array( "alt" => get_the_title(), "proportional" => "true" ) ) .'</a>
							<div class="client-desc">
								<a href="'. types_render_field( "client-url", array() ) .'" class="name">'. get_the_title() .'</a>
								<p>'. types_render_field( "client-profession", array() ) .'</p>
							</div>
						</div>
					</li>
				';
			}
		}

		$ret .= '
				</ul>
			</article>
		</div>';
					

		wp_reset_query();
		return $ret;
	}

?>