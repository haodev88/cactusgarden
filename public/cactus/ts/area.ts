/// <reference path="call/jquery.d.ts" />
/// <reference path="call/function.ts" />
class Area {
    district(data:any):any {
        var result:string = "";
        result = callAjax({
            url     : '/get-district',
            type    : 'get',
            data    : data,
            async   : false,
        });
        return result;
    }

    ward(data:any):any {
        var result:string = '';
        result = callAjax({
            url     : '/get-ward',
            type    : 'get',
            data    : data,
            async   : false,
        });
        return result;
    }

}