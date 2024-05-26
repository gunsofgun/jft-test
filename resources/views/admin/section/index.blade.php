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

                    {{-- <h2 class="text-center mt-5">Hasil Test</h2>
                    <hr>
                    <div class="mx-3">
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
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($result) == 0)
                                    <tr>
                                        <td colspan="8" class="text-center">Data Kosong!</td>
                                    </tr>
                                @else
                                    @foreach ($result as $item)
                                        @if (count($item['total_correct_section']) == 0)
                                            <tr>
                                                <td colspan="8" class="text-center">Data Kosong!</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['total_point'] }}</td>
                                                <td>{{ ($item['total_correct_section'][1] / $item['total_que_section'][1]) * 100 }}%</td>
                                                <td>{{ ($item['total_correct_section'][2] / $item['total_que_section'][2]) * 100 }}%</td>
                                                <td>{{ ($item['total_correct_section'][3] / $item['total_que_section'][3]) * 100 }}%</td>
                                                <td>{{ ($item['total_correct_section'][4] / $item['total_que_section'][4]) * 100 }}%</td>
                                                <td class="text-center">
                                                    <a href="/result-test/download/pdf/{{ $item['user_id'] }}" class="btn btn-green">Download Result</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
