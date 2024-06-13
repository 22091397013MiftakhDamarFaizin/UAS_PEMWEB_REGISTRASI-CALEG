<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: red;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            color: #fff;
            padding: 20px;
        }

        .sidebar img {
            height: 100px;
            width: 160px;
            top: 20px;
            left: 20px;
            display: block;
            margin: 0 auto 20px;
        }

        .sidebar h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #de0a26;
        }

        .sidebar form button {
            color: #fff;
            background: none;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            text-align: left;
        }

        .sidebar form button:hover {
            background-color: #de0a26;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 35px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .submit-btn {
            display: inline-block;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #de0a26;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="{{ asset('image/logo_kpu-copy.jpg') }}" alt="Logo KPU">
    <div class="menu">
        <a href="{{ route('beranda-parpol') }}">Upload Berkas</a>
        <a href="{{ route('daftar-caleg-registrasi') }}">Daftar Caleg Sudah Upload Berkas</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="content">
    <div class="navbar">
        <h4>Upload Berkas</h4>
        <div class="user-info">
            <span style="font-weight: bold; margin-right: 10px">{{ Auth::user()->username }}</span>
            <img src="{{ asset('image/user.svg') }}">
        </div>
    </div>

    <div class="form-container">
        <form action="{{ url('/candidates') }}" method="POST" enctype="multipart/form-data" id="upload-form">
            @csrf
            <div class="form-group">
                <label for="username">Nama Calon Legislatif</label>
                <input type="text" id="username" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="posisi">Posisi Jabatan</label>
                <select class="form-select" name="position" id="posisi">
                    <option selected>Pilih...</option>
                    <option value="DPR">DPR</option>
                    <option value="DPD">DPD</option>
                    <option value="DPRD I">DPRD I</option>
                    <option value="DPRD II">DPRD II</option>
                </select>
            </div>
            <div class="form-group">
                <label for="formulir">Formulir Pendaftaran</label>
                <input type="file" class="form-control" id="formulir" name="formulir">
            </div>
            <div class="form-group">
                <label for="ktp">KTP</label>
                <input type="file" class="form-control" id="ktp" name="ktp">
            </div>
            <div class="form-group">
                <label for="ijazah">Ijazah</label>
                <input type="file" class="form-control" id="ijazah" name="ijazah">
            </div>
            <div class="form-group">
                <label for="surat-pernyataan">Surat Pernyataan</label>
                <input type="file" class="form-control" id="surat-pernyataan" name="surat_pernyataan">
            </div>
            <div class="form-group">
                <label for="surat-bebas-narkoba">Surat Bebas Narkoba</label>
                <input type="file" class="form-control" id="surat-bebas-narkoba" name="surat_bebas_narkoba">
            </div>
            <button type="submit" class="submit-btn">KIRIM</button>
        </form>
    </div>

    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Gagal mengunggah berkas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Gagal mengunggah berkas! Setiap partai hanya bisa mengusung maksimal 5 calon legislatif.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</script>
<!-- di beranda-parpol.blade.php -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var userCalegCount = {{ $userCalegCount }};
        
        // Fungsi untuk menampilkan modal alert
        function showAlertModal(message) {
            var alertModal = new bootstrap.Modal(document.getElementById('alertModal'), {
                keyboard: false
            });
            document.querySelector('#alertModal .modal-body').textContent = message;
            alertModal.show();
        }

        // Validasi form sebelum submit
        document.getElementById('upload-form').addEventListener('submit', function (event) {
            var name = document.getElementById('username').value;
            var position = document.getElementById('posisi').value;
            var formulir = document.getElementById('formulir').value;
            var ktp = document.getElementById('ktp').value;
            var ijazah = document.getElementById('ijazah').value;
            var suratPernyataan = document.getElementById('surat-pernyataan').value;
            var suratBebasNarkoba = document.getElementById('surat-bebas-narkoba').value;

            if (!name || !position || !formulir || !ktp || !ijazah || !suratPernyataan || !suratBebasNarkoba) {
                event.preventDefault();
                showAlertModal('Pastikan semua data terisi!');
            } else if (userCalegCount >= 5) {
                event.preventDefault();
                showAlertModal('Setiap partai hanya bisa mengusung maksimal 5 calon legislatif');
            }
        });
    });
</script>

</body>
</html>
