@extends('layouts.master')

@section('title')
    Data Mata Pelajaran
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="pdf_kehadiran" target="_blank" class="btn bg-purple btn-xs btn-flat"><i
                            class="fa fa-file-excel-o"></i> Export PDF</a>
                    <a class="btn btn-success btn-xs btn-flat" data-toggle="modal" data-target="#addAccountModal">Tambah
                        Data</a>
                </div>
                <section class="table-responsive">
                    <div class="box-body">
                        <table id="myTable" class="table table-stiped table-bordered text-center">
                            <thead class="bg-gray disabled color-palette">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Mapel</th>
                                    <th>Kode Mapel</th>
                                    <th>Jenjang Kelas</th>
                                    <th>Jumlah Jam
                                        /minggu
                                    </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($mapel as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->nama_mapel }}</td>
                                        <td>{{ $item->kode_mapel }}</td>
                                        <td>{{ $item->jenjang_kelas }}</td>
                                        <td>{{ $item->jumlah_jam }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-xs btn-flat btn-edit"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_mapel }}"
                                                data-kode="{{ $item->kode_mapel }}"
                                                data-jenjang="{{ $item->jenjang_kelas }}" data-jam="{{ $item->jumlah_jam }}"
                                                data-toggle="modal" data-target="#addAccountModal"><i
                                                    class="fa fa-pencil"></i></button>

                                            <a href="#" class="btn btn-xs btn-flat btn-danger delete-btn"
                                                data-id="{{ $item->id }}"
                                                data-url="{{ url('/admin/data-mata-pelajaran/delete/' . $item->id) }}"> <i
                                                    class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </section>
            </div>
        </div>
    </div>

    <div class="modal modal-secondary fade" id="addAccountModal" id="modal-primary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="modal-title">Buat Mata Pelajaran Baru</h4>
                </div>
                <form id="form-modal" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="mapel-id" name="id">
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mata Pelajaran</label>
                            <input type="text" name="nama_mapel" class="form-control" id="nama_mapel" required>
                        </div>

                        <div class="form-group">
                            <label for="kode_mapel">Kode Mata Pelajaran</label>
                            <input type="text" name="kode_mapel" class="form-control" id="kode_mapel" required>
                        </div>

                        <div class="form-group">
                            <label for="jenjang_kelas">Jenjang Kelas</label>
                            <input type="text" name="jenjang_kelas" class="form-control" id="jenjang_kelas" required>
                        </div>

                        <div class="form-group">
                            <label for="duration">Jumlah Jam <span class="text-danger small">*Dalam satu
                                    minggu</span></label>
                            <input type="number" name="jumlah_jam" class="form-control" id="jumlah_jam" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="modal-save-button">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('[data-target="#addAccountModal"]').addEventListener('click', function() {
                const modalForm = document.getElementById('form-modal');
                modalForm.reset();
                modalForm.setAttribute('action', "{{ route('data.mataPelajaran.store') }}");
                modalForm.dataset.method = "POST";
                document.getElementById('modal-title').innerText = 'Buat Mata Pelajaran Baru';
                document.getElementById('mapel-id').value = '';
            });


            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const nama_mapel = this.dataset.nama;
                    const kode_mapel = this.dataset.kode;
                    const jenjang_kelas = this.dataset.jenjang;
                    const jumlah_jam = this.dataset.jam;

                    // Set values di modal
                    document.getElementById('modal-title').innerText = 'Edit Mata Pelajaran';
                    document.getElementById('mapel-id').value = id;
                    document.getElementById('nama_mapel').value = nama_mapel;
                    document.getElementById('kode_mapel').value = kode_mapel;
                    document.getElementById('jenjang_kelas').value = jenjang_kelas;
                    document.getElementById('jumlah_jam').value = jumlah_jam;

                    const modalForm = document.getElementById('form-modal');
                    modalForm.setAttribute('action', `/admin/data-mata-pelajaran/update/${id}`);
                    modalForm.dataset.method = "POST";
                });
            });

            document.getElementById('form-modal').addEventListener('submit', function(event) {
                event.preventDefault();

                const form = this;
                const action = form.getAttribute('action');
                const method = form.dataset.method || "POST";
                const formData = new FormData(form);

                fetch(action, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan: " + (data.message ||
                                "Periksa kembali data Anda."));
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Gagal menyimpan data. Silakan coba lagi.");
                    });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const deleteUrl = button.getAttribute('data-url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Tindakan ini tidak dapat dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Terhapus!',
                                        'Pengguna telah dihapus.',
                                        'success'
                                    ).then(() => {
                                        location
                                            .reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus pengguna.',
                                    'error'
                                );
                            });
                    }
                });

            });
        });
    </script>
@endsection
