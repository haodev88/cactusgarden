@extends('cactus._include.master')
@section('title_page', 'Page')
@section('content')

    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--/Breadcrumb-->

    <!--page Area Start-->
    <div class="page-area pb-55">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--page Start-->
                        {!! $page->content !!}
                    <!--page End-->
                </div>

            </div>
        </div>
    </div>
    <!--page Area End-->
@endsection


