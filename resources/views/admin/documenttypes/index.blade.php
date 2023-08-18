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
                        <h2>Tüm Döküman Türleri <small>Döküman türlerini düzenlemek için ilgili döküman türünün sağ tarafındaki düzenle
                                butonuna tıklayabilirsiniz.</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{{--{{route('admin.officer.create')}}--}}"><i class="fa fa-plus"> Döküman Türü Ekle</i> </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Döküman Türü</th>
                                <th>Düzenle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($documentTypes as $documentType)

                                <tr>
                                    <th scope="row">{{$documentType->id}}</th>
                                    <td>{{$documentType->document_type}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('admin.documenttypes.edit', $documentType->id)}}"
                                               class="btn btn-info text-light">Düzenle</a>
                                            <form
                                                id="dokumanTuru-{{$documentType->id}}"
                                                action="{{route('admin.documenttypes.destroy', $documentType->id)}}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger text-light"
                                                        onclick="dokumanTuruSilme({{$documentType->id}})">Sil
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
