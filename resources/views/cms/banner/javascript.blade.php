<script type="text/javascript">
    $(function() {
        var template =
        `
            <div class="dz-preview dz-file-preview">
                <div class="dz-image" style="width: 250px; border-radius:0px;"><img data-dz-thumbnail /></div>
                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size></span></div>
                    <div class="dz-filename"><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="form-group" style="margin-top: 10px;">
                    <p><input name="txtLink[]" class="form-control txtLink" type="text" placeholder="Link banner"></p>
                    <p><textarea class="form-control" name="desc"></textarea></p>
                </div>
              </div>
        `;
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#uploadBanner", {
            autoProcessQueue : false,
            parallelUploads  : 10,
            thumbnailWidth   : 300,
            thumbnailHeight  : null,
            dictDefaultMessage: "Chọn hình ảnh",
            acceptedFiles   : "image/jpeg,image/png,image/gif",
            previewTemplate : template,
            uploadMultiple: true,
            init: function() {
                this.on("success", function(file, responseText) {
//                    console.log(responseText);
                    window.location.reload();
                });
            }
        });

        $('#imgsubbutt').click(function(){
            myDropzone.processQueue();
        });


        $(document).on("click","a.edit-banner", function () {
            var parent = $(this).closest("div.banner-position");
            var link   = parent.find("div.link-banner").html();
            var desc   = parent.find("div.desc-banner").html();
            var oldBanner = parent.find("div.old-banner").html();
            var id     = parent.attr("data-id");
            $("input[name=link_edit]").val(link);
            $("input[name=id_banner]").val(id);
            $("input[name=old_banner]").val(oldBanner);
            $("textarea[name=desc_edit]").html(desc);

        });

    });
</script>
