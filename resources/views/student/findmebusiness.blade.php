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


                    <div class="x_title">
                        <h2>İşletmeler</h2>
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
                                                        <form
                                                            id="isletme-{{$business->id}}"
                                                            action="{{route('student.apply', $business->id)}}"
                                                            method="GET"
                                                        >
                                                            @csrf

                                                            <button type="submit"
                                                                    class="btn btn-success text-light"
                                                                    onclick="isletmeBasvuru({{$business->id}})">Başvur
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
<script>
</script>
</body>
</html>
