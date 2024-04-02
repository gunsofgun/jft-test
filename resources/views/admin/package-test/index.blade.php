@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5 text-center">
                    <h2>Paket Test</h2>
                    <hr>
                    <div class="row justify-content-center mt-4">
                        @foreach ($data as $item)
                            <div class="col-4">
                                <a href="/package/{{ $item->id }}" class="text-decoration-none">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body py-4">
                                            <h3>{{ $item->package_name }}</h3>
                                            <h5>Waktu Test - {{ $item->time_test }} Menit</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection