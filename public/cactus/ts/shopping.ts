/// <reference path="call/jquery.d.ts" />
/// <reference path="call/function.ts" />
class shopping {
    addCart(data:any):any {
        var result:string = "";
        result = callAjax({
            "url"   : "/shopping/add",
            "type"  : "post",
            "data"  : data,
            "async" : false,
        });
        return result;
    }

    updateCart(data:any):string {
        var result:string = "";
        result = callAjax({
            "url"   : "/shopping/update",
            "type"  : "post",
            "data"  : data,
            "async" : false,
        });
        return result;
    }

    deleteCart(data:any):string {
        var result:string = "";
        result = callAjax({
            "url"   : "/shopping/delete",
            "type"  : "post",
            "data"  : data,
            "async" : false,
        });
        return result;
    }
}
