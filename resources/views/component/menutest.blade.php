<div class="header">
    <div class="bg-black">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2">
                <div class="col-md-4 mb-2 mb-md-0 text-white">
                    <p class="mb-0"><b>Question:</b> {{ $que_selected->que_num }} </p>
                    @if ($data_q[0]['section_id'] > 4)
                        <p class="mb-0"><b>Section:</b> {{ $data_p->sections[$data_q[0]['section_id']-5]->section_name }} </p>
                    @else
                        <p class="mb-0"><b>Section:</b> {{ $data_p->sections[$data_q[0]['section_id']-1]->section_name }} </p>
                    @endif
                </div>

                <div class="col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <div class="row">
                        <div class="col-2">
                            <i class="bi bi-stopwatch i-menu"></i>
                        </div>
                        <div class="col-10 text-white">
                            <p class="mb-0">Section Time Remaining</p>
                            <p id="countdownTimer" class="mb-0">00:00:00</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-finish fs-5 fw-semibold px-5 py-1" data-bs-toggle="modal" data-bs-target="#finishModal"> Finish Test </button>
                </div>
            </header>
        </div>
    </div>
    <div class="bg-green">
        <div class="container">
            <div class="row text-white">
                <div class="col-6 ">
                    <p class="mb-0"><b>Test:</b> Simulasi Japan Foundation Test for Basic Japanese</p>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-0"><b>Candidate:</b> {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
<div class="modal-dialog text-center">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="finishModalLabel">Konfirmasi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body fs-6">
        <h6>
            Apakah kamu yakin ingin menyelesaikan simulasi test? <br>
        </h6>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green fs-6 me-3 px-4 py-1 text-white" onclick="finishButton()">Ya</button>
        <button type="button" class="btn btn-outline-green fs-6 px-4 py-1" data-bs-dismiss="modal">Tidak</button>
    </div>
    </div>
</div>
</div>

<script>
    // Mendapatkan durasi timer dari variabel Laravel Blade
    const timerDuration = {{ $data_p->time_test }} * 60 * 1000; // Konversi menit ke milidetik

    let remainingTime;
    const countdownElement = document.getElementById('countdownTimer');

    // Cek apakah ada waktu yang tersisa di local storage
    if (localStorage.getItem('remainingTime-{{ Auth::user()->id }}')) {
        remainingTime = localStorage.getItem('remainingTime-{{ Auth::user()->id }}');
    } else {
        remainingTime = timerDuration / 1000;
    }

    // Fungsi untuk menekan tombol "Finish" secara otomatis
    function finishTimer() {
        document.getElementById("finishButton").click();
    }

    // Fungsi untuk meng-update countdown timer
    function updateCountdown() {
        const hours = Math.floor(remainingTime / 3600);
        const minutes = Math.floor((remainingTime % 3600) / 60);
        const seconds = remainingTime % 60;

        const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        
        countdownElement.textContent = formattedTime;

        // Kurangi waktu tersisa
        remainingTime--;

        // Hentikan countdown jika waktu telah habis
        if (remainingTime < 0) {
            clearInterval(intervalId);
            finishTimer();
        }
    }

    // Mulai countdown
    const intervalId = setInterval(updateCountdown, 1000);

    // Simpan waktu yang tersisa ke local storage setiap detik
    setInterval(() => {
        localStorage.setItem('remainingTime-{{ Auth::user()->id }}', remainingTime);
    }, 1000);

    // Mulai timer
    setTimeout(finishTimer, remainingTime * 1000);
</script>
