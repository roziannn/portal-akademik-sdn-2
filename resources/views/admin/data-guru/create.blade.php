@extends('layouts.master')

@section('title')
    Buat Data Guru
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

                </div>
                <div class="box-body">
                    <form role="form" action="{{ route('data.guru.store') }}" method="POST">
                        @csrf
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Biodata Guru</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nama Lengkap">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Email">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip"
                                                placeholder="NIP">
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                placeholder="Tempat Lahir">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                name="tanggal_lahir" placeholder="Tanggal Lahir">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control" id="agama" name="agama">
                                                <option value="islam">
                                                    Islam</option>
                                                <option value="kristen">
                                                    Kristen</option>
                                                <option value="katolik">
                                                    Katolik</option>
                                                <option value="hindu">
                                                    Hindu</option>
                                                <option value="budha">
                                                    Budha</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="laki_laki">
                                                    Laki - Laki</option>
                                                <option value="perempuan">
                                                    Perempuan</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="Alamat">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Pendidikan</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gelar_akademik">Gelar Akademik</label>
                                            <input type="text" class="form-control" id="gelar_akademik"
                                                name="gelar_akademik" placeholder="Gelar Akademik">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jurusan_akademik">Jurusan Akademik</label>
                                            <input type="text" class="form-control" id="jurusan_akademik"
                                                name="jurusan_akademik" placeholder="Jurusan Akademik">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="universitas">Institut/Universitas</label>
                                            <input type="text" class="form-control" id="universitas"
                                                name="universitas" placeholder="Institut/Universitas/Akademi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-secondary fade" id="addAccountModal" id="modal-primary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Buat Akun Baru</h4>
                </div>
                <form action="{{ route('data.user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" id="password" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role" required>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="user">Siswa</option>
                                <option value="kepsek">Kepala Sekolah</option>
                            </select>
                        </div>

                        <div class="form-group" id="guru-options" style="display: none;">
                            <label for="guru-access">Akses Sebagai</label>
                            <select name="guru_access" class="form-control" id="guru-access">
                                <option value="guru">Hanya Guru</option>
                                <option value="wali_kelas">Wali Kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#guru-options').hide();

            $('#role').on('change', function() {
                var selectedRole = $(this).val();

                if (selectedRole === 'guru') {
                    $('#guru-options').show();
                } else {
                    $('#guru-options').hide();
                }
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
@endpush
