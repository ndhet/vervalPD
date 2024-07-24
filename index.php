<?php

include_once("helper/functions.php");
include_once("helper/config.php");

if(isset($_POST['simpan'])){
    $idlama = post('idresidu');
    $nama = post('nama');
    $nik = post('nik');
    $nisn = post('nisn');
    $tmplahir = post('tmplahir');
    $tgl = post('tgllahir');
    $date = DateTime::createFromFormat('m/d/Y', $tgl);
    $tgllahir = $date->format('Y-m-d');
    $ibu = post('ibu');
    $jk = post('jk');
    $region = post('negara');
    $provinsi = post('provinsi');
    $kabupaten = post('kabupaten');
    $kecamatan = post('kecamatan');
    $desa = post('desa');
    $dusun = post('dusun');

    $image = $_FILES['imgkk']['name'];

    if ($image === "") {
        toastr_set("error", "Gambar tidak boleh kosong");
    }else{
        $tmpFile = $_FILES['imgkk']['tmp_name'];
        $extList = array("jpg","png","jpeg");
        $pecah = explode("." , $image);
        $extensi = $pecah[1];
        $dir = "/home/ppmbr/domains/vervalpd.ppmbr.my.id/public_html/assets/img/kk/";
    
        $filepath = $dir . 'kk_' . $nama . '.jpg';
        $images = 'kk_' . $nama . '.jpg';
    
        if (in_array($extensi, $extList)) {
            if(move_uploaded_file($tmpFile, $filepath)){
                $result = insertSiswa($nama, $nik, $nisn, $tmplahir, $tgllahir, $ibu, $jk, $region, $provinsi, $kabupaten, $kecamatan, $desa, $dusun, $images);
                uresidu($idlama, $nama);
                if ($result) {
                    toastr_set("success", "Data siswa berhasil di input");
                }else {
                    toastr_set("error", "Data gagal di input");
                }
            }else {
                toastr_set("error", "Gagal Upload");
                redirect("index.php");
            }
        }else {
            toastr_set("error", "Berkas harus berextensi jpg");
            redirect("index.php");
        }
    }
    

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
    <meta property="og:image" content="/assets/img/kk/pp.png" />
    <meta name="distribution" content="global" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        </div>
    </nav>
    <div class="container-xl">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <div class="card mb-3">
                        <div class="card-header">
                            Informasi
                        </div>
                        <div class="card-body" style="overflow-y:auto; max-height:200px;">
                            <div class="card bg-azure-lt">
                                <span class="ms-3 mb-2 mt-4 text-muted">2024-07-02 12:27:00</span>
                                <div class="badges-list">
                                    <span class="ms-3 mb-2 badge bg-orange text-orange-fg w-20">Important<span class="badge bg-orange badge-notification badge-blink"></span></span>
                                </div>
                                <span class="ms-3 mb-2 me-3 text-muted justify">Assalamualaikum Wr, Wb<br>Perhatian Kepada seluruh siswa yang datanya invalid Tolong diperbaiki dengan mencari siswa di form SEARCH dengan mengetikan nama siswa kemudian mengklik tombol merah "Perbaiki", kemudian isi semua form yang tersedia seperti Nama, Nik, Nisn, dan seterusnya termasuk mengupload foto KK.<br><i class="text-red">Dimohon saat mengisi data harus teliti karena jika data sudah disimpan tidak bisa diubah lagi, hanya bisa melihat data yang sudah diinput.</i><br><br>Jika ada masalah atau kesulitan bisa menghubungi admin klik tombol whatsapp dibawah</span>
                                <div class="badges-list">
                                    <a href="https://wa.me/+6282125388500" class="ms-3 mb-4 badge bg-green text-green-fg text-decoration-none d-flex"><svg  xmlns="http://www.w3.org/2000/svg" class="me-1" width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>Whatsapp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div id="dataTable_wrapper" class="m-3 table-responsive dataTables_wrapper dt-bootstrap4 no-footer">
                                        <?= toastr_show() ?>
                                        <table class="table card-table table-vcenter text-nowrap datatable dataTable no-footer"
                                        id="dataTable" aria-describedby="dataTable_info" role="grid">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NAMA</th>
                                                <th>DATA</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                $residu = getResidu();
                                                foreach($residu as $data ): ?>
                                            <tr>
                                            
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['status'] ? '<span class="fs-5 status status-green"><span class="status-dot status-dot-animated"></span>Valid</span>': '<span class="fs-5 status status-red"><span class="status-dot status-dot-animated"></span>Invalid</span>' ?></td>
                                                <td><?= $data['status'] ? '<a id="validsiswa" class="btn btn-success btn-sm btn-pill" data-id="'.$data["nama"].'"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" /><path d="M9 12l2 2l4 -4" /></svg>Lihat</a>' : '<a id="modalinput" class="btn btn-danger btn-sm btn-pill" data-id="'.$data["id"].'" data-name="'.$data['nama'].'"><svg   xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-xbox-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10m3.6 5.2a1 1 0 0 0 -1.4 .2l-2.2 2.933l-2.2 -2.933a1 1 0 1 0 -1.6 1.2l2.55 3.4l-2.55 3.4a1 1 0 1 0 1.6 1.2l2.2 -2.933l2.2 2.933a1 1 0 0 0 1.6 -1.2l-2.55 -3.4l2.55 -3.4a1 1 0 0 0 -.2 -1.4" /></svg> Perbaiki</a>'?></td>
                                            </tr>
                                                <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="modalinput" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <div id="modal-title-input"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idresidu" id="idresidu"/>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="nama" class="form-control" id="floatingInput" required placeholder="Nama Lengkap">
                                <label for="floatingInput">Nama Lengkap</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="nik" class="form-control" id="floatingInput" required placeholder="No NIK">
                                <label for="floatingInput">No NIK</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="nisn" class="form-control" id="floatingInput" required placeholder="Nisn">
                                <label for="floatingInput">Nisn</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="tmplahir" class="form-control" id="floatingInput" required placeholder="Tempat Lahir">
                                <label for="floatingInput">Tempat Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group date form-floating mb-3" id="datepicker">
                                <input name="tgllahir" type="text" class="form-control  d-flex" id="floatingInput" required placeholder="Tgl Lahir">
                                <label for="floatingInput">Tgl Lahir</label>
                                <span class="input-group-append">
                                    
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="ibu" class="form-control" id="floatingInput" required placeholder="Ibu Kandung">
                                <label for="floatingInput">Ibu Kandung</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <select name="jk" class="form-select" id="floatingSelect" aria-label="Jenis Kelamin">
                                    <option value="null">Pilih</option>
                                    <option value="L">Laki Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label for="floatingSelect">Jenis Kelamin</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="negara" class="form-control" id="floatingInput" required placeholder="Negara">
                                <label for="floatingInput">Negara</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="provinsi" class="form-control" id="floatingInput" required placeholder="Provinsi">
                                <label for="floatingInput">Provinsi</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="kabupaten" class="form-control" id="floatingInput" required placeholder="Kabupaten">
                                <label for="floatingInput">Kabupaten</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="kecamatan" class="form-control" id="floatingInput" required placeholder="Kecamatan">
                                <label for="floatingInput">Kecamatan</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="desa" class="form-control" id="floatingInput" required placeholder="Desa">
                                <label for="floatingInput">Desa</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" name="dusun" class="form-control" id="floatingInput" required placeholder="Kampung">
                                <label for="floatingInput">Kampung</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                            <div class="form-label mb-0 mt-0">Upload Foto KK</div>
                                <input name="imgkk" type="file" id="floatingInput" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
            </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="siswavalid" tabindex="-1" aria-labelledby="validsiswa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <div id="modaltitle">
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="datahtml">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function() {
            $('#datepicker').datepicker();
        });
        getid();
        getvalid();
        function getid(){
            $(document).on("click", "#modalinput", function(){
                var id = $(this).attr('data-id')
                var nama = $(this).attr('data-name')
                $('#inputdata').modal('show');
                $('#modal-title-input').html('<b class="modal-title h5">DATA <i class="text-danger">'+ nama +'</i></b>')
                $('#idresidu').val(id)
            })
        }
        function getvalid(){
            $(document).on("click", "#validsiswa", function (){
                var nama = $(this).attr('data-id')
                $.ajax({
                    url: 'getdata.php',
                    method: 'post',
                    data: {nama: nama},
                    success: function(data){
                        $('#siswavalid').modal('show')
                        $('#modaltitle').html('<h5 class="modal-title">Data '+ nama +'</h5>')
                        $('#datahtml').html(data)
                    }
                })
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>