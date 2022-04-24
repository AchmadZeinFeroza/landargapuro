    <?php
defined('BASEPATH') or exit('No direct script access allowed');
class Keuangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') != true) {
            redirect(base_url('login'));
        }
        $this->load->model('keuangan_model');
        $this->load->model('master_model');
        $this->load->library('form_validation');
        $this->load->helper(array('string', 'security', 'form'));
    }
    public function index()
    {
        level_user('keuangan', 'index', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->load->view('member/keuangan/beranda');
    }

    public function keuangandetail()
    {
        cekajax();
        $kode_item = $this->input->get('id');
        $datapembayaran = $this->keuangan_model->getpembayaran($kode_item);
        $dataitem = $this->master_model->getdatatanah($kode_item);
        $arraysub = array();
        foreach ($datapembayaran as $po_data) {
            $subArray = array(
                "id_pembayaran" => $this->security->xss_clean($po_data['id_pembayaran']),
                "kode_item" => $this->security->xss_clean($po_data['kode_item']),
                "tanggal_pembayaran" => $this->security->xss_clean($po_data['tanggal_pembayaran']),
                "total_bayar" => $this->security->xss_clean(rupiah($po_data['total_bayar'])),
            );
            $arraysub[] = $subArray;

        }

        foreach ($dataitem as $r) {
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
            } else {
                $harga_satuan = $r->total_harga_pengalihan / $r->luas_surat;
            }

            $totalbiayalain = $r->lain + $r->pbb + $r->ganti_rugi;
            $totalharga_biaya = $r->total_harga_pengalihan + $r->nilai + $totalbiayalain;
            if ($totalharga_biaya == 0) {
                $harga_perm = 0;
            } else {
                $harga_perm = $totalharga_biaya / $r->luas_surat;

            }
            $result = array(

                "kode_item" => $this->security->xss_clean($r->kode_item),
                // "nama_item" => $this->security->xss_clean($r->nama_item),
                "tanggal_pembelian" => $this->security->xss_clean($r->tanggal_pembelian),
                "nama_penjual" => $this->security->xss_clean($r->nama_penjual),
                "nama_surat_tanah" => $this->security->xss_clean($r->nama_surat_tanah),
                // "status_surat_tanah" => $this->security->xss_clean($r->status_surat_tanah),
                "nama_status_surat_tanah" => $this->security->xss_clean($r->nama_sertifikat),
                "no_gambar" => $this->security->xss_clean($r->no_gambar),
                "jumlah_bidang" => $this->security->xss_clean($r->jumlah_bidang),
                "luas_surat" => $this->security->xss_clean($r->luas_surat),
                "luas_ukur" => $this->security->xss_clean($r->luas_ukur),
                "no_pbb" => $this->security->xss_clean($r->no_pbb),
                "luas_pbb_bangunan" => $this->security->xss_clean($r->luas_pbb_bangunan),
                "njop_bangunan" => $this->security->xss_clean($r->njop_bangunan),
                "total_harga_pengalihantampil" => $this->security->xss_clean(rupiah($r->total_harga_pengalihan)),
                "total_harga_pengalihan" => $this->security->xss_clean($r->total_harga_pengalihan),
                "satuan_harga_pengalihantampil" => $this->security->xss_clean(rupiah($harga_satuan)),
                "nama_makelar" => $this->security->xss_clean($r->nama_makelar),
                "nilaitampil" => $this->security->xss_clean(rupiah($r->nilai)),
                "nilai" => $this->security->xss_clean($r->nilai),
                "tanggal_pengalihan" => $this->security->xss_clean($r->tanggal_pengalihan),
                "akta_pengalihan" => $this->security->xss_clean($r->akta_pengalihan),
                "nama_pengalihan" => $this->security->xss_clean($r->nama_pengalihan),
                "ganti_rugitampil" => $this->security->xss_clean(rupiah($r->ganti_rugi)),
                "ganti_rugi" => $this->security->xss_clean($r->ganti_rugi),
                "pbbtampil" => $this->security->xss_clean(rupiah($r->pbb)),
                "pbb" => $this->security->xss_clean($r->pbb),
                "laintampil" => $this->security->xss_clean(rupiah($r->lain)),
                "lain" => $this->security->xss_clean($r->lain),
                "harga_permtampil" => $this->security->xss_clean(rupiah($harga_perm)),
                "harga_perm" => $this->security->xss_clean($harga_perm),
                "keterangan" => $this->security->xss_clean($r->keterangan),
                "id_perumahan" => $this->security->xss_clean($r->id_perumahan),
                "harga_permtampil" => $this->security->xss_clean(rupiah($harga_perm)),
                "nama_regional" => $this->security->xss_clean($r->nama_regional),
                "status_order_akta" => $this->security->xss_clean($r->status_order_akta),
                "jenis_pengalihan_hak" => $this->security->xss_clean($r->jenis_pengalihan_hak),
                "status_teknik" => $this->security->xss_clean($r->status_teknik),
            );

        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';

    }
    public function datahutang()
    {
        cekajax();
        $get = $this->input->get();
        $list = $this->keuangan_model->get_datahutang_datatable();
        $data = array();
        foreach ($list as $r) {
            $row = array();
            $tombol = '';
            $sisa = $r->nominal - $r->nominal_dibayar;
            $statuslunas = '<span class="btn btn-danger btn-xs">Belum</span>';
            if ($r->sudah_lunas == '1') {
                $statuslunas = '<span class="btn btn-success btn-xs">Sudah</span>';
                $tombolbayar = '';
            } else {
                $tombolbayar = '<li><a href="#" onclick="bayar(this)" data-id="' . $r->id . '">Bayar</a></li>';
            }
            if ($r->nomor_faktur != null) {
                $tombol = '
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="#" onclick="detail(this)" data-id="' . $r->id . '">Rincian</a></li>
                    ' . $tombolbayar . '
                    </ul>
                    </div>
                    ';
            } else {
                $tombolhapus = level_user('keuangan', 'hutang', $this->session->userdata('kategori'), 'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $r->id . '">Hapus</a></li>' : '';
                $tombol = '
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="#" onclick="detail(this)" data-id="' . $r->id . '">Rincian</a></li>
                    ' . $tombolhapus . '
                    ' . $tombolbayar . '
                    </ul>
                    </div>
                    ';
            }
            $row[] = $tombol;
            $row[] = $this->security->xss_clean($r->id);
            $row[] = $this->security->xss_clean($r->judul);
            $row[] = $this->security->xss_clean($r->nomor_faktur);
            $row[] = $this->security->xss_clean(tgl_indo($r->tanggal));
            $row[] = $this->security->xss_clean(rupiah($r->nominal));
            $row[] = $this->security->xss_clean(tgl_indo($r->tanggal_jatuh_tempo));
            $row[] = $this->security->xss_clean(rupiah($r->nominal_dibayar));
            $row[] = $this->security->xss_clean(rupiah($sisa));
            $row[] = $statuslunas;
            $data[] = $row;
        }
        $result = array(
            "draw" => $get['draw'],
            "recordsTotal" => $this->keuangan_model->count_all_datatable_datahutang(),
            "recordsFiltered" => $this->keuangan_model->count_filtered_datatable_datahutang(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function hutangtambah()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->ruleshutang());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatahutang()) {
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

    public function hutanghapus()
    {
        cekajax();
        $hapus = $this->keuangan_model;
        if ($hapus->hapusdatahutang()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function hutangdetail()
    {
        cekajax();
        $idd = $this->input->get("id");
        $query = $this->keuangan_model->get_hutang($idd);
        foreach ($query as $po_data) {
            $sisa = $po_data['nominal'] - $po_data['nominal_dibayar'];
            if ($po_data['sudah_lunas'] == '1') {
                $statuslunas = '<span class="btn btn-success btn-xs">Sudah Lunas</span>';
                $tombolbayar = '';
            } else {
                $statuslunas = '<span class="btn btn-danger btn-xs">Belum Lunas</span>';
            }
            $result = array(
                "id" => $this->security->xss_clean($po_data['id']),
                "judul" => $this->security->xss_clean($po_data['judul']),
                "tanggal" => $this->security->xss_clean(tgl_indo($po_data['tanggal'])),
                "nominal" => $this->security->xss_clean(rupiah($po_data['nominal'])),
                "nominal_dibayar" => $this->security->xss_clean(rupiah($po_data['nominal_dibayar'])),
                "sisa" => $this->security->xss_clean(rupiah($sisa)),
                "nomor_faktur" => $this->security->xss_clean($po_data['nomor_faktur']),
                "id_target" => $this->security->xss_clean($po_data['id_target']),
                "tanggal_jatuh_tempo" => $this->security->xss_clean(tgl_indo($po_data['tanggal_jatuh_tempo'])),
                "tanggal_jatuh_tempo_ymd" => $this->security->xss_clean($po_data['tanggal_jatuh_tempo']),
                "target" => $this->security->xss_clean($po_data['nama_target']),
                "telepon" => $this->security->xss_clean($po_data['telepon']),
                "alamat" => $this->security->xss_clean($po_data['alamat']),
                "status" => $statuslunas,
                "keterangan" => $this->security->xss_clean($po_data['keterangan']),
            );
        }
        $detailpo = $this->db->get_where('hutang_dibayar_history', array('id_hutang' => $idd));
        if ($detailpo->num_rows() > 0) {
            foreach ($detailpo->result() as $r) {
                $subArray['id'] = $this->security->xss_clean($r->id);
                $subArray['tanggal'] = $this->security->xss_clean(tgl_indo($r->tanggal));
                $subArray['nominal'] = $this->security->xss_clean(rupiah($r->nominal));
                $subArray['keterangan'] = $this->security->xss_clean($r->keterangan);
                $subArray['nominalInt'] = $this->security->xss_clean($r->nominal);
                $arraysub[] = $subArray;
            }
        } else {
            $subArray['id'] = "";
            $subArray['tanggal'] = "";
            $subArray['nominal'] = "";
            $subArray['keterangan'] = "";
            $arraysub[] = $subArray;
        }
        $datasub = $arraysub;
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . ',"datasub":' . json_encode($datasub) . '}';
    }

    public function hutanghapuspembayaran()
    {
        cekajax();
        $hapus = $this->keuangan_model;
        if ($hapus->hapusdatapembayaranhutang()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function hutangtambahpembayaran()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->ruleshutangdibayar());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatahutangdibayar()) {
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

    public function bayar_tanah($kode_item)
    {
        $data['kode_item'] = $kode_item;
        $total_pembayaran = 0;

        $query = $this->db->query("select * from master_item where kode_item='" . $kode_item . "'");
        foreach ($query->result() as $data_tanah) {
            $data['tanah_milik'] = $data_tanah->nama_penjual;
            $data['tanggal_pembelian'] = $data_tanah->tanggal_pembelian;
            $data['luas_surat'] = $data_tanah->luas_surat;
            $nilai = 0;
            $lain = 0;
            if ($data_tanah->nilai == 0 || $data_tanah->nilai == '') {
                $nilai = 0;
            } else {
                $nilai = $data_tanah->nilai;
            }

            if ($data_tanah->lain == 0 || $data_tanah->lain == '') {
                $lain = 0;
            } else {
                $lain = $data_tanah->lain;
            }
            $total_pembayaran = $data_tanah->total_harga_pengalihan + $lain + $nilai;
            $data['total_harga_pengalihan'] = rupiah($total_pembayaran);

        }

        $query = $this->db->query("select id_pembayaran,status_bayar, kode_item, tanggal_pembayaran, total_bayar, keterangan from tabel_pembayaran  where kode_item='" . $kode_item . "' and status_bayar=1 ");

        $total_sudah_dibayar = 0;
        $pembayaran_terahir = 0;
        foreach ($query->result() as $data_pembayaran) {
            $total_sudah_dibayar += $data_pembayaran->total_bayar;
            $pembayaran_terahir = $data_pembayaran->total_bayar;

        }
        $data['total_sudah_dibayar'] = rupiah($total_sudah_dibayar);
        $data['pembayaran_terahir'] = rupiah($pembayaran_terahir);
        $data['total_belum_dibayar'] = rupiah($total_pembayaran - $total_sudah_dibayar);

        $this->load->view('member/keuangan/bayar_tanah', $data);
    }

    public function databayar_tanah($kode_item)
    {
        cekajax();
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->db->select("a.id_pembayaran,a.status_bayar, a.kode_item, a.tanggal_pembayaran, a.total_bayar, a.tanggal_realisasi, a.keterangan")->from("tabel_pembayaran a")->where('a.kode_item', $kode_item)->get();
        $data = [];
        foreach ($query->result() as $r) {
            if ($r->status_bayar == '0') {
                $status = '<a href="#" class="btn btn-danger">Belum Terbayar</a>';
                // $status ='lunas';
            } else {
                $status = '<a href="#" class="btn btn-success">Sudah Terbayar</a>';
            }
            $tomboledit = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($r->id_pembayaran) . '">Edit</a></li>' : '';

            $data[] = array(
                '
            <div class="btn-group dropup">
            <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
            <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="hapus(this)" data-id="' . $r->id_pembayaran . '">Hapus</a></li>
            ' . $tomboledit . '
            </ul>
            </div>
            ',
                $this->security->xss_clean($r->id_pembayaran),
                $this->security->xss_clean(tgl_indo($r->tanggal_pembayaran)),
                $this->security->xss_clean(tgl_indo($r->tanggal_realisasi)),
                $this->security->xss_clean(rupiah($r->total_bayar)),
                $this->security->xss_clean($status),
                $this->security->xss_clean($r->keterangan),
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function itemdetail()
    {
        cekajax();
        $id = $this->input->get("id");
        $query = $this->db->select("a.id_pembayaran,a.status_bayar, a.kode_item, a.tanggal_pembayaran, a.total_bayar, a.keterangan")->from("tabel_pembayaran a")->where('a.id_pembayaran', $id)->get();
        $data = $query->result();
        echo json_encode($data);
    }

    public function update_status($id, $item)
    {
        $row = $this->keuangan_model->get_by_id($id);
        $statusdb = $row->status_bayar;
        if ($statusdb == '1') {
            $data = array(
                'status_bayar' => 0,
            );
        } else {
            $data = array(
                'status_bayar' => 1,
            );
        }
        $this->db->where('id_pembayaran', $id);
        $this->db->update('tabel_pembayaran', $data);
        redirect(site_url('keuangan/bayar_tanah/' . $item));

    }
    public function bayar_tanahhapuspembayaran()
    {
        cekajax();
        $hapus = $this->keuangan_model;
        if ($hapus->hapusdatapembayaranbayar_tanah()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function bayar_tanahtambahpembayaran()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        if ($simpan->simpandatabayar_tanahdibayar()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function bayar_tanahubahpembayaran()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        if ($simpan->updatedataitems()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function cashinout()
    {
        level_user('keuangan', 'cashinout', $this->session->userdata('kategori'), 'read') > 0 ? '' : show_404();
        $this->load->view('member/keuangan/cashinout');
    }

    public function datacashincashout()
    {
        cekajax();
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->db->select("a.id,, a.kode_rekening, a.tanggal, a.masuk, a.keluar, a.keterangan, b.kategori, b.nama_rekening, b.editable")->from("cash_in_out a")->join('rekening_kode b', 'a.kode_rekening = b.kode_rekening')->get();
        $data = [];
        foreach ($query->result() as $r) {
            if ($r->kategori == 'pengeluaran') {
                $nominal = $r->keluar;
            } else {
                $nominal = $r->masuk;
            }
            if ($r->editable == '1') {
                $edit = '';
                $hapus = '';
                if (level_user('keuangan', 'cashinout', $this->session->userdata('kategori'), 'edit') > 0) {
                    $edit = '    <li><a href="#" onclick="edit(this)" data-id="' . $r->id . '">Edit</a></li>';
                }
                if (level_user('keuangan', 'cashinout', $this->session->userdata('kategori'), 'delete') > 0) {
                    $hapus = '     <li><a href="#" onclick="hapus(this)" data-id="' . $r->id . '">Hapus</a></li>
                ';
                }
                $tombol = $edit . $hapus;
            } else {
                $tombol = '';
            }

            $data[] = array(
                '
            <div class="btn-group dropup">
            <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
            <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="detail(this)" data-id="' . $r->id . '">Detail</a></li>
            ' . $tombol . '
            </ul>
            </div>
            ',
                $this->security->xss_clean(tgl_indo($r->tanggal)),
                $this->security->xss_clean($r->kode_rekening),
                $this->security->xss_clean($r->nama_rekening),
                $this->security->xss_clean($r->kategori),
                $this->security->xss_clean(rupiah($nominal)),
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data,
        );
        echo json_encode($result);
    }

    public function datarekeningkode()
    {
        cekajax();
        $kategori = $this->input->get("kategori");
        $detailpo = $this->db->get_where('rekening_kode', array('kategori' => $kategori, 'editable' => '1'));
        foreach ($detailpo->result() as $r) {
            $subArray['kode_rekening'] = $this->security->xss_clean($r->kode_rekening);
            $subArray['nama_rekening'] = $this->security->xss_clean($r->nama_rekening);
            $subArray['kategori'] = $this->security->xss_clean($r->kategori);
            $arraysub[] = $subArray;
        }
        $datasub = $arraysub;
        echo '{"datarows":' . json_encode($datasub) . '}';
    }

    public function cashincashout_tambah()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulescash());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->simpandatacash()) {
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

    public function cashdetail()
    {
        cekajax();
        $idd = intval($this->input->get("id"));
        $query = $this->db->select("a.id,, a.kode_rekening, a.tanggal, a.masuk, a.keluar, a.keterangan, b.kategori, b.nama_rekening")->from("cash_in_out a")->join('rekening_kode b', 'a.kode_rekening = b.kode_rekening')->where('a.id', $idd, '1')->get();

        if ($query->row()->kategori == 'pengeluaran') {
            $nominal = $query->row()->keluar;
        } else {
            $nominal = $query->row()->masuk;
        }
        $result = array(
            "tanggal" => $this->security->xss_clean(tgl_indo($query->row()->tanggal)),
            "tanggalYmd" => $this->security->xss_clean($query->row()->tanggal),
            "kategori" => $this->security->xss_clean($query->row()->kategori),
            "kode_rekening" => $this->security->xss_clean($query->row()->kode_rekening),
            "nominal" => $this->security->xss_clean(rupiah($nominal)),
            "nominalInt" => $this->security->xss_clean($nominal),
            "nama_rekening" => $this->security->xss_clean($query->row()->nama_rekening),
            "keterangan" => $this->security->xss_clean($query->row()->keterangan),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function cashhapus()
    {
        cekajax();
        $hapus = $this->keuangan_model;
        if ($hapus->hapusdatacash()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
        } else {
            $errors['fail'] = "gagal menghapus data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function cashedit()
    {
        cekajax();
        $simpan = $this->keuangan_model;
        $validation = $this->form_validation;
        $validation->set_rules($simpan->rulescash());
        if ($this->form_validation->run() == false) {
            $errors = $this->form_validation->error_array();
            $data['errors'] = $errors;
        } else {
            if ($simpan->updatedatacash()) {
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

    public function cashinout_data()
    {
        cekajax();
        $masuk_minggu = $this->db->select('SUM(masuk) as total')->from('cash_in_out')->where('tanggal BETWEEN "' . date('Y-m-d', strtotime('monday this week')) . '" and "' . date('Y-m-d', strtotime('sunday this week')) . '"')->get()->row();
        $keluar_minggu = $this->db->select('SUM(keluar) as total')->from('cash_in_out')->where('tanggal BETWEEN "' . date('Y-m-d', strtotime('monday this week')) . '" and "' . date('Y-m-d', strtotime('sunday this week')) . '"')->get()->row();
        $masuk_hari = $this->db->select('SUM(masuk) as total')->from('cash_in_out')->where('tanggal ="' . date('Y-m-d') . '"')->get()->row();
        $keluar_hari = $this->db->select('SUM(keluar) as total')->from('cash_in_out')->where('tanggal ="' . date('Y-m-d') . '"')->get()->row();

        $result = array(
            "masuk_minggu" => $this->security->xss_clean(rupiah($masuk_minggu->total)),
            "keluar_minggu" => $this->security->xss_clean(rupiah($keluar_minggu->total)),
            "masuk_hari" => $this->security->xss_clean(rupiah($masuk_hari->total)),
            "keluar_hari" => $this->security->xss_clean(rupiah($keluar_hari->total)),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function bayar_tanah_data()
    {
        cekajax();
        $dibayar_minggu = $this->db->select('SUM(nominal) as total')->from('bayar_tanah_dibayar_history')->where('tanggal BETWEEN "' . date('Y-m-d', strtotime('monday this week')) . '" and "' . date('Y-m-d', strtotime('sunday this week')) . '"')->get()->row();
        $total_bayar_tanah_belum_bayar = $this->db->select('SUM(nominal - nominal_dibayar) as total')->from('bayar_tanah_history')->where('sudah_lunas ="0"')->get()->row();

        $akan_jatuh_tempo = $this->db->select('*')->from('bayar_tanah_history')->where('tanggal_jatuh_tempo <= "' . date('Y-m-d', strtotime('+2 weeks')) . '" and tanggal_jatuh_tempo > "' . date('Y-m-d') . '" and sudah_lunas ="0"')->get()->num_rows();
        $sudah_jatuh_tempo = $this->db->select('*')->from('bayar_tanah_history')->where('tanggal_jatuh_tempo <= "' . date('Y-m-d') . '" and sudah_lunas ="0"')->get()->num_rows();
        $result = array(
            "dibayar_minggu" => $this->security->xss_clean(rupiah($dibayar_minggu->total)),
            "total_bayar_tanah_belum_bayar" => $this->security->xss_clean(rupiah($total_bayar_tanah_belum_bayar->total)),
            "akan_jatuh_tempo" => $this->security->xss_clean($akan_jatuh_tempo . " Transaksi"),
            "sudah_jatuh_tempo" => $this->security->xss_clean($sudah_jatuh_tempo . " Transaksi"),
        );
        echo '[' . json_encode($result) . ']';
    }

    public function hutang_data()
    {
        cekajax();
        $total_hutang_belum_bayar = $this->db->select('SUM(nominal - nominal_dibayar) as total')->from('hutang_history')->where('sudah_lunas ="0"')->get()->row();
        $akan_jatuh_tempo = $this->db->select('*')->from('hutang_history')->where('tanggal_jatuh_tempo <= "' . date('Y-m-d', strtotime('+2 weeks')) . '" and tanggal_jatuh_tempo > "' . date('Y-m-d') . '" and sudah_lunas ="0"')->get()->num_rows();
        $sudah_jatuh_tempo = $this->db->select('*')->from('hutang_history')->where('tanggal_jatuh_tempo <= "' . date('Y-m-d') . '" and sudah_lunas ="0"')->get()->num_rows();

        $dibayar_minggu = $this->db->select('SUM(nominal) as total')->from('hutang_dibayar_history')->where('tanggal BETWEEN "' . date('Y-m-d', strtotime('monday this week')) . '" and "' . date('Y-m-d', strtotime('sunday this week')) . '"')->get()->row();

        $result = array(
            "akan_jatuh_tempo" => $this->security->xss_clean($akan_jatuh_tempo . " Transaksi"),
            "sudah_jatuh_tempo" => $this->security->xss_clean($sudah_jatuh_tempo . " Transaksi"),
            "total_hutang_belum_bayar" => $this->security->xss_clean(rupiah($total_hutang_belum_bayar->total)),
            "dibayar_minggu" => $this->security->xss_clean(rupiah($dibayar_minggu->total)),
        );
        echo '[' . json_encode($result) . ']';
    }

}