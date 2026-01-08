<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/fpdf/fpdf.php';

if (!isset($_SESSION['login'])) {
    exit('Akses ditolak');
}

$user_id = $_SESSION['user_id'];

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

// JUDUL
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN KESEHATAN MENTAL',0,1,'C');
$pdf->Ln(4);

// TANGGAL CETAK
$pdf->SetFont('Arial','I',9);
$pdf->Cell(0,6,'Tanggal cetak: '.date('d-m-Y'),0,1,'R');
$pdf->Ln(4);

// HEADER TABEL
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,8,'Tanggal',1);
$pdf->Cell(30,8,'Mood',1);
$pdf->Cell(40,8,'Self Care',1);
$pdf->Ln();

// DATA
$pdf->SetFont('Arial','',10);

$query = $koneksi->prepare("
    SELECT 
        m.tanggal,
        m.mood,
        (s.fisik + s.emosional + s.mental + s.sosial + s.istirahat)/5 AS selfcare
    FROM mood m
    LEFT JOIN self_care s 
        ON m.tanggal = s.tanggal 
        AND m.user_id = s.user_id
    WHERE m.user_id = ?
    ORDER BY m.tanggal ASC
");

$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $selfcare = $row['selfcare'] !== null ? round($row['selfcare'],2) : '-';

    $pdf->Cell(45,8,$row['tanggal'],1);
    $pdf->Cell(30,8,$row['mood'],1);
    $pdf->Cell(40,8,$selfcare,1);
    $pdf->Ln();
}

/*
 D = FORCE DOWNLOAD
 I = PREVIEW
*/
$pdf->Output('D', 'laporan_kesehatan_mental.pdf');
exit;
