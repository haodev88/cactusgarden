<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lấy Lại Mật Khẩu</title>
</head>

<body bgcolor="#f7f7f7" style="padding: 0; margin: 0; font-family:Arial,sans-serif;font-size:13px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f7f7f7">
    <tr>
        <td height="15">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="margin: 0 auto;" bgcolor="">
                <tr>
                    <td align="center" style="text-align: center; padding:12px 0px;">
                        <a href="{{ route('home') }}" target="_blank"><img src="{{ asset('cactus/img/logo/logo.png') }}" width="136" border="0" /></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="15">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" style="margin: 0 auto;">
                <tr>
                    <td height="15px;"></td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="540" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                            <tr>
                                <td>
                                    <font style="font-family: Arial, sans-serif; color: #333;">
                                        <p style="margin-top: 0; margin-bottom: 10px; font-size: 16px; font-weight: bold;">Chào {{ $findInfo['name'] }}, </p>
                                        <p style="margin-bottom: 25px; font-size: 13px; font-weight: bold; line-height: 20px;">
                                        <p style="margin-bottom:0; font-size: 13px; line-height: 20px;">
                                            Email : <strong>{{ $findInfo['email'] }}</strong><br /> Vui lòng <a target="_blank" href="{{ route('get-reset-password').'?check-sum='.$findInfo['checkSum'] }}">click vảo đây</a> để thay đổi mật khẩu
                                        </p>
                                        </p>
                                        <p style="margin-top: 0; margin-bottom: 25px; width: 100%; border-bottom: 1px solid #ebebeb;">&nbsp;</p>
                                        <p style="line-height: 24px; font-size: 13px;">
                                            Nếu cần sự giúp đỡ, hãy liên hệ với chúng tôi với số Hotline: <span style="font-size: 20px; font-weight: bold; color: #ff9000">
		                                                {{ Config('global')['infomation_shop']['hotline'] }}</span>
                                        </p>
                                        <p>{{  Config('global')['infomation_shop']['shop_name'] }} cảm ơn bạn đã ủng hộ.</p>
                                    </font>
                                </td>
                            </tr>
                            <tr>
                                <td width="540px">&nbsp;</td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
