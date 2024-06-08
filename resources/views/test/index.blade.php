@extends('layout/maintest')

@section('content')
<div class="container">
    <div class="row">
        <div class="col p-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1 text-center">
                            @foreach ($data_p->sections as $item)
                                @php
                                    $num = 0;
                                    if($item->section_code == 'SV'){
                                        $num = 1;
                                    }else if($item->section_code == 'CE'){
                                        $num = 16;
                                    }else if($item->section_code == 'LC'){
                                        $num = 31;
                                    }else if($item->section_code == 'RC'){
                                        $num = 46;
                                    }
                                @endphp
                                <a href="/do-test/sec/{{ $item->id }}/que/{{ $num }}" class="text-decoration-none">
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $item->section_code }}
                                            <div class="progress progress-bar-vertical mt-3">
                                                <div class="progress progress-bar-vertical-green" style="height: 60%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="col">
                            <div class="card pt-3 pb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            @foreach ($data_q as $item)
						                        @php
                                                    $answeredColor = 'btn-green';
                                                    $answeredColorCaret = '';
                                                    foreach ($que_answered_all as $answer) {
                                                        if ($item->id == $answer->question_test_id) {
                                                            $answeredColor = 'btn-secondary';
                                                            $answeredColorCaret = 'text-secondary';
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <a href="/do-test/sec/{{ $item->section_id }}/que/{{ $item->que_num }}" class="btn {{ $answeredColor }} mb-2 text-decoration-none" style="width: 5rem">
                                                    {{ $item->que_num }}
                                                </a>
                                                @if ($que_selected->que_num == $item->que_num)
                                                    <i class="bi bi-caret-right-fill i-num {{ $answeredColorCaret }}" style="position: absolute; left: 5.5rem; "></i>
                                                @endif

                                                <br>
                                            @endforeach
                                        </div>
                                        <div class="col">
                                            <div class="question-content">
                                                <h4><?php echo $que_selected->que_content; ?></h4>

                                                <div>
                                                    <button type="button" class="btn btn-outline-green mt-3" data-bs-toggle="popover" data-bs-title="Bahasa Indonesia" data-bs-content="<?php echo $que_selected->que_content_ind ?>">Your Language 1 <i class="bi bi-box-arrow-up-right ms-2"></i></button>
                                                </div>

                                                <div>
                                                    <button type="button" class="btn btn-outline-green my-3" data-bs-toggle="popover" data-bs-title="English" data-bs-content="<?php echo $que_selected->que_content_eng ?>">Your Language 2 <i class="bi bi-box-arrow-up-right ms-2"></i></button>
                                                </div>

                                                @if ($que_selected->que_audio != null)
                                                    <div class="mt-3">
                                                        <audio id="audioPlayer" src="{{ URL::asset('storage/' . $que_selected->que_audio); }}">
                                                            Audio not supported
                                                        </audio>
                                                        
                                                        <div class="d-flex align-items-center">
                                                            <button type="button" class="btn btn-green px-3 mb-2" id="togglePlayAudio" onclick="togglePlay()">
                                                                <i class="bi bi-play-circle-fill i-aud" id="playButton"></i>
                                                            </button>
                                                            <div class="ms-4">
                                                                <div class="d-flex">
                                                                    <h5 id="duration">0:00</h5>
                                                                    <h5 class="ms-4" id="times">0x</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="my-4">
                                                    @if ($que_selected->que_img != null)
                                                        <img style="max-width: 540px" src="{{ URL::asset('storage/' . $que_selected->que_img); }}" alt="Image Question {{ $que_selected->que_num }}" class="img-thumbnail">
                                                    @endif
                                                </div>

                                                <div class="me-5 pe-5">
                                                    <div class="row gap-3">
                                                        @foreach ($que_selected->group_options[0]->options as $item)
                                                            @if ($item->opt_content != null) 
                                                                <button id="option-btn" class="btn btn-outline-green text-dark py-2" type="button" onclick="changeStyle(this)" data-char="{{ $item->opt_char }}">
                                                                    <span style="font-size: 20pt;">{{ $item->opt_char }}. <?php echo $item->opt_content ?> </span>
                                                                </button>
                                                            @endif
                                                            @if ($item->opt_img != null)
                                                                <div class="card p-2" style="width: 12rem; border-color: #638C29; margin: 0;">
                                                                    <img src="{{ URL::asset('storage/' . $item->opt_img); }}" class="card-img-top" alt="Image Option {{ $item->opt_char }}" width="100">
                                                                    <div class="text-center mt-2">
                                                                        <button class="btn btn-outline-green text-dark py-2 stretched-link" id="option-btn" type="button" onclick="changeStyle(this)" data-char="{{ $item->opt_char }}">{{ $item->opt_char }}.</button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>
@endsection
