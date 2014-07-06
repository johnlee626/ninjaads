<?php

require_once("include/db_login.php");

session_start();

$connection=mysql_connect($db_host,$db_username,$db_password);
if(!$connection){
  die("Could not connect to the database: <br />".mysql_error());
}

$db_select=mysql_select_db($db_database);
if(!$db_select){
  die("Could not select the database: <br />".mysql_error());
}

$check_date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-30,date("Y")));
$query="SELECT * FROM post WHERE status='Yes' AND st>='".$check_date."'";
$result=mysql_query($query);
if(!$result){
  die("Could not query the database: <br />");
}		
$rows = mysql_num_rows($result);
if ($rows!=0){
  $max = 'limit 0,10';
}
else $max='';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>Ninja Ads - Free Classified Ads</title>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Erwin Aligam - styleshout.com" />
<meta name="description" content="Ninja Ads is a classified ads website that lets people post and search ads in the shortest time" />
<meta name="keywords" content="Ninja Ads - post and search classified ads for job, rental, service, and sale" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

<script src="jquery.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="http://ninjaads.com/reset.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://ninjaads.com/FreshPick.css" />
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

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

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27150130-1']);
  _gaq.push(['_setDomainName', 'ninjaads.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>

<!-- wrap starts here -->
<div id="wrap">

	<!--header -->
	<div id="header">			
				
		<h1 id="logo-text"><a href="/" title="">Ninja Ads</a></h1><div id="loc_text"><?php $arr=explode('.',$_SERVER['HTTP_HOST']); echo $city[$arr[0]]; ?></div><div id="loc_link"><a id="box" href="location.php">Change Location</a></div>
		<p id="slogan">Post and Find Ads Fast. </p>	  
		<div style="right:20px;top:20px;position:absolute;"><a href="http://www.ninjaads.com">English</a> | <a href="http://www.ninjaads.com/ch">Chinese</a></div>
                <!--<form action="" id="login_form" method="post"><span id="errormsg"><span id="msgbox" style="display:none"></span></span>&nbsp;&nbsp;login&nbsp;<input type="text" id="username" name="username" style="width:100px;" />&nbsp;&nbsp;password&nbsp;<input type="password" id="password" name="password" style="width:100px" />&nbsp;&nbsp;<input type="submit" name="Submit" value="Login" />&nbsp;<a href="../../register">Register</a></form>-->
		<?php if(isset($_SESSION['u_name'])) {if($_SESSION['u_name']=='jlee') echo '<span style="position: absolute;margin-top: 20px;"><a href="admin/logout.php">Log Out</a></span>';} ?>
                <span id="post_ad"><span class="slogan">It's Free!&nbsp;No Sign Up!</span><a href="post"><img border=0 src="images/postad.png"></a></span>
		<div id="nav">
			<ul>
				<li class="first" id="current"><a href="recent">Recent</a></li>
				<li><a href="sale">For Sale</a></li>
				<li><a href="job">Job</a></li>
				<li><a href="rental">Rental</a></li>
				<li><a href="service">Service</a></li>
				<li><a href="contact">Contact</a></li>
				<li><a href="about">About</a></li>		
			</ul>		
		</div>	
		
		<!--<div id="header-image"></div>-->
						
	<!--header ends-->					
	</div>
		
	<!-- content -->
	<div id="content-outer" class="clear"><div id="content-wrap">
	
		<div id="content">
		
			<div id="left">			
			
				<div class="entry">
				
					<?php										 		

					$check_date=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-30,date("Y")));
					$query="SELECT * FROM post WHERE status='Yes' AND st>='".$check_date."' ORDER BY st DESC $max";
					$result=mysql_query($query);
					$total_rows = mysql_num_rows($result);
					if(!$result){
					  die("Could not query the database: <br />");
					}		
					if(mysql_num_rows($result)!=0){
					  if($row=mysql_fetch_array($result,MYSQL_ASSOC)){					    
					    $st=$row["st"];
					    $cur_st = $st;					    	
					    echo '<ul>';
					  }
					  
					  $result=mysql_query($query);
					  if(!$result){
					    die("Could not query the database: <br />");
					  }
					  $cur=0;
					  while($row=mysql_fetch_array($result,MYSQL_ASSOC))
					  {
					    $cur+=1;
					    $post_id=$row["post_id"];
					    $title=$row["title"];
					    $description=$row["description"];
					    $location=$row["location"];
					    $price=$row["price"];
					    $st=$row["st"];		
					    $category=$row["cat"];			      					      					      
					    if ($cur_st != $st){
					      $cur_st = $st;
					      echo '</ul>';					      	
					      echo '<ul>';
					    }
					    if($cur==$total_rows){
					      if($category==2){
						echo '<span class="search-results l_last"><li><a href="recentpost/?id='.$post_id.'">'.$title.'</a> ('.$location.')';
					      }
					      else echo '<span class="search-results l_last"><li><a href="recentpost/?id='.$post_id.'">'.$title.'</a> - $'.$price.' ('.$location.')';					      
					    }
					    else{
					      if($category==2){
						echo '<span class="search-results"><li><a href="recentpost/?id='.$post_id.'">'.$title.'</a> ('.$location.')';
					      }
					      else echo '<span class="search-results"><li><a href="recentpost/?id='.$post_id.'">'.$title.'</a> - $'.$price.' ('.$location.')';
					    }
					    if(isset($_SESSION['u_name'])) {if($_SESSION['u_name']=='jlee') echo '&nbsp;<a href="remove.php?id='.$post_id.'">X</a>'; else echo '';}
					    echo '</li></span>';
					  }
					  echo '</ol>';
					}				

					if($rows==0) echo '<h3 class="no_post">No post found.</h3>';
					
					mysql_close($connection);

					
					?>
				
				</div>				
				
			</div>
		
			<div id="right">
                                <h3>Search</h3>
			
				<form id="quick-search" action="search" method="get" >
					<p>
					<label for="qsearch">Search:</label>
					<input class="tbox" id="qsearch" type="text" name="qsearch" value="" title="Start typing and hit ENTER" />
					<input class="btn" alt="Search" type="image" name="searchsubmit" title="Search" src="images/search.gif" />
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
