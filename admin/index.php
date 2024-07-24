<?php

include_once("../helper/config.php");
include_once("../helper/functions.php");
require_once('../helper/phpexcel.php');

$login = cekSession();
if(!$login){
    redirect("login.php");
}

if(post("save")){
    $user = $_SESSION['user'];
    $target = basename($_FILES['fileexcel']['name']) ;
    move_uploaded_file($_FILES['fileexcel']['tmp_name'], $target);
    chmod($_FILES['fileexcel']['name'],0777);
            
            // mengambil isi file xls
    $data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['name'],false);
            // menghitung jumlah baris data yang ada
    $jumlah_baris = $data->rowcount($sheet_index=0);
    
    
            
            // jumlah default data yang berhasil di import
            
    for ($i=2; $i<=$jumlah_baris; $i++){
            
                // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
        $nama = $data->val($i, 1);
            
        if($nama != "")
        {
                    // input data ke database (table barang)
            try{
                $sql = upexcel($nama, 0);
                toastr_set("success", "Number Added Successfully");
            }catch(mysqli_sql_exception $e) {
                toastr_set("error", "Number Failed to Add");
                redirect('index.php');
            }
        }
    }
    
            // hapus kembali file .xls yang di upload tadi
    unlink($_FILES['fileexcel']['name']);
            
            // alihkan halaman ke index.php
}

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="theme-color" content="#171347">
    <meta name="msapplication-navbutton-color" content="#171347">
    <meta name="apple-mobile-web-app-status-bar-style" content="#171347">
    <meta name="description" content="Verifikasi Dan Validasi Peserta Didik SMPS ISLAM ALMUBAROKver">
    <meta name="keywords" content="VervalPD, Peserta Didik, Verifikasi, Data, Kemdikbud">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Dedi Humaedi">
    <title>VervalPD SMPS ISLAM AL MUBAROK</title>
    <meta name="rating" content="general" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://vervalpd.ppmbr.my.id" />
    <meta property="og:title" content="VervalPD Ponpes Al Mubarok" />
    <meta property="og:description" content="Verifikasi Dan Validasi Peserta Didik SMPS ISLAM ALMUBAROK" />
    <meta property="og:image" content="/assets/images/logossh.jpg" />
    <meta name="distribution" content="global" />
    <link href="https://vip.sshaxor.my.id/assets/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="https://vip.sshaxor.my.id/assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">VervalPD PPMBR</a>
            <nav class="nav">
                <a class="btn btn-sm rounded btn-secondary" aria-current="page" href="logout.php">Logout</a>
            </nav>
        </div>
    </nav>
    <div class="container py-1 h-100 h-4">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                    <a class="ms-3 btn btn-pill btn-success text-right" data-bs-toggle="modal" data-bs-target="#modal-import" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3"></path></svg> Import Excel</a>
                    </div>
                    <div id="dataTable_wrapper" class="m-3 table-responsive dataTables_wrapper dt-bootstrap4 no-footer">
                        <?= toastr_show() ?>
                        <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer" id="dataTable" aria-describedby="dataTable_info" role="grid">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>TTL</th>
                                <th>Ibu Kandung</th>
                                <th>JK</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $siswa = getSiswa();
                                foreach($siswa as $data ): ?>
                            <tr>
                            
                                <td><?= $no++ ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['nik'] ?></td>
                                <td><?= $data['tempatlahir'].', '.$data['tgllahir'] ?></td>
                                <td><?= $data['ibukandung'] ?></td>
                                <td><?= $data['jk'] ?></td>
                                <td><?= $data['dusun'].', '.$data['desa'].', '.$data['kecamatan'].', '.$data['kabupaten'].', '.$data['provinsi'] ?></td>
                            </tr>
                                <?php endforeach ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-import" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header justify-content-center">
                <a class="fs-3 m-2 btn btn-pill btn-sm btn-outline-success text-right fs-6" href="/assets/excel.xls"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M12 17v-6"></path><path d="M9.5 14.5l2.5 2.5l2.5 -2.5"></path></svg> Download Format Excel</a>
                <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                <form method="post" enctype="multipart/form-data">
                    <input class="form-control" name="fileexcel" type="file" required="required">
                </div> 
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Cancel
                </a>            
                <input class="btn btn-primary ms-auto" type="submit" name="save" value="Simpan">
                    </form>
            </div>
            </div>
        </div>
    </div>
    <script src="https://vip.sshaxor.my.id/assets/js/demo-theme.min.js?1692870487"></script>
    <script src="https://vip.sshaxor.my.id/assets/js/tabler.min.js?1692870487" defer></script>
    <script src="https://vip.sshaxor.my.id/assets/jquery/jquery.min.js"></script>
    <script src="https://vip.sshaxor.my.id/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="https://vip.sshaxor.my.id/assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://vip.sshaxor.my.id/assets/datatables/datatables-demo.js"></script>
</body>
</html>