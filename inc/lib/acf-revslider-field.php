<?php
/**
 *	Revolution Slider Field
 *	
 *	Laborator.co
 *	www.laborator.co 
 */
	
if ( ! class_exists( 'acf_field' ) ) {
	return;
}

class acf_field_revsliders extends acf_field {
	
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name       = 'revsliders';
		$this->label      = "Revolution Sliders";
		$this->category   = "Choice";
		$this->defaults   = array(
			'default_value'  => '',
		);
		
		
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		if ( class_exists( 'RevSlider' ) ) {
			$slider = new RevSlider();
			$sliders = $slider->getArrSlidersShort();
		} else {
			$sliders = array(
				0 => '(No sliders found)'
			);
		}
		
		// vars
		$o = array( 'id', 'class', 'name', 'value' );
		$e = '';
		
		
		$e .= '<div class="acf-revsliders">';
		$e .= '<select';
		
		foreach( $o as $k )
		{
			$e .= ' ' . $k . '="' . esc_attr( $field[ $k ] ) . '"';	
		}
		
		$e .= '>';
		
		foreach ( $sliders as $slider_id => $slider_name ) {
			$e .= '<option value="' . $slider_id. '" ' . selected( $slider_id, $field['value'], false ) . '>' . $slider_name . '</option>';
		}
		
		$e .= '</select>';
		$e .= '</div>';
		
		
		// return
		echo $e;
	}
	
}

new acf_field_revsliders();
