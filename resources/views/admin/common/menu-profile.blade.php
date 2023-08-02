<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{url('')}}/images/user.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Hoşgeldiniz,</span>
        <h2>{{ Auth::user()->name . ' ' . Auth::user()->surname   }} {{--{{$user->name . ' ' . $user->surname}}--}}</h2>
    </div>
</div>
