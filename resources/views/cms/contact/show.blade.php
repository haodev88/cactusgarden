@extends('cms.master')
@section('title','Chi Tiết Liên Hệ')
@section('main_content')
	<div class="right_col" role="main">
        <div class="row">
        	<div class="col-md-12">
			    <div class="x_panel">
			        <div class="x_title">
			            <p>Họ tên </p>
			            <p>Họ tên : {{ $contact->name }}</p>
			        
			            <div class="clearfix"></div>
			        </div>
			        <div class="x_content">
			            <div class="bs-example" data-example-id="simple-jumbotron">
			                <div class="jumbotron">
			                    <h1>Hello, world!</h1>
			                    <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			                </div>
			            </div>

			        </div>
			    </div>
			</div>
        </div>
	</div>   
@endsection