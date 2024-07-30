/// <reference path="call/jquery.d.ts" />
/// <reference path="call/function.ts" />
var shopping = (function () {
    function shopping() {
    }
    shopping.prototype.addCart = function (data) {
        var result = "";
        result = callAjax({
            "url": "/shopping/add",
            "type": "post",
            "data": data,
            "async": false
        });
        return result;
    };
    shopping.prototype.updateCart = function (data) {
        var result = "";
        result = callAjax({
            "url": "/shopping/update",
            "type": "post",
            "data": data,
            "async": false
        });
        return result;
    };
    shopping.prototype.deleteCart = function (data) {
        var result = "";
        result = callAjax({
            "url": "/shopping/delete",
            "type": "post",
            "data": data,
            "async": false
        });
        return result;
    };
    return shopping;
}());
