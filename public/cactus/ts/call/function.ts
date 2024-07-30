/// <reference path="jquery.d.ts" />
function callAjax(obj:any) {
    var response:string = '';
    $.ajax({
        "url"       : obj.url,
        "type"      : obj.type,
        "data"      : obj.data,
        "async"     : obj.async,
        "success"   : function (res) {
            response = res;
        }
    });
    return response;
}