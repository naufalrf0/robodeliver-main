<x-auth-layout 
    :title="'Daftar - Robodeliver'" 
    :metaDescription="'Login page for Robodeliver users'" 
    :metaAuthor="'Robodeliver Inc.'">
    <h1 class="m-3 fs-4 text-center fw-semibold">Daftar</h1>

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="first_name" placeholder="Nama Depan" required>
            <i class="icon_pencil-edit"></i>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="last_name" placeholder="Nama Belakang" required>
            <i class="icon_pencil-edit"></i>
        </div>
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" required>
            <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Kata Sandi" required>
            <i class="icon_lock_alt"></i>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                required>
            <i class="icon_lock_alt"></i>
        </div>
        <button type="submit" class="btn_1 gradient full-width">Daftar Sekarang</button>
        <div class="text-center mt-2">
            <small>Sudah memiliki akun? <strong><a href="{{ route('login') }}">Masuk</a></strong></small>
        </div>
    </form>

    <div class="divider"><span>Atau</span></div>
    <div class="text-center">
        <a href="{{ route('social.login', 'google') }}" class="social_bt google">Daftar dengan Google</a>
    </div>
</x-auth-layout>
