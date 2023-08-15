<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
<script>
    // sweet alert
    // mario anjeliko
    @if (session('error'))
        Swal.fire(
            'Ups !',
            '{{ session('error') }}',
            'error'
        )
    @elseif (session('success'))
        Swal.fire(
            'Success',
            '{{ session('success') }}',
            'success'
        )
    @enderror

    function logout() {
        Swal.fire({
            title: "Yakin ingin Logout?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout !',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url: '{{ route('logout') }}',
                    method: "POST",
                    data: '_token={{ csrf_token() }}',
                    success: function(data) {
                        window.location.href = '{{ route('login') }}';
                    },
                    error: function() {
                        window.location.href = '{{ route('login') }}';
                    }
                });

            }
        })
    }

    function form_delete(target) {
        Swal.fire({
            title: "Yakin ingin menghapus data?",
            text: "Mohon perhatikan data yang dipilih!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: target,
                    method: "DELETE",
                    data: '_token={{ csrf_token() }}',
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire({
                            type: 'error',
                            title: 'Whoops!',
                            text: 'Terjadi kesalahan.'
                        })
                    }
                });
            }
        })
    }

    $(".select-2").select2({
            theme: "bootstrap-5",
            placeholder: 'Pilih..'
    })


</script>
