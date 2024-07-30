<style type="text/css">
    .breadcrumb-bg {
        background-image : url("{{ $breadcrumb["bg"] }}");
    }
</style>
<div class="breadcrumb-area pb-80">
    {!! templateBreadcrumb($breadcrumb["items"], $breadcrumb["title"]) !!}
</div>
