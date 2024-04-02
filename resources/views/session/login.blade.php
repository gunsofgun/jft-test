@extends('layout/mainclear')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-md-center mt-5">
            <div class="card" style="width: 40rem;">
                <div class="card-body p-5">
                    <div class="row justify-content-between">
                        <div class="col">
                            <h2 class="mb-4">Masuk</h2>
                        </div>
                        <div class="col-auto">
                            <a href="/" class="btn btn-outline-green">< Kembali</a>
                        </div>
                    </div>

                    @include('component/message')
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required type="email" value="{{ Session::get('email') }}" name="email" id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input required type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="mb-3 d-grid mt-4">
                            <button class="btn btn-green py-2" name="submit" type="submit">Login</button>
                        </div>

                        <div class="mb-3 text-center">
                            <p>Belum mempunyai akun? silahkan untuk <span><a href="/register" class="text-decoration-none text-link">Daftar</a></span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection