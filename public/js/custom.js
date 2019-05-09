$(document).ready(function() {

	var cur_url = "http://localhost/freedomhydraulics/";

	$('#user-register').validate();
	$('#news-category').validate();
	$('#news-update').validate();

	$('#news').validate({
		rules: {
            'image': {
                extension: "jpg|jpeg|png|gif"
            }
        }
	});

	$('#add-language').validate();
	$("#add-menu").validate();
	
	$("#add-slider").validate({
		rules: {
            'image': {
                required: true,
                extension: "jpg|png|jpeg|gif"
            }
        }
	});

	$("#update-slider").validate();
	$("#add-page").validate();
	$("#add-product-tab").validate();
	$("#add-dealer").validate();
	$("#add-dealer-category").validate();

	$(document).on('click', '.add_more', function(event) {
		event.preventDefault();

		var intCount = $('.product_slider .slider').length;

		var productSliderHtml = '<div class="slider">'+
			'<a class="remove_slider"> <i class="fas fa-window-close"></i> Remove</a>'+
				'<div class="form-group ">'+
				    '<label for="slider_image" class="control-label">Slider Image</label>'+
				    '<input class="form-control" name="slider_image['+intCount+']" type="file">'+		    
				'</div>'+
				'<div class="card">'+
				  '<div class="card-header d-flex p-0">'+
				    '<h3 class="card-title p-3">Description</h3>'+
				    '<ul class="nav nav-pills ml-auto p-2">';
				    var ij = 0;
			    	$.each(language, function( index, value ) {
			    		ij++;
			    		var actClass = (ij == 1) ? 'active' : '';
	    				productSliderHtml += '<li class="nav-item"><a class="nav-link '+ actClass +'" href="#tab_'+intCount+'_'+ij+'" data-toggle="tab">'+ value +'</a></li>';
			    	});

				    productSliderHtml += '</ul>'+
					  '</div><!-- /.card-header -->'+
					  '<div class="card-body">'+
					    '<div class="tab-content">';
					    var ij = 0;
				    	$.each(language, function( index, value ) {			    		
				    		ij++;
				    		var cls = (ij == 1) ? 'active' : '';
					    	productSliderHtml += '<div class="tab-pane '+cls+'" id="tab_'+intCount+'_'+ij+'">'+
						         '<textarea class="form-control summernote" rows="4" name="content['+intCount+'][]" cols="50"></textarea>'+
						    '</div>';
						});

				    productSliderHtml +='</div>'+
				  '</div>'+
				'</div>'+
			'</div>';

		$(".product_slider").append(productSliderHtml);
	});

	$(document).on('click', '.remove_slider', function(event) {
		event.preventDefault();
		$(this).closest('.slider').remove()
	});

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$("#language").change(function(event) {
		/* Act on the event */
		var curt_lang = $(this).val();
		var site_url = window.location.href.split('?')[0];
		var full_url = site_url+'?lang='+curt_lang;		
		var dataString = "curt_lang="+curt_lang;
		if(curt_lang != '') {
			$.ajax({
			  type: 'post',
			  url: cur_url+"change-lang",
			  data: dataString,
			  success: function(html) {
			    window.location.href = full_url;
			  }
			});
		}		
	});

	$(document).on('click', '.delete_setting', function(event) {
		var intId = $(this).data('id');
		var clost = $(this).closest('.row-setting');

	    if (!confirm("Do you want to delete")){
	      return false;
	    }

		if(intId != '') {
			$.ajax({
			  	type: 'post',
			  	url: cur_url+"admin/delete-setting",
			  	data: 'id='+intId,
			  	success: function(html) {
			    	clost.remove();
			  	}
			});
		}
	});	
	

	$(document).on('click', '.add_more', function(event) {
		event.preventDefault();

		var repairSheets = '<div class="sheets">'+
	        '<div class="form-group">'+
	        	'<label for="modal_name" class="control-label">Repair Sheet</label>'+
	            '<input type="file" name="repair_sheet[]" class="form-control">'+
	        '</div>'+
	        '<div class="form-group">'+
	        	'<label for="modal_name" class="control-label">Repair Sheet Caption</label>'+
	            '<input type="text" name="repair_sheet_caption[]" class="form-control">'+
	        '</div>'+
	    '</div>';

		$("#repair_sheet_list").append(repairSheets);

	})



	
	// Html editor
	$( 'textarea.editor').each( function() {
	    CKEDITOR.replace( $(this).attr('id') );
	});

});