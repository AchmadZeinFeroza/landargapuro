<?php

function rupiah($angka){

    if ($angka==''||$angka==null) {

       $rupiah = 0;

   }else{

    $rupiah=number_format($angka,0,',','.');

}

return "Rp ".$rupiah;

}

function bilanganbulat($teks) { 
    if ($teks==''||$teks==null) {
        $teks=0;
    }
    $teks=preg_replace("/[^0-9]/", "", $teks);

    return $teks;

}

function tgl_indo($date) {  
    if ($date=='0000-00-00'||$date==null) {
        return ' ';
    }else{
        $BulanIndo = array("Januari", "Februari", "Maret",

            "April", "Mei", "Juni",

            "Juli", "Agustus", "September",

            "Oktober", "November", "Desember"); 

        $tahun = substr($date, 0, 4); 

        $bulan = substr($date, 5, 2);  

        $tgl   = substr($date, 8, 2);   

        $jam   = substr($date, 10);   

        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun." ".$jam;

        return($result);
    }
} 



function bulan_indo($date) {  

    $BulanIndo = array("Januari", "Februari", "Maret",

        "April", "Mei", "Juni",

        "Juli", "Agustus", "September",

        "Oktober", "November", "Desember"); 

    $bulan = $date;   

    $result = $BulanIndo[(int)$bulan-1];

    return($result);

} 



function penyebut($nilai) {

    $nilai = abs($nilai);

    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

    $temp = "";

    if ($nilai < 12) {

        $temp = " ". $huruf[$nilai];

    } else if ($nilai <20) {

        $temp = penyebut($nilai - 10). " belas";

    } else if ($nilai < 100) {

        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);

    } else if ($nilai < 200) {

        $temp = " seratus" . penyebut($nilai - 100);

    } else if ($nilai < 1000) {

        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);

    } else if ($nilai < 2000) {

        $temp = " seribu" . penyebut($nilai - 1000);

    } else if ($nilai < 1000000) {

        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);

    } else if ($nilai < 1000000000) {

        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);

    } else if ($nilai < 1000000000000) {

        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));

    } else if ($nilai < 1000000000000000) {

        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));

    }     

    return $temp;

}



function terbilang($nilai) {

    if($nilai<0) {

        $hasil = "minus ". trim(penyebut($nilai));

    } else {

        $hasil = trim(penyebut($nilai));

    }     		

    return ucfirst($hasil)." Rupiah";

}

function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null){

    $ci = get_instance();

    $cmb = "<select name='$name' class='form-control'>";

    if($order){

        $ci->db->order_by($field,$order);

    }

    $data = $ci->db->get($table)->result();

    foreach ($data as $d){

        $cmb .="<option value='".$d->$pk."'";

        $cmb .= $selected==$d->$pk?" selected='selected'":'';

        $cmb .=">".  strtoupper($d->$field)."</option>";

    }

    $cmb .="</select>";

    return $cmb;  

}



function select2_dinamis($name,$table,$field,$pk,$selected=null,$order=null){

    $ci = get_instance();

    $select2 = '<select name="'.$name.'" id="'.$name.'" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">';

    if($order){

        $ci->db->order_by($field,$order);

    }

    $data = $ci->db->get($table)->result();

    foreach ($data as $d){

     $select2 .="<option value='".$d->$pk."'";

     $select2 .= $selected==$d->$pk?" selected='selected'":'';

     $select2 .=">".  strtoupper($d->$field)."</option>";

 }

 $select2 .='</select>';

 return $select2;

}



function datalist_dinamis($name,$table,$field,$value=null){

    $ci = get_instance();

    $string = '<input value="'.$value.'" name="'.$name.'" list="'.$name.'" class="form-control">

    <datalist id="'.$name.'">';

    $data = $ci->db->get($table)->result();

    foreach ($data as $row){

        $string.='<option value="'.$row->$field.'">';

    }

    $string .='</datalist>';

    return $string;

}

function get_field_db($name,$id,$table,$field){

    $ci = get_instance();

    $ci->db->where($name,$id);
    $data = $ci->db->get($table)->result();
    $string ='';
    foreach ($data as $row){
        $string=$row->$field;

    }

    return $string;

}



function rename_string_status($string,$link,$id){

    if ($string=='1') {

        return anchor(site_url(''.$link.'/update_status/'.$id.''),'Aktif', 'class="btn btn-success"');

    }else{

        return anchor(site_url(''.$link.'/update_status/'.$id.''),'Non Aktif', 'class="btn btn-danger"');

    }

}

function rename_string_status_button($string){

    if ($string=='1') {

        return '<button class="btn btn-success"> Aktif</button>';

    }else{

        return '<button class="btn btn-danger"> Non Aktif</button>';

    }

}



function link_gambar_deposit($string)

{

    $gambar = '<img  src="'.base_url().'file_upload/deposit/'.$string.'" style="height:50px">';

    return '<a href="'.base_url().'file_upload/deposit/'.$string.'"> '.$gambar.'

    </a>';

}

function link_gambar_produk($id,$string,$class='')
{
    if ($class=='') {
        $class='class="img-fluid"';
    }
    $gambar = '<img '.$class.' src="'.base_url().'file_upload/foto_item/'.$string.'" >';

    return '<a href="'.base_url().'Penjualanv2/produk_detail/'.$id.'"> '.$gambar.'</a>';

}

function gambar_produk($id,$string,$class='')
{
    if ($class=='') {
        $class='class="img-fluid"';
    }
    $gambar = '<img '.$class.' src="'.base_url().'file_upload/foto_item/'.$string.'" style="width:500px;height:500px;">';

    return $gambar;

}



function link_gambar($string,$link)

{

    $gambar = '<img src="'.base_url().'file_upload/'.$link.'/'.$string.'" style="height:50px">';

    return '<a href="'.base_url().'file_upload/'.$link.'/'.$string.'"> '.$gambar.'

    </a>';

}

function button_crud($id,$string,$set=null){



    $tombolread = '<li><a href="'.base_url().$string.'/read/'.$id.'">Detail</a></li>';

    $tombolhapus = '<li><a href="'.base_url().$string.'/delete/'.$id.'" onclick="return confirm(\'Yakin Hapus Data?\')">Hapus</a></li>';

    $tomboledit = '<li><a href="'.base_url().$string.'/update/'.$id.'" )>Edit</a></li>';

    if ($set=='del') {
        $tombolhapus = '';
    }
    if ($set=='update') {
        $tomboledit = '';
    }
    $string ='<div class="btn-group dropup">

    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>

    <ul class="dropdown-menu" role="menu">

    ' . $tombolread . '

    ' . $tomboledit . '

    ' . $tombolhapus . '

    </ul>

    </div>

    ';

    return $string;

}

function button_crud_item($id,$string){



    $tombolread = '<li><a href="'.base_url().$string.'/read/'.$id.'">Detail</a></li>';

    $tombolhapus = '<li><a href="'.base_url().$string.'/delete/'.$id.'" onclick="return confirm(\'Yakin Hapus Data?\')">Hapus</a></li>';

    $tomboledit = '<li><a href="'.base_url().$string.'/update/'.$id.'" )>Edit</a></li>';
    $tombolvar = '<li><a href="'.base_url().$string.'/variasi/'.$id.'" )>Variasi</a></li>';

    $string ='<div class="btn-group dropup">

    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>

    <ul class="dropdown-menu" role="menu">

    ' . $tombolread . '
    ' . $tombolvar . '

    ' . $tomboledit . '

    ' . $tombolhapus . '

    </ul>

    </div>

    ';

    return $string;

}

function button_link($id,$link,$teks){
    $tombol = '<a href="'.base_url().$link.''.$id.'" class="btn btn-primary">'.$teks.'</a>';
    return $tombol;
}





function alert($class,$title,$description){

    return '<div class="alert '.$class.' alert-dismissible">

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

    <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>

    '.$description.'

    </div>';

}



// untuk chek akses level pada modul peberian akses

function checked_akses($id_user_level,$id_menu){

    $ci = get_instance();

    $ci->db->where('id_user_level',$id_user_level);

    $ci->db->where('id_menu',$id_menu);

    $data = $ci->db->get('tbl_hak_akses');

    if($data->num_rows()>0){

        return "checked='checked'";

    }

}





function autocomplate_json($table,$field){

    $ci = get_instance();

    $ci->db->like($field, $_GET['term']);

    $ci->db->select($field);

    $collections = $ci->db->get($table)->result();

    foreach ($collections as $collection) {

        $return_arr[] = $collection->$field;

    }

    echo json_encode($return_arr);

}

function set_video($link)
{
 return anchor(site_url('Auth/play_video/'.$link.''),'Play', 'class="btn btn-success" target="_blank"');
}

function garr($data, $value) {
    if(is_array($data)) {
        if(array_key_exists($value, $data)) {
            return $data[$value];
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function gobj($object, $key) {
    return isset($object->$key) ? $object->$key : NULL;
}
