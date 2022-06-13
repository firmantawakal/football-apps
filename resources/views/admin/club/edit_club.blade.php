@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Klub</h6>
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
                    <form action="{{ route('club.update', $dt_club->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Klub</label>
                            <div class="col-sm-9">
                                <input type="text" name="club_name" value="{{$dt_club->club_name}}" class="form-control" placeholder="Nama Klub">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Stadion</label>
                            <div class="col-sm-9">
                                <input type="text" name="stadium" value="{{$dt_club->stadium}}" class="form-control" placeholder="Nama Stadion">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Pelatih</label>
                            <div class="col-sm-9">
                                <input type="text" name="coach" class="form-control" value="{{$dt_club->coach}}" placeholder="Nama Pelatih">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="image_old" value="{{ $dt_club->image }}" class="form-control" placeholder="Title">
                                <input type="file" class="form-control-file" name="image" id="" placeholder=""><br>
                                <img src="/image/club/{{ $dt_club->image }}" width="100px" style="padding-top:30px">
                            </div>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
