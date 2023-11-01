@extends('layouts.master')
@include('sweetalert::alert')
@section('content')
<div class="px-3 py-2 border-bottom mb-3">
    <div class="container d-flex flex-wrap justify-content-center">
        <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto" role="search" method="get" action="/">
            <input type="text" name="cari" class="form-control w-75 d-inline" id="search" placeholder="Masukkan nama siswa">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
    </div>
</div>
<div class="container">
    <h3 class="mt-4">Data Siswa
        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    </h3>
    <div class="table-responsive">
        <table class="table table-hover table-borderless">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Olah Data</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1;?>
                @foreach ($data as $dt)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><img src="{{ asset('foto/'.$dt->foto) }}" width="15%" style="background-color:red"></td>
                    <td>{{ $dt->nis }}</td>
                    <td>{{ $dt->nama }}</td>
                    <td>{{ $dt->kelas }}</td>
                    <td>{{ $dt->jenis_kelamin }}</td>
                    <td>{{ $dt->telp }}</td>
                    <td>{{ $dt->alamat_domisili }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah{{ $dt->id }}">Ubah</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $dt->id }}">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nis" placeholder="masukkan nis siswa">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nm" placeholder="masukkan nama siswa">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" name="kls" placeholder="masukkan kelas">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jkl">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telp</label>
                        <input type="text" class="form-control" name="tlp" placeholder="masukkan no. telp siswa">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Domisili</label>
                        <textarea class="form-control" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Siswa:</label>
                        <input class="form-control" type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data as $dt)
<div class="modal fade" id="hapus{{ $dt->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">
                    Apakah anda yakin ingin menghapus <b>{{ $dt->nama }}</b>?
                </h4>
            </div>
            <div class="modal-footer">
                <form action="/{{ $dt->id }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tidak</button>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($data as $dt)
<div class="modal fade" id="ubah{{ $dt->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data</h1>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ $dt->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $dt->id }}">
                    <div class="mb-3">
                        <label class="form-label">NIS</label>
                        <input type="text" class="form-control" name="nis" value="{{ $dt->nis }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$dt->nama}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{$dt->kelas}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin">
                            <option selected>{{ $dt->jenis_kelamin }}</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telp</label>
                        <input type="text" class="form-control" name="telp" value="{{ $dt->telp }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Domisili</label>
                        <textarea class="form-control" name="alamat" rows="3">{{ $dt->alamat_domisili }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Siswa:</label>
                        <input class="form-control" type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
