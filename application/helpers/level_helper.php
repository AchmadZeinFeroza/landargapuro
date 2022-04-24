<?php
function level_user($nama_controller,$nama_function,$kategori,$akses){ 
    $ci =& get_instance(); 
    return $ci->db->select("a.kategori_user")
                ->from("kategori_user_modul a")
                ->join('modul b', 'b.id = a.modul AND b.controller ="'.$nama_controller.'"')  
                ->where(array('a.kategori_user' => $kategori, 'a.akses' => $akses, 'b.nama_function' => $nama_function))->get()->num_rows(); 
} 

/* CORE by Ghilman */
if(!function_exists('xarr')) {
    function xarr($arr, $key) {
        $value = '';

        if(is_array($arr)) {
	        if(strlen($key) > 0) {
	            if(array_key_exists($key, $arr)) {
	                $value = $arr[$key];
	            }
	        }
        } else {
        	return isset($object->$key) ? $object->$key : NULL;
        }

        return $value;
    }
}

if(!function_exists('xobj')) {
    function xobj($object, $key) {
        return isset($object->$key) ? $object->$key : NULL;
    }
}

if(!function_exists('generate_random')){
    function generate_random($key = 0) {
        $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $key; $i++) {
          $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}

if(!function_exists('remove_separator')){
    function remove_separator($key ='') {
        $data = str_replace(".", "", $key);
        $data = str_replace(",", ".", $data);   
        return $data;
    }
}

if(!function_exists('thousand_separator')){
    function thousand_separator($key ='') {
        $data = number_format($key, 0, "", ".");          
        return $data;
    }
}

if(!function_exists('thousand_separator_decimal')){
    function thousand_separator_decimal($key ='') {
        $data = number_format($key, 2, ",", ".");          
        return $data;
    }
}

if(!function_exists('terbilang_format')){
    function terbilang_format($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka[$x];
        } else if ($x <20) {
            $temp = terbilang_format($x - 10). " belas";
        } else if ($x <100) {
            $temp = terbilang_format($x/10)." puluh". terbilang_format($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . terbilang_format($x - 100);
        } else if ($x <1000) {
            $temp = terbilang_format($x/100) . " ratus" . terbilang_format($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . terbilang_format($x - 1000);
        } else if ($x <1000000) {
            $temp = terbilang_format($x/1000) . " ribu" . terbilang_format($x % 1000);
        } else if ($x <1000000000) {
            $temp = terbilang_format($x/1000000) . " juta" . terbilang_format($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = terbilang_format($x/1000000000) . " milyar" . terbilang_format(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = terbilang_format($x/1000000000000) . " trilyun" . terbilang_format(fmod($x,1000000000000));
        }     
        return $temp;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($x, $style=1) {
        if($x<0) {
            $hasil = "minus ". trim(terbilang_format($x));
        } else {
            $hasil = trim(terbilang_format($x));
        }     
        switch ($style) {
            case 1:
                $hasil = strtoupper($hasil);
                break;
            case 2:
                $hasil = strtolower($hasil);
                break;
            case 3:
                $hasil = ucwords($hasil);
                break;
            default:
                $hasil = ucfirst($hasil);
                break;
        }     
        return $hasil;
    }
}