<body class="bg-gray-100 p-6">
<?php include './component/navigasi.php' ?>
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-28">
    <h2 class="text-xl font-bold mb-4">Filter Nilai Mahasiswa</h2>
    <form method="get" class="mb-4">
        <input type="hidden" name="page" value="filter">
        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama" class="border p-2 w-full" placeholder="Contoh: Arif Maulana" required>
        <button type="submit" class="mt-2 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Cari</button>
    </form>

    <?php
    if (!empty($_GET['nama'])) {
        $nama = $_GET['nama'];
        $query = mysqli_query($conn, "
            SELECT m.nama, mk.nama_mk, n.nilai_angka
            FROM nilai n
            JOIN mahasiswa m ON n.id_mahasiswa = m.id
            JOIN mata_kuliah mk ON n.id_mata_kuliah = mk.id
            WHERE m.nama LIKE '%$nama%'
        ");

        if (mysqli_num_rows($query) > 0) {
            echo "<div class='overflow-x-auto'><table class='min-w-full border mt-4'>";
            echo "<thead class='bg-blue-500 text-white'><tr><th>Nama</th><th>Mata Kuliah</th><th>Nilai</th><th>Mutu</th><th>Keterangan</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($query)) {
                list($mutu, $ket) = konversiNilai($row['nilai_angka']);
                echo "<tr class='border-b'><td>{$row['nama']}</td><td>{$row['nama_mk']}</td><td>{$row['nilai_angka']}</td><td>$mutu</td><td>$ket</td></tr>";
            }
            echo "</tbody></table></div>";
            echo "<a href='index.php?page=export&nama=" . urlencode($nama) . "' class='block mt-4 text-center bg-green-600 text-white py-2 rounded hover:bg-green-700'>
                Export PDF
            </a>";
        } else {
            echo "<p class='text-red-500 mt-4'>Data tidak ditemukan.</p>";
        }
    }

    function konversiNilai($nilai) {
        if ($nilai >= 85) return ['A', 'Sangat Memuaskan'];
        elseif ($nilai >= 80) return ['A-', 'Memuaskan'];
        elseif ($nilai >= 75) return ['B+', 'Sangat Baik'];
        elseif ($nilai >= 70) return ['B', 'Baik'];
        elseif ($nilai >= 65) return ['B-', 'Cukup Baik'];
        elseif ($nilai >= 60) return ['C+', 'Sangat Cukup'];
        elseif ($nilai >= 55) return ['C', 'Cukup'];
        elseif ($nilai >= 50) return ['C-', 'Sedang'];
        elseif ($nilai >= 40) return ['D', 'Kurang'];
        else return ['E', 'Sangat Kurang'];
    }
    ?>
</div>

</body>
