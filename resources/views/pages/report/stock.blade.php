@extends("layouts.app")
@section("content")
    <div class="container-fluid mt-5 ">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <form action="" method="GET" class="row">
                            @csrf
                            <div class="col-3">
                                <input class="form-control" type="number" name="minStock" placeholder="maximal stock" required>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="submit" class="btn btn-primary">Lihat</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="table-responsive p-0 ">
                            <table class="table align-items-center mb-0  ">
                                <thead>
                                <tr>
                                    <td colspan="5" class="text-center pb-3 text-bold   ">
                                        Laporan Stok Produk<br/>
                                        Tanggal {{ date('d M Y') }}
                                    </td>
                                </tr>
                                <tr class="mt-5">
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="5%">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2" width="40%%">
                                       Nama Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2" width="10%">
                                        Kategori Produk
                                    </th>
                                    <th class="text-uppercase  text-center text-secondary text-xxs font-weight-bolder ps-2">
                                        Stok Produk
                                    </th>
                                    <th class="text-uppercase  text-center text-secondary text-xxs font-weight-bolder ps-2">
                                        Unit
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalItem = 0;
                                    $i = 1;
                                @endphp
                                @foreach($product as $key => $item)
                                    @php
                                        $totalItem += $item->stock;
                                    @endphp
                                    <tr>
                                        <td class="align-middle  text-center ">{{  $i++ }}</td>
                                        <td class="align-middle " style="text-transform: capitalize;">{{ $item->name }}</td>
                                        <td class="align-middle " style="text-transform: capitalize;">{{ $item->category->name }}</td>
                                        <td class="align-middle text-center ">{{ $item->stock }}</td>
                                        <td class="align-middle text-center ">{{ $item->unit }}</td>
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
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

        </div>
    </div>

@endsection
