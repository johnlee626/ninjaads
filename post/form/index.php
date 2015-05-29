<?php

define('DS', '/'); // I always use this short form in my code.
require_once("../../include/db_login.php");

session_start();

if(isset($_POST['cityAndState']) && $_POST['cityAndState']!="") {
  $_SESSION['cityAndState'] = $_POST['cityAndState'];

}


function copy_r( $path, $dest )
{
    if( is_dir($path) )
    {
        @mkdir( $dest );
        $objects = scandir($path);
        if( sizeof($objects) > 0 )
        {
            foreach( $objects as $file )
            {
                if( $file == "." || $file == ".." )
                    continue;
                // go on
                if( is_dir( $path.DS.$file ) )
                {
                    copy_r( $path.DS.$file, $dest.DS.$file );
                }
                else
                {
                    copy( $path.DS.$file, $dest.DS.$file );
                }
            }
        }
        return true;
    }
    elseif( is_file($path) )
    {
        return copy($path, $dest);
    }
    else
    {
        return false;
    }
}

function createForm()
{
  return '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5"></textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32><br><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State<br>
	   <div id="cityAndStateEle"></div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
}

function createErrorForm()
{
  $mystr='<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32 value="'.$_POST['title'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5">'.$_POST['description'].'</textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32 value="'.$_POST['location'].'"><br><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State<br>
	   <div id="cityAndStateEle">'; 
  if($_SESSION['cityAndState']!="") $mystr.=$_SESSION['cityAndState']; 
  $mystr.='</div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right" value="'.$_POST['price'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32 value="'.$_POST['email'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32 value="'.$_POST['phone'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
  return $mystr;
}

function createForm_car()
{
  return '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5"></textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32><br><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State<br>
	   <div id="cityAndStateEle"></div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="year">Year</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="year" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="make">Make</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="make" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="model">Model</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="model" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="mileage">Mileage</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="mileage" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
}

function createForm_car_error()
{
  $mystr='<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32 value="'.$_POST['title'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5">'.$_POST['description'].'</textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32 value="'.$_POST['location'].'"><br><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State<br>
	   <div id="cityAndStateEle">';
  if($_SESSION['cityAndState']!="") $mystr.=$_SESSION['cityAndState'];
  $mystr.='</div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right" value="'.$_POST['price'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="year">Year</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="year" size=32 value="'.$_POST['year'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="make">Make</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="make" size=32 value="'.$_POST['make'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="model">Model</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="model" size=32 value="'.$_POST['model'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="mileage">Mileage</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="mileage" size=32 value="'.$_POST['mileage'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32 value="'.$_POST['email'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32 value="'.$_POST['phone'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
  return $mystr;
}


function DBLogin()
{

  $connection = mysql_connect($db_host,$db_username,$db_password);

  if(!$connection)
  {   
    $error_message.=("Database Login failed! Please make sure that the DB login credentials provided are correct");
    return false;
  }
  if(!mysql_select_db($db_database, $connection))
  {
    $error_message.=('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
    return false;
  }
  if(!mysql_query("SET NAMES 'UTF8'",$connection))
  {
    $error_message.=('Error setting utf8 encoding');
    return false;
  }
  return true;
}

function SanitizeForSQL($str)
{
  if( function_exists( "mysql_real_escape_string" ) )
  {
    $ret_str = mysql_real_escape_string( $str );
  }
  else
  {
    $ret_str = addslashes( $str );
  }
    return $ret_str;
}

function Sanitize($str,$remove_nl=true)
{
  $str = $this->StripSlashes($str);

  if($remove_nl)
  {
    $injections = array('/(\n+)/i',
        '/(\r+)/i',
        '/(\t+)/i',
        '/(%0A+)/i',
        '/(%0D+)/i',
        '/(%08+)/i',
        '/(%09+)/i'
        );
    $str = preg_replace($injections,'',$str);
  }

  return $str;
}

function count_files () {
	$count = count(glob($_SERVER['DOCUMENT_ROOT'] . '/post/form/temp/' . $_SESSION['folder_name'] . '/'  . "*")) ;
	return $count;
}

session_start();
$sid = session_id();

if(isset($_SESSION['category'])) {        
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form your submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	/*if(!isset($_SESSION['category']) ||
		!isset($_SESSION['section'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}*/		
   
  $category = $_SESSION['category']; // required
  $section = $_SESSION['section']; // required
  $error_message = "";
  $confirm_message = "";
  $form = "";    
  while (is_dir('uploads' . '/' . $_SESSION['folder_name'])){
    $_SESSION['folder_name'] = rand(100000,999999);
  }

  if($category==1){
    if($section==2){
      $form = createForm_car();
    }
    else $form = createform();
      
  }
  elseif($category==2){
    $form = '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32>
	   </td>
	   </tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="type">Job Type</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5"></textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State
	   <div id="cityAndStateEle"></div>
	   </div>
	   </td>
	   </tr>	   
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
  }
  elseif($category==3){
    if($section==1 || $section==2 || $section==4 || $section==7){
      $form = '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=35>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="32" rows="5"></textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32><br><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State<br>
	   <div id="cityAndStateEle"></div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right">
	   </td>
	   </tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="bedroom">Bedroom</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>
	   </td>
	   </tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="bathroom">Bathroom</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
    }
    else $form = createform();
  }
  elseif($category==4){
    $form = createform();
  }

  if(isset($_POST['title'])) {
    if($_POST['title']=='') {
      $error_message .= '<font color="red">Title is required.</font><br />'; 
    }

    if($_POST['description']=='') {
      $error_message .= '<font color="red">Description is required.</font><br />'; 
    }    

    if($_POST['location']=='') {
      $error_message .= '<font color="red">Location is required.</font><br />';
    }    
    
    if($_POST['cityAndState']=='<font color="red">Please enter a valid 5-digit zip code.</font>') {      
      $error_message .= '<font color="red">Please enter a valid 5-digit zip code.<br />';
    }
    else if($_POST['cityAndState']=='') {
      $error_message .= '<font color="red">Please enter the city and state.<br />';
    }

    if(isset($_POST['price'])) {
      if(!is_numeric($_POST['price']) and $_POST['price']!='') {
        $error_message .= '<font color="red">Enter a number for price.</font><br />';
      }
    }

    if($_POST['email']=='') {
      $error_message .= '<font color="red">Email is required.</font><br />';      
    }    
    elseif (!eregi('^[a-zA-Z]+[a-zA-Z0-9_-]*@([a-zA-Z0-9]+){1}(\.[a-zA-Z0-9]+){1,2}', stripslashes(trim($_POST['email'])))) {
      $error_message .= '<font color="red">Please provide a valid email address.</font>';
    }

    if($error_message==""){

      // send confirmation email
      $activationKey =  mt_rand(1000,9999) . mt_rand(1000,9999) . mt_rand(1000,9999) . mt_rand(1000,9999) . mt_rand(1000,9999);
      $to = $_POST['email'];
      $subject = "Ninja Classifieds Post Activation";
      $message = "Welcome to Ninja Classifieds!<br><br>You will need to complete the Ad posting process and <a href=http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/verify.php?actKey=$activationKey>click here</a>.<br><br>If clicking the link above doesn't work, type or copy the following address into your browser:<br>http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/verify.php?actKey=$activationKey.<br><br>To remove your post, please <a href=http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/remove.php?actKey=$activationKey&email=".$_POST['email'].">click here</a>.<br><br>If clicking the link above doesn't work, type or copy the following address into your browser:<br>http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/remove.php?actKey=$activationKey&email=".$_POST['email']."<br><br>If this is an error, please ignore this email.<br><br>Regards,<br>ninjaads.com Team";
      $headers = 'From: ' . "support@ninjaads.com" . "\r\n" .
      'Reply-To: ' . $_POST['email'] . "\r\n" .
      'X-Mailer: PHP/' . phpversion() . "\r\nContent-Type: text/html";
      if(!mail($to, $subject, $message, $headers)){
        $error_message.='<font color="red">There was a problem sending the mail.</font>';
      }
      else{

        $connection = mysql_connect($db_host,$db_username,$db_password);

        if(!$connection)
        {   
          $error_message.=("Database Login failed! Please make sure that the DB login credentials provided are correct");        
        }
        if(!mysql_select_db($db_database, $connection))
        {
          $error_message.=('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');        
        }
        if(!mysql_query("SET NAMES 'UTF8'",$connection))
        {
          $error_message.=('Error setting utf8 encoding');        
        }      

        if(isset($_POST['model'])){
          $insert_query = 'insert into post(   
		email,             
                title,                
                description,
                location,
		price,
		year,
		make,
		model,
		mileage,
		phone,
                cat,
                section,
		photo,
		akey,
                st
                )
                values
                (
		"' . SanitizeForSQL($_POST['email']) . '",                
                "' . SanitizeForSQL($_POST['title']) . '",                
                "' . SanitizeForSQL($_POST['description']) . '",
		"' . SanitizeForSQL($_POST['cityAndState']) . '",                
                "' . SanitizeForSQL($_POST['price']) . '", 
		"' . SanitizeForSQL($_POST['year']) . '", 
		"' . SanitizeForSQL($_POST['make']) . '",
		"' . SanitizeForSQL($_POST['model']) . '",
		"' . SanitizeForSQL($_POST['mileage']) . '",
		"' . SanitizeForSQL($_POST['phone']) . '", 
                "' . $_SESSION['category'] . '", 
                "' . $_SESSION['section'] . '",
		"' . $_SESSION['folder_name'] . '",
		"' . $activationKey . '",
                CURDATE()           
                );';
        }
        elseif(isset($_POST['bedroom'])){
          $insert_query = 'insert into post(   
		email,             
                title,                
                description,
                location,
		price,
		bedroom,
		bathroom,		
		phone,
                cat,
                section,
		photo,
		akey,
                st
                )
                values
                (
		"' . SanitizeForSQL($_POST['email']) . '",                
                "' . SanitizeForSQL($_POST['title']) . '",                
                "' . SanitizeForSQL($_POST['description']) . '",
		"' . SanitizeForSQL($_POST['cityAndState']) . '",                
                "' . SanitizeForSQL($_POST['price']) . '", 
		"' . SanitizeForSQL($_POST['bedroom']) . '", 
		"' . SanitizeForSQL($_POST['bathroom']) . '",		
		"' . SanitizeForSQL($_POST['phone']) . '", 
                "' . $_SESSION['category'] . '", 
                "' . $_SESSION['section'] . '",
		"' . $_SESSION['folder_name'] . '",
		"' . $activationKey . '",
                CURDATE()           
                );';
        }
	elseif(isset($_POST['type'])){
          $insert_query = 'insert into post(   
		email,             
                title,                
                description,
                location,
		type,
		phone,
                cat,
                section,
		photo,
		akey,
                st
                )
                values
                (
		"' . SanitizeForSQL($_POST['email']) . '",                
                "' . SanitizeForSQL($_POST['title']) . '",                
                "' . SanitizeForSQL($_POST['description']) . '",
		"' . SanitizeForSQL($_POST['cityAndState']) . '",                
                "' . SanitizeForSQL($_POST['type']) . '",  
		"' . SanitizeForSQL($_POST['phone']) . '", 
                "' . $_SESSION['category'] . '", 
                "' . $_SESSION['section'] . '",
		"' . $_SESSION['folder_name'] . '",
		"' . $activationKey . '",
                CURDATE()           
                );';
        }
        else{
          $insert_query = 'insert into post(   
		email,             
                title,                
                description,
                location,
		price,
		phone,
                cat,
                section,
		photo,
		akey,
                st
                )
                values
                (
		"' . SanitizeForSQL($_POST['email']) . '",                
                "' . SanitizeForSQL($_POST['title']) . '",                
                "' . SanitizeForSQL($_POST['description']) . '",
		"' . SanitizeForSQL($_POST['cityAndState']) . '",                
                "' . SanitizeForSQL($_POST['price']) . '",  
		"' . SanitizeForSQL($_POST['phone']) . '", 
                "' . $_SESSION['category'] . '", 
                "' . $_SESSION['section'] . '",
		"' . $_SESSION['folder_name'] . '",
		"' . $activationKey . '",
                CURDATE()           
                );';    
        }  
      }
      if(!mysql_query($insert_query,$connection))
      {
        $error_message.="Error inserting data to the table\nquery: $insert_query";      
      }
      else{

        $confirm_message.='<table><tr>
                   <td style="vertical-align:top;border:none" colspan="2"><font color=green>Post added.</font><br>An email has been sent to '.$_POST['email'].'.<br>Please go to the email to complete the ad posting process.</td></tr></table>';    
	$form = createform();        

	// save uploaded picture files
        if (!is_dir('uploads' . '/' . $_SESSION['folder_name']) && count_files()>0) mkdir('uploads' . '/' . $_SESSION['folder_name']);  
      
        if (count_files()>0) copy_r('temp' . '/' . $_SESSION['folder_name'], 'uploads' . '/' . $_SESSION['folder_name']);

        // remove files in the temporary uploads folder
        $dir = "temp" . '/' . $_SESSION['folder_name'];	
        if (is_dir($dir)) {
          if ($dh = opendir($dir)) {		
            while (($file = readdir($dh)) !== false) {	    
              if (is_file($dir.'/'.$file)) {		
		  unlink($dir.'/' . $file);		  			
	      }
       	    }	
            closedir($dh);
          }
        }
	if (is_dir($dir)) rmdir($dir);

	// send confirmation email
	/*$to = $_POST['email'];
	$subject = "Ninja Classifieds Post Activation";
	$message = "Welcome to Ninja Classifieds!<br><br>You will need to complete the Ad posting process and <a href=http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/site/verify.php?actKey=$activationKey>click here</a>.<br><br>If clicking the link above doesn't work, type or copy the following address into your browser:<br>http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/site/verify.php?actKey=$activationKey.<br><br>To remove your post, please <a href=http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/site/remove.php?actKey=$activationKey&email=".$_POST['email'].">click here</a>.<br><br>If clicking the link above doesn't work, type or copy the following address into your browser:<br>http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME']."/site/remove.php?actKey=$activationKey&email=".$_POST['email']."<br><br>If this is an error, please ignore this email.<br><br>Regards,<br>ninjaads.com Team";
	$headers = 'From:' . $_POST['email'] . "\r\n" .
    	'Reply-To: ' . $_POST['email'] . "\r\n" .
    	'X-Mailer: PHP/' . phpversion() . "\r\nContent-Type: text/html";
	if(!mail($to, $subject, $message, $headers)){
          $error_message.='<font color="red">There was a problem sending the mail.</font>';
        }*/
      }

      if($error_message!=""){
        $error_table="";
        $error_table.='<table><tr>
                   <td style="vertical-align:top;border:none" colspan="2">';           
        $error_table.=$error_message;                 
        $error_table.='</td>
                   </tr></table>';
	$form = createErrorform();
      }      
    } 
    else
    {
      $error_table="";
      $error_table.='<table><tr>
                   <td style="vertical-align:top;border:none" colspan="2">';           
      $error_table.=$error_message;                 
      $error_table.='</td>
                   </tr></table>';      

      if($category==1){
        if($section==2){
          $form = createForm_car_error();
        }
        else $form = createErrorForm();
      }
      elseif($category==2){
        $form = '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=32 value="'.$_POST['title'].'">
	   </td>
	   </tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="type">Job Type</label>	   
 	   </td>
 	   <td style="vertical-align:top">';
         if($_POST['type']=="full"){
           $form .= '<select name="type"><option value="">Select</option><option value="full" selected>Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
         elseif($_POST['type']=="part"){
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part" selected>Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
         elseif($_POST['type']=="contract"){
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract" selected>Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
         elseif($_POST['type']=="intern"){
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern" selected>Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
         elseif($_POST['type']=="freelance"){
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance" selected>Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
         elseif($_POST['type']=="telecommute"){
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute" selected>Telecommute</option></select>';
         }
         else{
           $form .= '<select name="type"><option value="">Select</option><option value="full">Full Time</option><option value="part">Part Time</option><option value="contract">Contract</option><option value="intern">Internship</option><option value="freelance">Freelance</option><option value="telecommute">Telecommute</option></select>';
         }
	 $form .= '</td></tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="30" rows="5">'.$_POST['description'].'</textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32 value="'.$_POST['location'].'"><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State
	   <div id="cityAndStateEle">';
	 if($_SESSION['cityAndState']!="") $form.=$_SESSION['cityAndState'];
	 $form.='</div>
	   </div>
	   </td>
	   </tr>	   
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32 value="'.$_POST['email'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32 value="'.$_POST['phone'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
      }
      elseif($category==3){
        if($section==1 || $section==2 || $section==4 || $section==7){
          $form = '<tr>                   
	   <td style="vertical-align:top">
	   <label for="title">Title <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="title" size=35 value="'.$_POST['title'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="description">Description <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <textarea name="description" cols="32" rows="5">'.$_POST['description'].'</textarea>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="location">Zip Code <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text id="zipCode" name="location" size=32 value="'.$_POST['location'].'"><input id="cityAndState" name="cityAndState" value="" type="hidden">
	   City, State
	   <div id="cityAndStateEle">';
	 if($_SESSION['cityAndState']!="") $form.=$_SESSION['cityAndState'];
	 $form.='</div>
	   </div>
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="price">Price</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="price" size=10 style="text-align:right" value="'.$_POST['price'].'">
	   </td>
	   </tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="bedroom">Bedroom</label>	   
 	   </td>
 	   <td style="vertical-align:top">';

           if($_POST['bedroom']=="STUDIO"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO" selected>Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="ONE"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE" selected>1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="TWO"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO" selected>2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="THREE"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE" selected>3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="FOUR"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR" selected>4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="FIVE"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE" selected>5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bedroom']=="MORE_THAN_SIX"){
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX" selected>6+</option></select>';
           }
           else{
             $form .= '<select name="bedroom"><option value="">Select</option><option value="STUDIO">Studio</option><option value="ONE">1</option><option value="TWO">2</option><option value="THREE">3</option><option value="FOUR">4</option><option value="FIVE">5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
	   
           $form.='</td></tr>
	   <tr>
	   <td style="vertical-align:top" width=40%>	   
	   <label for="bathroom">Bathroom</label>	   
 	   </td>
 	   <td style="vertical-align:top">';

           if($_POST['bathroom']=="ONE"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE" selected>1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="ONE_HALF"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF" selected>1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="TWO"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO" selected>2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="TWO_HALF"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF" selected>2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="THREE"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE" selected>3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="THREE_HALF"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF" selected>3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="FOUR"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR" selected>4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="FOUR_HALF"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF" selected>4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="FIVE"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE" selected>5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="FIVE_HALF"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF" selected>5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
           elseif($_POST['bathroom']=="MORE_THAN_SIX"){
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX" selected>6+</option></select>';
           }
           else{
             $form .= '<select name="bathroom"><option value="">Select</option><option value="ONE">1</option><option value="ONE_HALF">1.5</option><option value="TWO">2</option><option value="TWO_HALF">2.5</option><option value="THREE">3</option><option value="THREE_HALF">3.5</option><option value="FOUR">4</option><option value="FOUR_HALF">4.5</option><option value="FIVE">5</option><option value="FIVE_HALF">5.5</option><option value="MORE_THAN_SIX">6+</option></select>';
           }
	   
	   $form.='</td></tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="email">Email <font color=red>*</font></label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="email" size=32 value="'.$_POST['email'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="phone">Phone</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input type=text name="phone" size=32 value="'.$_POST['phone'].'">
	   </td>
	   </tr>
	   <tr>                   
	   <td style="vertical-align:top" width=40%>	   
	   <label for="photo">Photo</label>	   
 	   </td>
 	   <td style="vertical-align:top">
	   <input class="multi" id="file_upload" name="file_upload" type="file" />
	   <p>(Up to 6 photos, 4 MB max each)</p><br>
	   <div id="loaddiv"></div><input id="photos" name="photos" value="" type="hidden"><div class="upload-action">
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input id="submit-button" type="submit" value="Post Ad">   
	   </td>
	   </tr>';
        }
        else $form = createErrorForm();
      }
      elseif($category==4){
        $form = createErrorForm();
      }
    }
  }
}
session_write_close();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>Ninja Ads</title>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Erwin Aligam - styleshout.com" />
<meta name="description" content="Ninja Ads is a classified ads website that lets people post and search ads in the shortest time" />
<meta name="keywords" content="Ninja Ads - post and search classified ads for job, rental, service, and sale" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

<link rel="stylesheet" type="text/css" media="screen" href="http://ninjaads.com/reset.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://ninjaads.com/FreshPick.css" />
<link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script src="jquery.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="../../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="../../fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<style>
.cancel a:hover {
	border: 0;
}

img {
	background: none;
   	border: 0;	
	padding: 0;
}
</style>

<script language="javascript">
$(document).ready(function()
{	         

	$("a#box").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
	    	$("#error").hide();
		}
	});

	$('#file_upload').uploadify({
	'uploader'  : 'uploadify/uploadify.swf',
	'script'    : 'uploadify/uploadify.php',
	'cancelImg' : 'uploadify/cancel.png',
	'folder'    : 'temp'+'/'+<?php echo $_SESSION['folder_name']; ?>,
	'sizeLimit' : 4000000,	
	'fileExt'   : '*.jpg;*.jpeg;*.tif;*.gif;*.png',
	'fileDesc'  : 'Image Files',
	'auto'      : true,
	'scriptData' : { 'PHPSESSID': '".$sid."'},
	'onComplete': function(){$('#loaddiv').fadeOut('slow').load('list_img.php?fid='+<?php echo $_SESSION['folder_name']; ?>).fadeIn("slow");}
	});	

	$('#loaddiv').fadeOut('slow').load('list_img.php?fid='+<?php echo $_SESSION['folder_name']; ?>).fadeIn("slow");

	$('a.delete').live('click', function()
	{
		if (confirm("Are you sure you want to delete this row?"))
		{
			var id = $(this).parent().attr('id');
			var data = 'id=' + id ;
			var parent = $(this).parent();

			$.ajax(
			{
			   type: "POST",
			   url: "delete_img.php",
			   data: data,
			   cache: false,
					
			   success: function()
			   {
				parent.fadeOut('slow', function() {$(this).remove();});
			   }
		 	});				
		}
	});

	$('#zipCode').focus(function() {
        	this._value = this.value;
    	});

		
	/*$('#zipCode').on(function(){$.post("zip_code.php", { zip_code:this.value }, function(data){alert("test");
				$('#cityAndStateEle').html("test");
				$('#cityAndState').val(data);alert(data);});
	});*/


	/*var data = 'zipcode=91754';
	$.ajax(
			{
			   type: "POST",
			   url: "zip_code.php",
			   data: data,
			   cache: false,
			   success: function()
			   {
				$('#cityAndState').val(data);$('#cityAndStateEle').html(data);alert(data);
			   }
					
			   
	});*/

	$('#zipCode').blur(function() {
		
        	if ( this._value != this.value ) {
			
			/*var data = 'id=' + this.value;

			var str = $.ajax(
			{
			   type: "POST",
			   url: "zip_code.php",
			   data: data,
			   cache: false,
					
			   success: function()
			   {
				parent.fadeOut('slow', function() {$(this).remove();});
			   }
		 	}).responseText;	
			$('#cityAndStateEle').html(str);*/
			$.post("zip_code.php", { zip_code:this.value }, function(data){
				$('#cityAndStateEle').html(data);
				$('#cityAndState').val(data);
			});
		}
	});
	

	/*$('#zipCode').change(function() {
		var data = 'id=' + this.value;
        	$.post("zip_code.php", { zip_code:this.value }, function(data){
			$('#cityAndStateEle').html(data);
			$('#cityAndState').val(data);
		});
    	});*/

  
        $("#errorMsg").hide();
  
        $("#login_form").submit(function()
	{
                $("#errorMsg").show();
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ajax_login.php",{ user_name:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        	{
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              		function()
			  { 
			  	 //redirect to secure page
				 document.location='secure.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Invalid login/password').addClass('messageboxerror').fadeTo(900,1);
			});		
          	}
				
        });
 		return false; //not to post the  form physically
	});
	// now call the ajax also focus move from 
	/*$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});*/
});

</script>

</head>

<body>

<!-- wrap starts here -->
<div id="wrap">

	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="../../" title="">Ninja Ads</a></h1><div id="loc_text"><?php $arr=explode('.',$_SERVER['HTTP_HOST']); echo $city[$arr[0]]; ?></div><div id="loc_link"><a id="box" href="../../location.php">Change Location</a></div>
		<p id="slogan">Post and Find Ads Fast. </p>
                <!--<form action="" id="login_form" method="post"><span id="errormsg"><span id="msgbox" style="display:none"></span></span>&nbsp;&nbsp;login&nbsp;<input type="text" id="username" name="username" style="width:100px;" />&nbsp;&nbsp;password&nbsp;<input type="password" id="password" name="password" style="width:100px" />&nbsp;&nbsp;<input type="submit" name="Submit" value="Login" />&nbsp;<a href="../../register">Register</a></form>-->
                <div  id="post_ad"><span class="slogan">It's Free!&nbsp;No Sign Up!</span><a href="../../post"><img border=0 src="../../images/postad.png"></a></div>
		<div  id="nav">
			<ul>
				<li class="first"><a href="../../recent">Recent</a></li>
				<li><a href="../../sale">For Sale</a></li>
				<li><a href="../../job">Job</a></li>
				<li><a href="../../rental">Rental</a></li>
				<li><a href="../../service">Service</a></li>
				<li><a href="../../contact">Contact</a></li>
				<li><a href="../../about">About</a></li>		
			</ul>		
		</div>	
						
	<!--header ends-->					
	</div>
	
        <!-- featured ends -->
	
	<!-- content -->
	<div id="content-outer" class="clear"><div id="content-wrap">
	
		<div id="content">
		
			<div id="left">			
			
				<div class="entry">
					<? 					
					if(isset($error_table)) {
					  echo $error_table;
					}
					if(isset($confirm_message) && $confirm_message!='') {
					  echo $confirm_message;					  
					}
					else {							                 								
                   		 	  if(isset($form)) {
					    echo '<form name="postad" method="post" action="/post/form/" enctype="multipart/form-data">';
                   			    echo '<table width="450px">';
					    echo $form;
		   			    echo '</table></form>';
					  }
					}	   			  					
					?>
				
				</div>
				
			</div>
		
			<div id="right">
                                <h3>Search</h3>
			
				<form id="quick-search" action="../../search" method="get">
					<p>
					<label for="qsearch">Search:</label>
					<input class="tbox" id="qsearch" type="text" name="qsearch" value="" title="Start typing and hit ENTER" />
					<input class="btn" alt="Search" type="image" name="searchsubmit" title="Search" src="../../images/search.gif" />
					</p>
				</form>
							
				<div class="sidemenu">	
					<h3>Sponsors</h3>
					<ul>				
						<li><b>Coming Soon..</b></li>
							
					</ul>	
				</div>
					
			</div>		
		
		</div>	
			
	<!-- content end -->	
	</div></div>
		
	<!-- footer-bottom starts -->		
	<div id="footer-bottom">
		<div class="bottom-left">
			<p>
			&copy; 2011 <strong>Ninja Ads Inc.</strong>&nbsp; &nbsp; &nbsp;
			Design by: <a href="http://www.styleshout.com/">styleshout</a> 			
			</p>
		</div>
	
		<div class="bottom-right">
			<p>			
				<a href="http://www.ninjaads.com">Home</a> |
				<a href="contact">Contact</a> |
				<a href="about">About</a>								
			</p>
		</div>
	<!-- footer-bottom ends -->		
	</div>
	
<!-- wrap ends here -->
</div>

</body>
</html>
