@extends('cactus._include.master')
@section('title_page', 'Blog')
@section('content')
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Blog Area Start-->
    <div class="blog-area pb-50">
        <div class="container">
            <div class="row">
                @if($blogs->count()!=0)
                    @foreach ($blogs as $_item)
                        <div class="col-md-6">
                            <!--Single Blog Start-->
                            <div class="single-blog mb-30">
                                <div class="blog-img img-full">
                                    <a href="{{ route("blog-detail",["slug"=>$_item["slug"], "id"=>$_item["id"]]) }}"><img src="{{ URL::to("/").Config("global.root_media")."blogs/".$_item["image"] }}" alt=""><span class="icon-view"></span></a>
                                </div>
                                <div class="blog-content">
                                    <h3 class="blog-title"><a href="{{ route("blog-detail",["slug"=>$_item["slug"], "id"=>$_item["id"]]) }}">{{ $_item->title }}</a></h3>
                                    <div class="blog-meta">
                                        <p class="author-name">post by: <span>{{ $_item["author"] }}</span> {{ $_item["updated_at"] }}</p>
                                    </div>
                                    <div class="blog-des">
                                        {!! $_item->short_desc !!}
                                    </div>
                                    <a class="read-btn" href="{{ route("blog-detail",["slug"=>$_item["slug"], "id"=>$_item["id"]]) }}">Xem Thêm</a>
                                </div>
                            </div>
                            <!--Single Blog End-->
                        </div>
                    @endforeach
                @endif
            </div>
            <!--Pagination Start-->
            @if(isset($append) && !empty($append))
                @include('cactus._include.paginate', ['paginator' => $blogs->appends($append)]);
            @else
                @include('cactus._include.paginate', ['paginator' => $blogs])
            @endif
        <!--Pagination End-->
        </div>
    </div>
    <!--Blog Area End-->
@endsection


