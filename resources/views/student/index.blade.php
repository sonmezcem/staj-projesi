<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
@include('custom.datatables')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 3;">
                    <a href="{{url('')}}" class="site_title"><img src="{{url('')}}/images/firat_logo.gif" width="45"
                                                                  height="45"></i> <span>Fırat Üniversitesi</span></a>
                </div>


                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                @include('student.common.menu-profile')
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                @include('student.common.sidebar')
                <!-- /sidebar menu -->


            </div>
        </div>

        <!-- top navigation -->
        @include('student.common.top-navigation')
        <!-- /top navigation -->

        <!-- page content -->

        <div class="right_col" role="main">

            <div class="row">
                <div class="x_panel">
                    @if (!empty($message))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                            </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif

                    <div class="x_title">
                        <h2>Bilgilerim</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-2 ">Adı :</label>
                            <div class="col-md-10 col-sm-10 ">
                                <input type="text" class="form-control" readonly="readonly"
                                       placeholder="{{ Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-2 ">Soyadı :</label>
                            <div class="col-md-10 col-sm-10 ">
                                <input type="text" class="form-control" readonly="readonly"
                                       placeholder="{{ Auth::user()->surname}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-2 ">Telefon Numarası :</label>
                            <div class="col-md-10 col-sm-10 ">
                                <input type="text" class="form-control" readonly="readonly"
                                       placeholder="{{ Auth::user()->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-2  ">E-Posta Adresi :</label>
                            <div class="col-md-10 col-sm-10 ">
                                <input type="text" class="form-control" readonly="readonly"
                                       placeholder="{{ Auth::user()->email}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel col-lg-3">
                    Staj Durumu
                </div>
                @if(isset($student) && $student->internship_status == 1)
                    <div class="x_panel col-lg-9 alert alert-info">
                        <i class="fa fa-spinner" aria-hidden="true"></i>
                        <strong>Staj başvurunuz onay için bekleniyor. Onaylandığında eposta ile
                            bilgilendirileceksiniz.</strong>
                    </div>
                @elseif(isset($student) && $student->internship_status == 2)
                    <div class="x_panel col-lg-9 alert alert-success">
                        <strong>Staj başvurunuz onaylandı. {{$student->internship_start_date->format('d M Y')}}
                            tarihinde stajınız başlayacaktır.</strong>
                    </div>
                @elseif(isset($student) && $student->internship_status == 3)
                    <div class="x_panel col-lg-9 alert alert-danger">
                        <strong>Staj başvurunuz red edildi. Nedenini öğrenmek için <a href="#">tıklayınız.</a></strong>
                    </div>
                @else
                    <div class="x_panel col-lg-9 alert">
                        <strong>Henüz staj başvurusu yapmadınız. Staj başvurusu yapmak için <a href="{{URL::to('student/application-form')}}">tıklayınız</a>.</strong>
                    </div>
                @endif

            </div>
            {{--<div>
                --}}{{--{{$student}}--}}{{--
            </div>--}}

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

@include('student.common.js')

</body>
</html>
