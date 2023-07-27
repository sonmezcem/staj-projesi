<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/html">
@include('common.head')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{url('')}}" class="site_title"><img src="{{url('')}}/images/firat_logo.gif" width="45" height="45"></i> <span>Fırat Üniversitesi</span></a>
                </div>

                @if($user->user_type === 3)

                @endif

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{url('')}}/images/user.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Hoşgeldiniz,</span>
                        <h2>{{$user->name . ' ' . $user->surname}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Anasayfa <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="bos.html">Bilgilerim</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Staj Kayıt Formu <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="../ayiklanmis-tema/staj-basvuru.html">Staj Başvuru Formu</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-exclamation"></i>Staj Yeri Bulamadım<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="staj-yeri-bulamadim.html">Staj Yeri</a></li>
                                </ul>

                            </li>
                            <li>
                                <ul class="nav child_menu">
                                    <li><a href="../gentelella-master/production/tables.html">Tables</a></li>
                                    <li><a href="../gentelella-master/production/tables_dynamic.html">Table Dynamic</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul class="nav child_menu">
                                    <li><a href="../gentelella-master/production/chartjs.html">Chart JS</a></li>
                                    <li><a href="../gentelella-master/production/chartjs2.html">Chart JS2</a></li>
                                    <li><a href="../gentelella-master/production/morisjs.html">Moris JS</a></li>
                                    <li><a href="../gentelella-master/production/echarts.html">ECharts</a></li>
                                    <li><a href="../gentelella-master/production/other_charts.html">Other Charts</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul class="nav child_menu">
                                    <li><a href="../gentelella-master/production/fixed_sidebar.html">Fixed Sidebar</a></li>
                                    <li><a href="../gentelella-master/production/fixed_footer.html">Fixed Footer</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <ul class="nav side-menu">
                        <li>
                            <ul class="nav child_menu">
                                <li><a href="../gentelella-master/production/e_commerce.html">E-commerce</a></li>
                                <li><a href="../gentelella-master/production/projects.html">Projects</a></li>
                                <li><a href="../gentelella-master/production/project_detail.html">Project Detail</a></li>
                                <li><a href="../gentelella-master/production/contacts.html">Contacts</a></li>
                                <li><a href="../gentelella-master/production/profile.html">Profile</a></li>
                            </ul>
                        </li>
                        <li>
                            <ul class="nav child_menu">
                                <li><a href="../gentelella-master/production/page_403.html">403 Error</a></li>
                                <li><a href="../gentelella-master/production/page_404.html">404 Error</a></li>
                                <li><a href="../gentelella-master/production/page_500.html">500 Error</a></li>
                                <li><a href="../gentelella-master/production/plain_page.html">Plain Page</a></li>
                                <li><a href="../gentelella-master/production/login.html">Login Page</a></li>
                                <li><a href="../gentelella-master/production/pricing_tables.html">Pricing Tables</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /sidebar menu -->


            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{url('')}}/images/user.jpg" alt="">Mustafa Güngör
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="profil.html"> Profil</a>
                                <a class="dropdown-item"  href="{{url('')}}/logout.html"><i class="fa fa-sign-out pull-right"></i> Çıkış Yap </a>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12    col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Bilgilerim</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-0 ">Adı :</label>
                                <div class="col-md-5 col-sm-5 ">
                                    <input type="text" class="form-control" placeholder="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-0 ">Soyadı :</label>
                                <div class="col-md-5 col-sm-5 ">
                                    <input type="text" class="form-control" placeholder="{{$user->surname}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-0 ">Telefon Numarası :</label>
                                <div class="col-md-5 col-sm-5 ">
                                    <input type="text" class="form-control" placeholder="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-1 col-sm-0 ">E-Posta Adresi :</label>
                                <div class="col-md-5 col-sm-5 ">
                                    <input type="text" class="form-control" placeholder="{{$user->email}}">
                                </div>
                            </div>

                            {{$user}}

                        </div>
                    </div>
                    <!-- Staj Durumu-->

                    <!-- Staj Durumu-->

                </div>
            </div>

            <br />
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

<!-- jQuery -->
<script src="{{url('')}}/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{url('')}}/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="{{url('')}}/js/fastclick.js"></script>
<!-- NProgress -->
<script src="{{url('')}}/js/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="{{url('')}}/js/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="{{url('')}}/js/icheck.min.js"></script>
<!-- Skycons -->
<script src="{{url('')}}/js/skycons.js"></script>
<!-- DateJS -->
<script src="{{url('')}}/js/date.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{url('')}}/js/moment.min.js"></script>
<script src="{{url('')}}/js/daterangepicker.js"></script>
<!-- Custom Theme Scripts -->
<script src="{{url('')}}/js/custom.min.js"></script>

</body>
</html>
