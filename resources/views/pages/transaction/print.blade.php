<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>
<center>
    <table>
        <tr>
            <th colspan="4">
                <span style="font-size: 30px">Daynita Frozen Food</span><br/>
                <br/>
            </th>
        </tr>
        <tr>
            <th width="100px" style="text-align: left">Produk</th>
            <th width="100px" style="text-align: right">Harga</th>
            <th width="80px" style="text-align: center">Jumlah</th>
            <th width="100px" style="text-align: right">Total Price</th>
        </tr>
        @php
            $itemPrice = 0;
            @endphp
        @foreach($transaction->detail as $item)
            @php
                $itemPrice += $item->qty * $item->price;
            @endphp
        @php
           dd($item->product);
        @endphp
            <tr>
                <td></td>
                <td style="text-align: right">Rp. {{ number_format($item->price) }}</td>
                <td style="text-align: center;"> {{ $item->qty }}</td>
                <td style="text-align: right;">Rp. {{ number_format($item->qty * $item->price) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" align="right"><b>Total:</b></td>
            <td style="text-align: right;">Rp. 1000</td>
        </tr>
        <tr>
            <td colspan="4" align="center" style="font-size:14px; ">
                <p>
                    Terima Kasih<br/><span>{{ date('d M Y H:i') }}</span><br/>
                    <span style="font-weight: normal;">Jln HOS Cokroaminoto NO 45<br/>Yogyakarta<br/></span>
                </p>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
