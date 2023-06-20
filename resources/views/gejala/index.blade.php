@extends('layouts.admin.dashboard')
@section('judul', 'Tabel Gejala')

@section('content')
    <section class="section">
        <div class="card">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <div class="card-header">
                <button class="btn btn-primary btn-sm fw-bold"data-bs-toggle="modal" data-bs-target="#tambahGejalaModal"><i
                        class="bi bi-plus"></i>Tambah</button>
            </div>
            <div class="card-body">
                <table class="table table-hovered" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gejala as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama}}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button data-toggle="modal" data-target="#editModal{{ $item->id }}" class="btn btn-warning btn-sm bi-pencil"></button>
                                    <form action="{{ route('gejala.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger bi-trash"></button>
                                    </form>
                                    
                                    
                                </div>
                            </td>
                        </tr>

                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>

    </section>


    @foreach ($gejala as $item)
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $item->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Data Gejala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('gejala.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Gejala</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

    <div class="modal fade" id="tambahGejalaModal" tabindex="-1" role="dialog" aria-labelledby="tambahGejalaModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGejalaModalTitle">Tambah Data Gejala</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gejala.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="nama" class="form-label">nama Gejala<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                </div>
                            </div>
                            
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" >
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    

@endsection

