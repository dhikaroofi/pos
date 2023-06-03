@extends("layouts.app_without_side")
@section("content")
    <div class="container-fluid mt-5 ">
        <div class="row">
            <div class="col-12">
            </div>
        </div>

        <div class="row">
            <div class="col-5">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <form action="{{ route('transaction.index') }}" method="GET">
                            @csrf
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" type="text"
                                           placeholder="nama produk atau nomor serial produk" name="keyword">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-4 overflow-auto" style="height: 525px">
                        @isset($product)
                            @if(count($product) < 1)
                                <div class="text-center mt-5">
                                    <h6>data tidak ada</h6>
                                </div>
                            @else
                                <div class="table-responsive pb-2 px-2">
                                    <table class="table align-items-center mb-0">
                                        @foreach($product as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img
                                                                src="{{ url('/')."/".$item->image }}"
                                                                class="avatar avatar-xxl me-3">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-lg">{{ $item->name }}</h6>
                                                            <p class="text-lg text-secondary mb-0">
                                                                Rp {{ number_format($item->selling_price) }}</p>
                                                            <p class="text-lg text-secondary ">
                                                                Tersisa {{ $item->stock." ".$item->unit }} </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    {{--                                                        <input type="number" class="form-control" name="qty" min="1" value="1" oninput="validateInput(this)" >--}}
                                                </td>
                                                <td class="align-middle pt-4 text-center">
                                                    <form action="{{ route('cart.addItem') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="product_id">
                                                        <input type="submit"
                                                               class=" btn btn-slack font-weight-bold text-xs"
                                                               value="Tambah">
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        @endisset
                    </div>
                    <div class="card-footer ">

                    </div>
                </div>
            </div>
            @php
            $totalItem = 0;
            $totalPrice = 0;
            @endphp
            <div class="col-7">
                <div class="card mb-4">
                    <div class="card-header  text-end ">
                        <span class="text-bolder">  {{ date("d M Y") }}</span>
                    </div>
                    <div class="card-body overflow-auto px-0 pt-0 pb-4" style="height: 335px">
                        <div class="table-responsive p-0 pb-2">
                            <table class="table table-bordered  table-striped align-items-center mb-0 ">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  text-xxs  font-weight-bolder"
                                        width="50%">Product Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="5%">Qty
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="20%">Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="25%">Total Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="25%">Hapus
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    @php
                                        $totalPrice += ($item->price*$item->qty);
                                        $totalItem += ($item->qty);
                                    @endphp
                                    <tr>
                                        <td class="text-start">{{ $item->product->name }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-end">Rp. {{ number_format($item->price) }}</td>
                                        <td class="text-end">Rp. {{ number_format($item->price*$item->qty) }}</td>
                                        <td class="text-center p-0 ">
                                            <form action="{{ route('cart.subtractItem') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->product->id }}" name="product_id">
                                                <input type="submit" class="btn btn-danger text-xxs mt-3 px-2 py-2" value="Kurangi Stok">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="table-responsive p-0 pb-2">
                            <table class="table  align-items-center mb-0 " border="0">
                                <tr>
                                    <td class="text-end text-xl " colspan="4" width="70%" style="height: 50px;">
                                        Total Item :
                                    </td>
                                    <td class="text-end text-xl">{{ $totalItem }}</td>
                                </tr>
                                <tr>
                                    <td class="text-end text-xl " colspan="4" width="70%" style="height: 50px;">
                                        Total Harga :
                                    </td>
                                    <td class="text-end text-xl">Rp. {{ number_format($totalPrice) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <button class="btn btn-danger col-2 mt-3 mx-2">Batalkan</button>
                                        <button class="btn btn-slack col-3 mt-3">Bayar</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->



    <div class="modal fade modal-dialog-scrollable" id="modalCreateCategory" data-bs-backdrop="static"
         data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-dialog-scrollable" id="modalCategory" data-bs-backdrop="static"
         data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">

                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" style="text-transform: capitalize;">Rubah
                        Data {{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer text-start bg-dark">
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection

