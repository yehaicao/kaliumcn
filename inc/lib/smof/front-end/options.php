<?php
$saved_text = '设置已保存';
?>
<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save"><i class="fa fa-thumbs-up"></i> 设置已更新</div>
	</div>

	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset"><i class="fa fa-refresh"></i> 设置已重置</div>
	</div>

	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail"><i class="fa fa-times-circle"></i> 发生错误！</div>
	</div>

	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >

		<div id="header">

			<div class="logo">
				<h2>
					<?php echo THEMENAME; ?>
					<span class="theme_version"><?php echo (THEMEVERSION); ?></span>
				</h2>
				
				<?php /*<div class="holidays-pine"></div>*/ ?>
			</div>

			<div id="js-warning">Warning: This options panel will not work properly without javascript!</div>
			<a href="http://laborator.co" target="_blank" class="icon-option"></a>
			<div class="clear"></div>

    	</div>

		<div id="info_bar" class="hidden">

			<a>
				<div id="expand_options" class="expand">Expand</div>
			</a>

			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

			<button id="of_save" type="button" class="button-primary">
				<span class="loading-spinner">
					<i class="fa fa-circle-o-notch fa-spin"></i>
				</span>
				<em data-success="<?php echo $saved_text; ?>">保存所有改变</em>
			</button>

		</div><!--.info_bar-->

		<div id="main">

			<div id="of-nav">
				<ul>
				  <?php echo $options_machine->Menu ?>
				</ul>
			</div>

			<div id="content">
		  		<?php echo $options_machine->Inputs /* Settings */ ?>
		  	</div>

			<div class="clear"></div>
			
			<a href="#of_save" class="of-save-sticky">
				<i class="fa fa-save"></i>
				<i class="fa fa-circle-o-notch fa-spin"></i>
				<span class="save-text">保存所有改变</span>
			</a>

		</div>

		<div class="save_bar">

			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<button id ="of_save" type="button" class="button-primary">
				<span class="loading-spinner">
					<i class="fa fa-circle-o-notch fa-spin"></i>
				</span>
				<em data-success="<?php echo $saved_text; ?>">保存所有改变</em>
			</button>
			<button id ="of_reset" type="button" class="button submit-button reset-button">Options Reset</button>
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />

		</div><!--.save_bar-->

	</form>

	<div style="clear:both;"></div>

</div><!--wrap-->
<div class="smof_footer_info hidden">Slightly Modified Options Framework <strong><?php echo SMOF_VERSION; ?></strong></div>