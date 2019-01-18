echo "<br>";
echo "<br>";
echo "<br>";
echo "Proses 1 selesai";
echo "<br>";
echo "<br>";
echo "<br>";


echo "<br>";
echo "<br>";
echo "<br>";
echo "Mulai Post ke target";
echo "<br>";
echo "<br>";
echo "<br>";
$a = http_request("http://192.168.133.66/warnadev/public/api/import_cek_target_upload_log_cek_field?id_status=2");
$a = json_decode($a, TRUE);

$count_import = 0;
if (isset($a['data'])){
  foreach ($a['data'] as $data){

   
     $url2 = 'http://192.168.133.66/warnadev/public/api/import_ngirim_data_ke_target';
     $params2 = array( 'id_mst_branch' => $data['id_mst_branch'],
      'id_mst_data_source' => $data['id_mst_data_source'],
      'id_target_mst_status' => $data['id_target_mst_status'],
      'business_code' => $data['business_code'],
      'category' => $data['category'],
      'priority' => $data['priority'],
      'no_contract' => $data['no_contract'],
      'nopol' => $data['nopol'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'hp_1' => $data['hp_1'],
      'hp_2' => $data['hp_2'],
      'provider_1' => $data['provider_1'],
      'provider_2' => $data['provider_2'],
      'job' => $data['job'], 
      'address' => $data['address'], 
      'kelurahan' => $data['kelurahan'],
      'kecamatan' => $data['kecamatan'],
      'kabupaten' => $data['kabupaten'],
      'provinsi' => $data['provinsi'],
      'id_cms_users' => $data['id_cms_users'],
      'updated_by' => $data['updated_by']);
     $chi = curl_init();
     curl_setopt($chi, CURLOPT_URL, $url2);
     curl_setopt($chi, CURLOPT_POST, 1); 
     curl_setopt($chi, CURLOPT_RETURNTRANSFER, 1); 
     curl_setopt($chi, CURLOPT_POSTFIELDS, http_build_query($params2));
     curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, 60);
     curl_setopt($chi, CURLOPT_TIMEOUT, 60); 
     $result2 = curl_exec($chi);
     $httpcode = curl_getinfo($chi, CURLINFO_HTTP_CODE);
     curl_close($chi);

     print_r($result2);
     $count_import++;
     echo "<br>";

 }
}
echo $count_import;



echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "Proses 1 selesai";
  echo "<br>";
  echo "<br>";
  echo "<br>";


  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "Mulai Post ke target";
  echo "<br>";
  echo "<br>";
  echo "<br>";
  $a = http_request("http://192.168.133.66/warnadev/public/api/import_cek_target_upload_log_cek_field?id_status=2");
  $a = json_decode($a, TRUE);

  $count_import = 0;
  if (isset($a['data'])){
    foreach ($a['data'] as $data){


     $url2 = 'http://192.168.133.66/warnadev/public/api/import_ngirim_data_ke_target';
     $params2 = array( 'id_mst_branch' => $data['id_mst_branch'],
      'id_mst_data_source' => $data['id_mst_data_source'],
      'id_target_mst_status' => $data['id_target_mst_status'],
      'business_code' => $data['business_code'],
      'category' => $data['category'],
      'priority' => $data['priority'],
      'no_contract' => $data['no_contract'],
      'nopol' => $data['nopol'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'hp_1' => $data['hp_1'],
      'hp_2' => $data['hp_2'],
      'provider_1' => $data['provider_1'],
      'provider_2' => $data['provider_2'],
      'job' => $data['job'], 
      'address' => $data['address'], 
      'kelurahan' => $data['kelurahan'],
      'kecamatan' => $data['kecamatan'],
      'kabupaten' => $data['kabupaten'],
      'provinsi' => $data['provinsi'],
      'id_cms_users' => $data['id_cms_users'],
      'updated_by' => $data['updated_by']);
     $chi = curl_init();
     curl_setopt($chi, CURLOPT_URL, $url2);
     curl_setopt($chi, CURLOPT_POST, 1); 
     curl_setopt($chi, CURLOPT_RETURNTRANSFER, 1); 
     curl_setopt($chi, CURLOPT_POSTFIELDS, http_build_query($params2));
     curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, 60);
     curl_setopt($chi, CURLOPT_TIMEOUT, 60); 
     $result2 = curl_exec($chi);
     $httpcode = curl_getinfo($chi, CURLINFO_HTTP_CODE);
     curl_close($chi);

     echo "post ke db".$result2;
     $count_import++;
     echo "<br>";

   }
 }
 echo "<h1>".$count_import."</h1>";



 $url_billing = 'http://192.168.133.66/warnadev/public/api/import_log_billing';
 $params_billing = array( 'success' => $count_import,
  'url' => $select_file['url'],
  'id_cms_users' => $select_file['id_cms_users']);
 $chi = curl_init();
 curl_setopt($chi, CURLOPT_URL, $url_billing);
 curl_setopt($chi, CURLOPT_POST, 1); 
 curl_setopt($chi, CURLOPT_RETURNTRANSFER, 1); 
 curl_setopt($chi, CURLOPT_POSTFIELDS, http_build_query($params_billing));
 curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, 60);
 curl_setopt($chi, CURLOPT_TIMEOUT, 60); 
 $result_biling = curl_exec($chi);
 curl_close($chi);

 echo "Billing = ".$result_biling;
 echo "<br>";


 $download_log = http_request("http://192.168.133.66/warnadev/public/api/import_download_log");
 $download_log = json_decode($download_log, TRUE);
 $csvFileName = 'upload_log.csv';
 $fp = fopen($csvFileName, 'w');
 if (isset($download_log['data'])){
  $header = array("id_status", "Status", "id_mst_branch", "id_mst_data_source", "id_target_mst_status", "business_code", "category", "priority", "no_contract", "nopol", "first_name", "last_name", "hp_1", "hp_2", "provider_1", "provider_2", "job", "address", "kelurahan", "kecamatan", "kabupaten", "provinsi", "id_cms_users", "updated_by");
  fputcsv($fp, $header);
  foreach ($download_log['data'] as $data){
    fputcsv($fp, $data);
  }
}
fclose($fp);

$reset_file = 'http://192.168.133.66/warnadev/public/api/import_set_files';
$params_reset = array( 'id' => 2,
  'name' => '1',
  'url' => '1',
  'description' => '1',
  'id_cms_users' => 1);
$chi = curl_init();
curl_setopt($chi, CURLOPT_URL, $reset_file);
curl_setopt($chi, CURLOPT_POST, 1); 
curl_setopt($chi, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($chi, CURLOPT_POSTFIELDS, http_build_query($params_reset));
curl_setopt($chi, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($chi, CURLOPT_TIMEOUT, 60); 
$reset = curl_exec($chi);
curl_close($chi);

echo "reset = ".$reset;
echo "<br>";

?>

<script> location.replace("upload_log.csv"); </script>

<?php
function http_request2($url)
{
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

echo "<br>";
echo "<br>";
echo "download_log";
$delete_log = http_request2("http://192.168.133.66/warnadev/public/api/import_target_upload_log");
$delete_log = json_decode($delete_log, true);

//fungsi clear data
if (isset($delete_log['data'])) {
  foreach ($delete_log['data'] as $data) {
    $ngapus_data_table_bersih = http_request2("http://192.168.133.66/warnadev/public/api/import_delete_log?id=" . $data['id']);
    $ngapus_data_table_bersih = json_decode($ngapus_data_table_bersih, true);
    echo "ngapus log".$ngapus_data_table_bersih;
  }
}


echo "<h1>".$count_import."</h1>";


?>






