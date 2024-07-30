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

function getDistrict(id) {
    var area   = new Area();
    var result = area.district({'id':id});
    var option = '<option value="">Chọn</option>';
    for (x in result) {
        option+= '<option value="'+result[x].districtid+'">'+result[x].type+' '+result[x].name+'</option>';
    }
    return option;
}

function getWard(id) {
    var area    = new Area();
    var result  = area.ward({id:id});
    var option = '<option value="">Chọn</option>';
    for (x in result) {
        option+= '<option value="'+result[x].wardid+'">'+result[x].type+' '+result[x].name+'</option>';
    }
    return option;
}

function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function currentPriceNumber(number, decimals, dec_point, thousands_sep) {
    if (number == 0) {
        return number;
    }
    return number_format(number, decimals, dec_point, thousands_sep)+" <sup>VND</sup>";
}

// left menu
function _sideNav() {
    jQuery("div.side-nav").each(function() {
        var e = jQuery("ul.list-group", this);
        var h = jQuery(".side-nav-head", this);
        jQuery("button", this).bind("click", function() {

            e.slideToggle(300);
            h.toggleClass('in');
        });
    });

    jQuery("div.side-nav ul>li>a.dropdown-toggle").bind("click", function(e) {
        e.preventDefault(), jQuery(this).next("ul").slideToggle(200), jQuery(this).closest("li").toggleClass("active");
    });

    var navActive = $("li.list-group-item.active");
    var firstItem = navActive.closest("li.first-item");
    firstItem.find("ul").show();
    firstItem.addClass("active");
    navActive.closest("ul").prev().parent().addClass("active");
}
_sideNav();
