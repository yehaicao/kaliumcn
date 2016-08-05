<?php
/**
 *	Laborator 1 Click Demo Content Importer
 *
 *	Developed by: Arlind
 *	URL: www.laborator.co
 */


?>
<div class="wrap" id="lab_demo_content_container">
	<h2 id="main-title">1-Click Demo Content Installer</h2>
	<p class="description">Choose the demo content pack to install in this copy of WordPress installation. We recommend to install only one demo content pack per WordPress installation. This process is irreversible!</p>
	
	
	<?php
	$max_execution_time_cur = @ini_get( 'max_execution_time' );
	$max_execution_time_sug = 180;
	
	$max_input_time_cur = @ini_get( 'max_input_time' );
	$max_input_time_sug = 60;
	
	$memory_limit_cur = @ini_get( 'memory_limit' ); //WP_MAX_MEMORY_LIMIT;
	$memory_limit_sug = 64;
	?>
	
	<table class="lab-democi-table-php-requirements">
		<thead>
			<tr>
				<td colspan="4">
					<p>In order to successfully import a demo content pack you need to fulfil at least these PHP configuration parameters:</p>
				</td>
			</tr>
			<tr>
				<th>Directive</th>
				<th>Priority</th>
				<th>Least Suggested Value</th>
				<th>Current Value</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>DOMDocument</td>
				<td>High</td>
				<td class="bold">Supported</td>
				<td class="bold <?php echo class_exists( 'DOMDocument' ) ? 'ok' : 'notok'; ?>"><?php echo class_exists( 'DOMDocument' ) ? 'Supported' : 'Not Supported'; ?></td>
			</tr>
			<tr>
				<td>memory_limit</td>
				<td>High</td>
				<td class="bold"><?php echo $memory_limit_sug; ?>M</td>
				<td class="bold <?php echo intval($memory_limit_cur) >= $memory_limit_sug ? 'ok' : 'notok'; ?>"><?php echo $memory_limit_cur; ?></td>
			</tr>
			<tr>
				<td>max_execution_time</td>
				<td>Medium</td>
				<td class="bold"><?php echo $max_execution_time_sug; ?></td>
				<td class="bold <?php echo $max_execution_time_cur >= $max_execution_time_sug ? 'ok' : 'notok'; ?>"><?php echo $max_execution_time_cur; ?></td>
			</tr>
			<tr>
				<td>max_input_time</td>
				<td>Medium</td>
				<td class="bold"><?php echo $max_input_time_sug; ?></td>
				<td class="bold <?php echo $max_input_time_cur >= $max_input_time_sug ? 'ok' : 'notok'; ?>"><?php echo $max_input_time_cur; ?></td>
			</tr>
		</tbody>
		<?php if( intval($memory_limit_cur) < $memory_limit_sug || $max_execution_time_cur < $max_execution_time_sug ): ?>
		<tfoot>
			<tr>
				<td colspan="4" class="small">
					To change PHP directives you need to modify <strong>php.ini</strong> file, more information about this you can <a href="http://goo.gl/I9f74U" target="_blank">search here</a> or contact your hosting provider.
				</td>
			</tr>
		</tfoot>
		<?php endif; ?>
	</table>

	<ul class="demo-content-packs">
	<?php
	foreach(lab_1cl_demo_installer_get_packs() as $pack):

		extract($pack);

		$popup_link = admin_url( 'admin.php?page=laborator_demo_content_installer&install-pack=' . sanitize_title($name)) . '&#038;TB_iframe=true&#038;width=780&#038;height=550';
		?>
		<li>
			<div class="pack-entry">
				<a href="<?php echo $popup_link; ?>" class="thickbox">
					<img src="<?php echo LAB_1CL_DEMO_INSTALLER_REMOTE_PATH . $thumb; ?>" />
				</a>

				<div class="pack-details">
					<h3><?php echo $name; ?></h3>

					<?php if($desc): ?>
					<p><?php echo nl2br( $desc ); ?></p>
					<?php endif; ?>
					
					<div class="demo-content-action-buttons">
						<a href="<?php echo $popup_link; ?>" title="Demo Content Pack &raquo; <?php echo esc_attr($name); ?>" class="button button-primary thickbox">Install Content Pack</a>
						<a href="<?php echo $url; ?>" target="_blank" class="button button-secondary" title="Preview this demo">
							<i class="dashicons-before dashicons-share-alt2"></i>
						</a>
					</div>
				</div>
			</div>
		</li>
		<?php

	endforeach;
	?>
	</ul>

	<hr />
	<div class="footer-copyrights">
		&copy; This plugin is developed by <a href="http://laborator.co">Laborator</a>
	</div>
</div>