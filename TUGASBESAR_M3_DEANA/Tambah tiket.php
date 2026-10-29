<?php
include 'koneksi.php';

$id = "";
$nama_pembeli = "";
$tipe_tiket = "";
$harga = "";
$kuota = "";
$benefit = "";
$fasilitas_selected = array();

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);$query = "SELECT * FROM `daftar tiket` WHERE id = '$id'";
    $result = mysqli_query($koneksi,$query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {$nama_pembeli = isset($data['Nama Pembeli']) ?$data['Nama Pembeli'] : '';
        $tipe_tiket   =$data['Tipe Tiket'];
        $harga        =$data['Harga'];
        $kuota        =$data['Kuota'];
        $benefit      =$data['Benefit'];
        $fasilitas_selected = explode(', ',$benefit);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = mysqli_real_escape_string($koneksi, $_POST['nama_pembeli']);$tipe_tiket   = mysqli_real_escape_string($koneksi,$_POST['kategori']);
    $harga        = mysqli_real_escape_string($koneksi, $_POST['harga']);$kuota        = mysqli_real_escape_string($koneksi,$_POST['kuota']);

    if (isset($_POST['fasilitas']) && is_array($_POST['fasilitas'])) {$benefit = mysqli_real_escape_string($koneksi, implode(', ',$_POST['fasilitas']));
    } else {
        $benefit = "-";
    }

    if (!empty($id)) {
        $sql = "UPDATE `daftar tiket` SET 
                `Nama Pembeli`='$nama_pembeli',
                `Tipe Tiket`='$tipe_tiket', 
                `Harga`='$harga', 
                `Kuota`='$kuota', 
                `Benefit`='$benefit' 
                WHERE id='$id'";

        if (mysqli_query($koneksi,$sql)) {
            header("Location: Pengelolaan jenis tiket.php");
            exit();
        } else {
            $error = "Gagal memperbarui data tiket!";
        }
    } else {
        $sql = "INSERT INTO `daftar tiket` (`Nama Pembeli`, `Tipe Tiket`, `Harga`, `Kuota`, `Benefit`) 
                VALUES ('$nama_pembeli', '$tipe_tiket', '$harga', '$kuota', '$benefit')";

        if (mysqli_query($koneksi,$sql)) {
            header("Location: Pengelolaan jenis tiket.php");
            exit();
        } else {
            $error = "Gagal menambahkan tiket baru!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($id) ? 'Edit' : 'Tambah'; ?> Tiket - Modul C</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="font-family: 'Times New Roman', Times, serif; background-color: #eaf6ff; padding: 40px;">

    <div class="form-container">
        <h2><?= !empty($id) ? 'Edit Tipe Tiket' : 'Tambah Tipe Tiket'; ?></h2>
        
        <?php if (isset($error)): ?>
            <p style="color: red; text-align: center; margin-bottom: 15px;"><?= $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="nama_pembeli">Nama Pemesan / Pembeli</label>
            <input 
                type="text" 
                id="nama_pembeli" 
                name="nama_pembeli"
                placeholder="Contoh: Dea"
                value="<?= htmlspecialchars($nama_pembeli); ?>"
                required
            >

            <div class="form-group">
                <label for="kategori">Kategori Tiket</label>
                <select id="kategori" name="kategori" required>
                    <option value="" disabled <?= empty($tipe_tiket) ? 'selected' : ''; ?> hidden>Pilih Kategori Tiket</option>
                    <option value="Regular" <?= $tipe_tiket == 'Regular' ? 'selected' : ''; ?>>Regular</option>
                    <option value="Early Bird" <?= $tipe_tiket == 'Early Bird' ? 'selected' : ''; ?>>Early Bird</option>
                    <option value="VIP" <?= $tipe_tiket == 'VIP' ? 'selected' : ''; ?>>VIP</option>
                </select>
            </div>

            <label for="harga">Harga Tiket</label>
            <input 
                type="number" 
                id="harga" 
                name="harga"
                placeholder="Contoh: 150000"
                value="<?= htmlspecialchars($harga); ?>"
                required
            >

            <label for="kuota">Kuota Tiket</label>
            <input 
                type="number" 
                id="kuota" 
                name="kuota"
                placeholder="Contoh: 100"
                value="<?= htmlspecialchars($kuota); ?>"
                required
            >

            <div class="checkbox-group">
                <label class="group-title">Fasilitas / Benefit Included:</label>
                
                <label class="checkbox-item" for="benefit1">
                    <input type="checkbox" id="benefit1" name="fasilitas[]" value="E-Certificate" <?= in_array('E-Certificate', $fasilitas_selected) ? 'checked' : ''; ?>>
                    <span>E-Certificate Resmi</span>
                </label>

                <label class="checkbox-item" for="benefit2">
                    <input type="checkbox" id="benefit2" name="fasilitas[]" value="Akses Materi" <?= in_array('Akses Materi', $fasilitas_selected) ? 'checked' : ''; ?>>
                    <span>Akses Modul & Slide Materi</span>
                </label>

                <label class="checkbox-item" for="benefit3">
                    <input type="checkbox" id="benefit3" name="fasilitas[]" value="Lunch & Coffee Break" <?= in_array('Lunch & Coffee Break', $fasilitas_selected) ? 'checked' : ''; ?>>
                    <span>Lunch & Coffee Break</span>
                </label>

                <label class="checkbox-item" for="benefit4">
                    <input type="checkbox" id="benefit4" name="fasilitas[]" value="Merchandise Kit" <?= in_array('Merchandise Kit', $fasilitas_selected) ? 'checked' : ''; ?>>
                    <span>Merchandise / Seminar Kit</span>
                </label>

                <label class="checkbox-item" for="benefit5">
                    <input type="checkbox" id="benefit5" name="fasilitas[]" value="Front Row Seat" <?= in_array('Front Row Seat', $fasilitas_selected) ? 'checked' : ''; ?>>
                    <span>Duduk Barisan Depan (VIP)</span>
                </label>
            </div>

            <button type="submit"><?= !empty($id) ? 'Perbarui Tiket' : 'Simpan Tiket'; ?></button>
            <a href="Pengelolaan jenis tiket.php" class="btn-back">Kembali ke Daftar Tiket</a>
        </form>
    </div>

</body>
</html>