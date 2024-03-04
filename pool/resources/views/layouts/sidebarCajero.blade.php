<div>
    @php
        $usuario_actual = Auth::user();
    @endphp
    <div class="row flex-nowrap fixed-top bg-success" style="width: 14%">
        <div class="col-12 px-sm-2 px-0 ">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/home"
                    class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-3 d-none d-sm-inline">{{ $usuario_actual->nombres }}</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item py-2">
                        <a href="/home" class="nav-link text-light fs-5">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-cash-register me-3"></i>
                                <span class="d-none d-xl-inline">Caja</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a href="/#" class="nav-link text-light fs-5">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-table me-3"></i>
                                <span class="d-none d-xl-inline">Mesas</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a href="/#" class="nav-link text-light fs-5">
                            <div class="d-flex align-items-center">
                                <i class="fa-sharp fa-solid fa-users me-3"></i>
                                <span class="d-none d-xl-inline">Meseras</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a href="/#" class="nav-link text-light fs-5">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-boxes-stacked me-3"></i>
                                <span class="d-none d-xl-inline"><span>Inventario</span></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a href="/clientes_cajero" class="nav-link text-light fs-5">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-user-check me-3"> </i>
                                <span class="d-none d-xl-inline">Clientes</span>
                            </div>
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="d-flex align-items-center btn text-light fs-5">
                                <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                                <span class="d-none d-xl-inline">Cerrar Sesión</span>
                            </button>

                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>