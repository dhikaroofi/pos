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
                <span style="font-size: 30px">Dayinta Frozen Food</span><br/>
                <br/>
            </th>
        </tr>
        <tr>
            <th width="100px" style="text-align: left">Produk</th>
            <th width="100px" style="text-align: left">Harga</th>
            <th width="80px" style="text-align: center">Jumlah</th>
            <th width="100px" style="text-align: right">Total Price</th>
        </tr>
        @php
            $itemPrice = 0;
            @endphp
        @foreach($transaction as $item)
            @php
                $itemPrice += $item->qty * $item->price;
            @endphp
            <tr>
                <td>{{ $item->product->name }}</td>
                <td style="text-align: left">Rp. {{ number_format($item->price) }}</td>
                <td style="text-align: center;"> {{ $item->qty }}</td>
                <td style="text-align: right;">Rp. {{ number_format($item->qty * $item->price) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" align="right"><b>Total:</b></td>
            <td style="text-align: right">Rp. {{ number_format($itemPrice) }}</td>
        </tr>
        <tr>
            <td colspan="4" align="center" style="font-size:14px; ">
                <p>
                    Terima Kasih<br/><span>{{ date('d M Y H:i') }}</span><br/>
                    <span style="font-weight: normal;">Jln Raya Brengkok Parakancanggah<br/>Banjarnegara<br/></span>
                </p>
            </td>
        </tr>
    </table>
</center>
</body>
</html>
