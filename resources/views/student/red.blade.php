<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
@include('custom.datatables')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('student.common.logo')
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
            <div class="x_panel col-lg-3">
                Staj Durumu
            </div>
            <div class="x_panel col-lg-9 alert alert-danger">
                <strong>Staj başvurunuz red edildi. Nedenini öğrenmek için <a onclick="bilgi()" href="#">tıklayınız.</a></strong>
            </div>

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
                <form class="form-horizontal form-label-left" method="POST"
                      action="{{route('student.fix')}}"
                      class="form-horizontal form-label-left"
                      enctype="multipart/form-data">
                    @csrf
                    @foreach($errorMessages as $error)
                        @if($error->problem === "business_error")
                            <input type="hidden" name="business_error" value="1">
                            <div class="x_title">
                                <h2>İşletme Bilgileri</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br>
                                <div class="item form-group">
                                    <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">İşletme
                                        Adı</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input class="form-control"
                                               value="@if(isset($business)){{$business->business_name}} @endif"
                                               name="business_name"
                                        >
                                        @error('business_name')
                                        <span class="red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">İşletme
                                        Adresi</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input class="form-control"
                                               value="@if(isset($business)){{$business->business_address}} @endif"
                                               name="business_address"
                                        >
                                        @error('business_address')
                                        <span class="red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label for="ogrenci-num" class="col-form-label col-md-3 col-sm-3 label-align">İşletme
                                        Telefonu</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input class="form-control"
                                               value="@if(isset($business)){{$business->business_phone}} @endif"
                                               name="business_phone"
                                        >
                                        @error('business_phone')
                                        <span class="red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach($errorMessages as $error)
                        @if($error->problem === "internship_date_error")
                            <input type="hidden" name="internship_date_error" value="1">
                            <div class="x_title">
                                <h2>Staj Tarihleri</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
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
                        @endif
                    @endforeach
                    @foreach($errorMessages as $error)
                        @if($error->problem === "documents_error")
                            <input type="hidden" name="documents_error" value="1">
                            <div class="x_title">
                                <h2>Evraklar</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
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
                                                class="red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                    <div class="x_title">
                        <h2>Eksiklikleri tamamladım</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Tekrar Başvur</button>
                            </div>
                        </div>
                    </div>

                </form>
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

@if(isset($rejectionReason->reason))
    <script>
        function bilgi() {
            Swal.fire({
                title: '{{$rejectionReason->reason}}, <br> <p class="small"> Eksiklikleri gidermeniz için ilgili bölümler aktiftir. Lütfen, eksiklikleri tamamlayınız.</p>',
                confirmButtonText: 'Tamam',
            })
        }

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
@endif
</body>
</html>
