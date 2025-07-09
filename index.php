<?php 
    session_start();
    include './method/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS SPK</title>
    <?php include './method/head.php'  ?>
    </head>
    <?php
        if (!isset($_SESSION['sudah_redirect'])) {
            $_SESSION['sudah_redirect'] = true;
            header("location: index.php?page=home");
            exit;
        }
        $page = $_GET['page'] ?? 'form';
        switch ($page) {
            case 'home':
                include 'view/landingPage.php';
                break;
            case 'inputNilai':
                include 'view/input_nilai.php';
                break;
            case 'laporan':
                include 'view/laporan.php';
                break;
            case 'filter':
                include 'view/filter.php';
                break;
            case 'export':
                include 'view/export_pdf.php';
                break;
            default:
                include 'view/notfound.php';
        }
    ?>
</html>