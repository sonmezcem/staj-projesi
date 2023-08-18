<!DOCTYPE html>
<html lang="tr">
@include('common.head')
<body class="login">
<div>
    <a href="{{ route('login') }}" class="to_register"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="images/firat-logo-yatay.png" width="360" height="140">


                <form method="POST" action="{{ route('login') }}" id="girisFormu">
                    @csrf
                    <h1>Staj Takip Sistemi</h1>

                    {{--
                                        @if ($errors->any())
                                            <div>
                                                <p class="alert alert-danger">
                                                    Hata var.
                                                </p>
                                            </div>
                                        @endif
                    --}}

                    <div>

                        <x-text-input id="input_type" class="form-control" type="text" name="input_type"
                                      :value="old('input_type')" required autofocus autocomplete="input_type"
                                      placeholder="Lütfen, kullanıcı adınızı giriniz."/>

                        <div class="hatadurumu">
                            <x-input-error :messages="$errors->get('email')" class="alert alert-danger"/>
                            <x-input-error :messages="$errors->get('username')" class="alert alert-danger"/>
                        </div>


                    </div>

                    <div>
                        <x-text-input id="password" class="form-control"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" placeholder="Şifrenizi giriniz"/>


                    </div>

                    <div class="hatadurumu">
                        <x-input-error :messages="$errors->get('password')" class="alert alert-danger"/>
                    </div>

                    <div>
                        <button class="btn btn-default submit btn-a">Giriş Yap</button>
{{--
                        <a class="btn btn-default submit" href="#" id="girisYap">Giriş Yap</a>
--}}
                        <a class="btn btn-default submit btn-a" href="{{ route('password.request') }}">Şifremi Unuttum ?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">
                            <a href="{{ route('register') }}" class="to_register"> Hesap Oluştur </a>
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
    </div>
</div>
</body>
</html>


