<?php

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['nim'])) {
    if (!empty($_POST)) {
        $nim = isset($_POST['nim']) ? $_POST['nim'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $jurusan = isset($_POST['prodi']) ? $_POST['jurusan'] : '';
        $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
        $gambar = isset($_POST['gambar']) ? $_POST['gambar'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE tabel_mahasiswa SET nim = ?, nama = ?, email = ?, jurusan = ?, fakultas = ?, gambar = ? WHERE nim = ?');
        $stmt->execute([$nim, $nama, $email, $prodi, $fakultas, $gambar, $_GET['nim']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM tabel_mahasiswa WHERE nim = ?');
    $stmt->execute([$_GET['nim']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that nim!');
    }
} else {
    exit('No nim specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['nim']?></h2>
    <form action="update.php?nim=<?=$contact['nim']?>" method="post">
        <label for="nim">nim</label>
        <label for="nama">Nama</label>
        <input type="text" name="nim" value="<?=$contact['nim']?>" nim="nim">
        <input type="text" name="nama" value="<?=$contact['nama']?>" nim="nama">
        <label for="email">Email</label>
        <label for="jurusan">prodi</label>
        <input type="text" name="email" value="<?=$contact['email']?>" nim="email">
        <input type="text" name="prodi" value="<?=$contact['jurusan']?>" nim="jurusan">
        <label for="fakultas">Pekerjaan</label>
        <input type="text" name="fakultas" value="<?=$contact['fakultas']?>" nim="title">
        <label for="gambar">gambar</label>
        <input type="text" name="gambar" value="<?=$contact['gambar']?>" nim="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>