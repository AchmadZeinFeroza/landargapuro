<?php

use SebastianBergmann\Environment\Console;

defined('BASEPATH') OR exit('No direct script access allowed');
class Stok extends CI_Controller {   
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login') != TRUE){    
            redirect(base_url('login'));
        }    
        $this->load->model('stok_model');
        $this->load->library('form_validation');
        $this->load->helper(array('string','security','form'));
    }
    public function index()
    {   
        level_user('stok','index',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $this->load->view('member/stok/beranda');
    } 
    public function keluar()
    {    
        level_user('stok','keluar',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $data['retur'] = $this->db->get('retur_pembelian')->result(); 
        $this->load->view('member/stok/keluar',$data);
    }   

    public function stokkeluar()
    {    
        cekajax();
        $get = $this->input->get();
        $list = $this->stok_model->get_stokkeluar_datatable();
        $data = array(); 
        foreach ($list as $r) { 
            $row = array(); 
            $tombolhapus = level_user('stok','keluar',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-kodeitem="'.$this->security->xss_clean($r->kode_item).'"  data-kuantiti="'.$this->security->xss_clean($r->kuantiti).'" data-id="'.$r->id.'" >Hapus</a></li>':'';

            $row[] = ' 
            <div class="btn-group dropup">
            <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
            <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="detail(this)" data-id="'.$r->id.'">Detail</a></li> 
            '.$tombolhapus.'
            </ul>
            </div> 
            ';
            $row[] = $this->security->xss_clean(tgl_indo($r->tanggal));
            $row[] = $this->security->xss_clean($r->nomor_ref);
            $row[] = $this->security->xss_clean($r->nomor_retur_pembelian); 
            $row[] = $this->security->xss_clean($r->kode_item);
            $row[] = $this->security->xss_clean($r->nama_item);
            $row[] = $this->security->xss_clean($r->kuantiti);
            $row[] = $this->security->xss_clean($r->satuan_kecil);
            $data[] = $row; 
        } 
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->stok_model->count_all_datatable_stokkeluar(),
            "recordsFiltered" => $this->stok_model->count_filtered_datatable_stokkeluar(),
            "data" => $data,
        ); 
        echo json_encode($result);
    }    
    public function stokkeluartambah(){ 
        cekajax(); 
        $post = $this->input->post();   
        $simpan = $this->stok_model;
        $validation = $this->form_validation; 
        $validation->set_rules($simpan->rulesstokkeluar());
        if ($this->form_validation->run() == FALSE){
         $errors = $this->form_validation->error_array();
         $data['errors'] = $errors;
     }else{            
        $kode_item = $this->input->post("kode_item"); 
        $nama_item = $this->input->post("nama_item"); 
        if(isset($kode_item) === TRUE AND $nama_item !='')
        { 
            $cek = $this->db->select('*')->from('retur_detail')->where('kode_item ="'.$kode_item.'" AND tgl_expired="'.$post['tgl_expired'].'"')->get()->num_rows();
            if($cek > 0){              
               if($simpan->simpandatastokkeluar()){ 
                  $data['success']= true;
                  $data['message']="Berhasil menyimpan data";  
              }else{
                  $errors['fail'] = "gagal melakukan update data";
                  $data['errors'] = $errors;
              }					
          }else{  
            $errors['kode_item'] = "Data tidak sesuai dengan database retur pembelian";
            $errors['tgl_expired'] = "Data tidak sesuai dengan database retur pembelian";
            $data['errors'] = $errors;
        }  
    }
    else{ 
        $errors['kode_item'] = "Mohon pilih item";
        $data['errors'] = $errors;
    }
}
$data['token'] = $this->security->get_csrf_hash();
echo json_encode($data); 
}

public function stokkeluardetail(){  
    cekajax(); 
    $idd = intval($this->input->get("id")); 
    $query = $this->db->get_where('stok_keluar', array('id' => $idd),1);
    $result = array(    
        "tanggal" => $this->security->xss_clean(tgl_indo($query->row()->tanggal)),
        "nomor_ref" => $this->security->xss_clean($query->row()->nomor_ref),
        "nomor_retur_pembelian" => $this->security->xss_clean($query->row()->nomor_retur_pembelian),
        "kuantiti" => $this->security->xss_clean(bilanganbulat($query->row()->kuantiti)),
        "kode_item" => $this->security->xss_clean($query->row()->kode_item),
        "nama_item" => $this->security->xss_clean($query->row()->nama_item),
        "tgl_expired" => $this->security->xss_clean(tgl_indo($query->row()->tgl_expired)), 
        "satuan_kecil" => $this->security->xss_clean($query->row()->satuan_kecil),
        "keterangan" => $this->security->xss_clean($query->row()->keterangan),
    );    
    echo'['.json_encode($result).']';
}
public function stokkeluarhapus(){ 
    cekajax(); 
    $hapus = $this->stok_model;
    if($hapus->hapusdatastokkeluar()){ 
        $data['success']= true;
        $data['message']="Berhasil menghapus data"; 
    }else{    
        $errors['fail'] = "gagal menghapus data";
        $data['errors'] = $errors;
    }
    $data['token'] = $this->security->get_csrf_hash();
    echo json_encode($data); 
}

public function adjustment()
{   
    level_user('stok','adjustment',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $this->load->view('member/stok/adjustment');
}  
public function stokadjustment()
{    
    cekajax();
    $get = $this->input->get();
    $list = $this->stok_model->get_stokadjustment_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $row = array(); 
        $tombolhapus = level_user('stok','adjustment',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-kodeitem="'.$r->kode_item.'"   data-kuantiti="'.$r->kuantiti_berubah.'" data-id="'.$r->id.'">Hapus</a></li>':'';

        $row[] = '  
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="'.$r->id.'">Detail</a></li>
        '.$tombolhapus.'

        </ul>
        </div>
        ';
        $row[] = $this->security->xss_clean(tgl_indo($r->tanggal));
        $row[] = $this->security->xss_clean($r->nomor_ref);
        $row[] = $this->security->xss_clean($r->kode_item); 
        $row[] = $this->security->xss_clean($r->nama_item);
        $row[] = $this->security->xss_clean(tgl_indo($r->tgl_expired));
        $row[] = $this->security->xss_clean($r->kuantiti_berubah);
        $row[] = $this->security->xss_clean($r->satuan_kecil);
        $data[] = $row;  
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_stokadjustment(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_stokadjustment(),
        "data" => $data,
    ); 
    echo json_encode($result);
}    
public function stokadjustmentdetail(){  
    cekajax(); 
    $idd = intval($this->input->get("id")); 
    $query = $this->db->get_where('stok_adjustment', array('id' => $idd),1);
    $result = array(    
        "tanggal" => $this->security->xss_clean(tgl_indo($query->row()->tanggal)),
        "nomor_ref" => $this->security->xss_clean($query->row()->nomor_ref),
        "stok_sebelum" => $this->security->xss_clean(bilanganbulat($query->row()->stok_sebelum)),
        "kuantiti_berubah" => $this->security->xss_clean(bilanganbulat($query->row()->kuantiti_berubah)),
        "kode_item" => $this->security->xss_clean($query->row()->kode_item),
        "nama_item" => $this->security->xss_clean($query->row()->nama_item),
        "tgl_expired" => $this->security->xss_clean(tgl_indo($query->row()->tgl_expired)), 
        "satuan_kecil" => $this->security->xss_clean($query->row()->satuan_kecil),
        "keterangan" => $this->security->xss_clean($query->row()->keterangan),
    );    
    echo'['.json_encode($result).']';
}


public function stokadjustmenttambah(){ 
    cekajax();  
    $post = $this->input->post();   
    $simpan = $this->stok_model;
    $validation = $this->form_validation; 
    $validation->set_rules($simpan->rulesstokadjustment());
    if ($this->form_validation->run() == FALSE){
     $errors = $this->form_validation->error_array();
     $data['errors'] = $errors;
 }else{            
    $kode_item = $this->input->post("kode_item"); 
    $nama_item = $this->input->post("nama_item"); 
    if(isset($kode_item) === TRUE AND $nama_item !='')
    { 
        $cek = $this->db->select('*')->from('kartu_stok')->where('kode_item ="'.$kode_item.'" AND tgl_expired="'.$post['tgl_expired'].'"')->get();
        if($cek->num_rows() > 0){              
            $masuk = $this->db->select('SUM(jumlah_masuk) as total')->from('kartu_stok')->where('kode_item ="'.$kode_item.'" AND tgl_expired="'.$post['tgl_expired'].'"')->get()->row();
            $keluar = $this->db->select('SUM(jumlah_keluar) as total')->from('kartu_stok')->where('kode_item ="'.$kode_item.'" AND tgl_expired="'.$post['tgl_expired'].'"')->get()->row();
            $total = $masuk->total - $keluar->total ;
            $sisa = $total - $post["kuantiti_berubah"];
            if($sisa < 0 )
            { 
                $errors['kode_item'] = "Data tidak sesuai dengan database stok";
                $errors['tgl_expired'] = "Data tidak sesuai dengan database stok";
                $data['errors'] = $errors;
            }else{ 
                if($simpan->simpandatastokadjustment()){
                    $data['success']= true;
                    $data['message']="Berhasil menyimpan data";   
                }else{
                    $errors['fail'] = "gagal melakukan update data";
                    $data['errors'] = $errors;
                }
            }

        }else{  
            $errors['kode_item'] = "Data tidak sesuai dengan database stok";
            $errors['tgl_expired'] = "Data tidak sesuai dengan database stok";
            $data['errors'] = $errors;
        }  
    }
    else{ 
        $errors['kode_item'] = "Mohon pilih item";
        $data['errors'] = $errors;
    }
}
$data['token'] = $this->security->get_csrf_hash();
echo json_encode($data); 
}
public function stokadjustmenthapus(){ 
    cekajax(); 
    $hapus = $this->stok_model;
    if($hapus->hapusdatastokadjustment()){ 
        $data['success']= true;
        $data['message']="Berhasil menghapus data"; 
    }else{    
        $errors['fail'] = "gagal menghapus data";
        $data['errors'] = $errors;
    }
    $data['token'] = $this->security->get_csrf_hash();
    echo json_encode($data); 
}

public function opname()
{   
    level_user('stok','opname',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $this->load->view('member/stok/opname');
}  

public function stokopname()
{    
    cekajax();
    $get = $this->input->get();
    $list = $this->stok_model->get_stokopname_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $row = array(); 
        $tombolhapus = level_user('stok','opname',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)"data-kodeitem="'.$r->kode_item.'"  data-kuantiti="'.$r->kuantiti_berubah.'" data-id="'.$r->id.'">Hapus</a></li>':'';
        $row[] = '  
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="'.$r->id.'">Detail</a></li> 
        '.$tombolhapus.' 
        </ul>
        </div>
        ';
        $row[] = $this->security->xss_clean(tgl_indo($r->tanggal));
        $row[] = $this->security->xss_clean($r->nomor_ref);
        $row[] = $this->security->xss_clean($r->kode_item); 
        $row[] = $this->security->xss_clean($r->nama_item);
        $row[] = $this->security->xss_clean(tgl_indo($r->tgl_expired));
        $row[] = $this->security->xss_clean($r->kuantiti_berubah);
        $row[] = $this->security->xss_clean($r->satuan_kecil);
        $data[] = $row;  
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_stokopname(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_stokopname(),
        "data" => $data,
    ); 
    echo json_encode($result);
}     
public function stokopnamedetail(){  
    cekajax(); 
    $idd = intval($this->input->get("id")); 
    $query = $this->db->get_where('stok_opname', array('id' => $idd),1);
    $result = array(    
        "tanggal" => $this->security->xss_clean(tgl_indo($query->row()->tanggal)),
        "nomor_ref" => $this->security->xss_clean($query->row()->nomor_ref),
        "stok_sebelum" => $this->security->xss_clean(bilanganbulat($query->row()->stok_sebelum)),
        "kuantiti_berubah" => $this->security->xss_clean(bilanganbulat($query->row()->kuantiti_berubah)),
        "kode_item" => $this->security->xss_clean($query->row()->kode_item),
        "nama_item" => $this->security->xss_clean($query->row()->nama_item),
        "tgl_expired" => $this->security->xss_clean(tgl_indo($query->row()->tgl_expired)), 
        "satuan_kecil" => $this->security->xss_clean($query->row()->satuan_kecil),
        "keterangan" => $this->security->xss_clean($query->row()->keterangan),
    );    
    echo'['.json_encode($result).']';
}
public function stokopnametambah(){ 
    cekajax(); 
    $simpan = $this->stok_model;
    $validation = $this->form_validation; 
    $validation->set_rules($simpan->rulesstokopname());
    if ($this->form_validation->run() == FALSE){
     $errors = $this->form_validation->error_array();
     $data['errors'] = $errors;
 }else{            
    $kode_item = $this->input->post("kode_item"); 
    $nama_item = $this->input->post("nama_item"); 
    if(isset($kode_item) === TRUE AND $nama_item !='')
    {     
        if($simpan->simpandatastokopname()){ 
           $data['success']= true;
           $data['message']="Berhasil menyimpan data";  
       }else{
           $errors['fail'] = "gagal melakukan update data";
           $data['errors'] = $errors;
       }					
   }
   else{ 
    $errors['kode_item'] = "Mohon pilih item";
    $data['errors'] = $errors;
}
}
$data['token'] = $this->security->get_csrf_hash();
echo json_encode($data); 
}
public function stokopnamehapus(){ 
    cekajax(); 
    $hapus = $this->stok_model;
    if($hapus->hapusdatastokopname()){ 
        $data['success']= true;
        $data['message']="Berhasil menghapus data"; 
    }else{    
        $errors['fail'] = "gagal menghapus data";
        $data['errors'] = $errors;
    }
    $data['token'] = $this->security->get_csrf_hash();
    echo json_encode($data); 
}
public function stokdataverfikasi()
{    
    cekajax();
    $get = $this->input->get();
    $list = $this->stok_model->get_stokdataverfikasi_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $row = array(); 
        $row[] = '   
        <input type="checkbox" name="idstok[]" value="'.$this->security->xss_clean($r->id).'">
        <input type="hidden" name="kode_item[]" value="'.$this->security->xss_clean($r->kode_item).'">
        <input type="hidden" name="kuantiti[]" value="'.$this->security->xss_clean($r->kuantiti_berubah).'">
        <input type="hidden" name="tgl_expired[]" value="'.$this->security->xss_clean($r->tgl_expired).'">
        <input type="hidden" name="tanggal[]" value="'.$this->security->xss_clean($r->tanggal).'">
        <input type="hidden" name="satuan[]" value="'.$this->security->xss_clean($r->satuan_kecil).'">

        ';
        $row[] = $this->security->xss_clean(tgl_indo($r->tanggal));
        $row[] = $this->security->xss_clean($r->nomor_ref);
        $row[] = $this->security->xss_clean($r->kode_item); 
        $row[] = $this->security->xss_clean($r->nama_item);
        $row[] = $this->security->xss_clean(tgl_indo($r->tgl_expired));
        $row[] = $this->security->xss_clean($r->kuantiti_berubah);
        $row[] = $this->security->xss_clean($r->satuan_kecil);
        $data[] = $row;  
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_stokdataverfikasi(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_stokdataverfikasi(),
        "data" => $data,
    ); 
    echo json_encode($result);
} 


public function verfikasistokopname(){ 
    cekajax(); 
    $simpan = $this->stok_model;
    $aksiverifikasi = $this->input->post("aksiverifikasi");    
    $data = array();
    $idstok = $this->input->post("idstok");   
    $kode_item = $this->input->post("kode_item");   
    $kuantiti = $this->input->post("kuantiti");   
    $tanggal = $this->input->post("tanggal");    
    $satuan = $this->input->post("satuan");   
    $tgl_expired = $this->input->post("tgl_expired");   
    if(isset($idstok) === TRUE AND $idstok[0]!=''){
        if($aksiverifikasi == 'hapus'){
            for($i = 0; $i < count($idstok); $i++){
                $this->db->where('id', $idstok[$i])->delete('stok_opname');   
            }
            $data['success']= true;
            $data['message']= "Berhasil menghapus data stok";  
        }
        else{
            for($i = 0; $i < count($idstok); $i++){
                $this->verifikasi = "1"; 
                $this->db->update("stok_opname", $this, array('id' => $idstok[$i]));  
                $list_kartustok = array(
                    'id_stok_opname'=>$idstok[$i],  
                    'kode_item'=>$kode_item[$i],  
                    'tanggal'=>$tanggal[$i],  
                    'jenis_transaksi'=>"stok opname",   
                    'jumlah_masuk'=>$kuantiti[$i],     
                    'tgl_expired'=>$tgl_expired[$i],     
                    'jumlah_keluar'=>0,   
                    'satuan_kecil'=>$satuan[$i]
                ); 
                $this->db->insert("kartu_stok", $list_kartustok); 
                $this->db->set('stok', 'stok + ' . (int) $kuantiti[$i], FALSE)->where('kode_item', $kode_item[$i])->update('master_item');  
            } 
            $data['success']= true;
            $data['message']= "Berhasil verfikasi data stok";  
        }
    }
    else{ 
        $errors['jumlah_item'] = "Mohon pilih item yang ingin divalidasi";
        $data['errors'] = $errors;
    } 
    $data['token'] = $this->security->get_csrf_hash();
    echo json_encode($data); 
} 
public function barcode()
{   
    level_user('stok','barcode',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $this->load->view('member/stok/barcode');
}  
public function dataitems()
{   
    cekajax(); 
    $get = $this->input->get();
    $list = $this->stok_model->get_pilihanitem_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $row = array(); 
        $row[] = $this->security->xss_clean($r->kode_item); 
        $row[] = $this->security->xss_clean($r->nama_item); 
        $row[] = $this->security->xss_clean($r->kategori);  
        $row[] = $this->security->xss_clean(rupiah($r->harga_jual));   
        $row[] = $this->security->xss_clean($r->satuan);  
        $row[] = ' 
        <a onclick="pilih(this)"  data-harga="'.rupiah($r->harga_jual).'" data-stok="'.$r->stok.'" data-satuan="'.$r->satuan.'"  data-namaitem="'.$r->nama_item.'" data-id="'.$r->kode_item.'" class="mt-xs mr-xs btn btn-info datarowobat" role="button"><i class="fa fa-check-square-o"></i></a>

        '; 
        $data[] = $row;
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_pilihanitem(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_pilihanitem(),
        "data" => $data,
    ); 
    echo json_encode($result);  
}
public function viewbarcode()
{        
    level_user('stok','barcode',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $idd = $this->input->post("idd");   
    if(isset($idd) === TRUE AND $idd[0]!=''){  
        $this->load->view('member/stok/viewbarcode');
    }else{
        echo "<script>alert('Tidak ada item yang dipilih'); window.location='".base_url()."stok/barcode'</script>";
    }
} 
public function barcodegenerator()
{ 
    $code = $this->input->get("code"); 
    $this->load->library('zend');
    $this->zend->load('Zend/Barcode'); 
    $barcodeOptions = array('text' => $code);
    $rendererOptions = array('imageType'=>'png');
    Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->render(); 
}

public function kartustok()
{   
    level_user('stok','kartustok',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $data['select_item'] = $this->stok_model->listitem();
    $data['kode_item'] = $this->input->get('kode_item');
    $data['jns_select'] = $this->input->get('jns_select');
    $data['search_jns_select'] = $this->input->get('search_jns_select');
    $this->load->view('member/stok/kartustok',$data);
} 

public function datakartustok()
{   
    cekajax(); 
    $get = $this->input->get();
    $list = $this->stok_model->get_datakartustok_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $row = array(); 
        $row[] = ' 
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="'.$r->kode_item.'">Tampil</a></li>  
        </ul>
        </div>
        ';
        $row[] = $this->security->xss_clean($r->nama_item); 
        $row[] = $this->security->xss_clean($r->tanggal); 
        $keterangan='';
        if ($r->nomor_rec_penerimaan!=null) {
            $keterangan = 'rec penerimaan';
            $this->db->select('ms.nama_supplier,pd.harga');
            $this->db->where('pb.nomor_rec', $r->nomor_rec_penerimaan);
            $this->db->where('pd.kode_item', $r->kode_item);
            $this->db->from('penerimaan_barang pb');
            $this->db->join('purchase_order po', 'pb.nomor_po = po.nomor_po');
            $this->db->join('penerimaan_barang_detail pd', 'pb.nomor_rec = pd.nomor_rec');
            $this->db->join('master_supplier ms', 'po.supplier = ms.id');
            $pembelian=$this->db->get();
            if ($pembelian->num_rows()>0) {
                $pembelian=$pembelian->result_array()[0];
                $keterangan = "Beli di.".$pembelian['nama_supplier'].' '.$pembelian['harga'];
            }
        }
        if ($r->id_utility!=null) {
            $keterangan = 'utility';
        }
        if ($r->id_stok_opname!=null) {
            $keterangan = 'opname';
        }
        if ($r->id_penjualan!=null) {
            $keterangan = 'penjualan';
            $this->db->select('pd.total,p.id_admin');
            $this->db->where('id_penjualan', $r->id_penjualan);
            $this->db->where('kode_item', $r->kode_item);
            $this->db->from('penjualan_detail pd');
            $this->db->join('penjualan p', 'p.id = pd.id_penjualan');
            $penjualan=$this->db->get();
            if ($penjualan->num_rows()>0) {
                $penjualan=$penjualan->result_array()[0];
                $keterangan = "Penj.".$r->id_penjualan." ".$penjualan['total']."/".$r->satuan_kecil."/".$penjualan['id_admin'];
            }
        }
        $row[] = $this->security->xss_clean($keterangan);  
        $row[] = $this->security->xss_clean(bilanganbulat($r->jumlah_masuk));
        $row[] = $this->security->xss_clean(bilanganbulat($r->jumlah_keluar)); 
        $row[] = $this->security->xss_clean(bilanganbulat($r->stok_sisa)); 
        $data[] = $row; 
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_datakartustok(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_datakartustok(),
        "data" => $data,
    ); 
    echo json_encode($result);  
}
public function cekquery($value='')
{
  $this->db->select('pd.total,p.id_admin');
  $this->db->where('id_penjualan', '270520000080');
  $this->db->where('kode_item', '8999909028224');
  $this->db->from('penjualan_detail pd');
  $this->db->join('penjualan p', 'p.id = pd.id_penjualan');
  $penjualan=$this->db->get()->result_array()[0];
  echo "<pre>";
  print_r ($penjualan);
  echo "</pre>";
}
public function viewhtmlkartustok(){ 
    $startdate = $this->input->post("startdate");   
    $enddate = $this->input->post("enddate");   
    $idd = $this->input->post("idd");    
    if(isset($idd) == TRUE AND $idd[0]!=''){        
        $data['total_keluar'] = $this->db->select_sum('jumlah_keluar')->where('kode_item', $idd )->where('tanggal <=', date('Y-m-d', strtotime($startdate)) )->get('kartu_stok')->row()->jumlah_keluar;
        $data['total_masuk'] = $this->db->select_sum('jumlah_masuk')->where('kode_item', $idd )->where('tanggal <=', date('Y-m-d', strtotime($startdate)) )->get('kartu_stok')->row()->jumlah_masuk;
        $data['total_keluar'] = $this->db->where('kode_item', $idd )->where('tanggal <=', date('Y-m-d', strtotime($startdate)) )->get('kartu_stok')->result();
        $data['rincianstok']  = $this->stok_model->rincianstok(); 
        $data['namaproduk']  = $this->stok_model->namaproduk(); 
        $this->load->model('pembelian_model'); 
        $data['profil'] = $this->pembelian_model->data_profil();  
        $this->load->view('member/stok/htmlkartustok',$data);
    }else{
        echo "<script>alert('Tidak ada item yang dipilih'); window.location='".base_url()."stok/kartustok'</script>";
    }
}
public function pdfkartustok()
{
    $startdate = $this->input->post("startdate");   
    $enddate = $this->input->post("enddate");   
    $idd = $this->input->post("idd");    
    if(isset($idd) === TRUE AND $idd[0]!=''){        
        $data['total_keluar'] = $this->db->select_sum('jumlah_keluar')->where('kode_item', $idd )->where('tanggal <=', date('Y-m-d', strtotime($startdate)) )->get('kartu_stok')->row()->jumlah_keluar;
        $data['total_masuk'] = $this->db->select_sum('jumlah_masuk')->where('kode_item', $idd )->where('tanggal <=', date('Y-m-d', strtotime($startdate)) )->get('kartu_stok')->row()->jumlah_masuk;
        $data['rincianstok']  = $this->stok_model->rincianstok(); 
        $data['namaproduk']  = $this->stok_model->namaproduk(); 
        $this->load->model('pembelian_model'); 
        $data['profil'] = $this->pembelian_model->data_profil();  
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $data = $this->load->view('member/stok/pdfkartustok', $data, TRUE);
        $mpdf->setTitle("Kartu Stok");
        $mpdf->WriteHTML($data);
        $mpdf->Output("Kartu Stok.pdf", "D"); 
    }else{
        echo "<script>alert('Tidak ada item yang dipilih'); window.location='".base_url()."stok/kartustok'</script>";
    } 
}

    // utility start
public function utility()
{   
    level_user('stok','utility',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    $data['select_item'] = $this->stok_model->listitem();
    $data['kode_item'] = $this->input->get('kode_item');
    $data['firstdate'] = $this->input->get('firstdate');
    $data['lastdate'] = $this->input->get('lastdate');
    $data['kasir'] = $this->input->get('id_kasir');
    $data['id_admin'] = $this->input->get('id_admin');
    $data['select_kasir'] = $this->stok_model->listkasir();
    $this->load->view('member/stok/utility',$data);
}  
public function stokutility()
{    
    cekajax(); 
    $get = $this->input->get();
    $list = $this->stok_model->get_stokutility_datatable();
    $data = array(); 
    foreach ($list as $r) { 
        $tombolhapus = level_user('stok','adjustment',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-kodeitem="'.$r->kode_item.'"   data-kuantiti="'.$r->jumlah.'" data-id="'.$r->id_utility.'">Hapus</a></li>':'';
        $row = array(); 
        $row[] = '  
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        '.$tombolhapus.'

        </ul>
        </div>
        ';
        $row[] = $this->security->xss_clean(tgl_indo($r->waktu)); 
        $row[] = $this->security->xss_clean($r->nama_item);  
        $row[] = $this->security->xss_clean($r->kode_item."/".$r->no_bet);  
        $row[] = $this->security->xss_clean($r->aksi.$r->jumlah);
        $row[] = $this->security->xss_clean($r->ket_utility);  
        if ($r->aksi=='+') {
            $row[] =$this->security->xss_clean($r->stok_sebelum  + $r->jumlah);  
        } else {
            $row[] =$this->security->xss_clean($r->stok_sebelum  - $r->jumlah);     
        }
        $row[] = $this->security->xss_clean($r->satuan);  
        $data[] = $row; 
    } 
    $result = array(
        "draw" => $get['draw'],
        "recordsTotal" => $this->stok_model->count_all_datatable_stokutility(),
        "recordsFiltered" => $this->stok_model->count_filtered_datatable_stokutility(),
        "data" => $data,
    ); 
    echo json_encode($result);
}    


public function stokutilitytambah(){ 
    cekajax();  
    $this->db->trans_begin();

    $post = $this->input->post();  
    $simpan = $this->stok_model;
    $validation = $this->form_validation; 
    $validation->set_rules($simpan->rulesstokutility());
    if ($this->form_validation->run() == FALSE){
     $errors = $this->form_validation->error_array();
     $data['errors'] = $errors;
 }else{            
    $kode_item = $this->input->post("kode_item"); 
    $nama_item = $this->input->post("nama_item"); 
    if(isset($kode_item) === TRUE AND $nama_item !='')
    { 
        $cek = $this->db->select('*')->from('kartu_stok')->where('kode_item ="'.$kode_item.'"')->get();
        $statcek=false;
        if ($cek->num_rows() <= 0) {
            $this->db->query("INSERT INTO `kartu_stok` (`id`, `nomor_rec_penerimaan`, `id_utility`, `id_stok_opname`, `id_stok_keluar`, `id_penjualan`, `kode_item`, `tanggal`, `jenis_transaksi`, `jumlah_masuk`, `jumlah_keluar`, `satuan_kecil`, `stok_sisa`, `tgl_expired`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, '$kode_item', 'current_timestamp()', 'stok utility', '0', '0', '1', '0', NULL);");
            $statcek=true;
        }
        if($cek->num_rows() > 0||$statcek){              
            $masuk = $this->db->select('SUM(jumlah_masuk) as total')->from('kartu_stok')->where('kode_item ="'.$kode_item.'"')->get()->row();
            $keluar = $this->db->select('SUM(jumlah_keluar) as total')->from('kartu_stok')->where('kode_item ="'.$kode_item.'"')->get()->row();
            $total = $masuk->total - $keluar->total ;
            $aksi = $post["aksi"];
            if ($aksi == '+') {
                $sisa = $total + $post["jumlah"];
            }else{
                $sisa = $total - $post["jumlah"];
            }
            if($sisa < 0 )
            {
                $errors['kode_item'] = "Stok sisa kurang dari 0 (nol)";
                $errors['tgl_expired'] = "Data tidak sesuai dengan database stok 2";
                $data['errors'] = $errors;
            }else{ 
                if($simpan->simpandatastokutility()){
                    $data['success']= true;
                    $data['message']="Berhasil menyimpan data";   
                }else{
                    $data['success']= false;
                    $errors['fail'] = "gagal menyimpan data";
                    $data['errors'] = $errors;
                }
            }
        }else{  
            $errors['kode_item'] = "Data tidak sesuai dengan database stok 3";
            $errors['tgl_expired'] = "Data tidak sesuai dengan database stok 4";
            $data['errors'] = $errors;
        }  
    }
    else{ 
        $errors['kode_item'] = "Mohon pilih item";
        $data['errors'] = $errors;
    }
}
if ($this->db->trans_status() === FALSE)
{
 $this->db->trans_rollback();
}
else
{
    $this->db->trans_commit();
}
$data['token'] = $this->security->get_csrf_hash();
$this->session->set_userdata('cek', $data);
echo json_encode($data); 
}
public function stokutilityhapus(){ 
    cekajax(); 
    $hapus = $this->stok_model;
    if($hapus->hapusdatastokutility()){ 
        $data['success']= true;
        $data['message']="Berhasil menghapus data"; 
    }else{    
        $errors['fail'] = "gagal menghapus data";
        $data['errors'] = $errors;
    }
    $data['token'] = $this->security->get_csrf_hash();
    echo json_encode($data); 
}
public function cek()
{
   echo "<pre>";
   print_r ($this->session->userdata());
   echo "</pre>";

}
}