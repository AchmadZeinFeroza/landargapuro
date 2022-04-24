<?php
class Laporan_model extends CI_Model{   

// datatable perijinan start
    var $column_search_perijinan = array('id_penyelesaian','id_perumahan','luas_daftar','luas_terbit','tgl_terbit_ijin'); 
    var $column_order_perijinan = array(null, 'id_penyelesaian','id_perumahan','luas_daftar','luas_terbit','tgl_terbit_ijin');
    var $order_perijinan = array('waktu_update' => 'DESC');
    private function _get_query_perijinan($id)
    { 
        $get = $this->input->get();
        $this->db->select('a.*,b.nama_regional');
        $this->db->from('master_penyelesaian_ijin a'); 
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->where('id_perumahan', $id);
        $i = 0; 
        foreach ($this->column_search_perijinan as $perijinan)
        {
            if($get['search']['value'])
            { 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($perijinan, $get['search']['value']);
                }
                else
                {
                    $this->db->or_like($perijinan, $get['search']['value']);
                }

                if(count($this->column_search_perijinan) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        } 
        if(isset($get['order'])) 
        {
            $this->db->order_by($this->column_order_perijinan[$get['order']['0']['column']], $get['order']['0']['dir']);
        } 
        else if(isset($this->order_perijinan))
        {
            $order = $this->order_perijinan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_perijinan_datatable($id)
    {
        $get = $this->input->get();
        $this->_get_query_perijinan($id);
        if($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_perijinan($id)
    {
        $this->_get_query_perijinan($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_perijinan($id)
    {
        $this->db->from('master_penyelesaian_ijin');
        $this->db->where('id_perumahan', $id);

        return $this->db->count_all_results();
    } 
    //datatable perijinan end
    public function getdataijinlokasi()
    {
       $this->db->from('master_penyelesaian_ijin a'); 
       $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
       $this->db->where('nomor_ijin != ""');
       return $this->db->get()->result();
   }
    //CRUD perijinan start
   public function rules_perijinan()
   {
    return [
        [
            'field' => 'id_perumahan',
            'label' => 'Nama perijinan',
            'rules' => 'required',
        ], 
    ];
} 
public function rules_perijinanedit()
{
    return [
        [
            'field' => 'id_perumahan',
            'label' => 'Nama perijinan',
            'rules' => 'required',
        ], 
    ];
} 
function simpandata_perijinan(){   
    $post = $this->input->post();   
    $array = array(
        'id_perumahan'=>$post["id_perumahan"], 
        'titik_koordinat'=> xarr($post, 'titik_koordinat'), 
        'luas_daftar'=> xarr($post, 'luas_daftar'),  
        'luas_terbit'=>$post["luas_terbit"],  
        'daftar_online_oss'=> xarr($post, 'daftar_online_oss'),  
        'tgl_daftar_pertimbangan'=> xarr($post, 'tgl_daftar_pertimbangan'),  
        'no_berkas_pertimbangan'=> xarr($post, 'no_berkas_pertimbangan'),  
        'tgl_terbit_pertimbangan'=> xarr($post, 'tgl_terbit_pertimbangan'),  
        'nomor_sk_pertimbangan'=> xarr($post, 'nomor_sk_pertimbangan'),  
        'tgl_daftar_tata_ruang'=> xarr($post, 'tgl_daftar_tata_ruang'),  
        'tgl_terbit_tata_ruang'=> xarr($post, 'tgl_terbit_tata_ruang'),  
        'nomor_surat_tata_ruang'=> xarr($post, 'nomor_surat_tata_ruang'),    
        'tgl_daftar_ijin'=> xarr($post, 'tgl_daftar_ijin'),  
        'tgl_terbit_ijin'=>$post["tgl_terbit_ijin"],  
        'nomor_ijin'=>$post["nomor_ijin"],  
        'masa_berlaku_ijin'=>$post["masa_berlaku_ijin"],  
        'keterangan'=>$post["keterangan"] 
    );
    return $this->db->insert("master_penyelesaian_ijin", $array);  
}    

public function updatedata_perijinan()
{
    $post = $this->input->post();
    $this->id_perumahan = ($post["id_perumahan"]); 
    $this->titik_koordinat = ($post["titik_koordinat"]); 
    $this->luas_daftar = ($post["luas_daftar"]); 
    $this->luas_terbit = ($post["luas_terbit"]); 
    $this->daftar_online_oss = ($post["daftar_online_oss"]); 
    $this->tgl_daftar_pertimbangan = ($post["tgl_daftar_pertimbangan"]); 
    $this->no_berkas_pertimbangan = bilanganbulat($post["no_berkas_pertimbangan"]); 
    $this->tgl_terbit_pertimbangan = bilanganbulat($post["tgl_terbit_pertimbangan"]); 
    $this->nomor_sk_pertimbangan = bilanganbulat($post["nomor_sk_pertimbangan"]); 
    $this->tgl_daftar_tata_ruang = ($post["tgl_daftar_tata_ruang"]); 
    $this->tgl_terbit_tata_ruang = bilanganbulat($post["tgl_terbit_tata_ruang"]); 
    $this->nomor_surat_tata_ruang = ($post["nomor_surat_tata_ruang"]); 
    $this->tgl_daftar_ijin = bilanganbulat($post["tgl_daftar_ijin"]); 
    $this->tgl_terbit_ijin = ($post["tgl_terbit_ijin"]); 
    $this->nomor_ijin = bilanganbulat($post["nomor_ijin"]); 
    $this->masa_berlaku_ijin = ($post["masa_berlaku_ijin"]); 
    $this->keterangan = ($post["keterangan"]); 
    return $this->db->update("master_penyelesaian_ijin", $this, array('id_penyelesaian' => $post['idd']));
}
public function get_rekapproses_perijinan($id='',$firstdate='',$lastdate='',$terbit='')
{
    $this->db->select('count(id_penyelesaian) as jumlah,sum(luas_daftar) as luas,sum(luas_terbit) as luas_terbit');
    $this->db->from('master_penyelesaian_ijin a'); 
    $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
    if(!empty($firstdate) AND !empty($lastdate)){
        $this->db->where('a.daftar_online_oss BETWEEN "'.$firstdate. '" and "'. $lastdate.'"');
    }
    if (!empty($id)) {
        $this->db->where('id_perumahan', $id);
    }
    if (empty($terbit)) {
        $this->db->where('tgl_terbit_ijin', '0000-00-00');
    }else{
        $this->db->where('tgl_terbit_ijin !=',  '0000-00-00');
    }
    $jumlah=0;
    $luas=0;
    $luas_terbit=0;
    $hasil = $this->db->get()->result_array()[0];
    if ($hasil['jumlah']!='') {
       $jumlah=$hasil['jumlah'];
   }
   if ($hasil['luas']!='') {
       $luas=$hasil['luas'];
   }
   if ($hasil['luas_terbit']!='') {
       $luas_terbit=$hasil['luas_terbit'];
   }
   return array('luas' => $luas,'jumlah' => $jumlah ,'luas_terbit' => $luas_terbit );
}

public function getdatatarget($id='',$tahun)
{
    $this->db->select('target_bid, target_luas');
    $this->db->from('tbl_target a'); 
    $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
    $this->db->where('id_perumahan', $id);
    $this->db->where('tahun', $tahun.'-01-01');

    $get = $this->db->get();
    if ($get->num_rows()>0) {
        $hasil = $get->result_array()[0];
        $stringbid = substr($hasil['target_bid'], 0, -1);
        $stringluas = substr($hasil['target_luas'], 0, -1);
        $bid=explode(';', $stringbid);
        $luas=explode(';', $stringluas);
        return array('luas' => $luas,'bid' => $bid);
    }
    else{
        return array('luas' => 0,'bid' => 0);
    }
}

public function getrealisasi($id,$sebelum,$sesudah)
{
    $this->db->select("count(kode_item) as bid,sum(luas_surat) as luas");
    $this->db->where('id_perumahan', $id);
    $this->db->where('tanggal_pembelian BETWEEN "'.$sebelum.'" and "'.$sesudah.'"');
    $this->db->from('master_item');
    $hasil = $this->db->get();
    if ($hasil->num_rows()>0) {
       return $hasil->result_array()[0];
   }else{
    return array('luas' => 0,'bid' => 0 );;
}
}
function getrowspo($params = array()){ 
    $this->db->select("a.nomor_po, a.tgl_po, a.termin,
     a.pembayaran, a.target, a.total, a.keterangan, b.nama_target");
    $this->db->from("purchase_order a");
    $this->db->join('tbl_target b', 'b.id = a.target');   
    if(!empty($params['search']['target'])){
        $this->db->where('a.target',$params['search']['target']);
    } 
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tgl_po BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.tgl_po','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
}

function getrowspembelian($params = array()){ 
    $this->db->select("a.nomor_faktur, a.tgl_pembelian, a.termin,
     a.pembayaran, a.target, a.total, a.keterangan, b.nama_target");
    $this->db->from("pembelian_langsung a");
    $this->db->join('tbl_target b', 'b.id = a.target');   
    if(!empty($params['search']['target'])){
        $this->db->where('a.target',$params['search']['target']);
    } 
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tgl_pembelian BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.tgl_pembelian','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
} 
function getrowspenerima($params = array()){ 
    $this->db->select("*");
    $this->db->from("penerimaan_barang"); 
    if(!empty($params['search']['penerima'])){
        $this->db->where('penerima',$params['search']['penerima']);
    } 
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('tanggal_penerimaan BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('tanggal_penerimaan','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
}


function getrowsstok($params = array()){ 
    $this->db->select("a.kode_item, a.tanggal, a.jumlah_masuk, a.jenis_transaksi,
     a.jumlah_keluar, a.satuan_kecil, a.tgl_expired, b.nama_item");
    $this->db->from("kartu_stok a");
    $this->db->join('master_item b', 'b.kode_item = a.kode_item');    
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tanggal BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.jumlah_keluar','desc'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
}

function getrowspenjualan($params = array(),$status=''){ 
    $this->db->select("a.total_upah_peracik, c.harga,c.kuantiti, a.total_harga_item, c.total,
        a.tanggal, a.id, d.nama_item,d.harga_beli, c.stok_sisa,b.nama_admin");
    $this->db->from("penjualan a");
        // $this->db->join('master_penjual b', 'b.id = a.id_penjual');   
    $this->db->join('master_admin b', 'a.id_admin = b.id');  
    $this->db->join('penjualan_detail c', 'c.id_penjualan = a.id');  
    $this->db->join('master_item d', 'd.kode_item = c.kode_item');  
    if ($status!='') {
        $this->db->where('a.status_penjualan', $status);
    }
    if(!empty($params['search']['kasir'])){
        $this->db->where('a.id_admin',$params['search']['kasir']);
    } 
    if(!empty($params['search']['obat'])){
        $this->db->where('c.kode_item',$params['search']['obat']);
    } 
    if(!empty($params['search']['costumer'])){
        $this->db->where('a.id_pembeli',$params['search']['costumer']);
    } 
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tanggal BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.tanggal_jam','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
} 


function getrowskeuangan($params = array()){ 
    $this->db->select("a.kode_rekening, a.tanggal, a.masuk, a.keluar,
     a.keterangan, b.nama_rekening ");
    $this->db->from("cash_in_out a");
    $this->db->join('rekening_kode b', 'b.kode_rekening = a.kode_rekening');    
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tanggal BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.tanggal','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
}


function getrowpenjual($params = array()){ 
    $this->db->select("a.id_komisi, a.id_penjualan, a.tgl_transaksi,
     b.nama_penjual, a.total, b.kontak, c.komisi, c.jumlah, d.nama_item");
    $this->db->from("master_komisi a");
    $this->db->join('master_penjual b','a.id_komisi = b.id'); 
    $this->db->join('komisi_detail c','a.id_komisi = c.id_komisi');
    $this->db->join('master_item d','c.id_barang = d.kode_item');   
    if(!empty($params['search']['penjual'])){
        $this->db->where('a.id_penjual',$params['search']['penjual']);
    } 
    if(!empty($params['search']['firstdate']) AND !empty($params['search']['lastdate'])){
        $this->db->where('a.tgl_transaksi BETWEEN "'.$params['search']['firstdate']. '" and "'. $params['search']['lastdate'].'"');
    }
    $this->db->order_by('a.tgl_transaksi','ASC'); 
    if(empty($params['kategori']['excel']) OR $params['kategori']['excel'] != 'excel'){
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        } 
    }

    $query = $this->db->get(); 
    return $query->result_array();
} 


    // datatable purchase order start
function getallsplitsing(){   
    $tombolhapus = level_user('pembelian','splitsing',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="$2">Hapus</a></li>':'';
    $tomboledit = level_user('pembelian','splitsing',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="$2">Edit</a></li>':'';

    $this->datatables->select('nomor_splitsing,tgl_splitsing,pembayaran,
      termin,id,nama_supplier');
    $this->datatables->from('purchase_order');
    $this->datatables->join('master_supplier', 'supplier=id');
    $this->datatables->add_column('tombol', 
      ' <div class="btn-group dropup">
      <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
      <ul class="dropdown-menu" role="menu">
      <li><a href="#" onclick="detail(this)"  data-id="$2">Detail</a></li>
      '.$tomboledit.'
      '.$tombolhapus.'
      </ul>
      </div>
      ','tgl_splitsing,nomor_splitsing,pembayaran,nama_supplier,termin'); 
    $this->datatables->edit_column('tgl_splitsing','$1', 'tgl_indo(tgl_splitsing)'); 
    return $this->datatables->generate();
}  
    // datatable purchase order end 

    // CRUD purchase order start 
public function get_splitsing($idd){ 
    $this->db->select("a.nomor_splitsing, a.tgl_splitsing, a.total, a.termin, a.pembayaran, a.supplier, a.keterangan, b.nama_supplier, b.telesplitsingn, b.alamat");
    $this->db->from("purchase_order a");
    $this->db->join('master_supplier b', 'a.supplier = b.id'); 
    $this->db->where('a.nomor_splitsing', $idd,'1'); 
    return $this->db->get()->result_array();
}  

private function _kode_splitsing()
{ 
    $jumlah = $this->db->select('*')->from('purchase_order')->get()->num_rows();
    $jml_baru = $jumlah + 1; 
    $kode = sprintf("%04s", $jml_baru);
    $kode = "splitsing".date('dmy').$kode;
    $cek_ada = $this->db->select('*')->from('purchase_order')->where('nomor_splitsing ="'. $kode.'"')->get()->num_rows();
    if($cek_ada > 0){
        return $this->_kode_splitsing();
    }else{
        return $kode ;
    } 
}

public function detail_splitsing($idd){ 
    return $this->db->get_where('purchase_order_detail', array('nomor_splitsing' => $idd)); 
} 
public function data_profil(){ 
    return $this->db->get_where('profil_asplitsingtek', array('id' => '1')); 
}  
public function rulessplitsing()
{
    return [
        [
            'field' => 'kode_item',
            'label' => 'kode_item',
            'rules' => 'required',
        ] ,
        [
            'field' => 'termin',
            'label' => 'Termin',
            'rules' => 'required',
        ] 
    ];
} 

function splitsingvalid($nomor_splitsing){   
    return  $this->db->get_where(
        'purchase_order',array(
            'nomor_splitsing' => $nomor_splitsing, 
        )
    ); 
}   

function simpandataprosesinduk(){   
    $post = $this->input->post();
    $this->db->trans_start();
    $array = array(
       'no_gambar'=>$post["no_gambar2"],
       'id_perumahan'=>$post["id_perumahan"],
       'penjual'=>$post["penjual"],
       'no_surat_tanah'=>$post["no_surat_tanah"],
       'nama_surat_tanah'=>$post["nama_surat_tanah"],
       'luas'=>$post["luas"],
       'luas_daftar'=>$post["luas_daftar"],
       'luas_terbit'=>$post["luas_terbit"],
       'tanggal_daftar_sk_hak'=>$post["tanggal_daftar_sk_hak"],
       'no_daftar_sk_hak'=>$post["no_daftar_sk_hak"],
       'tanggal_terbit_sk_hak'=>$post["tanggal_terbit_sk_hak"],
       'no_terbit_sk_hak'=>$post["no_terbit_sk_hak"],
       'tanggal_daftar_shgb'=>$post["tanggal_daftar_shgb"],
       'no_daftar_shgb'=>$post["no_daftar_shgb"],
       'tanggal_terbit_shgb'=>$post["tanggal_terbit_shgb"],
       'no_terbit_shgb'=>$post["no_terbit_shgb"],
       'masa_berlaku_shgb'=>$post["masa_berlaku_shgb"],
       'target_penyelesaian'=>$post["target_penyelesaian"],
       'status'=>$post["status"],
       'keterangan'=>$post["keterangan"],
   );
    $this->db->insert("master_proses_induk", $array);
    $id_proses_induk =  $this->db->insert_id();
    $kode_item = $this->input->post("kode_item");    
    $tgl_proses_induk = $this->input->post("tgl_proses_induk");    
    $keterangandetail = $this->input->post("keterangandetail");    
    $total = 0;
    $detail = array();
    for($i = 0; $i < count($kode_item); $i++){    
        $listitem = array(
            'id_proses_induk'=>$id_proses_induk,  
            'id_master_item'=>$kode_item[$i],  
            'tgl_proses_induk'=>$tgl_proses_induk[$i],  
            'keterangan'=>$keterangandetail[$i],
        );  
        $detail[] = $listitem;
        $this->db->insert("tbl_dtl_proses_induk", $listitem);  
    } 
    if($this->db->trans_status() === FALSE){
        return false;
        $this->db->trans_rollback();
    }else{
     $this->db->trans_complete();
     return true;
 }
}    



public function updatedataprosesinduk()
{
    $post = $this->input->post();   
    $this->penjual = $post["penjual"];
    $this->no_gambar = $post["no_gambar2"];
    $this->no_surat_tanah = $post["no_surat_tanah"];
    $this->nama_surat_tanah = $post["nama_surat_tanah"];
    $this->luas = $post["luas"];
    $this->luas_daftar = $post["luas_daftar"];
    $this->luas_terbit = $post["luas_terbit"];
    $this->tanggal_daftar_sk_hak = $post["tanggal_daftar_sk_hak"];
    $this->no_daftar_sk_hak = $post["no_daftar_sk_hak"];
    $this->tanggal_terbit_sk_hak = $post["tanggal_terbit_sk_hak"];
    $this->no_terbit_sk_hak = $post["no_terbit_sk_hak"];
    $this->tanggal_daftar_shgb = $post["tanggal_daftar_shgb"];
    $this->no_daftar_shgb = $post["no_daftar_shgb"];
    $this->tanggal_terbit_shgb = $post["tanggal_terbit_shgb"];
    $this->no_terbit_shgb = $post["no_terbit_shgb"];
    $this->masa_berlaku_shgb = $post["masa_berlaku_shgb"];
    $this->target_penyelesaian = $post["target_penyelesaian"];
    $this->status = $post["status"];
    $this->keterangan = $post["keterangan"];
    $this->db->update("master_proses_induk", $this, array('id_proses_induk' => $post['idd']));
    $this->db->where('id_proses_induk', $post['idd'])->delete('tbl_dtl_proses_induk');  
    $id_proses_induk =   $post['idd'];
    $kode_item = $this->input->post("kode_item");    
    $tgl_proses_induk = $this->input->post("tgl_proses_induk");    
    $keterangandetail = $this->input->post("keterangandetail");    
    $total = 0;
    $detail = array();
    for($i = 0; $i < count($kode_item); $i++){    
        $listitem = array(
            'id_proses_induk'=>$id_proses_induk,  
            'id_master_item'=>$kode_item[$i],  
            'tgl_proses_induk'=>$tgl_proses_induk[$i],  
            'keterangan'=>$keterangandetail[$i],
        );  
        $detail[] = $listitem;
        $this->db->insert("tbl_dtl_proses_induk", $listitem);  
    } 
    return TRUE;
}

public function hapusdataprosesinduk()
{
    $post = $this->input->post();  
    $this->db->where('id_proses_induk', $post['idd']);
    return $this->db->delete('master_proses_induk');  
}
    // CRUD purchase order end
public function getmaster_split($id_perumahan,$firstdate='',$lastdate='')
{
   $this->db->select('a.*');
   $this->db->from('master_split a'); 
   $this->db->join('master_proses_induk b', 'a.id_proses_induk = b.id_proses_induk', 'left');
   $this->db->where('b.id_perumahan', $id_perumahan);
   if(!empty($firstdate) AND !empty($lastdate)){
    $this->db->where('b.tanggal_terbit_shgb BETWEEN "'.$firstdate. '" and "'. $lastdate.'"');
}

// if (!empty($sudah)) {
//     $this->db->where('status', 'terbit');
// }else{
//     $this->db->where('status', 'belum');
// }

return $this->db->get()->result();
}


function simpandataprosessplit(){   
    $post = $this->input->post();
    $this->db->trans_start();
    $array = array(
       'id_proses_induk'=>$post["id_proses_induk"],
       'masa_berlaku_split'=>$post["masa_berlaku_blok"],
       'tgl_daftar_split'=>$post["tgl_daftar_blok"],
       'no_berkas_split'=>$post["no_berkas"],
       'keterangan'=>$post["keterangan"],
   );
    $this->db->insert("master_split", $array);
    $id_split =  $this->db->insert_id();
    $id_stok_split = $this->input->post("id_stok_split");    
    $luas_daftar_blok = $this->input->post("luas_daftar_blok"); 
    $no_shgb_blok = $this->input->post("no_terbit_shgb");
    $masa_berlaku_blok = $this->input->post("masa_berlaku_blok");    
    $tgl_daftar_blok = $this->input->post("tgl_daftar_blok");    
    $keterangandetail = $this->input->post("keterangandetail"); 
    $detail = array();
    for($i = 0; $i < count($id_stok_split); $i++){
        $listitem = array(
            'id_split'=>$id_split,  
            'id_stok_split'=>$id_stok_split[$i],  
            'luas_daftar_blok'=>$luas_daftar_blok[$i],  
            'no_shgb_blok'=>$no_shgb_blok,  
            'masa_berlaku_blok'=>$masa_berlaku_blok,    
            'tgl_daftar_blok'=>$tgl_daftar_blok,  
            'no_daftar_blok'=>$post['no_berkas'],  
            'keterangan'=>$keterangandetail[$i],
        );  
        $detail[] = $listitem;
        $this->db->insert("tbl_dtl_split", $listitem);  
    } 
    if($this->db->trans_status() === FALSE){
        return false;
        $this->db->trans_rollback();
    }else{
     $this->db->trans_complete();
     return true;
 }
}    
public function updatedataprosessplit()
{
    $post = $this->input->post();
    $id_split =  $post["idd"];
    $this->db->trans_start();
    $id_stok_split = $this->input->post("id_stok_split");    
    $luas_daftar_blok = $this->input->post("luas_daftar_blok"); 
    $luas_terbit_blok = $this->input->post("luas_terbit_blok"); 
    $no_shgb_blok = $this->input->post("no_terbit_shgb");
    $masa_berlaku_blok = $this->input->post("masa_berlaku_blok");    
    $tgl_daftar_blok = $this->input->post("tgl_daftar_blok");    
    $tgl_terbit_blok = $this->input->post("tgl_terbit_blok");    
    $keterangandetail = $this->input->post("keterangandetail"); 
    $array = array(
        'id_proses_induk'=>$post["id_proses_induk"],
        'masa_berlaku_split'=>$post["masa_berlaku_blok"],
        'tgl_daftar_split'=>$post["tgl_daftar_blok"],
        'no_berkas_split'=>$post["no_berkas"],
        'keterangan'=>$post["keterangan"],
    );
    $this->db->where('id_split', $id_split);
    $this->db->update("master_split", $array);
    $this->db->where('id_split', $id_split);
    $this->db->delete('tbl_dtl_split');
    
    $detail = array();
    for($i = 0; $i < count($id_stok_split); $i++){
        $listitem = array(
            'id_split'=>$id_split,  
            'id_stok_split'=>$id_stok_split[$i],  
            'luas_daftar_blok'=>$luas_daftar_blok[$i],  
            'luas_terbit_blok'=>$luas_terbit_blok[$i],  
            'no_shgb_blok'=>$no_shgb_blok,  
            'masa_berlaku_blok'=>$masa_berlaku_blok,    
            'tgl_daftar_blok'=>$tgl_daftar_blok,  
            'no_daftar_blok'=>$post['no_berkas'],  
            'tgl_terbit_blok'=>$tgl_terbit_blok[$i],  
            'keterangan'=>$keterangandetail[$i],
        );  
        $detail[] = $listitem;
        $this->db->insert("tbl_dtl_split", $listitem);  
    } 
    if($this->db->trans_status() === FALSE){
        return false;
        $this->db->trans_rollback();
    }else{
     $this->db->trans_complete();
     return true;
 }
}

public function hapusdataprosessplit()
{
    $post = $this->input->post();  
    $this->db->where('id_proses_split', $post['idd']);
    return $this->db->delete('master_proses_split');  
}
    // CRUD purchase order end

    //datatable pembelian start
function getallpembelian(){   
    $tombolhapus = level_user('pembelian','langsung',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="$2">Hapus</a></li>':'';
    $tomboledit = level_user('pembelian','langsung',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="$2">Edit</a></li>':'';
    $this->datatables->select('nomor_faktur,tgl_pembelian,pembayaran,
      termin,id,nama_supplier');
    $this->datatables->from('pembelian_langsung');
    $this->datatables->join('master_supplier', 'supplier=id');
    $this->datatables->add_column('tombol', 
      ' <div class="btn-group dropup">
      <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
      <ul class="dropdown-menu" role="menu">
      <li><a href="#" onclick="detail(this)"  data-id="$2">Detail</a></li>
      '.$tombolhapus.'
      </ul>
      </div>
      ','tgl_pembelian,nomor_faktur,pembayaran,nama_supplier,termin'); 
    $this->datatables->edit_column('tgl_pembelian','$1', 'tgl_indo(tgl_pembelian)'); 
    return $this->datatables->generate();
}   
    //datatable pembelian end
    public function perijinan_detail($id)
    {
        $this->db->select('a.*,b.nama_regional');
        $this->db->from('master_penyelesaian_ijin a'); 
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->where('id_perumahan', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function dataijinlokasi($id = '')
    {
       $this->db->from('master_penyelesaian_ijin a'); 
       $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
       $this->db->where('nomor_ijin != ""');
       $this->db->where('a.id_perumahan' , $id);
       return $this->db->get()->result();
    }
}