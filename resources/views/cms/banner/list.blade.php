@extends('cms.master')
@section('title','Danh sách Banner')
@section('main_content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh sách các danh mục</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title" style="width:20%;">STT</th>
                                        <th class="column-title">Vị trí banner</th>
                                        <th class="column-title">Ngày tạo </th>
                                        <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($listBannerPosition))
                                            @foreach($listBannerPosition as $item)
                                                <?php $stt++; ?>
                                                <tr>
                                                    <td class="">{{ $stt }}</td>
                                                    <td class="">{{ $item->name }}</td>
                                                    <td class="">{{ date('d-m-Y H:s', strtotime($item->created_at)) }}</td>
                                                    <td class="">
                                                        &nbsp;&nbsp;
                                                        <?php
                                                            $params = [
                                                                'link'  => route('admin_shop.banner.show',['id'=>$item->id]),
                                                                'title' => 'Thêm banner'
                                                            ];
                                                        ?>
                                                        {!! loadAction('','banner',true,$params) !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listBannerPosition->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listBannerPosition])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection