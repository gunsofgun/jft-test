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
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['total_point'] }}</td>

                                        @if (count($item['total_correct_section']) == 0)
                                            <td colspan="4" class="text-center">Data Kosong!</td>
                                        @else
                                            @for ($i = 1; $i < 5; $i++)
                                                @if(isset($item['total_correct_section'][$i]))
                                                    <td>{{ number_format(($item['total_correct_section'][$i] / $item['total_que_section'][$i]) * 100 , 2) }}%</td>
                                                @else
                                                    <td>
                                                        0%
                                                    </td>
                                                @endif
                                            @endfor
                                        @endif
                                        <td class="text-center">
                                            {{ isset($item['total_correct_section'][1]) && $item['total_correct_section'][1] < 0 ? 'disabled' : '' }}

                                            <a href="/result-test/download/pdf/{{ $item['user_id'] }}" 
                                            class="btn btn-green {{ count($item['total_correct_section']) == 0 ? 'disabled' : '' }} ">Download Result</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
