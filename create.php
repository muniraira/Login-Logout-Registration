<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    
    $nim = isset($_POST['nim']) && !empty($_POST['nim']) && $_POST['nim'] != 'auto' ? $_POST['nim'] : NULL;
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $jurusan = isset($_POST['jurusan']) ? $_POST['jurusan'] : '';
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $gambar = isset($_POST['gambar']) ? $_POST['gambar'] : '';
    $stmt = $pdo->prepare('INSERT INTO tabel_mahasiswa VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nim, $nama, $email, $jurusan, $fakultas, $gambar]);
    $msg = 'Created Successfully!';
}

?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="nim">nim</label>
        <label for="nama">Nama</label>
        <input type="text" name="nim" value="" nim="nim">
        <input type="text" name="nama" nim="nama">
        <label for="email">Email</label>
        <label for="prodi">prodi</label>
        <input type="text" name="email" nim="email">
        <input type="text" name="prodi" nim="prodi">
        <label for="fakultas">fakultas</label>
        <label for="gambar">gambar</label>
        <input type="text" name="fakultas" nim="fakultas">
        <input type="text" name="gambar" nim="gambar">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>