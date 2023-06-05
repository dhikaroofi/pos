@extends("layouts.app")
@section("content")
    <div class="container-fluid mt-5 ">
        <div class="row">

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <form action="" method="GET" class="row">
                            @csrf
                            <div class="col-2">
                                <input class="form-control" type="date" name="startDate" required>
                            </div>
                            <div class="col-2">
                                <input class="form-control" type="date" name="endDate" required>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="table-responsive p-0 ">
                            <table class="table align-items-center mb-0  ">
                                <thead>
                                <tr>
                                    <td colspan="4" class="text-center pb-3 text-bold   ">
                                        Laporan Penjualan Produk<br/>
                                        {{ date('d M Y',strtotime($startDate)) }} s/d {{ date('d M Y',strtotime($endDate)) }}
                                    </td>
                                </tr>
                                <tr class="mt-5">
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="5%">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Produk Terjual
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Total Penjualan
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalItem = 0;
                                    $totalPrice = 0;
                                    $i = 1;
                                @endphp
                                @foreach($transaction as $key => $item)
                                    @php
                                        $totalItem += $item["qty"];
                                        $totalPrice += $item["total"];
                                    @endphp
                                    <tr>
                                        <td class="align-middle  text-center ">{{  $i++ }}</td>
                                        <td class="align-middle " style="text-transform: capitalize;">{{ $item["name"] }}</td>
                                        <td class="align-middle ">{{ $item["qty"] }}</td>
                                        <td class="align-middle ">Rp. {{ number_format($item["total"]) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div></div>
                    </div>
                    <div class="card-footer text-start " >
                        <table class="table">
                            <tr>
                                <td class="text-end">Total Item :</td>
                                <td class="text-end">{{ $totalItem }}</td>
                            </tr>
                            <tr>
                                <td class="text-end">Total Penjualan :</td>
                                <td class="text-end">Rp. {{ number_format($totalPrice) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

        </div>
    </div>

@endsection
