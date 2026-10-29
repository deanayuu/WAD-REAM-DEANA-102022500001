<?php
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = trim($_GET['hapus']);
    if ($id !== '') {
        $id = mysqli_real_escape_string($koneksi, $id);$query = "DELETE FROM `daftar tiket` WHERE `id` = '$id'";
        if (mysqli_query($koneksi,$query)) {
            header("Location: Pengelolaan jenis tiket.php");
            exit();
        }
    }
}

$result = mysqli_query($koneksi, "SELECT * FROM `daftar tiket` ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Event - Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Pengelolaan Tiket</h4>
            </div>
            <a href="Tambah tiket.php" class="btn btn-primary px-3 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg"></i> Tambah Tiket
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">NO</th>
                                <th>NAMA PEMBELI</th>
                                <th>TIPE TIKET</th>
                                <th>HARGA</th>
                                <th>KUOTA</th>
                                <th>BENEFIT</th>
                                <th class="text-end pe-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)):$id_tiket = isset($row['id']) ?$row['id'] : (isset($row['Id']) ?$row['Id'] : '');
                            ?>
                                <tr>
                                    <td class="ps-4 text-muted small"><?= $no++; ?></td>
                                    <td>
                                        <span class="fw-bold text-dark"><?= htmlspecialchars(isset($row['Nama Pembeli']) ?$row['Nama Pembeli'] : '-'); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark fw-semibold"><?= htmlspecialchars($row['Tipe Tiket']); ?></span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">Rp <?= number_format($row['Harga'], 0, ',', '.'); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal px-2 py-1"><?= htmlspecialchars($row['Kuota']); ?> Kursi</span>
                                    </td>
                                    <td class="text-muted small">
                                        <?php 
                                        if (!empty($row['Benefit'])) {
                                            $items = explode(', ',$row['Benefit']);
                                            foreach ($items as$item) {
                                                echo '<span class="badge bg-light text-dark border me-1 mb-1">' . htmlspecialchars($item) . '</span>';
                                            }
                                        } else {
                                            echo '<span class="text-muted">-</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="Tambah tiket.php?id=<?= $id_tiket; ?>" class="btn btn-outline-warning btn-action me-1" title="Edit Data">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="Pengelolaan jenis tiket.php?hapus=<?= $id_tiket; ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?')" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php 
                                endwhile; 
                            } else {
                                echo '<tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data tiket. Klik tombol "Tambah Tiket" untuk menambahkan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>