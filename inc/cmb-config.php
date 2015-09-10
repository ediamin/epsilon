<?php
/**
 * Custom Meta Box Configs
 *
 * @package Epsilon
 *
 * CMB2 Documentation: https://github.com/WebDevStudios/CMB2/wiki
 * Generator: http://hasinhayder.github.io/cmb2-metabox-generator/
 */

add_action( 'cmb2_init', 'cmb2_add_metabox' );
function cmb2_add_metabox() {

	$prefix = '_cmb_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Metabox Title', 'epsilon' ),
		'object_types' => array( 'page', 'post' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Sample Text Box', 'epsilon' ),
		'id' => $prefix . 'sample_text',
		'type' => 'text',
	) );

}
