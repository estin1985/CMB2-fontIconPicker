var fip;

(function( $ ) {
	'use strict';

	fip = {

		options: {emptyIcon:false, iconsPerPage:30, theme:"fip-bootstrap"},


		getIcons : function() {
				var fontello_json_icons = [];
				var json_fonts=JSON.parse(cmb2_iconpicker_data);
	            $.each(json_fonts.glyphs, function(i, v) {
	                fontello_json_icons.push( json_fonts.css_prefix_text + v.css );
	            });
	            return fontello_json_icons;

		},

		initTarget : function() {
			var iconpicker = $('.iconpicker').fontIconPicker({emptyIcon:false, iconsPerPage:30, theme:"fip-bootstrap"})
				.on('change', function() {
					var thisInput = $(this),
				    nextSpan = thisInput.next('span'),
				    iconToChange = nextSpan.find('.selected_icon'),
				    selectedIcon = $(this).val();
					thisInput.val(selectedIcon);
			});
			var fonts = fip.getIcons();
			iconpicker.setIcons( fonts );
		},

		addRow : function(evt, row) {
			fip.initTarget();
			$(row).find('.cmb-td > .icons-selector:first-child').remove();
		}
	}
	jQuery(document).ready(function($) {
		fip.initTarget();
		$('.cmb2-wrap > .cmb2-metabox').on( 'cmb2_add_row', function(evt, row) { fip.addRow(evt, row) });
	});


})(jQuery);





	// jQuery(document).ready(function($) {

	// 	// Load fontello config.json
	// 	var fonts = function() {
	// 		var result = null;
	// 		if (!result) {
	// 			var fontello_json_icons = [];
	// 			var json_fonts=JSON.parse(cmb2_iconpicker_data);
	//             $.each(json_fonts.glyphs, function(i, v) {
	//                 fontello_json_icons.push( json_fonts.css_prefix_text + v.css );
	//             });
	//             var result=fontello_json_icons;
	// 		}
	// 		return result;
	// 	}();


	// 	var fip_options = {emptyIcon:false, iconsPerPage:30, theme:"fip-bootstrap"};

		
	// 	// $("div.wrap").on("click",".postbox .cmb-row span.selector-button", function(e){
	// 	// 	e.preventDefault();
	// 	// 	var iconpicker = $('.iconpicker').fontIconPicker(fip_options).on('change', function() {
	// 	// 		var thisInput = $(this),
	// 	//         nextSpan = thisInput.next('span'),
	// 	//         iconToChange = nextSpan.find('.selected_icon'),
	// 	//         selectedIcon = $(this).val();
	//  //        	thisInput.val(selectedIcon);
	// 	//     });
	// 	// 	// $(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
	// 	// 	iconpicker.setIcons( fonts );
	//  //        // $(this).prop('disabled', false).html('');
	        
	// 	// });

	// 	$('.cmb2-wrap > .cmb2-metabox').on( 'cmb2_add_row', function(evt, row) {
 //    			var iconpicker = $('.iconpicker')
 //    				.fontIconPicker(fip_options)
 //    				.on('change', function() {
	// 					var thisInput = $(this),
	// 				    nextSpan = thisInput.next('span'),
	// 				    iconToChange = nextSpan.find('.selected_icon'),
	// 				    selectedIcon = $(this).val();
	// 					thisInput.val(selectedIcon);
	// 		});
    		

 //    		// $(this).find('.cmb-td > .icons-selector + .icons-selector').remove()
	// 		iconpicker.setIcons( fonts );
	// 		// console.log(row)
	// 		$(row).find('.cmb-td > .icons-selector:first-child').remove();
	// 		// $(theID).find('.cmb-td > .icons-selector:nth-last-child(2)').remove();


	// 	});


	// 	if ( $('.iconpicker').length ) {
	// 		// Init IconPicker Field
	// 		var iconpicker = $('.iconpicker').fontIconPicker(fip_options).on('change', function() {
	// 			var thisInput = $(this),
	// 	        nextSpan = thisInput.next('span'),
	// 	        iconToChange = nextSpan.find('.selected_icon'),
	// 	        selectedIcon = $(this).val();
	//         	thisInput.val(selectedIcon);
	// 	    });
	// 		iconpicker.setIcons( fonts );
	// 	}
	// });

// })(jQuery);