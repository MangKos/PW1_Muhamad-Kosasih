<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// data artikel
$artikels = [
    ["kategori" => "Mental Health", "judul" => "Mental Health", "deskripsi" => "Tips menjaga kesehatan mental sehari-hari."],
    ["kategori" => "Self Care", "judul" => "Self Care", "deskripsi" => "Cara sederhana untuk merawat diri sendiri."],
    ["kategori" => "Psikologi", "judul" => "Psikologi", "deskripsi" => "Manfaat konsultasi dengan psikolog profesional."],
    ["kategori" => "Tidur", "judul" => "Tidur", "deskripsi" => "Tips tidur cukup untuk kesehatan mental dan fisik."],
    ["kategori" => "Stres", "judul" => "Stres", "deskripsi" => "Cara mengelola stres dalam kehidupan sehari-hari."],
    ["kategori" => "Emosi", "judul" => "Emosi", "deskripsi" => "Tips mengenali dan mengatur emosi dengan baik."]
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        .profile-nav {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
        }

        .profile-nav img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #e5e7eb;
        }

        .profile-nav span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .card-feature {
            border: none;
            border-radius: 18px;
            background: #ffffff;
            transition: all .25s ease;
        }

        .card-feature:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.08);
        }

        .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .bg-mood {
            background: #2563eb;
        }

        .bg-care {
            background: #16a34a;
        }

        .bg-report {
            background: #f59e0b;
        }

        .article-card {
            border-radius: 16px;
            background: #ffffff;
            overflow: hidden;
            transition: all .25s ease;
        }

        .article-card img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        }

        .article-card .badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .filter-btn {
            border: 1.5px solid #2563eb;
            background: #ffffff;
            color: #2563eb;
            padding: 6px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            border-radius: 999px;
            transition: all 0.2s ease;
        }

        .filter-btn:hover {
            background: #2563eb;
            color: #ffffff;
        }

        .filter-btn.active {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.25);
        }

        footer {
            color: #64748b;
            font-size: 0.85rem;
        }
    </style>

</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand fw-bold text-primary"><i class="bi bi-heart-pulse"></i> Jaga Mental</span>
            <a href="profil.php" class="profile-nav">
                <img src="assets/img/yess sir.jpg" alt="Profil">
                <span><?= htmlspecialchars($_SESSION['username']) ?></span>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <h4 class="fw-bold mb-1">Halo, <?= htmlspecialchars($_SESSION['username']) ?></h4>
        <p class="text-muted mb-4">Bagaimana perasaanmu hari ini?</p>

        <!-- FITUR UTAMA -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <a href="detail_menuutama/mood.php" class="text-decoration-none text-dark">
                    <div class="card card-feature p-4">
                        <div class="icon-box bg-mood mb-3"><i class="bi bi-emoji-smile"></i></div>
                        <h5 class="fw-semibold">Mood Tracker</h5>
                        <p class="text-muted small">Catat suasana hatimu setiap hari.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="detail_menuutama/selfcare.php" class="text-decoration-none text-dark">
                    <div class="card card-feature p-4">
                        <div class="icon-box bg-care mb-3"><i class="bi bi-heart"></i></div>
                        <h5 class="fw-semibold">Self Care</h5>
                        <p class="text-muted small">Tips menjaga kesehatan mental.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="detail_menuutama/laporan.php" class="text-decoration-none text-dark">
                    <div class="card card-feature p-4">
                        <div class="icon-box bg-report mb-3"><i class="bi bi-file-earmark-text"></i></div>
                        <h5 class="fw-semibold">Laporan</h5>
                        <p class="text-muted small">Riwayat dan evaluasi mood.</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- JUDUL ARTIKEL -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-bold">Artikel & Edukasi</h5>
            <span class="text-muted small">6 artikel</span>
        </div>

        <!-- FILTER BUTTON -->
        <div class="mb-4 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-primary btn-sm filter-btn active" data-filter="Semua">Semua</button>
            <?php foreach (array_unique(array_column($artikels, 'kategori')) as $k): ?>
                <button class="btn btn-outline-primary btn-sm filter-btn" data-filter="<?= $k ?>"><?= $k ?></button>
            <?php endforeach; ?>
        </div>

        <!-- ARTIKEL -->
        <div class="row g-4">
            <!-- Artikel 1: Mental Health -->
            <div class="col-md-4 artikel-item" data-kategori="Mental Health">
                <a href="detail_artikel/artikel1.php" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel1.jpg" alt="Mental Health">
                        <div class="card-body">
                            <span class="badge bg-primary">Mental Health</span>
                            <h6 class="fw-semibold mt-2">Mental Health</h6>
                            <p class="text-muted small">
                                Tips menjaga kesehatan mental sehari-hari.
                            </p>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Artikel 2: Self Care -->
            <div class="col-md-4 artikel-item" data-kategori="Self Care">
                <a href="detail_artikel/artikel2.php" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel2.jpg" alt="Self Care">
                        <div class="card-body">
                            <span class="badge bg-primary">Self Care</span>
                            <h6 class="fw-semibold mt-2">Self Care</h6>
                            <p class="text-muted small">Cara sederhana untuk merawat diri sendiri.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 3: Psikologi -->
            <div class="col-md-4 artikel-item" data-kategori="Psikologi">
                <a href="detail_artikel/artikel3.php" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel3.jpg" alt="Psikologi">
                        <div class="card-body">
                            <span class="badge bg-primary">Psikologi</span>
                            <h6 class="fw-semibold mt-2">Psikologi</h6>
                            <p class="text-muted small">Manfaat konsultasi dengan psikolog profesional.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 4: Tidur -->
            <div class="col-md-4 artikel-item" data-kategori="Tidur">
                <a href="detail_artikel/artikel4.php?id=4" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel4.jpg" alt="Tidur">
                        <div class="card-body">
                            <span class="badge bg-primary">Tidur</span>
                            <h6 class="fw-semibold mt-2">Tidur</h6>
                            <p class="text-muted small">Tips tidur cukup untuk kesehatan mental dan fisik.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 5: Stres -->
            <div class="col-md-4 artikel-item" data-kategori="Stres">
                <a href="detail_artikel/artikel5.php?id=5" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel5.jpg" alt="Stres">
                        <div class="card-body">
                            <span class="badge bg-primary">Stres</span>
                            <h6 class="fw-semibold mt-2">Stres</h6>
                            <p class="text-muted small">Cara mengelola stres dalam kehidupan sehari-hari.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Artikel 6: Emosi -->
            <div class="col-md-4 artikel-item" data-kategori="Emosi">
                <a href="detail_artikel/artikel6.php?id=6" class="text-decoration-none text-dark">
                    <div class="card article-card shadow-sm border-0">
                        <img src="assets/img/artikel6.jpg" alt="Emosi">
                        <div class="card-body">
                            <span class="badge bg-primary">Emosi</span>
                            <h6 class="fw-semibold mt-2">Emosi</h6>
                            <p class="text-muted small">Tips mengenali dan mengatur emosi dengan baik.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <footer class="text-center py-4">
            <small>© Muhamad Kosasih</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;

                document.querySelectorAll('.artikel-item').forEach(item => {
                    if (filter === 'Semua' || item.dataset.kategori === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>