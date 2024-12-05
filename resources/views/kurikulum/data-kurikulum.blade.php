@extends('layouts.master')

@section('title')
    Data Kurikulum
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
