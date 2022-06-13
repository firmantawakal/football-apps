@extends('layout.master')

@push('plugin-styles')
  <!-- Plugin css import here -->
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">
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
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 mb-3 center-flx"><img class="logo-club" src="{{url('/image/club/'.$schedule->image_a)}}" alt=""></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-light mb-3 center-flx" data-bs-toggle="modal" data-bs-target="#addScoreA">Tambah</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <ul class="list-group list-group-flush goal_a">
                                @foreach ($scorer_a as $scr_a)
                                    <li class="list-group-item">
                                         {{$scr_a->player_name}} &nbsp; <b>"{{$scr_a->minutes_goal}}</b>&nbsp;
                                         <button type="button" class="btn-close remove" data-team="{{$scr_a->team}}" data-id="{{$scr_a->id}}" aria-label="Close"></button>
                                    </li>
                                @endforeach
                              </ul>
                        </div>
                    </div>
                    <!-- Modal A-->
                    <div class="modal fade" id="addScoreA" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pencetak Gol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Pemain</label>
                                        <div class="col-sm-9">
                                            <select id="id_player_a" class="form-select" required>
                                                <option value="">--Pilih Pencetak Gol--</option>
                                                @foreach ($playerA as $item)
                                                    <option value="{{$item->id}}">{{$item->player_name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="id_schedule" value="{{$schedule->id}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Menit Gol</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="minutes_goal_a" class="form-control" placeholder="Menit Gol" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" onClick="saveScorer('teamA')" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-4">
                        <h2 class="d-flex justify-content-center">
                           <div id="score_a">{{count($scorer_a)}}</div>&nbsp; - &nbsp;<div id="score_b">{{count($scorer_b)}}</div>
                        </h2>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 mb-3 center-flx"><img class="logo-club" src="{{url('/image/club/'.$schedule->image_b)}}" alt=""></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-light mb-3 center-flx" data-bs-toggle="modal" data-bs-target="#addScoreB">Tambah</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <ul class="list-group list-group-flush goal_b">
                                @foreach ($scorer_b as $scr_b)
                                    <li class="list-group-item">
                                         {{$scr_b->player_name}} &nbsp; <b>"{{$scr_b->minutes_goal}}</b>&nbsp;
                                         <button type="button" class="btn-close remove" data-team="{{$scr_b->team}}" data-id="{{$scr_b->id}}" aria-label="Close"></button>
                                    </li>
                                @endforeach
                              </ul>
                        </div>
                    </div>
                    {{-- Modal B --}}
                    <div class="modal fade" id="addScoreB" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pencetak Gol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Nama Pemain</label>
                                        <div class="col-sm-9">
                                            <select id="id_player_b" class="form-select" required>
                                                <option value="">--Pilih Pencetak Gol--</option>
                                                @foreach ($playerB as $item)
                                                    <option value="{{$item->id}}">{{$item->player_name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="id_schedule" value="{{$schedule->id}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Menit Gol</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="minutes_goal_b" class="form-control" placeholder="Menit Gol" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" onClick="saveScorer('teamB')" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        <button type="button" class="btn btn-warning" onclick="finish()"> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
  <!-- Custom js here -->
  <script type="text/javascript">
    $(".select-search").select2({
        dropdownParent: $('#createModal')
    });

    function saveScorer(team){
        let id_player;
        let minutes_goal;
        let teams;
        let scoreA = parseInt(document.getElementById("score_a").firstChild.data);
        let scoreB = parseInt(document.getElementById("score_b").firstChild.data);
        let id_schedule = document.getElementById('id_schedule').value;

        if (team=='teamA') {
            id_player = document.getElementById('id_player_a').value;
            minutes_goal = document.getElementById('minutes_goal_a').value;
            teams = 'a';
        }else{
            id_player = document.getElementById('id_player_b').value;
            minutes_goal = document.getElementById('minutes_goal_b').value;
            teams = 'b';
        }

        $.ajax({
            type: "POST",
            url: '{{route("schedule.scorer_store")}}',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            dataType: 'JSON',
            data: {
                minutes_goal: minutes_goal,
                id_schedule: id_schedule,
                id_player: id_player,
                team: teams
            },
            success: function (dt) {
                if (dt[0].team == 'a') {
                    scoreA++;
                    let goalA = '';
                    dt.forEach(el => {
                        goalA += '<li class="list-group-item">'+el.player_name+' &nbsp; <b>"'+el.minutes_goal+'</b>'+
                                '&nbsp;<button type="button" class="btn-close remove" data-team="'+el.team+'" data-id="'+el.id+'" aria-label="Close"></button>'+
                                '</li>';
                    });
                    document.getElementById("score_a").firstChild.data = scoreA;
                    $(".goal_a").html(goalA);
                    $('#addScoreA').modal('hide');

                }else if (dt[0].team == 'b') {
                    scoreB++;
                    let goalB = '';
                    dt.forEach(el => {
                        goalB += '<li class="list-group-item">'+el.player_name+' &nbsp; <b>"'+el.minutes_goal+'</b>'+
                                '&nbsp;<button type="button" class="btn-close remove" data-team="'+el.team+'" data-id="'+el.id+'" aria-label="Close"></button>'+
                                '</li>';
                    });
                    document.getElementById("score_b").firstChild.data = scoreB;
                    $(".goal_b").html(goalB);
                    $('#addScoreB').modal('hide');
                }
            }
        })
    }

    $(document).on('click', '.remove', function(){
        let scoreA = parseInt(document.getElementById("score_a").firstChild.data);
        let scoreB = parseInt(document.getElementById("score_b").firstChild.data);
        let id_scorer = $(this).data('id');
        let teams = $(this).data('team');
        let id_schedule = '{{$schedule->id}}';
        $.ajax({
            type: "POST",
            url: '{{route("schedule.scorer_destroy")}}',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            dataType: 'JSON',
            data: {
                id: id_scorer,
                id_schedule: id_schedule,
                team: teams,
            },
            success: function (dt) {
                if (teams == 'a') {
                    scoreA--;
                    let goalA = '';
                    dt.forEach(el => {
                        goalA += '<li class="list-group-item">'+el.player_name+' &nbsp; <b>"'+el.minutes_goal+'</b>'+
                                '&nbsp;<button type="button" class="btn-close remove" data-team="'+el.team+'" data-id="'+el.id+'" aria-label="Close"></button>'+
                                '</li>';
                    });
                    document.getElementById("score_a").firstChild.data = scoreA;
                    $(".goal_a").html(goalA);
                    $('#addScoreA').modal('hide');

                }else if (teams == 'b') {
                    scoreB--;
                    let goalB = '';
                    dt.forEach(el => {
                        goalB += '<li class="list-group-item">'+el.player_name+' &nbsp; <b>"'+el.minutes_goal+'</b>'+
                                '&nbsp;<button type="button" class="btn-close remove" data-team="'+el.team+'" data-id="'+el.id+'" aria-label="Close"></button>'+
                                '</li>';
                    });
                    document.getElementById("score_b").firstChild.data = scoreB;
                    $(".goal_b").html(goalB);
                    $('#addScoreB').modal('hide');
                }
            }
        })
    })

    function finish(){
        let id_schedule = document.getElementById('id_schedule').value;
        $.ajax({
            type: "POST",
            url: '{{route("schedule.finish")}}',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                id_schedule: id_schedule,
            },
            dataType: 'JSON',
            success: function (dt) {
                if (dt.response=='success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Score berhasil disimpan!',
                        confirmButtonText: 'ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{route("schedule")}}';
                            }
                        })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal',
                        text: 'gagal menyimpan score',
                        confirmButtonText: 'ok'
                    })
                }

            }
        })
    }
  </script>
@endpush
