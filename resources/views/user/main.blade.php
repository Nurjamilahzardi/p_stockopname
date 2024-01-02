<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title class="hide-on-print">STOK OPNAME</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ url('css/swap.css') }}" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <!-- <link href="fontawesome/css/all.min.css" rel="stylesheet"> -->
    <link href="{{ url('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ url('/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ url('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{url ('css/style.css')}}" rel="stylesheet">
    <style>
    /* CSS untuk tampilan cetakan */
    @media print {
        /* Menyembunyikan elemen-elemen yang tidak perlu dicetak */
        .hide-on-print {
            display: none;
        }
    }
    </style>
</head>
<body>
    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary hide-on-print">
                        <p class="fs-5">
                        <img src="/img/logo1.png" style="width: 35px; height: 35px;" class="me-2" alt="Logo">STOCK OPNAME</p></i></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <i class="fa fa-user fs-4 ms-2"></i>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->role }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">  
                    @if(Auth::check() && Auth::user()->role == 'user')
                        <a href="/dashboard" class="nav-link @yield('Dashboard')"><i class="fa fa-tachometer-alt me-2 mb-2"></i>Dashboard</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-5 text-secondary mt-2" href="#" id="transaksiDropdown" data-bs-toggle="dropdown" aria-expanded="true">
                                Data Transaksi
                            </a>
                            <div class="dropdown-menu bg-transparent show border-0 " aria-labelledby="transaksiDropdown">
                                <a href="/beranda" class="dropdown-item nav-link @yield('Transaksi')"><i class="fa fa-credit-card-alt me-2"></i>Transaksi</a>
                            </div>
                        </li>
                        <div class="nav-item dropdown">
                            <a href="#" id="dataMasterDropdown" class="nav-link dropdown-toggle fs-5 text-secondary mt-2" data-bs-toggle="dropdown" aria-expanded="true">Data Master</a>
                            <div class="dropdown-menu bg-transparent show border-0 ">
                                <a href="/barang" class="dropdown-item nav-link @yield('Barang') "><i class="fa fa-database me-2"></i>Data Barang</a>
                                @if(Auth::user()->unit != '13000')
                                <a href="/barang-unit" class="dropdown-item nav-link @yield('BarangUnit') "><i class="fa fa-table me-2" aria-hidden="true"></i>Data Barang Unit</a>
                                @endif
                                @if(Auth::user()->unit == '13000')
                                <div class="nav-item dropdown">
                                    <a href="#" id="dataUPDropdown" class="nav-link dropdown-toggle fs-6 text-black" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-building me-2"></i>Data UP</a>
                                        <div class="dropdown-menu ms-4 bg-transparent border-0">
                                            <a href="{{url('/up-informasi')}}" class="dropdown-item nav-link @yield('UP')">Informasi</a>
                                            <a class="dropdown-item nav-link @yield('UP3PADANG')" href="{{ route('up3padang') }}">UP3 Padang</a>
                                            <a class="dropdown-item nav-link @yield('UP3BUKITTINGGI')" href="{{ route('up3bukittinggi') }}">UP3 Bukittinggi</a>
                                            <a class="dropdown-item nav-link @yield('UP3SOLOK')" href="{{ route('up3solok') }}">UP3 Solok</a>
                                            <a class="dropdown-item nav-link @yield('UP3PAYAKUMBUH')" href="{{ route('up3payakumbuh') }}">UP3 Payakumbuh</a>
                                            <a class="dropdown-item nav-link @yield('UP2D')" href="{{ route('up2d') }}">UP2D</a>
                                        </div>
                                </div>
                                @endif
                                <a href="/ulp" class="dropdown-item nav-link @yield('ULP')"><i class="fa fa-building-shield me-2"></i>Data ULP</a>
                            </div>
                        </div>
                    @endif
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0  hide-on-print" style="width: 100%; height: 60px;">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="fs-7 fw-bold ms-4">{{Auth::user()->up->up_nama}}</div>
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    @yield('container')
                </div>
            </div>
            <!-- Widgets End -->
            
        </div>
        <!-- Content End -->
    </div>
 
    <!-- JavaScript Libraries -->
    <script src="{{ url('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('lib/chart/chart.min.js')}}"></script>
    <script src="{{ url('lib/easing/easing.min.js')}}"></script>
    <script src="{{ url('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ url('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ url('lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ url('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ url('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{ url('js/popper.min.js') }} "></script>
    <script src="{{ url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/copy.js')}}"></script>
    <script src="{{url('js/pdf.js')}}"></script>
    <script src="{{url('js/excel.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>


    <!-- Template Javascript -->
    <!-- Template Javascript -->
    <script src="{{ url('js/main.js')}}"></script>
   
    <script>
       $(document).ready(function () {
        var uniqueOptions = {}; // Objek untuk melacak opsi unik

        // Mendengarkan perubahan pada input pencarian
        // $('#searchInput').on('keyup', function () {
        //     var keyword = $(this).val();
        //     console.log('okok');
        //     // Hapus opsi sebelumnya
        //    // $('#searchResults').empty();
        //    $('#searchResults').append('<option value="ndak bapitih"></option>');
        //     // Kirim permintaan AJAX ke controller autocomplete
        //     if (keyword.length > 0) {
                
        //     }
            
        // });
        $.ajax({
                    url: '{{ route("transaksi.autocomplete") }}', // Sesuaikan dengan route Anda
                    method: 'POST', // Sesuaikan dengan metode yang Anda gunakan di controller
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        // Tampilkan hasil autocomplete
                        data.forEach(function (item) {
                            // Periksa apakah opsi sudah ditambahkan
                            if (!uniqueOptions[item.barang_nama]) {
                                $('#searchResults').append('<option value="' + item.barang_nama + '"></option>');
                                uniqueOptions[item.barang_nama] = true; // Tandai opsi sebagai sudah ditambahkan
                            }
                            console.log(item);
                        });
                       
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });

        // Menangani pemilihan item autocomplete
        $('#searchResults').on('click', 'option', function () {
            var selectedValue = $(this).val();
            $('#searchInput').val(selectedValue);
            $('#searchResults').empty(); // Hapus pilihan setelah memilih
        });

        
    });
    </script>

    <script>
        $(document).ready(function () {
            $('#searchButton').on('click', function (e) {
                e.preventDefault();
                var keyword = $('#searchInput').val();

                $.ajax({
                    url: '{{ route("transaksi.inputPost") }}',
                    method: 'POST',
                    data: {
                        _token : "{{ csrf_token() }}",
                        cari: keyword },
                    success: function (data) {
                        console.log(data);
                        // Replace the content of the table with the search results
                        $('#tampilBarang').append(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                    
                });
            });
            // Fungsi untuk menghapus baris
            function deleteRow(button) {
                // Dapatkan referensi ke baris yang akan dihapus (elemen <tr>)
                var row = button.closest('tr');

                // Hapus baris dari tabel
                row.remove();
            }

            // Menambahkan event handler untuk tombol "Hapus" dalam tabel
            $('#tampilBarang').on('click', 'button.btn-danger', function () {
                deleteRow(this);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#searchButtonKeluar').on('click', function (e) {
                e.preventDefault();
                var keyword = $('#searchInput').val();

                $.ajax({
                    url: '{{ route("transaksi.keluarPost") }}',
                    method: 'POST',
                    data: {
                        _token : "{{ csrf_token() }}",
                        cari: keyword },
                    success: function (data) {
                        console.log(data);
                        // Replace the content of the table with the search results
                        $('#tampilBarangKeluar').append(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                    
                });
            });
            // Fungsi untuk menghapus baris
            function deleteRow(button) {
                // Dapatkan referensi ke baris yang akan dihapus (elemen <tr>)
                var row = button.closest('tr');

                // Hapus baris dari tabel
                row.remove();
            }

            // Menambahkan event handler untuk tombol "Hapus" dalam tabel
            $('#tampilBarangKeluar').on('click', 'button.btn-danger', function () {
                deleteRow(this);
            });
            // Fungsi untuk membatasi input jumlah berdasarkan stok
            $('#tampilBarangKeluar').on('input', 'input[name="barang_quantity[]"]', function () {
                var input = $(this);
                var stock = parseFloat(input.closest('tr').find('.tdStock').text());
                var quantity = parseFloat(input.val());

                if (quantity > stock) {
                    input.val(stock); // Set nilai input menjadi stok maksimal jika melebihi stok
                }
            });
        });
    </script>
    <script>
    $(document).ready(function(){
        // Aktifkan semua komponen Bootstrap yang memerlukannya
        $('.dropdown-toggle').dropdown();
    });
    </script>
    <script>
        const table = document.getElementById('tabelTransaksi');
        const rows = table.getElementsByTagName('tr');
        const numRowsToShow = 5;
        let currentIndex = 0;
    
        function showRows(startIndex) {
            for (let i = 0; i < rows.length; i++) {
                if (i >= startIndex && i < startIndex + numRowsToShow) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    
        function showNext() {
            currentIndex += numRowsToShow;
    
            if (currentIndex >= rows.length) {
                currentIndex = rows.length - numRowsToShow;
            }
    
            showRows(currentIndex);
        }
    
        function showPrevious() {
            currentIndex -= numRowsToShow;
    
            if (currentIndex < 0) {
                currentIndex = 0;
            }
    
            showRows(currentIndex);
        }
    
        // Tampilkan baris pertama saat halaman dimuat
        showRows(currentIndex);
    </script>    
    <script>
        var currentRow = 0;
    
        function showNextRows() {
            var rows = document.getElementsByClassName("data-row");
            var totalRows = rows.length;
    
            // Sembunyikan semua baris
            for (var i = 0; i < totalRows; i++) {
                rows[i].style.display = "none";
            }
    
            // Tampilkan 5 baris berikutnya
            for (var i = currentRow; i < currentRow + 5 && i < totalRows; i++) {
                rows[i].style.display = "";
            }
    
            currentRow += 5;
    
            // Tampilkan tombol "Previous"
            document.querySelectorAll("button")[0].style.display = "";
    
            if (currentRow >= totalRows) {
                // Sembunyikan tombol "Next" jika tidak ada baris lagi
                document.querySelectorAll("button")[1].style.display = "none";
            }
        }
    
        function showPreviousRows() {
            currentRow -= 5;
    
            if (currentRow < 0) {
                currentRow = 0;
            }
    
            var rows = document.getElementsByClassName("data-row");
            var totalRows = rows.length;
    
            // Sembunyikan semua baris
            for (var i = 0; i < totalRows; i++) {
                rows[i].style.display = "none";
            }
    
            // Tampilkan 5 baris sebelumnya
            for (var i = currentRow; i < currentRow + 5 && i < totalRows; i++) {
                rows[i].style.display = "";
            }
    
            // Tampilkan tombol "Next"
            document.querySelectorAll("button")[1].style.display = "";
    
            if (currentRow === 0) {
                // Sembunyikan tombol "Previous" jika sudah di baris pertama
                document.querySelectorAll("button")[0].style.display = "none";
            }
        }
    </script>
    
    
</body> 
</html>