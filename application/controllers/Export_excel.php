<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require './phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export_excel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master_model');
        $this->load->model('laporan_model');
        $this->excel = $this->master_model->manajemen_excel();
    }

    public function excel_laporan2rekap($id_perumahan = '')
    {

        $spreadsheet = new Spreadsheet();
        $datarumah['id_perumahan'] = $id_perumahan;
        $datarumah['dataperumahanseb'] = $this->master_model->getperumahanarray($datarumah['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31');
        $datarumah['dataperumahanses'] = $this->master_model->getperumahanarray($datarumah['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31');
        $datarumah['dataperumahantekseb'] = $this->master_model->getperumahanarray($datarumah['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'sudah');
        $datarumah['dataperumahantekses'] = $this->master_model->getperumahanarray($datarumah['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'sudah');
        $datarumah['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/evaluasi_land_bank_per.xlsx');
        $i = 12;

        $nama_perumahan = '';
        $no = 1;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C11', 'Sd. Tahun ' . (date('Y') - 1));
        foreach ($datarumah['dataperumahanseb'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++ . '')
                ->setCellValue('B' . $i, $perumahan)
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('E' . $i, $data['nama_penjual'])
                ->setCellValue('F' . $i, $data['kode_sertifikat'])
                ->setCellValue('G' . $i, $data['nama_surat_tanah'])
                ->setCellValue('H' . $i, $data['luas_surat'])
                ->setCellValue('I' . $i, $data['luas_ukur'])
                ->setCellValue('J' . $i, $data['id_posisi_surat'])
                ->setCellValue('K' . $i, '')
                ->setCellValue('L' . $i, $data['status_order_akta'])
                ->setCellValue('M' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('N' . $i, $data['akta_pengalihan'])
                ->setCellValue('O' . $i, $tgl_pengalihan)
                ->setCellValue('P' . $i, $data['nama_pengalihan'])
                ->setCellValue('Q' . $i, $data['status_teknik'])
                ->setCellValue('R' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . ($i - 1), 'Sd. Tahun ' . (date('Y')));
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahanses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no)
                ->setCellValue('B' . $i, $perumahan)
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('E' . $i, $data['nama_penjual'])
                ->setCellValue('F' . $i, $data['kode_sertifikat'])
                ->setCellValue('G' . $i, $data['nama_surat_tanah'])
                ->setCellValue('H' . $i, $data['luas_surat'])
                ->setCellValue('I' . $i, $data['luas_ukur'])
                ->setCellValue('J' . $i, $data['id_posisi_surat'])
                ->setCellValue('K' . $i, '')
                ->setCellValue('L' . $i, $data['status_order_akta'])
                ->setCellValue('M' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('N' . $i, $data['akta_pengalihan'])
                ->setCellValue('O' . $i, $tgl_pengalihan)
                ->setCellValue('P' . $i, $data['nama_pengalihan'])
                ->setCellValue('Q' . $i, $data['status_teknik'])
                ->setCellValue('R' . $i, $data['keterangan']);
            $i++;
            $no++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }

        $i += 10;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . ($i - 1), 'LAND BANK Sd. Tahun ' . (date('Y') - 1));
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahantekseb'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++ . '')
                ->setCellValue('B' . $i, $perumahan)
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('E' . $i, $data['nama_penjual'])
                ->setCellValue('F' . $i, $data['kode_sertifikat'])
                ->setCellValue('G' . $i, $data['nama_surat_tanah'])
                ->setCellValue('H' . $i, $data['luas_surat'])
                ->setCellValue('I' . $i, $data['luas_ukur'])
                ->setCellValue('J' . $i, $data['id_posisi_surat'])
                ->setCellValue('K' . $i, '')
                ->setCellValue('L' . $i, $data['status_order_akta'])
                ->setCellValue('M' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('N' . $i, $data['akta_pengalihan'])
                ->setCellValue('O' . $i, $tgl_pengalihan)
                ->setCellValue('P' . $i, $data['nama_pengalihan'])
                ->setCellValue('Q' . $i, $data['status_teknik'])
                ->setCellValue('R' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . ($i - 1), 'LAND BANK Sd. Tahun ' . date('Y'));
        $nama_perumahan = '';
        $no = 1;
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahantekses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++ . '')
                ->setCellValue('B' . $i, $perumahan)
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('E' . $i, $data['nama_penjual'])
                ->setCellValue('F' . $i, $data['kode_sertifikat'])
                ->setCellValue('G' . $i, $data['nama_surat_tanah'])
                ->setCellValue('H' . $i, $data['luas_surat'])
                ->setCellValue('I' . $i, $data['luas_ukur'])
                ->setCellValue('J' . $i, $data['id_posisi_surat'])
                ->setCellValue('K' . $i, '')
                ->setCellValue('L' . $i, $data['status_order_akta'])
                ->setCellValue('M' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('N' . $i, $data['akta_pengalihan'])
                ->setCellValue('O' . $i, $tgl_pengalihan)
                ->setCellValue('P' . $i, $data['nama_pengalihan'])
                ->setCellValue('Q' . $i, $data['status_teknik'])
                ->setCellValue('R' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan ' . $nama_perumahan);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Land bank.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function excel_laporan1_evaluasi_pembelian_detail($firstdate = '', $lastdate = '')
    {

        $spreadsheet = new Spreadsheet();
        $data['firstdate'] = $firstdate;
        $data['lastdate'] = $lastdate;
        $datarumah['perumahandalamijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '1')->get('master_regional')->result();
        $datarumah['perumahanluarijin'] = $this->db->order_by("id", "DESC")->where('status_regional', '2')->get('master_regional')->result();
        $datarumah['perumahanlokasi'] = $this->db->order_by("id", "DESC")->where('status_regional', '3')->get('master_regional')->result();
        $datrumah['perumahan2'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $datarumah['sertifikat_tanah'] = $this->db->order_by("id_sertifikat_tanah", "DESC")->get('tbl_sertifikat_tanah')->result();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_pembelian.xlsx');
        $i = 9;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $char = range('A', 'Z');
        $stylefont = array('font' => array('bold' => true));
        foreach ($datarumah['perumahandalamijin'] as $key => $per) {
            $dataperumahan = $this->master_model->getperumahan($per->id, $firstdate, $lastdate);
            if ($dataperumahan != null) {
                $totalbidang = 0;
                $totalluassurat = 0;
                $totalluasukur = 0;
                $totalhargasatuan = 0;
                $totalnilaimakelar = 0;
                $totalhargatotal = 0;
                $totalhargabiaya = 0;
                $totalhargam = 0;
                $totalgantirugi = 0;
                $totalpbb = 0;
                $totallain = 0;
                $totalakhirbiayalain = 0;
                $no = 1;
                $nama_perumahan = '';

                foreach ($dataperumahan as $value => $data) {
                    $totalbidang += ((int) $data->jumlah_bidang);

                    if ($data->tanggal_pengalihan != null) {
                        $tgl_pengalihan = tgl_indo($data->tanggal_pengalihan);
                    } else {
                        $tgl_pengalihan = '-';
                    }
                    if ($data->id_perumahan == '0') {
                        $perumahan = 'Tidak ada';
                    } else {
                        $perumahan = $data->nama_regional;
                    }
                    if ($data->total_harga_pengalihan == 0) {
                        $total_harga_pengalihan = 0;
                        $harga_satuan = 0;
                    } else {
                        $harga_satuan = $data->total_harga_pengalihan / $data->luas_surat;
                        $total_harga_pengalihan = $data->total_harga_pengalihan;
                    }

                    if ($data->lain == '') {
                        $data->lain = 0;
                    }if ($data->pbb == '') {
                        $data->pbb = 0;
                    }if ($data->ganti_rugi == '') {
                        $data->ganti_rugi = 0;
                    }
                    if ($data->nilai == '') {
                        $data->nilai = 0;
                    }
                    if ($data->lain == '') {
                        $data->lain = 0;
                    }if ($data->pbb == '') {
                        $data->pbb = 0;
                    }if ($data->ganti_rugi == '') {
                        $data->ganti_rugi = 0;
                    }
                    if ($data->nilai == '') {
                        $data->nilai = 0;
                    }
                    $totalbiayalain = $data->lain + $data->pbb + $data->ganti_rugi;
                    $totalharga_biaya = $total_harga_pengalihan + $data->nilai + $totalbiayalain;
                    if ($totalharga_biaya == 0) {
                        $harga_perm = 0;
                    } else {
                        $harga_perm = $totalharga_biaya / $data->luas_surat;

                    }

                    $totalluassurat += $data->luas_surat;
                    $totalluasukur += $data->luas_ukur;
                    $totalhargasatuan += $harga_satuan;
                    $totalhargatotal += $total_harga_pengalihan;
                    $totalnilaimakelar += $data->nilai;
                    $totalhargabiaya += $totalharga_biaya;
                    $totalhargam += $harga_perm;
                    $totalgantirugi += $data->ganti_rugi;
                    $totalpbb += $data->pbb;
                    $totallain += $data->lain;
                    $totalakhirbiayalain += $totalbiayalain;

                    if ($nama_perumahan != $perumahan) {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('B' . $i, $char[$key - 1])
                            ->setCellValue('C' . $i, 'PROYEK ' . $perumahan);
                        $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                        $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                        $i++;
                        $nama_perumahan = $perumahan;
                    }
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $no++ . '')
                        ->setCellValue('C' . $i, tgl_indo($data->tanggal_pembelian))
                        ->setCellValue('D' . $i, $data->nama_penjual)
                        ->setCellValue('E' . $i, $data->nama_surat_tanah)
                        ->setCellValue('F' . $i, $data->kode_sertifikat)
                        ->setCellValue('G' . $i, $data->no_gambar)
                        ->setCellValue('H' . $i, $data->jumlah_bidang)
                        ->setCellValue('I' . $i, $data->luas_surat)
                        ->setCellValue('J' . $i, $data->luas_ukur)
                        ->setCellValue('K' . $i, $data->no_pbb)
                        ->setCellValue('L' . $i, $data->luas_pbb_bangunan)
                        ->setCellValue('M' . $i, $data->njop_bangunan)
                        ->setCellValue('N' . $i, rupiah($harga_satuan))
                        ->setCellValue('O' . $i, rupiah($data->total_harga_pengalihan))
                        ->setCellValue('P' . $i, $data->nama_makelar)
                        ->setCellValue('Q' . $i, rupiah($data->nilai))
                        ->setCellValue('R' . $i, $tgl_pengalihan)
                        ->setCellValue('S' . $i, $data->akta_pengalihan)
                        ->setCellValue('T' . $i, $data->nama_pengalihan)
                        ->setCellValue('U' . $i, rupiah($data->ganti_rugi))
                        ->setCellValue('V' . $i, rupiah($data->pbb))
                        ->setCellValue('W' . $i, rupiah($data->lain))
                        ->setCellValue('X' . $i, rupiah($totalbiayalain))
                        ->setCellValue('Y' . $i, rupiah($totalharga_biaya))
                        ->setCellValue('Z' . $i, rupiah($harga_perm))
                        ->setCellValue('AA' . $i, $data->keterangan);
                    $i++;
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                }
                if ($dataperumahan != null) {
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, 'TOTAL')
                        ->setCellValue('H' . $i, " " . $totalbidang)
                        ->setCellValue('I' . $i, " " . $totalluassurat)
                        ->setCellValue('J' . $i, " " . $totalluasukur);
                    $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                    $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $i += 2;
                }
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            }
        }
        $i += 9;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        foreach ($datarumah['perumahanluarijin'] as $per) {
            $dataperumahan = $this->master_model->getperumahan($per->id, $firstdate, $lastdate);

            if ($dataperumahan != null) {
                $totalbidang = 0;
                $totalluassurat = 0;
                $totalluasukur = 0;
                $totalhargasatuan = 0;
                $totalnilaimakelar = 0;
                $totalhargatotal = 0;
                $totalhargabiaya = 0;
                $totalhargam = 0;
                $totalgantirugi = 0;
                $totalpbb = 0;
                $totallain = 0;
                $totalakhirbiayalain = 0;
                $no = 1;
                $nama_perumahan = '';
                foreach ($dataperumahan as $value => $data) {
                    $totalbidang += ((int) $data->jumlah_bidang);
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                    // exit;
                    if ($data->tanggal_pengalihan != null) {
                        $tgl_pengalihan = tgl_indo($data->tanggal_pengalihan);
                    } else {
                        $tgl_pengalihan = '-';
                    }
                    if ($data->id_perumahan == '0') {
                        $perumahan = 'Tidak ada';
                    } else {
                        $perumahan = $data->nama_regional;
                    }
                    if ($data->total_harga_pengalihan == 0) {
                        $harga_satuan = 0;
                    } else {
                        $harga_satuan = $data->total_harga_pengalihan / $data->luas_surat;
                    }

                    // if ($data->lain == '') {
                    //     $data->lain = 0;
                    // }if ($data->pbb == '') {
                    //     $data->pbb = 0;
                    // }if ($data->ganti_rugi == '') {
                    //     $data->ganti_rugi = 0;
                    // }
                    // if ($data->nilai == '') {
                    //     $data->nilai = 0;
                    // }
                    // if ($data->lain == '') {
                    //     $data->lain = 0;
                    // }if ($data->pbb == '') {
                    //     $data->pbb = 0;
                    // }if ($data->ganti_rugi == '') {
                    //     $data->ganti_rugi = 0;
                    // }
                    // if ($data->nilai == '') {
                    //     $data->nilai = 0;
                    // }
                    // $totalbiayalain = $data->lain + $data->pbb + $data->ganti_rugi;
                    // $totalharga_biaya = $data->total_harga_pengalihan + $data->nilai + $totalbiayalain;
                    // if ($totalharga_biaya == 0) {
                    //     $harga_perm = 0;
                    // } else {
                    //     $harga_perm = $totalharga_biaya / $data->luas_surat;

                    // }
                    // $totalbidang += $data->jumlah_bidang;
                    // $totalluassurat += $data->luas_surat;
                    // $totalluasukur += $data->luas_ukur;
                    // $totalhargasatuan += $harga_satuan;
                    // $totalhargatotal += $data->total_harga_pengalihan;
                    // $totalnilaimakelar += $data->nilai;
                    // $totalhargabiaya += $totalharga_biaya;
                    // $totalhargam += $harga_perm;
                    // $totalgantirugi += $data->ganti_rugi;
                    // $totalpbb += $data->pbb;
                    // $totallain += $data->lain;
                    // $totalakhirbiayalain += $totalbiayalain;
                    if ($nama_perumahan != $perumahan) {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('B' . $i, 'B')
                            ->setCellValue('C' . $i, 'PROYEK ' . $perumahan);
                        $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                        $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                        $i++;
                        $nama_perumahan = $perumahan;
                    }
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $no++ . '')
                        ->setCellValue('C' . $i, tgl_indo($data->tanggal_pembelian))
                        ->setCellValue('D' . $i, $data->nama_penjual)
                        ->setCellValue('E' . $i, $data->nama_surat_tanah)
                        ->setCellValue('F' . $i, $data->kode_sertifikat)
                        ->setCellValue('G' . $i, $data->no_gambar)
                        ->setCellValue('H' . $i, $data->jumlah_bidang)
                        ->setCellValue('I' . $i, $data->luas_surat)
                        ->setCellValue('J' . $i, $data->luas_ukur)
                        ->setCellValue('K' . $i, $data->no_pbb)
                        ->setCellValue('L' . $i, $data->luas_pbb_bangunan)
                        ->setCellValue('M' . $i, $data->njop_bangunan)
                        ->setCellValue('N' . $i, rupiah($harga_satuan))
                        ->setCellValue('O' . $i, rupiah($data->total_harga_pengalihan))
                        ->setCellValue('P' . $i, $data->nama_makelar)
                        ->setCellValue('Q' . $i, rupiah($data->nilai))
                        ->setCellValue('R' . $i, $tgl_pengalihan)
                        ->setCellValue('S' . $i, $data->akta_pengalihan)
                        ->setCellValue('T' . $i, $data->nama_pengalihan)
                    // ->setCellValue('U' . $i, rupiah($data->ganti_rugi))
                    // ->setCellValue('V' . $i, rupiah($data->pbb))
                        ->setCellValue('W' . $i, rupiah($data->lain))
                    // ->setCellValue('X' . $i, rupiah($totalbiayalain))
                    // ->setCellValue('Y' . $i, rupiah($totalharga_biaya))
                        ->setCellValue('Z' . $i, rupiah($harga_perm))
                        ->setCellValue('AA' . $i, $data->keterangan);
                    $i++;
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                }
                if ($dataperumahan != null) {
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, 'TOTAL')
                        ->setCellValue('H' . $i, " " . $totalbidang);
                    $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                    $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $i += 2;
                }
            }
        }

        $i += 9;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        foreach ($datarumah['perumahanlokasi'] as $per) {
            $dataperumahan = $this->master_model->getperumahan($per->id, $firstdate, $lastdate);

            if ($dataperumahan != null) {
                $totalbidang = 0;
                $totalluassurat = 0;
                $totalluasukur = 0;
                $totalhargasatuan = 0;
                $totalnilaimakelar = 0;
                $totalhargatotal = 0;
                $totalhargabiaya = 0;
                $totalhargam = 0;
                $totalgantirugi = 0;
                $totalpbb = 0;
                $totallain = 0;
                $totalakhirbiayalain = 0;
                $no = 1;
                $nama_perumahan = '';
                foreach ($dataperumahan as $value => $data) {
                    $totalbidang += ((int) $data->jumlah_bidang);
                    // echo "<pre>";
                    // print_r($data);
                    // echo "</pre>";
                    // exit;
                    if ($data->tanggal_pengalihan != null) {
                        $tgl_pengalihan = tgl_indo($data->tanggal_pengalihan);
                    } else {
                        $tgl_pengalihan = '-';
                    }
                    if ($data->id_perumahan == '0') {
                        $perumahan = 'Tidak ada';
                    } else {
                        $perumahan = $data->nama_regional;
                    }
                    if ($data->total_harga_pengalihan == 0) {
                        $harga_satuan = 0;
                    } else {
                        $harga_satuan = $data->total_harga_pengalihan / $data->luas_surat;
                    }

                    // if ($data->lain == '') {
                    //     $data->lain = 0;
                    // }if ($data->pbb == '') {
                    //     $data->pbb = 0;
                    // }if ($data->ganti_rugi == '') {
                    //     $data->ganti_rugi = 0;
                    // }
                    // if ($data->nilai == '') {
                    //     $data->nilai = 0;
                    // }
                    // if ($data->lain == '') {
                    //     $data->lain = 0;
                    // }if ($data->pbb == '') {
                    //     $data->pbb = 0;
                    // }if ($data->ganti_rugi == '') {
                    //     $data->ganti_rugi = 0;
                    // }
                    // if ($data->nilai == '') {
                    //     $data->nilai = 0;
                    // }
                    // $totalbiayalain = $data->lain + $data->pbb + $data->ganti_rugi;
                    // $totalharga_biaya = $data->total_harga_pengalihan + $data->nilai + $totalbiayalain;
                    // if ($totalharga_biaya == 0) {
                    //     $harga_perm = 0;
                    // } else {
                    //     $harga_perm = $totalharga_biaya / $data->luas_surat;

                    // }
                    // $totalbidang += $data->jumlah_bidang;
                    // $totalluassurat += $data->luas_surat;
                    // $totalluasukur += $data->luas_ukur;
                    // $totalhargasatuan += $harga_satuan;
                    // $totalhargatotal += $data->total_harga_pengalihan;
                    // $totalnilaimakelar += $data->nilai;
                    // $totalhargabiaya += $totalharga_biaya;
                    // $totalhargam += $harga_perm;
                    // $totalgantirugi += $data->ganti_rugi;
                    // $totalpbb += $data->pbb;
                    // $totallain += $data->lain;
                    // $totalakhirbiayalain += $totalbiayalain;
                    if ($nama_perumahan != $perumahan) {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('B' . $i, 'B')
                            ->setCellValue('C' . $i, 'PROYEK ' . $perumahan);
                        $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                        $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                        $i++;
                        $nama_perumahan = $perumahan;
                    }
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $no++ . '')
                        ->setCellValue('C' . $i, tgl_indo($data->tanggal_pembelian))
                        ->setCellValue('D' . $i, $data->nama_penjual)
                        ->setCellValue('E' . $i, $data->nama_surat_tanah)
                        ->setCellValue('F' . $i, $data->kode_sertifikat)
                        ->setCellValue('G' . $i, $data->no_gambar)
                        ->setCellValue('H' . $i, $data->jumlah_bidang)
                        ->setCellValue('I' . $i, $data->luas_surat)
                        ->setCellValue('J' . $i, $data->luas_ukur)
                        ->setCellValue('K' . $i, $data->no_pbb)
                        ->setCellValue('L' . $i, $data->luas_pbb_bangunan)
                        ->setCellValue('M' . $i, $data->njop_bangunan)
                        ->setCellValue('N' . $i, rupiah($harga_satuan))
                        ->setCellValue('O' . $i, rupiah($data->total_harga_pengalihan))
                        ->setCellValue('P' . $i, $data->nama_makelar)
                        ->setCellValue('Q' . $i, rupiah($data->nilai))
                        ->setCellValue('R' . $i, $tgl_pengalihan)
                        ->setCellValue('S' . $i, $data->akta_pengalihan)
                        ->setCellValue('T' . $i, $data->nama_pengalihan)
                    // ->setCellValue('U' . $i, rupiah($data->ganti_rugi))
                    // ->setCellValue('V' . $i, rupiah($data->pbb))
                        ->setCellValue('X' . $i, rupiah($data->lain))
                    // ->setCellValue('X' . $i, rupiah($totalbiayalain))
                    // ->setCellValue('Y' . $i, rupiah($totalharga_biaya))
                        ->setCellValue('Z' . $i, rupiah($harga_perm))
                        ->setCellValue('AA' . $i, $data->keterangan);
                    $i++;
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                }
                if ($dataperumahan != null) {
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, 'TOTAL')
                        ->setCellValue('H' . $i, " " . $totalbidang);
                    $spreadsheet->getActiveSheet()->mergeCells('C' . $i . ':D' . $i);
                    $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
                    $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                    $i += 2;
                }
            }
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan ' . $perumahan);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 4), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 10), $this->excel[0]->nama)
            ->setCellValue('AA' . ($i + 10), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 11), $this->excel[0]->posisi)
            ->setCellValue('AA' . ($i + 11), $this->excel[1]->posisi);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Pembelian Tanah.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function excel_rekap_pembelian()
    {
        $data['dalamijin'] = $this->datarekap_evaluasi_pembelian('1');
        $data['luarijin'] = $this->datarekap_evaluasi_pembelian('2');
        $data['lokasi'] = $this->datarekap_evaluasi_pembelian('3');
        $spreadsheet = new Spreadsheet();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_pembelian.xlsx');
        $i = 10;
        $char = range('A', 'Z');
        $no_char = 0;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        if($data['dalamijin'] !== null) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $i, $char[$no_char].'. Proyek Dalam Ijin');
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':C' . $i);
            $no_char++;
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $no = 1;
            foreach ($data['dalamijin'] as $item) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no++ . '')
                    ->setCellValue('C' . $i, $item['nama_regional'])
                    ->setCellValue('D' . $i, $item['bidtarget'])
                    ->setCellValue('E' . $i, $item['luastarget'])
                    ->setCellValue('F' . $i, $item['bidrealsebelum'])
                    ->setCellValue('G' . $i, $item['luasrealsebelum'])
                    ->setCellValue('H' . $i, $item['bidrealsesudah'])
                    ->setCellValue('I' . $i, $item['luasrealsesudah'])
                    ->setCellValue('J' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah']). " ")
                    ->setCellValue('K' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum']). " ")
                    ->setCellValue('L' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'] . " ")
                    ->setCellValue('M' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum'])-$item['luastarget'] . " ")
                    ->setCellValue('N' . $i, ($item['bidrealsebelum'] != 0 || $item['bidrealsesudah'] != 0 || $item['bidtarget'] != 0 || $item['luastarget'] != 0) ? number_format(((float)((($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'])/$item['luastarget'])*100), 2, '.', ''). " " : "0" )
                    ->setCellValue('O' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][0] ." ": 0 . " ")
                    ->setCellValue('P' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][0] ." ": 0 . " ")
                    ->setCellValue('Q' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][1] ." ": 0 . " ")
                    ->setCellValue('R' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][1] ." ": 0 . " ")
                    ->setCellValue('S' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][2] ." ": 0 . " ")
                    ->setCellValue('T' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][2] ." ": 0 . " ")
                    ->setCellValue('U' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][3] ." ": 0 . " ")
                    ->setCellValue('V' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][3] ." ": 0 . " ")
                    ->setCellValue('W' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][4] ." ": 0 . " ")
                    ->setCellValue('X' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][4] ." ": 0 . " ")
                    ->setCellValue('Y' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][5] ." ": 0 . " ")
                    ->setCellValue('Z' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][5] ." ": 0 . " ")
                    ->setCellValue('AA' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][6] ." ": 0 . " ")
                    ->setCellValue('AB' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][6] ." ": 0 . " ")
                    ->setCellValue('AC' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][7] ." ": 0 . " ")
                    ->setCellValue('AD' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][7] ." ": 0 . " ")
                    ->setCellValue('AE' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][8] ." ": 0 . " ")
                    ->setCellValue('AF' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][8] ." ": 0 . " ")
                    ->setCellValue('AG' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][9] ." ": 0 . " ")
                    ->setCellValue('AH' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][9] ." ": 0 . " ")
                    ->setCellValue('AI' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][10] ." ": 0 . " ")
                    ->setCellValue('AJ' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][10] ." ": 0 . " ")
                    ->setCellValue('AK' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][11] ." ": 0 . " ")
                    ->setCellValue('AL' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][11] ." ": 0 . " ");
                $i++;
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            }
        }

        if($data['luarijin'] != null) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $i, $char[$no_char].'. Proyek Luar Ijin');
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':C' . $i);
            $no_char++;
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $no = 1;
            foreach ($data['luarijin'] as $item) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no++ . '')
                    ->setCellValue('C' . $i, $item['nama_regional'])
                    ->setCellValue('D' . $i, $item['bidtarget'])
                    ->setCellValue('E' . $i, $item['luastarget'])
                    ->setCellValue('F' . $i, $item['bidrealsebelum'])
                    ->setCellValue('G' . $i, $item['luasrealsebelum'])
                    ->setCellValue('H' . $i, $item['bidrealsesudah'])
                    ->setCellValue('I' . $i, $item['luasrealsesudah'])
                    ->setCellValue('J' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah']). " ")
                    ->setCellValue('K' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum']). " ")
                    ->setCellValue('L' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'] . " ")
                    ->setCellValue('M' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum'])-$item['luastarget'] . " ")
                    ->setCellValue('N' . $i, ($item['bidrealsebelum'] != 0 || $item['bidrealsesudah'] != 0 || $item['bidtarget'] != 0 || $item['luastarget'] != 0) ? number_format(((float)((($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'])/$item['luastarget'])*100), 2, '.', ''). " " : "0" )
                    ->setCellValue('O' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][0] ." ": 0 . " ")
                    ->setCellValue('P' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][0] ." ": 0 . " ")
                    ->setCellValue('Q' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][1] ." ": 0 . " ")
                    ->setCellValue('R' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][1] ." ": 0 . " ")
                    ->setCellValue('S' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][2] ." ": 0 . " ")
                    ->setCellValue('T' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][2] ." ": 0 . " ")
                    ->setCellValue('U' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][3] ." ": 0 . " ")
                    ->setCellValue('V' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][3] ." ": 0 . " ")
                    ->setCellValue('W' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][4] ." ": 0 . " ")
                    ->setCellValue('X' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][4] ." ": 0 . " ")
                    ->setCellValue('Y' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][5] ." ": 0 . " ")
                    ->setCellValue('Z' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][5] ." ": 0 . " ")
                    ->setCellValue('AA' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][6] ." ": 0 . " ")
                    ->setCellValue('AB' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][6] ." ": 0 . " ")
                    ->setCellValue('AC' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][7] ." ": 0 . " ")
                    ->setCellValue('AD' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][7] ." ": 0 . " ")
                    ->setCellValue('AE' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][8] ." ": 0 . " ")
                    ->setCellValue('AF' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][8] ." ": 0 . " ")
                    ->setCellValue('AG' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][9] ." ": 0 . " ")
                    ->setCellValue('AH' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][9] ." ": 0 . " ")
                    ->setCellValue('AI' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][10] ." ": 0 . " ")
                    ->setCellValue('AJ' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][10] ." ": 0 . " ")
                    ->setCellValue('AK' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][11] ." ": 0 . " ")
                    ->setCellValue('AL' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][11] ." ": 0 . " ");
                $i++;
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            }
        }

        if($data['lokasi'] != null) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $i, $char[$no_char].'. Proyek Lokasi');
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':C' . $i);
            $no_char++;
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $no = 1;
            foreach ($data['lokasi'] as $item) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no++ . '')
                    ->setCellValue('C' . $i, $item['nama_regional'])
                    ->setCellValue('D' . $i, $item['bidtarget'])
                    ->setCellValue('E' . $i, $item['luastarget'])
                    ->setCellValue('F' . $i, $item['bidrealsebelum'])
                    ->setCellValue('G' . $i, $item['luasrealsebelum'])
                    ->setCellValue('H' . $i, $item['bidrealsesudah'])
                    ->setCellValue('I' . $i, $item['luasrealsesudah'])
                    ->setCellValue('J' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah']). " ")
                    ->setCellValue('K' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum']). " ")
                    ->setCellValue('L' . $i, ($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'] . " ")
                    ->setCellValue('M' . $i, ($item['luasrealsesudah']+$item['luasrealsebelum'])-$item['luastarget'] . " ")
                    ->setCellValue('N' . $i, ($item['bidrealsebelum'] != 0 || $item['bidrealsesudah'] != 0 || $item['bidtarget'] != 0 || $item['luastarget'] != 0) ? number_format(((float)((($item['bidrealsebelum']+$item['bidrealsesudah'])-$item['bidtarget'])/$item['luastarget'])*100), 2, '.', ''). " " : "0" )
                    ->setCellValue('O' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][0] ." ": 0 . " ")
                    ->setCellValue('P' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][0] ." ": 0 . " ")
                    ->setCellValue('Q' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][1] ." ": 0 . " ")
                    ->setCellValue('R' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][1] ." ": 0 . " ")
                    ->setCellValue('S' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][2] ." ": 0 . " ")
                    ->setCellValue('T' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][2] ." ": 0 . " ")
                    ->setCellValue('U' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][3] ." ": 0 . " ")
                    ->setCellValue('V' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][3] ." ": 0 . " ")
                    ->setCellValue('W' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][4] ." ": 0 . " ")
                    ->setCellValue('X' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][4] ." ": 0 . " ")
                    ->setCellValue('Y' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][5] ." ": 0 . " ")
                    ->setCellValue('Z' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][5] ." ": 0 . " ")
                    ->setCellValue('AA' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][6] ." ": 0 . " ")
                    ->setCellValue('AB' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][6] ." ": 0 . " ")
                    ->setCellValue('AC' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][7] ." ": 0 . " ")
                    ->setCellValue('AD' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][7] ." ": 0 . " ")
                    ->setCellValue('AE' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][8] ." ": 0 . " ")
                    ->setCellValue('AF' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][8] ." ": 0 . " ")
                    ->setCellValue('AG' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][9] ." ": 0 . " ")
                    ->setCellValue('AH' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][9] ." ": 0 . " ")
                    ->setCellValue('AI' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][10] ." ": 0 . " ")
                    ->setCellValue('AJ' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][10] ." ": 0 . " ")
                    ->setCellValue('AK' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['bid'][11] ." ": 0 . " ")
                    ->setCellValue('AL' . $i, ($item['datatarget']['luas']!=0)? $item['datatarget']['luas'][11] ." ": 0 . " ");
                $i++;
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            }
        }
        $spreadsheet->getActiveSheet()->setTitle('Tanah Proyek Belum SHGB ');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 3), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 9), $this->excel[0]->nama)
            ->setCellValue('N' . ($i + 9), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 10), $this->excel[0]->posisi)
            ->setCellValue('N' . ($i + 10), $this->excel[1]->posisi);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Rekap Pembelian Tanah.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
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

    public function excellaporanbelumshgb($id = '')
    {
        $spreadsheet = new Spreadsheet();

        $data['id_perumahan'] = $this->input->get('id_perumahan', true);
        $datarumah['dataperumahanseb'] = $this->master_model->getshgbperumahanarray($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31');
        $datarumah['dataperumahanses'] = $this->master_model->getshgbperumahanarray($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31');
        $datarumah['dataperumahantekseb'] = $this->master_model->getshgbperumahanarray($data['id_perumahan'], '1970-01-01', (date('Y') - 1) . '-12-31', 'selesai');
        $datarumah['dataperumahantekses'] = $this->master_model->getshgbperumahanarray($data['id_perumahan'], date('Y' . '-01-01'), date('Y') . '-12-31', 'selesai');
        $datarumah['perumahan'] = $this->db->order_by("id", "DESC")->get('master_regional')->result();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_belum_shgb_per.xlsx');
        $i = 12;

        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahanseb'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C' . ($i - 1), 'sd. TAHUN ' . (date('Y') - 1))
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;

        $nama_perumahan = '';
        $no = 1;
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahanses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C' . ($i - 1), 'sd. TAHUN ' . date('Y'))
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }

        $i += 10;

        $nama_perumahan = '';
        $no = 1;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . ($i - 1), 'LAND BANK sd. TAHUN ' . (date('Y') - 1));
        foreach ($datarumah['dataperumahantekseb'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;

        $nama_perumahan = '';
        $no = 1;
        $nama_perumahan = '';
        $no = 1;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . ($i - 1), 'LAND BANK sd. TAHUN ' . (date('Y')));
        foreach ($datarumah['dataperumahantekses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C' . ($i - 1), 'LAND BANK sd. TAHUN ' . date('Y'))
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Tanah Proyek Belum SHGB ');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Tanah Proyek Belum SHGB.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function excellaporanprosesinduk($id = '')
    {
        $spreadsheet = new Spreadsheet();

        // $data['id_perumahan'] = $this->input->get('id_perumahan',true);
        $datarumah['prosesindukseb'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31');
        $datarumah['prosesindukses'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31');
        $datarumah['terbitindukseb'] = $this->master_model->getmaster_prosesinduk($id, date('Y' . '-01-01'), date('Y') . '-12-31', 'terbit');
        $datarumah['terbitindukses'] = $this->master_model->getmaster_prosesinduk($id, '1970-01-01', (date('Y') - 1) . '-12-31', 'terbit');

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_proses_induk.xlsx');
        $i = 9;

        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['prosesindukseb'] as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $data['id_proses_induk'])
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, $data['no_surat_tanah'])
                ->setCellValue('E' . $i, $data['nama_surat_tanah'])
                ->setCellValue('F' . $i, $data['luas'])
                ->setCellValue('G' . $i, $data['luas_daftar'])
                ->setCellValue('H' . $i, $data['luas_terbit'])
                ->setCellValue('I' . $i, $data['luas_daftar'] - $data['luas_terbit'])
                ->setCellValue('K' . $i, tgl_indo($data['tanggal_daftar_sk_hak']))
                ->setCellValue('L' . $i, $data['no_daftar_sk_hak'])
                ->setCellValue('M' . $i, tgl_indo($data['tanggal_terbit_sk_hak']))
                ->setCellValue('N' . $i, $data['no_terbit_sk_hak'])
                ->setCellValue('O' . $i, tgl_indo($data['tanggal_daftar_shgb']))
                ->setCellValue('P' . $i, $data['no_daftar_shgb'])
                ->setCellValue('Q' . $i, tgl_indo($data['tanggal_terbit_shgb']))
                ->setCellValue('R' . $i, $data['no_terbit_shgb'])
                ->setCellValue('S' . $i, tgl_indo($data['masa_berlaku_shgb']))
                ->setCellValue('T' . $i, tgl_indo($data['target_penyelesaian']))
                ->setCellValue('U' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            //INSERT DETAIL PROSES INDUK
            $dataitem = $this->master_model->getprosesinduk($data['id_proses_induk']);

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, '')
                ->setCellValue('C' . $i, $data['no_gambar'])
                ->setCellValue('D' . $i, $data['no_surat_tanah'])
                ->setCellValue('E' . $i, $data['nama_surat_tanah'])
                ->setCellValue('F' . $i, $data['luas'])
                ->setCellValue('G' . $i, $data['luas_daftar'])
                ->setCellValue('H' . $i, $data['luas_terbit'])
                ->setCellValue('I' . $i, $data['luas_daftar'] - $data['luas_terbit'])
                ->setCellValue('K' . $i, tgl_indo($data['tanggal_daftar_sk_hak']))
                ->setCellValue('L' . $i, $data['no_daftar_sk_hak'])
                ->setCellValue('M' . $i, tgl_indo($data['tanggal_terbit_sk_hak']))
                ->setCellValue('N' . $i, $data['no_terbit_sk_hak'])
                ->setCellValue('O' . $i, tgl_indo($data['tanggal_daftar_shgb']))
                ->setCellValue('P' . $i, $data['no_daftar_shgb'])
                ->setCellValue('Q' . $i, tgl_indo($data['tanggal_terbit_shgb']))
                ->setCellValue('R' . $i, $data['no_terbit_shgb'])
                ->setCellValue('S' . $i, tgl_indo($data['masa_berlaku_shgb']))
                ->setCellValue('T' . $i, tgl_indo($data['target_penyelesaian']))
                ->setCellValue('U' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;

        $nama_perumahan = '';
        $no = 1;
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahanses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }

        $i += 10;

        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahantekseb'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $i += 3;

        $nama_perumahan = '';
        $no = 1;
        $nama_perumahan = '';
        $no = 1;
        foreach ($datarumah['dataperumahantekses'] as $data) {
            if ($data['tanggal_pengalihan'] != null) {
                $tgl_pengalihan = tgl_indo($data['tanggal_pengalihan']);
            } else {
                $tgl_pengalihan = '-';
            }
            if ($data['id_perumahan'] == '0') {
                $perumahan = 'Tidak ada';
            } else {
                $perumahan = $data['nama_regional'];
            }
            $nama_perumahan = $perumahan;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $perumahan)
                ->setCellValue('D' . $i, $data['no_gambar'])
                ->setCellValue('E' . $i, tgl_indo($data['tanggal_pembelian']))
                ->setCellValue('F' . $i, $data['nama_penjual'])
                ->setCellValue('G' . $i, $data['kode_sertifikat'])
                ->setCellValue('H' . $i, $data['nama_surat_tanah'])
                ->setCellValue('I' . $i, $data['luas_surat'])
                ->setCellValue('J' . $i, $data['luas_ukur'])
                ->setCellValue('K' . $i, $data['id_posisi_surat'])
                ->setCellValue('L' . $i, '')
                ->setCellValue('M' . $i, $data['status_order_akta'])
                ->setCellValue('N' . $i, $data['jenis_pengalihan_hak'])
                ->setCellValue('O' . $i, $data['akta_pengalihan'])
                ->setCellValue('P' . $i, $tgl_pengalihan)
                ->setCellValue('Q' . $i, $data['nama_pengalihan'])
                ->setCellValue('R' . $i, $data['terima_finance'])
                ->setCellValue('S' . $i, $data['keterangan']);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Laporan ' . $nama_perumahan);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Land banks.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_master_tanah()
    {
        $get = $this->input->get();
        // var_dump($get['firstdate']);exit;
        if ($get['id_perumahan'] != '') {
            $data = $this->master_model->master_tanah_all($get['id_perumahan'], $get['firstdate'], $get['lastdate']);
        } else {
            $data = $this->master_model->master_tanah_all(null, $get['firstdate'], $get['lastdate']);
        }
        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_master_tanah.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 9;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $no = 1;
        $jumlah_bidang = 0;
        $luas_surat = 0;
        $luas_ukur = 0;
        foreach ($data as $per) {
            $data_master_tanah = $this->master_model->master_tanah_all();
            if ($data_master_tanah != null) {

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no++ . '')
                    ->setCellValue('C' . $i, $per->nama_regional)
                    ->setCellValue('D' . $i, $per->kode_item)
                    ->setCellValue('E' . $i, tgl_indo($per->tanggal_pembelian))
                    ->setCellValue('F' . $i, $per->nama_penjual)
                    ->setCellValue('G' . $i, $per->nama_surat_tanah)
                    ->setCellValue('H' . $i, $per->kode_sertifikat1)
                    ->setCellValue('I' . $i, $per->no_gambar)
                    ->setCellValue('J' . $i, $per->jumlah_bidang)
                    ->setCellValue('K' . $i, $per->luas_surat)
                    ->setCellValue('L' . $i, $per->luas_ukur)
                    ->setCellValue('M' . $i, $per->no_pbb)
                    ->setCellValue('N' . $i, $per->luas_pbb_bangunan)
                    ->setCellValue('O' . $i, $per->njop_bangunan)
                    ->setCellValue('P' . $i, rupiah($per->total_harga_pengalihan / $per->luas_surat))
                    ->setCellValue('Q' . $i, rupiah($per->total_harga_pengalihan))
                    ->setCellValue('R' . $i, $per->nama_makelar)
                    ->setCellValue('S' . $i, $per->nilai)
                    ->setCellValue('T' . $i, tgl_indo($per->tanggal_pengalihan))
                    ->setCellValue('U' . $i, $per->akta_pengalihan)
                    ->setCellValue('V' . $i, $per->nama_pengalihan)
                    ->setCellValue('W' . $i, $per->lain)
                    ->setCellValue('X' . $i, $per->lain)
                    ->setCellValue('Y' . $i, rupiah($per->total_harga_pengalihan + $per->nilai + $per->lain))
                    ->setCellValue('Z' . $i, rupiah(($per->total_harga_pengalihan + $per->nilai + $totalbiayalain) / $per->luas_ukur))
                    ->setCellValue('AA' . $i, $per->keterangan);
                $i++;
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
                $jumlah_bidang += $per->jumlah_bidang;
                $luas_surat += $per->luas_surat;
                $luas_ukur += $per->luas_ukur;
            }

        }
        if ($data != null) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, 'TOTAL')
                ->setCellValue('J' . $i, " " . $jumlah_bidang)
                ->setCellValue('K' . $i, " " . $luas_surat)
                ->setCellValue('L' . $i, " " . $luas_ukur);
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':I' . $i);
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $i += 2;
        }
        $spreadsheet->getActiveSheet()->setTitle('Laporan Master Tanah');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 4), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 10), $this->excel[0]->nama)
            ->setCellValue('Z' . ($i + 10), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 11), $this->excel[0]->posisi)
            ->setCellValue('Z' . ($i + 11), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Master Tanah.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_pembayaran_master_tanah($kode_item)
    {
        $query = $this->db->select("a.id_pembayaran,a.status_bayar, a.kode_item, a.tanggal_pembayaran, a.total_bayar, a.keterangan")->from("tabel_pembayaran a")->where('a.kode_item', $kode_item)->get();
        $pembayaran = $query->result();
        // var_dump($pembayaran);exit;

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
        // echo "<pre>";
        // print_r($pembayaran);
        // echo "</pre>";
        // exit;

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_pembayaran_master_tanah.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));

        $this->db->select('a.*,b.nama_regional,c.kode_sertifikat as kode_sertifikat1,c.nama_sertifikat as nama_surat_tanah1');
        $this->db->from('master_item a');
        $this->db->join('master_regional b', 'a.id_perumahan = b.id', 'left');
        $this->db->join('tbl_sertifikat_tanah c', 'c.id_sertifikat_tanah = a.status_surat_tanah1', 'left');
        $this->db->where('kode_item', $kode_item);
        $query = $this->db->get();
        $list = $query->result();
        $list = $list[0];
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B6', $list->nama_penjual)
            ->setCellValue('C6', $list->nama_regional)
            ->setCellValue('D6', $list->tanggal_pembelian)
            ->setCellValue('E6', $list->nama_surat_tanah)
            ->setCellValue('F6', $list->kode_sertifikat1)
            ->setCellValue('G6', $list->luas_surat)
            ->setCellValue('H6', $list->luas_ukur);

        $i = 11;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        // $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('B5', $data['tanah_milik']);
        // $spreadsheet->getActiveSheet()->mergeCells('B5' . ':D5');
        // $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray($title);
        $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);
        foreach ($pembayaran as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $item->id_pembayaran)
                ->setCellValue('D' . $i, $item->tanggal_pembayaran)
                ->setCellValue('E' . $i, rupiah($item->total_bayar))
                ->setCellValue('F' . $i, ($item->status_bayar == 1) ? 'Sudah Terbayar' : 'Belum Terbayar')
                ->setCellValue('G' . $i, $item->keterangan);

            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        if ($pembayaran != null) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, 'TOTAL')
                ->setCellValue('E' . $i, $data['total_harga_pengalihan']);
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':D' . $i);
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $i += 2;
        }
        $spreadsheet->getActiveSheet()->setTitle('Laporan Pembayaran Master Tanah');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 3), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 9), $this->excel[0]->nama)
            ->setCellValue('F' . ($i + 9), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 10), $this->excel[0]->posisi)
            ->setCellValue('F' . ($i + 10), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pembayaran Master Tanah ' . $data['tanah_milik'] . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_evaluasi_rekap_proses_ijin_lokasi()
    {
        $get = $this->input->get();
        $list = $this->master_model->rekap_proses_ijin();
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
        foreach ($list as $value => $r) {
            $dataseb = $this->laporan_model->get_rekapproses_perijinan($r->id, '1970-01-01', (date('Y') - 1) . '-12-31');
            $datases = $this->laporan_model->get_rekapproses_perijinan($r->id, date('Y' . '-01-01'), date('Y') . '-12-31');
            $dataterbit = $this->laporan_model->get_rekapproses_perijinan($r->id, '1970-01-01', (date('Y')) . '-12-31', 'sudah');
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
            $data[$value] = $row;
            unset($row);
        }
        $total = array();
        $total[] = (string) $jumlahsisa;
        $total[] = (string) $luassisa;
        $total[] = (string) $jumlahbaru;
        $total[] = (string) $luasbaru;
        $total[] = (string) $jumlahtotal;
        $total[] = (string) $luastotal;
        $total[] = (string) $jumlahterbit;
        $total[] = (string) $luas;
        $total[] = (string) $luasterbit;
        $total[] = (string) $jumlahsisaterbit;
        $total[] = (string) $luassisaterbit;

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_proses_ijin_lokasi.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $no = 1;
        foreach ($data as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $item[0])
                ->setCellValue('D' . $i, $item[1])
                ->setCellValue('E' . $i, $item[2])
                ->setCellValue('F' . $i, $item[3])
                ->setCellValue('G' . $i, $item[4])
                ->setCellValue('H' . $i, $item[5])
                ->setCellValue('I' . $i, $item[6])
                ->setCellValue('J' . $i, $item[7])
                ->setCellValue('K' . $i, $item[8])
                ->setCellValue('L' . $i, $item[9])
                ->setCellValue('M' . $i, $item[10])
                ->setCellValue('N' . $i, $item[11])
                ->setCellValue('O' . $i, $item[12])
                ->setCellValue('P' . $i, $item[13]);

            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $i, 'TOTAL')
            ->setCellValue('E' . $i, $total[0])
            ->setCellValue('F' . $i, $total[1])
            ->setCellValue('G' . $i, $total[2])
            ->setCellValue('H' . $i, $total[3])
            ->setCellValue('I' . $i, $total[4])
            ->setCellValue('J' . $i, $total[5])
            ->setCellValue('K' . $i, $total[6])
            ->setCellValue('L' . $i, $total[7])
            ->setCellValue('M' . $i, $total[8])
            ->setCellValue('N' . $i, $total[9])
            ->setCellValue('O' . $i, $total[10]);
        $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':D' . $i);
        $i++;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $spreadsheet->getActiveSheet()->setTitle('Laporan Rekap Ijin Lokasi');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 4), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 10), $this->excel[0]->nama)
            ->setCellValue('G' . ($i + 10), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 11), $this->excel[0]->posisi)
            ->setCellValue('G' . ($i + 11), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Rekap Ijin Lokasi.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;

    }

    public function laporan_evaluasi_perijinan_lokasi_detail($id)
    {
        $list = $this->laporan_model->perijinan_detail($id);

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_proses_ijin_lokasi_detail.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 11;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B5', $list[0]->nama_regional);
        $spreadsheet->getActiveSheet()->mergeCells('B5' . ':D5');
        $spreadsheet->getActiveSheet()->getStyle('B5')->applyFromArray($title);
        $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);
        foreach ($list as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $item->nama_regional)
                ->setCellValue('D' . $i, $item->titik_koordinat)
                ->setCellValue('E' . $i, $item->luas_daftar)
                ->setCellValue('F' . $i, $item->luas_terbit)
                ->setCellValue('G' . $i, abs((int) $item->luas_daftar - (int) $item->luas_terbit))
                ->setCellValue('H' . $i, tgl_indo($item->daftar_online_oss))
                ->setCellValue('I' . $i, $item->tgl_daftar_pertimbangan)
                ->setCellValue('J' . $i, $item->no_berkas_pertimbangan)
                ->setCellValue('K' . $i, $item->tgl_terbit_pertimbangan)
                ->setCellValue('L' . $i, $item->nomor_sk_pertimbangan)
                ->setCellValue('M' . $i, $item->tgl_daftar_tata_ruang)
                ->setCellValue('N' . $i, $item->tgl_terbit_tata_ruang)
                ->setCellValue('O' . $i, $item->nomor_surat_tata_ruang)
                ->setCellValue('P' . $i, $item->tgl_daftar_ijin)
                ->setCellValue('Q' . $i, $item->tgl_terbit_ijin)
                ->setCellValue('R' . $i, $item->nomor_ijin)
                ->setCellValue('S' . $i, $item->masa_berlaku_ijin)
                ->setCellValue('T' . $i, $item->keterangan);

            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $spreadsheet->getActiveSheet()->setTitle('Laporan Evaluasi Proses Ijin');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 3), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 9), $this->excel[0]->nama)
            ->setCellValue('I' . ($i + 9), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 10), $this->excel[0]->posisi)
            ->setCellValue('I' . ($i + 10), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Rekap Ijin Lokasi ' . $list[0]->nama_regional . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_rincian_ijin_lokasi()
    {
        $get = $this->input->get();
        if ($get['id_perumahan'] != '') {
            $data = $this->laporan_model->dataijinlokasi($get['id_perumahan']);
        } else {
            $data = $this->laporan_model->getdataijinlokasi();
        }
        $total_luas1 = 0;
        $total_luas2 = 0;
        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rincian_ijin_lokasi.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 11;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;
        $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);
        foreach ($data as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $item->nama_regional)
                ->setCellValue('D' . $i, $item->luas_terbit)
                ->setCellValue('E' . $i, $item->nomor_ijin)
                ->setCellValue('F' . $i, $item->tgl_terbit_ijin)
                ->setCellValue('G' . $i, $item->masa_berlaku_ijin)
                ->setCellValue('H' . $i, $item->luas_terbit)
                ->setCellValue('I' . $i, '%')
                ->setCellValue('J' . $i, $item->keterangan);
            $total_luas1 += ((int) $item->luas_daftar);
            $total_luas2 += ((int) $item->luas_terbit);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        $total_luas2 = "" . $total_luas2 . "";
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $i, 'TOTAL')
            ->setCellValue('H' . $i, $total_luas2 . '');
        // ->setCellValue('H' . $i, $total_luas2);
        $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':C' . $i);
        $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $i += 2;
        $spreadsheet->getActiveSheet()->setTitle('Laporan Rincian Ijin Lokasi');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 2), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 8), $this->excel[0]->nama)
            ->setCellValue('I' . ($i + 8), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 9), $this->excel[0]->posisi)
            ->setCellValue('I' . ($i + 9), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Rincian Ijin Lokasi.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_land_bank_rekap()
    {
        $get = $this->input->get();
        if ($get['id_perumahan'] != '') {
            $data = $this->dataevaluasilandbank($get['id_perumahan']);
        } else {
            $data = $this->dataevaluasilandbank();
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_land_bank_rekap.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 11;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $number = 0;
        $char = range('A', 'Z');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D7', 'Land Bank s/d ' . (date('Y') - 1))
            ->setCellValue('G7', 'Land Bank s/d ' . (date('Y')));
        $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);
        foreach ($data as $key => $status) {
            $no = 1;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $char[$number])
                ->setCellValue('C' . $i, 'IP PROYEK - ' . $key);
            $number++;
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
            $spreadsheet->getActiveSheet()->getStyle('C' . $i)->applyFromArray($stylefont);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            foreach ($status as $item) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no++ . '')
                    ->setCellValue('C' . $i, $item[1] . '( ' . $key . ' )')
                    ->setCellValue('D' . $i, $item[2])
                    ->setCellValue('E' . $i, $item[3])
                    ->setCellValue('F' . $i, $item[4])
                    ->setCellValue('G' . $i, $item[5])
                    ->setCellValue('H' . $i, $item[6])
                    ->setCellValue('I' . $i, $item[7])
                    ->setCellValue('J' . $i, $item[8])
                    ->setCellValue('K' . $i, $item[9])
                    ->setCellValue('L' . $i, $item[10])
                    ->setCellValue('M' . $i, $item[11])
                    ->setCellValue('N' . $i, $item[12])
                    ->setCellValue('O' . $i, $item[13])
                    ->setCellValue('P' . $i, $item[14])
                    ->setCellValue('Q' . $i, $item[15])
                    ->setCellValue('R' . $i, $item[16])
                    ->setCellValue('S' . $i, $item[17])
                    ->setCellValue('T' . $i, $item[18])
                    ->setCellValue('U' . $i, $item[19])
                    ->setCellValue('V' . $i, $item[20])
                    ->setCellValue('W' . $i, $item[21]);
                $i++;
                $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            }
        }

        $spreadsheet->getActiveSheet()->setTitle('Laporan Land Bank Rekap');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 3), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Land Bank Rekap.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;

    }
    public function dataevaluasilandbank($id = null)
    {
        if ($id != null) {
            $data = $this->db->order_by("id_status_regional", "ASC")->join('master_status_regional', 'master_status_regional.id_status_regional = master_regional.status_regional')->where('id', $id)->get('master_regional')->result();
        } else {
            $data = $this->db->order_by("id_status_regional", "ASC")->join('master_status_regional', 'master_status_regional.id_status_regional = master_regional.status_regional')->get('master_regional')->result();
        }
        $data1 = array();
        $no = 1;
        if ($data != null) {
            foreach ($data as $key => $value) {
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
                $row[] = $this->security->xss_clean($list4['surat']);
                $data1[$value->nama_status][$key] = $row;
            }
        }
        return $data1;
    }

    public function laporan_evaluasi_tanah_belum_shgb()
    {
        $get = $this->input->get();
        if (!empty($get['id_perumahan'])) {
            $data['perumahan'] = $this->db->order_by("id", "DESC")->where('id', $get['id_perumahan'])->get('master_regional')->result();
        } else {
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

        $total = array();
        $total[2] = 0;
        $total[3] = 0;
        $total[4] = 0;
        $total[5] = 0;
        $total[6] = 0;
        $total[7] = 0;
        $total[8] = 0;
        $total[9] = 0;
        $total[10] = 0;
        $total[11] = 0;
        $total[12] = 0;
        $total[13] = 0;
        $total[14] = 0;
        $total[15] = 0;
        $total[16] = 0;
        $total[17] = 0;
        $total[18] = 0;
        $total[19] = 0;
        $total[20] = 0;
        $total[21] = 0;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_tanah_belum_shgb.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D7', 'Tanah Proyek Belum SHGB s/d Tahun' . (date('Y') - 1))
            ->setCellValue('G7', 'Tanah Proyek Belum SHGB s/d Tahun' . (date('Y')))
            ->setCellValue('M7', 'Proses SHGB Tahun ' . (date('Y')))
            ->setCellValue('P7', 'Sisa Tanah Proyek Belum SHGB s/d Tahun ' . (date('Y')));
        $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);
        foreach ($data2 as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, $item[1])
                ->setCellValue('D' . $i, $item[2])
                ->setCellValue('E' . $i, $item[3])
                ->setCellValue('F' . $i, $item[4])
                ->setCellValue('G' . $i, $item[5])
                ->setCellValue('H' . $i, $item[6])
                ->setCellValue('I' . $i, $item[7])
                ->setCellValue('J' . $i, $item[8])
                ->setCellValue('K' . $i, $item[9])
                ->setCellValue('L' . $i, $item[10])
                ->setCellValue('M' . $i, $item[11])
                ->setCellValue('N' . $i, $item[12])
                ->setCellValue('O' . $i, $item[13])
                ->setCellValue('P' . $i, $item[14])
                ->setCellValue('Q' . $i, $item[15])
                ->setCellValue('R' . $i, $item[16])
                ->setCellValue('S' . $i, $item[17])
                ->setCellValue('T' . $i, $item[18])
                ->setCellValue('U' . $i, $item[19])
                ->setCellValue('V' . $i, $item[20])
                ->setCellValue('W' . $i, $item[21]);
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
            $total[2] += (int) $item[2];
            $total[3] += (int) $item[3];
            $total[4] += (int) $item[4];
            $total[5] += (int) $item[5];
            $total[6] += (int) $item[6];
            $total[7] += (int) $item[7];
            $total[8] += (int) $item[8];
            $total[9] += (int) $item[9];
            $total[10] += (int) $item[10];
            $total[11] += (int) $item[11];
            $total[12] += (int) $item[12];
            $total[13] += (int) $item[13];
            $total[14] += (int) $item[14];
            $total[15] += (int) $item[15];
            $total[16] += (int) $item[16];
            $total[17] += (int) $item[17];
            $total[18] += (int) $item[18];
            $total[19] += (int) $item[19];
            $total[20] += (int) $item[20];
            $total[21] += (int) $item[21];
        }
        // echo "<pre>";
        // print_r($total);
        // echo "</pre>";
        // exit;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C' . $i, 'TOTAL')
            ->setCellValue('D' . $i, ' ' . $total[2])
            ->setCellValue('E' . $i, ' ' . $total[3])
            ->setCellValue('F' . $i, ' ' . $total[4])
            ->setCellValue('G' . $i, ' ' . $total[5])
            ->setCellValue('H' . $i, ' ' . $total[6])
            ->setCellValue('I' . $i, ' ' . $total[7])
            ->setCellValue('J' . $i, ' ' . $total[8])
            ->setCellValue('K' . $i, ' ' . $total[9])
            ->setCellValue('L' . $i, ' ' . $total[10])
            ->setCellValue('M' . $i, ' ' . $total[11])
            ->setCellValue('N' . $i, ' ' . $total[12])
            ->setCellValue('O' . $i, ' ' . $total[13])
            ->setCellValue('P' . $i, ' ' . $total[14])
            ->setCellValue('Q' . $i, ' ' . $total[15])
            ->setCellValue('R' . $i, ' ' . $total[16])
            ->setCellValue('S' . $i, ' ' . $total[17])
            ->setCellValue('T' . $i, ' ' . $total[18])
            ->setCellValue('U' . $i, ' ' . $total[19])
            ->setCellValue('V' . $i, ' ' . $total[20])
            ->setCellValue('W' . $i, ' ' . $total[21]);

        $spreadsheet->getActiveSheet()->setTitle('Laporan Tanah Belum SHGB');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 4), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Laporan Tanah Belum SHGB.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_evaluasi_proses_induk()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_proses_induk.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        // $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        // $stylefont = array('font' => array('bold' => true));
        // $title = array('font' => array('bold' => true, 'size' => 16));
        // $no = 1;
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(5, 1);

        // $spreadsheet->getActiveSheet()->setTitle('Laporan Evaluasi Proses Induk');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D6', 'SISA sd. TAHUN ' . (date("Y") - 1))
            ->setCellValue('F6', 'SISA sd. TAHUN ' . date("Y"))
            ->setCellValue('J5', 'TERBIT TAHUN ' . date("Y"))
            ->setCellValue('M5', 'SISA BELUM  TERBIT sd ' . date("Y"))
        ;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i), 'Jember, ' . tgl_indo(date("Y-m-d")));
        // $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Proses Induk.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_evaluasi_proses_penggabungan_revisi_split()
    {
        $data['perumahan'] = $this->db->get('master_regional')->result();
        $data['sertifikat_tanah'] = $this->db->get('tbl_sertifikat_tanah')->result();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_evaluasi_proses_penggabungan_revisi_split.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->getActiveSheet()->setTitle('Laporan Penggabungan Split');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 1), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Penggabungan Revisi Split.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;

    }

    public function laporan_rekap_evaluasi_sudah_shgb()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_sudah_shgb.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->getActiveSheet()->setTitle('Laporan Evaluasi SHGB');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i - 1), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Sudah SHGB.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
    public function laporan_rekap_evaluasi_sudah_shgb_per()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_sudah_shgb_per.xlsx');
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Sudah SHGB per.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_rekap_evaluasi_proses_splitsing()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_proses_splitsing.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->getActiveSheet()->setTitle('Laporan Evaluasi SHGB');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 2), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Proses Splitsing.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_rekap_evaluasi_stok_splitsing()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_stok_splitsing.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->getActiveSheet()->setTitle('Laporan Stok Splitsing');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 2), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Stok Splitsing.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_rekap_evaluasi_kavling_efektif()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_rekap_evaluasi_kavling_efektif.xlsx');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 10;
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;

        $spreadsheet->getActiveSheet()->setTitle('Laporan Kavling Efektif');
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 2), 'Jember, ' . tgl_indo(date("Y-m-d")));
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Evaluasi Kavling Efektif.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    public function laporan_pembayaran()
    {
        $get = $this->input->get();
        // echo "<pre>";
        // print_r($this->excel[0]->posisi);
        // echo "</pre>";exit;
        $this->db->select("a.*, b.*");
        $this->db->from("tabel_pembayaran a");
        $this->db->join('master_item b', 'a.kode_item = b.kode_item');
        if ($get['status'] != '') {
            $this->db->where('a.status_bayar', $get['status']);
        }

        $spreadsheet = new Spreadsheet();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/file/laporan_pembayaran_master_tanah_detail.xlsx');
        if ($get['firstdate'] != '' && $get['lastdate'] != '') {
            $tanggal = $get['firstdate'] . ' - ' . $get['lastdate'];
            if ($get['status'] != '') {
                if ($get['status'] == "1") {
                    $this->db->where('a.tanggal_realisasi BETWEEN "' . $get['firstdate'] . '" and "' . $get['lastdate'] . '"');
                }
            } else {
                $this->db->where('a.tanggal_pembayaran BETWEEN "' . $get['firstdate'] . '" and "' . $get['lastdate'] . '"');
            }
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B6', 'Periode   =   ' . $tanggal);
            $spreadsheet->getActiveSheet()->mergeCells('B6:E6');
        }
        $pembayaran = $this->db->get()->result();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', 'TAHUN ' . date("Y"));
        $i = 9;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        $stylefont = array('font' => array('bold' => true));
        $title = array('font' => array('bold' => true, 'size' => 16));
        $no = 1;
        $total_sudah_dibayar = 0;
        $total_belum_dibayar = 0;
        $total_semua = 0;
        foreach ($pembayaran as $item) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, $no++ . '')
                ->setCellValue('C' . $i, ($item->status_bayar == 1) ? $item->tanggal_realisasi : $item->tanggal_pembayaran)
                ->setCellValue('D' . $i, ($item->tanggal_realisasi) ? $item->tanggal_realisasi : "-")
                ->setCellValue('E' . $i, $item->nama_penjual)
                ->setCellValue('F' . $i, rupiah($item->total_bayar))
                ->setCellValue('G' . $i, ($item->status_bayar == 1) ? 'Sudah Terbayar' : 'Belum Terbayar')
                ->setCellValue('H' . $i, $item->keterangan);
            if ($item->status_bayar == 1) {
                $total_sudah_dibayar += $item->total_bayar;
            } else {
                $total_belum_dibayar += $item->total_bayar;
            }
            $total_semua += $item->total_bayar;
            $i++;
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i, 1);
        }
        if ($pembayaran != null) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, 'TOTAL')
                ->setCellValue('F' . $i, " " . rupiah($total_semua));
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':E' . $i);
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
            $i += 1;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, 'SUDAH BAYAR')
                ->setCellValue('F' . $i, " " . rupiah($total_sudah_dibayar));
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':E' . $i);
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
            $spreadsheet->getActiveSheet()->insertNewRowBefore($i + 1, 1);
            $i += 1;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $i, 'BELUM BAYAR')
                ->setCellValue('F' . $i, " " . rupiah($total_belum_dibayar));
            $spreadsheet->getActiveSheet()->mergeCells('B' . $i . ':E' . $i);
            $spreadsheet->getActiveSheet()->getStyle('B' . $i)->applyFromArray($stylefont);
        }
        $spreadsheet->getActiveSheet()->setTitle('Laporan Pembelian Tanah');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ($i + 3), 'Jember, ' . tgl_indo(date("Y-m-d")))
            ->setCellValue('B' . ($i + 9), $this->excel[0]->nama)
            ->setCellValue('G' . ($i + 9), $this->excel[1]->nama)
            ->setCellValue('B' . ($i + 10), $this->excel[0]->posisi)
            ->setCellValue('G' . ($i + 10), $this->excel[1]->posisi);
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Pembelian Tanah .xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        //    $writer = PHPExcel_IOFactory::createWriter($spreadshet, 'Excel2007');
        //    ob_end_clean();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
}

/* End of file  */
/* Location: ./application/controllers/ */
