<script type="text/javascript">
    // checkbox with delivery
    $(function() {
        $(document).on("click",'input[name=same_as_billing]',function() {
            $('div#dd_info').toggle();
            if (!$(this).prop('checked')) {
                $('div#dd_info').find('input,select').attr('required','required');
            } else {
                $('div#dd_info').find('input,select').removeAttr('required');
                // $("form[name=fCheckout]").bootstrapValidator('resetForm', true);
                $('form[name=fCheckout]').validator('validate')
            }
        });
    });

    // Area such as provice,ward,district
    $(document).on("change","select#dd_province",function () {
        $('select#dd_ward').html('<option value="">Chọn</option>').niceSelect("update");
        var id     = $(this).val();
        var option = getDistrict(id);
        // $('select#dd_district').html(option).niceSelect("update");

    });

    $(document).on('change','select#dd_district',function () {
        var id      = $(this).val();
        var option  = getWard(id);
        // $('select#dd_ward').html(option).niceSelect("update");

    });
    /*
    $(document).on("change","select#dd_province",function () {
        $('select#dd_ward').html('<option value="">Chọn</option>');
        var id     = $(this).val();
        var option = getDistrict(id);
        $('select#dd_district').html(option);
    });
    */
    /*
    $(document).on('change','select#dd_district',function () {
        var id      = $(this).val();
        var option  = getWard(id);
        $('select#dd_ward').html(option);
    });
    */

</script>
