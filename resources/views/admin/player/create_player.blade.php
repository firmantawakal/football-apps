@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Tambah Pemain</h6>
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
                    <form action="{{ route('player.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Klub</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single form-select" name="id_club" required>
                                    @foreach ($club as $cl)
                                        <option value="{{$cl->id}}">{{$cl->club_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nama Pemain</label>
                            <div class="col-sm-9">
                                <input type="text" name="player_name" class="form-control" placeholder="Nama Pemain" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="birth_place" class="form-control" placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <div class="input-group date datepicker" id="datePickerExample">
                                    <input type="text" name="birth_date" class="form-control" required>
                                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">No. Punggung</label>
                            <div class="col-sm-9">
                                <input type="number" name="number" class="form-control" placeholder="No. Punggung" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Posisi</label>
                            <div class="col-sm-9">
                                <input type="text" name="position" class="form-control" placeholder="Posisi" required>
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
