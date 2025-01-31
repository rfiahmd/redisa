 {{-- alert toast success --}}
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}", "Success", {
                positionClass: "toast-top-right",
                timeOut: 5000,
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                preventDuplicates: true,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: false,
            });
        });
    </script>
@endif

{{-- alertntoast errors --}}
@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.error("{{ session('error') }}", "Error", {
                positionClass: "toast-top-right",
                timeOut: 5000,
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                preventDuplicates: true,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: false,
            });
        });
    </script>
@endif
 
 {{-- SweetAlert untuk login sukses --}}
 @if (session('login_success'))
   <script>
     document.addEventListener('DOMContentLoaded', function() {
       Swal.fire({
         title: "Good job!",
         text: "{{ session('login_success') }}",
         icon: "success",
       });
     });
   </script>
 @endif


 {{-- sweet alert untuk login error --}}
 @if ($errors->any())
   <script>
     document.addEventListener('DOMContentLoaded', function() {
       Swal.fire({
         type: 'error',
         icon: 'error',
         title: 'Oops...',
         html: `
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                `,
       });
     });
   </script>
 @endif
