<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation','datatables'));
        $this->load->helper(array('string','security','form')); 
    }

    public function printsplitdetail(){ 
        $idd = $this->security->xss_clean($this->uri->segment(3)); 
        $kode_item = $this->input->get('id');
        $dataitem = $this->master_model->getsplit($kode_item);
        $datasplit = $this->master_model->getdetailsplit($kode_item);
        $arraysub = array();
        foreach ($datasplit as $po_data) {
            $subArray = array(  
              "id_dtl_split" => $this->security->xss_clean($po_data['id_dtl_split']),
              "id_split" => $this->security->xss_clean($po_data['id_split']),
              "blok" => $this->security->xss_clean($po_data['blok']),
              "luas_daftar_blok" => $this->security->xss_clean($po_data['luas_daftar_blok']),
              "luas_terbit_blok" => $this->security->xss_clean($po_data['luas_terbit_blok']),
              "no_shgb_blok" => $this->security->xss_clean($po_data['no_shgb_blok']),
              "masa_berlaku_blok" => $this->security->xss_clean($po_data['masa_berlaku_blok']),
              "masa_berlaku_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['masa_berlaku_blok'])),
              "no_daftar_blok" => $this->security->xss_clean($po_data['no_daftar_blok']),
              "tgl_daftar_blok" => $this->security->xss_clean($po_data['tgl_daftar_blok']),
              "tgl_daftar_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_daftar_blok'])),
              "tgl_terbit_blok" => $this->security->xss_clean($po_data['tgl_terbit_blok']),
              "tgl_terbit_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_terbit_blok'])),
              "keterangan" => $this->security->xss_clean($po_data['keterangan'])
          );
            $arraysub[] =  $subArray ; 

        }

        foreach($dataitem as $po_data) {

            $result = array(  
                "nama_regional" => $this->security->xss_clean($po_data['nama_regional']),
                "nama_penjual" => $this->security->xss_clean($po_data['penjual']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "luas_daftar" => $this->security->xss_clean($po_data['luas_daftar']),
                "luas_terbit" => $this->security->xss_clean($po_data['luas_terbit']),
                "no_daftar_shgb" => $this->security->xss_clean($po_data['no_daftar_shgb']),
                "tanggal_daftar_shgb" => $this->security->xss_clean($po_data['tanggal_daftar_shgb']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "tanggal_terbit_shgb" => $this->security->xss_clean($po_data['tanggal_terbit_shgb']),
                "masa_berlaku" => $this->security->xss_clean($po_data['masa_berlaku_shgb']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']), 
                "id_induk" => $this->security->xss_clean($po_data['id_proses_induk'])
            ); 

        }  
        $datasub = $arraysub;
        $array[] =  $result ; 
        $kirim['dataitem'] = $array;
        $kirim['detail'] = $datasub;
        // $kirim['profil'] = $this->pembelian_model->data_profil(); 
        if($kirim['dataitem'] != TRUE) show_404(); 
        $this->load->view('member/print/printsplitdetail',$kirim);
    }
    public function pdfsplitdetail()
    {
        $idd = $this->security->xss_clean($this->uri->segment(3)); 
        $data['po_data'] = $this->pembelian_model->get_po($idd); 
        $data['detail_po']  = $this->pembelian_model->detail_po($idd);  
        $data['profil'] = $this->pembelian_model->data_profil(); 
        if($data['po_data'] != TRUE) show_404(); 
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $data = $this->load->view('member/pembelian/pdfpo', $data, TRUE);
        $mpdf->setTitle("Purchase Order ".$idd);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Purchase Order ".$idd.".pdf", "D"); 
    }

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */