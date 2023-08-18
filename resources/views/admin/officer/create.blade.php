<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('admin.common.logo')
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
        @include('admin.common.top-navigation')
        <!-- /top navigation -->

        <!-- page content -->
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
                                    <input type="text" class="form-control" name="username" value="{{old('username')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('username') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Adı</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('name') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Soyadı</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" name="surname" value="{{old('surname')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('surname') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Görevi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" name="major" value="{{old('major')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('major') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Telefon</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="number" class="form-control" name="phone" value="{{old('phone')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('phone') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Eposta</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    @error('email') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
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
