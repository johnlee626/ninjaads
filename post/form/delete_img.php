<?php	

function findexts ($filename) 
{ 
	$filename = strtolower($filename) ; 
	$exts = split("[/\\.]", $filename) ; 
	$n = count($exts)-1; 
	$exts = $exts[$n]; 
	return $exts; 
}

$id_info = explode('_',$_POST['id']);
$dir = "temp".'/'.$id_info[0];

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {		
        while (($file = readdir($dh)) !== false) {	    
            if (is_file($dir.'/'.$file)) {		
		$file_name=explode('.',$file);
		if ($id_info[1] == $file_name[0]) {
		    unlink($dir.'/' . $file);
		    break;
		}			
	    }
       	}
	
    }

    if ($dh = opendir($dir)) {		
        
	// rename files in the directory
	$i=1;
	while (($file = readdir($dh)) !== false) {	    
            if (is_file($dir.'/'.$file)) {		
		rename($dir.'/'.$file,$dir.'/'.$i.'.'.findexts($file));
		$i+=1;					
	    }
       	}
	closedir($dh);
    }
}

?>
