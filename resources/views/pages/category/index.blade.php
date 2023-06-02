@extends("layouts.app")
@section("content")
    <div class="container-fluid mt-5 ">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-slack float-end" data-bs-toggle="modal" id="btnModalCreateCategory"
                   data-bs-target="#modalCreateCategory " style="text-transform: capitalize;">Buat {{ $title }} Baru</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="table-responsive p-0 ">
                            <table class="table align-items-center mb-0  ">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="5%">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Kategori
                                    </th>
                                    <th class="text-secondary text-center text-xxs " width=15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td class="align-middle  text-center ">{{ $data->firstItem() + $key }}</td>
                                        <td class="align-middle ">{{ $item->name }}</td>
                                        <td class="text-sm text-center ">
                                            <a type="button" data-bs-toggle="modal"
                                               data-form-name="{{ $item->name }}"
                                               data-form-id="{{ $item->id }}"
                                               class="btn btnModalCategory " data-bs-target="#modalCategory">
                                                <i class="fas fa-eye text-primary mx-1" aria-hidden="true"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div></div>
                    </div>
                    <div class="card-footer " >
                            {{ $data->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

        </div>
    </div>
    <!-- Button trigger modal -->


    <div class="modal fade modal-dialog-scrollable" id="modalCreateCategory" data-bs-backdrop="static"
         data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <form method="POST" action="{{ route($page.".actCreate") }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel" style="text-transform: capitalize;">
                            Buat Data {{ $title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inptCategory">Kategori</label>
                            <input type="text" class="form-control" name="name" id="inptCategory">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn col-3 btn-slack">Buat Baru</button>
                    </div>
                </form>
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
                <div class="modal-body ">
                    <form id="updateCategoryForm" method="POST" action="{{ route($page.'.actUpdate') }}">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="updtFormCategoryName" class="text-sm">Kategori</label>
                            <input type="text" name="name" class="form-control" id="updtFormCategoryName">
                        </div>
                        <input type="hidden" name="id" id="updtFormCategoryID" >
                    </form>
                    <a class="btn col-3 btn-reddit float-end"
                       onclick="event.preventDefault(); document.getElementById('updateCategoryForm').submit();">Ubah
                        Data</a>
                    <button type="button" class="btn btn-secondary float-end  mx-2" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route($page.'.actDelete') }}" method="POST">
                        @csrf
                        @method("DELETE")

                        <input type="hidden" name="id" id="deleteCategoryID" value="3">
                        <button type="submit" class="btn col-2 btn-danger float-start"
                                onclick="return confirm('Yakin akan menghapus data ini?');">Hapus Data
                        </button>
                    </form>
                </div>
                <div class="modal-footer text-start bg-dark">
                </div>
            </div>
        </div>
    </div>
    <script>
        // START Form update
        let btnModalCategory = document.getElementsByClassName("btnModalCategory");
        let modalCategory = document.getElementById("modalCategory");

        for (var i = 0; i < btnModalCategory.length; i++) {
            btnModalCategory[i].addEventListener('click', function () {
                setOverlaySidenav();

                document.getElementById("updtFormCategoryName").value = this.getAttribute("data-form-name");
                document.getElementById("updtFormCategoryID").value = this.getAttribute("data-form-id");
                document.getElementById("deleteCategoryID").value = this.getAttribute("data-form-id");
            }, false);
        }

        modalCategory.addEventListener("hidden.bs.modal", function () {
            unsetOverlaySidenav()
        });
        // END


        // START Form Create
        let btnModalCreateCategory = document.getElementById("btnModalCreateCategory");
        let modalCreateCategory = document.getElementById("modalCreateCategory");

        btnModalCreateCategory.addEventListener('click', function () {
            setOverlaySidenav();
        }, false);

        modalCreateCategory.addEventListener("hidden.bs.modal", function () {
            unsetOverlaySidenav()
        });
        // END



    </script>

@endsection
