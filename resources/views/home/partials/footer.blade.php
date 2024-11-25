<footer>
    <div class="wave footer"></div>
    <div class="container margin_60_40 fix_mobile">
        <div class="row">
            {{-- Quick Links --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">Quick Links</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        @foreach ($footerNavigation['quick_links'] as $link)
                            <li><a href="{{ route($link['route']) }}">{{ $link['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>


            {{-- Contacts --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_3">Kontak Kami</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="icon_house_alt"></i>Jl. Sudirman No.123<br>Jakarta, Indonesia</li>
                        <li><i class="icon_mobile"></i>+62 812-3456-7890</li>
                        <li><i class="icon_mail_alt"></i><a
                                href="mailto:info@robodeliver.co.id">info@robodeliver.co.id</a></li>
                    </ul>
                </div>
            </div>

            {{-- Keep in touch --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_4">Tetap Terhubung</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <form method="post" action="#" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" class="form-control"
                                    placeholder="Masukkan email Anda">
                                <button type="submit"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="follow_us">
                        <h5>Ikuti Kami</h5>
                        <ul>
                            <li><a target="_blank" href="{{ env('SOCIAL_FACEBOOK') }}"><i
                                        class="bi bi-facebook"></i></a></li>
                            <li><a target="_blank" href="{{ env('SOCIAL_INSTAGRAM') }}"><i
                                        class="bi bi-instagram"></i></a></li>
                            <li><a target="_blank" href="{{ env('SOCIAL_TIKTOK') }}"><i class="bi bi-tiktok"></i></a>
                            </li>
                            <li><a target="_blank" href="{{ env('SOCIAL_WHATSAPP') }}"><i
                                        class="bi bi-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        {{-- Footer Selector --}}
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li>
                        <img src="{{ asset('assets/img/cards_all.svg') }}" alt="Metode Pembayaran" width="230"
                            height="35" class="lazy">
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="{{ route('terms') }}">Syarat dan Ketentuan</a></li>
                    <li><a href="{{ route('privacy') }}">Kebijakan Privasi</a></li>
                    <li><span>© {{ env('APP_NAME') }} {{ now()->year }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
