@extends('frontend.home')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Jadwal</h2>
            <ol>
                <li><a href="{{ route('frontend.home') }}">Home</a></li>
                <li>Jadwal</li>
            </ol>
        </div>
    </div>
</section>

<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-12 mt-3">
            <div id='calendar'></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-action" tabindex="-1" aria-labelledby="modalActionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActionLabel">Detail Pemesanan : <span id="selected-date"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pesanan-details">
                    <!-- Pesanan details will be appended here -->
                </div>
                <p id="no-pesanan-message" style="display: none;">Tidak ada pesanan pada hari ini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                @auth
                    <a href="" id="buat-pesanan-link" class="btn btn-success">Buat Pesanan</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
    /* Mengubah warna tombol prev, next, dan today */
    .fc .fc-prev-button, 
    .fc .fc-next-button, 
    .fc .fc-today-button {
        background-color: #006400 !important;
        border-color: #006400 !important;
        color: #ffffff !important;
    }

    .fc .fc-prev-button:hover, 
    .fc .fc-next-button:hover, 
    .fc .fc-today-button:hover {
        background-color: #004d00 !important;
        border-color: #004d00 !important;
    }

    /* Mengubah warna event */
    .fc-event {
        background-color: #006400 !important;
        border-color: #006400 !important;
        color: #ffffff !important; /* Warna teks event menjadi putih */
    }

    /* Mengubah warna teks pada event */
    .fc-event .fc-event-title, .fc-event .fc-event-time {
        color: #ffffff !important; /* Warna teks event menjadi putih */
    }

    /* Mengubah warna teks pada tombol prev, next, dan today */
    .fc .fc-prev-button, 
    .fc .fc-next-button, 
    .fc .fc-today-button {
        color: #ffffff !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.14/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/locales-all.global.min.js"></script>
<script>
function formatRupiah(angka) {
    var number_string = angka.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return 'Rp ' + rupiah;
}

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        locale: 'id',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        events: `{{ route('frontend.list') }}`,
        dateClick: function(info) {
            var dateStr = info.dateStr;
            $.ajax({
                url: `{{ route('frontend.pesanan-by-date') }}`,
                data: { date: dateStr },
                success: function(data) {
                    $('#pesanan-details').empty();
                    $('#bayar-pesanan-link').hide();
                    let adaPesananDisetujui = false;
                    const userId = {{ auth()->check() ? auth()->user()->id : 'null' }};

                    data.forEach(function(pesanan) {
                        if (pesanan.status_konfirmasi === 'disetujui') {
                            adaPesananDisetujui = true;
                            var statusText = 'Pesanan anda telah disetujui, silahkan melakukan pembayaran!';
                            if (pesanan.status_pembayaran === 'lunas') {
                                statusText = 'Telah Dibayar';
                            }

                            var pesananHtml = `
                              <p><strong>Nama Kegiatan :</strong> ${pesanan.nama_kegiatan}</p>
                              <p><strong>Mulai :</strong> ${new Date(pesanan.tanggal_mulai).toLocaleString()}</p>
                              <p><strong>Selesai :</strong> ${new Date(pesanan.tanggal_selesai).toLocaleString()}</p>
                            `;

                            if (userId !== 'null' && userId === pesanan.user_id) {
                                pesananHtml += `
                                  <p><strong>Biaya:</strong> ${formatRupiah(Math.floor(pesanan.total_biaya))}</p>
                                  <p><strong>Status:</strong> ${statusText}</p>
                                `;
                                if (pesanan.status_pembayaran !== 'lunas') {
                                    pesananHtml += `<a href="{{ url('form-bayar') }}?id=${pesanan.id}" class="btn btn-success">Catat Pembayaran</a>`;
                                }
                            }

                            pesananHtml += '<hr>';
                            $('#pesanan-details').append(pesananHtml);
                            $('#bayar-pesanan-link').attr('href', `{{ url('form-bayar') }}?id=${pesanan.id}`).show();
                        }
                    });

                    if (!adaPesananDisetujui) {
                        $('#no-pesanan-message').show();
                    } else {
                        $('#no-pesanan-message').hide();
                    }

                    $('#selected-date').text(dateStr);
                    @auth
                    $('#buat-pesanan-link').attr('href', `{{ url('form-pesanan') }}?date=${dateStr}`).show();
                    @endauth
                    $('#modal-action').modal('show');
                }
            });
        }
    });
    calendar.render();
});
</script>
@endsection
