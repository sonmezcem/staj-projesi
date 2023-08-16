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
                    <h2>Merhaba {{Auth::user()->name . " " . Auth::user()->surname}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    Lütfen, sol taraftan staj başvurusu yada staj yeri bulamadıysanız staj yeri bulamadım bağlantısına tıklayınız.
                </div>
                    <div class="x_title">
                        <h2>Öğrenci Bilgileri</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <div class="item form-group">
                            <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Öğrenci
                                Numarası<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="ogrenci-num"
                                       class="form-control"
                                       value="{{$student->student_number}}"
                                       readonly
                                >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Ad
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="ogrenci-num"
                                       class="form-control"
                                       value="{{Auth::user()->name}}"
                                       readonly
                                >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Soyad
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="ogrenci-num"
                                       class="form-control"
                                       value="{{Auth::user()->surname}}"
                                       readonly
                                >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Telefon
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="ogrenci-num"
                                       class="form-control"
                                       value="{{Auth::user()->phone}}"
                                       readonly
                                >
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Eposta
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="ogrenci-num"
                                       class="form-control"
                                       value="{{Auth::user()->email}}"
                                       readonly
                                >
                            </div>
                        </div>

                    </div>
            </div>

                <div class="x_panel col-lg-3">
                    Staj Durumu
                </div>

            @if(isset($student) && $student->internship_status == 1)

                    <div class="x_panel col-lg-9 alert">
                        <strong>Henüz staj başvurusu yapmadınız. Staj başvurusu yapmak için <a href="{{URL::to('student/application-form')}}">tıklayınız</a>.</strong>
                    </div>
                @elseif(isset($student) && $student->internship_status == 2)
                    <div class="x_panel col-lg-9 alert alert-info">
                        <i class="fa fa-spinner" aria-hidden="true"></i>
                        <strong>Staj başvurunuz alındı ve onay için bekleniyor. Onaylandığında eposta ile
                            bilgilendirileceksiniz.</strong>
                    </div>
                @elseif(isset($student) && $student->internship_status == 3)
                    <div class="x_panel col-lg-9 alert alert-success">
                        <strong>Staj başvurunuz onaylandı. {{$student->internship_start_date->format('d M Y')}}
                            tarihinde stajınız başlayacaktır.</strong>
                    </div>
                @elseif(isset($student) && $student->internship_status == 4)
                    <div class="x_panel col-lg-9 alert alert-danger">
                        <strong>Staj başvurunuz red edildi. Nedenini öğrenmek için <a href="#">tıklayınız.</a></strong>
                    </div>
                @else
                    <div class="x_panel col-lg-9 alert alert-danger">
                        <strong>Staj ile ilgili bir işlem sizin için bulunmamaktadır.</strong>
                    </div>
                @endif


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

@if(isset($rejectionReason->reason))
    <script>
        function bilgi() {
            Swal.fire({
                title: '{{$rejectionReason->reason}}, <br> <p class="small"> Eksiklikleri gidermeniz için ilgili bölümler aktiftir. Lütfen, eksiklikleri tamamlayınız.</p>',
                confirmButtonText: 'Tamam',
            })
        }
    </script>
@endif
</body>
</html>
