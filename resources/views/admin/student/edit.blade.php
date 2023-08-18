<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                @include('admin.common.logo')
                @if(isset($user->user_type) && $user->user_type === 3)

                @endif

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

                @if ($message = Session::get('rejection'))
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong>{{$message}}!</strong>
                    </div>
                @endif

                {{--{{$user->rejection}}--}}

                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$user->user->name . " " . $user->user->surname . "'i"}} düzenliyorsunuz...</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form class="form-horizontal form-label-left" method="POST"
                              action="{{ route('admin.students.update', $user->id  ) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3"></label>
                                <div class="col-md-9 col-sm-9 col-xs-9 text-center">
                                    <img class="img-responsive avatar-view rounded-circle"
                                         src="{{$user->user->profile_picture}}" alt="Avatar" title="Change the avatar">
                                    <br>
                                    {{$user->user->name . " " . $user->user->surname }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Öğreni No:</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" readonly
                                           value="{{$user->student_number}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Adı</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" readonly value="{{$user->user->name}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Soyadı</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" readonly
                                           value="{{$user->user->surname}}">
                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Telefon</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="text" class="form-control" name="student[phone]"
                                           value="{{$user->user->phone}}">
                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                    @error('phone') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Eposta</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="email" class="form-control" name="student[email]"
                                           value="{{$user->user->email}}">
                                    <span class="fa fa-inbox form-control-feedback right" aria-hidden="true"></span>
                                    @error('email') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Parola gönder</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="btn btn-secondary text-white"
                                         onclick="parolaGonder({{$user->user_id}})">
                                        Parola gönder
                                    </div>
                                </div>
                            </div>
                            @if(isset($user->business))
                                <div class="form-group row">
                                    <input type="hidden" name="business[id]" value="{{$user->business->id}}">
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="business[business_name]"
                                               value="{{$user->business->business_name}}">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business_name') <span class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme Adresi</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="business[business_address]"
                                               value="{{$user->business->business_address}}">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business_name') <span class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme Telefon</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="business[business_phone]"
                                               value="{{$user->business->business_phone}}">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business_name') <span class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <input type="hidden" name="business[id]" id="business_id">
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="business[business_name]"
                                            id="business_name"
                                            readonly
                                        >
                                        <a href="#"><span class="fa fa-search form-control-feedback right"
                                                          aria-hidden="true"></span></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme Adresi</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="business[business_address]"
                                            id="business_address"
                                            readonly
                                        >
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business[business_address]') <span
                                            class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme Telefon</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="business[business_phone]"
                                            id="business_phone"
                                            readonly
                                        >
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business[business_phone]') <span
                                            class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme ara</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">

                                        <input type="text" id="search" class="live-search-box"
                                               placeholder="İşletme arayınız"/>

                                        <ul class="live-search-list">

                                        </ul>
                                        <a href="#"><span class="fa fa-search form-control-feedback right"
                                                          aria-hidden="true"></span></a>
                                    </div>
                                </div>
                            @endif

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Staj Türü</label>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    @if(isset($user->internship_type) && $user->internship_type === 1)
                                        <select id="staj-turu" class="form-control" required
                                                name="student[internship_type]">
                                            <option value="1" selected>Zorunlu</option>
                                            <option value="2">Gönüllü</option>
                                        </select>
                                    @else
                                        <select id="staj-turu" class="form-control" required
                                                name="student[internship_type]">
                                            <option value="1">Zorunlu</option>
                                            <option value="2" selected>Gönüllü</option>
                                        </select>
                                    @endif
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Staj Başlangıç Tarihi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input
                                        type="text"
                                        id="internship_start_date"
                                        class="form-control"
                                        name="student[internship_start_date]"
                                        value="@if(isset($user->internship_start_date)){{$user->internship_start_date->format('d/m/Y')}}@endif"
                                    >
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                    @error('internship_start_date') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Staj Bitiş Tarihi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input
                                        type="text"
                                        id="internship_end_date"
                                        class="form-control"
                                        name="student[internship_end_date]"
                                        value="@if(isset($user->internship_end_date)){{$user->internship_end_date->format('d/m/Y')}}@endif"
                                    >
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                    @error('internship_end_date') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Belgeler</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    @foreach($user->document as $document)
                                        <a
                                            href="{{url($document->file_path)}}"
                                            class="btn border  no-margin"
                                            target="_blank"
                                        >
                                            @foreach($documentTypes as $documentType)
                                                @if($document->document_type_id === $documentType->id)
                                                    {{$documentType->document_type}}
                                                @endif
                                            @endforeach
                                        </a>

                                        <a onclick="resimSil({{$document->id}})">X</a>

                                    @endforeach

                                    {{--
                                                                        <a href="#" class="btn border">Öğrenci Belgesi</a>
                                                                        <a href="#" class="btn border">Öğrenci Belgesi</a>
                                                                        <a href="#" class="btn border">Öğrenci Belgesi</a>
                                    --}}

                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Onay durumu</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    @if(isset($user->rejection->student_id))
                                        <input
                                            type="radio"
                                            class="iradio_flat-green checked"
                                            name="approval-radio"
                                            value="approve"
                                            id="approve"
                                        >
                                        Onayla
                                        <input
                                            type="radio"
                                            class="iradio_flat-green checked"
                                            name="approval-radio"
                                            value="dismiss"
                                            id="reject"
                                            checked
                                        >
                                        Reddet
                                    @else
                                        <input
                                            type="radio"
                                            class="iradio_flat-green checked"
                                            name="approval-radio"
                                            value="approve"
                                            id="approve"
                                            checked
                                        >
                                        Onayla
                                        <input
                                            type="radio"
                                            class="iradio_flat-green checked"
                                            name="approval-radio"
                                            value="dismiss"
                                            id="reject"
                                        >
                                        Reddet
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Red gerekçesi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    @if(!isset($user->rejection->student_id))
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="reason"
                                            placeholder=""
                                            id="reason"
                                            disabled
                                        >
                                        @error('reason') <span class="red">{{ $message }}</span> @enderror
                                    @endif
                                    @if(isset($user->rejection->student_id))
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="reason"
                                            placeholder=""
                                            id="reason"
                                            value="{{$user->rejection->reason}}"
                                        >
                                        @error('reason') <span class="red">{{ $message }}</span> @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Lütfen, problemleri
                                    seçiniz</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <label>
                                        <input
                                            type="checkbox"
                                            class="flat sorunlar"
                                            name="errors[]"
                                            value="business_error"
                                        >
                                        İşletme ile ilgili sorun.
                                    </label>
                                    <label>
                                        <input type="checkbox"
                                               class="flat sorunlar"
                                               name="errors[]"
                                               value="internship_date_error"
                                        >
                                        Staj tarihleri ile ilgili sorun.
                                    </label>
                                    <label>
                                        <input
                                            type="checkbox"
                                            class="flat sorunlar"
                                            name="errors[]"
                                            value="documents_error"
                                        >
                                        Belgeler ile ilgili sorun.
                                    </label>
                                    @error('errors') <br><span class="red">{{ $message }}</span> @enderror
{{--
                                    @foreach($user->error as $rejectionError)

                                        @switch(isset($rejectionError->problem))
                                            @case($rejectionError->problem === "business_error")
                                                {{$rejectionError->problem}}
                                                @break
                                            @case($rejectionError->problem === "internship_date_error")
                                                {{$rejectionError->problem}}
                                                @break
                                            @case($rejectionError->problem === "documents_error")
                                                {{$rejectionError->problem}}
                                                @break
                                            @default
                                        @endswitch
--}}



                                        {{--
                                @if($rejectionError->problem === "business_error")
                                        {{$rejectionError->problem}}
                                    @endif
                                    @if($rejectionError->problem === "internship_date_error")
                                        {{$rejectionError->problem}}
                                    @endif
                                    @if($rejectionError->problem === "documents_error")
                                        {{$rejectionError->problem}}
                                    @endif
--}}
                                    {{--@endforeach--}}

                                    {{--/// eğer işaretli değilse nasıl olacak onu yapacağız.--}}
{{--
                                    @switch(!isset($rejectionError->problem))
                                        @case(empty($rejectionError->problem))
                                            {{$user}}
                                            @break
                                        @default
                                            {{$user}}
                                    @endswitch
--}}
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <a href="{{ route('admin.officers.index')}}" type=""
                                       class="btn btn-primary">İptal</a>
                                    <button type="submit" class="btn btn-success">Güncelle</button>
                                    <a href="#"
                                       onclick="ogrenciSifirla({{$user->id}})"
                                       class="btn btn-danger pull-right"
                                    >
                                        Sıfırla
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ln_solid"></div>
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
@include('admin.common.js')
<script>
    function parolaGonder(id) {
        var formData = {
            id: id
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{URL('/admin/students/password-reset/')}}" + "/" + id,
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
        });
        Swal.fire({
            icon: 'success',
            text: 'Yeni parola gönderildi!',
            confirmButtonText: 'Tamam'
        })
    }
</script>

<script>
    $("#search").on("keyup", function () {
        var formData = {
            search: $(this).val()
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{URL::to('/admin/student-search')}}",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            sayac = 0;
            if (data)
                $.each(data, function (index, val) {
                    $('.live-search-list').empty();
                    $('.live-search-list').append($('<li>').text('İşletme: ' + data.business_name));
                    $('#business_id').val(data.id)
                    $('#business_name').val(data.business_name)
                    $('#business_address').val(data.business_address)
                    $('#business_phone').val(data.business_phone)
                });
            console.log(data);

        });
    });

    $(function () {
        $('#internship_start_date, #internship_end_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    })

    $('#reject').change(
        function () {
            if ($(this).is(':checked') && $(this).val() == 'dismiss') {
                $('#reason').attr('placeholder', 'Lütfen, red gerekçesini giriniz');
                $('#reason').prop("disabled", false);
                $('.sorunlar').each(function () {
                    if (!$(this).is(':checked')) {
                        $(this).prop('disabled', false);
                    }
                });
            }
        })
    $('#approve').change(
        function () {
            if ($(this).is(':checked')) {
                $('#reason').attr('placeholder', '');
                $('#reason',).prop("disabled", true);
                $('.sorunlar').each(function () {
                    if (!$(this).is(':checked')) {
                        $(this).prop('disabled', true);
                    }
                });

            }
        })

    function ogrenciSifirla(id) {

        Swal.fire({
            title: 'Yapacağınız işlem sonucu öğrencinin staj ile ilgili bilgileri sıfırlanacaktır ve yeniden staj belgelerini göndermek zorunda kalacaktır?',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Silindi!',
                    'Öğrencinin staj ile ilgili bilgileri silindi.',
                    'Tamam'
                )
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{URL::to('/admin/internship-removal')}}" + '/' + id,
                    dataType: "json",
                    encode: true,
                })
            }
        })

        /*        Swal.fire({
                    title: 'Yapacağınız işlem sonucu öğrencinin staj ile ilgili bilgileri sıfırlanacaktır ve yeniden staj belgelerini göndermek zorunda kalacaktır.',
                    confirmButtonText: 'Tamam',
                })*/
    }

    function resimSil(id) {

        Swal.fire({
            title: 'Yapacağınız işlem sonucu yüklenmiş olan resim silinecektir.',
            text: "Bu işlem geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, sil!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{route('admin.imageRemoval', ':id')}}";
                url = url.replace(':id', id);
                Swal.fire(
                    'Silindi!',
                    'İlgili resim silindi.',
                    'success'
                )
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    encode: true,
                })
            }
        })

        /*        Swal.fire({
                    title: 'Yapacağınız işlem sonucu öğrencinin staj ile ilgili bilgileri sıfırlanacaktır ve yeniden staj belgelerini göndermek zorunda kalacaktır.',
                    confirmButtonText: 'Tamam',
                })*/
    }


</script>
</body>
</html>
