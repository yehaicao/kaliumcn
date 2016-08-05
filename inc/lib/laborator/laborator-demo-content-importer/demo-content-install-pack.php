<?php
/**
 *	Laborator 1 Click Demo Content Importer
 *
 *	Developed by: Arlind
 *	URL: www.laborator.co
 */
 
$content_packs = lab_1cl_demo_installer_pack_content_types($pack);
?>
<html>
<head>
	<title>Content Pack Settings - <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
	
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" href="<?php echo LAB_1CL_DEMO_INSTALLER_STYLESHEET; ?>" type="text/css" media="screen" charset="utf-8">
	
	<script type="text/javascript" src="<?php echo site_url( 'wp-includes/js/jquery/jquery.js' ); ?>"></script>
</head>
<body>
	<style>
		body { 
			padding: 0;
			margin: 0;
		}
	</style>
	
	<div class="lab-1cl-demo-installer-popup">
		<h2>
			Import Demo Content <strong><?php echo $pack['name']; ?></strong>
			<small>Select what type of content do you want to import:</small>
		</h2>
		
		<form method="post" enctype="application/x-www-form-urlencoded" action="" id="lab_1cl_demo_installer_form_step_1">
			
			<?php
			foreach ( $content_packs as $content_pack ) :
				
				$field_id = uniqid( 'el_' );
				?>
				<div class="pack-details-entry<?php echo $content_pack['type'] == 'xml-wp-download-media' ? ' hidden' : ''; ?>" data-content-pack="<?php echo $content_pack['type']; ?>">
					
					<label class="cb">
						<input type="checkbox" name="content_type[]" id="<?php echo $field_id; ?>" value="<?php echo $content_pack['type']; ?>" <?php checked( $content_pack['checked'] ); ?> <?php if ( isset( $content_pack['disabled'] ) && $content_pack['disabled'] ) : ?> disabled="disabled"<?php endif; ?> />
						<span class="error-close"></span>
					</label>
					
					<div class="details-title">
						<label for="<?php echo $field_id; ?>">
							<strong>
								<?php echo $content_pack['title']; ?> 
							</strong>
							<?php echo nl2br( $content_pack['description'] ); ?>
						</label>
												
						<?php if ( isset( $content_pack['size'] ) && $content_pack['size'] ) : ?>
							<span class="file-size"><?php echo $content_pack['size']; ?></span>
						<?php endif; ?>
						
						<?php if ( isset( $content_pack['disabled'] ) && $content_pack['disabled'] ) : ?>
						<div class="package-warning">
							<strong>NOTE:</strong>
							<?php
							foreach ( $content_pack['requires'] as $plugin_info ) :
								echo nl2br( $plugin_info );
							endforeach;
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
				
			endforeach;
			?>
			
			
			<div class="button-container">
				<button type="submit" name="step2">
					<span>Import Demo Content</span>
					<span>Importing...</span>
				</button>
			</div>
			
		</form>
	</div>
	
	<div class="lab-1cl-demo-success">
		<div class="smiley"></div>
		
		<h2>Hooray! All Done.</h2>
		<a href="<?php echo esc_attr( home_url() ); ?>" target="_blank">View <strong><?php echo $pack['name']; ?></strong> Demo Content &raquo;</a>
		
		<div class="errors-container">
			<span>However few errors appeared during the import process:</span>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			// WP Media Download Toggle
			var $xml_wp_content = $('.pack-details-entry[data-content-pack="xml-wp-content"]'),
				$xml_wp_download_media = $('.pack-details-entry[data-content-pack="xml-wp-download-media"]'),
				
				$xml_wp_content_input = $xml_wp_content.find('input');
			
			$xml_wp_download_media.addClass('hidden');
			
			if($xml_wp_content_input.is(':checked'))
			{
				$xml_wp_download_media.removeClass('hidden');
			}
			
			$xml_wp_content_input.on('change', function()
			{
				var is_checked = $xml_wp_content_input.prop('checked');
				
				$xml_wp_download_media[is_checked ? 'removeClass' : 'addClass']('hidden');
			});
			
			
			// Form Submit
			$("#lab_1cl_demo_installer_form_step_1").on('submit', function(ev)
			{
				ev.preventDefault();
				
				var $form = $(this)
					$submit = $form.find('button[type="submit"]'),
					
					$content_packs = $(".pack-details-entry:not([data-content-pack=\"xml-wp-download-media\"]):has(input:checked:enabled)");
				
				if($form.data('is-busy'))
				{
					return false;
				}
				
				// Make form busy
				$submit.addClass('is-loading').attr('readonly', true);
				$form.data('is-busy', true).find('.cb input').attr('disabled', true);
				
				var importPacks = [];
				
				$content_packs.each(function(i, el)
				{
					var $el    	  = $(el),
						$input    = $el.find('input[type="checkbox"]'),
						type      = $el.data('content-pack'),
						entry     = {
							type: type,
							$el: $el
						};
					
					if(type == 'xml-wp-content')
					{
						entry.downloadMedia = $xml_wp_download_media.find('input[type="checkbox"]').is(':checked') ? 1 : 0;
					}
					
					importPacks.push(entry);
				});
				
				if(importPacks.length == 0)
				{
					alert("Please select at least one content type to import!");
					
					$form.data('is-busy', false).find('.cb input').attr('disabled', false);
					$submit.removeClass('is-loading').attr('readonly', false);
				}
				else
				{
					// Prevent Window Escaping
					var preventCloseFn = function () {
						return  "Are you sure you want to close this window?";
					};
					
					$(window).on('beforeunload', preventCloseFn);
				
					var contentPacksTotal = importPacks.length,
						contentPacksImported = 0,
						contentPacksImportedSuccess = 0,
						errorsArray = [];
					
					var importFinished = function()
					{
						$(window).off('beforeunload', preventCloseFn);
						
						$submit.fadeTo(500, 0);
						
						if(errorsArray.length)
						{
							$("body").addClass('lab-1cl-errors-visible');
							
							$.each(errorsArray, function(i, err)
							{
								$(".errors-container").append('<div class="error-entry">[ErrType: '+err.type+'] '+err.errorMsg+'</div>');
							});
						}
						
						if(errorsArray.length > contentPacksImportedSuccess)
						{
							$(".lab-1cl-demo-success").find(".smiley").attr('class', 'sad');
							$(".lab-1cl-demo-success .errors-container span").html((contentPacksImportedSuccess > 0 ? 'One or more content sources was imported successfully except content sources these blow. ' : '')+'Errors during the import:');
							$(".lab-1cl-demo-success").find('h2').html('Oops.. there were ' + errorsArray.length + ' errors during the import!' );
						}
						
						$("body").addClass("lab-1cl-success-visible");
					};
					
					var registerTypeError = function(type, errorMsg)
					{
						errorsArray.push({
							type: type,
							errorMsg: errorMsg
						});
					};
					
					var checkIfFinished = function()
					{
						if(contentPacksImported < contentPacksTotal)
						{
							importContentPacks(); // Request Another AJAX request for remaining content sources to import
						}
						else
						{
							importFinished();
						}
					};
					
					var importContentPacks = function()
					{
						if(importPacks.length)
						{
							var contentPack = importPacks.shift(),
								ajaxData = {
									action: 'lab_1cl_demo_install_package_content',
									pack: '<?php echo sanitize_title($pack['name']); ?>'
								};
							
							var $el = contentPack.$el;
							
							delete contentPack.$el;
							
							ajaxData.contentSourceDetails = contentPack;
							
							// Is loading state
							$el.addClass('is-loading');
							
							
							// Media Files Checkup
							if(contentPack.type == 'xml-wp-content')
							{
								if($el.next().find('input:checked').length)
								{
									$el.next().addClass('is-loading');
								}								
								else
								{
									$el.next().addClass('hidden');
								}
							}
							
							// Do AJAX Request
							$.post('<?php echo esc_url(admin_url("admin-ajax.php")); ?>', ajaxData, function(resp){
								
								var classToSet = resp.success ? 'is-finished' : 'has-errors';
								
								$el.removeClass('is-loading').addClass(classToSet);
							
								// Media Files Download
								if(contentPack.type == 'xml-wp-content')
								{
									$el.next().removeClass('is-loading').addClass(classToSet);
								}
								
								if(resp.success)
								{
									contentPacksImportedSuccess++;
								}
								else
								{
									registerTypeError(contentPack.type, resp.errorMsg);
								}
								
								contentPacksImported++;
								
								checkIfFinished();
								
							}, 'json')
							.fail(function(resp)
							{
								$el.removeClass('is-loading').addClass('has-errors');
								
								contentPacksImported++;
								
								registerTypeError(contentPack.type, resp.responseText);
								checkIfFinished();
							});
						}	
					};
					
					importContentPacks();
				}
			});
			
			
			// Bottom Padding
			$("body").css('padding-bottom', $(".button-container").outerHeight());
			
		});
		
	</script>
</body>
</html>