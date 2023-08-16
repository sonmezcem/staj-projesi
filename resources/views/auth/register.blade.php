<!DOCTYPE html>
<html lang="tr">
@include('common.head')
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="images/firat-logo-yatay.png" width="360" height="140">
                <form action="/register" method="POST" id="kayitFormu">
                    @csrf
                    <h1>Hesap Oluştur</h1>
                    <div>
                        <x-text-input id="student_number" class="form-control" type="text" name="student_number" :value="old('student_number')"
                                      required autofocus autocomplete="student_number" placeholder="Öğrenci Numaranız"/>
                    </div>
                    <div>
                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                                      required autofocus autocomplete="name" placeholder="Adınız"/>
                    </div>
                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('name')" class="alert alert-danger"/>
                    </div>
                    <div>
                        <x-text-input id="surname" class="form-control" type="text" name="surname" :value="old('surname')"
                                      required autofocus autocomplete="surname"
                                      placeholder="Soyadınız"/>
                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('surname')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" placeholder="Telefon numaranız"/>
                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('phone')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Eposta adresiniz"/>
                    </div>
                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('email')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <x-text-input id="username" class="form-control" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Kullanıcı adınız"/>
                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('username')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <x-text-input id="password" class="form-control" type="password" name="password" :value="old('password')" required autofocus autocomplete="password" placeholder="Parolanız"/>
                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('password')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <x-text-input id="password" class="form-control" type="password" name="password_confirmation" :value="old('password_confirmation')" required autofocus autocomplete="password_confirmation" placeholder="Parolanızı tekrar giriniz."/>
                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="alert alert-danger"/>
                    </div>

                    <div class="padding-bottom-10">
                        <span>{!! captcha_img() !!}</span>
                    </div>

                    <div>
                        <x-text-input id="captcha" class="form-control" type="text" name="captcha" required autofocus
                                      placeholder="Yukarıdaki işlemi yapınız."/>
                        <div class="hatadurumu">
                            <x-input-error :messages="$errors->get('captcha')" class="alert alert-danger"/>
                        </div>
                    </div>


                    <div>
                        <a class="btn btn-default submit" id="kaydol" href="#">Kaydol</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Zaten Hesabım Var
                            <a href="{{ route('login') }}" class="to_login"> Giriş Yap </a>
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
    <script>
        document.getElementById("kaydol").onclick = function () {
            document.getElementById("kayitFormu").submit();
        }
    </script>
</body>
</html>
