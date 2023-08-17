<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
@include('custom.datatables')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong>{{$message}}!</strong>
                    </div>
                @endif

                <div class="x_panel">
                    <form id="internshipApplicationForm"
                          method="POST"
                          action="{{ route('student.students.store')}}"
                          class="form-horizontal form-label-left"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="x_title">
                            <h2>Öğrenci Bilgileri</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Ad<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="first-name" class="form-control"
                                           value="{{Auth::user()->name}}" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Soyad <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="last-name" class="form-control"
                                           value="{{Auth::user()->surname}}" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">Öğrenci
                                    Numarası<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="ogrenci-num" class="form-control" type="text"
                                           value="{{$student->student_number}}" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel-num">Telefon
                                    Numarası<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" id="tel-num" class="form-control"
                                           value="{{Auth::user()->phone}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="x_title">
                            <h2>Staj Bilgileri</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Staj
                                    Türü:<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    @if(isset($student) && $student->internship_type === 1)
                                        <select id="staj-turu" class="form-control" required name="internship_type">
                                            <option value="1" selected>Zorunlu</option>
                                            <option value="2">Gönüllü</option>
                                        </select>
                                    @else
                                        <select id="staj-turu" class="form-control" required name="internship_type">
                                            <option value="1">Zorunlu</option>
                                            <option value="2" selected>Gönüllü</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Staj
                                    Başlangıç Tarihi<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input
                                        type="text"
                                        id="internship_start_date"
                                        class="form-control"
                                        name="internship_start_date"
                                        @if(isset($student->internship_start_date))
                                            value="{{$student->internship_start_date->format('d/m/Y')}}"
                                        @else
                                            value="{{old('internship_start_date')}}"
                                        @endif
                                    >
                                    @error('internship_start_date') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Staj Bitiş
                                    Tarihi :<span
                                        class="required">*</span>
                                </label>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input
                                        type="text"
                                        id="internship_end_date"
                                        class="form-control"
                                        name="internship_end_date"
                                        @if(isset($student->internship_end_date))
                                            value="{{$student->internship_end_date->format('d/m/Y')}}"
                                        @else
                                            value="{{old('internship_end_date')}}"
                                        @endif
                                    >
                                    @error('internship_end_date') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="x_title">
                            <h2>Firma Bilgileri</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Firma
                                    Adı<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input
                                        type="text"
                                        id="business-name"
                                        name="business_name"
                                        required="required"
                                        class="form-control"
                                        @if(isset($business->business_name))
                                            value="{{$business->business_name}}"
                                        @else
                                            value="{{old('business_name')}}"
                                        @endif
                                    >
                                    @error('business_name') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="business_address">Firma
                                    Adresi<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input
                                        type="text"
                                        id="business_address"
                                        name="business_address"
                                        required="required"
                                        class="form-control"
                                        @if(isset($business->business_address))
                                            value="{{$business->business_address}}"
                                        @else
                                            value="{{old('business_address')}}"
                                        @endif
                                    >
                                    @error('business_address') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="ogrenci-num" name="business_phone"
                                       class="col-form-label col-md-3 col-sm-3 label-align">Firma
                                    Telefon Numarası
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input
                                        id="business_phone"
                                        class="form-control"
                                        type="number"
                                        name="business_phone"
                                        required
                                        @if(isset($business->business_phone))
                                            value="{{$business->business_phone}}"
                                        @else
                                            value="{{old('business_phone')}}"
                                        @endif

                                    >
                                    @error('business_phone') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="x_title">
                                <h2>Evraklar</h2>
                                <div class="clearfix"></div>
                            </div>

                            {{$documentTypes}}

                            @foreach($documentTypes as $documentType)

                                <div class="item form-group">
                                    <label for="formFileLg"
                                           class="col-form-label col-md-3 col-sm-3 label-align">{{$documentType->document_type}}</label>
                                    <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input
                                            class="form-control border-0"
                                            id="formFileLg"
                                            name="{{$documentType->document_slug}}"
                                            type="file"
                                            value="{{old($documentType->document_slug)}}"
                                        >
                                        @error($documentType->document_slug) <span
                                            class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endforeach


                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Fakülte Onayına Gönder</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

@include('student.common.js')

<script>
    $(function () {
        $('#internship_start_date, #internship_end_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    })
</script>

</body>
</html>
