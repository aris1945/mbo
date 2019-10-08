<?php

error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$timezone  = +7; //(GMT -5:00) EST (U.S. & Canada)
$date =  gmdate("H", time() + 3600*($timezone+date("I")));
$date2 = gmdate("d M Y, H:i:s", time() + 3600*($timezone+date("I")));
$tgl = date('d');
$hari = date('D');

if($hari == "Sun"){
    $response = "Hari Minggu";
    echo $response;
}elseif($date == "6"){
    $url = 'https://apps.telkomakses.co.id/hana/get_data_hana_check_flagging_masuk.php?nik=18990339';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Apache-HttpClient/UNAVAILABLE (java 1.4)');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    if($result == "n\n"){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://apps.telkomakses.co.id/hana/put_data_hana_insert_2018.php?latitude=-7.3119886&longitude=112.7280522&nik=18990339&tanggal=".$tgl."&nama=MUCHAMAD%20ARIS%20SETIAWAN&jenis_absen=masuk&imei=352383100493109&root=true&allow_mock_location=false&emulate=false&series=asus_asus_WW_X01BD_WW_X01BD",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
            ),
          ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
          if ($err) {
            $response = "cURL Error #:" . $err;
            echo $response;
          } else {
            $response = "Absen terlaksana boss!!!";
            echo $response;
          }
      }
    }
    $token_bot="722678303:AAFjSzPdraDEe_mpf29EFFeQObcLwXiY95E";
        $data['chat_id']="528007468";
        $data['text']=$date2." : ".$response;
        function kirimperintah($perintah,$token_bot,array $keterangan=null){
            $url="https://api.telegram.org/bot".$token_bot."/";
            $url.=$perintah."?";
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$keterangan);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
        kirimperintah("sendMessage",$token_bot,$data);
?>
