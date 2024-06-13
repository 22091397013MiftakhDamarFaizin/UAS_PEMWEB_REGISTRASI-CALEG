<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Login Caleg</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: red;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    img {
      height: 60px;
      width: 90px;
      position: absolute;
      top: 20px;
      left: 20px;
    }
    
    .container {
      margin-top: 50px;
    }

    .card {
      max-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      background-color: white;
      border-radius: 15px;
      padding: 15px 100px; /* Mengurangi padding horizontal */
    }

    .card-body {
      text-align: center;
      margin-bottom: 20px;
    }

    .card-role {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      gap: 15px; 
    }

    .input {
      display: flex;
      gap: 20px;
      flex-direction: column;
      text-align: left;
      font-size: small;
    }

    .input p {
      margin: 5px 0;
    }

    select:focus {
      outline: none;
    }

    input:focus {
      outline: none;
    }

    .username, .password {
      display: flex;
      flex-direction: column;
      gap: 0px;
    }

    .username > select, .password > input {
      padding: 5px 10px; /* Atur padding untuk placeholder */
      border-radius: 3px;
      border: solid 1px #a9a9a9;
    }

    .btn-submit {
      display: block;
      width: 100%;
      margin-top: 25px;
      padding: 10px 0;
      background-color: red;
      color: white;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: darkred;
    }

    .alert {
      margin-top: 20px;
      padding: 12px;
      border-radius: 5px;
      font-size: 12px;
    }

    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
      display: none;
    }

    .alert-danger {
      background-color: #f8d7da;
      border-color: #f5c6cb;
      color: #721c24;
    }
  </style>
</head>
<body>
  <img src="{{ asset('image/logo_kpu.jpg') }}" alt="Logo KPU">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2>Login Partai Politik</h2>
            <label>Silahkan Masuk Ke Akun Anda</label> 
            <form action="{{ route('login.process') }}" method="POST">
              @csrf
              <div class="card-role">
                <div class="input">
                  <div class="username">
                    <p>Partai</p>
                    <select name="username">
                      <option selected value="">Pilih Partai</option>
                      <option value="PDI PERJUANGAN">PDI PERJUANGAN</option>
                      <option value="GERINDRA">GERINDRA</option>
                      <option value="PAN">PAN</option>
                      <option value="PKB">PKB</option>
                      <option value="GOLKAR">GOLKAR</option>
                      <option value="NASDEM">NASDEM</option>
                      <option value="PSI">PSI</option>
                      <!-- Tambahkan opsi manual sesuai dengan kebutuhan -->
                    </select>
                  </div>
                  <div class="password">
                    <p>Password</p>
                    <input type="password" name="password" autocomplete="new-password">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn-submit">Login</button>
            </form>
            <!-- Alert untuk pesan login berhasil/gagal -->
            @if(session('status'))
              <div class="alert {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}" role="alert">
                {{ session('message') }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
