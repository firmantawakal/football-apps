@extends('frontend.layout.master')

@section('content')
<div class="bigslam-page-title-wrap  bigslam-style-medium bigslam-center-align">
    <div class="bigslam-header-transparent-substitute"></div>
    <div class="bigslam-page-title-overlay"></div>
    <div class="bigslam-page-title-container bigslam-container">
        <div class="bigslam-page-title-content bigslam-item-pdlr">
            <h1 class="bigslam-page-title">Jadwal Pertandingan</h1></div>
    </div>
</div>
<div class="bigslam-page-wrapper" id="bigslam-page-wrapper">
    <div class="gdlr-core-page-builder-body">
        <div class="gdlr-core-pbf-section">
            <div class="gdlr-core-pbf-section-container gdlr-core-container clearfix">
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" style="padding-bottom: 10px ;">
                        <div class="gdlr-core-text-box-item-content">
                            <div class="sportspress sp-widget-align-none">
                                <div class="sp-template sp-template-event-list">
                                    <div class="bigslam-sp-event-featured-holder clearfix">
                                        @foreach ($all_schedule as $sch)
                                            @if ($loop->first)
                                                <div class="bigslam-sp-event-featured-top bigslam-status-vs">
                                                    <div class="bigslam-sp-event-featured-title bigslam-title-font clearfix">
                                                        <div class="bigslam-sp-event-featured-title-left">
                                                            <span class="bigslam-sp-team-logo"><img width="120" height="146" src="{{ url('/image/club/' . $sch->image_a) }}" class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image" alt="" ></span>
                                                            <span class="bigslam-sp-team-name">{{ $sch->club_a }}</span>
                                                        </div>
                                                            <span class="bigslam-sp-event-result">VS</span>
                                                        <div class="bigslam-sp-event-featured-title-right">
                                                            <span class="bigslam-sp-team-logo">
                                                                <img width="110" height="119" src="{{ url('/image/club/' . $sch->image_b) }}" class="attachment-sportspress-fit-medium size-sportspress-fit-medium wp-post-image" alt="" >
                                                            </span>
                                                            <span class="bigslam-sp-team-name">{{ $sch->club_b }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="bigslam-sp-event-featured-info"><span class="bigslam-sp-event-date">{{ dateIndo($sch->time) }}</span><span class="bigslam-sp-event-venue">{{ $sch->stadium_a }}</span></div>
                                                </div>
                                            @else
                                                <div class="bigslam-sp-event-featured-list clearfix">
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
                                                    <div class="bigslam-sp-event-featured-info"><span class="bigslam-sp-event-date">{{ dateIndo($sch->time) }}</span>
                                                        <span class="bigslam-sp-event-venue">{{ $sch->stadium_a }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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
