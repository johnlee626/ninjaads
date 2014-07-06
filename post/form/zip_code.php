<?php	

$file_handle = fopen("zip_codes.csv", "r");

while (!feof($file_handle)) {

  $line_of_text = fgets($file_handle);
  
  if($line_of_text!=''){
    $parts = explode(',', $line_of_text);

    if($parts[0]=='"'.$_POST['zip_code'].'"'){
      $city = explode(' ', trim($parts[3],'"'));
      if(count($city)==1){
        $city_str = ucfirst(strtolower($city[0]));
      }
      elseif(count($city)==2){
        $city_str = ucfirst(strtolower($city[0])).' '.ucfirst(strtolower($city[1]));
      }
      elseif(count($city)==3){
        $city_str = ucfirst(strtolower($city[0])).' '.ucfirst(strtolower($city[1])).' '.ucfirst(strtolower($city[2]));
      }      

      $res = $city_str.', '.trim($parts[4],'"');
      break;
    }
    else{
      $res = '<font color="red">Please enter a valid 5-digit zip code.</font>';
    }
  }
}

fclose($file_handle);

echo $res;

?>
