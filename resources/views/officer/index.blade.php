<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
@include('custom.datatables')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('officer.common.logo')
                @if(isset($user->user_type) && $user->user_type === 3)

                @endif

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                @include('officer.common.menu-profile')
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                @include('officer.common.sidebar')
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
                            <h2>İşletmeler</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a href="{{URL::to('officer/businesses/create')}}"><i class="fa fa-plus"> İşletme Ekle</i> </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive overflow-x-hidden">
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
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{route('officer.businesses.edit', $business->id)}}"
                                                               class="btn btn-info text-light">Düzenle</a>
                                                            <form
                                                                id="isletme-{{$business->id}}"
                                                                action="{{route('officer.businesses.destroy', $business->id)}}"
                                                                method="POST"
                                                            >
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                        class="btn btn-danger text-light"
                                                                        onclick="isletmeSilme({{$business->id}})">Sil
                                                                </button>
                                                            </form>
                                                        </div>

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
                                                <th>İşletme Adı</th>
                                                <th>Staj Başlangıç Tarihi</th>
                                                <th>Staj Bitiş Tarihi</th>
                                                <th>Düzenle</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach($students as $user)

                                                <tr>
                                                    <th scope="row">{{$user->id}}</th>
                                                    <td>{{$user->user->name}}</td>
                                                    <td>{{$user->user->surname}}</td>
                                                    <td>{{$user->user->phone}}</td>
                                                    <td>{{$user->user->email}}</td>
                                                    <td>@if(isset($user->business->business_name))
                                                            {{$user->business->business_name}}
                                                        @else
                                                            {{"İşletmesi yok"}}
                                                        @endif
                                                    </td>
                                                    <td>{{$user->internship_start_date}}</td>
                                                    <td>{{$user->internship_end_date}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{route('officer.students.edit', $user->id)}}"
                                                               class="btn btn-primary text-light">İncele</a>
                                                            <form
                                                                id="ogrenciSilme-{{$user->id}}"
                                                                action="{{route('officer.students.destroy', $user->id)}}"
                                                                method="POST"
                                                            >
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                        class="btn btn-danger text-light"
                                                                        onclick="ogrenciSilme-({{$user->id}})">Sil
                                                                </button>
                                                            </form>
                                                        </div>
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
@include('officer.common.js')
</body>
</html>
