<tr style="background:#fff">
    <td align="left" width="600" height="auto" style="padding:15px">
        <table>
            <tbody>
                <tr>
                    <td>
                        <p> Chào quý khách,</p>
                        <p> ISMART gửi cho quý khách hàng hóa đơn điện tử cho đơn hàng <b>{{ $data['code'] }}</b>,

                        </p>

                        </ul>
                        <h3
                            style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">
                            Thông tin đơn hàng {{ $data['code'] }} <span
                                style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(
                                {{ $data['created_at'] }})</span>

                        </h3>
                    </td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th align="left" width="50%"
                                        style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">
                                        Thông tin thanh toán </th>
                                    <th align="left" width="50%"
                                        style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold">
                                        Địa chỉ giao hàng
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td valign="top"
                                        style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        <span style="text-transform:capitalize">{{ Auth::user()->name }}</span><br> <a
                                            href="" target="_blank">{{ Auth::user()->email }}</a><br>

                                    </td>
                                    <td valign="top"
                                        style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                        {{ $data['fullname'] }}<br> {{ $data['address'] }}
                                        <br> Đt: {{ $data['phone'] }}
                                        <br> Ghi chú : {{ $data['note'] ? $data['note'] : 'Không có' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top"
                                        style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444"
                                        colspan="2">
                                        <p
                                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:normal">
                                            <br> <strong>Phương thức thanh
                                                toán:</strong>
                                            {{ $data['payment_method'] == 1 ? 'Thanh toán tại nhà' : 'Thanh toán online' }}<br>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2
                            style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">
                            CHI TIẾT ĐƠN HÀNG </h2>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                            <thead>
                                <tr>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Sản phẩm </th>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Đơn giá </th>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Số lượng </th>

                                    <th align="right" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Total tạm thời </th>
                                </tr>
                            </thead>
                            <tbody bgcolor="#eee"
                                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                @php
                                    $decodeData = json_decode($data['order_detail'], true);
                                @endphp
                                @foreach ($decodeData as $item)
                                    <tr>
                                        <td align="left" valign="top" style="padding:3px 9px">
                                            <strong>{{ $item['name'] }}</strong>
                                        </td>
                                        <td align="left" valign="top" style="padding:3px 9px">
                                            <span>{{ number_format($item['price'], 0, '', '.') }}đ</span>
                                        </td>
                                        <td align="left" valign="top" style="padding:3px 9px"> {{ $item['qty'] }}
                                        </td>

                                        <td align="right" valign="top" style="padding:3px 9px">
                                            <span>{{ number_format($item['subtotal'], 0, '', '.') }}đ</span>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot
                                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

                                <tr bgcolor="#eee">
                                    <td colspan="3" align="right" style="padding:7px 9px"> <strong><big>Tổng giá trị
                                                đơn hàng</big></strong></td>
                                    <td align="right" style="padding:7px 9px">
                                        <strong><big><span>{{ $data['totalCart'] }}
                                                    ₫</span></big></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table><br>
                    </td>
                </tr>
                <tr>
                    <td>

                        <p
                            style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            Mọi thắc mắc và góp ý, quý khách hàng vui lòng liên hệ với ISMART Care qua <a href="https://www.facebook.com/"
                                style="color:#099202;text-decoration:none"
                                target="_blank"><strong>haitd</strong></a> . Đội ngũ ISMART Care
                            luôn sẵn
                            sàng hỗ trợ bạn. </p>
                    </td>
                </tr>
                <tr>
                    <td><br>
                        <p
                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">
                            ISMART cảm ơn quý khách hàng, <br></p>
                        <p
                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right">
                            <strong><a style="color:#00a3dd;text-decoration:none;font-size:14px"
                                    href="http://mg-email.tiki.vn/c/eJxNj8tqwzAQRb9G2tXoacULLZKI7Br6B2Gshy1iWUGWm9-vDFkUhhnu4XJgnB57GRzgqBlhlFAiaE97qTracWO4JOZKzlyc-CCQIDU-Y_e74lnzUVkrBjGclBrlIAlQz33wIdghKBVw8tsGk384qKCRuiDGomsL8TNlXMgeKYMXPdf6agixW5uPHvHbXtNjy3uxHnFTC6wb2BrzCgtiF58gttsfpeRd3FMr_YfVlwMtecofYiG9IE5NbVb_bo5cnC-46BliLZTR9tx0GDqbE676-nP_-m7xD0jDWTQ"
                                    target="_blank">ISMART</a></strong> <br>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
