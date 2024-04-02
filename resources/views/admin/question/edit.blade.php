@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5 mx-5">
                    <a href="/section/{{ $data->section_id }}" class="btn btn-outline-green" style="width: 7rem">< Back</a>
                    <h2 class="text-center">Edit Question</h2>
                    
                    <h3 class="text-center">Nomor {{ $data->que_num }}</h3>
                    <div class="row justify-content-center ">
                        <div class="col-11 my-3">
                            <form action="/question/{{ $data->id }}" method="post" enctype="multipart/form-data">
                                <div class="body-question">
                                    @csrf
                                    @method('put')
                                    <h4>Soal</h4>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="que_num" class="form-label">Nomor Soal</label>
                                        <input type="text" class="form-control" id="que_num" name="que_num" value="{{ $data->que_num }}">
                                    </div>
                                                                        
                                    <div class="mb-3">
                                        <label for="que_content" class="form-label">Isi Soal</label>
                                        <textarea class="form-control" id="que_content" rows="3" name="que_content" >{{ $data->que_content }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="que_content_eng" class="form-label">Isi Soal (eng)</label>
                                        <textarea class="form-control" id="que_content_eng" rows="3" name="que_content_eng" >{{ $data->que_content_eng }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="que_content_ind" class="form-label">Isi Soal (ind)</label>
                                        <textarea class="form-control" id="que_content_ind" rows="3" name="que_content_ind" >{{ $data->que_content_ind }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        @if ($data->que_audio != null)
                                            <audio controls src="{{ url('storage/' . $data->que_audio) }}"></audio>
                                        @else
                                            <p>No Audio</p>
                                        @endif

                                        <label for="que_audio" class="form-label">Audio</label>
                                        <input class="form-control" type="file" id="que_audio" name="que_audio">
                                    </div>

                                    <div class="mb-3">
                                        @if ($data->que_img != null)
                                            <img src="{{ url('storage/' . $data->que_img) }}" alt="Image Question {{ $data->que_num }}" width="100">
                                        @else
                                            <p>No Image</p>
                                        @endif

                                        <label for="que_img" class="form-label">Gambar</label>
                                        <input class="form-control" type="file" id="que_img" name="que_img">
                                    </div>

                                    <div class="mb-5">
                                        <label for="que_score" class="form-label">Bobot Soal</label>
                                        <input type="text" class="form-control" id="que_score" name="que_score" value="{{ $data->que_score }}">
                                    </div>

                                    <h4>Pilihan</h4>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="opt_title" class="form-label">Title Pertanyaan</label>

                                        @if (isset($data->group_options[0]->opt_title))
                                            <input type="text" class="form-control" id="opt_title" name="opt_title" placeholder="Tambahkan title pertanyaan (opsional)" value="{{ $data->group_options[0]->opt_title }}">
                                        @else
                                            <input type="text" class="form-control" id="opt_title" name="opt_title" placeholder="Tambahkan title pertanyaan (opsional)">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="opt_correct" class="form-label">Jawaban Benar</label>
                                        <select class="form-select" name="opt_correct" id="opt_correct" aria-label="Default select">
                                            <option value="" disabled selected>Silakan Pilih</option>
                                            <option value="A" {{ $data->group_options[0]->opt_correct == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $data->group_options[0]->opt_correct == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ $data->group_options[0]->opt_correct == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ $data->group_options[0]->opt_correct == 'D' ? 'selected' : '' }}>D</option>
                                        </select>

                                    </div>

                                    @foreach ($data->group_options[0]->options as $data_opt)
                                        <div class="row mb-3">
                                            <div class="col-1 text-center">
                                                {{ chr($loop->index + 65) }}.
                                            </div>
                                            <div class="col-5">
                                                <label for="opt_content_{{ strtolower(chr($loop->index + 65)) }}" class="form-label">Isi Opsi</label>
                                                <textarea class="form-control" id="opt_content_{{ strtolower(chr($loop->index + 65)) }}" rows="3" name="opt_content_{{ strtolower(chr($loop->index + 65)) }}" value="{{ $data_opt->opt_content }}">{{ $data_opt->opt_content }}</textarea>
                                            </div>
                                            <div class="col-6">
                                                @if ($data_opt->opt_img != null)
                                                    <img src="{{ url('storage/' . $data_opt->opt_img) }}" alt="Image Option {{ chr($loop->index + 65) }}" width="100">
                                                @else
                                                    <p>No Image</p>
                                                @endif
                                                <label for="opt_img_{{ strtolower(chr($loop->index + 65)) }}" class="form-label">Gambar Opsi</label>
                                                <input class="form-control" type="file" id="opt_img_{{ strtolower(chr($loop->index + 65)) }}" name="opt_img_{{ strtolower(chr($loop->index + 65)) }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    <a href="/section/{{ $data->section_id }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-green">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection