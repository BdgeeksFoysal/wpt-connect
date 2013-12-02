<?php
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );

function cmb_sample_metaboxes( array $meta_boxes ){
	$prefix = 'cfa_';
	$meta_boxes[] = array(
		'id'         => 'skills_metabox',
		'title'      => 'Skills Info',
		'pages'      => array( 'skill', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Color',
				'desc' => 'The color of the skill meter',
				'id'   => $prefix . 'skill_colopicker',
				'type' => 'colorpicker',
			),
			array(
				'name' => 'Level/Value',
				'desc' => 'The Level of you expertise from 0-100',
				'id'   => $prefix . 'skill_level',
				'type' => 'text_small',
			),
		)
	);

	return $meta_boxes;
}

/* including the metabox functionality to the init hook */

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';
}


