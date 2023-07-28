<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('')}}" class="site_title"><img src="{{url('')}}/images/firat_logo.gif" width="45"
                                                                  height="45"></i> <span>Fırat Üniversitesi</span></a>
                </div>

                @if(isset($user->user_type) && $user->user_type === 3)

                @endif

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{url('')}}/images/user.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Hoşgeldiniz,</span>
                        <h2>{{ Auth::user()->name . ' ' . Auth::user()->surname   }} {{--{{$user->name . ' ' . $user->surname}}--}}</h2>
                    </div>
                </div>

                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Anasayfa <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="bos-yetki.html">Tüm Tablolar</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Yetkililer <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="yetkili-tablo.html">Yetkili Düzenleme</a></li>
                                    <li><a href="yetkili-ekle.html">Yetkili Ekle</a></li>

                                </ul>

                            </li>
                            <li><a><i class="fa fa-exclamation"></i>Öğrenciler<span
                                        class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="ogrenci-tablo.html">Öğrenci Düzenleme</a></li>
                                </ul>

                            </li>
                            <li><a><i class="fa fa-exclamation"></i>İşletmeler<span
                                        class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="isletme-tablo.html">İşletme Düzenleme</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->


            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                               id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{Auth::user()->profile_picture}}"
                                     alt="">{{ Auth::user()->name . ' ' . Auth::user()->surname   }}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="profil.html"> Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     class="dropdown-item"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Çıkış Yap') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->


        <div class="right_col" role="main">

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Yetkililer</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="#yetkili-ekle"><i class="fa fa-plus"> Yetkili Ekle</i> </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <p class="text-muted font-13 m-b-30">
                                            İşlem yapmak istediğiniz yetkiliyi aşağıdan seçebilir yada sağ taraftaki
                                            arama bölümünden arayarak bulabilirsiniz.
                                        </p>
                                        <table id="yetkililer" class="table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                                <th>Telefon</th>
                                                <th>Eposta</th>
                                                <th>Düzenle</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($users as $user)
                                                @if($user->roles[0]->id === 2)
                                                    <tr>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->surname}}</td>
                                                        <td>{{$user->phone}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td class="pull-right">
                                                            <a class="btn btn-info text-light">Düzenle</a>
                                                            <a class="btn btn-danger text-light">Sil</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>İşletmeler</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="#isletme-ekle"><i class="fa fa-plus"> İşletme Ekle</i> </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <p class="text-muted font-13 m-b-30">
                                            İşlem yapmak istediğiniz işletmeyi aşağıdan seçebilir yada sağ taraftaki
                                            arama bölümünden arayarak bulabilirsiniz.
                                        </p>
                                        <table id="isletmeler" class="table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>İşletme Adı</th>
                                                <th>İşletme Adresi</th>
                                                <th>İşletme Telefon Numarası</th>
                                                <th>Kontenjan</th>
                                                <th>Düzenle</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($businesses as $business)
                                                <tr>
                                                    <td>{{$business->id}}</td>
                                                    <td>{{$business->business_name}}</td>
                                                    <td>{{$business->business_address}}</td>
                                                    <td>{{$business->business_phone}}</td>
                                                    <td>{{$business->quota}}</td>
                                                    <td class="pull-right">
                                                        <a class="btn btn-info text-light">Düzenle</a>
                                                        <a class="btn btn-danger text-light">Sil</a>
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
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Öğrenciler</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="#ogrenci-ekle"><i class="fa fa-plus"> Öğrenci Ekle</i> </a>
                                </li>
                            </ul>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <p class="text-muted font-13 m-b-30">
                                            İşlem yapmak istediğiniz öğrenciyi aşağıdan seçebilir yada sağ taraftaki
                                            arama bölümünden arayarak bulabilirsiniz.
                                        </p>
                                        <table id="ogrenciler" class="table table-striped table-bordered"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                                <th>Telefon</th>
                                                <th>Eposta</th>
                                                <th>Staj Başlangıç Tarihi</th>
                                                <th>Staj Bitiş Tarihi</th>
                                                <th>Düzenle</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($users as $user)
                                                @if($user->roles[0]->id === 3)
                                                    <tr>
                                                        <td>{{$user->id}}</td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->surname}}</td>
                                                        <td>{{$user->phone}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>21.11.2022</td>
                                                        <td>21.12.2022</td>
                                                        <td class="pull-right">
                                                            <a class="btn btn-info text-light">Düzenle</a>
                                                            <a class="btn btn-danger text-light">Sil</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
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


        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Fırat Üniversitesi Bilgi İşlem Daire Başkanlığı © 2023
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{url('')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{url('')}}/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="{{url('')}}/js/fastclick.js"></script>
<!-- NProgress -->
<script src="{{url('')}}/js/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="{{url('')}}/js/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="{{url('')}}/js/icheck.min.js"></script>
<!-- Skycons -->
<script src="{{url('')}}/js/skycons.js"></script>
<!-- DateJS -->
<script src="{{url('')}}/js/date.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('')}}/js/moment.min.js"></script>
<script src="{{url('')}}/js/daterangepicker.js"></script>

<!-- datatable -->
<script src="{{url('')}}/js/jquery.dataTables.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{url('')}}/js/custom.min.js"></script>
<script src="{{url('')}}/js/bizim.min.js"></script>

</body>
</html>
