@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Data Klub</h6>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <h5><i data-feather="check"></i> Berhasil!</h5>{{ $message }}
            </div>
        @endif
        <a href="{{route('club.create')}}" type="button" class="btn btn-primary mb-4">Tambah</a>

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Logo</th>
                <th>Nama Klub</th>
                <th>Stadium</th>
                <th>Pelatih</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($club as $cl)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{url('/image/club/'.$cl->image)}}" alt=""></td>
                        <td>{{$cl->club_name}}</td>
                        <td>{{$cl->stadium}}</td>
                        <td>{{$cl->coach}}</td>
                        <td>
                            <a href="{{ route('club.edit', $cl->id) }}" type="button" class="btn btn-success btn-sm"><i class="feather-16" data-feather="edit-2" aria-hidden="true"></i></a>
                            <a href="{{ route('club.detail', $cl->id) }}" type="button" class="btn btn-warning btn-sm"><i class="feather-16" data-feather="sun" aria-hidden="true"></i></a>
                        </td>
                    </tr>
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
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
