<!--Breadcrumb Area Start-->
<style type="text/css">
    .breadcrumb-bg {
        background-image : url("{{ $breadcrumb["bg"] }}");
    }
</style>
<!--Breadcrumb Area Start-->
<div class="breadcrumb-area pb-80">
    <div class="row">
        <div class="col-12">
            {!! templateBreadcrumb($breadcrumb["items"], $breadcrumb["title"]) !!}
        </div>
    </div>
</div>
