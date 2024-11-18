<x-auth-layout :title="'Login - Robodeliver'" :metaDescription="'Login page for Robodeliver users'" :metaAuthor="'Robodeliver Inc.'">

        <h1 class="m-3 fs-4 text-center fw-semibold">Masuk</h1>

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email" required>
            <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Kata Sandi" required>
            <i class="icon_lock_alt"></i>
        </div>
        <div class="clearfix add_bottom_15">
            <div class="checkboxes float-start">
                <label class="container_check">Ingat Saya
                    <input type="checkbox" name="remember">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="float-end"><a href="{{ route('password.request') }}">Lupa Kata Sandi?</a></div>
        </div>
        <button type="submit" class="btn_1 gradient full-width">Masuk</button>
        <div class="text-center mt-2">
            <small>Belum memiliki akun? <strong><a href="{{ route('register') }}">Daftar</a></strong></small>
        </div>
    </form>

    <div class="divider"><span>Atau</span></div>
    <div class="text-center">
        <a href="{{ route('social.login', 'google') }}" class="social_bt google">Masuk dengan Google</a>
    </div>
</x-auth-layout>
