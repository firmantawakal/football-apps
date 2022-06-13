@extends('layout.master')

@push('plugin-styles')
  <!-- Plugin css import here -->
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  <style>
      .logo-club {
        display: block;
        width: auto !important;
        height: 70px !important;
        max-width: 100%;
        max-height: 100%;
      }

      table td{
        height: 90px;
        border-bottom-width: 0px !important;
      }

      .center-flx {
        display: flex;
        align-items: center;
      }
  </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
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
                <div class="d-flex justify-content-start mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Jadwal</button>
                    <select onchange="window.location.assign('{{'/admin/schedule/'}}'+this.value)" class="form-select" name="id_season" style="width: 180px; margin-left:20px">
                        @foreach ($season as $ssn)
                            <option value="{{$ssn->id}}" @php echo ($ssn->id==$isActiveSeason->id) ? 'selected' : '' ; @endphp>{{$ssn->season_name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Modal create-->
                <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Jadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('schedule.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Klub Home</label>
                                        <div class="col-sm-9">
                                            <select class="select-search" name="id_club_a" data-width="100%" required>
                                                @foreach ($club as $cl)
                                                    <option value="{{$cl->id}}">{{$cl->club_name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="id_season" value="{{$isActiveSeason->id}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Klub Away</label>
                                        <div class="col-sm-9">
                                            <select class="select-search" name="id_club_b" data-width="100%" required>
                                                @foreach ($club as $cl)
                                                    <option value="{{$cl->id}}">{{$cl->club_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Waktu</label>
                                        <div class="col-sm-4 pt-1 pl-1">
                                            <div class="input-group date timepicker" id="datetimepickerExample" data-target-input="nearest">
                                                <input type="text" name="time" class="form-control datetimepicker-input" data-target="#datetimepickerExample" data-toggle="datetimepicker" required/>
                                                <span class="input-group-text" data-target="#datetimepickerExample" data-toggle="datetimepicker"><i data-feather="clock"></i></span>
                                              </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="input-group date datepicker" id="datePickerExample">
                                                <input type="text" name="date" class="form-control" required>
                                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                              </div>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th class="text-center">Pertandingan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_schedule as $all)
                          @php
                              $time = date('H:i', strtotime($all->time));
                          @endphp
                          <tr>
                              <td scope="row" class="center-flx mt-3">
                                  {{$time}} &bull; {{Carbon\Carbon::parse($all->time)->isoFormat('D MMM Y')}}
                              </td>
                              <td>
                                  <div class="d-flex justify-content-center">
                                      <div class="p-2 center-flx"><h4>{{$all->club_a}}</h4></div>
                                      <div class="p-2 center-flx"><img class="logo-club" src="{{url('/image/club/'.$all->image_a)}}" alt=""></div>
                                      <div class="p-2 center-flx"><h4> @php echo ($all->isFinish==0) ? '- : -' : $all->score_a.' : '.$all->score_b; @endphp</h4></div>
                                      <div class="p-2 center-flx"><img class="logo-club" src="{{url('/image/club/'.$all->image_b)}}" alt=""></div>
                                      <div class="p-2 center-flx"><h4>{{$all->club_b}}</h4></div>
                                  </div>
                              </td>
                              <td class="center-flx mt-3">
                                  <a href="{{ route('schedule.scorer', $all->id) }}" type="button" class="btn btn-sm btn-warning" ><i class="feather-16" data-feather="edit-2"></i></button>
                              </td>
                          </tr>
                          <!-- Modal create-->
                          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title">Input Score</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                                              @csrf
                                              <div class="row">
                                                  <div class="col-6">
                                                      <div class="d-flex justify-content-center">
                                                          <div class="p-2 mb-3 center-flx"><img class="logo-club" src="{{url('/image/club/'.$all->image_a)}}" alt=""></div>
                                                      </div>
                                                      <div class="d-flex justify-content-center">
                                                          <button type="button" class="btn btn-light mb-3 center-flx" name="add" id="addItem_a">Tambah</button>
                                                      </div>
                                                      <div class="createOrderForm" id="orderMenuItems_a">
                                                          <div class="orderItem_a">
                                                              <div class="row g-3 mb-3">
                                                                  <div class="col-6">
                                                                      <select name="id_player_a[]" class="form-select">
                                                                          <option value="">--Pilih Pencetak Gol--</option>
                                                                          @foreach ($player as $item)
                                                                              <option value="{{$item->id}}">{{$item->player_name}}</option>
                                                                          @endforeach
                                                                      </select>
                                                                  </div>
                                                                  <div class="col-4">
                                                                      <input type="number" name="minutes_a[]" class="form-control" placeholder="Menit Gol">
                                                                  </div>
                                                                  <div class="col-2">
                                                                      <button type="button" class="btn btn-danger remove_a" style="display: none" id="remove_a">X</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>

                                                  </div>
                                                  <div class="col-6">
                                                      <div class="d-flex justify-content-center">
                                                          <div class="p-2 mb-3 center-flx"><img class="logo-club" src="{{url('/image/club/'.$all->image_b)}}" alt=""></div>
                                                      </div>
                                                      <div class="d-flex justify-content-center">
                                                          <button type="button" class="btn btn-light mb-3 center-flx" name="add" id="addItem_b">Tambah</button>
                                                      </div>
                                                      <div class="createOrderForm" id="orderMenuItems_b">
                                                          <div class="orderItem_b">
                                                              <div class="row g-3 mb-3">
                                                                  <div class="col-6">
                                                                      <select name="id_player_b[]" class="form-select" name="id_season">
                                                                          <option value="">--Pilih Pencetak Gol--</option>
                                                                          @foreach ($player as $item)
                                                                              <option value="{{$item->id}}">{{$item->player_name}}</option>
                                                                          @endforeach
                                                                      </select>
                                                                  </div>
                                                                  <div class="col-4">
                                                                      <input type="number" name="minutes_b[]" class="form-control" placeholder="Menit Gol">
                                                                  </div>
                                                                  <div class="col-2">
                                                                      <button type="button" class="btn btn-danger remove_b" style="display: none" id="remove_b">X</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <br>
                                              <small class="text-muted">Kosongkan form jika score 0</small>
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

@endsection

@push('plugin-scripts')
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
  <!-- Custom js here -->
  <script type="text/javascript">
    $('#datetimepickerExample').datetimepicker({
        format: 'HH:mm',
        debug: true,
        icons: {
            up: 'fas fa-angle-up',
            down: 'fas fa-angle-down',
        }
    });

    $(".select-search").select2({
        dropdownParent: $('#createModal')
    });

    $(document).ready(function () {

        // Remove item A
        var $addItem_a = $('#addItem_a');
        var $orderMenuItems_a = $('#orderMenuItems_a');

        $addItem_a.click(function(){
            var markup_a = $orderMenuItems_a.children('.orderItem_a')[0].outerHTML;
            $orderMenuItems_a.append(markup_a);
            var rma = $('body .remove_a').length;
            if (rma>1) {
                $('body .remove_a').css('display','block');
            }else{
                $('body .remove_a').css('display','none');
            }
        });

        $("body").on('click', '#remove_a', function() {
            (this).closest('div.orderItem_a').remove();
            var rm = $('body .remove_a').length;
            if (rm>1) {
                $('body .remove_a').css('display','block');
            }else{
                $('body .remove_a').css('display','none');
            }
        });

        // Remove item B
        var $addItem_b = $('#addItem_b');
        var $orderMenuItems_b = $('#orderMenuItems_b');

        $addItem_b.click(function(){
            var markup_b = $orderMenuItems_b.children('.orderItem_b')[0].outerHTML;
            $orderMenuItems_b.append(markup_b);
            var rmb = $('body .remove_b').length;
            if (rmb>1) {
                $('body .remove_b').css('display','block');
            }else{
                $('body .remove_b').css('display','none');
            }
        });

        $("body").on('click', '#remove_b', function() {
            (this).closest('div.orderItem_b').remove();
            var rmb = $('body .remove_b').length;
            if (rmb>1) {
                $('body .remove_b').css('display','block');
            }else{
                $('body .remove_b').css('display','none');
            }
        });

        function save() {
            var values = [];
            var stuff = $('input[name="answer[]"]').each(function(i, item) {
            values.push(item.value);
            });
        }
    });
  </script>
@endpush
