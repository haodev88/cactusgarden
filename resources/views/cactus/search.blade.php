@extends('cactus._include.master')
@section('title_page', 'Tìm kiếm')
@section('content')
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
<!--Shop Area Start-->
<div class="shop-area pb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="shop-layout">
                    <!--Grid & List View Start-->
                    <div class="shop-topbar-wrapper d-md-flex justify-content-md-between align-items-center">
                        <div class="grid-list-option">&nbsp;</div>
                        <!--Toolbar Short Area Start-->
                        <form name="sort-by" id="sort-by" method="get" action="{{ $sortAction }}">
                            <div class="toolbar-short-area d-md-flex align-items-center">
                                <div class="toolbar-shorter">
                                    <select id="sort_by" name="sort_by" class="wide" style="display: none;">
                                        <option>Chọn</option>
                                        @if($sortValue != null)
                                            <option value="">Bỏ chọn</option>
                                        @endif
                                        @foreach($sortOptions as $name => $_item)
                                            @if(isset($params["sort_by"]) && $params["sort_by"] == $name)
                                                <option selected data-display="Select" value="{{ $name }}">{{ $_item }}</option>
                                            @else
                                                <option value="{{ $name }}">{{ $_item }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="nice-select wide" tabindex="0">
                                        <span class="current">{{ $sortValue!=null ? $sortValue : 'Chọn' }}</span>
                                        <ul class="list">
                                            @if($sortValue != null)
                                                <li data-value="" class="option">Bỏ chọn</li>
                                            @endif
                                            @foreach($sortOptions as $name => $_item)
                                                @if(isset($params["sort_by"]) && $params["sort_by"] == $name)
                                                    <li data-display="Select" data-value="{{ $name }}" class="option selected">{{ $_item }}</li>
                                                @else
                                                    <li data-value="{{ $name }}" class="option">{{ $_item }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @if(isset($append) && !empty($append))
                                @foreach ($append as $name=>$_item)
                                    @if($name!="sort_by")
                                        <input type="hidden" name="{{ $name }}" value="{{ $_item }}" />
                                    @endif
                                @endforeach
                            @endif
                        </form>
                        <!--Toolbar Short Area End-->
                    </div>
                    <!--Grid & List View End-->
                    <!--Shop Product Start-->
                    <div class="shop-product">
                        <div id="grid" class="tab-pane fade show active">
                            <div class="product-grid-view">
                                <div class="row">
                                    @foreach($listProduct as $_item)
                                    <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6">
                                        <!--Single Product Area Start-->
                                        {!! templateProductItem($_item) !!}
                                        <!--Single Product Area End-->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--Pagination Start-->
                        @if(isset($append) && !empty($append))
                            @include('cactus._include.paginate', ['paginator' => $listProduct->appends($append)])
                        @else
                            @include('cactus._include.paginate', ['paginator' => $listProduct])
                        @endif
                        <!--Pagination End-->
                    </div>
                    <!--Shop Product End-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--Shop Area End-->
    @foreach ($listProduct as $_item)
        <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6">
            <!--Single Product Area Start-->
            {!! templateModalProduct($_item) !!}
        </div>
    @endforeach
@endsection

@section("js")
    <script type="text/javascript">
        $(function() {
            $("a.quick-view").on("click", function () {
                var id = $(this).attr("data-id");
                $("div.modal-product-"+id).modal();
            });

            $("select#sort_by").on("change", function () {
                $("form[name=sort-by]").submit();
            });
        });
    </script>
@endsection
