@extends('layout.master')

@push('plugin-styles')
<style>
    .club-logo{
        width:100px;
        margin:20px;
    }
</style>
@endpush

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="text-uppercase text-center">{{$club->club_name}}</h4>
        <div class="row">
            <div class="col-sm-3">
                <img class="club-logo rounded mx-auto d-block" src="{{url('/image/club/'.$club->image)}}">
            </div>
            <div class="col-sm-9">
                <dl class="row" style="margin-top:50px;font-size:18px">
                    <dt class="col-sm-2">Nama Klub</dt>
                    <dd class="col-sm-9">{{$club->club_name}}</dd>

                    <dt class="col-sm-2 text-truncate">Stadion</dt>
                    <dd class="col-sm-9">{{$club->stadium}}</dd>

                    <dt class="col-sm-2">Pelatih</dt>
                    <dd class="col-sm-9">{{$club->coach}}</dd>
                </dl>
            </div>
        </div>
        <hr>
        <h4 class="text-uppercase text-center">Daftar Pemain</h4><br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h5><i data-feather="check"></i> Berhasil!</h5>{{ $message }}
            </div>
        @endif
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
        <div class="d-flex flex-row bd-highlight mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-right: 10px">Kembali</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah
            </button>
        </div>

        <!-- Modal create-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pemain</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('player.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Pemain</label>
                                <div class="col-sm-9">
                                    <input type="text" name="player_name" class="form-control" placeholder="Nama Pemain" required>
                                    <input type="hidden" name="id_club" class="form-control" value="{{$club->id}}">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Pemain / No. Punggung</th>
                <th>Tempat, Tgl Lahir</th>
                <th>Posisi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($player as $ply)
                    @php
                        $birth_date = date('d/m/Y', strtotime($ply->birth_date));
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$ply->player_name.' ('.$ply->number.')'}}</td>
                        <td>{{$ply->birth_place.', '.$birth_date}}</td>
                        <td>{{$ply->position}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$ply->id}}">
                                <i class="feather-16" data-feather="edit-2" aria-hidden="true"></i>
                            </button>
                            {{-- <a href="{{ route('player.delete', $ply->id) }}" type="button" class="btn btn-danger btn-sm delete-confirm">
                                <i class="feather-16" data-feather="x" aria-hidden="true"></i>
                            </a> --}}

                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{$ply->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pemain</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('player.update', $ply->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Nama Pemain</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{$ply->player_name}}" name="player_name" class="form-control" placeholder="Nama Pemain" required>
                                                <input type="hidden" value="{{$ply->id_club}}" name="id_club">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{$ply->birth_place}}" name="birth_place" class="form-control" placeholder="Tempat Lahir" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                            @php
                                                $birth_date = date('d/m/Y', strtotime($ply->birth_date));
                                            @endphp
                                            <div class="col-sm-9">
                                                <div class="input-group date datepicker" id="datePickerExample">
                                                    <input type="text" value="{{$birth_date}}" name="birth_date" class="form-control" required>
                                                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">No. Punggung</label>
                                            <div class="col-sm-9">
                                                <input type="number" value="{{$ply->number}}" name="number" class="form-control" placeholder="No. Punggung" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Posisi</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{$ply->position}}" name="position" class="form-control" placeholder="Posisi" required>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')

  @endpush

@push('custom-scripts')
  <script type="text/javascript">
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    })
  </script>
@endpush
