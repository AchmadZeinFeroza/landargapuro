<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tools extends CI_Controller {   
    function __construct(){
        parent::__construct();
        if($this->session->userdata('login') != TRUE){    
            redirect(base_url('login'));
        }    
        $this->load->model('tools_model');
        $this->load->library('form_validation');
        $this->load->helper(array('string','security','form'));
    } 
    public function index()
    {   
        level_user('tools','index',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $this->load->view('member/tools/beranda');
    }  
    public function profil()
    {   
        level_user('tools','profil',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $data['profil'] = $this->db->get_where('profil_apotek', array('id' => '1'),1); 
        $this->load->view('member/tools/profil',$data);
    }   
    
    public function editprofile(){ 
        cekajax(); 
        $simpan = $this->tools_model; 
        $post = $this->input->post();
        $validation = $this->form_validation; 
        $validation->set_rules($simpan->rulesprofiledit());
        if ($this->form_validation->run() == FALSE){
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        }else{       
            if($simpan->updatedataprofile()){
                $data['success']= true;
                $data['message']="Berhasil menyimpan data";   
            }else{
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }  				
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data); 
    }

    public function import_item()
    {     
        level_user('tools','import_item',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $this->load->view('member/tools/import_item');
    }   
    private function gen_kode_stok_split()
    {   
        $this->db->group_by('id_gen');
        $jumlah = $this->db->select('id_gen')->from('tbl_stok_split')->get()->num_rows();
        $jml_baru = $jumlah + 1; 
        $kode = sprintf("%04s", $jml_baru);
        $kode = "gen".date('dmy').$kode;
        $cek_ada = $this->db->select('id_gen')->from('tbl_stok_split')->where('id_gen ="'. $kode.'"')->get()->num_rows();
        if($cek_ada > 0){
            return $this->gen_kode_stok_split();
        }else{
            return $kode ;
        } 
    }
    public function view_upload()
    {    
        $nama_file = $this->security->get_csrf_hash(); 
        $id_perumahan = $this->input->post('id_perumahan');
        $aksi = $this->tools_model->upload_file($nama_file);  
        $arraysub = array();
        // $id_gen = $this->gen_kode_stok_split();
        $stat = true;
        if($aksi['result'] == "success"&&$id_perumahan!=''){  
            include APPPATH.'third_party/PHPExcel/PHPExcel.php'; 
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/'.$nama_file.'.xlsx');
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);   
            $data = array();
            $baris = 1;
            $this->db->trans_begin();
            foreach($sheet as $row){    
                if($baris > 1){ 
                    $luas_teknik = bilanganbulat($row['B']);
                    $data = array(
                        'blok'=>$row['A'],  
                        'luas_teknik'=>$luas_teknik,  
                        'id_perumahan'=> $id_perumahan
                    );
                    if (!$this->tools_model->input_semua($data)) {
                        $stat = false;
                    }
                } 
                $baris++;  
            } 
            if ($stat)
            {
             $data['success']= true;
             $data['message']="Berhasil upload file ke database";   
             $this->db->trans_commit();

         }
         else
         {
          $errors['fail'] =  'gagal mengupload semua data, pastikan data terisi dengan benar'; 
          $data['errors'] = $errors;
          $this->db->trans_rollback();
      }
  }else{
    $errors['fail'] =  $aksi['error']; 
    $data['errors'] = $errors;
} 
$data['token'] = $this->security->get_csrf_hash(); 
echo json_encode($data);  
}   

}