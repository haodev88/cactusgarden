/// <reference path="call/jquery.d.ts" />
/// <reference path="call/function.ts" />
var Area = (function () {
    function Area() {
    }
    Area.prototype.district = function (data) {
        var result = "";
        result = callAjax({
            url: '/get-district',
            type: 'get',
            data: data,
            async: false
        });
        return result;
    };
    Area.prototype.ward = function (data) {
        var result = '';
        result = callAjax({
            url: '/get-ward',
            type: 'get',
            data: data,
            async: false
        });
        return result;
    };
    return Area;
}());
//# sourceMappingURL=area.js.map