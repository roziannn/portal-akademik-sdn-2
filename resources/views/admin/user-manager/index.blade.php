@extends('layouts.master')

@section('title')
    Data User
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
                <div>
                    <form action="kehadiran" method="POST">
                        @csrf
                        <div class="container">
                            <div class="row">
                            </div>
                        </div>
                    </form>
                </div>
                <section class="table-responsive">
                    <div class="box-body">
                        <table id="myTable" class="table table-stiped table-bordered  text-center">
                            <thead class="bg-gray disabled color-palette">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        @if ($item->email === 'admin@gmail.com')
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger " disabled><i
                                                        class="fa fa-trash"></i></a>
                                                <a href="#" class="btn btn-sm btn-warning" disabled><i
                                                        class="fa fa-pencil"></i></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger delete-btn"
                                                    data-id="{{ $item->id }}"
                                                    data-url="{{ url('/admin/data-user/delete/' . $item->id) }}"> <i
                                                        class="fa fa-trash"></i>
                                                </a>

                                                <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editAccountModal{{ $item->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>


                                    <div class="modal modal-secondary fade" id="editAccountModal{{ $item->id }}"
                                        id="modal-primary">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Edit Akun User</h4>
                                                </div>
                                                <form action="{{ route('data.user.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Nama Lengkap</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="name" required value="{{ $item->name }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                id="email" required value="{{ $item->email }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="text" name="password" class="form-control"
                                                                id="password" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="role">Role</label>
                                                            <select name="role" class="form-control" id="role"
                                                                required>
                                                                <option value="admin"
                                                                    {{ old('role', $item->role) == 'admin' ? 'selected' : '' }}>
                                                                    Admin</option>
                                                                <option value="guru"
                                                                    {{ old('role', $item->role) == 'guru' ? 'selected' : '' }}>
                                                                    Guru</option>
                                                                <option value="kepsek"
                                                                    {{ old('role', $item->role) == 'kepsek' ? 'selected' : '' }}>
                                                                    Kepala Sekolah</option>
                                                            </select>

                                                        </div>

                                                        <div class="form-group" id="guru-options" style="display: none;">
                                                            <label for="guru-access">Akses Sebagai</label>
                                                            <select name="guru_access" class="form-control"
                                                                id="guru-access">
                                                                <option value="guru">Hanya Guru</option>
                                                                <option value="wali_kelas">Wali Kelas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
