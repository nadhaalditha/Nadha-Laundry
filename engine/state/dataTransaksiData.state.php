<?php

class dataTransaksiData{
   
 private $st;

  public function __construct()
  {
   $this -> st = new state;
  }

  public function dataPembayaran()
  {
    $this -> st -> query("SELECT * FROM tbl_pembayaran;");
    return $this -> st -> queryAll();
  }

  public function getUsernameInLaundryCard($kodeService)
  {
    $this -> st -> query("SELECT pelanggan FROM tbl_kartu_laundry WHERE kode_service='$kodeService';");
    return $this -> st -> querySingle();
  }

  public function getPelangganName($username)
  {
    $this -> st -> query("SELECT nama_lengkap FROM tbl_pelanggan WHERE username='$username';");
    return $this -> st -> querySingle();
  }

  public function detailTransaksi($kdTransaksi)
  {
    $this -> st -> query("SELECT * FROM tbl_pembayaran WHERE kd_pembayaran='$kdTransaksi' LIMIT 0,1;");
    return $this -> st -> querySingle();
  }

  public function getTempCucian($kodeService)
  {
    $this -> st -> query("SELECT * FROM tbl_temp_item_cucian WHERE kd_room='$kodeService';");
    return $this -> st -> queryAll();
  }

  public function getDataProduk($kodeItem)
  {
    $this -> st -> query("SELECT nama, satuan FROM tbl_service WHERE kd_service='$kodeItem' LIMIT 0,1;");
    return $this -> st -> querySingle();
  }

}