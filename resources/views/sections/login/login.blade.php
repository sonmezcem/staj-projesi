<!DOCTYPE html>
<html lang="tr">
@include('common.head')
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="images/firat-logo-yatay.png" width="360" height="140">
                <form action="/login-checker" method="POST" id="girisFormu">
                    @csrf
                    <h1>Staj Takip Sistemi</h1>
                    <div id="hatadurumu">

                    </div>
                    <div>
                        <input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="parola" placeholder="Şifre" required="" />
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="#" id="girisYap">Giriş Yap</a>
                        <a class="reset_pass" href="#">Şifremi Unuttum ?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">
                            <a href="#signup" class="to_register"> Hesap Oluştur </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1>Fırat Üniversitesi</h1>
                            <p>Fırat Üniversitesi Bilgi İşlem Daire Başkanlığı © 2023</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Hesap Oluştur</h1>
                    <div>
                        <input type="text" class="form-control" required="required" placeholder="Ad "/>
                    </div>

                    <div>
                        <input type="text" class="form-control" required="required" placeholder="Soyad" />
                    </div>
                    <div>
                        <input type="text" class="form-control"required="required"  placeholder="Telefon Numarası" />
                    </div>

                    <div>
                        <input type="text" class="form-control" placeholder="Kullanıcı Adı " required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" required="required" placeholder="E-Posta"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" required="required" placeholder="Şifre"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" required="required" placeholder="Şifre Tekrar"/>
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="bos.html">Kaydol</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Zaten Hesabım Var
                            <a href="#signin" class="to_register"> Giriş Yap </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1>Fırat Üniversitesi</h1>
                            <p>Fırat Üniversitesi Bilgi İşlem Daire Başkanlığı © 2023
                            </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script>
    document.getElementById("girisYap").onclick = function (){
        document.getElementById("girisFormu").submit();
    }
</script>
</body>
</html>
