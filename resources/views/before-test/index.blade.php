@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card text-center mb-3">
                <div class="card-body p-5">
                    <h2 class="card-title">Selamat Datang di <br> Simulasi JFT-Basic Nakayoshi Gakuin Center</h2>
                    <p class="card-text fs-5 mt-4">Simulasi ini digunakan untuk mengukur kemampuan bahasa Jepang yang diperlukan untuk berkomunikasi dalam situasi kehidupan sehari-hari serta menilai kualifikasi dalam hal “kemampuan percakapan sehari-hari dan kemampuan selama hidup di Jepang tanpa adanya kesulitan”</p>
                    <p class="card-text fs-5 mt-4">Jika kamu ingin mengetahui lebih jauh mengenai JFT-Basic bisa mengunjungi link <a href="https://www.jpf.go.jp/jft-basic/id/about/index.html" target="_blank">ini</a>.</p>

                    <a href="/instruction" class="btn btn-green fs-5 px-5 py-2 mt-3 text-white">Selanjutnya ></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection