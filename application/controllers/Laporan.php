<?php
defined('BASEPATH') or exit('No direct script access allowed');

require './phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') != true) {
            redirect(base_url('login'));
        }
        $this->load->model('master_model');
        $this->load->model('laporan_model');
        $this->load->library('form_validation');
        $this->load->helper(array('string', 'security', 'form'));
        $this->load->library('Ajax_pagination'); 
        $this->perPage = 100;
    }
    public function query()
    {
        echo "<pre>";
        print_r($this->session->flashdata('query'));
        echo "</pre>";
    }
    public function index()
    {
        level_user('laporan', 'index', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->load->view('member/laporan/beranda2');
    }

    public function laba_rugi()
    {
        level_user('laporan', 'penjualan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->load->model('Master_model');

        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $this->load->model('Keuangan_model');
        $data['data_hutang'] = $this->Keuangan_model->gethutangarray();
        $data['data_penjualan'] = $this->laporan_model->getrowspenjualan($conditions);
        $data['data_proses_induk'] = $this->Master_model->getproses_indukarray($conditions);
        $this->load->view('member/laporan/laba_rugi', $data);
    }
    public function pembayaran($kode_item = '')
    {
        level_user('master', 'items', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();

        $data['firstdate'] = $this->input->get('firstdate', true);
        $data['lastdate'] = $this->input->get('lastdate', true);
        $data['kode_item'] = $kode_item;
        $data['list'] = $this->keuangan_model->getpembayaran($kode_item);
        $this->load->view('member/master/items', $data);
    }
    public function laporan_evaluasi_pembelian_detail()
    {
        level_user('master', 'items', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['firstdate'] = $this->input->get('firstdate', true);
        $data['lastdate'] = $this->input->get('lastdate', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan2'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $data['jenis_pengalihan'] = $this->db->order_by("id_pengalihan", "DESC")->get('tbl_jenis_pengalihan')->result();
        $this->load->view('member/master/items', $data);
    }
    public function laporan_evaluasi_pembelian()
    {
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['cek'] = $this->datarekap_evaluasi_pembelian('1');
        // echo "<pre>";
        // print_r($data['cek']);
        // echo "</pre>";
        // exit;
        $data['lokasi'] = $this->datarekap_evaluasi_pembelian('3');
        $data['dalamijin'] = $this->datarekap_evaluasi_pembelian('1');
        $data['luarijin'] = $this->datarekap_evaluasi_pembelian('2');
        $this->load->view('member/laporan/laporan2_rekap', $data);

    }
    public function datarekap_evaluasi_pembelian($jenis)
    {
        $get = $this->input->get();
        $listdlmijin = $this->master_model->getperumahanbykategori($jenis);
        $bulan = date('n');
        $bidtarget = 0;
        $luastarget = 0;
        $data = array();
        foreach ($listdlmijin as $r) {
            $datatarget = $this->laporan_model->getdatatarget($r->id, date('Y'));
            $bulanini1 = date('Y-m-01');
            $time = strtotime($bulanini1);
            $bulanini2 = date("Y-m-d", strtotime("+1 month", $time));
            $bulanawal = date('Y-01-01');
            $datarealisasisebelum = $this->laporan_model->getrealisasi($r->id, $bulanawal, $bulanini1);
            $datarealisasisesudah = $this->laporan_model->getrealisasi($r->id, $bulanini1, $bulanini2);
            if ($datatarget['luas'] == '') {
            } else {
                for ($i = 0; $i < $bulan; $i++) {
                    $target = (int) $datatarget['bid'][$i];
                    $bidtarget += $target;
                    $luas = (int) $datatarget['luas'][$i];
                    $luastarget += $luas;
                }
            }
            $row = array();

            // $row[] = $this->security->xss_clean($r->id);
            $row['nama_regional'] = $this->security->xss_clean($r->nama_regional);
            // $row[] = $this->security->xss_clean($r->lokasi);
            $row['bidtarget'] = $this->security->xss_clean($bidtarget);
            $row['luastarget'] = $this->security->xss_clean($luastarget);
            $row['bidrealsebelum'] = $this->security->xss_clean($datarealisasisebelum['bid']);
            if ($datarealisasisebelum['luas'] == '') {
                $row['luasrealsebelum'] = $this->security->xss_clean(0);
            } else {
                $row['luasrealsebelum'] = $this->security->xss_clean($datarealisasisebelum['luas']);
            }
            $row['bidrealsesudah'] = $this->security->xss_clean($datarealisasisesudah['bid']);
            if ($datarealisasisesudah['luas'] == '') {
                $row['luasrealsesudah'] = $this->security->xss_clean(0);
            } else {
                $row['luasrealsesudah'] = $this->security->xss_clean($datarealisasisesudah['luas']);
            }
            $row['datatarget'] = $this->security->xss_clean($datatarget);
            $row['status'] = $this->security->xss_clean($r->nama_status);
            $luastarget = 0;
            $bidtarget = 0;
            $data[] = $row;
        }
        return $data;
    }
    public function list_ijin()
    {
        level_user('master', 'perumahan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        // $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $get = $this->input->get();
        if(!empty($get['id'])){
            $data['getdataijinlokasi'] = $this->laporan_model->dataijinlokasi($get['id']);
            $data['id'] = $get['id'];
            $data['nama_regional'] = $this->db->select('nama_regional')->where('id' , $get['id'])->get('master_regional')->result();
        }else{
            $data['getdataijinlokasi'] = $this->laporan_model->getdataijinlokasi();
        }
        // echo "<pre>";
        
        // print_r($data['getdataijinlokasi']); 
        // echo "</pre>";
        // exit;
        $this->load->view('member/laporan/1/list_ijin', $data);
    }
    public function rekap_proses_ijin_lokasi()
    {
        level_user('master', 'perumahan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['firstdate'] = $this->input->get('firstdate', true);
        $data['lastdate'] = $this->input->get('lastdate', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        // $data['status'] = $this->db->order_by("id_status_regional","DESC")->get('master_status_regional')->result();
        $this->load->view('member/laporan/1/list_perumahan', $data);
    }
    public function datarekap_proses_ijin()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_kategori_datatable();
        $data = array();
        $jumlahsisa = 0;
        $luassisa = 0;
        $jumlahbaru = 0;
        $luasbaru = 0;
        $jumlahtotal = 0;
        $luastotal = 0;
        $jumlahterbit = 0;
        $luas = 0;
        $luasterbit = 0;
        $jumlahsisaterbit = 0;
        $luassisaterbit = 0;
        foreach ($list as $r) {
            $dataseb = $this->laporan_model->get_rekapproses_perijinan($r->id, '1970-01-01', (date('Y') - 1) . '-12-31');
            $datases = $this->laporan_model->get_rekapproses_perijinan($r->id, date('Y' . '-01-01'), date('Y') . '-12-31');
            $dataterbit = $this->laporan_model->get_rekapproses_perijinan($r->id, '1970-01-01', (date('Y')) . '-12-31', 'sudah');
            $query = $this->db->last_query();
            $row = array();
            $tomboledit = level_user('master', 'perumahan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="' . site_url('Laporan/proses_ijin_per/') . $this->security->xss_clean($r->id) . '">Detail</a></li>' : '';
            $row[] = '
            <div class="btn-group dropup">
            <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
            <ul class="dropdown-menu" role="menu">
            ' . $tomboledit . '
            </ul>
            </div>
            ';
            // $row[] = $this->security->xss_clean($r->id);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->lokasi);
            $row[] = $this->security->xss_clean($dataseb['jumlah']);
            $jumlahsisa += $dataseb['jumlah'];
            $row[] = $this->security->xss_clean($dataseb['luas']);
            $luassisa += $dataseb['luas'];
            $row[] = $this->security->xss_clean($datases['jumlah']);
            $jumlahbaru += $datases['jumlah'];
            $row[] = $this->security->xss_clean($datases['luas']);
            $luasbaru += $datases['luas'];
            $row[] = $this->security->xss_clean($dataseb['jumlah'] + $datases['jumlah']);
            $jumlahtotal += $dataseb['jumlah'] + $datases['jumlah'];
            $row[] = $this->security->xss_clean($dataseb['luas'] + $datases['luas']);
            $luastotal += $dataseb['luas'] + $datases['luas'];
            $row[] = $this->security->xss_clean($dataterbit['jumlah']);
            $jumlahterbit += $dataterbit['jumlah'];
            $row[] = $this->security->xss_clean($dataterbit['luas']);
            $luas += $dataterbit['luas'];
            $row[] = $this->security->xss_clean($dataterbit['luas_terbit']);
            $luasterbit += $dataterbit['luas_terbit'];
            $row[] = $this->security->xss_clean(($dataseb['jumlah'] + $datases['jumlah']) - $dataterbit['jumlah']);
            $jumlahsisaterbit += ($dataseb['jumlah'] + $datases['jumlah']) - $dataterbit['jumlah'];
            $row[] = $this->security->xss_clean(($dataseb['luas'] + $datases['luas']) - $dataterbit['luas_terbit']);
            $luassisaterbit += ($dataseb['luas'] + $datases['luas']) - $dataterbit['luas_terbit'];
            $row[] = $this->security->xss_clean($r->keterangan);
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = $jumlahsisa;
        $row[] = $luassisa;
        $row[] = $jumlahbaru;
        $row[] = $luasbaru;
        $row[] = $jumlahtotal;
        $row[] = $luastotal;
        $row[] = $jumlahterbit;
        $row[] = $luas;
        $row[] = $luasterbit;
        $row[] = $jumlahsisaterbit;
        $row[] = $luassisaterbit;
        $row[] = '';
        $data[] = $row;

        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_kategori(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_kategori(),
            "data" => $data,
            "query" => $query,
        );
        echo json_encode($result);
    }
    public function proses_ijin_per($id)
    {
        level_user('master', 'items', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan2'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $data['id_perumahan'] = $id;
        $this->load->view('member/laporan/1/list_perijinan_per', $data);
    }
    public function data_perijinan($id)
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->laporan_model->get_perijinan_datatable($id);
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'items', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id_penyelesaian) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_penyelesaian) . '">Edit</a></li>' : '';
            $row[] = '
            <div class="btn-group dropup">
            <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
            <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->id_penyelesaian) . '">Detail</a></li>
            ' . $tomboledit . '
            ' . $tombolhapus . '
            </ul>
            </div>
            ';
            if ($r->id_perumahan == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $r->nama_regional;
            }

            $row[] = $this->security->xss_clean($perumahan);
            $row[] = $this->security->xss_clean($r->titik_koordinat);
            $row[] = $this->security->xss_clean($r->luas_daftar);
            $row[] = $this->security->xss_clean($r->luas_terbit);
            $row[] = $this->security->xss_clean($r->luas_daftar - $r->luas_terbit);
            $row[] = $this->security->xss_clean(tgl_indo($r->daftar_online_oss));
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_daftar_pertimbangan));
            $row[] = $this->security->xss_clean($r->no_berkas_pertimbangan);
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_terbit_pertimbangan));
            $row[] = $this->security->xss_clean($r->nomor_sk_pertimbangan);
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_daftar_tata_ruang));
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_terbit_tata_ruang));
            $row[] = $this->security->xss_clean($r->nomor_surat_tata_ruang);
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_daftar_ijin));
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_terbit_ijin));
            $row[] = $this->security->xss_clean($r->nomor_ijin);
            $row[] = $this->security->xss_clean(tgl_indo($r->masa_berlaku_ijin));
            $row[] = $this->security->xss_clean($r->keterangan);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->laporan_model->count_all_datatable_perijinan($id),
            "recordsFiltered" => $this->laporan_model->count_filtered_datatable_perijinan($id),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function perijinantambah()
    {
        cekajax();
        $simpan = $this->laporan_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rules_perijinan());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandata_perijinan()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function perijinandetail()
    {
        cekajax();
        $idd = $this->input->get("id");
        $this->db->join('master_regional', 'master_penyelesaian_ijin.id_perumahan = master_regional.id', 'left');
        $query = $this->db->get_where('master_penyelesaian_ijin', array('id_penyelesaian' => $idd), 1);
        $result = array(
            "id_perumahan" => $this->security->xss_clean($query->row()->id_perumahan),
            "titik_koordinat" => $this->security->xss_clean($query->row()->titik_koordinat),
            "luas_daftar" => $this->security->xss_clean($query->row()->luas_daftar),
            "luas_terbit" => $this->security->xss_clean($query->row()->luas_terbit),
            "daftar_online_oss" => $this->security->xss_clean(($query->row()->daftar_online_oss)),
            "tgl_daftar_pertimbangan" => $this->security->xss_clean(($query->row()->tgl_daftar_pertimbangan)),
            "setdaftar_online_oss" => $this->security->xss_clean(tgl_indo($query->row()->daftar_online_oss)),
            "settgl_daftar_pertimbangan" => $this->security->xss_clean(tgl_indo($query->row()->tgl_daftar_pertimbangan)),
            "no_berkas_pertimbangan" => $this->security->xss_clean($query->row()->no_berkas_pertimbangan),
            "tgl_terbit_pertimbangan" => $this->security->xss_clean(($query->row()->tgl_terbit_pertimbangan)),
            "settgl_terbit_pertimbangan" => $this->security->xss_clean(tgl_indo($query->row()->tgl_terbit_pertimbangan)),
            "nomor_sk_pertimbangan" => $this->security->xss_clean($query->row()->nomor_sk_pertimbangan),
            "tgl_daftar_tata_ruang" => $this->security->xss_clean(($query->row()->tgl_daftar_tata_ruang)),
            "tgl_terbit_tata_ruang" => $this->security->xss_clean(($query->row()->tgl_terbit_tata_ruang)),
            "settgl_daftar_tata_ruang" => $this->security->xss_clean(tgl_indo($query->row()->tgl_daftar_tata_ruang)),
            "settgl_terbit_tata_ruang" => $this->security->xss_clean(tgl_indo($query->row()->tgl_terbit_tata_ruang)),
            "nomor_surat_tata_ruang" => $this->security->xss_clean($query->row()->nomor_surat_tata_ruang),
            "tgl_daftar_ijin" => $this->security->xss_clean($query->row()->tgl_daftar_ijin),
            "tgl_terbit_ijin" => $this->security->xss_clean(($query->row()->tgl_terbit_ijin)),
            "settgl_daftar_ijin" => $this->security->xss_clean(tgl_indo($query->row()->tgl_daftar_ijin)),
            "settgl_terbit_ijin" => $this->security->xss_clean(tgl_indo($query->row()->tgl_terbit_ijin)),
            "nomor_ijin" => $this->security->xss_clean($query->row()->nomor_ijin),
            "masa_berlaku_ijin" => $this->security->xss_clean(tgl_indo($query->row()->masa_berlaku_ijin)),
            "setmasa_berlaku_ijin" => $this->security->xss_clean(tgl_indo($query->row()->masa_berlaku_ijin)),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function perijinanedit()
    {
        cekajax();
        $simpan = $this->laporan_model;
        $post = $this->input->post();
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rules_perijinan());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedata_perijinan()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;

            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function laporan_evaluasi_land_bank()
    {
        level_user('master', 'items', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $get = $this->input->get();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan2'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $data['list'] = $this->dataevaluasilandbank();
        // echo "<pre>";
        // print_r($data['list']);
        // echo "</pre>";
        // exit;
        if(!empty($get['id'])){
            $data_regional =  $this->db->join('master_status_regional', 'master_status_regional.id_status_regional = master_regional.status_regional')->order_by("id", "DESC")->where('id', $get['id'])->get('master_regional')->result();
        //     echo "<pre>";
        // print_r($data_regional);
        // echo "</pre>";
        // exit;
            $data['status'] = $data_regional[0]->nama_status;
            $data['nama_regional'] = $data_regional[0]->nama_regional;
            $data['id'] = $get['id'];
        }
        $this->load->view('member/laporan/evaluasi_land_bank', $data);
    }
    public function dataevaluasilandbank()
    {
        $get = $this->input->get();
        if(!empty($get['id'])){
            $data['perumahan'] = $this->db->join('master_status_regional', 'master_status_regional.id_status_regional = master_regional.status_regional')->order_by("id", "DESC")->where('id', $get['id'])->get('master_regional')->result();
        }
            $data['perumahandalamijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '1')->get('master_regional')->result();
            $data['perumahanluarijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '2')->get('master_regional')->result();
            $data['perumahanlokasi'] = $this->db->order_by("id", "DESC")->where('status_regional', '3')->get('master_regional')->result();
        $data1 = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();
        $status = '';
        $no = 1;
        if (isset($data['perumahan'])) {
            foreach ($data['perumahan'] as $key => $value) {
                $list1 = $this->master_model->get_rekaplandbank($value->id, '1970-01-01', (date('Y') - 1) . '-12-31');
                $list2 = $this->master_model->get_rekaplandbank($value->id, date('Y' . '-01-01'), date('Y') . '-12-31');
                $list3 = $this->master_model->get_rekaplandbank($value->id);
                $list4 = $this->master_model->get_rekaplandbank($value->id, '', '', 'sudah');
                $row = array();

                $row[] = $this->security->xss_clean($no++);
                $row[] = $this->security->xss_clean($value->nama_regional);

                $row[] = $this->security->xss_clean($list1['bid']);
                $row[] = $this->security->xss_clean($list1['surat']);
                $row[] = $this->security->xss_clean($list1['ukur']);

                $row[] = $this->security->xss_clean($list2['bid']);
                $row[] = $this->security->xss_clean($list2['surat']);
                $row[] = $this->security->xss_clean($list2['ukur']);

                $row[] = $this->security->xss_clean($list3['bid']);
                $row[] = $this->security->xss_clean($list3['surat']);
                $row[] = $this->security->xss_clean($list3['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list3['bid'] - $list4['bid']);
                $row[] = $this->security->xss_clean($list3['surat'] - $list4['surat']);
                $row[] = $this->security->xss_clean($list3['ukur'] - $list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $data4[] = $row;
                $status = $this->security->xss_clean($value->nama_status);
            }
        }
        if ($data['perumahandalamijin'] != null) {
            foreach ($data['perumahandalamijin'] as $key => $value) {
                $list1 = $this->master_model->get_rekaplandbank($value->id, '1970-01-01', (date('Y') - 1) . '-12-31');
                $list2 = $this->master_model->get_rekaplandbank($value->id, date('Y' . '-01-01'), date('Y') . '-12-31');
                $list3 = $this->master_model->get_rekaplandbank($value->id);
                $list4 = $this->master_model->get_rekaplandbank($value->id, '', '', 'sudah');
                $row = array();

                $row[] = $this->security->xss_clean($no++);
                $row[] = $this->security->xss_clean($value->nama_regional);

                $row[] = $this->security->xss_clean($list1['bid']);
                $row[] = $this->security->xss_clean($list1['surat']);
                $row[] = $this->security->xss_clean($list1['ukur']);

                $row[] = $this->security->xss_clean($list2['bid']);
                $row[] = $this->security->xss_clean($list2['surat']);
                $row[] = $this->security->xss_clean($list2['ukur']);

                $row[] = $this->security->xss_clean($list3['bid']);
                $row[] = $this->security->xss_clean($list3['surat']);
                $row[] = $this->security->xss_clean($list3['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list3['bid'] - $list4['bid']);
                $row[] = $this->security->xss_clean($list3['surat'] - $list4['surat']);
                $row[] = $this->security->xss_clean($list3['ukur'] - $list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $data1[] = $row;
            }
        }

        if ($data['perumahanluarijin'] != null) {
            foreach ($data['perumahanluarijin'] as $key => $value) {
                $list1 = $this->master_model->get_rekaplandbank($value->id, '1970-01-01', (date('Y') - 1) . '-12-31');
                $list2 = $this->master_model->get_rekaplandbank($value->id, date('Y' . '-01-01'), date('Y') . '-12-31');
                $list3 = $this->master_model->get_rekaplandbank($value->id);
                $list4 = $this->master_model->get_rekaplandbank($value->id, '', '', 'sudah');
                $row = array();

                $row[] = $this->security->xss_clean($no++);
                $row[] = $this->security->xss_clean($value->nama_regional);

                $row[] = $this->security->xss_clean($list1['bid']);
                $row[] = $this->security->xss_clean($list1['surat']);
                $row[] = $this->security->xss_clean($list1['ukur']);

                $row[] = $this->security->xss_clean($list2['bid']);
                $row[] = $this->security->xss_clean($list2['surat']);
                $row[] = $this->security->xss_clean($list2['ukur']);

                $row[] = $this->security->xss_clean($list3['bid']);
                $row[] = $this->security->xss_clean($list3['surat']);
                $row[] = $this->security->xss_clean($list3['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list3['bid'] - $list4['bid']);
                $row[] = $this->security->xss_clean($list3['surat'] - $list4['surat']);
                $row[] = $this->security->xss_clean($list3['ukur'] - $list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $data2[] = $row;
            }
        }

        if ($data['perumahanlokasi'] != null) {
            foreach ($data['perumahanlokasi'] as $key => $value) {
                $list1 = $this->master_model->get_rekaplandbank($value->id, '1970-01-01', (date('Y') - 1) . '-12-31');
                $list2 = $this->master_model->get_rekaplandbank($value->id, date('Y' . '-01-01'), date('Y') . '-12-31');
                $list3 = $this->master_model->get_rekaplandbank($value->id);
                $list4 = $this->master_model->get_rekaplandbank($value->id, '', '', 'sudah');
                $row = array();

                $row[] = $this->security->xss_clean($no++);
                $row[] = $this->security->xss_clean($value->nama_regional);

                $row[] = $this->security->xss_clean($list1['bid']);
                $row[] = $this->security->xss_clean($list1['surat']);
                $row[] = $this->security->xss_clean($list1['ukur']);

                $row[] = $this->security->xss_clean($list2['bid']);
                $row[] = $this->security->xss_clean($list2['surat']);
                $row[] = $this->security->xss_clean($list2['ukur']);

                $row[] = $this->security->xss_clean($list3['bid']);
                $row[] = $this->security->xss_clean($list3['surat']);
                $row[] = $this->security->xss_clean($list3['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list3['bid'] - $list4['bid']);
                $row[] = $this->security->xss_clean($list3['surat'] - $list4['surat']);
                $row[] = $this->security->xss_clean($list3['ukur'] - $list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $data3[] = $row;
            }
        }
        return array('dalamijin' => $data1, 'luarijin' => $data2, 'lokasi' => $data3, 'rumah' => $data4 , 'status' => $status);
    }

    public function dataevaliasishgb()
    {
        $get = $this->input->get();
        if(!empty($get['id'])){
            $data['perumahan'] = $this->db->order_by("id", "DESC")->where('id', $get['id'])->get('master_regional')->result();
        }else{
            $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        }
        $data2 = array();
        $no = 1;
        if ($data['perumahan'] != null) {
            foreach ($data['perumahan'] as $key => $value) {
                $list1 = $this->master_model->get_rekapshgb($value->id, '1970-01-01', (date('Y') - 1) . '-12-31');
                $list2 = $this->master_model->get_rekapshgb($value->id, date('Y' . '-01-01'), date('Y') . '-12-31');
                $list3 = $this->master_model->get_rekapshgb($value->id);
                $list4 = $this->master_model->get_rekapshgb($value->id, '', '', '3');
                $row = array();

                $row[] = $this->security->xss_clean($no++);
                $row[] = $this->security->xss_clean($value->nama_regional);

                $row[] = $this->security->xss_clean($list1['bid']);
                $row[] = $this->security->xss_clean($list1['surat']);
                $row[] = $this->security->xss_clean($list1['ukur']);

                $row[] = $this->security->xss_clean($list2['bid']);
                $row[] = $this->security->xss_clean($list2['surat']);
                $row[] = $this->security->xss_clean($list2['ukur']);

                $row[] = $this->security->xss_clean($list3['bid']);
                $row[] = $this->security->xss_clean($list3['surat']);
                $row[] = $this->security->xss_clean($list3['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list3['bid'] - $list4['bid']);
                $row[] = $this->security->xss_clean($list3['surat'] - $list4['surat']);
                $row[] = $this->security->xss_clean($list3['ukur'] - $list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $row[] = $this->security->xss_clean($list4['ukur']);

                $row[] = $this->security->xss_clean($list4['bid']);
                $row[] = $this->security->xss_clean($list4['surat']);
                $data2[] = $row;
            }
        }
        return $data2;
    }
    public function master_proses_indukdetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->get_where('master_proses_induk', array('id_proses_induk' => $idd), 1);
        $result = array(
            "id_proses_induk" => $this->security->xss_clean($query->row()->id_proses_induk),
            "no_surat_tanah" => $this->security->xss_clean($query->row()->no_surat_tanah),
            "nama_surat_tanah" => $this->security->xss_clean($query->row()->nama_surat_tanah),
            "luas" => $this->security->xss_clean($query->row()->luas),
            "tanggal_daftar_sk_hak" => $this->security->xss_clean($query->row()->tanggal_daftar_sk_hak),
            "tanggal_daftar_sk_haktampil" => $this->security->xss_clean(tgl_indo($query->row()->tanggal_daftar_sk_hak)),
            "no_daftar_sk_hak" => $this->security->xss_clean($query->row()->no_daftar_sk_hak),
            "tanggal_terbit_sk_hak" => $this->security->xss_clean($query->row()->tanggal_terbit_sk_hak),
            "tanggal_terbit_sk_haktampil" => $this->security->xss_clean(tgl_indo($query->row()->tanggal_terbit_sk_hak)),
            "no_terbit_sk_hak" => $this->security->xss_clean($query->row()->no_terbit_sk_hak),
            "tanggal_daftar_shgb" => $this->security->xss_clean($query->row()->tanggal_daftar_shgb),
            "tanggal_daftar_shgbtampil" => $this->security->xss_clean(tgl_indo($query->row()->tanggal_daftar_shgb)),
            "no_daftar_shgb" => $this->security->xss_clean($query->row()->no_daftar_shgb),
            "tanggal_terbit_shgb" => $this->security->xss_clean($query->row()->tanggal_terbit_shgb),
            "tanggal_terbit_shgbtampil" => $this->security->xss_clean(tgl_indo($query->row()->tanggal_terbit_shgb)),
            "no_terbit_shgb" => $this->security->xss_clean($query->row()->no_terbit_shgb),
            "masa_berlaku_shgb" => $this->security->xss_clean($query->row()->masa_berlaku_shgb),
            "masa_berlaku_shgbtampil" => $this->security->xss_clean(tgl_indo($query->row()->masa_berlaku_shgb)),
            "target_penyelesaian" => $this->security->xss_clean($query->row()->target_penyelesaian),
            "target_penyelesaiantampil" => $this->security->xss_clean(tgl_indo($query->row()->target_penyelesaian)),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
        );
        echo '[' . json_encode($result) . ']';
    }
    public function laporan_evaluasi_land_bank_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/evaluasi_land_bank_per', $data);
    }
    public function pageevaluasilandbankper()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['dataperumahanseb'] = $this->master_model->getperumahan($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'belum');
        $data['dataperumahanses'] = $this->master_model->getperumahan($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'belum');
        $data['dataperumahantekseb'] = $this->master_model->getperumahan($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'sudah');
        $data['dataperumahantekses'] = $this->master_model->getperumahan($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'sudah');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/laporan/ajax/ajaxevaluasilandbankper', $data);
    }

    public function pageevaluasishgbper()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['dataperumahanseb'] = $this->master_model->getshgbperumahan($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'belum');
        $data['dataperumahanses'] = $this->master_model->getshgbperumahan($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'belum');
        $data['dataperumahantekseb'] = $this->master_model->getshgbperumahan($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'proses');
        $data['dataperumahantekses'] = $this->master_model->getshgbperumahan($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'proses');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/laporan/ajax/ajaxevaluasishgbper', $data);
    }

    public function pageevaluasisudahshgbper()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['dataperumahantekseb'] = $this->master_model->getshgbperumahan($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'selesai');
        $data['dataperumahantekses'] = $this->master_model->getshgbperumahan($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'selesai');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/laporan/ajax/ajaxevaluasisudahshgbper', $data);
    }

    public function pageevaluasiprosesinduk($id = '')
    {
        $data['prosesshgbses'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31');
        $data['prosesshgbseb'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31');
        $data['terbitshgbses'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31', 'terbit');
        $data['terbitshgbseb'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31', 'terbit');
        $this->load->view('member/laporan/ajax/ajaxpenyelesaianinduk', $data);
    }

    public function proses_indukdetail()
    {
        cekajax();
        $kode_item = $this->input->get('id');
        $datapembayaran = $this->master_model->getdetailprosesinduk($kode_item);
        $dataitem = $this->master_model->getprosesinduk($kode_item);
        $arraysub = array();
        foreach ($datapembayaran as $po_data) {
            $subArray = array(
                "id_dtl_proses_induk" => $this->security->xss_clean($po_data['id_dtl_proses_induk']),
                "id_master_item" => $this->security->xss_clean($po_data['id_master_item']),
                "tgl_proses_induk" => $this->security->xss_clean(tgl_indo($po_data['tgl_proses_induk'])),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
            );
            $arraysub[] = $subArray;

        }

        foreach ($dataitem as $po_data) {

            $result = array(
                "id_proses_induk" => $this->security->xss_clean($po_data['id_proses_induk']),
                "no_surat_tanah" => $this->security->xss_clean($po_data['no_surat_tanah']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']),
                "luas" => $this->security->xss_clean($po_data['luas']),
                "tanggal_daftar_sk_hak" => $this->security->xss_clean($po_data['tanggal_daftar_sk_hak']),
                "tanggal_daftar_sk_haktampil" => $this->security->xss_clean(tgl_indo($po_data['tanggal_daftar_sk_hak'])),
                "no_daftar_sk_hak" => $this->security->xss_clean($po_data['no_daftar_sk_hak']),
                "tanggal_terbit_sk_hak" => $this->security->xss_clean($po_data['tanggal_terbit_sk_hak']),
                "tanggal_terbit_sk_haktampil" => $this->security->xss_clean(tgl_indo($po_data['tanggal_terbit_sk_hak'])),
                "no_terbit_sk_hak" => $this->security->xss_clean($po_data['no_terbit_sk_hak']),
                "tanggal_daftar_shgb" => $this->security->xss_clean($po_data['tanggal_daftar_shgb']),
                "tanggal_daftar_shgbtampil" => $this->security->xss_clean(tgl_indo($po_data['tanggal_daftar_shgb'])),
                "no_daftar_shgb" => $this->security->xss_clean($po_data['no_daftar_shgb']),
                "tanggal_terbit_shgb" => $this->security->xss_clean($po_data['tanggal_terbit_shgb']),
                "tanggal_terbit_shgbtampil" => $this->security->xss_clean(tgl_indo($po_data['tanggal_terbit_shgb'])),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "masa_berlaku_shgb" => $this->security->xss_clean($po_data['masa_berlaku_shgb']),
                "masa_berlaku_shgbtampil" => $this->security->xss_clean(tgl_indo($po_data['masa_berlaku_shgb'])),
                "target_penyelesaian" => $this->security->xss_clean($po_data['target_penyelesaian']),
                "target_penyelesaiantampil" => $this->security->xss_clean(tgl_indo($po_data['target_penyelesaian'])),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
                "status" => $this->security->xss_clean($po_data['status']),
            );

        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';

    }
    public function laporan_evaluasi_tanah_belum_shgb()
    {
        $get = $this->input->get();
        
        $data['list'] = $this->dataevaliasishgb();
        if(!empty($get['id'])){
            $data['nama_regional'] = $data['list'][0][1];
            $data['id'] = $get['id'];
        }
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit;
        $this->load->view('member/laporan/laporan_evaluasi_tanah_belum_shgb', $data);
    }

    public function laporan_evaluasi_tanah_belum_shgb_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_tanah_belum_shgb_per', $data);
    }
    public function laporan_evaluasi_proses_induk()
    {
        $this->load->view('member/laporan/laporan_evaluasi_proses_induk');
    }
    public function laporan_evaluasi_proses_induk_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/laporan/laporan_evaluasi_proses_induk_per', $data);
    }
    public function laporan_evaluasi_penggabungan_split()
    {
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_penggabungan_split', $data);
    }
    public function laporan_evaluasi_penggabungan_split_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_penggabungan_split_per', $data);
    }

    public function pageevaluasipenggabungansplit($id = '')
    {
        $data['prosesshgbses'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31');
        $data['prosesshgbseb'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31');
        $data['terbitshgbses'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31', 'terbit');
        $data['terbitshgbseb'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31', 'terbit');
        $this->load->view('member/laporan/ajax/ajaxpenggabungansplit', $data);
    }

    public function pageevaluasiprosessplit($id = '')
    {
        $data['splitseb'] = $this->laporan_model->getmaster_split($id, date('Y' . '-01-01'), date('Y') . '-12-31');
        $data['splitses'] = $this->laporan_model->getmaster_split($id, '1970-01-01', (date('Y') - 1) . '-12-31');
        $this->load->view('member/laporan/ajax/ajaxprosessplit', $data);
    }

    public function splitdetail()
    {
        cekajax();
        $kode_item = $this->input->get('id');
        $dataitem = $this->master_model->getsplit($kode_item);
        $datasplit = $this->master_model->getdetailsplit($kode_item);
        $luas_daftar = 0;
        $luas_terbit = 0;
        $arraysub = array();
        foreach ($datasplit as $po_data) {
            $totalluasstok = $this->master_model->gettotalluasstok($po_data['id_stok_split']);
            $subArray = array(
                "id_dtl_split" => $this->security->xss_clean($po_data['id_dtl_split']),
                "id_split" => $this->security->xss_clean($po_data['id_split']),
                "blok" => $this->security->xss_clean($po_data['blok']),
                "id_stok_split" => $this->security->xss_clean($po_data['id_stok_split']),
                "luas_daftar_blok" => $this->security->xss_clean($po_data['luas_daftar_blok']),
                "luas_terbit_blok" => $this->security->xss_clean($po_data['luas_terbit_blok']),
                "sisa_luas" => $this->security->xss_clean($po_data['luas_terbit_blok'] - $totalluasstok),
                "no_shgb_blok" => $this->security->xss_clean($po_data['no_shgb_blok']),
                "masa_berlaku_blok" => $this->security->xss_clean($po_data['masa_berlaku_blok']),
                "masa_berlaku_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['masa_berlaku_blok'])),
                "no_daftar_blok" => $this->security->xss_clean($po_data['no_daftar_blok']),
                "tgl_daftar_blok" => $this->security->xss_clean($po_data['tgl_daftar_blok']),
                "tgl_daftar_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_daftar_blok'])),
                "tgl_terbit_blok" => $this->security->xss_clean($po_data['tgl_terbit_blok']),
                "tgl_terbit_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_terbit_blok'])),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
            );
            $luas_daftar += $po_data['luas_daftar_blok'];
            $luas_terbit += $po_data['luas_terbit_blok'];
            $arraysub[] = $subArray;

        }

        foreach ($dataitem as $po_data) {

            $result = array(
                "nama_regional" => $this->security->xss_clean($po_data['nama_regional']),
                "nama_penjual" => $this->security->xss_clean($po_data['penjual']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "luas_daftar" => $this->security->xss_clean($luas_daftar),
                "luas_terbit" => $this->security->xss_clean($luas_terbit),
                "no_daftar_shgb" => $this->security->xss_clean($po_data['no_daftar_shgb']),
                "tanggal_daftar_shgb" => $this->security->xss_clean($po_data['tanggal_daftar_shgb']),
                "no_terbit_shgb" => $this->security->xss_clean($po_data['no_terbit_shgb']),
                "tanggal_terbit_shgb" => $this->security->xss_clean($po_data['tanggal_terbit_shgb']),
                "masa_berlaku" => $this->security->xss_clean($po_data['masa_berlaku_shgb']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']),
                "tgl_daftar_split" => $this->security->xss_clean($po_data['tgl_daftar_split']),
                "masa_berlaku_split" => $this->security->xss_clean($po_data['masa_berlaku_split']),
                "no_berkas_split" => $this->security->xss_clean($po_data['no_berkas_split']),
                "id_induk" => $this->security->xss_clean($po_data['id_proses_induk']),
            );

        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';
    }
    public function laporan_evaluasi_tanah_shgb()
    {
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_tanah_shgb', $data);
    }
    public function laporan_evaluasi_tanah_shgb_per()
    {
        // $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_tanah_shgb_perumahan', $data);
    }
    public function laporan_evaluasi_splitsing()
    {
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_splitsing', $data);
    }
    public function laporan_evaluasi_splitsing_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
//   echo json_encode($data);
        //   die;
        $this->load->view('member/laporan/laporan_evaluasi_splitsing_per', $data);
    }

    public function laporan_evaluasi_sert_belum_split()
    {
        $this->load->view('member/laporan/laporan_evaluasi_sert_belum_split');
    }
    public function laporan_evaluasi_sert_belum_split_per()
    {
        $this->load->view('member/laporan/laporan_evaluasi_sert_belum_split_per');
    }

    public function laporan_evaluasi_stok_split()
    {
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $this->load->view('member/laporan/laporan_evaluasi_stok_split', $data);
    }
    public function laporan_evaluasi_stok_split_per()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['status_surat'] = $this->input->get('status_surat', true);
        $this->load->view('member/laporan/laporan_evaluasi_stok_split_per', $data);
    }
    public function ajaxstoksplit()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['status_surat'] = $this->input->get('status_surat', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->where('id_perumahan', $data['id_perumahan']);
        $this->db->where('id_stok_split not in (select id_stok_split from master_penjualan where status_jual = 1 ) ');
        $data['datastok'] = $this->db->get('tbl_stok_split')->result();
        $this->load->view('member/laporan/ajax/ajaxlaporanstoksplit', $data);
    }
    public function laporan_penjualan()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['status_surat'] = $this->input->get('status_surat', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);
        $this->load->view('member/laporan/laporan_penjualan', $data);
    }
    public function ajaxdatajual()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['status_surat'] = $this->input->get('status_surat', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->where('id_perumahan', $data['id_perumahan']);
        $this->db->join('master_penjualan', 'tbl_stok_split.id_stok_split = master_penjualan.id_stok_split');
        if ($data['tgl_awal'] != '' && $data['tgl_akhir'] != '') {
            $this->db->where('tgl_penjualan BETWEEN "' . $data['tgl_awal'] . '" and "' . $data['tgl_akhir'] . '"');
        }
        if ($data['status_surat'] == '' || $data['status_surat'] == 'jual') {
            $this->db->where("master_penjualan.status_jual !=0");
        } elseif ($data['status_surat'] == 'semua') {
        } else {
            $this->db->where("master_penjualan.status_jual = 0");
        }
        $data['datastok'] = $this->db->get('tbl_stok_split')->result();
        $this->load->view('member/laporan/ajax/ajaxlaporanstokjual', $data);
    }

    public function laporan_baliknama()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);
        $this->load->view('member/laporan/laporan_baliknama', $data);
    }
    public function ajaxbaliknama()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);

        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();

        if ($data['tgl_awal'] != '' && $data['tgl_akhir'] != '') {
            $this->db->where('tgl_penjualan BETWEEN "' . $data['tgl_awal'] . '" and "' . $data['tgl_akhir'] . '"');
        }
        $this->db->where('tbl_stok_split.id_perumahan', $data['id_perumahan']);
        // $this->db->where("tbl_stok_split.id_perumahan !=", 0);
        $this->db->join('tbl_dtl_split', 'tbl_stok_split.id_stok_split = tbl_dtl_split.id_stok_split', 'left');
        $this->db->join('master_split', 'tbl_dtl_split.id_split = master_split.id_split', 'left');
        $this->db->join('master_proses_induk', 'master_split.id_proses_induk = master_proses_induk.id_proses_induk', 'left');
        $this->db->join('master_penjualan', 'tbl_stok_split.id_stok_split = master_penjualan.id_stok_split', 'left');
        $this->db->select('luas_terbit_blok, no_terbit_shgb, no_shgb_blok, tgl_daftar_blok, tgl_terbit_blok, masa_berlaku_shgb, tbl_stok_split.blok, tbl_stok_split.luas_teknik, master_penjualan.id_jual, master_penjualan.id_stok_split, master_penjualan.nama_pembeli, master_penjualan.nik, master_penjualan.alamat, master_penjualan.pekerjaan, master_penjualan.tgl_terima_nego, master_penjualan.tgl_penjualan, master_penjualan.tipe, master_penjualan.sistem_pembayaran, master_penjualan.harga, master_penjualan.status_jual');
        $data['datastok'] = $this->db->get('tbl_stok_split')->result();

        $this->load->view('member/laporan/ajax/ajaxbaliknama', $data);
    }

    public function laporan_hutangsertifikat()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);
        $this->load->view('member/laporan/laporan_hutangsertifikat', $data);
    }
    public function ajaxhutangsertifikat()
    {
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['tgl_awal'] = $this->input->get('tgl_awal', true);
        $data['tgl_akhir'] = $this->input->get('tgl_akhir', true);
        $this->db->where('id_perumahan', $data['id_perumahan']);
        $this->db->join('master_penjualan', 'tbl_stok_split.id_stok_split = master_penjualan.id_stok_split', 'left');
        $this->db->where("tbl_stok_split.id_perumahan !=0 ");
        if ($data['tgl_awal'] != '' && $data['tgl_akhir'] != '') {
            $this->db->where('tgl_penjualan BETWEEN "' . $data['tgl_awal'] . '" and "' . $data['tgl_akhir'] . '"');
        }
        $data['datastok'] = $this->db->get('tbl_stok_split')->result();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/laporan/ajax/ajaxhutangsertifikat', $data);
    }
    public function stoksplitdetail()
    {
        cekajax();
        $id_stok_split = $this->input->get('id');
        $dataitem = $this->master_model->getstoksplit($id_stok_split);
        $datasplit = $this->master_model->getdetailstoksplit($id_stok_split);
        $totalluasstok = $this->master_model->gettotalluasstok($id_stok_split);
        $arraysub = array();
        foreach ($datasplit as $po_data) {
            $subArray = array(
                "id_dtl_split" => $this->security->xss_clean($po_data['id_dtl_split']),
                "id_split" => $this->security->xss_clean($po_data['id_split']),
                "blok" => $this->security->xss_clean($po_data['blok']),
                "id_stok_split" => $this->security->xss_clean($po_data['id_stok_split']),
                "luas_daftar_blok" => $this->security->xss_clean($po_data['luas_daftar_blok']),
                "luas_terbit_blok" => $this->security->xss_clean($po_data['luas_terbit_blok']),
                "sisa_luas" => $this->security->xss_clean($po_data['luas_terbit_blok'] - $totalluasstok),
                "no_shgb_blok" => $this->security->xss_clean($po_data['no_shgb_blok']),
                "masa_berlaku_blok" => $this->security->xss_clean($po_data['masa_berlaku_blok']),
                "masa_berlaku_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['masa_berlaku_blok'])),
                "no_daftar_blok" => $this->security->xss_clean($po_data['no_daftar_blok']),
                "tgl_daftar_blok" => $this->security->xss_clean($po_data['tgl_daftar_blok']),
                "tgl_daftar_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_daftar_blok'])),
                "tgl_terbit_blok" => $this->security->xss_clean($po_data['tgl_terbit_blok']),
                "tgl_terbit_bloktampil" => $this->security->xss_clean(tgl_indo($po_data['tgl_terbit_blok'])),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
            );
            $arraysub[] = $subArray;

        }

        foreach ($dataitem as $po_data) {

            $result = array(
                "nama_regional" => $this->security->xss_clean($po_data['nama_regional']),
                "luas_stok" => $this->security->xss_clean($totalluasstok),
                "sisa_luas" => $this->security->xss_clean($po_data['luas_teknik'] - $totalluasstok),
                "id_stok_split" => $this->security->xss_clean($po_data['id_stok_split']),
                "blok" => $this->security->xss_clean($po_data['blok']),
                "luas_teknik" => $this->security->xss_clean($po_data['luas_teknik']),
            );

        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';

    }
    public function po()
    {
        level_user('laporan', 'po', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['target'] = $this->db->get('tbl_target')->result();
        $this->load->view('member/laporan/po', $data);
    }
    public function laporanpo()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $target = $this->input->get('target');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['target'] = $target;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        //total rows count
        $totalRec = count($this->laporan_model->getrowspo($conditions));

        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpo';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //get posts data
        $data['posts'] = $this->laporan_model->getrowspo($conditions);

        //load the view
        $this->load->view('member/laporan/po_view', $data, false);
    }

    public function cekcetak($id_perumahan)
    {
        $data['id_perumahan'] = $id_perumahan;
        $data['dataperumahanseb'] = $this->master_model->getperumahanarray($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31');
        $data['dataperumahanses'] = $this->master_model->getperumahanarray($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31');
        $data['dataperumahantekseb'] = $this->master_model->getperumahanarray($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'sudah');
        $data['dataperumahantekses'] = $this->master_model->getperumahanarray($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'sudah');

        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public function pembelian()
    {
        level_user('laporan', 'pembelian', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $conditions['target'] = '*';
        $timestamp = strtotime(date('F Y'));
        $conditions['search']['firstdate'] = date('Y-m-01', $timestamp);
        $conditions['search']['lastdate'] = date('Y-m-t', $timestamp);

        //set start and limit
        $conditions['limit'] = '10';

        //get posts data
        $data['posts'] = $this->laporan_model->getrowspembelian($conditions);
        $data['target'] = $this->db->get('tbl_target')->result();
        $this->load->view('member/laporan/pembelian', $data);
    }
    public function laporanpembelian()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $target = $this->input->get('target');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['target'] = $target;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowspembelian($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpembelian';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowspembelian($conditions);

//load the view
        $this->load->view('member/laporan/pembelian_view', $data, false);
    }

    public function excel_pembelian()
    {

        $spreadsheet = new Spreadsheet();
        $target = $this->input->get('target');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['target'] = $target;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowspembelian($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Faktur')
            ->setCellValue('B1', 'Tanggal Pembelian')
            ->setCellValue('C1', 'Kode target')
            ->setCellValue('D1', 'Nama target')
            ->setCellValue('E1', 'Total')
            ->setCellValue('F1', 'Pembayaran')
            ->setCellValue('G1', 'Termin')
            ->setCellValue('H1', 'Keterangan')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tgl_pembelian']);
            $total = rupiah($post['total']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $post['nomor_faktur'])
                ->setCellValue('B' . $i, $tgl)
                ->setCellValue('C' . $i, $post['target'])
                ->setCellValue('D' . $i, $post['nama_target'])
                ->setCellValue('E' . $i, $total)
                ->setCellValue('F' . $i, $post['pembayaran'])
                ->setCellValue('G' . $i, $post['termin'] . " Hari")
                ->setCellValue('H' . $i, $post['keterangan']);
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Pembelian');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pembelian.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function penerimaan()
    {
        $data['penerima'] = $this->db->select('penerima')->group_by('penerima')->from('penerimaan_barang')->get()->result();
        $this->load->view('member/laporan/penerimaan', $data);
    }

    public function laporanpenerimaan()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $penerima = $this->input->get('penerima');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['penerima'] = $penerima;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowspenerima($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpenerimaan';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowspenerima($conditions);

//load the view
        $this->load->view('member/laporan/penerima_view', $data, false);
    }

    public function excel_penerimaan()
    {

        $spreadsheet = new Spreadsheet();
        $penerima = $this->input->get('penerima');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['penerima'] = $penerima;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowspenerima($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Referensi')
            ->setCellValue('B1', 'Tanggal Penerimaan')
            ->setCellValue('C1', 'Nomor Faktur')
            ->setCellValue('D1', 'Nomor PO')
            ->setCellValue('E1', 'Penerima')
            ->setCellValue('F1', 'Keterangan')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tanggal_penerimaan']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $post['nomor_rec'])
                ->setCellValue('B' . $i, $tgl)
                ->setCellValue('C' . $i, $post['nomor_faktur'])
                ->setCellValue('D' . $i, $post['nomor_po'])
                ->setCellValue('E' . $i, $post['penerima'])
                ->setCellValue('F' . $i, $post['keterangan']);
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Penerimaan');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Penerimaan.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function stok()
    {
        level_user('laporan', 'stok', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();

        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }
        $timestamp = strtotime(date('F Y'));
        $conditions['search']['firstdate'] = date('Y-m-01', $timestamp);
        $conditions['search']['lastdate'] = date('Y-m-t', $timestamp);
//total rows count
        $totalRec = count($this->laporan_model->getrowsstok($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/stok';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowsstok($conditions);
        $this->load->view('member/laporan/stok', $data);
    }

    public function laporanstok()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowsstok($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanstok';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowsstok($conditions);

//load the view
        $this->load->view('member/laporan/stok_view', $data, false);
    }

    public function excel_stok()
    {

        $spreadsheet = new Spreadsheet();
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowsstok($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kode Item')
            ->setCellValue('C1', 'Nama Item')
            ->setCellValue('D1', 'Tanggal Expired')
            ->setCellValue('E1', 'Transaksi')
            ->setCellValue('F1', 'Masuk')
            ->setCellValue('G1', 'Keluar')
            ->setCellValue('H1', 'Satuan')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tanggal']);
            $expired = tgl_indo($post['tgl_expired']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $tgl)
                ->setCellValue('B' . $i, $post['kode_item'])
                ->setCellValue('C' . $i, $post['nama_item'])
                ->setCellValue('D' . $i, $expired)
                ->setCellValue('E' . $i, $post['jenis_transaksi'])
                ->setCellValue('F' . $i, $post['jumlah_masuk'])
                ->setCellValue('G' . $i, $post['jumlah_keluar'])
                ->setCellValue('H' . $i, $post['satuan_kecil']);
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Purchase Order');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Stok.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function penjualan()
    {
        level_user('laporan', 'penjualan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['penjual'] = $this->db->get('master_penjual')->result();
        $data['costumer'] = $this->db->get('master_pembeli')->result();
        $data['obat'] = $this->db->get('master_item')->result();
        $this->load->view('member/laporan/penjualan', $data);
    }
    public function penjualan_approve()
    {
        level_user('laporan', 'penjualan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['penjual'] = $this->db->get('master_penjual')->result();
        $data['costumer'] = $this->db->get('master_pembeli')->result();
        $data['obat'] = $this->db->get('master_item')->result();
        $this->load->view('member/laporan/penjualan_approve', $data);
    }

    public function laporanpenjualan()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $kasir = $this->input->get('kasir');
        $obat = $this->input->get('obat');
        $costumer = $this->input->get('costumer');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['kasir'] = $kasir;
        $conditions['search']['obat'] = $obat;
        $conditions['search']['costumer'] = $costumer;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowspenjualan($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpenjualan';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowspenjualan($conditions);

//load the view
        $this->load->view('member/laporan/penjualan_view', $data, false);
    }

    public function laporanpenjualan_approve()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $kasir = $this->input->get('kasir');
        $obat = $this->input->get('obat');
        $costumer = $this->input->get('costumer');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['kasir'] = $kasir;
        $conditions['search']['obat'] = $obat;
        $conditions['search']['costumer'] = $costumer;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowspenjualan($conditions, '0'));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpenjualan_approve';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowspenjualan($conditions, '0');

//load the view
        $this->load->view('member/laporan/penjualan_view_approve', $data, false);
    }
    public function excel_penjualan()
    {

        $spreadsheet = new Spreadsheet();
        $kasir = $this->input->get('kasir');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['kasir'] = $kasir;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowspenjualan($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kasir')
            ->setCellValue('C1', 'Upah Peracik')
            ->setCellValue('D1', 'Harga Item')
            ->setCellValue('E1', 'Total Harga')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tanggal']);
            $total_upah_peracik = rupiah($post['total_upah_peracik']);
            $total_harga_item = rupiah($post['total_harga_item']);
            $total = rupiah($post['total']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $tgl)
                ->setCellValue('B' . $i, $post['nama_admin'])
                ->setCellValue('C' . $i, $total_upah_peracik)
                ->setCellValue('D' . $i, $total_harga_item)
                ->setCellValue('E' . $i, $total)
            ;
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan Penjualan');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Penjualan.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function keuangan()
    {
        $this->load->view('member/laporan/keuangan');
    }

    public function laporankeuangan()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowskeuangan($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporankeuangan';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowskeuangan($conditions);

//load the view
        $this->load->view('member/laporan/keuangan_view', $data, false);
    }

    public function excel_keuangan()
    {

        $spreadsheet = new Spreadsheet();
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowskeuangan($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kode Rekening')
            ->setCellValue('C1', 'Nama Rekening')
            ->setCellValue('D1', 'Masuk')
            ->setCellValue('E1', 'Keluar')
            ->setCellValue('F1', 'Keterangan')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tanggal']);
            $masuk = rupiah($post['masuk']);
            $keluar = rupiah($post['keluar']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $tgl)
                ->setCellValue('B' . $i, $post['kode_rekening'])
                ->setCellValue('C' . $i, $post['nama_rekening'])
                ->setCellValue('D' . $i, $masuk)
                ->setCellValue('E' . $i, $keluar)
                ->setCellValue('F' . $i, $post['keterangan']);
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Keuangan');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Keuangan.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

// penjual
    public function penjual()
    {
        level_user('laporan', 'penjual', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $conditions['penjual'] = '*';
        $timestamp = strtotime(date('F Y'));
        $conditions['search']['firstdate'] = date('Y-m-01', $timestamp);
        $conditions['search']['lastdate'] = date('Y-m-t', $timestamp);

        //set start and limit
        $conditions['limit'] = '10';

        //get posts data
        $data['posts'] = $this->laporan_model->getrowpenjual($conditions);
        $data['penjual'] = $this->db->get('master_penjual a')->result();
        $this->load->view('member/laporan/penjual', $data);
    }
    public function laporanpenjual()
    {
        $conditions = array();
        $page = $this->input->get('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $penjual = $this->input->get('penjual');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['penjual'] = $penjual;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
//total rows count
        $totalRec = count($this->laporan_model->getrowpenjual($conditions));

//pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'laporan/laporanpenjual';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

//set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

//get posts data
        $data['posts'] = $this->laporan_model->getrowpenjual($conditions);

//load the view
        $this->load->view('member/laporan/penjual_view', $data, false);
    }

    public function excel_penjual()
    {

        $spreadsheet = new Spreadsheet();
        $target = $this->input->get('target');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        $conditions['search']['target'] = $target;
        $conditions['search']['firstdate'] = $firstdate;
        $conditions['search']['lastdate'] = $lastdate;
        $conditions['kategori']['excel'] = "excel";
        $postdata = $this->laporan_model->getrowspembelian($conditions);

        $spreadsheet->getProperties()->setCreator('Paber Panjaitan')
            ->setLastModifiedBy('Paber Panjaitan')
            ->setTitle('Laporan Format Excel')
            ->setSubject('Laporan Format Excel');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nomor Faktur')
            ->setCellValue('B1', 'Tanggal Pembelian')
            ->setCellValue('C1', 'Kode target')
            ->setCellValue('D1', 'Nama target')
            ->setCellValue('E1', 'Total')
            ->setCellValue('F1', 'Pembayaran')
            ->setCellValue('G1', 'Termin')
            ->setCellValue('H1', 'Keterangan')
        ;

        $i = 2;
        foreach ($postdata as $post) {
            $tgl = tgl_indo($post['tgl_pembelian']);
            $total = rupiah($post['total']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $post['nomor_faktur'])
                ->setCellValue('B' . $i, $tgl)
                ->setCellValue('C' . $i, $post['target'])
                ->setCellValue('D' . $i, $post['nama_target'])
                ->setCellValue('E' . $i, $total)
                ->setCellValue('F' . $i, $post['pembayaran'])
                ->setCellValue('G' . $i, $post['termin'] . " Hari")
                ->setCellValue('H' . $i, $post['keterangan']);
            $i++;
        }

// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Pembelian');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pembelian.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

// public function splitsing()
    // {
    //     level_user('laporan','splitsing',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
    //     $data['supplier'] = $this->db->get('master_supplier')->result();
    //     $this->load->view('member/laporan/master_splitsing',$data);
    // }

// public function datasplitsing()
    // {
    //     cekajax();
    //     header('Content-Type: application/json');
    //     echo $this->laporan_model->getallsplitsing();
    // }

    public function prosesindukdetail()
    {
        $this->load->model('Master_model');
        cekajax();
        $idd = $this->input->get("id");
        $query = $this->Master_model->getprosesinduk($idd);
        foreach ($query as $prosesinduk_data) {
            $result = array(
                "id_proses_induk" => $this->security->xss_clean($prosesinduk_data['id_proses_induk']),
                "penjual" => $this->security->xss_clean($prosesinduk_data['penjual']),
                "no_gambar" => $this->security->xss_clean($prosesinduk_data['no_gambar']),
                "id_perumahan" => $this->security->xss_clean($prosesinduk_data['id_perumahan']),
                "no_surat_tanah" => $this->security->xss_clean($prosesinduk_data['no_surat_tanah']),
                "nama_surat_tanah" => $this->security->xss_clean($prosesinduk_data['nama_surat_tanah']),
                "luas" => $this->security->xss_clean($prosesinduk_data['luas']),
                "luas_daftar" => $this->security->xss_clean($prosesinduk_data['luas_daftar']),
                "luas_terbit" => $this->security->xss_clean($prosesinduk_data['luas_terbit']),
                "tanggal_daftar_sk_hak" => $this->security->xss_clean(tgl_indo($prosesinduk_data['tanggal_daftar_sk_hak'])),
                "tanggal_daftar_sk_haktampil" => $this->security->xss_clean($prosesinduk_data['tanggal_daftar_sk_hak']),
                "no_daftar_sk_hak" => $this->security->xss_clean($prosesinduk_data['no_daftar_sk_hak']),

                "tanggal_terbit_sk_hak" => $this->security->xss_clean(tgl_indo($prosesinduk_data['tanggal_terbit_sk_hak'])),
                "tanggal_terbit_sk_haktampil" => $this->security->xss_clean($prosesinduk_data['tanggal_terbit_sk_hak']),
                "no_terbit_sk_hak" => $this->security->xss_clean($prosesinduk_data['no_terbit_sk_hak']),

                "tanggal_daftar_shgb" => $this->security->xss_clean(tgl_indo($prosesinduk_data['tanggal_daftar_shgb'])),
                "tanggal_daftar_shgbtampil" => $this->security->xss_clean($prosesinduk_data['tanggal_daftar_shgb']),
                "no_daftar_shgb" => $this->security->xss_clean($prosesinduk_data['no_daftar_shgb']),

                "tanggal_terbit_shgb" => $this->security->xss_clean(tgl_indo($prosesinduk_data['tanggal_terbit_shgb'])),
                "tanggal_terbit_shgbtampil" => $this->security->xss_clean($prosesinduk_data['tanggal_terbit_shgb']),
                "no_terbit_shgb" => $this->security->xss_clean($prosesinduk_data['no_terbit_shgb']),

                "masa_berlaku_shgb" => $this->security->xss_clean(tgl_indo($prosesinduk_data['masa_berlaku_shgb'])),
                "masa_berlaku_shgbtampil" => $this->security->xss_clean($prosesinduk_data['masa_berlaku_shgb']),

                "target_penyelesaian" => $this->security->xss_clean(tgl_indo($prosesinduk_data['target_penyelesaian'])),
                "target_penyelesaiantampil" => $this->security->xss_clean($prosesinduk_data['target_penyelesaian']),

                "status" => $this->security->xss_clean($prosesinduk_data['status']),
                "keterangan" => $this->security->xss_clean($prosesinduk_data['keterangan']),
            );
        }
        $this->db->join('master_item', 'tbl_dtl_proses_induk.id_master_item = master_item.kode_item');
        $detail_proses_induk = $this->db->get_where('tbl_dtl_proses_induk', array('id_proses_induk' => $idd));
        $arraysub = array();
        foreach ($detail_proses_induk->result() as $r) {
            $subArray['id_dtl_proses_induk'] = $this->security->xss_clean($r->id_dtl_proses_induk);
            $subArray['id_proses_induk'] = $this->security->xss_clean($r->id_proses_induk);
            $subArray['nama_penjual'] = $this->security->xss_clean($r->nama_penjual);
            $subArray['no_gambar'] = $this->security->xss_clean($r->no_gambar);
            $subArray['id_master_item'] = $this->security->xss_clean($r->id_master_item);
            $subArray['tgl_proses_induk'] = $this->security->xss_clean($r->tgl_proses_induk);
            $subArray['keterangan'] = $this->security->xss_clean($r->keterangan);
            $arraysub[] = $subArray;
        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';
    }

    public function printsplitsing()
    {
        $idd = $this->security->xss_clean($this->uri->segment(3));
        $data['prosesinduk_data'] = $this->laporan_model->get_splitsing($idd);
        $data['detail_splitsing'] = $this->laporan_model->detail_splitsing($idd);
        $data['profil'] = $this->laporan_model->data_profil();
        if ($data['prosesinduk_data'] != true) {
            show_404();
        }

        $this->load->view('member/pembelian/printsplitsing', $data);
    }
    public function pdfsplitsing()
    {
        $idd = $this->security->xss_clean($this->uri->segment(3));
        $data['prosesinduk_data'] = $this->laporan_model->get_splitsing($idd);
        $data['detail_splitsing'] = $this->laporan_model->detail_splitsing($idd);
        $data['profil'] = $this->laporan_model->data_profil();
        if ($data['prosesinduk_data'] != true) {
            show_404();
        }

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $data = $this->load->view('member/pembelian/pdfsplitsing', $data, true);
        $mpdf->setTitle("Purchase Order " . $idd);
        $mpdf->WriteHTML($data);
        $mpdf->Output("Purchase Order " . $idd . ".pdf", "D");
    }
    public function proses_indukdetailsplit()
    {
        cekajax();
        $idd = $this->input->get("id");
        $this->db->from('master_proses_induk');
        $this->db->where('id_proses_induk', $idd);
        $query = $this->db->get()->result_array();
        foreach ($query as $po_data) {

            $result = array(
                "no_gambar" => $this->security->xss_clean($po_data['no_gambar']),
                "tanggal_daftar_sk_hak" => $this->security->xss_clean(tgl_indo($po_data['tanggal_daftar_sk_hak'])),
                "no_daftar_sk_hak" => $this->security->xss_clean($po_data['no_daftar_sk_hak']),
                "nama_surat_tanah" => $this->security->xss_clean($po_data['nama_surat_tanah']),
                "no_surat_tanah" => $this->security->xss_clean($po_data['no_surat_tanah']),
                "luas" => $this->security->xss_clean(rupiah($po_data['luas'])),
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
            );
        }

        $detailpo = $this->db->get_where('tbl_dtl_proses_induk', array('id_proses_induk' => $idd));
        foreach ($detailpo->result() as $r) {
            $subArray['id_master_item'] = $this->security->xss_clean($r->id_master_item);
            $subArray['tgl_proses_induk'] = $this->security->xss_clean($r->tgl_proses_induk);
            $subArray['keterangan'] = $this->security->xss_clean($r->keterangan);
            $arraysub[] = $subArray;
        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';
    }
    public function prosesinduktambah()
    {
        cekajax();
        $simpan = $this->laporan_model;
        $kode_item = $this->input->post("kode_item");
        if (isset($kode_item) === true and $kode_item[0] != '') {
            if ($simpan->simpandataprosesinduk()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        } else {
            $errors['jumlah_obat'] = "Mohon pilih item";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function prosesindukedit()
    {
        cekajax();
        $simpan = $this->laporan_model;
        // $validation = $this->form_validation;
        // $validation->set_rules($simpan->rulessplitsing());
        // if ($this->form_validation->run() == FALSE){
        //     $errors = $this->form_validation->error_array();
        //     $data['errors'] = $errors;
        // }else{
        $kode_item = $this->input->post("kode_item");
        if (isset($kode_item) === true and $kode_item[0] != '') {
            if ($simpan->updatedataprosesinduk()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        } else {
            $errors['tambah'] = "Mohon pilih item";
            $data['errors'] = $errors;
        }
        // }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function hapusdataprosesinduk()
    {
        cekajax();
        $hapus = $this->laporan_model;
        if ($hapus->hapusdataprosesinduk()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function prosessplittambah()
    {
        cekajax();
        $simpan = $this->laporan_model;
        $id_stok_split = $this->input->post("id_stok_split");
        if (isset($id_stok_split) === true and $id_stok_split[0] != '') {
            if ($simpan->simpandataprosessplit()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        } else {
            $errors['jumlah_obat'] = "Mohon pilih item";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function prosessplitedit()
    {
        cekajax();
        $simpan = $this->laporan_model;
        // $validation = $this->form_validation;
        // $validation->set_rules($simpan->rulessplitsing());
        // if ($this->form_validation->run() == FALSE){
        //     $errors = $this->form_validation->error_array();
        //     $data['errors'] = $errors;
        // }else{
        $id_stok_split = $this->input->post("id_stok_split");
        if (isset($id_stok_split) === true and $id_stok_split[0] != '') {
            if ($simpan->updatedataprosessplit()) {
                $data['success'] = true;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        } else {
            $errors['tambah'] = "Mohon pilih item";
            $data['errors'] = $errors;
        }
        // }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function hapusdataprosessplit()
    {
        cekajax();
        $hapus = $this->laporan_model;
        if ($hapus->hapusdataprosessplit()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function hapus_Land_Bank_Perum()
    {
        cekajax();
        $post = $this->input->post();
        $this->db->where('kode_item', $post['id']);
        if ($this->db->delete('master_item')) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

}
