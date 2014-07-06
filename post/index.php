<?php

require_once("../include/db_login.php");

session_start();
if(isset($_POST['category'])) {        
	
	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form your submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['category']) ||
		!isset($_POST['section'])) {
		died('We are sorry, but there appears to be a problem with the form your submitted.');		
	}		
    
  $_SESSION['category'] = $_POST['category']; // required
  $_SESSION['section'] = $_POST['section']; // required
  $_SESSION['folder_name'] = rand(100000,999999);
  while (is_dir('uploads' . '/' . $_SESSION['folder_name'])){
    $_SESSION['folder_name'] = rand(100000,999999);
  }
  session_write_close();
  $error_message = "";

  if($_SESSION['category']==0){
    $error_message .= '<font color="red">Category is required.</font><br />';

    if($_SESSION['section']==0) $error_message .= '<font color="red">Section is required.</font><br />';
      
  }
  elseif($_SESSION['section']==0){
    $error_message .= '<font color="red">Section is required.</font><br />';
  }

  if($error_message==""){
    header("Location: /post/form/");
    exit();
  } 
  else
  {
    $error_table="";

    $error_table.='<table><tr>
                   <td style="vertical-align:top;border:none" colspan="2">';
           
    $error_table.=$error_message;
                 
    $error_table.='</td>
                   </tr></table>';
       
    $form='<tr>                   
	   <td style="vertical-align:top">
	   <label for="category">Select a Category <font color=red>*</font></label>
 	   </td>
 	   <td style="vertical-align:top">
	   <select name="category" onchange="SelectCategory(this.value)"><option value="0">Select</option><option value="1">For Sale</option><option value="2">Jobs</option><option value="3">Rentals</option><option value="4">Services</option></select>
	   </td>
	   </tr>									                   								
           <tr>                   
	   <td style="vertical-align:top" width=40%>
	   
	   <label for="section">Select a Section <font color=red>*</font></label>
	   
 	   </td>
 	   <td style="vertical-align:top">
	   <div id="jobs">
	   <select name="section"><option value="0">Select</option><option value="1">Accounting</option><option value="2">Construction</option><option value="3">Engineering</option><option value="4">Executive</option><option value="5">Healthcare</option><option value="6">Marketing</option><option value="7">Retail</option><option value="8">Sales</option><option value="9">Work at Home</option></select>
	   </div>
	   <div id="rentals">
	   <select name="section"><option value="0">Select</option><option value="1">Apartment</option><option value="2">Condo</option><option value="3">Garage</option><option value="4">House</option><option value="5">Office Space</option><option value="6">Roommates</option><option value="7">Vacation Home</option></select>
	   </div>
	   <div id="sales">
	   <select name="section"><option value="0">Select</option><option value="1">Test</option></select>
	   </div>
	   <div id="services">
	   <select name="section"><option value="0">Select</option><option value="1">Test</option></select>
	   </div>
	   </td>
	   </tr>								   			                                        		   					   					   		   			
	   <tr><td></td>
	   <td style="text-align:left">
	   <input type="submit" value="Continue">   
	   </td>
	   </tr>';    
  }
}

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
<script src="jquery.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="http://ninjaads.com/general.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="../fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
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
	//now call the ajax also focus move from 
	/*$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});*/
});
</script>

</head>

<body onload="SelectCategory(<? if(isset($_POST['category'])) echo $_POST['category']; else echo '0'; ?>)">

<!-- wrap starts here -->
<div id="wrap">

	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="../" title="">Ninja Ads</a></h1><div id="loc_text"><?php $arr=explode('.',$_SERVER['HTTP_HOST']); echo $city[$arr[0]]; ?></div><div id="loc_link"><a id="box" href="../location.php">Change Location</a></div>
		<p id="slogan">Post and Find Ads Fast. </p>	                
                <!--<form action="" id="login_form" method="post"><span id="errormsg"><span id="msgbox" style="display:none"></span></span>&nbsp;&nbsp;login&nbsp;<input type="text" id="username" name="username" style="width:100px;" />&nbsp;&nbsp;password&nbsp;<input type="password" id="password" name="password" style="width:100px" />&nbsp;&nbsp;<input type="submit" name="Submit" value="Login" />&nbsp;<a href="../../register">Register</a></form>-->
                <div  id="post_ad"><span class="slogan">It's Free!&nbsp;No Sign Up!</span><a href="../post"><img border=0 src="../images/postad.png"></a></div>
		<div  id="nav">
			<ul>
				<li class="first"><a href="../recent">Recent</a></li>
				<li><a href="../sale">For Sale</a></li>
				<li><a href="../job">Job</a></li>
				<li><a href="../rental">Rental</a></li>
				<li><a href="../service">Service</a></li>
				<li><a href="../contact">Contact</a></li>
				<li><a href="../about">About</a></li>		
			</ul>		
		</div>	
		
		<!--<div id="header-image"></div>-->
						
	<!--header ends-->					
	</div>
	
	<!-- featured starts -->	
	<!--<div id="featured" class="clear">				
				
			<a name="TemplateInfo"></a>
			
			<div class="image-block">
              <img src="images/img-featured.jpg" alt="featured"/>
         </div>			
			
			<div class="text-block">
			
				<h2><a href="index.html">Featured Post</a></h2>
			
				<p class="post-info">Posted by <a href="index.html">erwin</a> | Filed under <a href="index.html">templates</a>, <a href="index.html">internet</a></p>
				
				<p><strong>Freshpick 1.0</strong> is a free, W3C-compliant, CSS-based website template 
				by <a href="http://www.styleshout.com/">styleshout.com</a>. This work is 
				distributed under the <a rel="license" href="http://creativecommons.org/licenses/by/2.5/">
				Creative Commons Attribution 2.5  License</a>, which means that you are free to 
				use and modify it for any purpose. All I ask is that you include a link back to  
				<a href="http://www.styleshout.com/">my website</a> in your credits. For more free designs, you can visit 
				<a href="http://www.styleshout.com/">my website</a> to see 
				my other works.
				</p>
			
				<p>Good luck and I hope you find my free templates useful! <a href="index.html" class="more-link">Read More</a></p>
								
			</div>	
		
	</div>-->
        <!-- featured ends -->
	
	<!-- content -->
	<div id="content-outer" class="clear"><div id="content-wrap">
	
		<div id="content">
		
			<div id="left">			
			
				<div class="entry">
					<? if(isset($error_table)) echo $error_table; ?>
					<form name="postad" method="post" action="/post/">
                   			<table width="450px">										                 								
                   			<tr>                   
		   			<td style="vertical-align:top">
		   			<label for="category">Select a Category <font color=red>*</font></label>
 		   			</td>
 		   			<td style="vertical-align:top">
		   			<select name="category" onchange="SelectCategory(this.value)"><option value="0">Select</option><option value="1"<? if(isset($_POST['category'])){ if($_POST['category']==1) print ' SELECTED'; } ?>>For Sale</option><option value="2"<? if(isset($_POST['category'])){ if($_POST['category']==2) print ' SELECTED'; } ?>>Jobs</option><option value="3"<? if(isset($_POST['category'])){ if($_POST['category']==3) print ' SELECTED'; } ?>>Rentals</option><option value="4"<? if(isset($_POST['category'])){ if($_POST['category']==4) print ' SELECTED'; } ?>>Services</option></select>
		   			</td>
		   			</tr>									                   								
                   			<tr>                   
		   			<td style="vertical-align:top" width=45%>
					
		   			<label for="section">Select a Sub-Category <font color=red>*</font></label>
					
 		   			</td>
 		   			<td style="vertical-align:top">
					<select name="section" id="showsection"><option value="0">Select</option><option value="1">Accounting</option><option value="2">Construction</option><option value="3">Engineering</option><option value="4">Executive</option><option value="5">Healthcare</option><option value="6">Marketing</option><option value="7">Retail</option><option value="8">Sales</option><option value="9">Work at Home</option></select>
		   			</td>
		   			</tr>								   			                                        		   					   					   		   			
		   			<tr><td></td>
		   			<td style="text-align:left">
		   			<input id="submit-button" type="submit" value="Continue">   
		   			</td>
		   			</tr>
		   			</table>					
		   			</form>
				
				</div>
				
				<!--<div class="entry">
						
					<h3>Lorem Ipsum Dolor Sit Amet</h3>
					<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
					Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
					posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
					odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra 
					condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. 
					In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
					Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
					posuere nunc justo tempus leo. 				
					</p>
				
					<p><a class="more-link" href="index.html">continue reading</a></p>
				
				</div>-->
				
				<!--<div class="entry">
			
					<h3>Lorem Ipsum</h3>
					<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
					Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
					posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
					odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra 
					condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. 
					In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
					Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
					posuere nunc justo tempus leo. 				
					</p>
				
					<p><a class="more-link" href="index.html">continue reading</a></p>
			
				</div>-->
				
			</div>
		
			<div id="right">
                                <h3>Search</h3>
			
				<form id="quick-search" action="../search" method="get" >
					<p>
					<label for="qsearch">Search:</label>
					<input class="tbox" id="qsearch" type="text" name="qsearch" value="" title="Start typing and hit ENTER" />
					<input class="btn" alt="Search" type="image" name="searchsubmit" title="Search" src="../images/search.gif" />
					</p>
				</form>
							
				<div class="sidemenu">	
					<h3>Sponsors</h3>
					<ul>				
						<li><b>Coming Soon..</b></li>
							
					</ul>	
				</div>
							
				<!--<div class="sidemenu">
					<h3>Sponsors</h3>
					<ul>
						<li><a href="http://themeforest.net?ref=ealigam">ThemeForest <br /><span>Your Choice for Site Templates, Wordpress, Joomla and CMS Themes</span></a></li>
						<li><a href="http://www.4templates.com/?aff=ealigam">4templates <br /><span>Low Cost Hi-Quality Templates</span></a></li>
						<li><a href="http://store.templatemonster.com?aff=ealigam">TemplateMonster <br /><span>Delivering the Best Templates on the Net!</span></a></li>
						<li><a href="http://tinyurl.com/3cgv2m">Text Link Ads <br /><span>Monetized your website</span></a></li>
						<li><a href="http://www.fotolia.com/partner/114283">Fotolia <br /><span>Free stock images or from $1</span></a> </li>
						<li><a href="http://www.dreamhost.com/r.cgi?287326">Dreamhost <br /><span>Premium webhosting</span></a></li>
					</ul>
				</div>-->							
					
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
