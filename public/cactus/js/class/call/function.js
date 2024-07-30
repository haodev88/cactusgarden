/// <reference path="jquery.d.ts" />
function callAjax(obj) {
    var response = '';
    $.ajax({
        "url": obj.url,
        "type": obj.type,
        "data": obj.data,
        "async": obj.async,
        "success": function (res) {
            response = res;
        }
    });
    return response;
}
