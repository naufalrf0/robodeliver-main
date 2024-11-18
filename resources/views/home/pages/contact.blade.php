<x-home-layout :title="'Kontak - Robodeliver'" :metaDescription="'Temukan makanan dan restoran terbaik bersama Robodeliver.'" :metaAuthor="'Robodeliver Inc.'">
    @push('styles')
        <link href="{{ asset('assets/css/contacts.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @endpush

    <x-breadcrumb :title="'Hubungi Robodeliver'" :subtitle="'Kontak Kami'" />

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="box_contacts">
                        <i class="icon_lifesaver"></i>
                        <h2>Pusat Bantuan</h2>
                        <a href="https://wa.me/62812345678">+62 812-3456-7890</a> - <a href="mailto:robodelivertek@gmail.com">robodelivertek@gmail.com</a>
                        <small>SEN hingga JUM 9am-6pm SAB 9am-2pm</small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_contacts">
                        <i class="icon_pin_alt"></i>
                        <h2>Alamat</h2>
                        <div>Jl. Raya Pajajaran, Kota Bogor, Jawa Barat 16128</div>
                        <small>SEN hingga JUM 9am-6pm SAB 9am-2pm</small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box_contacts">
                        <i class="icon_cloud-upload_alt"></i>
                        <h2>Pengajuan</h2>
                        <a href="https://wa.me/62812345678">+62 812-3456-7890</a> - <a href="mailto:order@robodeliver.com">order@robodeliver.com</a>
                        <small>SEN hingga JUM 9am-6pm SAB 9am-2pm</small>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="container margin_60_20">
        <h5 class="mb_5">Kirim Pesan kepada Kami</h5>
        <div class="row">
            <div class="col-lg-4 col-md-6 add_bottom_25">
                <div id="message-contact"></div>
                <form method="post" action="{{ asset('assets/contact.php') }}" id="contactform" autocomplete="off">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Nama" id="name_contact" name="name_contact">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email_contact">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" style="height: 150px;" placeholder="Ketik pesan Anda di sini..." id="message_contact" name="message_contact"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn_1 gradient full-width" type="submit" value="Kirim" id="submit-contact">
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-6 add_bottom_25">
                <iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.459082445812!2d106.80392861465141!3d-6.5897188662501955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5f2b25cf481%3A0x18a4eabbf4da5231!2sKAMPUS%20IPB%20CILIBENDE%20BOGOR%20cb!5e0!3m2!1sid!2sid!4v1618025605759!5m2!1sid!2sid" allowfullscreen></iframe>
            </div>
        </div>
    </div>

</x-home-layout>
