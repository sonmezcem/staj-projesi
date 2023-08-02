<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a href="{{URL::to('admin')}}"><i class="fa fa-home"></i> Anasayfa </a>
            </li>
            <li><a><i class="fa fa-user"></i> Yetkililer <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{URL::to('admin/officers')}}">Tüm Yetkililer</a></li>
                    <li><a href="{{URL::to('admin/officers/create')}}">Yetkili Ekle</a></li>

                </ul>

            </li>
            <li><a><i class="fa fa-exclamation"></i>Öğrenciler<span
                        class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="ogrenci-tablo.html">Öğrenci Düzenleme</a></li>
                </ul>

            </li>
            <li><a><i class="fa fa-exclamation"></i>İşletmeler<span
                        class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="isletme-tablo.html">İşletme Düzenleme</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
