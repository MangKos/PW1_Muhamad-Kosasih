<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jaga Mental | Aplikasi Kesehatan Mental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }

    .navbar {
      padding: 15px 0;
    }

    .hero {
      padding: 130px 20px;
      background: linear-gradient(135deg, #2563eb, #60a5fa);
      color: white;
    }

    .hero h1 {
      font-weight: 700;
      font-size: 3rem;
    }

    .hero p {
      max-width: 760px;
      margin: auto;
      font-size: 1.1rem;
    }

    section {
      padding: 90px 0;
    }

    .section-title {
      font-weight: 700;
      margin-bottom: 40px;
    }

    .card {
      border: none;
      border-radius: 16px;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-6px);
    }

    footer {
      background: #0f172a;
      color: #cbd5f5;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#beranda">
      <i class="bi bi-heart-pulse me-1"></i> Jaga Mental
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        <li class="nav-item ms-3">
          <a href="login.php" class="btn btn-primary px-4">Masuk</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- BERANDA -->
<section id="beranda" class="hero text-center">
  <div class="container">
    <h1 class="mb-4">Jaga Kesehatan Mental Anda</h1>
    <p class="mb-5">
      Jaga Mental adalah platform berbasis web yang bertujuan
      membantu pengguna memahami dan menjaga kesehatan mental
      melalui pendekatan edukatif dan terstruktur.
    </p>
    <a href="register.php" class="btn btn-light btn-lg px-5 fw-semibold">
      Mulai Sekarang
    </a>
  </div>
</section>

<!-- TENTANG -->
<section id="tentang">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4">
        <h2 class="section-title">Tentang Jaga Mental</h2>
        <p>
          Kesehatan mental merupakan aspek penting dalam kehidupan sehari-hari,
          terutama di tengah tuntutan akademik dan sosial yang semakin meningkat.
        </p>
        <p>
          Jaga Mental hadir sebagai aplikasi web yang menyediakan
          informasi dan sistem pendukung untuk membantu pengguna
          menjaga keseimbangan emosional secara mandiri.
        </p>

      </div>
      <div class="col-md-6 text-center">
        <i class="bi bi-emoji-smile-fill text-primary" style="font-size: 120px;"></i>
      </div>
    </div>
  </div>
</section>

<!-- ARTIKEL -->
<section id="artikel" class="bg-white py-5">
    <div class="container">
        <h2 class="text-center section-title mb-4">Artikel & Edukasi</h2>
        <p class="text-center text-muted mb-5">
            Kurasi artikel terpercaya seputar kesehatan mental dari sumber profesional.
        </p>

        <div class="row">

            <!-- Artikel 1 -->
            <div class="col-md-4 mb-4">
            <a href="detail_artikel/detail1.html?info=1"
              class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Apa Itu Kesehatan Mental?</h5>
                            <p class="card-text">
                                Penjelasan resmi dari WHO mengenai definisi,
                                faktor risiko, dan pentingnya kesehatan mental.
                            </p>
                            <span class="text-primary fw-semibold">
                                Baca sekarang →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 2 -->
            <div class="col-md-4 mb-4">
            <a href="detail_artikel/detail2.html"
  class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Mengelola Stres Sehari-hari</h5>
                            <p class="card-text">
                                Tips praktis dan ilmiah untuk mengelola stres
                                agar tidak berdampak pada kesehatan mental.
                            </p>
                            <span class="text-primary fw-semibold">
                                Baca sekarang →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 3 -->
            <div class="col-md-4 mb-4">
                <a href="detail_artikel/detail3.html"
                  class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pentingnya Self-Care</h5>
                            <p class="card-text">
                                Artikel jurnal ilmiah tentang peran self-care
                                dalam menjaga kesejahteraan mental individu.
                            </p>
                            <span class="text-primary fw-semibold">
                                Baca sekarang →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- KONTAK -->
<section id="kontak">
  <div class="container text-center">
    <h2 class="section-title">Kontak</h2>
    <p>Untuk informasi lebih lanjut, silakan hubungi:</p>
    <p class="fw-semibold">
      <i class="bi bi-envelope"></i> muhammadkosasih783@gmail.com <br>
      <i class="bi bi-person"></i> Muhamad
    </p>
  </div>
</section>

<!-- FOOTER -->
<footer class="text-center py-4">
  <small>©Copyright by 23552011450_MUHAMAD KOSASIH_TIF RP 23 CNS B_UASWEB1</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
