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

            {{-- Categories --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">Categories</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach ($footerNavigation['categories'] as $category)
                            <li><a href="{{ route($category['route']) }}">{{ $category['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Contacts --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_3">Contacts</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="icon_house_alt"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                        <li><i class="icon_mobile"></i>+94 423-23-221</li>
                        <li><i class="icon_mail_alt"></i><a href="mailto:info@domain.com">info@domain.com</a></li>
                    </ul>
                </div>
            </div>

            {{-- Keep in touch --}}
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <form method="post" action="{{ route('newsletter.subscribe') }}" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" class="form-control"
                                    placeholder="Your email">
                                <button type="submit"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="follow_us">
                        <h5>Ikuti Kami</h5>
                        <ul>
                            <li><a target="_blank" href="
                                {{ env('SOCIAL_FACEBOOK') }}
                                "><i class="bi bi-facebook"></i></a></li>
                            <li><a target="_blank" href="{{ env('SOCIAL_INSTAGRAM') }}"><i class="bi bi-instagram"></i></a></li>
                            <li><a target="_blank" href="{{ env('SOCIAL_TIKTOK') }}"><i class="bi bi-tiktok"></i></a></li>
                            <li><a target="_blank" href="{{ env('SOCIAL_WHATSAPP') }}"><i class="bi bi-whatsapp"></i></a></li>
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
                        <img src="{{ asset('assets/img/cards_all.svg') }}" alt="Payment Methods" width="230"
                            height="35" class="lazy">
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><a href="{{ route('terms') }}">
                            Syarat dan Ketentuan
                        </a></li>
                    <li><a href="{{ route('privacy') }}">Privasi</a></li>
                    <li><span>© {{ env('APP_NAME') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
