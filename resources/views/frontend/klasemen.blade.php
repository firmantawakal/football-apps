@extends('frontend.layout.master')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-medium bigslam-center-align">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Klasemen Sementara</h1></div>
    </div>
</div>
<div class="bigslam-page-wrapper" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 0px ;">
                        <div class="gdlr-core-text-box-item-content">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-league-table">
                                    <div class="sp-table-wrapper">
                                        <table class="sp-league-table sp-data-table sp-sortable-table sp-scrollable-table sp-paginated-table" data-sp-rows="10">
                                            <thead>
                                                <tr>
                                                    <th class="data-rank">Pos.</th>
                                                    <th class="data-name">Tim</th>
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
                                                        <td class="data-name has-logo" data-label="Club">
                                                            <span class="team-logo"><img width="90" height="80" src="upload/flag-20.png" class="attachment-sportspress-fit-icon size-sportspress-fit-icon wp-post-image" alt="" srcset="{{url('/image/club/'.$r['club_image'])}} 90w, upload/flag-20-32x28.png 32w" sizes="(max-width: 90px) 100vw, 90px"></span>
                                                            {{-- <img style="height:40px;width:auto;margin-right:10px" src="" alt=""> --}}
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
                                            {{-- <thead>
                                                <tr>
                                                    <th class="data-rank">Pos</th>
                                                    <th class="data-name">Club</th>
                                                    <th class="data-w">W</th>
                                                    <th class="data-l">L</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd sp-row-no-0">
                                                    <td class="data-rank" data-label="Pos">1</td>
                                                    <td class="data-name" data-label="Club">Napoli</td>
                                                    <td class="data-w" data-label="W">13</td>
                                                    <td class="data-l" data-label="L">0</td>
                                                </tr>
                                                <tr class="even sp-row-no-1">
                                                    <td class="data-rank" data-label="Pos">2</td>
                                                    <td class="data-name" data-label="Club">Juventus</td>
                                                    <td class="data-w" data-label="W">12</td>
                                                    <td class="data-l" data-label="L">0</td>
                                                </tr>
                                                <tr class="odd highlighted sp-row-no-2">
                                                    <td class="data-rank sp-highlight" data-label="Pos">3</td>
                                                    <td class="data-name sp-highlight" data-label="Club">Barcelona</td>
                                                    <td class="data-w sp-highlight" data-label="W">11</td>
                                                    <td class="data-l sp-highlight" data-label="L">0</td>
                                                </tr>
                                                <tr class="even sp-row-no-3">
                                                    <td class="data-rank" data-label="Pos">4</td>
                                                    <td class="data-name" data-label="Club">Real Soccer</td>
                                                    <td class="data-w" data-label="W">11</td>
                                                    <td class="data-l" data-label="L">1</td>
                                                </tr>
                                                <tr class="odd sp-row-no-4">
                                                    <td class="data-rank" data-label="Pos">5</td>
                                                    <td class="data-name" data-label="Club">Sevilla</td>
                                                    <td class="data-w" data-label="W">11</td>
                                                    <td class="data-l" data-label="L">2</td>
                                                </tr>
                                                <tr class="even sp-row-no-5">
                                                    <td class="data-rank" data-label="Pos">6</td>
                                                    <td class="data-name" data-label="Club">Liverpool</td>
                                                    <td class="data-w" data-label="W">11</td>
                                                    <td class="data-l" data-label="L">3</td>
                                                </tr>
                                                <tr class="odd sp-row-no-6">
                                                    <td class="data-rank" data-label="Pos">7</td>
                                                    <td class="data-name" data-label="Club">Valencia</td>
                                                    <td class="data-w" data-label="W">9</td>
                                                    <td class="data-l" data-label="L">0</td>
                                                </tr>
                                                <tr class="even sp-row-no-7">
                                                    <td class="data-rank" data-label="Pos">8</td>
                                                    <td class="data-name" data-label="Club">arsenal</td>
                                                    <td class="data-w" data-label="W">8</td>
                                                    <td class="data-l" data-label="L">4</td>
                                                </tr>
                                                <tr class="odd sp-row-no-8">
                                                    <td class="data-rank" data-label="Pos">9</td>
                                                    <td class="data-name" data-label="Club">spurs</td>
                                                    <td class="data-w" data-label="W">5</td>
                                                    <td class="data-l" data-label="L">2</td>
                                                </tr>
                                                <tr class="even sp-row-no-9">
                                                    <td class="data-rank" data-label="Pos">10</td>
                                                    <td class="data-name" data-label="Club">Man.Utd</td>
                                                    <td class="data-w" data-label="W">12</td>
                                                    <td class="data-l" data-label="L">6</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
