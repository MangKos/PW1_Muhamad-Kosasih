# Laporan Analisis Implementasi ISMS pada Aplikasi Web "Jaga Mental"

## Abstrak

Aplikasi web "Jaga Mental" merupakan platform kesehatan mental berbasis PHP yang dirancang untuk membantu pengguna dalam mengelola kesehatan mental melalui fitur seperti meditasi, konsultasi, laporan mood, dan self-care. Proyek ini dikembangkan sebagai bagian dari tugas akhir mata kuliah Pemrograman Web 1 (PW1), dengan fokus pada implementasi sistem informasi yang aman dan user-friendly. Latar belakang proyek ini muncul dari meningkatnya kesadaran akan kesehatan mental di era digital, di mana aplikasi web dapat menjadi alat pencegahan dan pengelolaan stres serta gangguan mental.

Tujuan utama penerapan Information Security Management System (ISMS) dalam proyek ini adalah untuk mengidentifikasi, menganalisis, dan meningkatkan mekanisme keamanan informasi guna melindungi data pengguna dari ancaman keamanan umum seperti SQL injection, XSS, dan session hijacking. ISMS diterapkan melalui pendekatan analisis statis terhadap kode sumber, evaluasi risiko berdasarkan OWASP Top 10, dan penilaian tingkat keamanan secara keseluruhan.

Metode utama yang digunakan meliputi tinjauan mendalam terhadap mekanisme keamanan yang sudah ada (seperti prepared statements, password hashing, dan CSRF protection) serta identifikasi potensi celah keamanan tanpa melakukan perubahan kode. Analisis ini dilakukan berdasarkan file dokumentasi keamanan yang tersedia, dengan fokus pada aspek autentikasi, otorisasi, keamanan database, dan penanganan input pengguna.

Hasil utama menunjukkan bahwa aplikasi memiliki tingkat keamanan sedang, dengan mekanisme dasar yang cukup baik namun masih memiliki area yang perlu diperbaiki terkait konfigurasi dan penanganan input. Kesimpulan singkat adalah bahwa meskipun aplikasi siap untuk penggunaan dasar, diperlukan perbaikan konfigurasi dan penambahan fitur keamanan untuk mencapai standar ISMS yang lebih tinggi, guna memastikan perlindungan data pengguna secara optimal.

(198 kata)

## Daftar Isi

1. **BAB I – PENDAHULUAN**  
   1.1 Latar belakang  
   1.2 Tujuan Pembuatan ISMS  
   1.3 Metodologi Umum Penerapan ISMI  
   1.4 Keterbatasan Studi (cangkupan pengerjaan sampai tanggal berapa)  

2. **BAB II – PENETAPAN RUANG LINGKUP ISMS**  
   2.1 Deskripsi Proyek Sistem  
   2.2 Cangkupan ISMS  
   2.3 Identifikasi Pihak Terkait (Stakeholders)  

3. **BAB III – IDENTIFIKASI DAN KLASIFIKASI ASET**  
   3.1 Identifikasi Aset  
   3.2 Klasifikasi Aset Berdasarkan CIA  
   3.3 Nilai Kepentingan Aset  

4. **BAB IV – ANALISIS RISIKO KEAMANAN INFORMASI**  
   4.1 Identifikasi Ancaman  
   4.2 Identifikasi Kerentanan  
   4.3 Analisis Dampak resiko  
   4.4 Penilaian Level Risiko  
   • Low  
   • Medium  
   • High

5. **BAB V – PEMETAAN KONTROL ISO/IEC 27001:2022 (ANNEX A)**  
   5.1 Pendekatan Pemilihan Kontrol  
   5.2 Daftar Kontrol yang Digunakan  
   5.3 Alasan Pemilihan Kontrol

## Lampiran

### Lampiran A: Struktur Aplikasi "Jaga Mental"

- **Frontend**: Halaman HTML dengan Bootstrap untuk UI responsif.
- **Backend**: Skrip PHP untuk logika bisnis dan interaksi database.
- **Database**: MySQL untuk penyimpanan data pengguna dan aplikasi.
- **Library Eksternal**: Bootstrap (CSS/JS), FPDF (untuk export PDF).

### Lampiran B: Kode Contoh Mekanisme Keamanan

**Contoh Prepared Statement (login_process.php)**:
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
```

**Contoh CSRF Protection (login.php)**:
```php
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
```

## Daftar Pustaka

1. ISO/IEC 27001:2022. *Information security, cybersecurity and privacy protection — Information security management systems — Requirements*. International Organization for Standardization, Geneva, 2022.

2. OWASP Foundation. *OWASP Top 10:2021*. Diakses dari https://owasp.org/www-project-top-ten/, 2021.

3. NIST. *NIST Special Publication 800-53 Rev. 5: Security and Privacy Controls for Information Systems and Organizations*. National Institute of Standards and Technology, Gaithersburg, MD, 2020.

4. Stallings, William. *Cryptography and Network Security: Principles and Practice*. Pearson, 7th Edition, 2017.

5. Howard, Michael dan LeBlanc, David. *Writing Secure Code*. Microsoft Press, 2nd Edition, 2003.

## BAB I – PENDAHULUAN

### 1.1 Latar Belakang

Aplikasi web "Jaga Mental" adalah sistem informasi kesehatan mental yang dikembangkan menggunakan bahasa pemrograman PHP dengan database MySQL. Aplikasi ini menyediakan fitur-fitur seperti login dan registrasi pengguna, dashboard interaktif, meditasi terpandu, pencatatan mood harian, self-care tips, konsultasi virtual, serta laporan ekspor dalam format PDF dan Excel. Proyek ini muncul sebagai respons terhadap tantangan kesehatan mental di masyarakat modern, di mana teknologi digital dapat berperan sebagai solusi aksesibel untuk pencegahan dan pengelolaan gangguan mental seperti stres, kecemasan, dan depresi.

Risiko keamanan seperti kebocoran data atau serangan siber dapat berdampak serius pada privasi pengguna dan kepercayaan terhadap platform. Oleh karena itu, penerapan Information Security Management System (ISMS) menjadi krusial untuk memastikan bahwa aplikasi tidak hanya berfungsi dengan baik secara teknis, tetapi juga aman dari ancaman keamanan umum. Analisis ini dilakukan tanpa melakukan perubahan kode, fokus pada evaluasi mekanisme keamanan yang sudah ada dan identifikasi potensi risiko berdasarkan standar keamanan informasi umum.

### 1.2 Tujuan Pembuatan ISMS

Tujuan utama pembuatan ISMS dalam aplikasi "Jaga Mental" adalah untuk membangun kerangka kerja yang sistematis dalam mengelola risiko keamanan informasi, sehingga data pengguna terlindungi dari ancaman seperti injeksi SQL, cross-site scripting (XSS), dan session hijacking. Secara spesifik, ISMS bertujuan untuk:

- Mengidentifikasi mekanisme keamanan yang sudah diimplementasikan, seperti penggunaan prepared statements, password hashing, dan CSRF protection.
- Menganalisis potensi celah keamanan yang dapat dieksploitasi, termasuk konfigurasi database yang tidak optimal dan mekanisme pembatasan akses yang perlu diperbaiki.
- Mengevaluasi tingkat keamanan keseluruhan aplikasi berdasarkan standar internasional, dengan fokus pada peningkatan kepercayaan pengguna dan kepatuhan terhadap regulasi privasi data.
- Memberikan rekomendasi perbaikan tanpa mengubah kode, sebagai dasar untuk pengembangan lebih lanjut menuju standar ISO 27001.

Dengan ISMS ini, aplikasi diharapkan dapat mencapai tingkat keamanan yang lebih tinggi, mengurangi risiko insiden keamanan, dan mendukung tujuan utama proyek yaitu promosi kesehatan mental yang aman dan terpercaya.

### 1.3 Metodologi Umum Penerapan ISMS

Metodologi penerapan ISMS dalam analisis ini mengikuti pendekatan analisis statis dan evaluasi risiko berdasarkan kerangka kerja standar. Langkah-langkah utama meliputi:

1. **Pengumpulan Informasi**: Tinjauan terhadap kode sumber aplikasi, file konfigurasi, dan dokumentasi keamanan yang tersedia (seperti file analisis_keamanan.md).
2. **Identifikasi Mekanisme Keamanan**: Evaluasi fitur keamanan yang sudah ada, termasuk autentikasi, otorisasi, keamanan database, dan penanganan input pengguna.
3. **Analisis Risiko**: Penilaian potensi celah keamanan berdasarkan OWASP Top 10, dengan fokus pada risiko seperti SQL injection, XSS, dan session fixation.
4. **Penilaian Tingkat Keamanan**: Klasifikasi tingkat keamanan aplikasi (rendah, sedang, tinggi) berdasarkan kekuatan mekanisme yang ada versus potensi risiko.
5. **Rekomendasi Perbaikan**: Penyusunan solusi untuk mengatasi celah yang teridentifikasi, tanpa melakukan implementasi kode.

Metodologi ini bersifat deskriptif dan non-invasif, mengandalkan tinjauan dokumentasi dan kode tanpa eksekusi atau pengujian dinamis, untuk memastikan analisis tetap obyektif dan tidak mengubah integritas aplikasi.

### 1.4 Keterbatasan Studi (cangkupan pengerjaan sampai tanggal berapa)

Studi ini terbatas pada analisis keamanan aplikasi "Jaga Mental" berdasarkan kode sumber dan dokumentasi yang tersedia per tanggal 15 Oktober 2023. Analisis dilakukan tanpa melakukan perubahan kode, pengujian dinamis, atau akses ke environment produksi, sehingga fokus utama adalah pada aspek teoritis dan statis. Cakupan terbatas pada fitur utama aplikasi (login, dashboard, meditasi, mood tracking, self-care, konsultasi, dan laporan), serta mekanisme keamanan yang sudah diimplementasikan. Studi tidak mencakup pengujian performa, audit eksternal, atau evaluasi terhadap komponen pihak ketiga seperti library FPDF. Rekomendasi yang diberikan bersifat umum dan memerlukan validasi lebih lanjut melalui pengujian praktis untuk implementasi di lingkungan nyata.

## BAB II – PENETAPAN RUANG LINGKUP ISMS

### 2.1 Deskripsi Proyek Sistem

Aplikasi "Jaga Mental" merupakan sistem web yang dikembangkan menggunakan bahasa pemrograman PHP dengan database MySQL. Sistem ini dirancang sebagai platform kesehatan mental yang dapat diakses melalui browser web, dengan arsitektur client-server sederhana. Pada sisi frontend, aplikasi menggunakan framework Bootstrap untuk antarmuka pengguna yang responsif, sementara sisi backend menangani logika bisnis, autentikasi pengguna, dan interaksi dengan database.

Gambaran arsitektur sistem meliputi:
- **Layer Presentasi**: Halaman web HTML dengan styling Bootstrap dan JavaScript untuk interaktivitas dasar.
- **Layer Aplikasi**: Skrip PHP yang menangani request pengguna, validasi input, dan pemrosesan data.
- **Layer Data**: Database MySQL untuk penyimpanan data pengguna, mood tracking, dan catatan self-care.

Sistem ini beroperasi pada environment lokal menggunakan server Apache (melalui Laragon) dan tidak terintegrasi dengan layanan eksternal atau API pihak ketiga, kecuali untuk library frontend seperti Bootstrap dan ikon Bootstrap Icons yang dimuat dari CDN.

### 2.2 Cakupan ISMS

Cakupan ISMS dalam analisis ini mencakup seluruh komponen aplikasi web "Jaga Mental", termasuk:
- **Aplikasi web**: Semua halaman PHP dan file terkait (login, dashboard, mood tracking, self-care, meditasi, konsultasi, laporan).
- **Data pengguna**: Informasi sensitif seperti username, email, password hash, catatan mood, dan data self-care yang disimpan dalam database.
- **Jaringan**: Komunikasi antara browser pengguna dan server lokal melalui protokol HTTP (tanpa HTTPS dalam environment pengembangan).

Batasan sistem meliputi:
- **Lingkungan deployment**: Terbatas pada environment pengembangan lokal (localhost) menggunakan Laragon, tidak mencakup deployment ke server produksi atau cloud.
- **Fitur eksternal**: Tidak mencakup integrasi dengan layanan pihak ketiga seperti email service atau payment gateway.
- **Komponen tambahan**: Library FPDF untuk export PDF dan komponen Excel export tidak termasuk dalam analisis mendalam ISMS.

Batasan organisasi terdiri dari:
- **Pengguna**: Mahasiswa dan dosen dalam konteks akademik sebagai pengguna utama.
- **Pengembang**: Developer tunggal (penulis laporan) yang bertanggung jawab atas implementasi dan analisis keamanan.
- **Institusi**: Politeknik Negeri Jember sebagai entitas pendidikan yang membatasi akses dan penggunaan aplikasi.

### 2.3 Identifikasi Pihak Terkait (Stakeholders)

Pihak terkait yang teridentifikasi dalam penerapan ISMS untuk aplikasi "Jaga Mental" meliputi:

- **Pengguna Akhir**: Individu yang menggunakan aplikasi untuk mengelola kesehatan mental, termasuk mahasiswa, dosen, dan masyarakat umum. Mereka memiliki kepentingan dalam privasi data dan keamanan informasi pribadi.
- **Pengembang Sistem**: Penulis laporan sebagai developer yang bertanggung jawab atas implementasi fitur dan mekanisme keamanan awal.
- **Dosen Pembimbing**: Sebagai supervisor akademik yang memastikan kepatuhan terhadap standar keamanan informasi dalam konteks pendidikan.
- **Administrator Sistem**: Dalam konteks ini, pengembang juga berperan sebagai administrator yang mengelola konfigurasi database dan environment pengembangan.
- **Institusi Pendidikan**: Politeknik Negeri Jember sebagai pemilik proyek yang memiliki kepentingan dalam keamanan data mahasiswa dan kepatuhan terhadap regulasi akademik.

## BAB III – IDENTIFIKASI DAN KLASIFIKASI ASET

### 3.1 Identifikasi Aset

Berdasarkan analisis terhadap aplikasi "Jaga Mental", aset yang teridentifikasi dalam sistem meliputi:

- **Data Pengguna**: Informasi sensitif yang disimpan dalam database MySQL, termasuk username, email, password hash, catatan mood harian, dan data self-care. Data ini merupakan aset utama yang memerlukan perlindungan tinggi karena berkaitan langsung dengan privasi pengguna kesehatan mental.
- **Sistem Aplikasi**: Kode sumber PHP yang terdiri dari halaman-halaman web (index.php, dashboard.php, login.php, dll.), file konfigurasi (config/koneksi.php), dan skrip pemrosesan (proses/*.php). Sistem ini mencakup logika bisnis, autentikasi, dan interaksi database.
- **Infrastruktur Jaringan**: Environment pengembangan lokal menggunakan Laragon (Apache server) dan database MySQL, termasuk koneksi HTTP antara browser pengguna dan server lokal.
- **Akun dan Hak Akses**: Akun pengguna yang terdaftar dalam sistem dengan hak akses berbeda (pengguna biasa vs administrator), serta session management untuk kontrol akses.

### 3.2 Klasifikasi Aset Berdasarkan CIA

Klasifikasi aset dilakukan berdasarkan prinsip CIA (Confidentiality, Integrity, Availability) dengan tingkatan Tinggi (T), Sedang (S), dan Rendah (R):

- **Data Pengguna**:
  - Confidentiality: Tinggi (T) - Data pribadi seperti email dan catatan kesehatan mental harus dijaga kerahasiaannya.
  - Integrity: Tinggi (T) - Catatan mood dan self-care harus akurat dan tidak dapat dimodifikasi oleh pihak tidak berwenang.
  - Availability: Sedang (S) - Sistem harus tersedia untuk pengguna, namun downtime sementara dapat ditoleransi dalam konteks akademik.

- **Sistem Aplikasi**:
  - Confidentiality: Sedang (S) - Kode sumber dapat diakses oleh pengembang, namun tidak boleh bocor ke publik.
  - Integrity: Tinggi (T) - Kode aplikasi harus tetap utuh untuk mencegah manipulasi fungsi keamanan.
  - Availability: Tinggi (T) - Aplikasi harus dapat diakses oleh pengguna kapan saja dalam environment pengembangan.

- **Infrastruktur Jaringan**:
  - Confidentiality: Rendah (R) - Dalam environment lokal, risiko kebocoran jaringan minimal.
  - Integrity: Sedang (S) - Konfigurasi server harus stabil untuk menjaga integritas sistem.
  - Availability: Sedang (S) - Server lokal harus berjalan selama jam pengembangan.

- **Akun dan Hak Akses**:
  - Confidentiality: Tinggi (T) - Password hash dan hak akses harus dijaga kerahasiaannya.
  - Integrity: Tinggi (T) - Hak akses pengguna harus akurat dan tidak dapat diubah tanpa otorisasi.
  - Availability: Sedang (S) - Sistem login harus tersedia untuk autentikasi pengguna.

### 3.3 Nilai Kepentingan Aset

Penilaian nilai kepentingan aset dilakukan berdasarkan dampak bisnis jika aset tersebut hilang atau terganggu, dengan skala Tinggi (T), Sedang (S), Rendah (R):

- **Data Pengguna**: Tinggi (T) - Kebocoran data dapat menyebabkan masalah privasi serius dan kehilangan kepercayaan pengguna, serta potensi pelanggaran regulasi privasi data.
- **Sistem Aplikasi**: Tinggi (T) - Kerusakan pada kode sumber dapat menghentikan fungsi aplikasi dan memerlukan waktu pengembangan ulang.
- **Infrastruktur Jaringan**: Sedang (S) - Dalam konteks pengembangan lokal, gangguan jaringan berdampak terbatas namun dapat mengganggu proses testing dan development.
- **Akun dan Hak Akses**: Tinggi (T) - Kompromi pada sistem autentikasi dapat membuka akses tidak sah ke seluruh sistem dan data pengguna.

## BAB IV – ANALISIS RISIKO KEAMANAN INFORMASI

### 4.1 Identifikasi Ancaman

Berdasarkan analisis terhadap aplikasi "Jaga Mental" dan referensi OWASP Top 10, ancaman keamanan yang teridentifikasi meliputi:

- **SQL Injection**: Ancaman injeksi kode SQL melalui input pengguna yang tidak tervalidasi dengan baik, yang dapat mengakibatkan akses tidak sah ke database.
- **Cross-Site Scripting (XSS)**: Ancaman injeksi skrip berbahaya melalui input pengguna yang ditampilkan tanpa sanitasi, berpotensi mencuri session atau data pengguna.
- **Broken Authentication**: Ancaman eksploitasi mekanisme autentikasi yang lemah, seperti session fixation atau brute force attack pada password.
- **Sensitive Data Exposure**: Ancaman kebocoran data sensitif seperti password hash atau informasi pribadi pengguna akibat penyimpanan yang tidak aman.
- **Broken Access Control**: Ancaman akses tidak sah ke fitur atau data yang seharusnya terbatas, seperti akses ke akun pengguna lain.
- **Security Misconfiguration**: Ancaman dari konfigurasi server atau aplikasi yang tidak aman, termasuk kredensial database yang hardcoded.
- **Insufficient Logging & Monitoring**: Ancaman yang sulit dideteksi karena kurangnya logging aktivitas pengguna dan monitoring keamanan.

### 4.2 Identifikasi Kerentanan

Kerentanan yang teridentifikasi dalam sistem berdasarkan tinjauan kode dan konfigurasi meliputi:

- **Konfigurasi Database yang Tidak Optimal**: Pengaturan koneksi database memerlukan peningkatan untuk mencegah akses tidak sah.
- **Potensi Injeksi Skrip pada Input Pengguna**: Input untuk pencatatan mood dan self-care perlu sanitasi yang lebih ketat untuk mencegah eksekusi skrip berbahaya.
- **Komunikasi Jaringan yang Tidak Aman**: Penggunaan protokol komunikasi yang tidak terenkripsi meningkatkan risiko intersepsi data.
- **Kurangnya Pembatasan Akses**: Mekanisme pencegahan percobaan login berulang perlu diperbaiki untuk menghindari serangan brute force.
- **Manajemen Sesi yang Perlu Diperbaiki**: Mekanisme session memerlukan evaluasi lebih lanjut untuk mencegah eksploitasi.
- **Validasi Input yang Terbatas**: Beberapa form input memerlukan validasi yang lebih komprehensif untuk menangani berbagai jenis input berbahaya.

### 4.3 Analisis Dampak Risiko

Analisis dampak risiko dilakukan berdasarkan potensi kerugian jika ancaman berhasil dieksploitasi:

- **Dampak pada Data Pengguna**: Kebocoran data pribadi dapat menyebabkan trauma psikologis tambahan bagi pengguna kesehatan mental, serta risiko hukum bagi pengembang.
- **Dampak pada Sistem Aplikasi**: Kompromi kode dapat menghentikan layanan, memerlukan downtime untuk perbaikan dan berpotensi kehilangan kepercayaan pengguna.
- **Dampak pada Infrastruktur**: Gangguan server lokal dapat mengganggu proses development dan testing, meskipun dampak terbatas dalam konteks akademik.
- **Dampak pada Akun dan Hak Akses**: Akses tidak sah dapat mengubah data pengguna atau meniru identitas, berdampak serius pada privasi dan integritas informasi.

### 4.4 Penilaian Level Risiko

Penilaian level risiko dilakukan dengan mengkombinasikan kemungkinan terjadinya ancaman dan tingkat dampaknya, diklasifikasikan sebagai Low, Medium, atau High:

- **Low**: Risiko dengan kemungkinan rendah dan dampak minimal, seperti kerentanan pada infrastruktur lokal yang jarang dieksploitasi.
- **Medium**: Risiko dengan kemungkinan sedang dan dampak signifikan, seperti potensi XSS pada input catatan yang dapat mempengaruhi beberapa pengguna.
- **High**: Risiko dengan kemungkinan tinggi dan dampak serius, seperti SQL injection yang dapat mengakibatkan kebocoran seluruh database pengguna, atau broken authentication yang membuka akses ke seluruh sistem.

## BAB V – PEMETAAN KONTROL ISO/IEC 27001:2022 (ANNEX A)

### 5.1 Pendekatan Pemilihan Kontrol

Pendekatan pemilihan kontrol dalam pemetaan ini didasarkan pada analisis risiko yang telah dilakukan pada BAB IV, di mana kontrol-kontrol dari Annex A ISO/IEC 27001:2022 dipilih berdasarkan relevansinya terhadap ancaman dan kerentanan yang teridentifikasi. Pemilihan dilakukan dengan mempertimbangkan prinsip CIA (Confidentiality, Integrity, Availability) serta kebutuhan spesifik aplikasi kesehatan mental yang menangani data sensitif pengguna.

### 5.2 Daftar Kontrol yang Digunakan

Berdasarkan analisis risiko, kontrol-kontrol berikut dari Annex A ISO/IEC 27001:2022 dipilih untuk diterapkan:

- **Access Control**: Kontrol akses untuk memastikan hanya pengguna yang berwenang dapat mengakses data dan fitur aplikasi.
- **Cryptography**: Penggunaan enkripsi untuk melindungi data sensitif seperti password hash dan komunikasi jaringan.
- **Network Security**: Pengamanan jaringan untuk mencegah akses tidak sah dan intersepsi data.
- **Incident Management**: Mekanisme penanganan insiden keamanan untuk respons cepat terhadap ancaman.
- **Data Protection**: Perlindungan data pengguna melalui validasi input, sanitasi, dan penyimpanan yang aman.

### 5.3 Alasan Pemilihan Kontrol

Kontrol-kontrol ini dipilih karena langsung mengatasi ancaman utama yang teridentifikasi seperti SQL injection, XSS, dan kebocoran data. Access Control dan Cryptography penting untuk melindungi data pengguna kesehatan mental yang sensitif, sementara Network Security dan Incident Management memastikan keamanan infrastruktur dan respons terhadap serangan. Data Protection menjadi fondasi untuk mencegah eksploitasi melalui input pengguna yang tidak aman.
