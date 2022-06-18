@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Liga Top Skor Madiun</h4>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Top Skor</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3">3,897</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Posisi 1 Liga</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3">3,897</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Top Skor</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-3">3,897</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg col-sm-12 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Klasemen Sementara</h6>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
            </div>
          </div>
        </div>
        <div class="row align-items-start mb-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pos.</th>
                        <th>Tim</th>
                        <th>P</th>
                        <th>M</th>
                        <th>S</th>
                        <th>K</th>
                        <th>+/-</th>
                        <th>Pts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rank as $r)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td><img style="height:40px;width:auto;margin-right:10px" src="{{url('/image/club/'.$r['club_image'])}}" alt="">
                                {{$r['club_name']}}</td>
                            <td>{{$r['p']}}</td>
                            <td>{{$r['m']}}</td>
                            <td>{{$r['s']}}</td>
                            <td>{{$r['k']}}</td>
                            <td>{{$r['pm']}}</td>
                            <td>{{$r['pts']}}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg col-sm-12 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Top Skor</h6>
        </div>
        <div class="row align-items-start mb-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pos.</th>
                        <th>Tim</th>
                        <th>Nama Pemain</th>
                        <th>Jumlah Gol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topScorer as $top)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td><img style="height:40px;width:auto;margin-right:10px" src="{{url('/image/club/'.$top->image)}}" alt="">
                                {{$top->club_name}}</td>
                            <td>{{$top->player_name}} ({{$top->number}})</td>
                            <td>{{$top->total_score}}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush
