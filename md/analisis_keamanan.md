# Analisis Keamanan Aplikasi Web "Jaga Mental"

## Daftar Mekanisme Keamanan yang SUDAH ADA

### Autentikasi & Otorisasi
- **Session Management**: Penggunaan session PHP untuk menyimpan status login (`$_SESSION['login'] = true`), user ID (`$_SESSION['user_id']`), dan username (`$_SESSION['username']`). Session diinisialisasi dengan konfigurasi cookie yang aman (httponly, samesite=Strict, secure=false untuk HTTP).
- **Session Regeneration**: Pada login berhasil, dilakukan `session_regenerate_id(true)` untuk mencegah session fixation attack.
- **Logout Mechanism**: Logout menghapus session (`session_unset()`, `session_destroy()`) dan menghapus cookie remember me jika ada.
- **Access Control**: Setiap halaman yang memerlukan login memeriksa `$_SESSION['login']` dan redirect ke login jika tidak ada. File `cek_login.php` digunakan untuk validasi session pada halaman tertentu.

### Keamanan Database
- **Prepared Statements**: Semua query database menggunakan prepared statements dengan `mysqli_prepare()` dan `bind_param()` untuk mencegah SQL Injection, seperti pada login, register, mood, dan self-care processing.
- **Input Validation**: Pada register, dilakukan validasi panjang password (minimal 8 karakter), komposisi (huruf besar, kecil, angka), dan konfirmasi password. Username dan email dicek keunikan sebelum insert.
- **Password Hashing**: Password di-hash menggunakan `password_hash(PASSWORD_DEFAULT)` pada register, dan diverifikasi dengan `password_verify()` pada login.

### Keamanan Form & Input User
- **CSRF Protection**: Setiap form login dan register menggunakan token CSRF yang di-generate dengan `bin2hex(random_bytes(32))` dan disimpan di session. Token divalidasi dengan `hash_equals()` pada processing.
- **Input Sanitization**: Username di-trim pada login dan register. Pada dashboard, username di-escape dengan `htmlspecialchars()` untuk mencegah XSS.
- **Brute Force Protection**: Pada login, ada counter `login_attempt` yang membatasi maksimal 5 percobaan, setelah itu blokir sementara.

### Session & Cookie Handling
- **Secure Cookie Settings**: Session cookie dikonfigurasi dengan `httponly=true`, `samesite=Strict`, dan `secure=false` (karena aplikasi berjalan di HTTP, bukan HTTPS).
- **Remember Me**: Ada checkbox "Ingat saya" pada form login, namun implementasi cookie remember me belum lengkap (hanya dihapus pada logout, tidak di-set pada login).

### Proteksi File & Folder
- **File Structure**: File konfigurasi database (`config/koneksi.php`) terpisah dari file utama. File processing (`proses/`) dan detail (`detail_menuutama/`) terorganisir dengan baik.
- **Access Restriction**: File processing seperti `login_process.php`, `mood_process.php`, dll., memeriksa session sebelum eksekusi. Export file (`export_excel.php`, `export_pdf.php`) juga memeriksa session.

### Error Handling & Informasi Sensitif
- **Error Messages**: Pesan error ditampilkan kepada user tanpa mengungkap detail teknis (misalnya "Kesalahan sistem (query gagal)" alih-alih error SQL spesifik).
- **No Sensitive Data Exposure**: Tidak ada informasi sensitif seperti password atau hash yang ditampilkan di UI.

### Risiko OWASP Top 10
- **A01:2021 - Broken Access Control**: Sudah ada kontrol akses dasar dengan session check.
- **A02:2021 - Cryptographic Failures**: Password di-hash dengan algoritma aman.
- **A03:2021 - Injection**: Menggunakan prepared statements untuk mencegah SQL Injection.
- **A04:2021 - Insecure Design**: Desain aplikasi sederhana, namun belum ada rate limiting global atau CAPTCHA.
- **A05:2021 - Security Misconfiguration**: Konfigurasi session cukup baik, namun `secure=false` karena HTTP.
- **A06:2021 - Vulnerable and Outdated Components**: Menggunakan library FPDF untuk PDF, namun versi tidak disebutkan (berpotensi outdated).
- **A07:2021 - Identification and Authentication Failures**: Ada brute force protection, namun tidak ada multi-factor authentication.
- **A08:2021 - Software and Data Integrity Failures**: Tidak ada validasi integritas data dari external sources.
- **A09:2021 - Security Logging and Monitoring Failures**: Tidak ada logging aktivitas user atau monitoring.
- **A10:2021 - Server-Side Request Forgery**: Tidak ada fitur yang mengakses external URLs dari server.

## Potensi Celah Keamanan (Tanpa mengubah kode)

### Autentikasi & Otorisasi
- **Session Fixation (Partial Mitigation)**: Meskipun ada `session_regenerate_id()`, namun pada login.php, session sudah dimulai sebelum login, sehingga attacker bisa set session ID sebelum user login. Dampak: Attacker bisa mengambil alih session user yang sudah login.
- **Remember Me Insecure**: Checkbox "Ingat saya" ada, namun tidak ada implementasi cookie remember me yang aman (misalnya token random yang di-hash). Dampak: Jika diimplementasikan nanti tanpa hashing, bisa bocor akun.

### Keamanan Database
- **Hardcoded Credentials**: File `config/koneksi.php` menggunakan kredensial database hardcoded (`$user = "root"; $pass = "";`). Dampak: Jika file ini bocor atau diakses unauthorized, database bisa diakses langsung.
- **No Database Encryption**: Tidak ada enkripsi data sensitif di database. Dampak: Jika database di-dump, data user (username, email, hash password) bisa dibaca.

### Keamanan Form & Input User
- **XSS via User Input**: Pada mood_process.php dan selfcare_process.php, input `catatan` disimpan langsung ke database tanpa sanitasi. Jika ditampilkan di UI tanpa escape, bisa menyebabkan XSS. Dampak: Attacker bisa inject script yang dieksekusi di browser user lain.
- **No Input Length Limits**: Tidak ada batas panjang input (misalnya catatan bisa sangat panjang). Dampak: Bisa menyebabkan denial of service atau buffer overflow jika tidak ditangani di database.
- **Email Validation Weak**: Pada register, email hanya dicek required, tidak divalidasi format. Dampak: User bisa daftar dengan email invalid, atau attacker inject email malicious.

### Session & Cookie Handling
- **Secure Flag Disabled**: Session cookie menggunakan `secure=false`, padahal aplikasi seharusnya menggunakan HTTPS. Dampak: Session bisa di-intercept via man-in-the-middle di jaringan tidak aman.
- **No Session Timeout**: Session tidak memiliki timeout otomatis. Dampak: Session tetap aktif selamanya jika user tidak logout, meningkatkan risiko jika device hilang.

### Proteksi File & Folder
- **No .htaccess Protection**: Tidak ada file .htaccess untuk mencegah akses langsung ke folder sensitif seperti `config/` atau `proses/`. Dampak: Attacker bisa akses file PHP langsung via URL.
- **File Upload Not Handled**: Tidak ada fitur upload file, namun jika ditambahkan nanti, bisa rentan file inclusion atau upload malicious.

### Error Handling & Informasi Sensitif
- **Error Disclosure**: Pada beberapa file, jika koneksi database gagal, error bisa bocor (meskipun ada handling dasar). Dampak: Attacker bisa tahu struktur aplikasi.
- **No Rate Limiting**: Tidak ada rate limiting pada API atau form submission. Dampak: Attacker bisa brute force atau spam request.

### Risiko OWASP Top 10
- **A01:2021 - Broken Access Control**: IDOR (Insecure Direct Object Reference) berpotensi jika user bisa akses data user lain via parameter (misalnya jika ada endpoint dengan user_id di URL). Dampak: User bisa baca data user lain.
- **A02:2021 - Cryptographic Failures**: Hash password menggunakan PASSWORD_DEFAULT (baik), namun jika algoritma diubah nanti, bisa bermasalah. Dampak: Password lama tidak bisa diverifikasi.
- **A03:2021 - Injection**: Meskipun prepared statements digunakan, namun jika ada query dinamis, bisa rentan. Dampak: SQL Injection jika ada celah.
- **A04:2021 - Insecure Design**: Tidak ada CAPTCHA atau reCAPTCHA pada login/register. Dampak: Mudah di-automatisasi untuk brute force.
- **A05:2021 - Security Misconfiguration**: Debug mode mungkin aktif (tidak terlihat), atau error reporting on. Dampak: Info sensitif bocor.
- **A06:2021 - Vulnerable and Outdated Components**: FPDF library mungkin outdated. Dampak: Jika ada vulnerability di FPDF, bisa dieksploitasi.
- **A07:2021 - Identification and Authentication Failures**: Tidak ada password reset mechanism. Dampak: User lupa password tidak bisa recover.
- **A08:2021 - Software and Data Integrity Failures**: Tidak ada checksum atau signature untuk file download (PDF/Excel). Dampak: File bisa dimodifikasi attacker.
- **A09:2021 - Security Logging and Monitoring Failures**: Tidak ada logging failed login atau aktivitas suspicious. Dampak: Sulit deteksi attack.
- **A10:2021 - Server-Side Request Forgery**: Jika nanti ada fitur fetch external URL, bisa rentan SSRF. Dampak: Attacker akses internal network.

## Solusi untuk Mengatasi Potensi Celah Keamanan

### Autentikasi & Otorisasi
- **Session Fixation (Partial Mitigation)**: Lakukan regenerasi session ID sebelum menyimpan data user ke session, bukan setelahnya. Pastikan session dimulai hanya setelah autentikasi berhasil.
- **Remember Me Insecure**: Implementasikan token remember me yang di-hash dan disimpan di database dengan expiry time, serta validasi token pada setiap akses.

### Keamanan Database
- **Hardcoded Credentials**: Gunakan environment variables atau file konfigurasi terpisah yang tidak di-commit ke version control untuk menyimpan kredensial database.
- **No Database Encryption**: Enkripsi data sensitif seperti password hash menggunakan algoritma enkripsi tambahan jika diperlukan, atau gunakan database yang mendukung enkripsi at-rest.

### Keamanan Form & Input User
- **XSS via User Input**: Sanitasi input menggunakan fungsi seperti htmlspecialchars() pada semua input sebelum disimpan atau ditampilkan. Validasi input dengan whitelist characters.
- **No Input Length Limits**: Tambahkan validasi panjang maksimal pada input fields di sisi server dan database schema.
- **Email Validation Weak**: Gunakan validasi format email dengan regex atau library validasi yang tepat.

### Session & Cookie Handling
- **Secure Flag Disabled**: Aktifkan flag secure pada cookie jika aplikasi menggunakan HTTPS. Pertimbangkan migrasi ke HTTPS.
- **No Session Timeout**: Implementasikan timeout session otomatis dengan memeriksa waktu aktivitas terakhir.

### Proteksi File & Folder
- **No .htaccess Protection**: Tambahkan file .htaccess untuk deny akses ke folder sensitif seperti config/ dan proses/.
- **File Upload Not Handled**: Jika ada fitur upload, validasi tipe file, ukuran, dan konten sebelum menyimpan.

### Error Handling & Informasi Sensitif
- **Error Disclosure**: Pastikan error messages tidak mengungkap detail teknis, dan log error ke file terpisah untuk debugging.
- **No Rate Limiting**: Implementasikan rate limiting menggunakan middleware atau library seperti throttle.

### Risiko OWASP Top 10
- **A01:2021 - Broken Access Control**: Pastikan semua akses data berdasarkan user ID yang valid dan tidak bisa dimanipulasi.
- **A02:2021 - Cryptographic Failures**: Gunakan algoritma hashing terbaru dan pertimbangkan enkripsi data.
- **A03:2021 - Injection**: Pastikan semua query menggunakan prepared statements dan hindari query dinamis.
- **A04:2021 - Insecure Design**: Tambahkan CAPTCHA pada form autentikasi dan rate limiting.
- **A05:2021 - Security Misconfiguration**: Nonaktifkan debug mode dan error reporting di production.
- **A06:2021 - Vulnerable and Outdated Components**: Update semua library ke versi terbaru dan lakukan audit keamanan.
- **A07:2021 - Identification and Authentication Failures**: Tambahkan multi-factor authentication dan password reset mechanism.
- **A08:2021 - Software and Data Integrity Failures**: Validasi integritas data dari external sources dengan checksum.
- **A09:2021 - Security Logging and Monitoring Failures**: Implementasikan logging untuk aktivitas suspicious dan monitoring real-time.
- **A10:2021 - Server-Side Request Forgery**: Validasi dan whitelist URL jika ada fitur fetch external.

## Kesimpulan Tingkat Keamanan Project

**Sedang**

Alasan: Project ini memiliki mekanisme keamanan dasar yang cukup baik, seperti prepared statements untuk mencegah SQL Injection, CSRF protection, password hashing, dan session management. Namun, ada beberapa celah signifikan seperti hardcoded credentials, potensi XSS, session fixation partial, dan kurangnya HTTPS/secure cookies, yang membuatnya rentan terhadap serangan umum. Untuk production, perlu perbaikan pada konfigurasi, input sanitization, dan penambahan fitur seperti rate limiting serta monitoring.
