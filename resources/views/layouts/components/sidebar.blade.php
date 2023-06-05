<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 bg-white"
       id="sidenav-main">
    <div class="sidenav-header text-center">
        <i class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-none d-xl-none text-white opacity-8"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
           target="_blank">
            <span class="ms-1 font-weight-bold">Daynita Frozen Food</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0" style="text-transform: capitalize">
    <div class="collapse navbar-collapse w-auto " style="height:75%;" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                   href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('transaction.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transaksi</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#report" class="nav-link " aria-controls="masterDataNav"
                   role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laporan</span>
                </a>
                <div
                    class="collapse {{ in_array(Route::currentRouteName(),array("report.transaction","report.stock"))  ? 'show' : '' }}"
                    id="report" style="">
                    <ul class="nav ms-4">
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'report.transaction' ? 'active' : '' }}"
                               href="{{ route('report.transaction') }}">
                                <span class="sidenav-mini-icon"> LT </span>
                                <span class="sidenav-normal">Laporan Penjualan Produk</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Route::currentRouteName() == 'report.stock' ? 'active' : '' }}"
                               href="{{ route('report.stock') }}">
                                <span class="sidenav-mini-icon"> LSP </span>
                                <span class="sidenav-normal">Laporan Stok Produk</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(Auth::user()->role == "admin")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelola Kasir</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#masterDataNav" class="nav-link " aria-controls="masterDataNav"
                       role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text  ms-1">Kelola Produk</span>
                    </a>
                    <div
                        class="collapse {{ in_array(Route::currentRouteName(),array("category.index","product.index"))  ? 'show' : '' }}"
                        id="masterDataNav" style="">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::currentRouteName() == 'category.index' ? 'active' : '' }}"
                                   href="{{ route('category.index') }}">
                                    <span class="sidenav-mini-icon"> K </span>
                                    <span class="sidenav-normal">Kategori</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ Route::currentRouteName() == 'product.index' ? 'active' : '' }}"
                                   href="{{ route('product.index') }}">
                                    <span class="sidenav-mini-icon"> P </span>
                                    <span class="sidenav-normal">Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

        </ul>
    </div>
    <div class="sidenav-footer p-0 mb-0">
        <ul class="navbar-nav position-relative bottom-0">
            <li class="nav-item">
            </li>
        </ul>
    </div>
</aside>



