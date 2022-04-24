<?php
class Keuangan_model extends CI_Model
{

    // datatable rekening start
    public $column_search_datarekening = array('kategori', 'kode_rekening', 'nama_rekening');
    public $column_order_datarekening = array(null, 'kategori', 'kode_rekening', 'nama_rekening');
    public $order_datarekening = array('waktu_update' => 'DESC');
    public function getpembayaran($kode_item)
    {
        $this->db->select('*');
        $this->db->from('tabel_pembayaran');
        $this->db->where('kode_item', $kode_item);
        $this->db->order_by('waktu_update', 'desc');
        return $this->db->get()->result_array();
    }

    private function _get_query_datarekening()
    {
        $get = $this->input->get();
        $this->db->from('rekening_kode');
        $i = 0;
        foreach ($this->column_search_datarekening as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_datarekening) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_datarekening[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_datarekening)) {
            $order = $this->order_datarekening;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datarekening_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_datarekening();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_datarekening()
    {
        $this->_get_query_datarekening();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function gethutangarray()
    {
        $this->db->from('hutang_history');
        return $this->db->get()->result_array();
    }
    public function count_all_datatable_datarekening()
    {
        $this->db->from('rekening_kode');
        return $this->db->count_all_results();
    }
    //datatable rekening end

    // CRUD rekening start
    public function ruleskeuangan()
    {
        return [
            [
                'field' => 'kode_rekening',
                'label' => 'Kode Rekening',
                'rules' => 'is_unique[rekening_kode.kode_rekening]|required',
            ],
        ];
    }
    public function simpandatarekening()
    {
        $post = $this->input->post();
        $array = array(
            'kode_rekening' => $post["kode_rekening"],
            'kategori' => $post["kategori"],
            'nama_rekening' => $post["nama_rekening"],
            'editable' => '1',
        );
        return $this->db->insert("rekening_kode", $array);
    }
    public function rulesrekeningedit()
    {
        return [
            [
                'field' => 'kode_rekening',
                'label' => 'Kode Rekening',
                'rules' => 'required',
            ],
        ];
    }
    public function updatedatarekening()
    {
        $post = $this->input->post();
        $this->kode_rekening = $post["kode_rekening"];
        $this->kategori = $post["kategori"];
        $this->nama_rekening = $post["nama_rekening"];
        return $this->db->update("rekening_kode", $this, array('kode_rekening' => $post['idd']));
    }
    public function hapusdatarekening()
    {
        $post = $this->input->post();
        $this->db->where('kode_rekening', $post['idd']);
        return $this->db->delete('rekening_kode');
    }
    // CRUD rekening end

    // datatable rekening start
    public $column_search_datahutang = array('id', 'judul', 'nomor_faktur', 'tanggal', 'nominal', 'tanggal_jatuh_tempo', 'nominal_dibayar', 'nominal_dibayar', 'sudah_lunas');
    public $column_order_datahutang = array(null, 'id', 'judul', 'nomor_faktur', 'tanggal', 'nominal', 'tanggal_jatuh_tempo', 'nominal_dibayar', 'nominal_dibayar', 'sudah_lunas');
    public $order_datahutang = array('waktu_update' => 'DESC');
    private function _get_query_datahutang()
    {
        $get = $this->input->get();
        $this->db->from('hutang_history');
        $i = 0;
        foreach ($this->column_search_datahutang as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_datahutang) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_datahutang[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_datahutang)) {
            $order = $this->order_datahutang;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datahutang_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_datahutang();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_datahutang()
    {
        $this->_get_query_datahutang();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_datahutang()
    {
        $this->db->from('hutang_history');
        return $this->db->count_all_results();
    }
    //datatable hutang end

    //CRUD hutang start
    public function ruleshutang()
    {
        return [
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required',
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatahutang()
    {
        $post = $this->input->post();
        $array = array(
            'judul' => $post["judul"],
            'tanggal' => $post["tanggal"],
            'nominal' => bilanganbulat($post["nominal"]),
            'id_target' => $post["id_target"],
            'tanggal_jatuh_tempo' => $post["tanggal_jatuh_tempo"],
            'keterangan' => $post["keterangan"],
        );
        return $this->db->insert("hutang_history", $array);
    }
    public function hapusdatahutang()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('hutang_history');
    }
    public function get_hutang($idd)
    {
        $this->db->select("a.id, a.judul, a.tanggal, a.nominal, a.nominal_dibayar, a.nomor_faktur, a.id_target, a.tanggal_lunas, a.tanggal_jatuh_tempo, a.sudah_lunas, a.keterangan, b.nama_target, b.telepon, b.alamat");
        $this->db->from("hutang_history a");
        $this->db->join('tbl_target b', 'a.id_target = b.id');
        $this->db->where('a.id', $idd, '1');
        return $this->db->get()->result_array();
    }
    public function hapusdatapembayaranhutang()
    {
        $post = $this->input->post();
        $nominal = bilanganbulat($post["nominalInt"]);
        $this->db->set('nominal_dibayar', 'nominal_dibayar - ' . (int) $nominal, false)->where('id', $post["dataId"])->update('hutang_history');
        $status = $this->db->get_where('hutang_history', array('id' => $post["dataId"]));
        if ($status->row()->nominal >= $status->row()->nominal_dibayar) {
            $this->tanggal_lunas = '0000-00-00';
            $this->sudah_lunas = '0';
            $this->db->update("hutang_history", $this, array('id' => $post['dataId']));
        }
        return $this->db->where('id', $post['id'])->delete('hutang_dibayar_history');
    }
    public function ruleshutangdibayar()
    {
        return [
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required',
            ],
            [
                'field' => 'nominal',
                'label' => 'Nominal',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatahutangdibayar()
    {
        $post = $this->input->post();
        $nominal = bilanganbulat($post["nominal"]);
        $array = array(
            'id_hutang' => $post["idd"],
            'tanggal' => $post["tanggal"],
            'nominal' => $nominal,
            'keterangan' => $post["keterangan"],
        );
        $this->db->insert("hutang_dibayar_history", $array);
        $insert_id = $this->db->insert_id();
        $cashout = array(
            'id_hutang_dibayar' => $insert_id,
            'kode_rekening' => '20001',
            'keluar' => $nominal,
            'masuk' => '0',
            'tanggal' => $post["tanggal"],
            'id_admin' => $this->session->userdata('idadmin'),
        );
        $this->db->insert("cash_in_out", $cashout);
        $this->db->set('nominal_dibayar', 'nominal_dibayar + ' . (int) $nominal, false)->where('id', $post["idd"])->update('hutang_history');
        $status = $this->db->get_where('hutang_history', array('id' => $post["idd"]));
        if ($status->row()->nominal_dibayar >= $status->row()->nominal) {
            $this->tanggal_lunas = $post["tanggal"];
            $this->sudah_lunas = '1';
            $this->db->update("hutang_history", $this, array('id' => $post['idd']));
        }
        return true;
    }
    public function get_by_id($id)
    {
        $this->db->where('id_pembayaran', $id);
        return $this->db->get('tabel_pembayaran')->row();
    }

    public function get_bayar_tanah($idd)
    {
        $this->db->select("a.id, a.id_penjualan, a.id_pembeli, a.judul, a.tanggal, a.tanggal_jatuh_tempo, a.nominal, a.nominal_dibayar, a.sudah_lunas, a.tanggal_lunas, a.keterangan, b.nama_pembeli, b.jenis_kelamin, b.alamat, b.telepon, b.handphone");
        $this->db->from("bayar_tanah_history a");
        $this->db->join('master_pembeli b', 'a.id_pembeli = b.id');
        $this->db->where('a.id', $idd, '1');
        return $this->db->get()->result_array();
    }
    public function get_bayar_tanahdetail($idd)
    {
        $this->db->select("a.nama_item, b.kode_item, b.kuantiti, b.harga, b.total, b.diskon");
        $this->db->from("master_item a");
        $this->db->join('penjualan_detail b', 'a.kode_item = b.kode_item');
        $this->db->join('bayar_tanah_history c', 'b.id_penjualan = b.id_penjualan');
        $this->db->where('c.id', $idd, '1');
        return $this->db->get()->result_array();
    }

    public function hapusdatapembayaranbayar_tanah()
    {
        $post = $this->input->post();
        return $this->db->where('id_pembayaran', $post['id'])->delete('tabel_pembayaran');
    }

    public function rulesbayar_tanahdibayar()
    {
        return [
            [
            ],
        ];
    }

    public function simpandatabayar_tanahdibayar()
    {
        $post = $this->input->post();
        foreach ($post['tanggal_pembayaran'] as $key => $item) {
            $total_bayar = bilanganbulat($post["total_bayar"][$key]);
            $array = array(
                'kode_item' => $post["kode_item"],
                'tanggal_pembayaran' => $item,
                'status_bayar' => $post["status_bayar"][$key],
                'total_bayar' => $total_bayar,
                'keterangan' => $post["keterangan"][$key],
            );
            if ($post['status_bayar'][$key] == 1) {
                $array['tanggal_realisasi'] = date('y-m-d');
            }
            $this->db->insert("tabel_pembayaran", $array);
        }

        return true;
    }
    //CRUD hutang end

    public function rulescash()
    {
        return [
            [
                'field' => 'kode_rekening',
                'label' => 'Kode Rekening',
                'rules' => 'required',
            ],
            [
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required',
            ],
        ];
    }

    public function simpandatacash()
    {
        $post = $this->input->post();
        $keluar = bilanganbulat($post["nominal"]);
        $masuk = 0;
        if ($post['kategori'] == 'pemasukan') {
            $masuk = bilanganbulat($post["nominal"]);
            $keluar = 0;
        }
        $array = array(
            'kode_rekening' => $post["kode_rekening"],
            'tanggal' => $post["tanggal"],
            'masuk' => $masuk,
            'keluar' => $keluar,
            'keterangan' => $post["keterangan"],
            'id_admin' => $this->session->userdata('idadmin'),
        );
        return $this->db->insert("cash_in_out", $array);
    }

    public function hapusdatacash()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('cash_in_out');
    }

    public function updatedatacash()
    {
        $post = $this->input->post();
        $keluar = bilanganbulat($post["nominal"]);
        $masuk = 0;
        if ($post['kategori'] == 'pemasukan') {
            $masuk = bilanganbulat($post["nominal"]);
            $keluar = 0;
        }
        $this->kode_rekening = $post["kode_rekening"];
        $this->tanggal = $post["tanggal"];
        $this->keterangan = $post["keterangan"];
        $this->masuk = $masuk;
        $this->keluar = $keluar;
        return $this->db->update("cash_in_out", $this, array('id' => $post['idd']));
    }

    public function updatedataitems()
    {
        $post = $this->input->post();
        $this->tanggal_pembayaran = ($post["tanggal_pembayaran"]);
        $this->status_bayar = ($post["status_bayar"]);
        $this->total_bayar = (bilanganbulat($post["total_bayar"]));
        $this->keterangan = ($post["keterangan"]);
        if ($post['tanggal_realisasi'] != "") {
            $this->tanggal_realisasi = ($post["tanggal_realisasi"]);

        } else {
            if ($post['status_bayar'] == 1) {
                $this->tanggal_realisasi = date('y-m-d');
            } else {
                $this->tanggal_realisasi = null;
            }
        }
        return $this->db->update("tabel_pembayaran", $this, array('id_pembayaran' => $post['idd']));
    }
}
