<script type="text/javascript">
	
	// Call ckeditor
	callCkeditor('txtShort');
	callCkeditor('txtLong');
	
	$(function() {
		/**
		|------------------------------
		| Delete image brand
		|-----------------------------
		*/
		$(document).on('click','span#remove-image-brand',function() {
			var source = $(this).attr('data-image');
			$('input[name=txtDeleteImage]').val(source);
			$('div#show-image-brand-choose').hide();
		});


	});
	


</script>