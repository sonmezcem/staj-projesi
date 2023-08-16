<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
                @if($student->internship_status === 1)
                    <li><a href="{{URL::to('student')}}"><i class="fa fa-home"></i> Anasayfa </a>
                    <li><a href="{{URL::to('student/application-form')}}"><i class="fa fa-edit"></i>Staj Başvuru Formu</a></li>
                    <li><a href="{{URL::to('student/find-me-business')}}"><i class="fa fa-exclamation"></i>Staj Yeri Bulamadım</a></li>
                @elseif($student->internship_status === 2)

                    <li><a href="{{URL::to('student')}}"><i class="fa fa-home"></i> Anasayfa </a></li>


                @else

                <li><a href="{{URL::to('student')}}"><i class="fa fa-home"></i> Anasayfa </a></li>
            @endif


            {{--
                        <li><a><i class="fa fa-user"></i> Yetkililer <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{URL::to('student/internship-application')}}">Tüm Yetkililer</a></li>
                                <li><a href="{{URL::to('admin/officers/create')}}">Yetkili Ekle</a></li>

                            </ul>

                        </li>
                        <li><a><i class="fa fa-institution"></i>İşletmeler<span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{URL::to('admin/businesses')}}">Tüm işletmeler</a></li>
                            <li><a href="{{URL::to('admin/businesses/create')}}">İşletme Ekle</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-pencil"></i>Öğrenciler<span
                                    class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{URL::to('admin/students')}}">Tüm Öğrenciler</a></li>
                                <li><a href="{{URL::to('admin/students')}}">Stajını Tamamlamış Öğrenciler</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-paperclip"></i>Döküman Türleri<span
                                    class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{URL::to('admin/documenttypes')}}">Tüm Döküman Türleri</a></li>
                                <li><a href="{{URL::to('admin/documenttypes/create')}}">Yeni Döküman Türü Ekle</a></li>
                            </ul>
                        </li>
            --}}

        </ul>
    </div>
</div>
