<?php
class Stok_model extends CI_Model
{

    // datatable stok keluar start
    var $column_search_stokkeluar = array('tanggal', 'nomor_ref', 'nomor_retur_pembelian', 'kode_item', 'nama_item', 'kuantiti', 'satuan_kecil');
    var $column_order_stokkeluar = array(null, 'tanggal', 'nomor_ref', 'nomor_retur_pembelian', 'kode_item', 'nama_item', 'kuantiti', 'satuan_kecil');
    var $order_stokkeluar = array('waktu_update' => 'DESC');
    private function _get_query_stokkeluar()
    {
        $get = $this->input->get();
        $this->db->from('stok_keluar');
        $i = 0;
        foreach ($this->column_search_stokkeluar as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_stokkeluar) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_stokkeluar[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_stokkeluar)) {
            $order = $this->order_stokkeluar;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_stokkeluar_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_stokkeluar();
        if ($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_stokkeluar()
    {
        $this->_get_query_stokkeluar();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_stokkeluar()
    {
        $this->db->from('stok_keluar');
        return $this->db->count_all_results();
    }
    //datatable stok keluar end

    // CRUD stok keluar retur start
    public function rulesstokkeluar()
    {
        return [
            [
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required',
            ]
        ];
    }

    private function _kode_stokkeluar()
    {
        $jumlah = $this->db->select('*')->from('stok_keluar')->get()->num_rows();
        $jml_baru = $jumlah + 1;
        $kode = sprintf("%04s", $jml_baru);
        $kode = "KRE" . date('dmy') . $kode;
        $cek_ada = $this->db->select('*')->from('stok_keluar')->where('nomor_ref ="' . $kode . '"')->get()->num_rows();
        if ($cek_ada > 0) {
            return $this->_kode_stokkeluar();
        } else {
            return $kode;
        }
    }

    function simpandatastokkeluar()
    {
        $post = $this->input->post();
        $nomor_ref = $this->_kode_stokkeluar();
        $array = array(
            'tanggal' => $post["tanggal"],
            'nomor_ref' => $nomor_ref,
            'nomor_retur_pembelian' => $post["nomor_retur_pembelian"],
            'kuantiti' => $post["kuantiti"],
            'kode_item' => $post["kode_item"],
            'nama_item' => $post["nama_item"],
            'tgl_expired' => $post["tgl_expired"],
            'satuan_kecil' => $post['satuan_kecil'],
            'keterangan' => $post['keterangan'],
        );
        $this->db->insert("stok_keluar", $array);
        $insert_id = $this->db->insert_id();
        $list_kartustok = array(
            'id_stok_keluar' => $insert_id,
            'kode_item' => $post["kode_item"],
            'tanggal' => $post["tanggal"],
            'jenis_transaksi' => "retur pembelian",
            'jumlah_masuk' => 0,
            'tgl_expired' => $post["tgl_expired"],
            'jumlah_keluar' => $post["kuantiti"],
            'satuan_kecil' => $post['satuan_kecil']
        );
        $this->db->insert("kartu_stok", $list_kartustok);
        $this->db->set('stok', 'stok - ' . (int) $post["kuantiti"], FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        return TRUE;
    }

    public function hapusdatastokkeluar()
    {
        $post = $this->input->post();
        $this->db->set('stok', 'stok + ' . (int) $post["kuantiti"], FALSE)->where('kode_item', $post["kode_item_hapus"])->update('master_item');
        return $this->db->where('id', $post['idd'])->delete('stok_keluar');
    }
    // CRUD stok keluar end


    // datatable stok adjustment start
    var $column_search_stokadjustment = array('tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $column_order_stokadjustment = array(null, 'tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $order_stokadjustment = array('waktu_update' => 'DESC');
    private function _get_query_stokadjustment()
    {
        $get = $this->input->get();
        $this->db->from('stok_adjustment');
        $i = 0;
        foreach ($this->column_search_stokadjustment as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_stokadjustment) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_stokadjustment[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_stokadjustment)) {
            $order = $this->order_stokadjustment;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_stokadjustment_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_stokadjustment();
        if ($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_stokadjustment()
    {
        $this->_get_query_stokadjustment();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_stokadjustment()
    {
        $this->db->from('stok_adjustment');
        return $this->db->count_all_results();
    }
    //datatable stok adjustment end

    // CRUD stok adjustment start
    public function rulesstokadjustment()
    {
        return [
            [
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required',
            ],
            [
                'field' => 'kuantiti_berubah',
                'label' => 'kuantiti',
                'rules' => 'required',
            ]
        ];
    }

    private function _kode_stokadjustment()
    {
        $jumlah = $this->db->select('*')->from('stok_adjustment')->get()->num_rows();
        $jml_baru = $jumlah + 1;
        $kode = sprintf("%04s", $jml_baru);
        $kode = "SA" . date('dmy') . $kode;
        $cek_ada = $this->db->select('*')->from('stok_adjustment')->where('nomor_ref ="' . $kode . '"')->get()->num_rows();
        if ($cek_ada > 0) {
            return $this->_kode_stokadjustment();
        } else {
            return $kode;
        }
    }
    function simpandatastokadjustment()
    {
        $post = $this->input->post();
        $array = array(
            'tanggal' => $post["tanggal"],
            'nomor_ref' => $this->_kode_stokadjustment(),
            'stok_sebelum' => $post["stok_sebelum"],
            'kuantiti_berubah' => $post["kuantiti_berubah"],
            'kode_item' => $post["kode_item"],
            'nama_item' => $post["nama_item"],
            'tgl_expired' => $post["tgl_expired"],
            'satuan_kecil' => $post['satuan_kecil'],
            'keterangan' => $post['keterangan'],
        );
        $this->db->insert("stok_adjustment", $array);
        $insert_id = $this->db->insert_id();
        $list_kartustok = array(
            'id_stok_adjustment' => $insert_id,
            'kode_item' => $post["kode_item"],
            'tanggal' => $post["tanggal"],
            'jenis_transaksi' => "stok adjustment",
            'jumlah_masuk' => 0,
            'jumlah_keluar' => $post["kuantiti_berubah"],
            'tgl_expired' => $post["tgl_expired"],
            'satuan_kecil' => $post['satuan_kecil']
        );
        $this->db->insert("kartu_stok", $list_kartustok);
        $this->db->set('stok', 'stok - ' . (int) $post["kuantiti_berubah"], FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        return TRUE;
    }
    public function hapusdatastokadjustment()
    {
        $post = $this->input->post();
        $this->db->set('stok', 'stok + ' . (int) $post["kuantiti"], FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        return $this->db->where('id', $post['idd'])->delete('stok_adjustment');
    }
    // CRUD stok adjustment end

    // datatable stok opname start
    var $column_search_stokopname = array('tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $column_order_stokopname = array(null, 'tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $order_stokopname = array('waktu_update' => 'DESC');
    private function _get_query_stokopname()
    {
        $get = $this->input->get();
        $this->db->where('verifikasi !=', '0')->from('stok_opname');
        $i = 0;
        foreach ($this->column_search_stokopname as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_stokopname) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_stokopname[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_stokopname)) {
            $order = $this->order_stokopname;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_stokopname_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_stokopname();
        if ($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_stokopname()
    {
        $this->_get_query_stokopname();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_stokopname()
    {
        $this->db->where('verifikasi !=', '0')->from('stok_opname');
        return $this->db->count_all_results();
    }
    //datatable stok opname end

    // datatable stok opname verifikasi start
    var $column_search_stokdataverfikasi = array('tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $column_order_stokdataverfikasi = array(null, 'tanggal', 'nomor_ref', 'kode_item', 'nama_item', 'tgl_expired', 'kuantiti_berubah', 'satuan_kecil');
    var $order_stokdataverfikasi = array('waktu_update' => 'DESC');
    private function _get_query_stokdataverfikasi()
    {
        $get = $this->input->get();
        $this->db->where('verifikasi !=', '1')->from('stok_opname');
        $i = 0;
        foreach ($this->column_search_stokdataverfikasi as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_stokdataverfikasi) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_stokdataverfikasi[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_stokdataverfikasi)) {
            $order = $this->order_stokdataverfikasi;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_stokdataverfikasi_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_stokdataverfikasi();
        if ($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_stokdataverfikasi()
    {
        $this->_get_query_stokdataverfikasi();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_stokdataverfikasi()
    {
        $this->db->where('verifikasi !=', '1')->from('stok_opname');
        return $this->db->count_all_results();
    }
    //datatable stok opname verifikasi end

    //CRUD stok opname start
    public function rulesstokopname()
    {
        return [
            [
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required',
            ],
            [
                'field' => 'kuantiti_berubah',
                'label' => 'kuantiti',
                'rules' => 'required',
            ]
        ];
    }

    private function _kode_stokopname()
    {
        $jumlah = $this->db->select('*')->from('stok_opname')->get()->num_rows();
        $jml_baru = $jumlah + 1;
        $kode = sprintf("%04s", $jml_baru);
        $kode = "SO" . date('dmy') . $kode;
        $cek_ada = $this->db->select('*')->from('stok_opname')->where('nomor_ref ="' . $kode . '"')->get()->num_rows();
        if ($cek_ada > 0) {
            return $this->_kode_stokopname();
        } else {
            return $kode;
        }
    }
    function simpandatastokopname()
    {
        $post = $this->input->post();
        $array = array(
            'tanggal' => $post["tanggal"],
            'nomor_ref' => $this->_kode_stokopname(),
            'stok_sebelum' => $post["stok_sebelum"],
            'kuantiti_berubah' => $post["kuantiti_berubah"],
            'kode_item' => $post["kode_item"],
            'nama_item' => $post["nama_item"],
            'tgl_expired' => $post["tgl_expired"],
            'satuan_kecil' => $post['satuan_kecil'],
            'keterangan' => $post['keterangan'],
            'verifikasi' => '0',
        );
        $this->db->insert("stok_opname", $array);
        return TRUE;
    }
    public function hapusdatastokopname()
    {
        $post = $this->input->post();
        $this->db->set('stok', 'stok - ' . (int) $post["kuantiti"], FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        return $this->db->where('id', $post['idd'])->delete('stok_opname');
    }
    public function hapusdatastokopnamearray()
    {
        $post = $this->input->post();
        $this->db->where('id', $post['idd']);
        return $this->db->delete('stok_opname');
    }
    public function rincianstok()
    {
        $startdate = $this->input->post("startdate");
        $enddate = $this->input->post("enddate");
        $idd = $this->input->post("idd");
        $this->db->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($startdate)) . '" and "' . date('Y-m-d', strtotime($enddate)) . '"');
        $this->db->where('kode_item', $idd);
        return $this->db->order_by('tanggal', 'ASC')->get('kartu_stok');
    }
    public function namaproduk()
    {
        $idd = $this->input->post("idd");
        return $this->db->get_where('master_item', array('kode_item' => $idd));
    }
    // CRUD Stok opname end

    // datatable data item start
    var $column_search_pilihanitem = array('kode_item', 'nama_item', 'harga_jual', 'stok');
    var $column_order_pilihanitem = array('kode_item', 'nama_item', 'harga_jual', 'stok', null);
    var $order_pilihanitem = array('waktu_update' => 'DESC');
    private function _get_query_pilihanitem()
    {
        $get = $this->input->get();
        $this->db->from('master_item');
        $i = 0;
        foreach ($this->column_search_pilihanitem as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_pilihanitem) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_pilihanitem[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_pilihanitem)) {
            $order = $this->order_pilihanitem;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_pilihanitem_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_pilihanitem();
        if ($get['length'] != -1)
            $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_pilihanitem()
    {
        $this->_get_query_pilihanitem();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_pilihanitem()
    {
        $this->db->from('master_item');
        return $this->db->count_all_results();
    }
    //datatable data item end


    // datatable data kartu stok start
    var $column_search_datakartustok = array('kode_item', 'nama_item','stok');
    var $column_order_datakartustok = array(null, 'kode_item', 'nama_item','stok');
    var $order_datakartustok = array('waktu_update' => 'DESC');
    private function _get_query_datakartustok()
    {
        $get = $this->input->get();
        $this->db->from('master_item');
        $i = 0;
        foreach ($this->column_search_datakartustok as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_datakartustok) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_datakartustok[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_datakartustok)) {
            $order = $this->order_datakartustok;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    // function get_datakartustok_datatable()
    // {
    //     $get = $this->input->get();
    //     $this->_get_query_datakartustok();
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    function get_datakartustok_datatable()
    {
        $this->db->select('*');
        $this->db->from('kartu_stok');
        $this->db->join('master_item', 'kartu_stok.kode_item = master_item.kode_item');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_datakartustok()
    {
        $this->_get_query_datakartustok();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_datakartustok()
    {
        $this->db->from('master_item');
        return $this->db->count_all_results();
    }
    //datatable data item end

    // datatable stok utility start
    var $column_search_stokutility = array('nomor_ref', 'kode_item', 'ket_utility', 'stok_sebelum', 'aksi', 'jumlah', 'waktu');
    var $column_order_stokutility = array(null, 'nomor_ref', 'kode_item', 'ket_utility', 'stok_sebelum', 'aksi', 'jumlah', 'waktu');
    var $order_stokutility = array('waktu' => 'DESC');
    private function _get_query_stokutility()
    {
        $get = $this->input->get();
        $this->db->from('master_utility u');
        $i = 0;
        foreach ($this->column_search_stokutility as $item) {
            if ($get['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $get['search']['value']);
                } else {
                    $this->db->or_like($item, $get['search']['value']);
                }

                if (count($this->column_search_stokutility) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($get['order'])) {
            $this->db->order_by($this->column_order_stokutility[$get['order']['0']['column']], $get['order']['0']['dir']);
        } else if (isset($this->order_stokutility)) {
            $order = $this->order_stokutility;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_stokutility_datatable()
    {
        $get = $this->input->get();
        $this->_get_query_stokutility();
        if ($get['length'] != -1)
            $this->db->join('master_item i', 'u.kode_item=i.kode_item');
        $this->db->limit($get['length'], $get['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_datatable_stokutility()
    {
        $this->_get_query_stokutility();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_datatable_stokutility()
    {
        $this->db->from('master_utility');
        return $this->db->count_all_results();
    }
    //datatable stok utility end


    // CRUD stok adjustment start
    public function rulesstokutility()
    {
        return [
            [
                'field' => 'tgl',
                'label' => 'Tanggal',
                'rules' => 'required',
            ],
            [
                'field' => 'jumlah',
                'label' => 'Jumlah',
                'rules' => 'required',
            ]
        ];
    }

    private function _kode_stokutility()
    {
        $jumlah = $this->db->select('*')->from('master_utility')->get()->num_rows();
        $jml_baru = $jumlah + 1;
        $kode = sprintf("%04s", $jml_baru);
        $kode = "SU" . date('dmy') . $kode;
        $cek_ada = $this->db->select('*')->from('master_utility')->where('nomor_ref ="' . $kode . '"')->get()->num_rows();
        if ($cek_ada > 0) {
            return $this->_kode_stokutility();
        } else {
            return $kode;
        }
    }
    function simpandatastokutility()
    {
        $post = $this->input->post();
        $aksi = $post["aksi"];
        if ($aksi == '+') {
            $masuk = $post["jumlah"];
            $keluar = 0;
            $sisa = $post["stok_sebelum"] + $post["jumlah"];
        } else {
            $masuk = 0;
            $keluar = $post["jumlah"];
            $sisa = $post["stok_sebelum"] - $post["jumlah"];
        }
        $array = array(
            'nomor_ref' => $this->_kode_stokutility(),
            'kode_item' => $post["kode_item"],
            'ket_utility' => $post["keterangan"],
            'stok_sebelum' => $post["stok_sebelum"],
            'aksi' => $aksi,
            'jumlah' => bilanganbulat($post["jumlah"]),
        );
        $this->db->insert("master_utility", $array);
        $insert_id = $this->db->insert_id();
        // add/minus stok item
        if ($aksi == '+') {
            $this->db->set('stok', 'stok + ' . (int) bilanganbulat($post["jumlah"]), FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        } else {
            $this->db->set('stok', 'stok - ' . (int) bilanganbulat($post["jumlah"]), FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        }
        // tulis kartu stok
        $list= array(
            'id_utility'=>$insert_id,
            'kode_item'=>$post["kode_item"],
            'tanggal'=>date('Y-m-d'),
            'jenis_transaksi'=>'penjualan',
            'jumlah_masuk'=>bilanganbulat($masuk),
            'jumlah_keluar'=>bilanganbulat($keluar),
            'tgl_expired'=>date('Y-m-d'),
            'satuan_kecil'=>$post['satuan_kecil'],
            'stok_sisa'=>$sisa,
        );
        $this->db->insert("kartu_stok", $list);
        return TRUE;
    }
    public function hapusdatastokutility()
    {
        $post = $this->input->post();
        $idd = $post['idd'];
        $this->db->join('master_item i', 'u.kode_item=i.kode_item');
        $query = $this->db->get_where('master_utility u', array('id_utility' => $idd), 1);

        if ($query->row()->aksi=='+') {
            $this->db->set('stok', 'stok - ' . (int) bilanganbulat($post["kuantiti"]), FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        } else {
            $this->db->set('stok', 'stok + ' . (int) bilanganbulat($post["kuantiti"]), FALSE)->where('kode_item', $post["kode_item"])->update('master_item');
        }
        return $this->db->where('id_utility', $post['idd'])->delete('master_utility');
    }
    // CRUD stok adjustment end

}
