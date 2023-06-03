

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
     data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="text-transform: capitalize;">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                                                                  href="javascript:;">{{ $title }}</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $currentPage }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        @if(Route::currentRouteName() == "transaction.index")
            <div class=" d-xl-block d-none text-white">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('home') }}" class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-home me-sm-1" aria-hidden="true"></i>
                            <span class="d-sm-inline d-none">Home</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">

            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item dropdown ">
                    <a href="javascript:;" class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#"> <i class="fa fa-user me-1 text-dark"
                                                                  aria-hidden="true"></i> Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('actLogout') }}">
                                <span class="nav-link-text"> <i class="fa fa-sign-out me-1 text-dark"
                                                                aria-hidden="true"></i> Logout</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</nav>
