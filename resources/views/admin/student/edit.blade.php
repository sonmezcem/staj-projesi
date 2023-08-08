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
                        <h2>{{$user->user->name . " " . $user->user->surname . "'i"}} düzenliyorsunuz...</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form class="form-horizontal form-label-left" method="POST"
                              action="{{ route('admin.officers.update', $user->id  ) }}">
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
                                    <input type="text" class="form-control" name="phone" value="{{$user->user->phone}}">
                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                    @error('phone') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Eposta</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="email" class="form-control" name="email"
                                           value="{{$user->user->email}}">
                                    <span class="fa fa-inbox form-control-feedback right" aria-hidden="true"></span>
                                    @error('email') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Parola gönder</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="btn btn-secondary text-white" onclick="parolaGonder({{$user->id}})">
                                        Parola gönder
                                    </div>
                                    <div id="parolaDurumu" class="d-inline">Buraya yazi gelecek</div>
                                </div>
                            </div>
                            @if(isset($user->business))
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="business_name"
                                               value="{{$user->business->business_name}}">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        @error('business_name') <span class="red">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @else
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">İşletme ara</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" class="form-control" name="business"
                                               value="" id="isletme" disabled>
                                        <a href="#"><span class="fa fa-search form-control-feedback right"
                                                          aria-hidden="true"></span></a>
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

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Staj Başlangıç Tarihi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input
                                        type="text"
                                        id="internship_start_date"
                                        class="form-control"
                                        name="internship_start_date"
                                        value="{{$user->internship_start_date->format('d/m/Y')}}"
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
                                        name="internship_end_date"
                                        value="{{$user->internship_end_date->format('d/m/Y')}}"
                                    >
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                    @error('internship_end_date') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Belgeler</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <a href="#" class="btn border">Öğrenci Belgesi</a>
                                    <a href="#" class="btn border">Öğrenci Belgesi</a>
                                    <a href="#" class="btn border">Öğrenci Belgesi</a>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Onay durumu</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input type="radio" class="radio" name="approval-radio" value="approve" id="approve"
                                           checked>Onayla
                                    <input type="radio" class="radio" name="approval-radio" value="dismiss" id="reject">Reddet
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Red gerekçesi</label>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="rejection-reason"
                                        placeholder=""
                                        id="rejection-reason"
                                        disabled
                                    >
                                    @error('rejection-reason') <span class="red">{{ $message }}</span> @enderror
                                </div>
                            </div>



                            <div class="ln_solid"></div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <a href="{{ route('admin.officers.index')}}" type=""
                                       class="btn btn-primary">İptal</a>
                                    <button type="submit" class="btn btn-success">Güncelle</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            {{--
                        {{$user}}
            --}}
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
                    $('#isletme').val(data.business_name)
                    //'id: ' + data.id + ',
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
                $('#rejection-reason').attr('placeholder','Lütfen, red gerekçesini giriniz');
                $('#rejection-reason').prop( "disabled", false );
            }
        })
    $('#approve').change(
        function () {
            if ($(this).is(':checked')) {
                $('#rejection-reason').attr('placeholder','');
                $('#rejection-reason').prop( "disabled", true );
            }
        })

</script>
<script>
</script>

</body>
</html>
