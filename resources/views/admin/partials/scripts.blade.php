<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/admin_layout/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin_layout/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('sweetAlert'))
        const alertData = @json(session('sweetAlert'));
        Swal.fire({
            icon: alertData.status, // 'success' or 'error'
            title: alertData.status === 'success' ? 'Success!' : 'Error!',
            text: alertData.message,
            confirmButtonText: 'OK',
        });
    @endif
</script>

<!-- Core plugin JavaScript -->
<script src="{{ asset('assets/admin_layout/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugin JavaScript -->
<script src="{{ asset('assets/admin_layout/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/admin_layout/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Custom scripts for all pages -->
<script src="{{ asset('assets/admin_layout/js/admin.js') }}"></script>
