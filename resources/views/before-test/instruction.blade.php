@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5">
                    {{-- @dd($data) --}}
                    <div class="row">
                        <div class="col">
                            <a href="/before-test" class="btn btn-outline-green py-2">< Kembali</a>
                        </div>
                        <div class="col">
                            <h2 class="text-center">Petunjuk Pengerjaan</h2>
                        </div>
                        <div class="col"></div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-8 card-text fs-5 my-4">
                            <ul>
                                <li>Pilihlah jawaban yang benar</li>
                                <li>Dilarang mencontek dan mengartikan menggunakan browser internet</li>
                                <li>Waktu mengerjakan {{ $data['datap']->time_test }} menit untuk {{ $data['totalq'] }} soal</li>
                                <li>Total point yang bisa didapatkan 250. Nilai kelulusan minimal 200 point</li>
                            </ul>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-green fs-5 me-3 px-5 py-2 text-white" data-bs-toggle="modal" data-bs-target="#startModal">
                            Mulai
                        </button>
    
                        <a href="https://www.jpf.go.jp/jft-basic/sample/q01.html" class="btn btn-outline-green fs-5 px-5 py-2" target="_blank">Contoh Soal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="startModal" tabindex="-1" aria-labelledby="startModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="startModalLabel">Konfirmasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fs-6">
            <p>
                Apakah kamu yakin ingin memulai simulasi test? <br>
                Test memiliki durasi, yaitu <b>{{ $data['datap']->time_test }} menit</b> setelah tombol <b>"Ya"</b> dipilih.
            </p>
        </div>
        <div class="modal-footer">
            <a href="/do-test/sec/{{ $data['sec_id'] }}/que/1" class="btn btn-green fs-6 me-3 px-4 py-1 text-white">Ya</a>
            <button type="button" class="btn btn-outline-green fs-6 px-4 py-1" data-bs-dismiss="modal">Tidak</button>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection