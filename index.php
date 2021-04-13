<?php
require 'functions.php';

$person = query("SELECT * FROM person_054");

if (isset($_POST["simpan"])) {
	// cek apakah data berhasil disimpan
	if(add($_POST) > 0) {
		echo "
			<script>
				alert('Data berhasil ditambahkan');
				document.location.href = 'index.php';
			</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal ditambahkan')
				</script>
			";
	}
}

if (isset($_POST["ubah"])) {
	// var_dump($_POST);
	// cek apakah data berhasil diubah
	if(edit($_POST) > 0) {
		echo "
			<script>
				alert('Data berhasil diubah');
				document.location.href = 'index.php';
			</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal diubah')
				</script>
			";
	}
}

if (isset($_POST["submit"])) {
	// cek apakah data berhasil diubah
	if(addPic($_POST) > 0) {
		echo "
			<script>
				alert('Gambar berhasil ditambahkan');
				document.location.href = 'hindex.php';
			</script>
			";
		} else {
			echo "
				<script>
					alert('Gambar gagal ditambahkan')
				</script>
			";
	}
}

if (isset($_POST["change"])) {
	// cek apakah data berhasil diubah
	if(change($_POST) > 0) {
		echo "
			<script>
				alert('Status berhasil diubah')
				document.location.href = 'index.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Status gagal diubah')
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Manage Person</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Data <b>Persons</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addPersonModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Person</span></a>						
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>IDPerson</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($person as $row) : ?>
						<tr>
							<td><?php echo $row["IDPerson"]; ?></td>
							<td><?php echo $row["Nama"]; ?></td>
							<td><?php echo $row["Alamat"]; ?></td>
							<td>
								<?php if($row["IsActive"]=="Y") : ?>
									<a href="#" class="detail-active" data-toggle="modal" data-target="#detailPersonModal<?php echo $row["IDPerson"]; ?>"><i class="material-icons person" data-toggle="tooltip" title="Detail">&#xe7fd;</i></a>
									<a href="#" class="edit-active" data-toggle="modal" data-target="#editPersonModal<?php echo $row["IDPerson"]; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
									<a href="#" class="status-active" data-toggle="modal" data-target="#statusPersonModal<?php echo $row["IDPerson"]; ?>"><i class="material-icons radio_button_on" data-toggle="tooltip" title="Active">&#xe837;</i></a>
								<?php else : ?>
									<a href="#" class="detail-inactive" data-toggle="modal"><i class="material-icons person" data-toggle="tooltip" title="Detail">&#xe7fd;</i></a>
									<a href="#" class="edit-inactive" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
									<a href="#" class="status-inactive" data-toggle="modal" data-target="#statusPersonModal<?php echo $row["IDPerson"]; ?>"><i class="material-icons radio_button_on" data-toggle="tooltip" title="Inactive">&#xe837;</i></a>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>        
	</div>

	
	<!-- Add Modal HTML -->
	<div id="addPersonModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Add Person</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="Nama" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Gender</label><br>
							<div class="radio">
								<div class="radio-male">
									<input type="radio" name="Gender" id="laki" value="L">
									<label for="laki">Laki-Laki</label>
								</div>
								<div class="radio-female">
									<input type="radio" name="Gender" id="perempuan" value="P">
									<label for="perempuan">Perempuan</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Kota Lahir</label>
							<input type="text" name="KotaLahir" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="TanggalLahir" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="Alamat" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Kota</label>
							<input type="text" name="Kota" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="simpan" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Add Modal HTML -->
	<!-- Edit Modal HTML -->
	<?php foreach($person as $row) : ?>
	<div id="editPersonModal<?php echo $row["IDPerson"]; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Person</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="IDPerson" value="<?php echo $row["IDPerson"]; ?>">					
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="Nama" class="form-control" value="<?php echo $row["Nama"]; ?>" required>
						</div>
						<div class="form-group">
							<label>Gender</label><br>
							<div class="radio">
								<div class="radio-male">
									<input type="radio" name="Gender" id="laki" value="L" <?php if($row["Gender"]=="L") echo 'checked'; ?>>
									<label for="laki">Laki-Laki</label>
								</div>
								<div class="radio-female">
									<input type="radio" name="Gender" id="perempuan" value="P" <?php if($row["Gender"]=="P") echo 'checked'; ?>>
									<label for="perempuan">Perempuan</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Kota Lahir</label>
							<input type="text" name="KotaLahir" class="form-control" value="<?php echo $row["KotaLahir"] ?>" required>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="TanggalLahir" class="form-control" value="<?php echo $row["TanggalLahir"] ?>" required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="Alamat" class="form-control" required><?php echo $row["Alamat"] ?></textarea>
						</div>
						<div class="form-group">
							<label>Kota</label>
							<input type="text" name="Kota" class="form-control" value="<?php echo $row["Kota"] ?>" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="ubah" class="btn btn-success" >
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<!-- End Edit Modal HTML -->
	<!-- Detail Modal HTML -->
	<?php foreach($person as $row) : ?>
	<div id="detailPersonModal<?php echo $row["IDPerson"]; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Detail Person</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="IDPerson" value="<?php echo $row["IDPerson"]; ?>">
						<div class="detail-wrapper">
							<div class="detail-data">
								<table class="table table-borderless">
									<?php $person ?>
									<tr>
										<td>IDPerson</td>
										<td>:</td>
										<td><?php echo $row["IDPerson"]; ?></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td><?php echo $row["Nama"]; ?></td>
									</tr>
									<tr>
										<td>Gender</td>
										<td>:</td>
										<td><?php if($row["Gender"]=="L") : echo "Laki-Laki"; else : echo "Perempuan"; ?><?php endif?></td>
									</tr>
									<tr>
										<td>Kota Lahir</td>
										<td>:</td>
										<td><?php echo $row["KotaLahir"]; ?></td>
									</tr>
									<tr>
										<td>Tanggal Lahir</td>
										<td>:</td>
										<td><?php echo $row["TanggalLahir"]; ?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?php echo $row["Alamat"]; ?></td>
									</tr>
									<tr>
										<td>Kota</td>
										<td>:</td>
										<td><?php echo $row["Kota"]; ?></td>
									</tr>
								</table>								
							</div>
							<div class="detail-avatar">
								<img src="img/<?php echo $row['Image'] ?>" alt="">
								<input type="file" name="Image" id="image">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="submit" class="btn btn-info">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<!-- End Detail Modal HTML -->
	<!-- Status Modal HTML -->
	<?php foreach($person as $row) : ?>
	<div id="statusPersonModal<?php echo $row["IDPerson"]; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Status Person</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="IDPerson" value="<?php echo $row["IDPerson"]; ?>">					
						<p>Are you sure you want to change the User's status?</p>
						<?php if($row["IsActive"]=="Y") : ?>
							<input type="hidden" name="IsActive" value="N">
						<?php else : ?>
							<input type="hidden" name="IsActive" value="Y">
						<?php endif ?>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="change" class="btn btn-danger" value="Change">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endforeach; ?>

	<script src="script.js"></script>
</body>
</html>

<?php
	// // koneksi ke DBMS
	// $conn = mysqli_connect("localhost","root","","person_054");

	// if (isset($_POST["simpan"])) {
	// 	// var_dump($_POST);
	// 	$Nama			= $_POST['Nama'];
	// 	$Gender			= $_POST['Gender'];
	// 	$KotaLahir		= $_POST['KotaLahir'];
	// 	$TanggalLahir	= $_POST['TanggalLahir'];
	// 	$Alamat			= $_POST['Alamat'];
	// 	$Kota			= $_POST['Kota'];

	// 	$query = "INSERT INTO person_054 VALUES
	// 			('', '$Nama', '$Gender', '$KotaLahir', '$TanggalLahir', '$Alamat', '$Kota, 'Y', '')";

	// 	mysqli_query($conn, $query);

	// 	// cek keberhasilan
	// 	// var_dump(mysqli_affected_rows($conn));
	// 	if(mysqli_affected_rows($conn) > 0){
	// 		echo "<div align='center'><h5> Silahkan Tunggu, Data Sedang Disimpan...</h5></div>";
	// 		echo "<meta http-equiv='refresh' content='1;url=http://localhost/user-management/index.php'>";
	// 	}
	// 	// else {
	// 	// 	echo "gagal!";
	// 	// 	echo "<br>";
	// 	// 	echo mysqli_error($conn);
	// 	// }
	// }
?>
