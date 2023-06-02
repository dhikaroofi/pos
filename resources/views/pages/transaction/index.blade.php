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
                        <form>
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" type="text"
                                           placeholder="nama produk atau nomor serial produk">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body px-0 pt-0 pb-4">
                        @php
                            $data = ["asdasd","asdasdasd"]
                        @endphp
                        @if(count($data) < 1)
                            <div class="text-center mt-5">
                                <h6>data tidak ada</h6>
                            </div>
                        @else
                            <div class="overflow-auto" style="height: 500px">
                                <div class="table-responsive pb-2 px-2">
                                    <table class="table align-items-center mb-0">
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img
                                                            src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                            class="avatar avatar-xxl me-3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-lg">John Michael</h6>
                                                        <p class="text-lg text-secondary mb-0">Rp 20.000</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-lg text-secondary ">20 Stok</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class=" btn btn-slack font-weight-bold text-xs"
                                                   data-toggle="tooltip" data-original-title="Edit user">
                                                    Tambah
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="card-footer ">

                    </div>
                </div>
            </div>

            <div class="col-7">
                <div class="card mb-4">
                    <div class="card-header  text-end ">
                        <span class="text-bolder">  {{ date("d M Y") }}</span>
                    </div>
                    <div class="card-body overflow-auto px-0 pt-0 pb-4" style="height: 380px">
                        <div class="table-responsive p-0 pb-2">
                            <table class="table table-bordered  table-striped align-items-center mb-0 ">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
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
                                <tr>
                                    <td class="text-center">asd1</td>
                                    <td class="text-center">1</td>
                                    <td class="text-end">Rp. 150 000</td>
                                    <td class="text-end">Rp. 150 000</td>
                                    <td class="text-center p-0 ">
                                        <button class="btn btn-danger text-xxs mt-3 p-2">Hapus</button>
                                    </td>
                                </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <div class="table-responsive p-0 pb-2">
                            <table class="table  align-items-center mb-0 " border="0">
                                <tr>
                                    <td class="text-end text-xl " colspan="4" style="height: 50px;">
                                        Total Harga :
                                    </td>
                                    <td class="text-end text-xl">Rp. 100.000</td>
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

