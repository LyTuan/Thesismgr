<pre>
    Đây là tài khoản của bạn ở hệ thống ThesisMgr
    Tài khoản: {{ $username }}
    Mật khẩu: {{ $password }}
    Hoặc đăng nhập tại:
    <a href="{{ route('activateAccount', ['code' => $confirmation_code]) }}">{{ route('activateAccount', ['code' => $confirmation_code]) }}</a>
</pre>
