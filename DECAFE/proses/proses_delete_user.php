<?php

include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("data berhasil di Hapus");
    window.location="../user";
    </script>';

    } else {
        $message = '<script>alert("data gagal di Hapus");
        window.location="../user";
    </script>';
    }
}
echo $message;


?>