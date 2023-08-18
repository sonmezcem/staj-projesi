<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')
<body class="nav-md">

@if(Session::has('message'))
    {{Session::get('message')}}
@endif
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
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <strong>{{$message}}!</strong>
                    </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tüm Yetkililer <small>Yetkilileri düzenlemek için ilgili yetkilinin sağ tarafındaki düzenle
                                butonuna tıklayabilirsiniz.</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{{--{{route('admin.officer.create')}}--}}"><i class="fa fa-plus"> Yetkili
                                        Ekle</i> </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>İşletme Adı</th>
                                <th>Adresi</th>
                                <th>Telefonu</th>
                                <th>Kontenjan</th>
                                <th>Düzenle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($businesses as $business)

                                <tr>
                                    <th scope="row">{{$business->id}}</th>
                                    <td>{{$business->business_name}}</td>
                                    <td>{{$business->business_address}}</td>
                                    <td>{{$business->business_phone}}</td>
                                    <td>{{$business->quota}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('admin.businesses.edit', $business->id)}}"
                                               class="btn btn-info text-light">Düzenle</a>
                                            <form
                                                id="isletme-{{$business->id}}"
                                                action="{{route('admin.businesses.destroy', $business->id)}}"
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
                        <div class="d-flex justify-content-center">
                            {{ $businesses->links()}}
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

@include('admin.common.js')

</body>
</html>
