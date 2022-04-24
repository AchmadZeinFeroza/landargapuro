<?php
class dashboard_model extends CI_Model{  
  public function penjualan($tgl,$id='')
  {
    if ($id!='') {
     return $this->db->select('*')->from('penjualan')->where('id_admin',$id)->where('tanggal ="'.$tgl.'"')->get()->num_rows();
   }else{
     return $this->db->select('*')->from('penjualan')->where('tanggal ="'.$tgl.'"')->get()->num_rows();

   }
 } 
 public function cash_masuk($tgl,$id='')
 {
  if ($id!='') {
    return $this->db->select('SUM(masuk) as total')->from('cash_in_out')->where('id_admin',$id)->where('tanggal ="'. $tgl.'"')->get()->row(); 
  }else{
    return $this->db->select('SUM(masuk) as total')->from('cash_in_out')->where('tanggal ="'. $tgl.'"')->get()->row(); 

  }
  
} 
public function cash_keluar($tgl,$id='')
{
  if ($id!='') {
    return $this->db->select('SUM(keluar) as total')->from('cash_in_out')->where('id_admin',$id)->where('tanggal ="'. $tgl.'"')->get()->row(); 
  }else{
    return $this->db->select('SUM(keluar) as total')->from('cash_in_out')->where('tanggal ="'. $tgl.'"')->get()->row(); 

  } 
} 
public function total_penjualan_hari_ini($id='')
{
  if ($id!='') {
   return $this->db->select('SUM(total) as total')->from('penjualan')->where('id_admin',$id)->where('tanggal ="'. date('Y-m-d').'"')->get()->row();
 }else{
   return $this->db->select('SUM(total) as total')->from('penjualan')->where('tanggal ="'. date('Y-m-d').'"')->get()->row();
 }
} 
public function total_penjualan_minggu_ini($id='')
{
 if ($id!='') {
   return $this->db->select('SUM(total) as total')->from('penjualan')->where('id_admin',$id)->where('tanggal BETWEEN "'. date('Y-m-d', strtotime('monday this week')). '" and "'. date('Y-m-d', strtotime('sunday this week')).'"')->get()->row();
 }else{
   return $this->db->select('SUM(total) as total')->from('penjualan')->where('tanggal BETWEEN "'. date('Y-m-d', strtotime('monday this week')). '" and "'. date('Y-m-d', strtotime('sunday this week')).'"')->get()->row();
 }
 
}
public function total_penjualan_bulan_ini($id='')
{
 if ($id!='') {
  return  $this->db->select('SUM(total) as total')->from('penjualan')->where('id_admin',$id)->where('tanggal BETWEEN "'. date('Y-m-01'). '" and "'. date('Y-m-t').'"')->get()->row();
}else{
  return  $this->db->select('SUM(total) as total')->from('penjualan')->where('tanggal BETWEEN "'. date('Y-m-01'). '" and "'. date('Y-m-t').'"')->get()->row();
}

} 
public function total_hutang_belum_bayar()
{
 return  $this->db->select('SUM(nominal - nominal_dibayar) as total')->from('hutang_history')->where('sudah_lunas ="0"')->get()->row();
}  
public function akan_jatuh_tempo()
{
 return  $this->db->select('*')->from('hutang_history')->where('tanggal_jatuh_tempo <= "'. date('Y-m-d',strtotime('+2 weeks')). '" and tanggal_jatuh_tempo > "'. date('Y-m-d'). '" and sudah_lunas ="0"')->get()->num_rows();
} 
public function sudah_jatuh_tempo()
{
 return   $this->db->select('*')->from('hutang_history')->where('tanggal_jatuh_tempo <= "'. date('Y-m-d'). '" and sudah_lunas ="0"')->get()->num_rows(); 
}
public function dibayar_minggu()
{
 return    $this->db->select('SUM(nominal) as total')->from('hutang_dibayar_history')->where('tanggal BETWEEN "'. date('Y-m-d', strtotime('monday this week')). '" and "'. date('Y-m-d', strtotime('sunday this week')).'"')->get()->row(); 

} 
public function total_piutang_belum_bayar()
{
 return $this->db->select('SUM(nominal - nominal_dibayar) as total')->from('piutang_history')->where('sudah_lunas ="0"')->get()->row(); 
}

public function listbelum(){ 
  $this->db->select("a.kode_item, a.tanggal_pembayaran,a.total_bayar,  a.keterangan,b.nama_penjual");
  $this->db->from("tabel_pembayaran a");
  $this->db->join('master_item b', 'a.kode_item = b.kode_item ');  
  $this->db->where('a.status_bayar', '0');
  // $this->db->where('a.tanggal_pembayaran <= ', date('Y-m-d',strtotime('+15 days')));  
  return $this->db->get()->result();
}
public function get_produk_terlaris(){ 
 $this->db->select("SUM(a.kuantiti) as total, a.kode_item,  b.nama_item");
 $this->db->from("penjualan_detail a");
 $this->db->join('master_item b', 'a.kode_item = b.kode_item ');   
 $this->db->group_by("a.kode_item");
 $this->db->order_by("total","DESC");
 $this->db->limit(20);
 return $this->db->get()->result();
}
public function rulescatatan()
{
  return [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required',
    ]
  ];
}
function simpancatatan(){
  $post = $this->input->post();
  $this->isi = $post["isi"];
  return $this->db->update("notes", $this, array('id' => '1'));
}

}
