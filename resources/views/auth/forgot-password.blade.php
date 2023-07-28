<!DOCTYPE html>
<html lang="tr">
@include('common.head')
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <a href="login.html"> <img src="images/firat-logo-yatay.png" width="360" height="140"> </a>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h1>Şifremi Unuttum</h1>

                    <div>
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                      required autofocus placeholder="E-Posta Adresini Giriniz"/>
                        <div class="hatadurumu">
                            <x-input-error :messages="$errors->get('email')" class="alert alert-danger"/>
                        </div>
                    </div>

                    <!-- CAPTCHA -->

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
                    <!-- CAPTCHA Bitiş -->


                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="btn-success">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>


                </form>
                <div class="clearfix"></div>

                <div class="separator">

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    $(".btn-refresh").click(function () {
        $.ajax({
            type: 'GET',
            url: '/refresh_captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>
</html>
