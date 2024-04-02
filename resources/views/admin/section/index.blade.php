@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5 ">
                    <a href="/list-package" class="btn btn-outline-green" style="width: 7rem">< Kembali</a>
                    <h2 class="text-center">Section Test</h2>
                    <hr>
                    <div class="row justify-content-center mt-4 text-center">
                        @foreach ($data as $item)
                            <div class="col-6 my-3">
                                <a href="/section/{{ $item->id }}" class="text-decoration-none">
                                    <div class="card mx-4">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body py-4">
                                            <h3>{{ $item->section_name }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <h2 class="text-center mt-5">Hasil Test</h2>
                    <hr>
                    <table class="table table-striped table-bordered table-hover mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Peserta</th>
                                <th scope="col">Nilai Hasil</th>
                                <th scope="col">Nilai SV</th>
                                <th scope="col">Nilai CE</th>
                                <th scope="col">Nilai LC</th>
                                <th scope="col">Nilai RC</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Gunawan</td>
                                <td>210</td>
                                <td>70%</td>
                                <td>75%</td>
                                <td>80%</td>
                                <td>85%</td>
                                <td>
                                    <a href="" class="btn btn-green">Download Result</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Vita</td>
                                <td>240</td>
                                <td>80%</td>
                                <td>85%</td>
                                <td>90%</td>
                                <td>85%</td>
                                <td>
                                    <a href="" class="btn btn-green">Download Result</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection