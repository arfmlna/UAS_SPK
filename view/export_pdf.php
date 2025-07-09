<body class="p-6 bg-gray-100">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Laporan Nilai Mahasiswa</h1>
        <button id="btn-export" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Download PDF</button>
    </div>

    <?php
    $nama = $_GET['nama'] ?? '';

    echo "<div id='print-area'>";
    echo "<h2 class='text-lg font-semibold mb-2'>Nama Mahasiswa: $nama</h2>";
    echo "<table class='w-full table-auto border border-collapse border-gray-300'>";
    echo "<thead class='bg-blue-600 text-white'>
            <tr>
                <th class='border px-3 py-2'>Mata Kuliah</th>
                <th class='border px-3 py-2'>Nilai</th>
                <th class='border px-3 py-2'>Mutu</th>
                <th class='border px-3 py-2'>Keterangan</th>
            </tr>
          </thead><tbody>";

    $query = mysqli_query($conn, "
        SELECT mk.nama_mk, n.nilai_angka FROM nilai n
        JOIN mahasiswa m ON n.id_mahasiswa = m.id
        JOIN mata_kuliah mk ON n.id_mata_kuliah = mk.id
        WHERE m.nama LIKE '%$nama%'
    ");

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

    while ($row = mysqli_fetch_assoc($query)) {
        list($mutu, $ket) = konversiNilai($row['nilai_angka']);
        echo "<tr class='border'>
                <td class='border px-3 py-1'>{$row['nama_mk']}</td>
                <td class='border px-3 py-1'>{$row['nilai_angka']}</td>
                <td class='border px-3 py-1'>$mutu</td>
                <td class='border px-3 py-1'>$ket</td>
              </tr>";
    }

    echo "</tbody></table>";
    echo "</div>";
    ?>
</div>

<script>
document.getElementById('btn-export').addEventListener('click', function () {
    const element = document.getElementById('print-area');
    html2pdf().from(element).set({
        margin: 1,
        filename: 'laporan_<?= urlencode($nama) ?>.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { orientation: 'portrait' }
    }).save();
});
</script>

</body>