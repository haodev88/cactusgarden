$(function() {
    $("button.add-cart").on("click",function () {
        var frm = $(this).closest('form.frmAddCart');
        var number = frm.find('input[name=number]').val();
        if (number <=0) {
            number = 1;
        } else if (number > 30) {
            number = 30;
        }
        frm.find('input[name=number]').val(number);
        var data     = frm.serialize();
        var sltColor = '', sltSize = '';
        if ($('select#sltColor').length) {
            sltColor = $('select#sltColor').val();
        }
        if ($('select#sltSize').length) {
            sltColor = $('select#sltSize').val();
        }
        data = data+'&sltColor='+sltColor+'&sltSize='+sltSize;
        var s        = new shopping();
        var result   = JSON.parse(s.addCart(data));
        if (!result.hasOwnProperty('error')) {
            var totalCart = 0;
            var cartPrice = 0;
            var tempAppend = "";
            var x = null;
            for (x in result) {
                var template = $("script#header-cart").html();
                template = template.replace(/{IMAGE}/g, mediaPath+result[x].default_image);
                template = template.replace(/{NAME}/g, result[x].name);
                template = template.replace(/{QUANTIY}/g, result[x].quanlity);
                template = template.replace(/{PRICE}/g, currentPriceNumber(result[x].price,0,'.','.'));
                template = template.replace(/{KEY}/g, x);
                totalCart+= parseInt(result[x]['quanlity']);
                var price = parseInt(result[x]['quanlity'])*parseInt(result[x].price);
                cartPrice+=price;
                tempAppend+=template;
            }
            $("span.float-right").html(currentPriceNumber(cartPrice,0,'.','.'));
            $("li.mini-cart span.cart-quantity").html(totalCart);
            $("li.mini-cart span.mini-cart-total").html(currentPriceNumber(cartPrice,0,'.','.'));
            $("div.cart-total").show();
            $("div.cart-btn").show();
            $("ul.cart-items").html(tempAppend);
            $("body,html").animate({"scrollTop":"0"},"slow");
            return false;
        }
    });

    $(document).on("click","button.update-qty",function () {
        var data     = $(this).closest('form');
        var s        = new shopping();
        var result   = s.updateCart(data.serialize());
        var cart     = result.cart;

        $('tbody#cart-items tr').remove();
        // update template left cart
        var tem = '';
        var totalCart = 0;
        var cartPrice = 0;
        var tempAppend = "";

        for (var i=0;i<cart.length;i++) {
            var template = $('script#template-cart').html();
            template = template.replace(/{NAME}/g, cart[i].name);
            template = template.replace(/{SRC}/g, cart[i].default_image);
            template = template.replace(/{LINK}/g, '/chi-tiet-san-pham/'+cart[i].slug+'-'+cart[i].id);
            template = template.replace(/{BRAND_NAME}/g, cart[i].brand_name);
            template = (cart[i].size!='') ? template.replace(/{SIZE}/g, '| '+cart[i].size) : template.replace(/{SIZE}/g, '');
            template = (cart[i].color!='') ? template.replace(/{COLOR}/g, '| '+cart[i].color) : template.replace(/{COLOR}/g, '');
            template = template.replace(/{PRICE}/g, cart[i].price);
            template = template.replace(/{TOTAL_PRICE}/g, cart[i].total_price);
            template = template.replace(/{ID}/g, cart[i].id);
            template = template.replace(/{KEY}/g,i);
            template = template.replace(/{QUANLITY}/g,cart[i].quanlity);
            template = template.replace(/{ACTION}/g,result.formAction);
            template = template.replace(/{TOKEN}/g,result.csrfToken);
            template = template.replace(/{REL}/g,i);
            tem+=template;

            var headerCart = $("script#header-cart").html();
            headerCart = headerCart.replace(/{IMAGE}/g, cart[i].default_image);
            headerCart = headerCart.replace(/{NAME}/g,  cart[i].name);
            headerCart = headerCart.replace(/{QUANTIY}/g, cart[i].quanlity);
            headerCart = headerCart.replace(/{PRICE}/g, cart[i].price);
            headerCart = headerCart.replace(/{KEY}/g, i);
            totalCart+= parseInt(cart[i].quanlity);
            tempAppend+= headerCart;
        }
        $('tbody#cart-items').html(tem);
        // update template bottom cart
        $("span#subtotal-cart").html(result.subTotal);
        $("span#total-cart").html(result.subTotal);

        // update header cart
        $("span.float-right").html(result.subTotal);
        $("li.mini-cart span.cart-quantity").html(totalCart);
        $("li.mini-cart span.mini-cart-total").html(result.subTotal);
        $("div.cart-total").show();
        $("div.cart-btn").show();
        $("ul.cart-items").html(tempAppend);


        return false;
    });


    $(document).on('click','a.remove_item',function() {

        var key    = $(this).attr('data-rel');
        var s      = new shopping();
        var result = s.deleteCart({
            'key'     : key,
            '_token'  : $('meta[name="csrf-token"]').attr('content')
        });

        // $(this).closest('div.cart-item').remove();
        if (result.length!=0) {
            $('tbody#cart-items tr').remove();
            var cart = result.cart;
            var totalCart = 0;
            var cartPrice = 0;
            var tempAppend = "";
            var x = null;
            var tem = '';
            for (x in cart) {
                if ($('script#template-cart').length!=0) {
                    var template_cart = $('script#template-cart').html();
                    template_cart = template_cart.replace(/{NAME}/g, cart[x].name);
                    template_cart = template_cart.replace(/{SRC}/g, cart[x].default_image);
                    template_cart = template_cart.replace(/{LINK}/g, '/chi-tiet-san-pham/'+cart[x].slug+'-'+cart[x].id);
                    template_cart = template_cart.replace(/{BRAND_NAME}/g, cart[x].brand_name);
                    template_cart = (cart[x].size!='') ? template_cart.replace(/{SIZE}/g, '| '+cart[x].size) : template_cart.replace(/{SIZE}/g, '');
                    template_cart = (cart[x].color!='') ? template_cart.replace(/{COLOR}/g, '| '+cart[x]) : template_cart.replace(/{COLOR}/g, '');
                    template_cart = template_cart.replace(/{PRICE}/g, cart[x].price);
                    template_cart = template_cart.replace(/{TOTAL_PRICE}/g, cart[x].total_price);
                    template_cart = template_cart.replace(/{ID}/g, cart[x].id);
                    template_cart = template_cart.replace(/{KEY}/g,x);
                    template_cart = template_cart.replace(/{QUANLITY}/g,cart[x].quanlity);
                    template_cart = template_cart.replace(/{ACTION}/g,result.formAction);
                    template_cart = template_cart.replace(/{TOKEN}/g,result.csrfToken);
                    template_cart = template_cart.replace(/{REL}/g,x);
                    tem+=template_cart;
                }

                console.log(tem);

                var template = $("script#header-cart").html();
                template = template.replace(/{IMAGE}/g, cart[x].default_image);
                template = template.replace(/{NAME}/g, cart[x].name);
                template = template.replace(/{QUANTIY}/g, cart[x].quanlity);
                template = template.replace(/{PRICE}/g, cart[x].price);
                template = template.replace(/{KEY}/g, x);
                totalCart+= parseInt(cart[x]['quanlity']);
                var price = parseInt(cart[x]['quanlity'])*parseInt(cart[x].price);
                cartPrice+=price;
                tempAppend+=template;
            }

            if ($('script#template-cart').length!=0) {
                // update shopping-cart
                $('tbody#cart-items').html(tem);
                // update template bottom cart
                $("span#subtotal-cart").html(result.subTotal);
                $("span#total-cart").html(result.subTotal);

            }

            $("li.mini-cart span.cart-quantity").html(result.totalItem);
            $("li.mini-cart span.mini-cart-total").html(result.subTotal);
            $("div.cart-total").show();
            $("div.cart-btn").show();
            $("ul.cart-items").html(tempAppend);
            $("body,html").animate({"scrollTop":"0"},"slow");
            return false;
        } else {
            window.location.reload();
        }

    });


});
