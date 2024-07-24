<?php

include_once("helper/functions.php");
include_once("helper/config.php");

if (isset($_POST['nama'])) {

    $nama = $_POST['nama'];

    $data = getSiswaByname($nama)->fetch_assoc();

?>
<div class="table-responsive-sm">
<table class="table table-striped table-responsive">
    <tr>
        <td>
            NAMA
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['nama'] ?>
        </td>
    </tr>
    <tr>
        <td>
            NIK
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['nik'] ?>
        </td>
    </tr>
    <tr>
        <td>
            NISN
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['nisn'] ?>
        </td>
    </tr>
    <tr>
        <td>
            TTL 
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['tempatlahir'].', '.$data['tgllahir'] ?>
        </td>
    </tr>
    <tr>
        <td>
            IBU
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['ibukandung']?>
        </td>
    </tr>
    <tr>
        <td>
            JK
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['jk']=='L' ? 'Laki Laki' : 'Perempuan'?>
        </td>
    </tr>
    <tr>
        <td>
            ALAMAT
        </td>
        <td>
            :
        </td>
        <td>
         <?= $data['dusun'].', '.$data['desa'].', '.$data['kecamatan'].', '.$data['kabupaten'].', '.$data['provinsi'].', '.$data['warga']?>
        </td>
    </tr>
    <tr>
        <td>
            KK
        </td>
        <td>
            :
        </td>
        <td>
            <img src="assets/img/kk/<?= $data['images']?>" width="90" height="90" class="img-fluid">
        </td>
    </tr>
    <tr class="mt-3">
        <td colspan="3">
            <a href="#" class="btn btn-sm btn-success d-flex text-center justify-content-center">UBAH</a>
        </td>
    </tr>
    
</table>
</div>

<?php
    
}else{
    echo "error";
}
?>