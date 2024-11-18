<script src="{{ asset('assets/js/single_files/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/common_scripts.min.js') }}"></script>
<script src="{{ asset('assets/js/common_func.js') }}"></script>
<script src="{{ asset('assets/validate.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const logoDefault = document.getElementById('logoDefault');
    const logoScrolled = document.getElementById('logoScrolled');

    window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
    logoDefault.classList.add('d-none');
    logoDefault.classList.remove('d-block');
    logoScrolled.classList.add('d-block');
    logoScrolled.classList.remove('d-none');
    } else {
    logoDefault.classList.add('d-block');
    logoDefault.classList.remove('d-none');
    logoScrolled.classList.add('d-none');
    logoScrolled.classList.remove('d-block');
    }
    });
    });
</script>
