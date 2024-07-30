<script type="text/javascript">
	
	// Call ckeditor
	callCkeditor('txtShort');
	callCkeditor('txtLong');
	
	/**
	|----------------------------------------
	| checkEmptyBrand to show hide brand
	|---------------------------------------
	*/	
	function checkEmptyBrand() {
		var hiddenBrand = $('div#append_brand').find('input[type=hidden]').length;
		if (hiddenBrand == 0) {
			$('div#show-brand-add').hide();
		} else {
			$('div#show-brand-add').show();
		}
	}

	$(function() {
		/**
		|------------------------------
		| Delete image supplier
		|------------------------------
		*/
		$(document).on('click','span#remove-image-supplier',function() {
			var source = $(this).attr('data-image');
			$('input[name=txtDeleteImage]').val(source);
			$('div#show-image-supplier-choose').hide();
		});

		/**
		|-------------------------------
		| Add Brand For Supplier
		|-------------------------------
		*/
		$(document).on('change','select[name=sltBrand]',function() {
			if (id!="") {
				var id 		   = $(this).find('option:selected').val();
				var brandName  = $(this).find('option:selected').text();
				var appendBrand     = true;
				$("input.brand_id").each(function(index, el) {
					var chooseId = $(this).val();
					if (chooseId == id) {
						appendBrand = false;
						return false; 
					}					
				});
				if (appendBrand) {
					var appendData =
					'<span class="label label-tag">'+brandName+
                    	'<input type="hidden" class="brand_id" name="brand_id[]" value="'+id+'">'+
                    	'&nbsp;<span data-id="'+id+'" class="glyphicon glyphicon-remove remove-tag" aria-hidden="true"></span>'+
	                '</span>&nbsp;';
	            	$("div#append_brand").append(appendData);
	            	checkEmptyBrand();  
				}
			}              
		});
		
		/**
		|-------------------------------
		| Remove Brand 
		|-------------------------------
		*/
		$(document).on('click','span.remove-tag',function() {
			if ($(this).attr('data-delete')) {
				var id = $(this).attr('data-delete');
				$('span#append-delete-brand').append('<input type="hidden" name="txtDeleteBrand[]" value="'+id+'">');
			}
			$(this).parent().remove();
			checkEmptyBrand();
		});

	});
	


</script>