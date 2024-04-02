<div class="header">
    <div class="bg-black">
        <div class="container bg-black">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2">
                <div class="col-md-5 mb-2 mb-md-0">
                    <a href="/" class="text-light text-decoration-none fw-semibold fs-4">
                        <img src="{{ URL::asset('images/logo-nakayoshi.png'); }}" alt="" width="50">
                        NAKAYOSHI GAKUIN CENTER
                    </a>
                </div>

                @if (Auth::check())
                    <ul class="nav col-4 col-md-auto mb-2 justify-content-center w-25">
                        <li><p class="mb-0 text-white">Halo, {{ Auth::user()->name }}!</p></li>
                    </ul>
                @endif

                <div class="col-md-3 text-end">
                    @if (Auth::check())
                        <a href="/logout" class="btn btn-outline-light">Logout</a>
                    @endif
                </div>
            </header>
        </div>
    </div>
    <div class="bg-green" style="height: 2vh"></div>
</div>