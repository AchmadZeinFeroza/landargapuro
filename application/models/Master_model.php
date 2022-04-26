<?php
class Master_model extends CI_Model
{
    public function getdetailprosesinduk($id_proses_induk)
    {
        $this->db->select('*');
        $this->db->from('tbl_dtl_proses_induk');
        $this->db->where('id_proses_induk', $id_proses_induk);
        $this->db->order_by('waktu_update', 'desc');
        return $this->db->get()->result_array();
    }

    public function gettotalluasstok($id_stok_split)
    {
        $this->db->select('sum(luas_daftar_blok) as total_luas');
        $this->db->from('tbl_dtl_split');
        $this->db->where('id_stok_split', $id_stok_split);
        $hasil = $this->db->get();
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array()[0]['total_luas'];
        } else {
            return 0;
        }
    }
    public function getdetailsplit($id_split)
    {
        $this->db->select('*');
        $this->db->from('tbl_dtl_split');
        $this->db->join('tbl_stok_split', 'tbl_stok_split.id_stok_split = tbl_dtl_split.id_stok_split', 'left');
        $this->db->where('id_split', $id_split);
        // $this->db->order_by('waktu_update', 'desc');
        return $this->db->get()->result_array();
    }
    public function getsplit($id)
    {
        $this->db->from('master_split a');
        $this->db->join('master_proses_induk b', 'a.id_proses_induk = b.id_proses_induk', 'left');
        $this->db->join('master_regional c', 'b.id_perumahan = c.id', 'left');
        $this->db->where('id_split', $id);
        return $this->db->get()->result_array();
    }
    public function getfullstoksplit($id_split)
    {
        $this->db->select('*');
        $this->db->from('tbl_stok_split a');
        $this->db->join('tbl_dtl_split b', 'a.id_stok_split = b.id_stok_split');
        $this->db->join('master_split c', 'c.id_split = b.id_split');
        $this->db->join('master_proses_induk d', 'c.id_proses_induk = d.id_proses_induk');
        $this->db->where('a.id_stok_split', $id_split);
        return $this->db->get()->result_array();
    }
    public function getdatapenjualan($id_jual)
    {
        $this->db->select('*');
        $this->db->from('master_penjualan a');
        $this->db->where('a.id_jual', $id_jual);
        return $this->db->get()->result_array();
    }
    public function getdetailstoksplit($id_split)
    {
        $this->db->select('*');
        $this->db->from('tbl_stok_split');
        $this->db->join('tbl_dtl_split', 'tbl_stok_split.id_stok_split = tbl_dtl_split.id_stok_split');
        $this->db->where('tbl_stok_split.id_stok_split', $id_split);
        return $this->db->get()->result_array();
    }
    public function getstoksplit($id)
    {
        // $this->db->select('a.*,b*,c*');
        $this->db->from('tbl_stok_split a');
        $this->db->join('master_regional c', 'a.id_perumahan = c.id');
        $this->db->where('id_stok_split', $id);
        return $this->db->get()->result_array();
    }
    public function getdatatanah($kode_item)
    {
        $this->db->select('a.*,b.nama_regional,c.*');
        $this->db->from('master_item a');
        $this->db->where('a.kode_item', $kode_item);
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        return $this->db->get()->result();
    }
    public function getdataabsensibyid($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_absensi');
        $this->db->where('id_admin', $id);
        $this->db->where("waktu BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'");
        $hasil = $this->db->get();
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array()[0];
        } else {
            $hasil = array('status' => '',
                'keterangan' => '');
            return $hasil;
        }
    }
    public function getkecamatan($id)
    {
        $hasil = $this->db->query("SELECT * FROM kecamatan WHERE id_kabupaten='$id'");
        return $hasil->result();
    }
    public function getdesa($id)
    {
        $hasil = $this->db->query("SELECT * FROM desa WHERE id_kecamatan='$id'");
        return $hasil->result();
    }
    public function absensiinput($data)
    {
        if ($data['status'] != '') {
            $this->db->select('status,waktu,id_admin,keterangan');
            $this->db->from('tbl_absensi');
            $this->db->where('id_admin', $data['id_admin']);
            $this->db->where("waktu BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'");
            $hasil = $this->db->get();
            if ($hasil->num_rows() > 0) {
                $this->db->where("waktu BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'");
                $this->db->update('tbl_absensi', $data);
            } else {
                $this->db->insert('tbl_absensi', $data);
            }
        }
    }
    public function getlistabsensi($id = '')
    {
        if (isset($id)) {
            $query = "SELECT * FROM tbl_absensi WHERE MONTH(waktu) = MONTH(CURDATE())";
        } else {
            $query = "SELECT * FROM tbl_absensi WHERE MONTH(waktu) = MONTH(CURDATE()) and id_admin='" . $id . "'";
        }
        $hasil = $this->db->query($query)->result();
        $this->session->set_flashdata('query', $this->db->last_query());
        return $hasil;
    }

    // datatable target start
    public $column_search_target = array('nama_regional', 'tahun');
    public $column_order_target = array(null, 'nama_regional', 'tahun');
    public $order_target = array('tbl_target.tahun' => 'DESC');
    private function _get_query_target($id)
    {
        $get = $this->input->get();
        $this->db->from('tbl_target');
        $this->db->join('master_regional', 'master_regional.id = tbl_target.id_perumahan');
        $this->db->where('id_perumahan', $id);
        $i = 0;
        foreach ($this->column_search_target as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_target) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
    }

    public function get_target_datatable($id)
    {
        $get = $this->input->get();
        $this->_get_query_target($id);
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_target($id)
    {
        $this->_get_query_target($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_target($id)
    {
        $this->db->from('tbl_target');
        $this->db->where('id_perumahan', $id);
        return $this->db->count_all_results();
    }
    //datatable target end

    // CRUD target start
    public function rulestarget()
    {
        return [
            [
                'field' => 'tahun',
                'label' => 'ID Perumahan',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatatarget()
    {
        $post = $this->input->post();
        $target_luas = $post['luas1'] . ';' . $post['luas2'] . ';' . $post['luas3'] . ';' . $post['luas4'] . ';' . $post['luas5'] . ';' . $post['luas6'] . ';' . $post['luas7'] . ';' . $post['luas8'] . ';' . $post['luas9'] . ';' . $post['luas10'] . ';' . $post['luas11'] . ';' . $post['luas12'] . ';';
        $target_bid = $post['bid1'] . ';' . $post['bid2'] . ';' . $post['bid3'] . ';' . $post['bid4'] . ';' . $post['bid5'] . ';' . $post['bid6'] . ';' . $post['bid7'] . ';' . $post['bid8'] . ';' . $post['bid9'] . ';' . $post['bid10'] . ';' . $post['bid11'] . ';' . $post['bid12'] . ';';
        $array = array(
            'id_perumahan' => $post["id_perumahan"],
            'tahun' => $post["tahun"],
            'target_bid' => $target_bid,
            'target_luas' => $target_luas,
        );
        return $this->db->insert("tbl_target", $array);
    }
    public function updatedatatarget()
    {
        $post = $this->input->post();
        $target_luas = $post['luas1'] . ';' . $post['luas2'] . ';' . $post['luas3'] . ';' . $post['luas4'] . ';' . $post['luas5'] . ';' . $post['luas6'] . ';' . $post['luas7'] . ';' . $post['luas8'] . ';' . $post['luas9'] . ';' . $post['luas10'] . ';' . $post['luas11'] . ';' . $post['luas12'] . ';';
        $target_bid = $post['bid1'] . ';' . $post['bid2'] . ';' . $post['bid3'] . ';' . $post['bid4'] . ';' . $post['bid5'] . ';' . $post['bid6'] . ';' . $post['bid7'] . ';' . $post['bid8'] . ';' . $post['bid9'] . ';' . $post['bid10'] . ';' . $post['bid11'] . ';' . $post['bid12'] . ';';
        $this->id_perumahan = $post["id_perumahan"];
        $this->tahun = $post["tahun"];
        $this->target_luas = $target_luas;
        $this->target_bid = $target_bid;
        return $this->db->update("tbl_target", $this, array('id_target' => $post['idd']));
    }
    public function hapusdatatarget()
    {
        $id = $_POST['idd'];
        $this->db->where('id_target', $id);
        return $this->db->delete('tbl_target');
    }
    // CRUD target end

    // datatable distributor start
    public $column_search_distributor = array('nama_distributor', 'telepon', 'alamat', 'nama_regional');
    public $column_order_distributor = array(null, 'nama_distributor', 'telepon', 'alamat', 'nama_regional');
    public $order_distributor = array('master_distributor.waktu_update' => 'DESC');
    private function _get_query_distributor()
    {
        $get = $this->input->get();
        $this->db->select('master_distributor.*,master_regional.nama_regional,master_penjual.nama_penjual');
        $this->db->from('master_distributor');
        $this->db->join('master_regional', 'master_regional.id = master_distributor.id_regional');
        $this->db->join('master_penjual', 'master_penjual.id = master_distributor.id_penjual');
        $i = 0;
        foreach ($this->column_search_distributor as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_distributor) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_distributor[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_distributor)) {
            $order = $this->order_distributor;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function getproses_indukarray()
    {

        $this->db->from('tbl_dtl_proses_induk');
        $firstdate = $this->input->get('firstdate');
        $lastdate = $this->input->get('lastdate');
        if ($firstdate != '' and $lastdate != '') {
            $this->db->where('tgl_proses_induk BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        $hasil = $this->db->get();
        if ($hasil->num_rows() > 0) {
            return $hasil->result_array();
        } else {
            return null;
        }
    }
    public function get_distributor_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_distributor();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_distributor()
    {
        $this->_get_query_distributor();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_distributor()
    {
        $this->db->from('master_distributor');
        return $this->db->count_all_results();
    }
    //datatable distributor end
    // CRUD distributor start
    public function rulesdistributor()
    {
        return [
            [
                'field' => 'nama_distributor',
                'label' => 'Nama distributor',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatadistributor()
    {
        $post = $this->input->post();
        $array = array(
            'nama_distributor' => $post["nama_distributor"],
            'alamat' => $post["alamat"],
            'telepon' => $post["telepon"],
            'id_regional' => $post["id_regional"],
            'id_penjual' => $this->session->userdata('idadmin'),
        );
        return $this->db->insert("master_distributor", $array);
    }
    public function updatedatadistributor()
    {
        $post = $this->input->post();
        $this->nama_distributor = $post["nama_distributor"];
        $this->alamat = $post["alamat"];
        $this->telepon = $post["telepon"];
        $this->id_regional = $post["id_regional"];
        $this->id_penjual = $post["id_penjual"];
        return $this->db->update("master_distributor", $this, array('id' => $post['idd']));
    }
    public function hapusdatadistributor()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('master_distributor');
    }
    // CRUD distributor end
    // datatable pembeli start
    public $column_search_pembeli = array('nama_pembeli', 'jenis_kelamin', 'handphone', 'email');
    public $column_order_pembeli = array(null, 'nama_pembeli', 'jenis_kelamin', 'handphone', 'email');
    public $order_pembeli = array('master_pembeli.waktu_update' => 'DESC');
    private function _get_query_pembeli()
    {
        $get = $this->input->get();
        $this->db->from('master_pembeli');
        $this->db->join('master_penjual', 'master_penjual.id = master_pembeli.id_penjual');
        $i = 0;
        foreach ($this->column_search_pembeli as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_pembeli) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_pembeli[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_pembeli)) {
            $order = $this->order_pembeli;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_pembeli_datatable($jenis = '')
    {
        $get = $this->input->get();
        $this->_get_query_pembeli();
        if ($jenis != '') {
            $this->db->where('jenis_pembeli', $jenis);

        }
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_pembeli()
    {
        $this->_get_query_pembeli();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_pembeli()
    {
        $this->db->from('master_pembeli');
        return $this->db->count_all_results();
    }
    //datatable pembeli end

    //CRUD pembeli start
    public function rulespembeli()
    {
        return [
            [
                'field' => 'nama_pembeli',
                'label' => 'Nama pembeli',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatapembeli()
    {
        $post = $this->input->post();
        $array = array(
            'nama_pembeli' => $post["nama_pembeli"],
            'alamat' => $post["alamat"],
            'hp' => $post["hp"],
            'stok_awal' => $post["stok_awal"],
            'total' => $post["total"],
            'jenis_pembeli' => $post["jenis_pembeli"],
            'luas_sawah' => $post["luas_sawah"],
            'id_penjual' => $this->session->userdata('idadmin'),

        );
        $this->db->insert("master_pembeli", $array);
        return $this->db->insert_id();
    }
    public function updatedatapembeli()
    {
        $post = $this->input->post();
        $this->nama_pembeli = $post["nama_pembeli"];
        $this->alamat = $post["alamat"];
        $this->hp = $post["hp"];
        $this->stok_awal = $post["stok_awal"];
        $this->total = $post["total"];
        $this->id_penjual = $post["id_penjual"];
        $this->luas_sawah = $post["luas_sawah"];
        $this->jenis_pembeli = $post["jenis_pembeli"];

        return $this->db->update("master_pembeli", $this, array('id' => $post['idd']));
    }
    public function hapusdatapembeli()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('master_pembeli');
    }
    //CRUD pembeli end
    public function getperumahanbykategori($status)
    {
        $get = $this->input->get();
        $this->db->select('*');
        $this->db->from('master_regional');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = master_regional.id_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = master_regional.id_kecamatan', 'left');
        $this->db->join('desa', 'desa.id_desa = master_regional.lokasi', 'left');
        if ($status != '') {
            $this->db->where('status_regional', $status);
        }
        if(isset($get['id_perumahan'])){
            $this->db->where('id', $get['id_perumahan']);
        }
        return $this->db->get()->result();
    }

    // datatable kategori start
    public $column_search_kategori = array('id', 'lokasi', 'nama_regional', 'nama_kabupaten', 'nama_desa', 'nama_kecamatan');
    public $column_order_kategori = array(null, 'id', 'lokasi');
    public $order_kategori = array('waktu_update' => 'DESC');
    private function _get_query_kategori($status = '')
    {
        $get = $this->input->get();
        $this->db->from('master_regional');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = master_regional.id_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = master_regional.id_kecamatan', 'left');
        $this->db->join('desa', 'desa.id_desa = master_regional.lokasi', 'left');
        if ($status != '') {
            $this->db->where('status_regional', $status);
        }
        $i = 0;
        foreach ($this->column_search_kategori as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_kategori) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if(isset($get['id_perumahan']) && $get['id_perumahan'] != ""){
            $this->db->where('id', $get['id_perumahan']);
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_kategori[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_kategori)) {
            $order = $this->order_kategori;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_kategori_datatable($status = '')
    {
        $get = $this->input->get();
        $this->_get_query_kategori($status);
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_kategori($status = '')
    {
        $this->_get_query_kategori($status);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_kategori($status = '')
    {
        $this->db->from('master_regional');
        if ($status != '') {
            $this->db->where('status_regional', $status);
        }
        return $this->db->count_all_results();
    }
    //datatable kategori end

    //CRUD kategori start
    public function ruleskategori()
    {
        return [
            [
                'field' => 'id',
                'label' => 'Nama kategori',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatakategori()
    {
        $post = $this->input->post();
        $array = array(
            'nama_regional' => $post["nama_regional"],
            'id_kecamatan' => $post["id_kecamatan"],
            'id_kabupaten' => $post["id_kabupaten"],
            'lokasi' => $post["lokasi"],
            'status_regional' => $post["status_regional"],
        );
        return $this->db->insert("master_regional", $array);
    }
    public function updatedatakategori()
    {
        $post = $this->input->post();
        $this->nama_regional = $post["nama_regional"];
        $this->id_kabupaten = $post["id_kabupaten"];
        $this->id_kecamatan = $post["id_kecamatan"];
        $this->lokasi = $post["lokasi"];
        $this->status_regional = $post["status_regional"];
        return $this->db->update("master_regional", $this, array('id' => $post['id']));
    }
    public function hapusdatakategori()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['id']);
        return $this->db->delete('master_regional');
    }
    //CRUD kategori end

    //CRUD stok_split start
    public function rulesstok_split()
    {
        return [
            [
                'field' => 'blok',
                'label' => 'Blok',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatastok_split()
    {
        $post = $this->input->post();
        $array = array(
            'blok' => $post["blok"],
            'id_perumahan' => $post["id_perumahan"],
            'luas_teknik' => $post["luas_teknik"]);
        return $this->db->insert("tbl_stok_split", $array);
    }

    public function simpandatajual_stok()
    {
        $post = $this->input->post();
        $array = array(
            'nama_pembeli' => $post["nama_pembeli"],
            'id_stok_split' => $post["id_stok_split"],
            'nik' => $post["nik"],
            'pekerjaan' => $post["pekerjaan"],
            'tgl_terima_nego' => $post["tgl_terima_nego"],
            'tgl_penjualan' => $post["tgl_penjualan"],
            'sistem_pembayaran' => $post["sistem_pembayaran"],
            'tipe' => $post["tipe"],
            'status_jual' => '1',
            'harga' => bilanganbulat($post["harga"]));
        $insertpenjualan = $this->db->insert("master_penjualan", $array);

        if ($insertpenjualan) {
            // $id = $this->db->insert_id();
            // $this->db->where('id_stok_split', $post['id_stok_split']);
            // $update = array('id_jual' => $id );
            // $this->db->update('tbl_stok_split', $update);
            return true;
        } else {
            return false;
        }
    }
    public function updatedatastok_split()
    {
        $post = $this->input->post();
        $this->blok = $post["blok"];
        $this->id_perumahan = $post["id_perumahan"];
        $this->luas_teknik = $post["luas_teknik"];
        return $this->db->update("tbl_stok_split", $this, array('id_stok_split' => $post['id_stok_split']));
    }
    public function hapusdatastok_split()
    {
        $post = $this->input->post();
        $this->db->where('id_stok_split', $post['id_stok_split']);
        return $this->db->delete('tbl_stok_split');

    }

    public function hapusdatajual()
    {
        $post = $this->input->post();
        // $update = array('id_jual' => 0 );
        // $this->db->where('id_jual', $post['id_jual']);
        // $this->db->update('tbl_stok_split', $update);

        // $update = array('status_jual' => '0',
        //     'tgl_batal' =>  date('Y-m-d'),
        //     'oleh' =>$this->session->userdata('idadmin')
        // );

        $update = [
            'status_jual' => 0,
        ];

        $this->db->where('id_jual', $post['id_jual']);
        return $this->db->update('master_penjualan', $update);
    }
    //CRUD stok_split end

    public function get_satuan_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_satuan();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_satuan()
    {
        $this->_get_query_satuan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_satuan()
    {
        $this->db->from('master_satuan');
        return $this->db->count_all_results();
    }
    //datatable satuan end

    //CRUD satuan start
    public function rulessatuan()
    {
        return [
            [
                'field' => 'id',
                'label' => 'Nama satuan',
                'rules' => 'is_unique[master_satuan.id]|required',
            ],
        ];
    }
    public function simpandatasatuan()
    {
        $post = $this->input->post();
        $array = array(
            'id' => $post["id"],
            'isi_persatuan' => $post["isi_persatuan"],
            'satuan_besar' => $post["satuan_besar"],
        );
        return $this->db->insert("master_satuan", $array);
    }
    public function updatedatasatuan()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->isi_persatuan = $post["isi_persatuan"];
        $this->satuan_besar = $post["satuan_besar"];
        return $this->db->update("master_satuan", $this, array('id' => $post['idd']));
    }
    public function hapusdatasatuan()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('master_satuan');
    }
    //CRUD satuan end

    // datatable sertifikat_tanah start
    public $column_search_sertifikat_tanah = array('id_sertifikat_tanah');
    public $column_order_sertifikat_tanah = array(null, 'id_sertifikat_tanah');
    public $order_sertifikat_tanah = array('id_sertifikat_tanah' => 'DESC');
    private function _get_query_sertifikat_tanah()
    {
        $get = $this->input->get();
        $this->db->from('tbl_sertifikat_tanah');
        $i = 0;
        foreach ($this->column_search_sertifikat_tanah as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_sertifikat_tanah) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_sertifikat_tanah[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_sertifikat_tanah)) {
            $order = $this->order_sertifikat_tanah;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_sertifikat_tanah_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_sertifikat_tanah();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_sertifikat_tanah()
    {
        $this->_get_query_sertifikat_tanah();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_sertifikat_tanah()
    {
        $this->db->from('tbl_sertifikat_tanah');
        return $this->db->count_all_results();
    }
    //datatable sertifikat_tanah end

    //CRUD sertifikat_tanah start
    public function rulessertifikat_tanah()
    {
        return [
            [
                'field' => 'kode_sertifikat',
                'label' => 'Kode Sertifikat Tanah',
                'rules' => 'is_unique[tbl_sertifikat_tanah.kode_sertifikat]|required',
            ],
        ];
    }
    public function simpandatasertifikat_tanah()
    {
        $post = $this->input->post();
        $array = array(
            'kode_sertifikat' => $post["kode_sertifikat"],
            'nama_sertifikat' => $post["nama_sertifikat"],
        );
        return $this->db->insert("tbl_sertifikat_tanah", $array);
    }

    public function hapusdatasertifikat_tanah()
    {
        $post = $this->input->post();
        $this->db->where('id_sertifikat_tanah', $post['idd']);
        return $this->db->delete('tbl_sertifikat_tanah');
    }
    public function updatedatasertifikat_tanah()
    {
        $post = $this->input->post();
        $this->kode_sertifikat = $post["kode_sertifikat"];
        $this->nama_sertifikat = $post["nama_sertifikat"];
        return $this->db->update("tbl_sertifikat_tanah", $this, array('id_sertifikat_tanah' => $post['idd']));
    }

    // datatable jenis_pengalihan start
    public $column_search_jenis_pengalihan = array('id_pengalihan', 'kode_pengalihan', 'nama_pengalihan');
    public $column_order_jenis_pengalihan = array(null, 'id_pengalihan', 'kode_pengalihan', 'nama_pengalihan');
    public $order_jenis_pengalihan = array('id_pengalihan' => 'DESC');
    private function _get_query_jenis_pengalihan()
    {
        $get = $this->input->get();
        $this->db->from('tbl_jenis_pengalihan');
        $i = 0;
        foreach ($this->column_search_jenis_pengalihan as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_jenis_pengalihan) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_jenis_pengalihan[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_jenis_pengalihan)) {
            $order = $this->order_jenis_pengalihan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_jenis_pengalihan_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_jenis_pengalihan();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_jenis_pengalihan()
    {
        $this->_get_query_jenis_pengalihan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_jenis_pengalihan()
    {
        $this->db->from('tbl_jenis_pengalihan');
        return $this->db->count_all_results();
    }
    //datatable jenis_pengalihan end

    //CRUD jenis_pengalihan start
    public function rulesjenis_pengalihan()
    {
        return [
            [
                'field' => 'kode_pengalihan',
                'label' => 'Kode pengalihan Tanah',
                'rules' => 'is_unique[tbl_jenis_pengalihan.kode_pengalihan]|required',
            ],
        ];
    }
    public function simpandatajenis_pengalihan()
    {
        $post = $this->input->post();
        $array = array(
            'kode_pengalihan' => $post["kode_pengalihan"],
            'nama_pengalihan' => $post["nama_pengalihan"],
        );
        return $this->db->insert("tbl_jenis_pengalihan", $array);
    }

    public function hapusdatajenis_pengalihan()
    {
        $post = $this->input->post();
        $this->db->where('id_pengalihan', $post['idd']);
        return $this->db->delete('tbl_jenis_pengalihan');
    }
    public function updatedatajenis_pengalihan()
    {
        $post = $this->input->post();
        $this->kode_pengalihan = $post["kode_pengalihan"];
        $this->nama_pengalihan = $post["nama_pengalihan"];
        return $this->db->update("tbl_jenis_pengalihan", $this, array('id_pengalihan' => $post['idd']));
    }
    public function get_rekaplandbank($id = '', $firstdate = '', $lastdate = '', $teknik = '')
    {
        $this->db->select('sum(jumlah_bidang) as bid,sum(luas_surat) as surat,sum(luas_ukur) as ukur');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('id_perumahan', $id);
        }

        if (!empty($teknik)) {
            $this->db->where('status_teknik', $teknik);
        }
        $hasil = $this->db->get()->result_array()[0];
        if ($hasil['bid'] != '') {
            return $hasil;
        } else {
            return array('bid' => '0', 'ukur' => '0', 'surat' => '0');
        }
    }

    public function get_rekapshgb($id = '', $firstdate = '', $lastdate = '', $shgb = '')
    {
        $this->db->select('sum(jumlah_bidang) as bid,sum(luas_surat) as surat,sum(luas_ukur) as ukur');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('id_perumahan', $id);
        }

        if (!empty($teknik)) {
            $this->db->where('a.status_surat_tanah1', $shgb);
        }
        $hasil = $this->db->get()->result_array()[0];
        if ($hasil['bid'] != '') {
            return $hasil;
        } else {
            return array('bid' => '0', 'ukur' => '0', 'surat' => '0');
        }
    }
    //CRUD sertifikat_tanah end
    public function getperumahan($id = '', $firstdate = '', $lastdate = '', $teknik = '')
    {
        $this->db->select('a.*,b.nama_regional,c.*,d.id_dtl_proses_induk,d.id_proses_induk,d.tgl_proses_induk');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        $this->db->join('tbl_dtl_proses_induk d', 'd.id_master_item = a.kode_item', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('id_perumahan', $id);
        }

        if (!empty($teknik)) {
            $this->db->where('status_teknik', $teknik);
        }

        return $this->db->get()->result();
    }

    public function getdataperumahan($id = '')
    {
        $this->db->select('*');
        $this->db->from('master_regional');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $this->db->where('id', $id);
        $hasil = $this->db->get();
        return $hasil->result_array()[0];
    }

    public function getperumahanarray($id = '', $firstdate = '', $lastdate = '', $teknik = '')
    {
        $this->db->select('a.*,b.nama_regional,c.*');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('id_perumahan', $id);
        }

        if (!empty($teknik)) {
            $this->db->where('status_teknik', 'sudah');
        }

        return $this->db->get()->result_array();
    }
    public function updatemasteritem($data)
    {
        $this->db->where('kode_item', $data['kode_item']);
        return $this->db->update('master_item', $data);
    }
    public function getshgbperumahan($id = '', $firstdate = '', $lastdate = '', $shgb = '')
    {
        $this->db->select('a.*,b.nama_regional,c.*,e.status as status_shgb');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        $this->db->join('tbl_dtl_proses_induk d', 'd.id_master_item = a.kode_item', 'left');
        $this->db->join('master_proses_induk e', 'e.id_proses_induk = d.id_proses_induk', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('a.id_perumahan', $id);
        }

        if ($shgb == 'belum') {

            $this->db->or_where('e.status', $shgb);
            $this->db->where('e.status', null);
        } else {
            $this->db->where('e.status', $shgb);

        }

        return $this->db->get()->result();
    }

    public function getshgbperumahanarray($id = '', $firstdate = '', $lastdate = '', $shgb = '')
    {
        $this->db->select('a.*,b.nama_regional,c.*');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        if (!empty($id)) {
            $this->db->where('id_perumahan', $id);
        }

        if (!empty($shgb)) {
            $this->db->where('status_order_akta', 'selesai');
        } else {
            $this->db->where('status_order_akta !=', 'selesai');

        }

        return $this->db->get()->result_array();
    }

    public function getmaster_prosesinduk($id_perumahan, $firstdate = '', $lastdate = '', $sudah = '')
    {
        $this->db->select('a.*');
        $this->db->from('master_proses_induk a');
        $this->db->where('id_perumahan', $id_perumahan);
        if (!empty($firstdate) and !empty($lastdate)) {
            $this->db->where('a.tanggal_daftar_sk_hak BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }

        if (!empty($sudah)) {
            $this->db->where('status', 'terbit');
        } else {
            $this->db->where('status', 'belum');
        }

        return $this->db->get()->result();
    }

    public function getprosesinduk($id)
    {
        $this->db->select('*');
        $this->db->from('master_proses_induk');
        $this->db->where('id_proses_induk', $id);
        return $this->db->get()->result_array();
    }

    public function getstatus()
    {
        $this->db->select('*');
        $this->db->from('master_status_regional');
        return $this->db->get()->result_array();
    }
    // datatable item start
    public $column_search_item = array('kode_item', 'nama_penjual', 'nama_surat_tanah', 'nama_makelar');
    public $column_order_item = array(null, 'kode_item', 'nama_penjual', 'nama_surat_tanah', 'nama_makelar');
    public $order_item = array('waktu_update' => 'DESC');
    private function _get_query_item()
    {
        $get = $this->input->get();
        $this->db->select('a.*,b.nama_regional,c.kode_sertifikat as kode_sertifikat1,c.nama_sertifikat as nama_surat_tanah1');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        // $this->db->join('tbl_sertifikat_tanah d', 'd.id_sertifikat_tanah = a.status_surat_tanah2', 'left');
        if (!empty($get['status'])) {
            $this->db->join('master_status_regional d', 'b.status_regional = d.id_status_regional', 'left');
            $this->db->where('d.id_status_regional', $get['status']);
        }
        if (!empty($get['id_perumahan'])) {
            $this->db->where('a.id_perumahan', $get['id_perumahan']);
        }
        if (!empty($get['firstdate']) && !empty($get['lastdate'])) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $get['firstdate'] . '" and "' . $get['lastdate'] . '"');
        }

        $i = 0;
        foreach ($this->column_search_item as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_item) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_item[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_item)) {
            $order = $this->order_item;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_item_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_item();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_item()
    {
        $this->_get_query_item();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_item()
    {
        $this->db->from('master_item');
        return $this->db->count_all_results();
    }
    //datatable item end

    //CRUD item start
    public function rulesitems()
    {
        return [
            [
                'field' => 'nama_penjual',
                'label' => 'Nama Item',
                'rules' => 'required',
            ],
        ];
    }
    public function rulesitemsedit()
    {
        return [
            [
                'field' => 'nama_penjual',
                'label' => 'Nama Item',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandataitems()
    {
        $post = $this->input->post();
        $tanggal_pengalihan = null;
        $akta_pengalihan = '';
        $nama_pengalihan = '';
        if (isset($post['tanggal_pengalihan'])) {
            $tanggal_pengalihan = $post['tanggal_pengalihan'];
        }
        if (isset($post['akta_pengalihan'])) {
            $tanggal_pengalihan = $post['akta_pengalihan'];
        }
        if (isset($post['nama_pengalihan'])) {
            $tanggal_pengalihan = $post['nama_pengalihan'];
        }
        $array = array(
            'tanggal_pembelian' => $post["tanggal_pembelian"],
            'nama_penjual' => $post["nama_penjual"],
            'nama_surat_tanah' => $post["nama_surat_tanah"],
            'status_surat_tanah1' => $post["status_surat_tanah1"],
            // 'status_surat_tanah2' => $post["status_surat_tanah2"],
            'keterangan1' => $post["keterangan1"],
            // 'keterangan1' => $post["keterangan1"],
            'no_gambar' => $post["no_gambar"],
            'jumlah_bidang' => $post["jumlah_bidang"],
            'luas_surat' => $post["luas_surat"],
            'luas_ukur' => $post["luas_ukur"],
            'no_pbb' => $post["no_pbb"],
            'atas_nama_pbb' => $post["atas_nama_pbb"],
            'luas_pbb_bangunan' => $post["luas_pbb_bangunan"],
            'njop_bangunan' => $post["njop_bangunan"],
            'luas_pbb_bumi' => $post["luas_pbb_bumi"],
            'njop_bumi' => $post["njop_bumi"],
            'total_harga_pengalihan' => bilanganbulat($post["total_harga_pengalihan"]),
            'nama_makelar' => $post["nama_makelar"],
            'nilai' => bilanganbulat($post["nilai"]),
            'jenis_pengalihan' => $post["jenis_pengalihan"],
            'tanggal_pengalihan' => $tanggal_pengalihan,
            'akta_pengalihan' => $akta_pengalihan,
            'nama_pengalihan' => $nama_pengalihan,
            'jenis_pengalihan' => $post["jenis_pengalihan"],
            'lain' => bilanganbulat($post["lain"]),
            'keterangan_lain' => $post["keterangan_lain"],
            'keterangan' => $post["keterangan"],
            'id_perumahan' => $post["id_perumahan"],
        );
        return $this->db->insert("master_item", $array);
    }

    public function updatedataitems()
    {
        $post = $this->input->post();
        $this->tanggal_pembelian = ($post["tanggal_pembelian"]);
        $this->nama_penjual = ($post["nama_penjual"]);
        $this->nama_surat_tanah = ($post["nama_surat_tanah"]);
        $this->status_surat_tanah1 = ($post["status_surat_tanah1"]);
        // $this->status_surat_tanah2 = ($post["status_surat_tanah2"]);
        $this->keterangan1 = ($post["keterangan1"]);
        // $this->keterangan2 = ($post["keterangan2"]);
        $this->no_gambar = ($post["no_gambar"]);
        $this->jumlah_bidang = bilanganbulat($post["jumlah_bidang"]);
        $this->luas_surat = bilanganbulat($post["luas_surat"]);
        $this->luas_ukur = bilanganbulat($post["luas_ukur"]);
        $this->atas_nama_pbb = ($post["atas_nama_pbb"]);
        $this->no_pbb = ($post["no_pbb"]);
        $this->luas_pbb_bangunan = bilanganbulat($post["luas_pbb_bangunan"]);
        $this->njop_bangunan = ($post["njop_bangunan"]);
        $this->luas_pbb_bumi = bilanganbulat($post["luas_pbb_bumi"]);
        $this->njop_bumi = ($post["njop_bumi"]);
        $this->total_harga_pengalihan = bilanganbulat($post["total_harga_pengalihan"]);
        $this->nama_makelar = ($post["nama_makelar"]);
        $this->nilai = bilanganbulat($post["nilai"]);
        $this->jenis_pengalihan = ($post["jenis_pengalihan"]);
        $this->lain = bilanganbulat($post["lain"]);
        $this->keterangan_lain = $post["keterangan_lain"];
        $this->keterangan = $post["keterangan"];
        $this->jenis_pengalihan = ($post["jenis_pengalihan"]);
        $this->id_perumahan = ($post["id_perumahan"]);
        return $this->db->update("master_item", $this, array('kode_item' => $post['idd']));
    }

    public function updatedatalandbank()
    {
        $post = $this->input->post();
        $this->nama_penjual = ($post["nama_penjual"]);
        $this->nama_surat_tanah = ($post["nama_surat_tanah"]);
        $this->tanggal_pembelian = ($post["tanggal_pembelian"]);
        $this->status_surat_tanah1 = ($post["status_surat_tanah"]);
        $this->keterangan1 = $post["keterangan1"];
        $this->total_harga_pengalihan = bilanganbulat($post["total_harga_pengalihan"]);
        $this->nama_makelar = ($post["nama_makelar"]);
        $this->nilai = bilanganbulat($post["nilai"]);
        $this->status_order_akta = ($post["status_order_akta"]);
        $this->tanggal_pengalihan = ($post["tanggal_pengalihan"]);
        $this->akta_pengalihan = ($post["akta_pengalihan"]);
        $this->jenis_pengalihan_hak = ($post["jenis_pengalihan_hak"]);
        $this->nama_pengalihan = ($post["nama_pengalihan"]);
        $this->lain = bilanganbulat($post["lain"]);
        $this->keterangan_lain = $post["keterangan_lain"];
        // $this->harga_perm = bilanganbulat($post["harga_perm"]);
        $this->status_teknik = ($post["status_teknik"]);
        $this->keterangan = ($post["keterangan"]);
        // $this->pematangan = bilanganbulat($post["pematangan"]);
        // $this->ganti_rugi = bilanganbulat($post["ganti_rugi"]);
        // $this->pbb = bilanganbulat($post["pbb"]);
        // $this->nama_item = ($post["nama_item"]);
        // // $this->id_posisi_surat = ($post["id_posisi_surat"]);
        return $this->db->update("master_item", $this, array('kode_item' => $post['idd']));
    }
    private function _uploadGambarProduk()
    {
        $post = $this->input->post();
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $post["kode_item"];
        $config['overwrite'] = true;
        $config['max_size'] = 1024;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        }
        return "default.jpg";
    }
    private function _hapusGambarProduk($id)
    {
        $product = $this->_namagambar($id);
        if ($product->gambar != "default.jpg") {
            $filename = explode(".", $product->gambar)[0];
            return array_map('unlink', glob(FCPATH . "images/$filename.*"));
        }
    }
    private function _namagambar($id)
    {
        return $this->db->get_where('master_item', ["kode_item" => $id])->row();
    }
    public function hapusdataitem()
    {
        $post = $this->input->post();
        $this->db->where('kode_item', $post['idd']);
        return $this->db->delete('master_item');
    }

//CRUD item end
    // datatable pilihan obat start
    public $column_search_pilihanobat = array('kode_item', 'nama_surat_tanah', 'no_gambar', 'no_pbb', 'tanggal_proses');
    public $column_order_pilihanobat = array(null, 'kode_item', 'nama_surat_tanah', 'no_gambar', 'no_pbb', 'tanggal_proses');
    public $order_pilihanobat = array('a.waktu_update' => 'DESC');

    private function _get_query_pilihanitem($id_perumahan = '')
    {
        $get = $this->input->get();
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
//   $this->db->where('kode_item not in (SELECT id_master_item from tbl_dtl_proses_induk)');
        $i = 0;
        foreach ($this->column_search_pilihanobat as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_pilihanobat) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_pilihanobat[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_pilihanobat)) {
            $order = $this->order_pilihanobat;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_pilihanitem_datatable($id_perumahan = '')
    {
        $get = $this->input->get();
        $this->_get_query_pilihanitem($id_perumahan);
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_pilihanitem($id_perumahan = '')
    {
        $this->_get_query_pilihanitem($id_perumahan);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_pilihanitem($id_perumahan)
    {
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->from('master_item');
        return $this->db->count_all_results();
    }
    //datatable pilihan obat end

    // datatable racikan start
    public $column_search_dataracikan = array('kode_item', 'nama_item', 'harga_jual', 'upah_peracik', 'aturan_pakai');
    public $column_order_dataracikan = array(null, 'kode_item', 'nama_item', 'harga_jual', 'upah_peracik', 'aturan_pakai');
    public $order_dataracikan = array('waktu_update' => 'DESC');
    private function _get_query_dataracikan()
    {
        $get = $this->input->get();
        $this->db->where('jenis', 'racikan');
        $this->db->from('master_item');
        $i = 0;
        foreach ($this->column_search_dataracikan as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_dataracikan) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_dataracikan[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_dataracikan)) {
            $order = $this->order_dataracikan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_dataracikan_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_dataracikan();
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_dataracikan()
    {
        $this->_get_query_dataracikan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_dataracikan()
    {
        $this->db->where('jenis', 'racikan');
        $this->db->from('master_item');
        return $this->db->count_all_results();
    }
    //datatable racikan end

    //CRUD racikan start
    public function get_dataracikan($idd)
    {
        $this->db->select("a.kode_obat, a.jumlah_obat_dibuat, a.jumlah_obat_dipakai, b.nama_item");
        $this->db->from("master_racikan a");
        $this->db->join('master_item b', 'a.kode_obat = b.kode_item AND a.kode_racikan="' . $idd . '"');
        return $this->db->get()->result();
    }

    public function simpandataracikan()
    {
        $post = $this->input->post();
        $array = array(
            'kode_item' => $post["kode_item"],
            'jenis' => 'racikan',
            'kategori' => $post["kategori"],
            'satuan' => $post["satuan"],
            'nama_item' => $post["nama_item"],
            'upah_peracik' => bilanganbulat($post["upah_peracik"]),
            'aturan_pakai' => $post["aturan_pakai"],
            'keterangan' => $post["keterangan"],
            'gambar' => $this->_uploadGambarProduk(),
            'harga_jual' => bilanganbulat($post["harga_jual"]),
        );

        $this->db->insert("master_item", $array);
        $kode_item = $this->input->post("kode_item");
        $kode_obat = $this->input->post("kode_obat");
        $jumlah_obat_dibuat = $this->input->post("jumlah_obat_dibuat");
        $jumlah_obat_dipakai = $this->input->post("jumlah_obat_dipakai");
        for ($i = 0; $i < count($kode_obat); $i++) {
            $listobat = array(
                'kode_racikan' => $kode_item,
                'kode_obat' => $kode_obat[$i],
                'jumlah_obat_dibuat' => $jumlah_obat_dibuat[$i],
                'jumlah_obat_dipakai' => $jumlah_obat_dipakai[$i],
            );
            $this->db->insert("master_racikan", $listobat);
        }
        return true;
    }
    public function hapusdataracikan()
    {
        $post = $this->input->post();
        $this->_hapusGambarProduk($post['idd']);
        $this->db->where('kode_item', $post['idd']);
        return $this->db->delete('master_item');
    }
    public function updatedataracikan()
    {
        $post = $this->input->post();
        $this->kode_item = $post["kode_item"];
        $this->kategori = $post["kategori"];
        $this->satuan = $post["satuan"];
        $this->nama_item = $post["nama_item"];
        $this->upah_peracik = bilanganbulat($post["upah_peracik"]);
        $this->aturan_pakai = $post["aturan_pakai"];
        $this->keterangan = $post["keterangan"];
        $this->harga_jual = bilanganbulat($post["harga_jual"]);
        if (!empty($_FILES["gambar"]["name"])) {
            $this->gambar = $this->_uploadGambarProduk();
        }
        $this->db->update("master_item", $this, array('kode_item' => $post['idd']));
        $this->db->where('kode_racikan', $post['idd'])->delete('master_racikan');
        $kode_item = $this->input->post("kode_item");
        $kode_obat = $this->input->post("kode_obat");
        $jumlah_obat_dibuat = $this->input->post("jumlah_obat_dibuat");
        $jumlah_obat_dipakai = $this->input->post("jumlah_obat_dipakai");
        for ($i = 0; $i < count($kode_obat); $i++) {
            $listobat = array(
                'kode_racikan' => $kode_item,
                'kode_obat' => $kode_obat[$i],
                'jumlah_obat_dibuat' => $jumlah_obat_dibuat[$i],
                'jumlah_obat_dipakai' => $jumlah_obat_dipakai[$i],
            );
            $this->db->insert("master_racikan", $listobat);
        }
        return true;
    }

    // datatable penjual start
    public $column_search_penjual = array('nama_penjual', 'kontak', 'alamat');
    public $column_order_penjual = array(null, 'nama_penjual', 'kontak', 'alamat');
    public $order_penjual = array('master_penjual.waktu_update' => 'DESC');
    private function _get_query_penjual()
    {
        $get = $this->input->get();
        $this->db->select('master_penjual.*,master_regional.id as id_regional,master_regional.nama_regional');
        $this->db->from('master_penjual');
        $this->db->join('master_regional', 'master_regional.id = master_penjual.regional');
        $i = 0;
        foreach ($this->column_search_penjual as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_penjual) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_penjual[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_penjual)) {
            $order = $this->order_penjual;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_penjual_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_penjual();
        // $this->db->where('jenis_pembeli','2');
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_penjual()
    {
        $this->_get_query_penjual();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_penjual()
    {
        $this->db->from('master_penjual');
        return $this->db->count_all_results();
    }
    //datatable penjual end

    //CRUD penjual start
    public function rulespenjual()
    {
        return [
            [
                'field' => 'nama_penjual',
                'label' => 'Nama penjual',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandatapenjual()
    {
        $post = $this->input->post();
        $array = array(
            'alamat' => $post["alamat"],
            'nama_penjual' => $post["nama_penjual"],
            'kontak' => $post["kontak"],
            'regional' => $post["regional"],
            'nik' => $post["nik"],
            'target' => $post["target"],
        );
        $this->db->insert("master_penjual", $array);
        return $this->db->insert_id();
    }
    public function updatedatapenjual()
    {
        $post = $this->input->post();
        $this->nama_penjual = $post["nama_penjual"];
        $this->alamat = $post["alamat"];
        $this->kontak = $post["kontak"];
        $this->regional = $post["regional"];
        $this->nik = $post["nik"];
        $this->target = $post["target"];
        return $this->db->update("master_penjual", $this, array('id' => $post['idd']));
    }
    public function hapusdatapenjual()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('master_penjual');
    }
    //CRUD penjual end

// datatable blok start
    public $column_search_blok = array('id_stok_split', 'blok', 'luas_teknik');
    public $column_order_blok = array(null, 'id_stok_split', 'blok', 'luas_teknik');
    public $order_blok = array('blok' => 'DESC');
    public function _get_query_blok($id_perumahan = '')
    {
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->select('*');
        $this->db->from('tbl_stok_split');
        $get = $this->input->get();
        $i = 0;
        foreach ($this->column_search_blok as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_prosesinduk) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_blok[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_blok)) {
            $order = $this->order_blok;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_blokdatatable($id_perumahan = '')
    {
        $get = $this->input->get();
        $this->_get_query_blok($id_perumahan);
        // $this->db->where('jenis_pembeli','2');
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_blok($id_perumahan = '')
    {
        $this->_get_query_prosesinduk($id_perumahan);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatableblok($id_perumahan = '')
    {
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->from('tbl_stok_split');
        return $this->db->count_all_results();
    }
//datatable blok end

// datatable proses_induk start
    public $column_search_prosesinduk = array('tgl_proses_induk', 'id_master_item', 'keterangan');
    public $column_order_prosesinduk = array(null, 'tgl_proses_induk', 'keterangan');
    public $order_prosesinduk = array('a.id_proses_induk' => 'DESC');
    public function _get_query_prosesinduk($id_perumahan = '')
    {
        $this->db->where('id_perumahan', $id_perumahan);
        $this->db->select('a.*,c.nama_regional');
        $this->db->from('master_proses_induk a');
        $this->db->join('master_regional c', 'a.id_perumahan = c.id', 'left');
        $get = $this->input->get();
        $i = 0;
        foreach ($this->column_search_prosesinduk as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_prosesinduk) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_prosesinduk[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_prosesinduk)) {
            $order = $this->order_prosesinduk;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_prosesindukdatatable($id_perumahan = '')
    {
        $get = $this->input->get();
        $this->_get_query_prosesinduk($id_perumahan);
        // $this->db->where('jenis_pembeli','2');
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_prosesinduk($id_perumahan = '')
    {
        $this->_get_query_prosesinduk($id_perumahan);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatableproses_induk($id_perumahan = '')
    {
        $this->db->from('tbl_dtl_proses_induk');
        return $this->db->count_all_results();
    }
//datatable proses_induk end

// datatable proses_induk start
    public $column_search_proses_induk = array('tgl_proses_induk', 'id_master_item', 'keterangan');
    public $column_order_proses_induk = array(null, 'tgl_proses_induk', 'keterangan');
    public $order_proses_induk = array('a.waktu_update' => 'DESC');
    private function _get_query_proses_induk()
    {
        $this->db->select('a.*,b.luas_surat,b.luas_ukur,c.nama_regional');
        $this->db->from('tbl_dtl_proses_induk a');
        $this->db->join('master_item b', 'b.kode_item = a.id_master_item', 'left');
        $this->db->join('master_regional c', 'b.id_perumahan = c.id', 'left');
        $get = $this->input->get();
        $i = 0;
        foreach ($this->column_search_proses_induk as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_proses_induk) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_proses_induk[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_proses_induk)) {
            $order = $this->order_proses_induk;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_proses_induk_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_proses_induk();
        // $this->db->where('jenis_pembeli','2');
        if ($get['length'] != -1) {
            $this->db->limit($get['length'], $get['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered_datatable_proses_induk()
    {
        $this->_get_query_proses_induk();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_proses_induk()
    {
        $this->db->from('tbl_dtl_proses_induk');
        return $this->db->count_all_results();
    }
//datatable proses_induk end

//CRUD proses_induk start
    public function rulesproses_induk()
    {
        return [
            [
                'field' => 'tgl_proses_induk',
                'label' => 'Tanggal proses_induk',
                'rules' => 'required',
            ],
        ];
    }
    public function simpandataproses_induk()
    {
        $post = $this->input->post();
        $array = array(
            'id_proses_induk' => $post["id_proses_induk"],
            'tgl_proses_induk' => $post["tgl_proses_induk"],
            'keterangan' => $post["keterangan"],
            'id_master_item' => $post["id_master_item"],
        );
        $this->db->insert("tbl_dtl_proses_induk", $array);
        return $this->db->insert_id();
    }
    public function updatedataproses_induk()
    {
        $post = $this->input->post();
        $this->id_proses_induk = $post["id_proses_induk"];
        $this->tgl_proses_induk = $post["tgl_proses_induk"];
        $this->keterangan = $post["keterangan"];
        return $this->db->update("tbl_dtl_proses_induk", $this, array('id_dtl_proses_induk' => $post['idd']));
    }
    public function hapusdataproses_induk()
    {
        $post = $this->input->post();
        $this->db->where('id_dtl_proses_induk', $post['idd']);
        return $this->db->delete('tbl_dtl_proses_induk');
    }
//CRUD proses_induk end

    public function rulesdetailproses_induk()
    {
        return [
            [
                'field' => 'tgl_proses_induk',
                'label' => 'Tanggal proses_induk',
                'rules' => 'required',
            ],
        ];
    }

    public function master_tanah_all($id = null, $firstdate = "", $lastdate = "")
    {
        $this->db->select('a.*,b.nama_regional,c.kode_sertifikat as kode_sertifikat1,c.nama_sertifikat as nama_surat_tanah1');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        // $this->db->join('tbl_sertifikat_tanah d', 'd.id_sertifikat_tanah = a.status_surat_tanah2', 'left');
        if ($id !== null) {
            $this->db->where('a.id_perumahan', $id);
        }
        if (!empty($firstdate) && !empty($lastdate)) {
            $this->db->where('a.tanggal_pembelian BETWEEN "' . $firstdate . '" and "' . $lastdate . '"');
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function rekap_proses_ijin()
    {
        $get = $this->input->get();
        $this->db->select('*');
        $this->db->from('master_regional');
        $this->db->join('master_status_regional', 'master_regional.status_regional = master_status_regional.id_status_regional', 'left');
        $this->db->join('kabupaten', 'kabupaten.id_kabupaten = master_regional.id_kabupaten', 'left');
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = master_regional.id_kecamatan', 'left');
        $this->db->join('desa', 'desa.id_desa = master_regional.lokasi', 'left');
        if(isset($get['id_perumahan']) && $get['id_perumahan'] != "" ){
            $this->db->where('id', $get['id_perumahan']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function perumahan()
    {
        $this->db->select('b.nama_regional, b.id');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        // $this->db->join('tbl_sertifikat_tanah d', 'd.id_sertifikat_tanah = a.status_surat_tanah2', 'left');
        // $this->db->group_by('b.nama_regional');
        $query = $this->db->get();
        return $query->result();
    }

    public function manajemen_excel()
    {
        $this->db->select("*");
        $this->db->from("excel");

        return $this->db->get()->result();
    }

    public function update_data_excel()
    {
        $post = $this->input->post();
        $this->nama = $post["nama"];
        $this->posisi = $post["posisi"];
        return $this->db->update("excel", $this, array('id' => $post['idd']));
    }

}
