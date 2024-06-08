<div class="fixed-bottom">
    <div class="bg-green" style="height: 1vh">
    </div>
    <div class="bg-black">
        <div class="container">
            <div class="row py-1">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col-md-5 text-end d-flex gap-2 justify-content-end">
                    <form action="/do-test" method="post">
                        @csrf
                        <input type="hidden" name="answer_char" id="answer_char" value="z">
                        <input type="hidden" name="question_test_id" id="question_test_id" value="{{ $que_selected->id }}">
                        <input type="hidden" name="section_id" id="section_id" value="{{ $que_selected->section_id }}">
                        <input type="hidden" name="user_answer_id" id="user_answer_id" value="{{ $user_answer }}">
                        <input type="hidden" name="movement" id="movement">
                    
                        <button class="invisible" type="submit" id="btnSubmit"></button>
                        <button type="submit" class="btn btn-green fs-6 fw-semibold" onclick="doMovement(this)" data-move="back" {{ ($que_selected->que_num == 1 && ($que_selected->section_id == 1 || $que_selected->section_id == 5)) ? 'disabled' : '' }}>
                            <i class="bi bi-caret-left" style="font-size: 1rem;"></i>
                            Back
                        </button>
                        <button type="submit" class="btn btn-green fs-6 fw-semibold" onclick="doMovement(this)" data-move="next" {{ $latest_q->id == $que_selected->id && ($que_selected->section_id == 4 || $que_selected->section_id == 8) ? 'disabled' : '' }}>
                            Next
                            <i class="bi bi-caret-right" style="font-size: 1rem;"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Pop Over
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

        // Prevent Inspect
        // $(document).keydown(function (event) {
        //     if (event.keyCode == 123) { // Prevent F12
        //         return false;
        //     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        //         return false;
        //     }
        // });
        //     $(document).on("contextmenu", function (e) {        
        //     e.preventDefault();
        // });

        function doMovement(btn) {
            var moveValue = btn.getAttribute('data-move');
            document.getElementById('movement').value = moveValue;
        }

        // Button Option
        function changeStyle(btn) {
            // Remove custom style from all buttons
            var buttons = document.querySelectorAll('#option-btn');
            buttons.forEach(function(button) {
                button.classList.remove("btn-green");
                button.classList.add("btn-outline-green", "text-dark");
            });

            // Apply custom style to the clicked button
            btn.classList.remove("btn-outline-green", "text-dark");
            btn.classList.add("btn-green");

            // Set value dari button ke inputan
            var charValue = btn.getAttribute('data-char');
            document.getElementById('answer_char').value = charValue;
        }

        // Fungsi untuk mengklik tombol secara otomatis
        function autoClickButton(optChar) {
            // Cari tombol dengan atribut data-char yang sesuai dengan optChar
            var button = document.querySelector('button[data-char="' + optChar + '"]');

            // Jika tombol ditemukan, klik tombol tersebut
            if (button) {
                button.click();
            }
        }

        function finishButton() {
            localStorage.clear();
            document.getElementById('movement').value = 'finish';
            var buttonSubmit = document.getElementById('btnSubmit');
            buttonSubmit.click();
        }

        // Panggil fungsi autoClickButton dengan nilai opt_char dari $que_answered
        @if ($que_answered)
            var optChar = "{{ $que_answered->answer_char }}";
            autoClickButton(optChar);
        @endif

        // Play Pause
        var audio = document.getElementById('audioPlayer');
        var playButton = document.getElementById('playButton');
        var togglePlayAudio = document.getElementById('togglePlayAudio');
        var playCount = localStorage.getItem("playCount-{{ Auth::user()->id }}-{{ $que_selected->section_id }}-{{ $que_selected->que_num }}") || 0;

        var timeDisplay = document.getElementById('times');
        if(playCount && timeDisplay){
            timeDisplay.textContent = playCount + 'x';
        }

        function togglePlay() {
            if (playCount < 2) {
                playButton.classList.remove('bi-play-circle-fill');
                playButton.classList.add('bi-pause-circle-fill');
                
                playCount++;
                timeDisplay.textContent = playCount + 'x';
                localStorage.setItem("playCount-{{ Auth::user()->id }}-{{ $que_selected->section_id }}-{{ $que_selected->que_num }}", playCount);
                audio.play();
                togglePlayAudio.disabled = true;
            } else {
                alert('Kamu sudah memutar audio sebanyak 2x!');
            }
        }

        if(audio) {
            audio.addEventListener('ended', function() {
                playButton.classList.remove('bi-pause-circle-fill');
                playButton.classList.add('bi-play-circle-fill');
                togglePlayAudio.disabled = false;
            });

            var durationDisplay = document.getElementById('duration');
            audio.addEventListener('timeupdate', function() {
                var minutes = Math.floor(audio.currentTime / 60);
                var seconds = Math.floor(audio.currentTime - minutes * 60);
                var duration = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                durationDisplay.textContent = duration;
            });
        }
    </script>
</div>