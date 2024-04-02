@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5 text-center">
                    <h2>Tes Telah Selesai!</h2>
                    <h4>Hasilnya dapat kamu unduh pada tombol di bawah ini. </h4>
                    <h4>Terima kasih.</h4>

                    <div class="text-center mt-4">
                        <a href="/result-test/download/pdf" class="btn btn-green fs-5 me-3 px-5 py-2 text-white">
                            <i class="bi bi-file-earmark-arrow-down"></i>
                            Unduh Hasil
                        </a>
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
                Test memiliki durasi, yaitu <b>60 menit</b> setelah tombol <b>"Ya"</b> dipilih.
            </p>
        </div>
        <div class="modal-footer">
            <a href="/do-test" class="btn btn-green fs-6 me-3 px-4 py-1 text-white">Ya</a>
            <button type="button" class="btn btn-outline-green fs-6 px-4 py-1" data-bs-dismiss="modal">Tidak</button>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection