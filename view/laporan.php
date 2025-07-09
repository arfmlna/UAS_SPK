<body class="bg-gray-100 p-6">
    <?php include './component/navigasi.php' ?>
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow-md mt-28">
        <h2 class="text-2xl font-bold mb-4 text-center">Laporan Nilai Mahasiswa</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Mata Kuliah</th>
                        <th class="px-4 py-2">Nilai Angka</th>
                        <th class="px-4 py-2">Nilai Mutu</th>
                        <th class="px-4 py-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    <?php
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

                    $result = mysqli_query($conn, "
                        SELECT m.nama, mk.nama_mk, n.nilai_angka
                        FROM nilai n
                        JOIN mahasiswa m ON n.id_mahasiswa = m.id
                        JOIN mata_kuliah mk ON n.id_mata_kuliah = mk.id
                        ORDER BY m.nama
                    ");
                    while ($row = mysqli_fetch_assoc($result)) {
                        list($mutu, $ket) = konversiNilai($row['nilai_angka']);
                        echo "<tr class='border-t border-gray-200 hover:bg-gray-100'>
                            <td class='px-4 py-2'>{$row['nama']}</td>
                            <td class='px-4 py-2'>{$row['nama_mk']}</td>
                            <td class='px-4 py-2'>{$row['nilai_angka']}</td>
                            <td class='px-4 py-2'>{$mutu}</td>
                            <td class='px-4 py-2'>{$ket}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
