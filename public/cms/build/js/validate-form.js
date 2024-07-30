/**
|-----------------------------------
| CHECK SKU WITH AJAX
|-----------------------------------
| REMEMBER TO SET DATA-HREF
|-----------------------------------
*/
function ExistsSku() {
	var sku  = $("input[name=txtSku]");
	var flag = false;
	if (sku.length != 0 && sku.val() != '') { 
		var href 		= sku.attr('data-href');
		var txtSku  	= sku.val();
		var productId   = (sku.attr('data-productId') && sku.attr('data-productId').length!=0) ? sku.attr('data-productId') : '';
		jQuery.ajaxSetup({async:false});
		$.get(href,{'txtSku':txtSku,'productId':productId}, function(response) {
			if (response == '1') {
				flag = true;
			}
		});
	}
	return flag;
}

/**
|-----------------------------------------
| Check brand For Supplier
|-----------------------------------------
*/
function checkEmptyInputBrand() {
	var appendBrand = $("div#append_brand");
	var flag = false;
	if (appendBrand.length != 0) {
		var check = appendBrand.find('input[type=hidden]');
		if (check.length == 0) {
			flag = true;
		}
	}
	return flag;
}

/**
|------------------------------------------
| get all function check data after submit
|------------------------------------------
| REMEMBER TO SET DATA-HREF
|------------------------------------------
*/
function checkAllInputBeforeSubmit() {
	var isOk = true;
	// check exists data
	if (ExistsSku() == true) {
		alert("Sku này đã tồn tại");
		$("input[name=txtSku]").focus();
		isOk = false;
	} else if (checkEmptyInputBrand() == true) { // check empty Brand
		alert('Phải chọn ít nhất 1 thương hiệu');
		isOk = false;
	}
	return isOk;
}


/* =============================================================================================== */
// $(function() { $('form#formInput').validator(); });
$('#formInput').validator({}).on('submit', function (e) {
    if (!(e.isDefaultPrevented())) {
    	var isOk = checkAllInputBeforeSubmit();
    	if (isOk == false) {
    		return false;
    	}
    }
});
