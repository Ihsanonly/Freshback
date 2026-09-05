<?php

require_once __DIR__ . '/config/database.php';

try {
    $databaseName = $pdo->query('SELECT DATABASE()')->fetchColumn();
    $totalFoods = $pdo->query('SELECT COUNT(*) FROM foods')->fetchColumn();
    $message = 'Koneksi database berhasil.';
} catch (PDOException $exception) {
    $databaseName = '-';
    $totalFoods = '-';
    $message = 'Koneksi berhasil, tetapi tabel foods belum ditemukan. Jalankan file database/freshback.sql terlebih dahulu.';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Database FRESHBACK</title>
</head>
<body>
    <h1>Tes Database FRESHBACK</h1>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <ul>
        <li>Database: <?php echo htmlspecialchars((string) $databaseName, ENT_QUOTES, 'UTF-8'); ?></li>
        <li>Total data di tabel foods: <?php echo htmlspecialchars((string) $totalFoods, ENT_QUOTES, 'UTF-8'); ?></li>
    </ul>
</body>
</html>
