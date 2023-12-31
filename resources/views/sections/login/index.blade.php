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

                    @if ($errors->any())
                        <div>
                            <p class="alert alert-danger">
                            Hata var.
                            </p>
                        </div>
                    @endif

                    <div class="hatadurumu">
                        @if($errors->has('kullanici_adi'))
                            <p class="alert alert-danger">{{ $errors->first('kullanici_adi') }}</p>
                        @endif
                    </div>
                    <div>
                        <input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı"
                               required=""/>
                    </div>
                    <div class="hatadurumu">
                        @if($errors->has('parola'))
                            <p class="alert alert-danger">{{ $errors->first('parola') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="password" class="form-control" name="parola" placeholder="Şifre" required=""/>
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
                        <br/>

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
                <form action="/register" method="POST" id="kayitFormu">
                    @csrf

                    <h1>Hesap Oluştur</h1>
                    <div class="hatadurumu">
                        @if($errors->has('kayit_ad'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_ad') }}</p>
                        @endif
                    </div>
                    <div>
                        <input type="text" class="form-control" name="kayit_ad" required="required" placeholder="Ad "/>
                    </div>
                    <div class="hatadurumu">
                        @if($errors->has('kayit_soyad'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_soyad') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="text" class="form-control" name="kayit_soyad" required="required"
                               placeholder="Soyad"/>
                    </div>

                    <div class="hatadurumu">
                        @if($errors->has('kayit_telefon'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_telefon') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="text" class="form-control" name="kayit_telefon" required="required"
                               placeholder="Telefon Numarası"/>
                    </div>

                    <div class="hatadurumu">
                        @if($errors->has('kayit_kullanici_adi'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_kullanici_adi') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="text" class="form-control" name="kayit_kullanici_adi" placeholder="Kullanıcı Adı "
                               required=""/>
                    </div>

                    <div class="hatadurumu">
                        @if($errors->has('kayit_eposta'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_eposta') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="email" class="form-control" name="kayit_eposta" required="required"
                               placeholder="E-Posta"/>
                    </div>

                    <div class="hatadurumu">
                        @if($errors->has('kayit_parola'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_parola') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="password" class="form-control" name="kayit_parola" required="required"
                               placeholder="Şifre"/>
                    </div>

                    <div class="hatadurumu">
                        @if($errors->has('kayit_parola_tekrari'))
                            <p class="alert alert-danger">{{ $errors->first('kayit_parola_tekrari') }}</p>
                        @endif
                    </div>

                    <div>
                        <input type="password" class="form-control" name="kayit_parola_tekrari" required="required"
                               placeholder="Şifre Tekrar"/>
                    </div>
                    <div>
                        <a class="btn btn-default submit" id="kaydol" href="#">Kaydol</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Zaten Hesabım Var
                            <a href="#signin" class="to_register"> Giriş Yap </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

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
    document.getElementById("girisYap").onclick = function () {
        document.getElementById("girisFormu").submit();
    }
    document.getElementById("kaydol").onclick = function () {
        document.getElementById("kayitFormu").submit();
    }
</script>
</body>
</html>
