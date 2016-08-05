;(function($, window, undefined)
{
	"use strict";

	$(document).ready(function()
	{
		if ( typeof labVcMaps == 'undefined' ) {
			return;
		}
		
		$.each(labVcMaps, function(mapIndex, mapEntry)
		{
			google.maps.event.addDomListener(window, 'load', function()
			{
				var bounds    = new google.maps.LatLngBounds(),
					markers   = [],
					zoom      = mapEntry.zoom,
					options   = {
						center: {
							lat: -34.397,
							lng: 150.644
						},
						scrollwheel: mapEntry.scrollwheel,
						draggable: $(window).width() > 768 ? true : mapEntry.scrollwheel,
						panControl: mapEntry.panControl,
						zoomControl: mapEntry.zoomControl,
						mapTypeControl: mapEntry.mapTypeControl,
						scaleControl: mapEntry.scaleControl,
						streetViewControl: mapEntry.streetViewControl,
						overviewMapControl: mapEntry.overviewMapControl,
						
						mapTypeId: mapEntry.mapType
					},
					map = new google.maps.Map(document.getElementById(mapEntry.id), options);
				
				jQuery.each(mapEntry.locations, function(i, location)
				{
					var latlng = new google.maps.LatLng(location.latitude, location.longitude),
						delay = (i+1) * 150 * (mapEntry.dropPins ? 1 : 0);
						
					bounds.extend(latlng);
					
					delay = Math.min(1000, delay);
					
					setTimeout(function(){
						
						var imageExtension = location.marker_image.toLowerCase().split('.');
						imageExtension = imageExtension[imageExtension.length - 1];
						
						if(location.retina_marker == 'yes' && $.inArray(imageExtension, ['svg']))
						{
							location.marker_image = new google.maps.MarkerImage(location.marker_image, null, null, null, new google.maps.Size(location.marker_image_size[0]/2, location.marker_image_size[1]/2));
						}
						
						var marker_id = markers.push( new google.maps.Marker({
							position: latlng,
							map: map,
							title: latlng.marker_title,
							icon: location.marker_image,
							animation: mapEntry.dropPins ? google.maps.Animation.DROP : null
						}) );
						
						var marker = markers[marker_id-1];
						
						if(location.marker_description)
						{
							var content_string = '';
							
							if(location.marker_title)
							{
								content_string += '<h3 style="margin-top: 10px;">' + location.marker_title + '</h3>';
							}
							
							content_string += '<div>' + location.marker_description+ '</div>';
							
							var infowindow = new google.maps.InfoWindow({
								content: content_string
							});
							
							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map, marker);
							});
						}
						
					}, delay);
				});
				
				
				if(mapEntry.zoom > 0)
				{
					map.setCenter(bounds.getCenter());
					map.setZoom(mapEntry.zoom);
				}
				else
				{
					map.fitBounds(bounds);
				}
				
				if(mapEntry.styles)
				{
					map.setOptions({styles: mapEntry.styles});
				}
				
				
				if(mapEntry.tilt)
				{
					map.setTilt(mapEntry.tilt);
				}
				
				if(mapEntry.heading)
				{
					map.setHeading(mapEntry.heading);
				}
				
				map.panBy(parseInt(mapEntry.panBy[0], 10), parseInt(mapEntry.panBy[1], 10));
				
				if(mapEntry.plusMinusZoom)
				{
					var customZoomControl = function(controlDiv, map)
					{
						var $zooms = $("#" + mapEntry.id).parent().find('.cd-zoom');
						
						$zooms.removeClass('hidden');
						
						var controlUIzoomIn = $zooms.filter(".cd-zoom-in")[0],
							controlUIzoomOut = $zooms.filter(".cd-zoom-out")[0];
							
						controlDiv.appendChild(controlUIzoomIn);
						controlDiv.appendChild(controlUIzoomOut);
				
						google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
						    map.setZoom(map.getZoom()+1)
						});
						
						google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
						    map.setZoom(map.getZoom()-1)
						});
					}
				
					var zoomControlDiv = document.createElement('div');
					zoomControlDiv.setAttribute('className', 'cd-zoom-controllers');
					var zoomControl = new customZoomControl(zoomControlDiv, map);
				
					map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);
				}
				
			});
		});
	});

})(jQuery, window);