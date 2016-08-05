<?php
/**
 *	Contact Form
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

# Atts
$defaults = array(
	'name_title'           => '',
	'email_title'          => '',
	'subject_title'        => '',
	'message_title'        => '',
	'show_subject_field'   => '',
	'submit_title'         => '',
	'submit_success'       => '',
	'email_receiver'       => '',
	'alert_errors'		   => '',
	'el_class'             => '',
	'css'                  => ''
);

#$atts = vc_shortcode_attribute_parse($defaults, $atts);
if( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

$uniqid = uniqid("el_");
$check_string = wp_create_nonce("cf_" . md5($uniqid . json_encode($atts)));

# Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "lab-contact-form message-form {$css_class}";
?>
<div class="<?php echo esc_attr($css_class) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<form action="#" class="contact-form" id="<?php echo esc_attr($uniqid); ?>" data-alerts="<?php echo $alert_errors == 'yes' ? 1 : 0; ?>" data-alerts-msg="<?php echo esc_attr( __( 'Please fill "%" field.', 'kalium' ) ); ?>" data-check="<?php echo esc_attr($check_string); ?>" novalidate>
		<input type="hidden" name="request" value="<?php echo str_rot13(base64_encode(json_encode($atts))); ?>" />
		<div class="row">
    		<div class="col-sm-6">
				<div class="form-group absolute">
					<?php if($name_title): ?>
					<div class="placeholder"><label for="<?php echo "{$uniqid}_name"; ?>"><?php echo esc_html($name_title); ?></label></div>
					<?php endif; ?>
					<input name="name" id="<?php echo "{$uniqid}_name"; ?>" type="text" placeholder="" data-label="<?php echo esc_attr( trim($name_title, ':?.') ); ?>">
				</div>
    		</div>
			<div class="col-sm-6">
				<div class="form-group absolute">
					<?php if($email_title): ?>
					<div class="placeholder"><label for="<?php echo "{$uniqid}_email"; ?>"><?php echo esc_html($email_title); ?></label></div>
					<?php endif; ?>
					<input name="email" id="<?php echo "{$uniqid}_email"; ?>" type="email" placeholder="" data-label="<?php echo esc_attr( trim($email_title, ':?.') ); ?>">
				</div>
			</div>
			
			<?php if($show_subject_field == 'yes'): ?>
    		<div class="col-sm-12">
				<div class="form-group absolute">
					<?php if($subject_title): ?>
					<div class="placeholder"><label for="<?php echo "{$uniqid}_subject"; ?>"><?php echo esc_html($subject_title); ?></label></div>
					<?php endif; ?>
					<input name="subject" id="<?php echo "{$uniqid}_subject"; ?>" type="text" placeholder="" data-label="<?php echo esc_attr( trim($subject_title, ':?.') ); ?>">
				</div>
    		</div>
			<?php endif; ?>
			
			<div class="col-sm-12">
				<div class="form-group">
					<?php if($message_title): ?>
					<div class="placeholder ver-two"><label for="<?php echo "{$uniqid}_message"; ?>"><?php echo esc_html($message_title); ?></label></div>
					<?php endif; ?>
					<textarea name="message" id="<?php echo "{$uniqid}_message"; ?>" placeholder="" data-label="<?php echo esc_attr( trim($message_title, ':?.') ); ?>"></textarea>
				</div>
			</div>
		</div> <!-- row -->
		<button type="submit" name="send" class="btn btn-primary send">
			<span class="pre-submit"><?php echo esc_html($submit_title); ?></span>
			<span class="success-msg"><?php echo strip_tags($submit_success, '<strong><span><em>'); ?> <i class="flaticon-verification24"></i></span>
			<span class="loading-bar">
				<span></span>
			</span>
		</button>
	</form>
</div>