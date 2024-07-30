<script type="text/javascript">
	/**
	|-----------------------------------
	| CHECK ATTRIBUTE PRODUCT FUNCTION
	|-----------------------------------
	*/
	function checkExistsAttributeProduct() {
	    var len = $("div.item-tag-warp").find("input[type=hidden]").length;
	    if (len != 0) {
	        $("div#show-attribute-product").show();
	    } else {
	        $("div#show-attribute-product").hide();
	    }
	}

	/**
	|-----------------------------------
	| HIDE OR SHOW LIST IMAGES
	|-----------------------------------
	*/
	function checkExistsUploadImage() {
	    var l = $("div#item-img-warp").find("img").length;
	    if (l != 0) {
	        $("div#show-image-product").show();
	    } else {
	        $("div#show-image-product").hide();
	    }
	    return l;
	}
	/**
	|----------------------------------------
	| Display Image multiple
	|----------------------------------------
	*/
	function mutipleImage(input) {
	    var length = input.files.length;
	    $("div#item-img-warp").html('');
	    var stt = 0;
	    // div edit is exists
	    if ($("div#img-edit").length!=0) {
	        stt = ($("div#img-edit").find('input[type=radio]').length);
	    }
	    for (var i=0; i<length; i++) {
	        var t = input.files[i].type;
	        var s = t.substr(0,t.indexOf("/"));
	        if (s == "image") {
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                var img = 
	                '<div class="col-md-4 col-sm-12 col-xs-12">'+
	                    '<div class="find-img-default">'+
	                        '<img src="'+e.target.result+'" class="img-responsive" alt="Responsive image">'+
	                        '<div class="checkbox">'+
	                            '<input data-stt="'+stt+'" name="checkImgDefault" type="radio" class="flat" value="1">'+
	                            '<label style="padding-left:5px;">Chọn ảnh đại diện</label>'+
	                        '</div>'+
	                    '</div>'+
	                '</div>';
	                $("div#item-img-warp").append(img);
	                loadIcheck();
	                checkExistsUploadImage();
	                stt++;
	            }
	            reader.readAsDataURL(input.files[i]);
	            checkExistsUploadImage();
	        } else {
	            checkExistsUploadImage();
	        }
	    }
	}
	/**
	|------------------------------------------
	| GET STT FOR PRODUCT IMAGR TO GET DEFAULT
	|------------------------------------------
	*/
	function getNewSttForImage() {
	    $("div.find-img-default").find("input[name=checkImgDefault]").each(function(i,e) {
	        $(this).attr('data-stt',i);
	    });
	}
//========================================== FOR READY FUNCTION ==========================================
	$(function() {
    /**
    |-----------------------------------
    | Load Icheck
    |-----------------------------------
    */
    if ($("input.flat")[0]) {
        loadIcheck();
    }

    /**
    |----------------------------
    | GET DATA BRAND FROM AJAX
    |----------------------------
    */
    $("select#sltSupplier").on("change",function() {
        var href         = $(this).attr("data-href");
        var supplierId   = $(this).find("option:selected").val();
        $.get(href,{"supplierId":supplierId},function(response) {
            if(typeof response == 'object') {
                var option = '';
                for (var i=0; i<response.length;i++) {
                    option+='<option value="'+response[i].id+'">'+response[i].name+'</option>';
                }
                $("select[name=sltBrand]").html(option);
                $("select[name=sltBrand]").addClass('select2_single');
                callSelect2();
            } else {
                var option = '<option value="">Chọn</option>';
                $("select[name=sltBrand]").html(option);
                callSelect2();
            }
        });
    });
    /**
    |-----------------------------
    | PROCCESS ATTRIBUTE PRODUCT
    |-----------------------------
    */
    $(document).on("change","select[name=sltAttribute]",function() {
        var id          = $(this).val();
        var optionName  = $(this).find('option:selected').attr('data-option-name');
        if (id != 0 ) {
            var addAttribute = true;
            $("input.option_id").each(function(index, el) {
                var chooseId = $(this).val();
                if (id == chooseId) {
                    addAttribute = false;
                    return false;
                }
            });
            // check attribute is exists.
            if (addAttribute) {
                var outPut = '<div>';
                outPut+= '<span class="label label-tag">' +optionName;
                outPut+= '<input type="hidden" class="option_id" name="option_id[]" value="'+id+'" />';
                outPut+= '&nbsp;<span class="glyphicon glyphicon-remove remove-tag" aria-hidden="true"></span> ';
                outPut+= '</span> ';
                outPut+= '</div> ';
                $("div.item-tag-warp").append(outPut);
            }
        }
        // show or hide Attribute
        checkExistsAttributeProduct(); 
    });

    /**
    |-----------------------------------
    | Remove Tag Attribute Product
    |-----------------------------------
    */
    $(document).on("click","span.remove-tag",function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        // append input hidden for delete option edit page
        if ($(this).attr('data-id') && $(this).attr('data-id')!="") {
            var optionId = $(this).attr('data-id');
            $("span#append-delete-option").append("<input type='hidden' name='txtDeleteOption[]' value='"+optionId+"' >");
        }
        // show or hide Attribute
        checkExistsAttributeProduct(); 
    });

    /**
    |-----------------------------------
    | Remove image product
    |-----------------------------------
    */
    $(document).on("click","div.wrapper-image span.glyphicon",function() {
        var source = $(this).attr('data-source');
        $("div#item-image-delete").append('<input type="hidden" name="txtImageDelete[]" value="'+source+'">');
        $(this).parent().parent().parent().remove();
        // get new stt for input radio product image
        getNewSttForImage();
        l = $("div#img-edit").find('div.wrapper-image').length;
        if (l == 0 && checkExistsUploadImage() == 0) {
            $("div#show-image-product").hide();
        } else {
            $("div#show-image-product").show();
        }
    });

    /**
    |----------------------------------------
    | FIND IMAGE DEFAULT
    |---------------------------------------
    */
    $(document).on("ifChecked","div.find-img-default input[type=radio]",function() {
        var stt = $(this).attr('data-stt');
        $("input[name=defaultImageMain]").val(stt);
    });
});
</script>