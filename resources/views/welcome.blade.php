@extends('layout/mainclear')

@section('content')
    <div>
        <div class="container col-xxl-9 px-3 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="images/undraw_knowledge.svg" class="d-block mx-lg-auto img-fluid" alt="Test Illustration" width="340" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Simulasi JFT-Basic Nakayoshi Gakuin Center</h1>
                    <p class="lead">Simulasi ini digunakan untuk mengukur kemampuan bahasa Jepang yang diperlukan untuk komunikasi dalam situasi kehidupan sehari-hari yang dihadapi oleh orang asing yang datang ke Jepang terutama untuk bekerja.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">

                    @if (Auth::check())
                        @if(Auth::user()->role == 'user')
                            <a href="/before-test" class="btn btn-green fs-5 me-3 px-5 py-2 text-white">Petunjuk</a>
                        @elseif (Auth::user()->role == 'admin')
                            <a href="/list-package" class="btn btn-green fs-5 me-3 px-5 py-2 text-white">Paket Test</a>
                        @elseif (Auth::user()->role == 'superadmin')
                            <a href="/" class="btn btn-green fs-5 me-3 px-5 py-2 text-white">SUPA</a>
                        @endif
                    @else
                        <a href="/login" class="btn btn-green fs-5 me-3 px-5 py-2 text-white">Masuk</a>
                        <a href="/register" class="btn btn-outline-green fs-5 px-5 py-2">Daftar</a>
                    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection