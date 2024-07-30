<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Xác nhận đơn hàng #{{ $orderInfo->order_code }}</title>
</head>

<body bgcolor="#f7f7f7" style="padding: 0; margin: 0; font-family:Arial,sans-serif;font-size:13px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7">
        <tr>
            <td height="15">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#cedcda" align="center" style="margin: 0 auto;">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                                <tr>
                                    <td width="15px;">&nbsp; </td>
                                    <td width="118px">
                                        <a href="{{ route('home') }}" target="_blank">
                                            <img src="{{ asset('shop/images/home/logo.png') }}" width="136" border="0" alt="" />
                                        </a>
                                    </td>
                                    <td style="font-size: 13px;font-family: Arial,sans-serif;text-align: right; line-height: 20px; vertical-align: bottom;">
                                        <p style="margin: 0 0 7px">Hotline: <span style="color: #ff9000;font-weight: bold;font-size: 18px;">{{ Config('global')['infomation_shop']['hotline'] }}</span></p>
                                    </td>
                                    <td width="15px;">&nbsp; </td>
                                </tr>
                                <tr>
                                    <td width="15px">&nbsp;</td>
                                    <td colspan="2" style="border-bottom: 1px solid #2bc5f8;">&nbsp;</td>
                                    <td width="15px">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="left">
                                <tr>
                                    <td width="40px">&nbsp;</td>
                                    <td width="420px" align="left" valign="top">
                                        <font style="font-family: Arial,sans-serif;font-size: 13px;color: #464646; line-height: 20px;">
                                            Chào bạn <span style="color: #2bc5f8;"><strong>{{ $orderInfo->orderDelivery->name_delivery_from }}</strong>,<br/></span>
                                            <p><strong>Anh vừa đặt hàng thành công trên <span style="color: #2bc5f8;"><a href="{{ route('home') }}">{{ route('home') }}</a></span></strong>
                                            Cảm ơn Anh đã ủng hộ & sử dụng dịch vụ. Bên dưới là thông tin chi tiết đơn hàng của quý khách  :</p>
                                        </font>
                                    </td>
                                    <td width="40px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="5px" colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="40px">&nbsp;</td>
                                    <td width="420px" align="left" valign="top">
                                        <font style="font-family: Arial,sans-serif;font-size: 15px;color: #2bc5f8;text-decoration: uppercase;">
                                            THÔNG TIN ĐƠN HÀNG: <span style="font-size:18px; color: #2bc5f8;"><strong>#{{ $orderInfo->order_code }}</strong></span></font>
                                    </td>
                                    <td width="40px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="5px" colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="40px">&nbsp;</td>
                                    <td width="420px" align="left" valign="top">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="10">
                                            <tr>
                                                <th width="40%" style="text-align: left; border-top:1px solid #ececec;border-left:1px solid #ececec;border-bottom:1px solid #dcdcdc;background-color:#ececec; vertical-align:top;">Ngày đặt hàng:</th>
                                                <td width="60%" style="border-top:1px solid #ececec;border-right:1px solid #ececec;border-bottom:1px solid #ececec;background-color:#fff">{{ date('d/m/Y H:i', strtotime($orderInfo->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left:1px solid #ececec;border-bottom:1px solid #dcdcdc;background-color:#ececec; vertical-align:top;">Mã đơn hàng: </th>
                                                <td style="border-right:1px solid #ececec;border-bottom:1px solid #ececec;background-color:#fff"><strong>{{ $orderInfo->order_code }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left:1px solid #ececec;border-bottom:1px solid #dcdcdc;background-color:#ececec; vertical-align:top;">Khách đặt hàng: </th>
                                                <td style="border-right:1px solid #ececec;border-bottom:1px solid #ececec;background-color:#fff"><strong>{{ $orderInfo->orderDelivery->name_delivery_from }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left:1px solid #ececec;border-bottom:1px solid #dcdcdc;background-color:#ececec; vertical-align:top;">Số điện thoại liên lạc: </th>
                                                <td style="border-right:1px solid #ececec;border-bottom:1px solid #ececec;background-color:#fff">{{ $orderInfo->orderDelivery->phone_delivery_from }}</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left: 1px solid #ececec; border-bottom: 1px solid #dcdcdc; background-color: #ececec; vertical-align: top" valign="top">Thông tin giao hàng: </th>
                                                <td style="font-family: Arial; sans-serif; border-right:1px solid #ececec;border-bottom:1px solid #ececec;background-color:#fff;" valign="top">
                                                    <p style="font-family: Arial; sans-serif; margin: 0 0 10px; font-weight: bold; font-size: 13px;">Khách hàng {{ $orderInfo->orderDelivery->name_delivery_to }}</p>
                                                    <p style="font-family: Arial; sans-serif; margin: 0 0 5px; line-height: 20px; font-size: 13px;">{{ $orderInfo->orderDelivery->address_to  }}</p>
                                                    <p style="font-family: Arial; sans-serif; margin: 0; font-size: 13px;">{{ $orderInfo->orderDelivery->phone_delivery_to }}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left:1px solid #ececec; border-bottom:1px solid #dcdcdc;background-color:#ececec; vertical-align:top;">Phương thức thanh toán: </th>
                                                <td style="border-right:1px solid #ececec; border-bottom:1px solid #ececec; background-color:#fff">Nhân viên thu tiền tận nơi</td>
                                            </tr>
                                            <tr>
                                                <th style="text-align: left; border-left: 1px solid #ececec; border-bottom: 1px solid #dcdcdc;background-color: #ececec; line-height: 20px;; vertical-align:top;">Ghi chú khi giao hàng: </th>
                                                <td style="border-right: 1px solid #ececec; border-bottom: 1px solid #ececec; background-color:#fff; line-height: 20px;">{{ $orderInfo->order_note }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-left:1px solid #ececec; border-right:1px solid #dcdcdc; background-color:#ffffff">
                                                    <span style="font-size: 15px; color: #2bc5f8;"><strong>Sản phẩm: </strong></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-left: 1px solid #ececec; border-right: 1px solid #dcdcdc; border-bottom: 1px solid #dcdcdc; background-color: #ffffff">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <!-- begin products -->
                                                        <?php $stt = 0; ?>
                                                        @foreach($orderInfo->orderDetail as $item)
                                                            <?php $stt++; ?>
                                                            <tr>
                                                                <td valign="top" style="width: 4%; padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;">{{ $stt }}. </td>
                                                                <td width="55%" style="font-family: Arial; sans-serif; padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;">
                                                                    <p style="margin: 0 0 3px; font-weight: bold; font-size: 13px;">{{ $item->product_name }}</p>
                                                                    <p style="margin: 0; font-size: 12px; font-style: italic; color: #8e8e8e;"></p>
                                                                </td>
                                                                <td style="padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;">{{ $item->quanlity }}</td>
                                                                <td style="padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;"> x </td>
                                                                <td style="padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;">{{ number_format($item->price,0,'.','.') }} đ</td>
                                                                <td style="padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;">=</td>
                                                                <td style="padding: 4px 0; border-bottom: 1px dotted #ebebeb; vertical-align: top;" align="right">{{ number_format($item->quanlity*$item->price,0,'.','.') }} đ</td>
                                                            </tr>
                                                        @endforeach        
                                                        <!-- end products -->
                                                        <tr>
                                                            <td colspan="4" align="right" style="padding-top: 10px; font-family: Arial; sans-serif; ">
                                                                <p style="margin-top: 0; margin-bottom: 7px; padding: 0; font-size: 13px; font-weight: bold;">Tổng cộng: </p>
                                                            </td>
                                                            <td colspan="4" align="right" style="padding-top: 10px; font-family: Arial; sans-serif; ">
                                                                <p style="margin-top: 0; margin-bottom: 7px; padding: 0; font-size: 13px; font-weight: bold;">{{ number_format($orderInfo->total_amount,0,'.','.') }} đ</strong></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="padding: 8px 0; background: #00c0a5; color: #fff; text-align: right">
                                                                <p style="font-family: Arial, sans-serif; margin: 0; line-height: 24px; font-size: 16px; font-weight: bold; ">
                                                                    <strong>Thanh toán: </strong>
                                                                </p>
                                                            </td>
                                                            <td colspan="4" style="padding: 8px 5px; background: #00c0a5;; color: #fff; text-align: right">
                                                                <p style="font-family: Arial, sans-serif; margin: 0; line-height: 24px; font-size: 18px; font-weight: bold; ">
                                                                    <strong>{{ number_format($orderInfo->total_amount,0,'.','.') }} <span style="font-size: 14px;">đ</span> </strong>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="40px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="40px">&nbsp;</td>
                                    <td style="padding: 10px 0; font-weight: bold; font-size: 14px; color: #2bc5f8">Xin chân thành cảm ơn quý khách.</td>
                                    <td width="40px">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="15px">&nbsp;</td>
                                    <td width="570px" colspan="2" style="border-bottom: 2px solid #ebebeb;">&nbsp;</td>
                                    <td width="15px">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
</body>

</html>