@extends('frontend.layout.master')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-medium bigslam-center-align">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Hasil Pertandingan</h1></div>
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
                                <div class="sp-template sp-template-event-list">
                                    <div class="sp-table-wrapper">
                                        <table class="sp-event-list sp-event-list-format-title sp-data-table sp-paginated-table sp-sortable-table sp-scrollable-table " data-sp-rows="10">
                                            <thead>
                                                <tr>
                                                    <th class="data-date">Tanggal</th>
                                                    <th class="data-event">Pertandingan</th>
                                                    <th class="data-time">Hasil</th>
                                                    <th class="data-season">Musim</th>
                                                    <th class="data-venue">Venue</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_schedule as $sch)
                                                <tr class="sp-row sp-post alternate sp-row-no-0" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" data-label="Date" style="vertical-align: middle;">
                                                        {{ dateIndo($sch->time) }}
                                                    </td>
                                                    <td class="bigslam-sp-event-featured-list clearfix" style="background-color: transparent !important">
                                                        {{-- <div class="bigslam-sp-event-featured-list clearfix"> --}}
                                                            <div class="bigslam-sp-event-featured-title bigslam-title-font">
                                                                <span class="bigslam-sp-team-logo">
                                                                    <img width="123" height="141" src="{{ url('/image/club/' . $sch->image_a) }}" class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image" alt="" >
                                                                </span>
                                                                <span class="bigslam-sp-team-name">{{ $sch->club_a }}</span>
                                                                <span class="bigslam-sp-event-result">VS</span>
                                                                <span class="bigslam-sp-team-name">{{ $sch->club_b }}</span>
                                                                <span class="bigslam-sp-team-logo">
                                                                    <img width="110" height="119" src="{{ url('/image/club/' . $sch->image_b) }}" class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image" alt="" >
                                                                </span>
                                                            </div>
                                                        {{-- </div> --}}
                                                    </td>
                                                    <td class="data-time ok" data-label="Time/Results" style="vertical-align: middle;">
                                                        {{$sch->score_a}} - {{$sch->score_b}}
                                                    </td>
                                                    <td class="data-season" data-label="Season" style="vertical-align: middle;">{{$sch->season_name}}</td>
                                                    <td class="data-venue" data-label="Venue" style="vertical-align: middle;">
                                                        <div itemprop="address">{{$sch->stadium_a}}</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                {{-- <tr class="sp-row sp-post sp-row-no-1" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-09-02T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-09-02 20:00:13</date>September 2, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Barcelona vs Liverpool</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:13</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Camp Nou</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post alternate sp-row-no-2" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-28T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-28 20:00:37</date>August 28, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Man.Utd vs Valencia</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:37</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Old Trafford</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post sp-row-no-3" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-24T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-24 20:00:35</date>August 24, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Juventus vs Real Soccer</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:35</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Allianz Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post alternate sp-row-no-4" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-22T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-22 20:00:01</date>August 22, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> spurs vs Valencia</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:01</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">spurs stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post sp-row-no-5" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-20T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-20 20:00:49</date>August 20, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Juventus vs Barcelona</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:49</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Allianz Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post alternate sp-row-no-6" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-15T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-15 20:00:54</date>August 15, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Juventus vs Real Soccer</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:54</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Allianz Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post sp-row-no-7" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2020-08-13T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2020-08-13 20:00:51</date>August 13, 2020</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Real Soccer vs Valencia</a></td>
                                                    <td class="data-time ok" data-label="Time/Results">
                                                        <a href="#" itemprop="url">
                                                            <date>&nbsp;20:00:51</date>8:00 pm</a>
                                                    </td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Santiago Bernabéu Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Preview</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post alternate sp-row-no-8" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2019-08-07T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2019-08-07 20:00:42</date>August 7, 2019</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Napoli vs Juventus</a></td>
                                                    <td class="data-time ok" data-label="Time/Results"><a href="#" itemprop="url">2 - 0</a></td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">San Paolo Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Recap</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post sp-row-no-9" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2019-08-05T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2019-08-05 20:00:21</date>August 5, 2019</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Valencia vs Sevilla</a></td>
                                                    <td class="data-time ok" data-label="Time/Results"><a href="#" itemprop="url">3 - 0</a></td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Mestalla Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Recap</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post alternate sp-row-no-10" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2019-08-02T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2019-08-02 20:00:42</date>August 2, 2019</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Barcelona vs Liverpool</a></td>
                                                    <td class="data-time ok" data-label="Time/Results"><a href="#" itemprop="url">2 - 1</a></td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Camp Nou</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Recap</a></td>
                                                </tr>
                                                <tr class="sp-row sp-post sp-row-no-11" itemscope="" itemtype="http://schema.org/SportsEvent">
                                                    <td class="data-date" itemprop="startDate" content="2019-08-01T20:00+00:00" data-label="Date">
                                                        <a href="#" itemprop="url">
                                                            <date>2019-08-01 20:00:42</date>August 1, 2019</a>
                                                    </td>
                                                    <td class="data-event" data-label="Event"><a href="#" itemprop="url name"> Juventus vs Man.Utd</a></td>
                                                    <td class="data-time ok" data-label="Time/Results"><a href="#" itemprop="url">1 - 0</a></td>
                                                    <td class="data-league" data-label="League">UEFA</td>
                                                    <td class="data-season" data-label="Season">2019</td>
                                                    <td class="data-venue" data-label="Venue" itemprop="location" itemscope="" itemtype="http://schema.org/Place">
                                                        <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">Allianz Stadium</div>
                                                    </td>
                                                    <td class="data-article" data-label="Article"><a href="#" itemprop="url">Recap</a></td>
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
