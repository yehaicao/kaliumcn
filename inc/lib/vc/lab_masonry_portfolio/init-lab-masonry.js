;(function($, window, undefined)
{
	"use strict";

	$(document).ready(function()
	{
		var definedImageSizes = {
			"8x3": {image: ''},
		};
		
		var getBoxSizeContainer = function()
		{
			var $box_size = $('.edit_form_line select[name="box_size"]');
			
			if($box_size.length)
			{
				var $box_size_container = $box_size.closest('.wpb_el_type_dropdown');
				
				if($box_size_container.find('.lab-box-size-previewer').length == 0)
				{
					$box_size_container.prepend('<div class="lab-box-size-previewer"></div>');
					
					var $box_size_previewer = $box_size_container.find('.lab-box-size-previewer');
					
					$box_size_previewer.append('<div class="box-size-preview-model-container"><table class="box-size-preview-model" cellspacing="0" cellpadding="0"></table></div>');
					$box_size_previewer.append('<div class="current-box-container"><div class="current-box-size"></div><span></span></div>');
					
					var $previewer_model = $box_size_previewer.find('.box-size-preview-model');
					
					for(var i=1; i<=12; i++)
					{
						var $tr = $('<tr></tr>');
						
						$previewer_model.append($tr);
						
						for(var j=1; j<=12; j++)
						{
							$tr.append('<td class="box-'+i+'x'+j+'"><i></i></td>');
						}
					}
					
					return $box_size_previewer;
				}
				
				return $box_size_container.find('.lab-box-size-previewer');
			}
		};
		
		var boxCheckType = function(ev, elRep)
		{
			var el = this;
			
			if(elRep)
			{
				el = elRep;
			}
			
			var $box_size_previewer = getBoxSizeContainer(),
				val = $(el).val().split('x');
			
			$box_size_previewer.find('.current-box-container').html(
				'<span>Box Size:' + '<em>' + $(el).val() + '</em></span>' +
				'<span>Box Width:' + '<em>~' + parseInt(val[0]/12 * 100, 10) + '%</em></span>' 
			);
			
			$box_size_previewer.find('td.active').removeClass('active');
			
			for(var i=1; i<=val[0]; i++)
			{
				for(var j=1; j<=val[1]; j++)
				{
					$box_size_previewer.find('.box-'+j+'x'+i+'').addClass('active');
				}
			}
			
			$(el).data('is-initialized', true);
		};
		
		$("#vc_properties-panel").on('vcPanel.shown', function()
		{
			$('.edit_form_line select[name="box_size"]').each(function(i, el)
			{
				var $el = $(el);
				
				if($el.data('is-initialized') != true)
				{
					boxCheckType(false, el);
				}
			});
		});
		
		$("body").on('change', '.edit_form_line select[name="box_size"]', boxCheckType);
		
	});

})(jQuery, window);