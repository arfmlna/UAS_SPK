<body class="bg-gray-100 p-6">
    <?php include './component/navigasi.php' ?>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-28">
        <h2 class="text-xl font-bold mb-4 text-center">Form Input Nilai Mahasiswa</h2>
        
        <form method="post" class="space-y-4">
            <div>
                <label class="block mb-1">Nama Mahasiswa</label>
                <input type="text" name="nama" required class="w-full border border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block mb-1">Mata Kuliah</label>
                <input type="text" name="mata_kuliah" required class="w-full border border-gray-300 rounded p-2">
            </div>
            <div>
                <label class="block mb-1">Nilai Angka</label>
                <input type="number" name="nilai_angka" min="0" max="100" required class="w-full border border-gray-300 rounded p-2">
            </div>
            <button type="submit" name="simpan" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Simpan</button>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = $_POST['nama'];
            $mk = $_POST['mata_kuliah'];
            $nilai = $_POST['nilai_angka'];

            mysqli_query($conn, "INSERT IGNORE INTO mahasiswa(nama) VALUES('$nama')");
            mysqli_query($conn, "INSERT IGNORE INTO mata_kuliah(nama_mk) VALUES('$mk')");

            $idmhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM mahasiswa WHERE nama='$nama'"))['id'];
            $idmk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM mata_kuliah WHERE nama_mk='$mk'"))['id'];

            mysqli_query($conn, "INSERT INTO nilai(id_mahasiswa, id_mata_kuliah, nilai_angka) VALUES($idmhs, $idmk, $nilai)");

            echo "<div class='mt-4 p-3 bg-green-100 text-green-800 rounded'>Data berhasil disimpan!</div>";
        }
        ?>
    </div>
</body>
