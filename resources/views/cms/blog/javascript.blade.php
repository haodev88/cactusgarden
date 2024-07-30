<script type="text/javascript">
	// Call ckeditor
	callCkeditor('content');
	callCkeditor('short_desc');
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
