<script type="text/javascript">
    var orderId = '{{ $order['id'] }}';
    $(document).ready(function() {
        /**
         * Change status tracking order
         */
        $(document).on("change","select#sltOrderStatus",function(e,i) {
            var status = $(this).find('option:selected').val();
            $.get('{{ route('save_order_status') }}',{'status':status,'orderId':orderId}, function(response) {
                if (response.status == 1) {
                    $('ul#result_html_tracking').html(response.html_tracking);
                }
            });
        });

        $(document).on('change','select#sltCityFrom',function () {
            var tag   = $('select[name=sltDistrictFrom]');
            tag.html('<option value="0">Chọn</option>');
            $('select[name=sltWardFrom]').html('<option value="0">Chọn</option>');
            var value = $(this).val();
            var url   = '{{ Route('get_district') }}';
            loadAjaxDistirct(url,tag,value);
        });

        $(document).on('change','select[name=sltDistrictFrom]',function() {
            var value = $(this).val();
            var tag   = $('select[name=sltWardFrom]');
            tag.html('<option value="0">Chọn</option>');
            var url   = '{{ Route('get_ward') }}';
            loadAjaxWard(url,tag,value);
        });

        $(document).on('change','select#sltCityTo',function () {
            var tag   = $('select[name=sltDistrictTo]');
            tag.html('<option value="0">Chọn</option>');
            $('select[name=sltWardTo]').html('<option value="0">Chọn</option>');
            var value = $(this).val();
            var url   = '{{ Route('get_district') }}';
            loadAjaxDistirct(url,tag,value);
        });

        $(document).on('change','select[name=sltDistrictTo]',function() {
            var value = $(this).val();
            var tag   = $('select[name=sltWardTo]');
            tag.html('<option value="0">Chọn</option>');
            var url   = '{{ Route('get_ward') }}';
            loadAjaxWard(url,tag,value);
        });


        $(document).on('click','button#btn-edit-info',function() {
            var data = $('form[name=formDeliveryInfo]').serialize();
                data+='&order_id='+orderId;
            $.ajax({
                "url"   : '{{ Route('changeOrderInfo') }}',
                "type"  : 'post',
                'data'  :  data,
                'async' :  true,
                'success':function(response) {
                    if (response.status == 1) {
                        alert(response.mess);
                    }
                }
            })
        });

        $(document).on('blur','input#txtSku',function() {
            var sku = $(this).val();
            $('div#product_option').remove();
            if (sku != '') {
                $.get('{{ route('chooseOption') }}',{'sku':sku},function (response) {
                    if (response!='') {
                        $('div#append_after').after(response);
                        callSelect2();
                    }
                });
            }
        });

        $(document).on('click','button#btn-add-product-action',function() {
            var data = $('form[name=form-add-product]').serialize();
                data+='&orderId='+orderId;
            $.get('{{ Route('addOrderProduct') }}',data, function(response) {
                if (response.status == 1) {
                    window.location.reload();
                } else {
                    alert(response.mess);
                }
            });
        });


        $(document).on('click','a#edit-quanlity',function(e) {
            e.preventDefault();
            var id              = $(this).attr('data-id');
            var quanlity        = $(this).parent().parent().find('input[type=number]').val();
                quanlity        = parseInt(quanlity);
                quanlity        = (quanlity < 0) ? 1 : quanlity;
            $.get('{{ route('editQuanlity') }}',{id:id,'quanlity':quanlity},function(response) {
                if (response.status == 1) {
                    window.location.reload();
                } else {
                    alert(response.mess);
                }
            });
        });


        $(document).on("click","a#delete-item",function() {
            if (!confirmMess('Bạn có chắc xóa không')) return false;
            var id = $(this).attr('data-id');
            $.get('{{ route('deleteItem') }}',{'id':id},function(response) {
                if (response.status == 1) {
                    window.location.reload();
                } else {
                    alert(response.mess);
                }
            });
        });

    });
</script>