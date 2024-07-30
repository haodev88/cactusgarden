@extends('cms.master')
@section('title','Danh sách các thuộc tính')
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
                            <h2>Danh sách các thuộc tính</h2>
                            <div class="pull-right" style="vertical-align: middle">
                                <a class="btn btn-success btn-sm btn-add" href="{!! route('admin_shop.option.create') !!}">
                                    Thêm thuộc tính
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title" style="width:20%;">STT</th>
                                            <th class="column-title">Nhóm</th>
                                            <th class="column-title">Tên</th>
                                            <th class="column-title">Ngày tạo </th>
                                            <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <form action="{!! Route('search-option') !!}" method="get">
                                            <td colspan="2">
                                                <select class="select2_single form-control" name="option_group" id="option_group">
                                                    <option value="">Chọn</option>
                                                    @if(!empty($optionGroup))
                                                        @foreach($optionGroup as $group)
                                                            <option <?= (isset($input['option_group']) && $input['option_group'] == $group->id) ? 'selected="selected"' : '' ?> value="{!! $group->id !!}">{!! $group->name !!}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td colspan="1">
                                                <input value="<?= isset($input['option_name']) ?  $input['option_name'] : '' ?>" placeholder="Nhập tên thuộc tính cần tìm" name="option_name" type="text" class="form-control" />
                                            </td>
                                            <td>&nbsp;</td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Lọc dữ liệu</button></td>
                                        </form>    
                                    </tr>
                                    <tbody style="border-top:none;">
                                        @foreach ($listOption as $item)
                                        <?php $stt++; ?>
                                        <tr class="even pointer">
                                            <td class=" ">{!! $stt !!}</td>
                                            <td class=" ">{!! $item->optionGroup->name !!}</td>
                                            <td class=" ">{!! $item->name !!}</td>
                                            <td class=" ">{!! date("d-m-Y H:i:s",strtotime($item->created_at)) !!}</td>
                                            <td class=" ">{!! loadAction($item->id,'option') !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(isset($append) && !empty($append))
                                @include('cms.blocks.paginate', ['paginator' => $listOption->appends($append)])
                            @else
                                @include('cms.blocks.paginate', ['paginator' => $listOption])
                            @endif    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <!-- /page content -->
@endsection