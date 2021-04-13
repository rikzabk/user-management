<?php
// koneksi ke database
$hostname   = "localhost";
$user       = "root";
$password   = "";
$database   = "person_054";
$conn = mysqli_connect($hostname, $user, $password, $database);

// function menyimpan query database ke dalam array
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// function tambah person
function add($data) {
    global $conn;

    $Nama			= htmlspecialchars($data["Nama"]);
    $Gender			= htmlspecialchars($data["Gender"]);
    $KotaLahir		= htmlspecialchars($data["KotaLahir"]);
    $TanggalLahir	= htmlspecialchars($data["TanggalLahir"]);
    $Alamat			= htmlspecialchars($data["Alamat"]);
    $Kota			= htmlspecialchars($data["Kota"]);

    $query = "INSERT INTO person_054 VALUES
            ('', '$Nama', '$Gender', '$KotaLahir', '$TanggalLahir', '$Alamat', '$Kota', 'Y', '')";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

// function edit person
function edit($data) {
    global $conn;

    $IDPerson       = $data["IDPerson"];
    $Nama			= htmlspecialchars($data["Nama"]);
    $Gender			= htmlspecialchars($data["Gender"]);
    $KotaLahir		= htmlspecialchars($data["KotaLahir"]);
    $TanggalLahir	= htmlspecialchars($data["TanggalLahir"]);
    $Alamat			= htmlspecialchars($data["Alamat"]);
    $Kota			= htmlspecialchars($data["Kota"]);

    $query = "UPDATE person_054 SET
                Nama = '$Nama',
                Gender = '$Gender',
                KotaLahir = '$KotaLahir',
                TanggalLahir = '$TanggalLahir',
                Alamat = '$Alamat',
                Kota = '$Kota'
                WHERE IDPerson = $IDPerson
            ";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

// function tambah gambar person
function addPic($data) {
    global $conn;
    
    $IDPerson = $data["IDPerson"];
    
    // upload gambar
    $Image = upload();
    if (!$Image) {
        return false;
    }
    
    $query = "UPDATE person_054 SET
                Image = '$Image'
                WHERE IDPerson = $IDPerson
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile   = $_FILES['Image']['name'];
    $ukuranFile = $_FILES['Image']['size'];
    $error      = $_FILES['Image']['error'];
    $tmpname    = $_FILES['Image']['tmp_name'];
    
    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid    = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar         = explode('.', $namaFile);
    $ekstensiGambar         = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
        alert('Ekstensi gambar tidak sesuai! (.jpg/.jpeg/.png)');
        </script>
        ";
        return false;
    }
    
    // cek jika ukurannya terlalu besar
    if($ukuranFile > 1000000) {
        echo "
        <script>
        alert('Ukuran gambar terlalu besar! (max. 1MB)');
        </script>
        ";
        return false;
    }
    
    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    
    // proses upload
    move_uploaded_file($tmpname, 'img/' . $namaFileBaru);
    
    return $namaFileBaru;
}

// function edit person
function change($data) {
    global $conn;

    $IDPerson = $data["IDPerson"];
    $IsActive = $data["IsActive"];

    $query = "UPDATE person_054 SET
                IsActive = '$IsActive'
                WHERE IDPerson = $IDPerson
            ";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}
?>