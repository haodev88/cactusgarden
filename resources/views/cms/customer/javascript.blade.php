<script type="text/javascript">
    $(document).on('change','select[name=sltCity]',function() {
        var tag   = $('select[name=sltDistrict]');
        tag.html('<option value="0">Chọn</option>');
        $('select[name=sltWard]').html('<option value="0">Chọn</option>');
        var value = $(this).val();
        var url   = '{{ Route('get_district') }}';
        loadAjaxDistirct(url,tag,value);
    });

    $(document).on('change','select[name=sltDistrict]',function() {
        var value = $(this).val();
        var tag   = $('select[name=sltWard]');
        tag.html('<option value="0">Chọn</option>');
        var url   = '{{ Route('get_ward') }}';
        loadAjaxWard(url,tag,value);
    });
</script>