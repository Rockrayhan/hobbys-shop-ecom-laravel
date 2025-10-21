<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> Hobby's Shop - Admin </title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('backend/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["/backend/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />


    <style>
        .body-content {
            margin-top: 100px;
            /* margin-left: 50px; */
        }
    </style>

</head>

<body>
    <div class="wrapper">

        {{--  Sidebar  --}}
        @include('backend.includes.sidebar')


        <div class="main-panel">

            {{-- ========  header ========== --}}
            @include('backend.includes.header')


            {{-- ========  content ========== --}}
            <div class="h-100 body-content px-5 ">
                <div class="pb-5">
                    @yield('content')
                </div>
            </div>


            {{-- =========  footer ========= --}}
            @include('backend.includes.footer')


        </div>
    </div>
    <!-- Core JS Files -->
    <script src="{{ asset('/backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>



    <!-- Datatables -->
    {{-- <script src="{{ asset('backend/assets/js/plugin/datatables/datatables.min.js') }}"></script> --}}

    <!-- Sweet Alert -->
    <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>



    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/zu7ey1ky86td80nvbsd6smu0wwwj1g7mn0xca8ugraat9wdw/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: '.getTinyMce',
            plugins: 'code lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist',
            height: 300
        });

        function syncTinyMCEContent() {
            tinymce.triggerSave(); // Synchronize TinyMCE content with the original <textarea>
        }
    </script>

    <!-- Sweet alert js -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({
                    title: "✅ Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    button: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                swal({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    button: "OK"
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let messages = `{!! implode('\n', $errors->all()) !!}`;
                swal({
                    title: "Validation Error!",
                    text: messages,
                    icon: "warning",
                    button: "OK"
                });
            });
        </script>
    @endif



    {{-- highlight item js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const highlightRow = document.getElementById('highlight-row');
            if (highlightRow) {
                // Scroll to the row
                highlightRow.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Remove highlight after 3 seconds
                setTimeout(() => {
                    highlightRow.classList.remove('table-success');
                }, 3000);
            }
        });
    </script>




    {{--  delete-confirm.js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all delete forms (those with class "delete-form")
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                const btn = form.querySelector('.delete-btn');
                if (!btn) return;

                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, this record cannot be recovered!",
                        icon: "warning",
                        buttons: ["Cancel", "Yes, delete it!"],
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal({
                                title: "Cancelled",
                                text: "Your data is safe.",
                                icon: "info",
                                timer: 1500,
                                buttons: false
                            });
                        }
                    });
                });
            });
        });
    </script>








</body>

</html>
