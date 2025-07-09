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