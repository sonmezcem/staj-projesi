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
                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                @include('admin.common.menu-profile')
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                @include('admin.common.sidebar')
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


        {{--
                <div class="right_col" role="main">
                    <div class="col-md-12 col-sm-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible " role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                                </button>
                                <strong>{{$message}}!</strong>
                            </div>
                        @endif

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Yeni kullanıcı oluşturuyorsunuz...</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <form class="form-horizontal form-label-left" method="POST"
                                      action="{{ route('admin.officers.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kullanıcı adı</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input type="text"
                                                   class="form-control"
                                                   name="username"
                                                   placeholder="Lütfen, bir kullanıcı adı belirleyiniz."
                                            >
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Adı</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                placeholder="Yetkilinin adını giriniz..."
                                            >
                                            <span class="fa fa-font form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Soyadı</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="surname"
                                                placeholder="Yetkilinin soyadını giriniz..."
                                            >
                                            <span class="fa fa-font form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Görevi</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="major"
                                                placeholder="Yetkilinin görevini giriniz..."
                                            >
                                            <span class="fa fa-institution form-control-feedback right"
                                                  aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Telefon</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="phone"
                                                placeholder="Yetkilinin telefon numarasını giriniz..."
                                            >
                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Eposta</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <input
                                                type="email"
                                                class="form-control"
                                                name="email"
                                                placeholder="Yetkilinin eposta adresini giriniz."
                                            >
                                            <span class="fa fa-inbox form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div>parola eposta ile gidecek...</div>
                                    <div class="ln_solid"></div>

                                    <div class="form-group row">
                                        <div class="col-md-9 offset-md-3">
                                            <a href="{{ route('admin.officers.index')}}" type="" class="btn btn-primary flex">İptal</a>
                                            <button type="submit" class="btn btn-success">Yetkili Oluştur</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        --}}

        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Yetkili Ekle</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="" action="" method="post" novalidate="">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                        class="rounded-circle mt-5" width="150px"
                                        src="../ayiklanmis-tema/images/user.jpg"><span
                                        class="font-weight-bold"></span><span
                                        class="text-black-50">e-posta@gmail.com</span><span> </span>
                                </div>
                                <input type="file" class="text-center center-block file-upload">

                                </p>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Adı<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" data-validate-length-range="6"
                                               data-validate-words="1" name="name" required="required">
                                    </div>

                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Soyadı<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" data-validate-length-range="6"
                                               data-validate-words="1" name="name" required="required">
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Telefon Numarası<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="tel" class='tel' name="phone"
                                               required='required' data-validate-length-range="8,20"/></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Görevi<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" data-validate-length-range="6"
                                               data-validate-words="1" name="name" required="required">
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align"> Email<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" name="email" required="required" type="email"></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Şifre<span
                                            class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="password" id="password1" name="password"
                                               required="">

                                        <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
													<i id="slash" class="fa fa-eye-slash"></i>
													<i id="eye" class="fa fa-eye"></i>
												</span>
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Şifreyi Tekrar
                                        Giriniz<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" type="password" name="password2"
                                               data-validate-linked="password" required="required"></div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /page content -->

    </div>
</div>

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

@include('admin.common.js')

</body>
</html>
