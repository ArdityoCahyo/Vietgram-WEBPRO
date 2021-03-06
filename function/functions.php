<?php

// koneksi database
require_once 'db.php';

// menampilkan isi query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] =  $row;
    }
    return $rows;
}

// tambah photo
function tambahPhoto($data)
{
    global $conn;
    $caption = htmlspecialchars($data['caption']);
    $ekstensi_allowed = array('png', 'jpg', 'jpeg', 'svg');
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];


    if (in_array($ekstensi, $ekstensi_allowed) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, 'img/' . $gambar);
            $query = "INSERT INTO photo VALUES('','$gambar','$caption')";
            mysqli_query($conn, $query);
        } else {
            echo '<script>File is Very Big</script>';
        }
    } else {
        echo '<script>Your Format be Denied!</script>';
    }
}


function hapusPhoto($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM photo WHERE id = $id");
    return mysqli_affected_rows($conn);
}
// ======================== Edit Profile  ==========================

function EditProfile($data)
{
    global $conn;
    $id = $data["id"];
    $name = $data["nama"];
    $username = $data["username"];
    $website = $data["website"];
    $bio = $data["bio"];
    $email = $data["email"];
    $number_phone = $data["number_phone"];
    $gender = $data["gender"];

    $query = "UPDATE profil SET nama = '$name', username = '$username'  , website = '$website', bio = '$bio', email = '$email',number_phone = '$number_phone', gender = '$gender'  WHERE id = $id  ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// ========== Searching Caption
function cariCaption($cari)
{
    $query = "SELECT * FROM photo WHERE caption LIKE '%$cari%' ";
    return query($query);
}

//=========== Register

//function Register($data){
//	global $conn;
//	$id = $data["id"];
//    $name = $data["nama"];
//    $username = $data["username"];
//    $email = $data["email"];
	
//	$query = "UPDATE profil SET nama = '$name', username = '$username'  , website = '$website', bio = '$bio', email = '$email',number_phone = '$number_phone', gender = '$gender'  WHERE id = $id  ";
//}
