@extends('cactus._include.master')
@section('title_page', 'About us')
@section('content')
    <!--Breadcrumb Area End-->
    <!--Breadcrumb Area End-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <div id="information-information" class="container">
        <div class="row">
            <div class="col-order">
                <div id="content" class="col-sm-12">
                    {!! $aboutUs->content !!}
                </div>
            </div>
        </div>
    </div>

@endsection


