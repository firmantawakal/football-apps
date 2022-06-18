<header class="bigslam-header-wrap bigslam-header-style-plain  bigslam-style-menu-right bigslam-sticky-navigation bigslam-style-slide">
    <div class="bigslam-header-background"></div>
    <div class="bigslam-header-container  bigslam-container">

        <div class="bigslam-header-container-inner clearfix">
            <div class="bigslam-logo  bigslam-item-pdlr">
                <div class="bigslam-logo-inner">
                    <a href="{{url('/')}}"><img src="{{ asset('front/upload/logo.png')}}" alt="" width="200" height="191" title="logo"></a>
                </div>
            </div>
            <div class="bigslam-navigation bigslam-item-pdlr clearfix ">
                <div class="bigslam-main-menu" id="bigslam-main-menu">
                    <ul id="menu-main-navigation-1" class="sf-menu">
                        <li class="menu-item menu-item-home bigslam-normal-menu {{ active_class_front(['/']) }}"><a href="{{url('/')}}">Beranda</a></li>
                        <li class="menu-item bigslam-normal-menu {{ active_class_front(['jadwal']) }}"><a href="{{url('jadwal')}}">Jadwal Pertandingan</a></li>
                        <li class="menu-item bigslam-normal-menu {{ active_class_front(['hasil']) }}"><a href="{{url('hasil')}}">Hasil Pertandingan</a></li>
                        <li class="menu-item bigslam-normal-menu {{ active_class_front(['klasemen']) }}"><a href="{{url('klasemen')}}">Klasemen</a></li>
                        <li class="menu-item bigslam-normal-menu"><a href="#">Berita</a></li>

                    </ul>
                    <div class="bigslam-navigation-slide-bar bigslam-style-2" id="bigslam-navigation-slide-bar"></div>
                </div>
            </div>
            <!-- bigslam-navigation -->
        </div>
        <!-- bigslam-header-inner -->
    </div>
    <!-- bigslam-header-container -->

</header>
<!-- header -->
