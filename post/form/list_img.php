<?php

$sid = $_REQUEST['PHPSESSID'];
session_id($sid);
session_start();

$dir = "temp" . "/" . $_REQUEST['fid'];

// Open a known directory, and proceed to read its contents

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {		
        while (($file = readdir($dh)) !== false) {	    
            if (is_file($dir.'/'.$file)) {
		$file_name=explode('.',$file);		
		echo '<div id="'.$_REQUEST['fid'].'_'.$file_name[0].'"><img src="'."http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].'/post/form/'.$dir.'/'.$file.'" width=55px height=55px>'.' <a href="#" class="delete">Remove</a></div>'.'<br>';
	    }	
        }
        closedir($dh);
    }
}
session_write_close();
?>
