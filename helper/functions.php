<?php

include_once('./config.php');
session_start();
function get($param){
    global $mysqli;
    $d = isset($_GET[$param]) ? $_GET[$param] : NULL;
    //$d = mysqli_real_escape_string($mysqli, $d);
    $d = htmlspecialchars($d);
    return $d;
}

function post($param){
    global $mysqli;
    $d = isset($_POST[$param]) ? $_POST[$param] : NULL;
    //$d = mysqli_real_escape_string($mysqli, $d);
    $d = htmlspecialchars($d);
    return $d;
}

function getSiswa(){
    global $mysqli;
    $sql = "SELECT * FROM siswa";
    $result = $mysqli->query($sql);
    return $result;
}

function getSiswaByname($nama){
    global $mysqli;
    $sql = "SELECT * FROM siswa WHERE nama='$nama'";
    $result = $mysqli->query($sql);
    return $result;
}

function getResidu(){
    global $mysqli;
    $sql = "SELECT * FROM residu";
    $result = $mysqli->query($sql);
    return $result;
}

function insertSiswa($nama, $nik, $nisn, $tmplahir, $tgllahir, $ibu, $jk, $region, $provinsi, $kabupaten, $kecamatan, $desa, $dusun, $image){
    global $mysqli;
    $sql = "INSERT INTO siswa(nik, nisn, nama, tempatlahir, tgllahir, ibukandung, jk, warga, provinsi, kabupaten, kecamatan, desa, dusun, images) VALUES('$nik', '$nisn', '$nama', '$tmplahir', '$tgllahir', '$ibu', '$jk', '$region', '$provinsi', '$kabupaten', '$kecamatan', '$desa', '$dusun', '$image')";
    $result = $mysqli->query($sql);
    return $result;
}

function upexcel($nama, $status){
    global $mysqli;
    $sql = "INSERT INTO residu(`nama`,`status`) VALUES('$nama',0)";
    $result = $mysqli->query($sql);
    return $result;
}

function uresidu($id, $nama){
    global $mysqli;
    $sql = "UPDATE residu SET status=1, nama='$nama' WHERE id='$id'";
    $result = $mysqli->query($sql);
    return $result;
}

function login($u, $p){
    global $mysqli;
    $p = md5($p);
    $sql = "SELECT * FROM users WHERE username='$u' AND password='$p'";
    $q = $mysqli->query($sql);


    if($q->num_rows){
        $_SESSION['login'] = true;
        $_SESSION['user'] = $u;
        return true;
    }else{
        toastr_set('error','Username atau Password salah !');
        return false;
    }
}

function cekSession(){
    $login = isset($_SESSION['login']) ? $_SESSION['login'] : false;
    if($login){
        return 1;
    }else{
        return 0;
    }
}

function toastr_set($status, $msg){
    $_SESSION['toastr'] = true;
    $_SESSION['toastr_status'] = $status;
    $_SESSION['toastr_msg'] = $msg;
}

function toastr_show(){
    $t = isset($_SESSION['toastr']) ? $_SESSION['toastr'] : null;
    $t_s = isset($_SESSION['toastr_status']) ? $_SESSION['toastr_status'] : null;
    $t_m = isset($_SESSION['toastr_msg']) ? $_SESSION['toastr_msg'] : null;
    if($t == true){
        if($t_s == "success"){
            echo '<div class="alert alert-important alert-success alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="d-flex me-3 icon alert-icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10"></svg></div><div>'.$t_m.'</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
        }

        if($t_s == "error"){
            echo '<div class="alert alert-important alert-danger alert-dismissible" role="alert"><div class="d-flex"><div><svg xmlns="http://www.w3.org/2000/svg" class="d-flex me-3 icon alert-icon icon-tabler-alert-triangle" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg></div><div> '.$t_m.'</div></div><a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a></div>';
        }                                                                                                                                                                                                                                                                         unset($_SESSION['toastr']);                                                                                                          unset($_SESSION['toastr_status']);                                                                                                   unset($_SESSION['toastr_msg']);
    }
}

function redirect($target){
    echo '
    <script>
    window.location = "'.$target.'";
    </script>
    ';
    exit;
}


?>