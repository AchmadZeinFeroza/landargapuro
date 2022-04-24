<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') != true) {
            redirect(base_url('login'));
        }
        $this->load->model('master_model');
        $this->load->library('form_validation');
        $this->load->helper(array('string', 'security', 'form'));
    }

    public function index()
    {
        level_user('master', 'index', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['total_penjual'] = $this->db->count_all('master_penjual');
        $data['total_pembeli'] = $this->db->count_all('master_pembeli');
        $data['total_agen'] = $this->db->count_all('tbl_target');
        $data['total_distributor'] = $this->db->count_all('master_distributor');
        $data['total_regional'] = $this->db->count_all('master_regional');
        $data['total_item'] = $this->db->count_all('master_item');
        $this->load->view('member/master/beranda', $data);
    }
    public function absensi()
    {
        $data['absensi'] = $this->master_model->getdataabsensibyid($this->session->userdata('idadmin'));
        $data['listabsensi'] = $this->master_model->getlistabsensi();
        $this->load->view('member/master/absensi', $data);
    }
    public function query($value = '')
    {
        echo "<pre>";
        print_r($this->session->userdata());
        print_r($this->session->flashdata('query'));
        echo "</pre>";
    }
    public function abseninsert()
    {
        $data['keterangan'] = $this->input->post('keterangan');
        $data['status'] = $this->input->post('status');
        $data['id_admin'] = $this->session->userdata('idadmin');
        $this->master_model->absensiinput($data);
        redirect('master/absensi', 'refresh');
    }
    public function target($id)
    {
        // level_user('master','target',$this->session->userdata('kategori'),'read') > 0 ? '': show_404();
        $data['id_perumahan'] = $id;
        $data['nama_regional'] = $this->db->where("id", $id)->get('master_regional')->result();
        // print_r($data['nama_regional'][0]->nama_regional);
        // exit();
        $data['regional'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['penjual'] = $this->db->order_by("id", "DESC")->get('master_penjual')->result();
        $this->load->view('member/master/target', $data);
    }
    public function datatarget($id)
    {
        // cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_target_datatable($id);
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id_target) . '">Hapus</a></li>';
            $tomboledit = '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_target) . '">Edit</a></li>';
            $row[] = ' <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            // $target = explode(';', $r->target);
            $stringtargetluas = $r->target_luas;
            $stringtargetbid = $r->target_bid;
            $targetluas = explode(';', $stringtargetluas);
            $targetbid = explode(';', $stringtargetbid);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->tahun);
            for ($i = 0; $i < 12; $i++) {
                $row[] = $this->security->xss_clean($targetbid[$i]);
                $row[] = $this->security->xss_clean($targetluas[$i]);
            }
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_target($id),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_target($id),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function targettambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulestarget());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatatarget()) {
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
    public function targetdetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->get_where('tbl_target', array('id' => $idd), 1);
        $result = array(
            "nama_target" => $this->security->xss_clean($query->row()->nama_target),
            "alamat" => $this->security->xss_clean($query->row()->alamat),
            "telepon" => $this->security->xss_clean($query->row()->telepon),
            "id_regional" => $this->security->xss_clean($query->row()->id_regional),
            "id_penjual" => $this->security->xss_clean($query->row()->id_penjual),
        );
        echo '[' . json_encode($result) . ']';
    }
    public function targetedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulestarget());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedatatarget()) {
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
    public function targethapus()
    {
        // cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatatarget()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function distributor()
    {
        level_user('master', 'target', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['regional'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['penjual'] = $this->db->order_by("id", "DESC")->get('master_penjual')->result();
        $this->load->view('member/master/distributor', $data);
    }
    public function datadistributor()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_distributor_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'target', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'target', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->nama_distributor);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->telepon);
            $row[] = $this->security->xss_clean($r->alamat);
            $row[] = $this->security->xss_clean($r->nama_penjual);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_distributor(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_distributor(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function distributortambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesdistributor());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatadistributor()) {
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
    public function distributordetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->get_where('master_distributor', array('id' => $idd), 1);
        $result = array(
            "nama_distributor" => $this->security->xss_clean($query->row()->nama_distributor),
            "alamat" => $this->security->xss_clean($query->row()->alamat),
            "telepon" => $this->security->xss_clean($query->row()->telepon),
            "id_regional" => $this->security->xss_clean($query->row()->id_regional),
            "id_penjual" => $this->security->xss_clean($query->row()->id_penjual),
        );
        echo '[' . json_encode($result) . ']';
    }
    public function distributoredit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesdistributor());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedatadistributor()) {
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
    public function distributorhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatadistributor()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function pembeli()
    {
        $data['penjual'] = $this->db->order_by("id", "DESC")->get('master_penjual')->result();

        $this->load->view('member/master/pembeli', $data);
    }

    public function datapembeli()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_pembeli_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'pembeli', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'pembeli', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->id) . '">Detail</a></li>
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->nama_pembeli);
            $row[] = $this->security->xss_clean($r->alamat);
            $row[] = $this->security->xss_clean($r->hp);
            $row[] = $this->security->xss_clean($r->stok_awal);
            $row[] = $this->security->xss_clean($r->total);
            $row[] = $this->security->xss_clean($r->jenis_pembeli);
            $row[] = $this->security->xss_clean($r->luas_sawah);
            $row[] = $this->security->xss_clean($r->nama_penjual);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_pembeli(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_pembeli(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function pembelitambah()
    {
        cekajax();
        $post = $this->input->post();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulespembeli());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $insert_id = $simpan->simpandatapembeli();
            if ($insert_id > 0) {
                $data['success'] = true;
                $data['pembeli'] = $post["nama_pembeli"];
                $data['id_pembeli'] = $insert_id;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function pembelidetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->select("nama_pembeli,hp,master_pembeli.alamat,stok_awal, total,jenis_pembeli,nama_penjual,luas_sawah,master_penjual.id as id_penjual")->join('master_penjual', 'master_pembeli.id_penjual=master_penjual.id')->get_where('master_pembeli', array('master_pembeli.id' => $idd), 1);

        $result = array(
            "nama_pembeli" => $this->security->xss_clean($query->row()->nama_pembeli),
            "alamat" => $this->security->xss_clean($query->row()->alamat),
            "hp" => $this->security->xss_clean($query->row()->hp),
            "stok_awal" => $this->security->xss_clean($query->row()->stok_awal),
            "total" => $this->security->xss_clean($query->row()->total),
            "jenis_pembeli" => $this->security->xss_clean($query->row()->jenis_pembeli),
            "luas_sawah" => $this->security->xss_clean($query->row()->luas_sawah),
            "nama_penjual" => $this->security->xss_clean($query->row()->nama_penjual),
            "id_penjual" => $this->security->xss_clean($query->row()->id_penjual),

        );
        echo '[' . json_encode($result) . ']';
    }
    public function pembeliedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulespembeli());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $simpan->updatedatapembeli();
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function pembelihapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatapembeli()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors = "fail";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function perumahan()
    {
        level_user('master', 'perumahan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['listkabupaten'] = $this->db->order_by("id_kabupaten", "DESC")->get('kabupaten')->result();
        $data['status'] = $this->db->order_by("id_status_regional", "DESC")->get('master_status_regional')->result();
        $this->load->view('member/master/perumahan', $data);
    }

    public function perumahanluarijin()
    {
        level_user('master', 'perumahan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['listkabupaten'] = $this->db->order_by("id_kabupaten", "DESC")->get('kabupaten')->result();
        $data['status'] = $this->db->order_by("id_status_regional", "DESC")->get('master_status_regional')->result();
        $this->load->view('member/master/perumahanluarijin', $data);
    }

    public function perumahandalamijin()
    {
        level_user('master', 'perumahan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['listkabupaten'] = $this->db->order_by("id_kabupaten", "DESC")->get('kabupaten')->result();
        $data['status'] = $this->db->order_by("id_status_regional", "DESC")->get('master_status_regional')->result();
        $this->load->view('member/master/perumahandalamijin', $data);
    }
    public function datakategori($status = '')
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_kategori_datatable($status);
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $linktarget = site_url('Master/target/') . $r->id;
            $tomboltarget = level_user('master', 'perumahan', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="' . $linktarget . '" >Target</a></li>' : '';
            $tomboledit = level_user('master', 'perumahan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tomboltarget . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->id);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->nama_kabupaten . ' / ' . $r->nama_kecamatan . ' / ' . $r->nama_desa);
            $row[] = $this->security->xss_clean($r->nama_status);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_kategori($status),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_kategori($status),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function getkecamatan()
    {
        $id = $this->input->post('id');
        $data = $this->master_model->getkecamatan($id);
        echo json_encode($data);
    }
    public function getdesa()
    {
        $id = $this->input->post('id');
        $hasil = $this->db->query("SELECT * FROM desa WHERE id_kecamatan='$id'")->result();
        $data = $this->master_model->getdesa($id);
        echo json_encode($data);
    }
    public function kategoritambah()
    {
        cekajax();
        $simpan = $this->master_model;

        if ($simpan->simpandatakategori()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }

        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function kategoridetail()
    {
        cekajax();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $this->db->join('kecamatan', 'master_regional.id_kecamatan = kecamatan.id_kecamatan', 'left');
        $this->db->join('desa', 'master_regional.lokasi = desa.id_desa', 'left');
        $query = $this->db->get_where('master_regional', array('id' => $this->input->get("id")), 1);
        $result = array(
            "id" => $this->security->xss_clean($query->row()->id),
            "nama_regional" => $this->security->xss_clean($query->row()->nama_regional),
            "id_kabupaten" => $this->security->xss_clean($query->row()->id_kabupaten),
            "id_kecamatan" => $this->security->xss_clean($query->row()->id_kecamatan),
            "nama_desa" => $this->security->xss_clean($query->row()->nama_desa),
            "nama_kecamatan" => $this->security->xss_clean($query->row()->nama_kecamatan),
            "lokasi" => $this->security->xss_clean($query->row()->lokasi),
            "nama_status" => $this->security->xss_clean($query->row()->nama_status),
            "status_regional" => $this->security->xss_clean($query->row()->status_regional),
            "nama_status_regional" => $this->security->xss_clean($query->row()->nama_status),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function stok_splittambah()
    {
        cekajax();
        $simpan = $this->master_model;

        if ($simpan->simpandatastok_split()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }

        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function jual_stok()
    {
        cekajax();
        $simpan = $this->master_model;

        if ($simpan->simpandatajual_stok()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }

        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function stoksplitdetail()
    {
        cekajax();
        $query = $this->db->get_where('tbl_stok_split', array('id_stok_split' => $this->input->get("id_stok_split")), 1);
        $result = array(
            "id_stok_split" => $this->security->xss_clean($query->row()->id_stok_split),
            "blok" => $this->security->xss_clean($query->row()->blok),
            "luas_teknik" => $this->security->xss_clean($query->row()->luas_teknik),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function stok_splitedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        if ($simpan->updatedatastok_split()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        //$data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function stok_splithapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatastok_split()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function hapus_jual()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatajual()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function stok_splitjual()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->jualdatastok_split()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menjual stok";
        } else {
            $errors['fail'] = "gagal menjual stok";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function kategoriedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        if ($post["id"] != $post["id"]) {
            $data['success'] = true;
            $data['message'] = "Data tidak berubah";
        } else {
            $validation = $this->form_validation;
            $validation->set_rules($simpan->ruleskategori());
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                $data['errors'] = $errors;
            } else {
                if ($simpan->updatedatakategori()) {
                    $data['success'] = true;
                    $data['message'] = "Berhasil menyimpan data";
                } else {
                    $errors['fail'] = "gagal melakukan update data";
                    $data['errors'] = $errors;
                }
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function kategorihapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatakategori()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function satuan()
    {
        level_user('master', 'satuan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->load->view('member/master/satuan');
    }
    public function datasatuan()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_satuan_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'satuan', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'satuan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->id);
            $row[] = $this->security->xss_clean($r->isi_persatuan);
            $row[] = $this->security->xss_clean($r->satuan_besar);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_satuan(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_satuan(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function satuantambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulessatuan());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatasatuan()) {
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

    public function satuanedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        if ($post["satuan_besar"] == $post["idd"]) {
            $data['success'] = true;
            $data['message'] = "Data satuan besar tidak boleh sama";
        } else {
            $validation = $this->form_validation;
            $validation->set_rules('isi_persatuan', 'Jumlah', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                $data['errors'] = $errors;
            } else {
                if ($simpan->updatedatasatuan()) {
                    $data['success'] = true;
                    $data['message'] = "Berhasil menyimpan data";
                } else {
                    $errors['fail'] = "gagal melakukan update data";
                    $data['errors'] = $errors;
                }
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function satuanhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatasatuan()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function sertifikat_tanah()
    {
        $this->load->view('member/master/sertifikat_tanah');
    }
    public function excel()
    {
        $this->load->view('member/master/excel');
    }

    public function data_excel()
    {
        cekajax();
        $list = $this->master_model->manajemen_excel();
        foreach ($list as $r) {
            $row = array();
            $tomboledit = level_user('master', 'satuan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->id);
            $row[] = $this->security->xss_clean($r->nama);
            $row[] = $this->security->xss_clean($r->posisi);
            $data[] = $row;
        }
        $result = array(
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function data_excel_detail()
    {
        cekajax();
        $query = $this->db->get_where('excel', array('id' => $this->input->get("id")), 1);
        $result = array(
            "id" => $this->security->xss_clean($query->row()->id),
            "nama" => $this->security->xss_clean($query->row()->nama),
            "posisi" => $this->security->xss_clean($query->row()->posisi),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function data_excel_edit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();

        $validation = $this->form_validation;
        if ($simpan->update_data_excel()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }

        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function datasertifikat_tanah()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_sertifikat_tanah_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'satuan', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id_sertifikat_tanah) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'satuan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_sertifikat_tanah) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->id_sertifikat_tanah);
            $row[] = $this->security->xss_clean($r->kode_sertifikat);
            $row[] = $this->security->xss_clean($r->nama_sertifikat);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_sertifikat_tanah(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_sertifikat_tanah(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function sertifikat_tanahtambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulessertifikat_tanah());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatasertifikat_tanah()) {
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

    public function sertifikat_tanahdetail()
    {
        cekajax();
        $query = $this->db->get_where('tbl_sertifikat_tanah', array('id_sertifikat_tanah' => $this->input->get("id")), 1);
        $result = array(
            "id_sertifikat_tanah" => $this->security->xss_clean($query->row()->id_sertifikat_tanah),
            "kode_sertifikat" => $this->security->xss_clean($query->row()->kode_sertifikat),
            "nama_sertifikat" => $this->security->xss_clean($query->row()->nama_sertifikat),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function sertifikat_tanahedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();

        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulessertifikat_tanah());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedatasertifikat_tanah()) {
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
    public function sertifikat_tanahhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatasertifikat_tanah()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function jenis_pengalihan()
    {
        $this->load->view('member/master/jenis_pengalihan');
    }
    public function datajenis_pengalihan()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_jenis_pengalihan_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'satuan', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id_pengalihan) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'satuan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_pengalihan) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->id_pengalihan);
            $row[] = $this->security->xss_clean($r->kode_pengalihan);
            $row[] = $this->security->xss_clean($r->nama_pengalihan);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_jenis_pengalihan(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_jenis_pengalihan(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function jenis_pengalihantambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesjenis_pengalihan());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatajenis_pengalihan()) {
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

    public function jenis_pengalihandetail()
    {
        cekajax();
        $query = $this->db->get_where('tbl_jenis_pengalihan', array('id_pengalihan' => $this->input->get("id")), 1);
        $result = array(
            "id_pengalihan" => $this->security->xss_clean($query->row()->id_pengalihan),
            "kode_pengalihan" => $this->security->xss_clean($query->row()->kode_pengalihan),
            "nama_pengalihan" => $this->security->xss_clean($query->row()->nama_pengalihan),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function jenis_pengalihanedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();

        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesjenis_pengalihan());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedatajenis_pengalihan()) {
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
    public function jenis_pengalihanhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatajenis_pengalihan()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function items()
    {
        level_user('master', 'items', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $data['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');

        $data['perumahan2'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $data['nama_regional'] = $this->master_model->perumahan();
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();
        $data['jenis_pengalihan'] = $this->db->order_by("id_pengalihan", "DESC")->get('tbl_jenis_pengalihan')->result();
        $data['status'] = $this->master_model->getstatus();
        $this->load->view('member/master/master_item', $data);
    }
    public function pageitem()
    {
        // $data['periode'] = $this->input->get('periode',true);
        $data['firstdate'] = $this->input->get('firstdate');
        $data['lastdate'] = $this->input->get('lastdate');
        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $data['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();

        if ($data['id_perumahan'] != '') {
            $data['perumahan'] = $this->master_model->getperumahan($data['id_perumahan'], $data['firstdate'], $data['lastdate']);
            $data['dataperumahan'] = $this->master_model->getdataperumahan($data['id_perumahan']);
            $this->load->view('member/master/items_view', $data);

        } else {
            // $data['perumahan']='';
            $data['perumahandalamijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '1')->get('master_regional')->result();
            $data['perumahanluarijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '2')->get('master_regional')->result();
            $data['perumahanlokasi'] = $this->db->order_by("id", "DESC")->where('status_regional', '3')->get('master_regional')->result();
            $this->load->view('member/master/items_view_all', $data);

            // $data['perumahan2'] = $this->db->order_by("id","DESC")->get('master_regional')->result();
        }
    }

    public function dataitems()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_item_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $linkbayar = site_url('keuangan/bayar_tanah/') . $r->kode_item;
            $tomboldetailbayar = '<li><a href="' . $linkbayar . '">Pembayaran</a></li>';
            $tombolhapus = level_user('master', 'items', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Detail</a></li>
        ' . $tomboldetailbayar . '
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            if ($r->tanggal_pengalihan != null) {
                $tgl_pengalihan = tgl_indo($r->tanggal_pengalihan);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($r->id_perumahan == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $r->nama_regional;
            }
            if ($r->total_harga_pengalihan == 0) {
                $harga_satuan = 0;
                $total_harga_pengalihan = 0;
            } else {
                $total_harga_pengalihan = $r->total_harga_pengalihan;
                $harga_satuan = $r->total_harga_pengalihan / $r->luas_surat;
            }
            if ($r->nilai == 0 || $r->nilai == '') {
                $nilai = 0;
            } else {
                $nilai = $r->nilai;
            }
            if ($r->lain == 0 || $r->lain == '') {
                $lain = 0;
            } else {
                $lain = $r->lain;
            }

            $totalbiayalain = $lain;
            $totalharga_biaya = $total_harga_pengalihan + $nilai + $totalbiayalain;
            if ($totalharga_biaya == 0) {
                $harga_perm = 0;
            } else {
                $harga_perm = $totalharga_biaya / $r->luas_ukur;

            }
            $row[] = $this->security->xss_clean($perumahan);
            $row[] = $this->security->xss_clean($r->kode_item);
            $row[] = $this->security->xss_clean(tgl_indo($r->tanggal_pembelian));
            $row[] = $this->security->xss_clean($r->nama_penjual);
            $row[] = $this->security->xss_clean($r->nama_surat_tanah);
            $row[] = $this->security->xss_clean($r->kode_sertifikat1);
            // $row[] = $this->security->xss_clean($r->kode_sertifikat2);
            $row[] = $this->security->xss_clean($r->no_gambar);
            $row[] = $this->security->xss_clean($r->jumlah_bidang);
            $row[] = $this->security->xss_clean($r->luas_surat);
            $row[] = $this->security->xss_clean($r->luas_ukur);
            $row[] = $this->security->xss_clean($r->no_pbb);
            $row[] = $this->security->xss_clean($r->luas_pbb_bangunan);
            $row[] = $this->security->xss_clean($r->njop_bangunan);
            $row[] = $this->security->xss_clean(rupiah($harga_satuan));
            $row[] = $this->security->xss_clean(rupiah($r->total_harga_pengalihan));
            $row[] = $this->security->xss_clean($r->nama_makelar);
            $row[] = $this->security->xss_clean(rupiah($r->nilai));
            $row[] = $this->security->xss_clean($tgl_pengalihan);
            $row[] = $this->security->xss_clean($r->akta_pengalihan);
            $row[] = $this->security->xss_clean($r->nama_pengalihan);
            $row[] = $this->security->xss_clean(rupiah($lain));
            $row[] = $this->security->xss_clean(rupiah($totalbiayalain));
            $row[] = $this->security->xss_clean(rupiah($totalharga_biaya));
            $row[] = $this->security->xss_clean(rupiah($harga_perm));
            $row[] = $this->security->xss_clean($r->keterangan);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_item(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_item(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function itemstambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesitems());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandataitems()) {
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

    public function itemdetail()
    {
        cekajax();
        $idd = $this->input->get("id");
        $this->db->join('master_regional', 'master_item.id_perumahan = master_regional.id', 'left');
        $this->db->join('tbl_sertifikat_tanah a', 'master_item.status_surat_tanah1 = a.id_sertifikat_tanah', 'left');
        // $this->db->join('tbl_sertifikat_tanah b', 'master_item.status_surat_tanah2 = b.id_sertifikat_tanah', 'left');
        $this->db->select('master_item.*,master_regional.*,a.nama_sertifikat as nama_sertifikat1');
        $query = $this->db->get_where('master_item', array('kode_item' => $idd), 1);
        if ($query->row()->total_harga_pengalihan == '' || $query->row()->luas_surat == '' || $query->row()->luas_surat == 0) {
            $harga_satuan = 0;
        } else {
            $harga_satuan = $query->row()->total_harga_pengalihan / $query->row()->luas_surat;

        }
        if ($query->row()->nilai == 0 || $query->row()->nilai == '') {
            $nilai = 0;
        } else {
            $nilai = $query->row()->nilai;
        }
        if ($query->row()->lain == 0 || $query->row()->lain == '') {
            $lain = 0;
        } else {
            $lain = $query->row()->lain;
        }
        $totalbiayalain = $lain;
        $totalharga_biaya = $query->row()->total_harga_pengalihan + $nilai + $totalbiayalain;
        if ($query->row()->luas_surat == '' || $totalharga_biaya == 0) {
            $harga_perm = 0;
        } else {
            $harga_perm = $totalharga_biaya / $query->row()->luas_surat;
        }

        $result = array(

            "kode_item" => $this->security->xss_clean($query->row()->kode_item),
            "tanggal_pembelian" => $this->security->xss_clean($query->row()->tanggal_pembelian),
            "nama_penjual" => $this->security->xss_clean($query->row()->nama_penjual),
            "nama_surat_tanah" => $this->security->xss_clean($query->row()->nama_surat_tanah),
            "status_surat_tanah1" => $this->security->xss_clean($query->row()->status_surat_tanah1),
            // "status_surat_tanah2" => $this->security->xss_clean($query->row()->status_surat_tanah2),
            "nama_sertifikat1" => $this->security->xss_clean($query->row()->nama_sertifikat1),
            // "nama_sertifikat2" => $this->security->xss_clean($query->row()->nama_sertifikat2),
            "keterangan1" => $this->security->xss_clean($query->row()->keterangan1),
            // "keterangan2" => $this->security->xss_clean($query->row()->keterangan2),
            "no_gambar" => $this->security->xss_clean($query->row()->no_gambar),
            "jumlah_bidang" => $this->security->xss_clean($query->row()->jumlah_bidang),
            "luas_surat" => $this->security->xss_clean($query->row()->luas_surat),
            "luas_ukur" => $this->security->xss_clean($query->row()->luas_ukur),
            "no_pbb" => $this->security->xss_clean($query->row()->no_pbb),
            "luas_pbb_bangunan" => $this->security->xss_clean($query->row()->luas_pbb_bangunan),
            "njop_bangunan" => $this->security->xss_clean($query->row()->njop_bangunan),
            "luas_pbb_bumi" => $this->security->xss_clean($query->row()->luas_pbb_bumi),
            "njop_bumi" => $this->security->xss_clean($query->row()->njop_bumi),
            "total_harga_pengalihantampil" => $this->security->xss_clean(rupiah($query->row()->total_harga_pengalihan)),
            "total_harga_pengalihan" => $this->security->xss_clean($query->row()->total_harga_pengalihan),
            "satuan_harga_pengalihantampil" => $this->security->xss_clean(rupiah($harga_satuan)),
            "nama_makelar" => $this->security->xss_clean($query->row()->nama_makelar),
            "nilaitampil" => $this->security->xss_clean(rupiah($nilai)),
            "nilai" => $this->security->xss_clean($nilai),
            "tanggal_pengalihan" => $this->security->xss_clean($query->row()->tanggal_pengalihan),
            "akta_pengalihan" => $this->security->xss_clean($query->row()->akta_pengalihan),
            "nama_pengalihan" => $this->security->xss_clean($query->row()->nama_pengalihan),
            "atas_nama_pbb" => $this->security->xss_clean($query->row()->atas_nama_pbb),
            "laintampil" => $this->security->xss_clean(rupiah($lain)),
            "lain" => $this->security->xss_clean($query->row()->lain),
            "keterangan_lain" => $this->security->xss_clean($query->row()->keterangan_lain),
            "harga_permtampil" => $this->security->xss_clean(rupiah($harga_perm)),
            "harga_perm" => $this->security->xss_clean($harga_perm),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
            "id_perumahan" => $this->security->xss_clean($query->row()->id_perumahan),
            "harga_perm" => $this->security->xss_clean($harga_perm),
            "harga_permtampil" => $this->security->xss_clean(rupiah($harga_perm)),
            "nama_regional" => $this->security->xss_clean($query->row()->nama_regional),
            "status_order_akta" => $this->security->xss_clean($query->row()->status_order_akta),
            "tanggal_proses" => $this->security->xss_clean($query->row()->tanggal_proses),
            "jenis_pengalihan_hak" => $this->security->xss_clean($query->row()->jenis_pengalihan_hak),
            "status_teknik" => $this->security->xss_clean($query->row()->status_teknik),
            "jenis_pengalihan" => $this->security->xss_clean($query->row()->jenis_pengalihan),
            "tanggal_pengalihan" => $this->security->xss_clean(tgl_indo($query->row()->tanggal_pengalihan)),
            "tanggal_pengalian_ymd" => $this->security->xss_clean($query->row()->tanggal_pengalihan),
            "terima_finance" => $this->security->xss_clean($query->row()->terima_finance),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function itemsedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesitems());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedataitems()) {
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

    public function editlandbank()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        $simpan->updatedatalandbank();exit;
        if ($simpan->updatedatalandbank()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;

        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function updatemasteritem()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();
        $data = array('kode_item' => $post['idd'],
            'status_order_akta' => $post['status_order_akta'],
            'tanggal_proses' => $post['tanggal_proses'],
            'akta_pengalihan' => $post['akta_pengalihan'],
            'tanggal_pengalihan' => $post['tanggal_pengalihan'],
            'nama_pengalihan' => $post['nama_pengalihan'],
            'jenis_pengalihan_hak' => $post['jenis_pengalihan_hak'],
            'terima_finance' => $post['terima_finance'],
            'keterangan' => $post['keterangan'],
        );
        if ($simpan->updatemasteritem($data)) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;

        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function itemshapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdataitem()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function racikan()
    {
        level_user('master', 'racikan', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['itemobat'] = $this->db->get_where('master_item', array('jenis' => 'obat'))->result();
        $data['kategori'] = $this->db->get('master_regional')->result();
        $this->load->view('member/master/racikan', $data);
    }

    public function dataracikan()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_dataracikan_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombolhapus = level_user('master', 'racikan', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Hapus</a></li>' : '';
            $tomboledit = level_user('master', 'racikan', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Edit</a></li>' : '';
            $row[] = ' <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->kode_item) . '">Detail</a></li>
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->kode_item);
            $row[] = $this->security->xss_clean($r->nama_item);
            $row[] = $this->security->xss_clean(rupiah($r->harga_jual));
            $row[] = $this->security->xss_clean(rupiah($r->upah_peracik));
            $row[] = $this->security->xss_clean($r->aturan_pakai);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_dataracikan(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_dataracikan(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function racikandetail()
    {
        cekajax();
        $idd = $this->input->get("id");
        $query = $this->db->get_where('master_item', array('kode_item' => $idd), 1);
        $result = array(
            "kode_item" => $this->security->xss_clean($query->row()->kode_item),
            "jenis" => $this->security->xss_clean($query->row()->jenis),
            "kategori" => $this->security->xss_clean($query->row()->kategori),
            "satuan" => $this->security->xss_clean($query->row()->satuan),
            "nama_item" => $this->security->xss_clean($query->row()->nama_item),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
            "lokasi" => $this->security->xss_clean($query->row()->lokasi),
            "harga_jual" => $this->security->xss_clean(rupiah($query->row()->harga_jual)),
            "harga_jual_edit" => $this->security->xss_clean($query->row()->harga_jual),
            "aturan_pakai" => $this->security->xss_clean($query->row()->aturan_pakai),
            "upah_peracik" => $this->security->xss_clean(rupiah($query->row()->upah_peracik)),
            "upah_peracik_edit" => $this->security->xss_clean($query->row()->upah_peracik),
            "gambar" => $this->security->xss_clean($query->row()->gambar),
        );

        $subitem = $this->master_model->get_dataracikan($idd);
        foreach ($subitem as $r) {
            $subArray['kode_item'] = $r->kode_obat;
            $subArray['nama_item'] = $r->nama_item;
            $subArray['jumlah_obat_dibuat'] = $r->jumlah_obat_dibuat;
            $subArray['jumlah_obat_dipakai'] = $r->jumlah_obat_dipakai;
            $arraysub[] = $subArray;
        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';
    }

    public function pilihanitem()
    {
        cekajax();
        $get = $this->input->get();
        $id_perumahan = $get['id_perumahan'];
        $list = $this->master_model->get_pilihanitem_datatable($id_perumahan);

        $data = array();
        foreach ($list as $r) {
            $row = array();
            $row[] = $this->security->xss_clean($r->kode_item);
            $row[] = $this->security->xss_clean($r->nama_penjual);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = '
        <a onclick="pilihitem(this)"  data-nama_regional="' . $r->nama_regional . '" data-nama_penjual="' . $r->nama_penjual . '" data-no_gambar="' . $r->no_gambar . '" data-keterangan="' . $r->keterangan . '" data-no_pbb="' . $r->no_pbb . '"  data-kode_item="' . $r->kode_item . '" class="mt-xs mr-xs btn btn-info datarowobat" role="button"><i class="fa fa-check-square-o"></i></a>
        ';
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_pilihanitem($id_perumahan),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_pilihanitem($id_perumahan),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function pilihaninduk()
    {
        cekajax();
        $get = $this->input->get();
        $id_perumahan = $get['id_perumahan'];
        $list = $this->master_model->get_prosesindukdatatable($id_perumahan);
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $row[] = $this->security->xss_clean($r->id_proses_induk);
            $row[] = $this->security->xss_clean($r->no_terbit_shgb);
            $row[] = $this->security->xss_clean($r->nama_surat_tanah);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = '
        <a onclick="pilihinduk(this)"  data-nama_regional="' . $r->nama_regional . '" data-nama_penjual="' . $r->penjual . '" data-no_terbit_shgb="' . $r->no_terbit_shgb . '" data-keterangan="' . $r->keterangan . '" data-no_terbit_shgb="' . $r->no_terbit_shgb . '" data-luas_daftar="' . $r->luas_daftar . '" data-luas_terbit="' . $r->luas_terbit . '" data-no_daftar_shgb="' . $r->no_daftar_shgb . '" data-tanggal_daftar_shgb="' . $r->tanggal_daftar_shgb . '" data-no_terbit_shgb="' . $r->no_terbit_shgb . '" data-tanggal_terbit_shgb="' . $r->tanggal_terbit_shgb . '" data-masa_berlaku="' . $r->masa_berlaku_shgb . '" data-nama_surat_tanah="' . $r->nama_surat_tanah . '"  data-id_induk="' . $r->id_proses_induk . '" class="mt-xs mr-xs btn btn-info datarowobat" role="button"><i class="fa fa-check-square-o"></i></a>
        ';
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatableproses_induk($id_perumahan),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_prosesinduk($id_perumahan),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function pilihanblok()
    {
        cekajax();
        $get = $this->input->get();
        $id_perumahan = $get['id_perumahan'];
        $list = $this->master_model->get_blokdatatable($id_perumahan);
        $data = array();
        foreach ($list as $r) {
            $totalluasstok = $this->master_model->gettotalluasstok($r->id_stok_split);
            $row = array();
            $row[] = $this->security->xss_clean($r->id_stok_split);
            $row[] = $this->security->xss_clean($r->blok);
            $row[] = $this->security->xss_clean($r->luas_teknik);
            $row[] = $this->security->xss_clean($totalluasstok);
            $row[] = $this->security->xss_clean($r->luas_teknik - $totalluasstok);
            $row[] = '
        <a onclick="pilihblok(this)"  data-id_stok_split="' . $r->id_stok_split . '" data-blok="' . $r->blok . '" data-luas_teknik="' . $r->luas_teknik . '" class="mt-xs mr-xs btn btn-info datarowobat" role="button"><i class="fa fa-check-square-o"></i></a>
        ';
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatableblok($id_perumahan),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_blok($id_perumahan),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function racikantambah()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesitems());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $kode_obat = $this->input->post("kode_obat");
            if (isset($kode_obat) === true and $kode_obat[0] != '') {
                if ($simpan->simpandataracikan()) {
                    $data['success'] = true;
                    $data['message'] = "Berhasil menyimpan data";
                } else {
                    $errors['fail'] = "gagal melakukan update data";
                    $data['errors'] = $errors;
                }
            } else {
                $errors['jumlah_obat'] = "Mohon pilih obat yang ingin diracik";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function racikanhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdataracikan()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function racikanedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesitemsedit());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $kode_obat = $this->input->post("kode_obat");
            if (isset($kode_obat) === true and $kode_obat[0] != '') {
                if ($simpan->updatedataracikan()) {
                    $data['success'] = true;
                    $data['message'] = "Berhasil menyimpan data";
                } else {
                    $errors['fail'] = "gagal melakukan update data";
                    $data['errors'] = $errors;
                }
            } else {
                $errors['jumlah_obat'] = "Mohon pilih obat yang ingin diracik";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    // penjual
    public function penjual()
    {
        $data['regional'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $this->load->view('member/master/penjual', $data);
    }

    public function datapenjual()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_penjual_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tomboldaftar = '';
            if ($r->id_admin == '0') {
                $tomboldaftar =
                '
            <div class="btn-group dropup">
            <a class="mb-xs mt-xs mr-xs btn btn-primary href="#" onclick="daftar_akun(this)" data-id_penjual="' . $this->security->xss_clean($r->id) . '" data-nama_penjual="' . $this->security->xss_clean($r->nama_penjual) . '">Daftar</a>
            </div>
            ';
            }
            $tombolhapus = '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($r->id) . '">Hapus</a></li>';
            $tomboledit = '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id) . '">Edit</a></li>';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->id) . '">Detail</a></li>
        ' . $tomboledit . '
        ' . $tombolhapus . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean($r->nama_penjual);
            $row[] = $this->security->xss_clean($r->nik);
            $row[] = $this->security->xss_clean($r->target);
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->alamat);
            $row[] = $this->security->xss_clean($r->kontak);
            $row[] = $tomboldaftar;
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_penjual(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_penjual(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function penjualtambah()
    {
        cekajax();
        $post = $this->input->post();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulespenjual());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $insert_id = $simpan->simpandatapenjual();
            if ($insert_id > 0) {
                $data['success'] = true;
                $data['penjual'] = $post["nama_penjual"];
                $data['id_penjual'] = $insert_id;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function penjualdetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->select("master_penjual.id as id_penjual,nama_penjual, kontak, alamat, nik,nama_regional,regional,target")->join('master_regional', 'master_regional.id=master_penjual.regional')->get_where('master_penjual', array('master_penjual.id' => $idd), 1);

        $result = array(
            "id_penjual" => $this->security->xss_clean($query->row()->id_penjual),
            "nama_penjual" => $this->security->xss_clean($query->row()->nama_penjual),
            "alamat" => $this->security->xss_clean($query->row()->alamat),
            "kontak" => $this->security->xss_clean($query->row()->kontak),
            "nama_regional" => $this->security->xss_clean($query->row()->nama_regional),
            "regional" => $this->security->xss_clean($query->row()->regional),
            "nik" => $this->security->xss_clean($query->row()->nik),
            "target" => $this->security->xss_clean($query->row()->target),
        );
        echo '[' . json_encode($result) . ']';
    }
    public function penjualedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulespenjual());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $simpan->updatedatapenjual();
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function penjualhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdatapenjual()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors = "fail";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
// proses_induk
    public function proses_induk($id_proses_induk)
    {
        level_user('master', 'proses_induk', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $data['id_proses_induk'] = $id_proses_induk;
        $this->load->view('member/master/proses_induk', $data);
    }

    public function dataproses_induk()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->master_model->get_proses_induk_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            // $tombolhapus = level_user('master','proses_induk',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($r->id_dtl_proses_induk).'">Hapus</a></li>':'';

            $tomboledit = level_user('master', 'proses_induk', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_dtl_proses_induk) . '">Edit</a></li>' : '';
            $row[] = '
        <div class="btn-group dropup">
        <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($r->id_proses_induk) . '">Detail</a></li>
        ' . $tomboledit . '
        </ul>
        </div>
        ';
            $row[] = $this->security->xss_clean(tgl_indo($r->tgl_proses_induk));
            $row[] = $this->security->xss_clean($r->nama_regional);
            $row[] = $this->security->xss_clean($r->luas_surat);
            $row[] = $this->security->xss_clean($r->luas_ukur);
            $row[] = $this->security->xss_clean($r->keterangan);
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->master_model->count_all_datatable_proses_induk(),
            "recordsFiltered" => $this->master_model->count_filtered_datatable_proses_induk(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function proses_induktambah()
    {
        cekajax();
        $post = $this->input->post();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesproses_induk());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $insert_id = $simpan->simpandataproses_induk();
            if ($insert_id > 0) {
                $data['success'] = true;
                $data['proses_induk'] = $post["keterangan"];
                $data['id_proses_induk'] = $insert_id;
                $data['message'] = "Berhasil menyimpan data";
            } else {
                $errors['fail'] = "gagal melakukan update data";
                $data['errors'] = $errors;
            }
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function proses_indukdetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $this->db->select("a.*,b.luas_surat,b.luas_ukur,c.nama_regional");
        $this->db->from('master_proses_induk a');
        $this->db->where('id_proses_induk', $idd);
        $this->db->join('master_item b', 'b.kode_item = a.id_master_item', 'left');
        $this->db->join('master_regional c', 'b.id_perumahan = c.id', 'left');
        $query = $this->db->get();

        $result = array(
            "idd" => $this->security->xss_clean($idd),
            "tgl_proses_induk" => $this->security->xss_clean($query->row()->tgl_proses_induk),
            "tgl_proses_induk_indo" => $this->security->xss_clean(tgl_indo($query->row()->tgl_proses_induk)),
            "id_proses_induk" => $this->security->xss_clean($query->row()->id_proses_induk),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
            "lokasi" => $this->security->xss_clean($query->row()->nama_regional),
            "luas_ukur" => $this->security->xss_clean($query->row()->luas_ukur),
            "luas_surat" => $this->security->xss_clean($query->row()->luas_surat),
        );
        echo '[' . json_encode($result) . ']';
    }
    public function proses_indukedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulesproses_induk());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            $simpan->updatedataproses_induk();
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function proses_indukhapus()
    {
        cekajax();
        $hapus = $this->master_model;
        if ($hapus->hapusdataproses_induk()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors = "fail";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function batal_jual($id)
    {
        $update = [
            'status_jual' => 1,
        ];
        $this->db->where('id_jual', $id);
        $this->db->update('master_penjualan', $update);
        redirect('laporan/laporan_penjualan');
    }

    public function baliknamadetail()
    {
        cekajax();
        $this->db->where(array('id_jual' => $this->input->get("id_stok_split")));
        $this->db->join('tbl_stok_split', 'master_penjualan.id_stok_split = tbl_stok_split.id_stok_split');
        $this->db->join('tbl_dtl_split', 'tbl_stok_split.id_stok_split = tbl_dtl_split.id_stok_split', 'left');
        $this->db->join('master_split', 'tbl_dtl_split.id_split = master_split.id_split', 'left');
        $this->db->join('master_proses_induk', 'master_split.id_proses_induk = master_proses_induk.id_proses_induk', 'left');
        $this->db->select('id_dtl_split, master_split.id_proses_induk, luas_terbit_blok, no_terbit_shgb, no_shgb_blok, tgl_daftar_blok, tgl_terbit_blok, masa_berlaku_shgb, tbl_stok_split.blok, tbl_stok_split.luas_teknik, master_penjualan.id_jual, master_penjualan.id_stok_split, master_penjualan.nama_pembeli, master_penjualan.nik, master_penjualan.alamat, master_penjualan.pekerjaan, master_penjualan.tgl_terima_nego, master_penjualan.tgl_penjualan, master_penjualan.tipe, master_penjualan.sistem_pembayaran, master_penjualan.harga, master_penjualan.status_jual');
        $query = $this->db->get('master_penjualan', 1);
        $result = array(
            "id_jual" => $this->security->xss_clean($query->row()->id_jual),
            "id_stok_split" => $this->security->xss_clean($query->row()->id_stok_split),
            "id_dtl_split" => $this->security->xss_clean(gobj($query->row(), 'id_dtl_split')),
            "id_proses_induk" => $this->security->xss_clean(gobj($query->row(), 'id_proses_induk')),
            "blok" => $this->security->xss_clean($query->row()->blok),
            "luas_teknik" => $this->security->xss_clean($query->row()->luas_teknik),
            "luas_terbit_blok" => $this->security->xss_clean($query->row()->luas_terbit_blok),
            "no_terbit_shgb" => $this->security->xss_clean($query->row()->no_terbit_shgb),
            "no_shgb_blok" => $this->security->xss_clean($query->row()->no_shgb_blok),
            "tgl_daftar_blok" => $this->security->xss_clean($query->row()->tgl_daftar_blok),
            "tgl_terbit_blok" => $this->security->xss_clean($query->row()->tgl_terbit_blok),
            "masa_berlaku_shgb" => $this->security->xss_clean($query->row()->masa_berlaku_shgb),
            "tgl_terima_nego" => $this->security->xss_clean($query->row()->tgl_terima_nego),
            "tgl_penjualan" => $this->security->xss_clean($query->row()->tgl_penjualan),
            "nama_pembeli" => $this->security->xss_clean($query->row()->nama_pembeli),
            "nik" => $this->security->xss_clean($query->row()->nik),
            "pekerjaan" => $this->security->xss_clean($query->row()->pekerjaan),
            "harga" => $this->security->xss_clean($query->row()->harga),
            "tipe" => $this->security->xss_clean($query->row()->tipe),
            "sistem_pembayaran" => $this->security->xss_clean($query->row()->sistem_pembayaran),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function baliknamaedit()
    {
        cekajax();
        $simpan = $this->master_model;
        $post = $this->input->post();

        $id_dtl_split = garr($post, 'id_dtl_split');

        $arr_dtl_split = array(
            'luas_terbit_blok' => garr($post, 'luas_terbit_blok'),
            'no_shgb_blok' => garr($post, 'no_shgb_blok'),
            'tgl_daftar_blok' => garr($post, 'tgl_daftar_blok'),
            'tgl_terbit_blok' => garr($post, 'tgl_terbit_blok'),
        );
        if (strlen($id_dtl_split) > 0) {
            $this->db->where('id_dtl_split', $id_dtl_split);
        } else {
            $this->db->where('id_stok_split', garr($post, 'id_stok_split'));
        }
        $this->db->update('tbl_dtl_split', $arr_dtl_split);

        $id_proses_induk = garr($post, 'id_proses_induk');
        if (strlen($id_proses_induk) > 0) {
            $arr_proses_induk = array(
                'no_terbit_shgb' => garr($post, 'no_terbit_shgb'),
                'masa_berlaku_shgb' => garr($post, 'masa_berlaku_shgb'),
            );
            $this->db->where('id_proses_induk', $id_proses_induk);
            $this->db->update('master_proses_induk', $arr_proses_induk);
        }

        $arr_update = array(
            'nama_pembeli' => garr($post, 'nama_pembeli'),
            'nik' => garr($post, 'nik'),
            'pekerjaan' => garr($post, 'pekerjaan'),
            'tgl_terima_nego' => garr($post, 'tgl_terima_nego'),
            'tgl_penjualan' => garr($post, 'tgl_penjualan'),
            'harga' => garr($post, 'harga'),
            'tipe' => garr($post, 'tipe'),
            'sistem_pembayaran' => garr($post, 'sistem_pembayaran'),
        );
        $this->db->where('id_jual', garr($post, 'id_jual'));
        $simpan = $this->db->update('master_penjualan', $arr_update);
        if ($simpan) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

}
