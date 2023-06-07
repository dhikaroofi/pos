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
                        <form action="" method="GET" class="row">
                            @csrf
                            <div class="col-5">
                                <input class="form-control" type="text"
                                       placeholder="nama user" name="keyword">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
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
                                        Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Email
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                        Role
                                    </th>
                                    <th class="text-secondary text-center text-xxs " width=15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td class="align-middle  text-center ">{{ $data->firstItem() + $key }}</td>
                                        <td class="align-middle ">{{ $item->name }}</td>
                                        <td class="align-middle ">{{ $item->email }}</td>
                                        <td class="align-middle ">{{ $item->role }}</td>
                                        <td class="text-sm text-center ">
                                            <a type="button" data-bs-toggle="modal"
                                               data-form-name="{{ $item->name }}"
                                               data-form-email="{{ $item->email }}"
                                               data-form-id="{{ $item->id }}"
                                               class="btn btnModalUser " data-bs-target="#modalUser">
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
                            <label for="inptFormUserName">Nama</label>
                            <input type="text" class="form-control" name="name" id="inptFormUserName">
                        </div>
                        <div class="form-group">
                            <label for="inptFormUserEmail">Email</label>
                            <input type="text" class="form-control" name="email" id="inptFormUserEmail">
                        </div>
                        <div class="form-group">
                            <label for="inptFormUserPassowrd">Passowrd</label>
                            <input type="password" class="form-control" name="password" id="inptFormUserPassowrd">
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
    <div class="modal fade modal-dialog-scrollable" id="modalUser" data-bs-backdrop="static"
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
                    <form id="updateUserForm" method="POST" action="{{ route($page.'.actUpdate') }}">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="updtFormUserName" class="text-sm">Nama</label>
                            <input type="text" name="name" class="form-control" id="updtFormUserName">
                        </div>
                        <div class="form-group">
                            <label for="updtFormUserEmail" class="text-sm">Email</label>
                            <input type="text" name="email" class="form-control" id="updtFormUserEmail">
                        </div>
                        <div class="form-group">
                            <label for="updtFormUserPassword" class="text-sm">Password</label>
                            <input type="text" name="password" class="form-control" id="updtFormUserPassword">
                        </div>
                        <input type="hidden" name="id" id="updtFormUserID" >
                    </form>
                    <a class="btn col-3 btn-reddit float-end"
                       onclick="event.preventDefault(); document.getElementById('updateUserForm').submit();">Ubah
                        Data</a>
                    <button type="button" class="btn btn-secondary float-end  mx-2" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route($page.'.actDelete') }}" method="POST">
                        @csrf
                        @method("DELETE")

                        <input type="hidden" name="id" id="deleteFormUserID" value="3">
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
        let btnModalUser = document.getElementsByClassName("btnModalUser");
        let modalUser = document.getElementById("modalUser");

        for (var i = 0; i < btnModalUser.length; i++) {
            btnModalUser[i].addEventListener('click', function () {
                setOverlaySidenav();

                document.getElementById("updtFormUserName").value = this.getAttribute("data-form-name");
                document.getElementById("updtFormUserEmail").value = this.getAttribute("data-form-email");
                document.getElementById("updtFormUserID").value = this.getAttribute("data-form-id");
                document.getElementById("deleteFormUserID").value = this.getAttribute("data-form-id");
            }, false);
        }

        modalUser.addEventListener("hidden.bs.modal", function () {
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
