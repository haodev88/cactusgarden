@extends('cms.master')
@section('title','Danh sách Liên hệ khách hàng')
@section('main_content')
	<div class="right_col" role="main">
        <div class="row">
        	<div class="col-md-12">
			    <div class="x_panel">
			        <div class="x_content">
			            <ul class="list-unstyled timeline">
			            	@foreach($listContact as $item)
				                <li>
				                    <div class="block">
				                        <div class="tags">
				                            <a href="javascript:void(0);" class="tag" title="{{ $item->name  }}">
				                                <span>{{ $item->name }}</span>
				                            </a>
				                        </div>
				                        <div class="block_content">
				                            <h2 class="title">{{ $item->email }}, {{ $item->phone }}</h2>
				                            <div class="byline">
				                                <span>{{ date("d/m/Y H:i",strtotime($item->created_at)) }}</span>
				                            </div>
				                            <p class="excerpt">{!! $item->content !!} 
				                            	<a href="{{ route('admin_shop.contact.show',['id'=>1]) }}">Xem&nbsp;thêm</a>
				                            </p>
				                        </div>
				                    </div>
				                </li>
			                @endforeach
			            </ul>
			        </div>
			        @if(isset($append) && !empty($append))
	                	@include('cms.blocks.paginate', ['paginator' => $listContact->appends($append)])
	            	@else
	                	@include('cms.blocks.paginate', ['paginator' => $listContact])
	            	@endif
			    </div>
			</div>
        </div>
	</div>       
@endsection