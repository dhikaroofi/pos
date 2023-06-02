@extends("layouts.app")
@section("content")
    <div class="container-fluid mt-5 ">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-slack float-end" data-bs-toggle="modal" id="btnModalCreateCategory"
                   data-bs-target="#modalCreateCategory" style="text-transform: capitalize;">Buat {{ $title }} Baru</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body px-0 pt-0 pb-4">
                        <div class="table-responsive p-0 pb-2">
                            <table class="table align-items-center mb-0  ">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs  font-weight-bolder"
                                        width="10px">No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2"
                                        width="225px">
                                        Produk
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2"
                                        width="155px">
                                        Kategori
                                    </th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder ps-2"
                                        width="75px">
                                        Stok Produk
                                    </th>
                                    <th class="text-uppercase text-secondary  text-end text-xxs font-weight-bolder ps-2"
                                        width="155px">
                                        Harga Jual
                                    </th>
                                    <th class="text-uppercase text-secondary   text-end text-xxs font-weight-bolder ps-2"
                                        width="155px">
                                        Harga Jual Reseller
                                    </th>
                                    <th class="text-uppercase text-center text-xxs " width=15px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $item)
                                    <tr>
                                        <td class="align-middle  text-center ">{{ $key+1 }}</td>
                                        <td class="align-middle ">{{ $item->name }}</td>
                                        <td class="align-middle ">{{ $item->category->name }}</td>
                                        <td class="align-middle  text-center ">{{ $item->stock }}</td>
                                        <td class="align-middle  text-end ">
                                            Rp. {{ number_format($item->selling_price) }}</td>
                                        <td class="align-middle  text-end ">
                                            Rp. {{ number_format($item->selling_price_resellers) }}</td>
                                        <td class="text-sm text-center pt-3">
                                            <a type="button" data-bs-toggle="modal"
                                               data-form-name="{{ $item->name }}"
                                               data-form-id="{{ $item->id }}"
                                               data-form-category="{{ $item->category }}"
                                               data-form-stock="{{ $item->stock }}"
                                               data-form-unit="{{ $item->unit }}"
                                               data-form-selling_price="{{ $item->selling_price }}"
                                               data-form-selling_price_resellers="{{ $item->selling_price_resellers }}"
                                               data-form-image="{{ $item->image }}"
                                               class="btn btnModalCategory " data-bs-target="#modalCategory">
                                                <i class="fas fa-eye text-primary mx-1" aria-hidden="true"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        {{ $data->links('vendor.pagination.bootstrap-5') }}
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
                <form method="POST" action="{{ route($page.".actCreate") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel" style="text-transform: capitalize;">
                            Buat Data {{ $title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inptCategoryProduct">Kategori Produk</label>
                            <select class="form-control" name="category" id="inptCategoryProduct" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($formData["categories"] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inptNameProduct">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="inptNameProduct" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Unit</label>
                                    <input type="text" class="form-control" name="unit" id="inptSellingPrice" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="inptSellingPrice"
                                           value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Harga Jual</label>
                                    <input type="number" class="form-control" name="selling_price" id="inptSellingPrice"
                                           value="0" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPriceResellers">Harga Jual Reseller</label>
                                    <input type="number" class="form-control" name="selling_price_resellers"
                                           id="inptSellingPriceResellers" value="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inptPictureProduct">Gambar Produk</label>
                            <input type="file" class="form-control" name="image" id="inptPictureProduct">
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

                        <div class="form-group mt-3">
                            <label for="inptCategoryProduct">Kategori Produk</label>
                            <select class="form-control" name="category" id="inptCategoryProduct" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($formData["categories"] as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inptNameProduct">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="inptNameProduct" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Unit</label>
                                    <input type="text" class="form-control" name="unit" id="inptSellingPrice" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="inptSellingPrice"
                                           value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPrice">Harga Jual</label>
                                    <input type="number" class="form-control" name="selling_price" id="inptSellingPrice"
                                           value="0" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inptSellingPriceResellers">Harga Jual Reseller</label>
                                    <input type="number" class="form-control" name="selling_price_resellers"
                                           id="inptSellingPriceResellers" value="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 ">
                                <div class="form-group">
                                    <label for="inptPictureProduct">Gambar Produk</label>
                                    <input type="file" class="form-control" name="image" id="inptPictureProduct" onchange="previewImage(event)">
                                </div>
                            </div>
                            <div class="col-6 text-center pt-3 ">
                                <img  class="img-thumbnail w-75" src=""    id="updtFormProductImage">
                            </div>
                        </div>
                        <input type="hidden" name="id" id="updtFormProductID" >
                    </form>
                    <a class="btn col-3 btn-reddit float-end"
                       onclick="event.preventDefault(); document.getElementById('updateCategoryForm').submit();">Ubah
                        Data</a>
                    <button type="button" class="btn btn-secondary float-end  mx-2" data-bs-dismiss="modal">Close
                    </button>
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
                //
                // var image = document.getElementById("myImage");
                // image.src = "image2.jpg";
                // image.alt = "Image 2";

                document.getElementById("updtFormProductImage").src = "{{url('/')}}"+"/product_images/"+this.getAttribute("data-form-image");
                // document.getElementById("updtFormCategoryID").value = this.getAttribute("data-form-id");
                // document.getElementById("deleteCategoryID").value = this.getAttribute("data-form-id");
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


        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('updtFormProductImage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>

@endsection

