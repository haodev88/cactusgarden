@extends('cactus._include.master')
@section('title_page', 'Đặt hàng')
@section('content')
    <!--Breadcrumb Area Start-->
    @include('cactus._include.breadcrumb')
    <!--Breadcrumb Area End-->
    <!--Checkout Area Strat-->
    <form method="POST" action="{{ route("post-infomation") }}" accept-charset="UTF-8" name="fCheckout" data-toggle="validator">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <div class="checkout-area pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="checkbox-form">
                        <h3>Địa chỉ giao hàng</h3>
                        <div class="row">
                            <div class="col-md-12">
                                @include("cactus._include.error")
                                <div class="checkout-form-list">
                                    <div class="form-group">
                                        <label class="control-label" for="orderer_name">Họ tên <span class="required">*</span></label>
                                        <input value="" data-error="Vui lòng nhập họ tên" required="required" class="form-control" id="orderer_name" name="orderer_name" type="text">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <div class="form-group">
                                        <label class="control-label">Điện thoại <span class="required">*</span></label>
                                        <input value="01254138820" data-error="Vui lòng nhập điện thoại" required="required" class="form-control" id="orderer_phone" name="orderer_phone" type="text">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="required">*</span></label>
                                        <input value="" required="required" data-error="Vui lòng nhập email" class="form-control" id="orderer_email" name="orderer_email" type="text">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ <span class="required">*</span></label>
                                        <input value="" required="required" data-error="Vui lòng nhập địa chỉ" class="form-control" id="orderer_address" name="orderer_address" type="text">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="country-select clearfix">
                                    <div class="form-group">
                                        <label class="control-label">Tỉnh thành  <span class="required">*</span></label>
                                        <select data-error="Vui lòng chọn tỉnh/thành" required="required" id="dd_province" name="dd_province">
                                            <option value="">Chọn</option>
                                            @if(!empty($province))
                                                @foreach($province as $item)
                                                    <option <?= $item['provinceid'] == 79 ? 'selected' : '' ?> value="{{ $item['provinceid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="country-select clearfix">
                                    <div class="form-group">
                                        <label>Quận / Huyện <span class="required">*</span></label>
                                        <select data-error="Vui lòng chọn quận/huyện" required="required" id="dd_district" name="dd_district">
                                            <option value="">Chọn</option>
                                            @if (!empty($district))
                                                @foreach($district as $item)
                                                    <option <?= $item['districtid'] == 774 ? 'selected' : '' ?> value="{{ $item['districtid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="country-select clearfix">
                                    <div class="form-group">
                                        <label>Phường / Xã <span class="required">*</span></label>
                                        <select data-error="Vui lòng chọn quận/huyện" required="required" id="dd_ward" name="dd_ward">
                                            <option value="">Chọn phường / xã</option>
                                            @if (!empty($ward))
                                                @foreach($ward as $item)
                                                    <option <?= $item['wardid'] == 27310 ? 'selected' : '' ?> value="{{ $item['wardid'] }}">{{ $item['type'].' '.$item['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="different-address">
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Order Notes</label>
                                    <textarea name="params[note]" id="params[note]" cols="30" rows="10" placeholder="Ghi chú đơn hàng"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Món hàng</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="cart-product-name">Sản phẩm</th>
                                    <th class="cart-product-total">Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $t=0; ?>
                                @if(!empty($listCartItems))
                                    @foreach($listCartItems as $_item)
                                        <tr class="cart_item">
                                            <td class="cart-product-name"> {{ $_item["name"] }}<strong class="product-quantity"> × {{ $_item["quanlity"] }}</strong></td>
                                            <td class="cart-product-total"><span class="amount">{!! currentPriceFormat($_item["price"]) !!}</span></td>
                                        </tr>
                                    <?php $t+= $_item["price"]*$_item["quanlity"];  ?>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Tổng tiền</th>
                                        <td><strong><span class="amount">{!! currentPriceFormat($t) !!}</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                    <input value="Đặt hàng" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!--Checkout Area End-->
@endsection

@section('js')
    @include('cactus.order.javascript')
@endsection
