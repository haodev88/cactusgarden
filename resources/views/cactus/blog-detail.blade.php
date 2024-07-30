@extends('cactus._include.master')
@section('title_page', $blog->slug)
@section('og')
    <meta property="og:image" content="{{ URL::to("/").Config("global.root_media")."blogs/".$blog->image }}" />
@endsection
@section('content')
    <style type="text/css">
        .breadcrumb-bg {
            background-image : url("{{ $breadcrumb["bg"] }}");
        }
    </style>
    <!--Breadcrumb Area Start-->
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Blog Area Start-->
    <div class="blog-area pb-30">
        <div class="container">
            <div class="row">
                <!--Blog Post Start-->
                <div class="col-lg-12">
                    <div class="blog_area">
                        @if($blog)
                            <article class="blog_single blog-details">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        {{ $blog->title }}
                                    </h2>
                                    <span class="post-author">
                                        <span class="post-by"> Đăng bởi : </span> {{ $blog->author }} </span>
                                    <span class="post-separator">|</span>
                                    <span class="post-date"><i class="fas fa-calendar-alt"></i>{{ $blog->created_at }} </span>
                                </header>
                                <div class="post-thumbnail img-full">
                                    <img src="{{ URL::to("/").Config("global.root_media")."blogs/".$blog->image }}" alt="{{ $blog->image }}">
                                </div>
                                <div class="postinfo-wrapper">
                                    <div class="post-info">
                                        <div class="entry-summary blog-post-description">
                                            {!! $blog->content !!}
                                            <!--Blog Post Tag-->

                                            <div class="social-sharing">
                                                <div class="widget widget_socialsharing_widget">
                                                    <h3 class="widget-title">Chia sẻ bài viết</h3>
                                                    <ul class="blog-social-icons">
                                                        <li>
                                                            <div class="addthis_toolbox addthis_default_style" data-url="{{ route("blog-detail",["id"=>$blog->id, "slug"=>$blog->slug]) }}">
                                                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                                                <a class="addthis_counter addthis_pill_style"></a>
                                                            </div>
                                                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dbbbff7dbae3a27"></script>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @else
                            <div class="alert alert-warning" role="alert">Chưa có bài viết</div>
                        @endif
                    </div>
                </div>
                <!--Blog Post End-->
            </div>
        </div>
    </div>
    <!--Blog Area End-->
@endsection

