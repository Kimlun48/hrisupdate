<div class="modal-body">
    <form id="editForm" method="post">
        @csrf
        <div class="form-group" hidden>
        <label for="date">id</label>
        <input type="text" class="form-control" id="id"  name="id" readonly>
        </div>
        <div class="form-group">
        <label for="date">Date:</label>
        <input type="text" class="form-control" id="date" value="{{ date('d-m-Y', strtotime($presensi->tanggal)) }}"  name="date" readonly>
        </div>
        <div class="form-group">
            <label for="scheduleIn">Shift:</label>
            <select id="scheduleIn" name="shift_id" class="form-control scltd">
                @foreach ($shift as $item)
                <option value="{{ $item->id }}" {{ $item->id == $presensi->id_parampresensi  ? 'selected' :''}}>{{ $item->jenis_shift }} ({{ $item->jam_masuk }} - {{ $item->jam_pulang }})</option>               
                    <!-- <option value="{{ $item->id }}">{{ $item->jenis_shift }} ({{ $item->jam_masuk }} - {{ $item->jam_pulang }})</option> -->
                @endforeach
            </select>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <span class="arrow-icon">&#9660;</span>
                <h6 class="texthead" id="collapseHeading">Attendance</h6>
                <h6 class="texthead text-right text-danger clear-all">Clear </h6>
            </div>
            <div class="accordion-content" id="collapseContent">
                <div class="form-container">
                    <div class="form-group form-attend left-form">
                        <label for="clockIn">Clock In:</label>
                        <input type="time" class="form-control" value="{{ $presensi->jam_masuk ? \Carbon\Carbon::parse($presensi->jam_masuk)->format('H:i') : '' }}" id="clockIn" name="clockIn">
                    </div>
                    <div class="form-group form-attend right-form">
                        <label for="clockOut">Clock Out:</label>
                        <input type="time" class="form-control" value="{{ $presensi->jam_pulang ? \Carbon\Carbon::parse($presensi->jam_pulang)->format('H:i') : '' }}" id="clockOut" name="clockOut">
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header">
                <span class="arrow-icon">&#9660;</span>
                <h6 class="texthead" id="collapseHeading">Time Off</h6>
                <h6 class="texthead text-right text-danger clear-all" id="clearButton">Clear </h6>
            </div>
            <div class="accordion-content" id="collapseContent">
                <div class="form-group">
                    <label for="timeOffStart">Select Time Off:</label>
                    <select name="time_off" id="timeoff" class="form-control scltd time">
                        <option value="">Select time...</option>
                        <option value="clear">Clear TimeOff</option>
                        
                            @foreach ($timeoff as $time)
                            <option value="{{ $time->id }}" {{ $time->nama == $presensi->presensi_status  ? 'selected' :''}}>{{ $time->nama }} </option>               
                            @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="accordion">
            <div class="accordion-header" style="border-bottom:0px">
                <span class="arrow-icon">&#9660;</span>
                <h6 class="texthead" id="collapseHeading">Overtime</h6>
                <h6 class="texthead text-right text-danger clear-all">Clear</h6>
            </div>
            <div class="accordion-content" id="collapseContent">
                <div class="form-container">
                    <div class="form-group form-overtime left-form">
                        <label for="breaktimeStart">Overtime Start:</label>
                        @if($ovtime)
                        <input type="time" class="form-control" value="{{ $ovtime->mulai ? \Carbon\Carbon::parse($ovtime->mulai)->format('H:i') : '' }}" id="breaktimeStart" name="ovtstart">
                        @else
                        <input type="time" class="form-control" id="breaktimeStart" name="ovtstart">
                        @endif
                    </div>
                    <div class="form-group form-overtime right-form">
                        <label for="breaktimeEnd">Overtime End:</label>
                        @if($ovtime)
                        <input type="time" class="form-control" value="{{ $ovtime->akhir ? \Carbon\Carbon::parse($ovtime->akhir)->format('H:i') : '' }}" id="breaktimeEnd" name="ovtend">
                         @else
                         <input type="time" class="form-control" id="breaktimeEnd" name="ovtend">

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" defer integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />




<script>
    $(document).ready(function() {
        // console.log("Script loaded and running"); // Pesan konfirmasi bahwa skrip dimuat

        var uniqueOptions = [];
        $('#timeoff option').each(function() {
            var optionText = $(this).text();
            var lowercaseOption = optionText.toLowerCase();
            
            // console.log("Option text:", optionText); // Tampilkan teks opsi dalam konsol
            // console.log("Lowercase option:", lowercaseOption); // Tampilkan teks opsi dalam huruf kecil

            if (uniqueOptions.indexOf(lowercaseOption) === -1) {
                uniqueOptions.push(lowercaseOption);
                // console.log("Option added:", optionText); // Tampilkan pesan jika opsi baru ditambahkan
            } else {
                $(this).remove(); // Hapus opsi yang sama
                // console.log("Option removed:", optionText); // Tampilkan pesan jika opsi dihapus
            }
        });

        // console.log("Unique options:", uniqueOptions); // Tampilkan daftar opsi unik di konsol
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Temukan elemen "Clear" berdasarkan ID
    var clearButton = document.getElementById("clearButton");

    // Tambahkan event click pada elemen "Clear"
    clearButton.addEventListener("click", function () {
        // Temukan elemen seleksi waktu
        var timeOffSelect = document.getElementById("timeoff");

        // Setel nilai seleksi waktu ke "clear"
        timeOffSelect.value = "clear";
    });
});
</script>


<script>
    $(document).ready(function () {
        $('.scltd').selectize({
            sortField: 'text'
        });
    });

    $(document).ready(function() {
    $(".accordion-header").click(function() {
        var content = $(this).next(".accordion-content"); // Find the content within the clicked accordion
        content.slideToggle(); // Toggle the content
        $(this).find(".arrow-icon").toggleClass("rotate"); // Toggle arrow rotation within the clicked accordion
    });

    $(".clear-all").click(function() {
        var accordion = $(this).closest(".accordion"); // Find the parent accordion of the clicked "Clear" button
        accordion.find(".form-control").val(""); // Clear input values within the same accordion
        return false;
    });
});


</script>


<style>
.accordion {
    /* margin: 20px; */
    width: 470px;
}

.accordion-header {
    /* background-color: #f0f0f0; */
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
    display: flex;
    width: 115%;
    /* align-items: center; */
    justify-content: space-between;
}

.accordion-header .texthead {
    margin: 0; /* Menghilangkan margin default dari h6 */
    /* margin-right: 340px; */
    margin-left: 20px;
    text-wrap: nowrap;

}


.accordion-header:hover {
    background-color: #e0e0e0;
}

.arrow-icon {
    transition: transform 0.3s ease;
}

.rotate {
    transform: rotate(-180deg);
}

.accordion-content {
    display: none;
    padding: 10px;
    width: 116%;
    /* background-color: #f9f9f9; */
}

.form-container {
    display: flex;
    justify-content: space-between;
}

.clear-all {
    margin: 0;
}

.form-attend {
    width: 48%; /* Lebar form di dalam form-container */
}
.form-overtime {
    width: 48%; /* Lebar form di dalam form-container */
}
.form-timeoff {
    width: 48%; /* Lebar form di dalam form-container */
}

.left-form {
    margin-right: 10px; /* Jarak antara form kiri dan kanan */
}

.right-form {
    margin-left: 10px; /* Jarak antara form kanan dan kiri */
}



</style>