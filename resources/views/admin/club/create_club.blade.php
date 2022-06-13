@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Klub</h6>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <label>Whoops!</label> There were some problems with your input.<br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('club.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Klub</label>
                            <div class="col-sm-9">
                                <input type="text" name="club_name" class="form-control" placeholder="Nama Klub">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Stadion</label>
                            <div class="col-sm-9">
                                <input type="text" name="stadium" class="form-control" placeholder="Nama Stadion">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Pelatih</label>
                            <div class="col-sm-9">
                                <input type="text" name="coach" class="form-control" placeholder="Nama Pelatih">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control-file" name="image" id="" placeholder="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
