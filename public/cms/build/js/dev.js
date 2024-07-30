/**
|-----------------------------------
| SELECT-2 FUNCTION
|-----------------------------------
*/
$(document).ready(function() {
    $(":input").inputmask();
});


$.extend($.fn.select2.defaults.defaults.language, {
    noResults: function() {return 'Chưa có dữ liệu'; }
});
/**
|-----------------------------------
| SELECT-2 FUNCTION
|-----------------------------------
*/
function callSelect2() {
	$(".select2_single").select2({
	    placeholder: "Chọn dữ liệu",
	    allowClear: true
	});
}
callSelect2();

/**
|-----------------------------------
| CALL CKEDITOR FUNCTION
|-----------------------------------
*/
function callCkeditor(name) {
	$(function () {
        CKEDITOR.replace(name,{
            filebrowserBrowseUrl      : '/cms/build/ckfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl : '/cms/build/ckfinder/browse.php?opener=ckeditor&type=images',
            filebrowserFlashBrowseUrl : '/cms/build/ckfinder/browse.php?opener=ckeditor&type=flash',
            filebrowserUploadUrl      : '/cms/build/ckfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl : '/cms/build/ckfinder/upload.php?opener=ckeditor&type=images',
            filebrowserFlashUploadUrl : '/cms/build/ckfinder/upload.php?opener=ckeditor&type=flash'
        }).config.allowedContent = true;
    });
}

/**
|-------------------------------------
| FUNCTION LOAD ICHECK
|-------------------------------------
*/
function loadIcheck() {
    $('input.flat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
}

/**
|-------------------------------------
| FUNCTION READ URL IMAGE
|-------------------------------------
| input  => this
| tag_id => id of images display
| width  => width of image when show
|-------------------------------------
*/
function readURL(input,tag_id,width,tagShowHide) {
    if (input.files && input.files[0]) {
        var t = input.files[0].type;
        var s = t.substr(0,t.indexOf("/"));
        if (s == 'image') {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('img#'+tag_id).attr('src', e.target.result).width(width);
                $(tagShowHide).show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            var id = input.id;
            var control = $("input#"+id);
            control.replaceWith( control = control.clone( true ) );
        }
    }
}

/**
|-----------------------------------------
| FUNCTION SHOW OR HIDE WARP SINGLE IMAGE
|-----------------------------------------
*/

function showOrHideWarpImg(imgId, warpHide) {
    var source = $("img#"+imgId).attr('src');
    if (source == '/cms/images/blank.gif' || source == '') {
        $(warpHide).hide();
    } else {
        $(warpHide).show();
    }
}

/**
|--------------------------------------------
| FUNCTION CREATE DATEPICKER
|--------------------------------------------
*/
function createDatePicker(id) {
    $('#'+id).daterangepicker({
        format: 'DD/MM/YYYY',
        singleDatePicker: true,
        calender_style: "picker_1"
    }, function(start, end, label) {
        // console.log(start.toISOString(), end.toISOString(), label);
    });
}

/**
|--------------------------------------------
| FUNCTION load District
|--------------------------------------------
*/

function loadAjaxDistirct(url,tag,value) {
    tag.html('<option value="0">Chọn</option>');
    tag.html('<option value="0">Chọn</option>');
    $.get(url,{'id':value}, function(response) {
        if (response!="") {
            response = JSON.parse(response);
            var options = '';
            for (x in response) {
                options+='<option value="'+response[x].districtid+'">'+response[x].name+'</option>';
            }
            tag.html(options);
            callSelect2();
        }
    });
}

/**
 |--------------------------------------------
 | FUNCTION load District
 |--------------------------------------------
 */
function loadAjaxWard(url,tag,value) {
    $.get(url,{'id':value}, function(response) {
        if (response!="") {
            response = JSON.parse(response);
            var options = '';
            for (x in response) {
                options+='<option value="'+response[x].wardid+'">'+response[x].name+'</option>';
            }
            tag.html(options);
            callSelect2();
        }
    });
}

function confirmMess(mess) {
    if (!window.confirm(mess)) {
        return false;
    } else {
        return true;
    }
}

/*
$(document).ready(function() {
    $.fn.test = function(option) {
        var setting = $.extend({
            color : '#556b2f',
            backgroundColor: "green"
        },option);

        return this.css({
            color               : setting.color,
            backgroundColor     : setting.backgroundColor
        });
    }
});
*/


