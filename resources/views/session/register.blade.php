@extends('layout/mainclear')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-md-center mt-5">
            <div class="card" style="width: 40rem;">
                <div class="card-body p-5">
                    <div class="row justify-content-between">
                        <div class="col">
                            <h2 class="mb-4">Daftar</h2>
                        </div>
                        <div class="col-auto">
                            <a href="/" class="btn btn-outline-green">< Kembali</a>
                        </div>
                    </div>

                    @include('component/message')
                    <form action="/create" method="POST">
                        @csrf
                        <input type="hidden" value="2" name="roleId">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" value="{{ Session::get('name') }}" name="name" id="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{ Session::get('email') }}" name="email" id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="mb-3 d-grid">
                            <button class="btn btn-green" name="submit" type="submit">Register</button>
                        </div>

                        <div class="text-center">
                            <p class="m-0">Sudah mempunyai akun? silahkan untuk <span><a href="/login" class="text-decoration-none text-link">Masuk</a></span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection