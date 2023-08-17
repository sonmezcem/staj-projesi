<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a href="{{URL::to('officer')}}"><i class="fa fa-home"></i> Anasayfa </a>
            </li>
            <li><a><i class="fa fa-institution"></i>İşletmeler<span
                        class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="{{URL::to('officer/businesses')}}">Tüm işletmeler</a></li>
                <li><a href="{{URL::to('officer/businesses/create')}}">İşletme Ekle</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-pencil"></i>Öğrenciler<span
                        class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('officer/students')}}">Tüm Öğrenciler</a></li>
                    <li><a href="{{URL::to('officer/students')}}">Stajını Tamamlamış Öğrenciler</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
