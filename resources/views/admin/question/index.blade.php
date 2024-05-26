@extends('layout/main')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-body p-5 ">
                    <a href="/package/{{ $section->package_test_id }}" class="btn btn-outline-green" style="width: 11rem">< Kembali</a>
                    <h2 class="text-center">List Question</h2>
                    <h3 class="text-center">{{ $section->section_name }}</h3>
                    <hr>
                    <div class="row justify-content-center ">
                        <div class="col my-3">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#addModal">
                                    Tambah Soal
                                </button>
                            </div>
                            <table class="table table-striped table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Isi Soal</th>
                                        <th scope="col">Isi Soal (eng)</th>
                                        <th scope="col">Isi Soal (ind)</th>
                                        <th scope="col">Audio</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Bobot Soal</th>
                                        <th scope="col">Pilihan Ganda</th>
                                        <th scope="col">Jawaban</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) == 0)
                                        <tr>
                                            <td colspan="9" class="text-center">Data Kosong!</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->que_num }}</td>
                                                <td>{{ $item->que_content }}</td>
                                                <td>{{ $item->que_content_eng != null ? $item->que_content_eng : '-' }}</td>
                                                <td>{{ $item->que_content_ind != null ? $item->que_content_ind : '-' }}</td>

                                                <td>
                                                    @if ($item->que_audio != null)
                                                        <audio controls src="{{ URL::asset('storage/' . $item->que_audio); }}"></audio>
                                                    @else
                                                        <p>No Audio</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->que_img != null)
                                                        <img src="{{ URL::asset('storage/' . $item->que_img); }}" alt="Image Question {{ $item->que_num }}" width="100">
                                                    @else
                                                        <p>No Image</p>
                                                    @endif
                                                </td>
                                                <td>{{ $item->que_score }}</td>
                                                <td>
                                                    @if ($item->group_options->isEmpty())
                                                        <p>-</p>
                                                    @else
                                                        @if ($item->group_options[0]->opt_title != null)
                                                            <p>{{ $item->group_options[0]->opt_title }}</p>
                                                        @endif

                                                        @foreach ($item->group_options[0]->options as $item_opt)
                                                            @if ($item_opt->opt_content != null)
                                                                <p>{{ chr($loop->index + 65) }}. {{ $item_opt->opt_content }}</p>
                                                            @endif

                                                            @if ($item_opt->opt_img != null)
                                                                <p>
                                                                    {{ chr($loop->index + 65) }}. 
                                                                    <img src="{{ url('storage/' . $item_opt->opt_img) }}" alt="Image Option {{ chr($loop->index + 65) }}" width="100">
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->group_options->isEmpty())
                                                        <p>-</p>
                                                    @else
                                                        <p>{{ $item->group_options[0]->opt_correct }}</p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="/question/{{ $item->id }}" class="btn btn-warning me-3">Edit</a>
                                                    @if ($item->group_options->isEmpty())
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger my-2" 
                                                            disabled
                                                        >
                                                            Delete
                                                        </button>
                                                    @else
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger my-2" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModal" 
                                                            data-id="{{ $item->group_options[0]->id }}" 
                                                            data-id-s="{{ $item->section_id }}"
                                                        >
                                                            Delete
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<form action="/question/{{ $ids }}" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Tambah Soal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <h4>Soal</h4>
                <hr>
                <div class="mb-3">
                    <label for="que_num" class="form-label">Nomor Soal</label>
                    <input type="text" class="form-control" id="que_num" name="que_num" required>
                </div>
                
                <div class="mb-3">
                    <label for="que_content" class="form-label">Isi Soal</label>
                    <textarea class="form-control" id="que_content" rows="3" name="que_content" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="que_content_eng" class="form-label">Isi Soal (eng)</label>
                    <textarea class="form-control" id="que_content_eng" rows="3" name="que_content_eng"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="que_content_ind" class="form-label">Isi Soal (ind)</label>
                    <textarea class="form-control" id="que_content_ind" rows="3" name="que_content_ind"></textarea>
                </div>

                <div class="mb-3">
                    <label for="que_audio" class="form-label">Audio</label>
                    <input class="form-control" type="file" id="que_audio" name="que_audio">
                </div>

                <div class="mb-3">
                    <label for="que_img" class="form-label">Gambar</label>
                    <input class="form-control" type="file" id="que_img" name="que_img">
                </div>

                <div class="mb-5">
                    <label for="que_score" class="form-label">Bobot Soal</label>
                    <input type="text" class="form-control" id="que_score" name="que_score" required>
                </div>

                <h4>Pilihan</h4>
                <hr>

                <div class="mb-3">
                    <label for="opt_title" class="form-label">Title Pertanyaan</label>
                    <input type="text" class="form-control" id="opt_title" name="opt_title" placeholder="Tambahkan title pertanyaan (opsional)">
                </div>

                <div class="mb-3">
                    <label for="opt_correct" class="form-label">Jawaban Benar</label>
                    <select class="form-select" name="opt_correct" id="opt_correct" aria-label="Default select">
                        <option selected disabled>Silahkan Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-1 text-center">
                        A.
                    </div>
                    <div class="col-5">
                        <label for="opt_content_a" class="form-label">Isi Opsi</label>
                        <textarea class="form-control" id="opt_content_a" rows="3" name="opt_content_a"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="opt_img_a" class="form-label">Gambar Opsi</label>
                        <input class="form-control" type="file" id="opt_img_a" name="opt_img_a">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-1 text-center">
                        B.
                    </div>
                    <div class="col-5">
                        <label for="opt_content_b" class="form-label">Isi Opsi</label>
                        <textarea class="form-control" id="opt_content_b" rows="3" name="opt_content_b"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="opt_img_b" class="form-label">Gambar Opsi</label>
                        <input class="form-control" type="file" id="opt_img_b" name="opt_img_b">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-1 text-center">
                        C.
                    </div>
                    <div class="col-5">
                        <label for="opt_content_c" class="form-label">Isi Opsi</label>
                        <textarea class="form-control" id="opt_content_c" rows="3" name="opt_content_c"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="opt_img_c" class="form-label">Gambar Opsi</label>
                        <input class="form-control" type="file" id="opt_img_c" name="opt_img_c">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-1 text-center">
                        D.
                    </div>
                    <div class="col-5">
                        <label for="opt_content_d" class="form-label">Isi Opsi</label>
                        <textarea class="form-control" id="opt_content_d" rows="3" name="opt_content_d"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="opt_img_d" class="form-label">Gambar Opsi</label>
                        <input class="form-control" type="file" id="opt_img_d" name="opt_img_d">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-green">Simpan</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Soal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h5>Apakah kamu yakin ingin menghapus soal ini?</h5>
      </div>
      <div class="modal-footer">
        <form action="/question" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="group_option_id" id="group_option_id" value="">
            <input type="hidden" name="section_id" id="section_id" value="">

            <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    $('#deleteModal').on('shown.bs.modal', function(event) {
        var reference_tag = $(event.relatedTarget); 
        var gOpId = reference_tag.data('id');
        var secId = reference_tag.data('id-s');
        $(".modal-footer #group_option_id").val( gOpId );
        $(".modal-footer #section_id").val( secId );
    })
</script>
@endsection
