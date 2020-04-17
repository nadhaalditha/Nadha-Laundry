<?php
$detailKartu = $data['detailKartu'];
$kodeService = $detailKartu['kode_service'];
$waktuRegistrasi = $detailKartu['waktu_masuk'];
$waktuDiambil = $detailKartu['waktu_diambil'];
$username = $detailKartu['pelanggan'];
$statusCucian = $detailKartu['status'];
$pembayaran = $detailKartu['pembayaran'];

//cari nama pelanggan 
$this -> st -> query("SELECT nama_lengkap FROM tbl_pelanggan WHERE username='$username';");
$qNamaPelanggan = $this -> st -> querySingle();
$namaPelanggan = $qNamaPelanggan['nama_lengkap'];
//status cucian 
if($statusCucian == 'hold'){
    $capStatus = 'Hold (Menunggu antrian ke laundry room)';
    $btnKeLaundryRoom = '';
}elseif($statusCucian === 'cuci'){
    $capStatus = 'Cuci (Sedang di laundry room)';
    $btnKeLaundryRoom = '';
}else{
    $capStatus = 'Selesai (Selesai di cuci)';
    $btnKeLaundryRoom = 'disabled';
}
//status pembayaran 
if($pembayaran == 'selesai'){
  $capPembayaran = 'disabled';
  $statusPembayaran = 'Sudah';
  $capSudahDiambil = '';
}else{
  $capPembayaran = '';
  $statusPembayaran = 'Pending';
  $capSudahDiambil = 'disabled';
}
//diambil 
if($waktuDiambil == '0000-00-00 00:00:00'){
$statusDiambil = 'Belum';
$capSudahDiambil = '';
}else{
$statusDiambil = 'Sudah';
$capSudahDiambil = 'disabled';
}
?>
<div class="container" id='divDetailKartuLaundry'>
    <div style='margin-bottom:15px;'>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
        <div class='card card-primary' style="border-radius:3px; padding:12px;">
        <div class="card-header"><h5>Kartu laundry <?=$kodeService; ?></h5></div>
        <div style="padding-top:12px;padding-left:10px;">
        <table class="table">
            <tr>
                <td>Pelanggan</td>
                <td><?=$namaPelanggan; ?></td>
            </tr>
            <tr>
                <td>Waktu Registrasi</td>
                <td><?=$waktuRegistrasi; ?></td>
            </tr>
            <tr>
                <td>Status Cucian</td>
                <td><?=$capStatus; ?></td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td><?=$statusPembayaran; ?></td>
            </tr>
            <tr>
                <td>Sudah di ambil</td>
                <td><?=$statusDiambil; ?></td>
            </tr>
        </table>
        <div style="text-align: center;padding-top:12px;">
            <a href='#!' class="btn btn-lg btn-primary btn-icon icon-left <?=$capPembayaran; ?>" v-on:click='bayarAtc'><i class='fas fa-receipt'></i> Bayar</a>&nbsp;&nbsp;
            <a href='#!' class="btn btn-lg btn-primary btn-icon icon-left <?=$capSudahDiambil; ?>" v-on:click='pickUpAtc("<?=$kodeService; ?>")' id='btnPickUp'><i class='fas fa-check-circle'></i> Set sudah di ambil</a>&nbsp;&nbsp;
            <a href='#!' class="btn btn-lg btn-primary btn-icon icon-left <?=$btnKeLaundryRoom; ?>" v-on:click='keLaundryRoomAtc("<?=$kodeService; ?>")'><i class='fas fa-tshirt'></i> Ke laundry room</a>&nbsp;&nbsp;
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
        <div class='card card-primary' style="border-radius:3px; padding:12px;">
        <div class="card-header"><h5>Timeline cucian</h5></div>
        <div class="card-body">
        <div class="activities">
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                      <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job"><?=$waktuRegistrasi; ?></span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#!">Admin</a>
                      </div>
                      <p>Cucian dibuat</p>
                    </div>
                  </div>
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                      <i class="fas fa-arrows-alt"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job"><?=$waktuRegistrasi; ?></span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">Admin</a>
                      </div>
                      <p>Cucian masuk ke laundry room.</p>
                    </div>
                  </div>
                </div>
        </div>
        </div>
        </div>
    </div>
</div>
<script src="<?=STYLEBASE; ?>/dasbor/detailKartuLaundry.js"></script>