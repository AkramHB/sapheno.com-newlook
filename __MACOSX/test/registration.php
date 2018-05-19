<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login and register Tabbed form</title>
  
  <link rel="stylesheet" href="assets/et-line-font-plugin/style.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/socicon/css/socicon.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
      <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/theme/js/script.js"></script>   
  <script src="assets/theme/js/slick.min.js"></script>  
  
	<style>
	   	body {
        direction: rtl;
		background: #80325b;
		margin: 0;
		padding: 0;
		font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;font-weight: light;
		font-weight: 100;
	}

.loginWrapper {
	display: block;
	position: relative;
	width: 350px;
	text-align: center;	
	margin: auto;
	right: 0;
	left: 0;
	margin-top: 60px;
	margin-bottom: 60px;
	z-index: 1000;
	transition: box-shadow 1s;
}

.logginFormFooter {
	text-align: center;
	color: #777;
	width: 100%;
	font-size: 12px;
	position: fixed;
	bottom: 10px;
}

	.logginFormFooter a       {color: #777; font-weight: 600;}
	.logginFormFooter a:hover {color: #AAA;}

* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

nav {
  z-index: 9;
  color: #FFF;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px 0;
  text-align: center;
}

.tabs {
  display: table;
  table-layout: fixed;
  width: 100%;
  -webkit-transform: translateY(5px);
  transform: translateY(5px);
}

.tabs > li {
  transition-duration: .25s;
  display: table-cell;
  list-style: none;
  text-align: center;
  padding: 20px 20px 25px 20px;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  color: #666;
  background-color: none;

}
.tabs > li:before {
  z-index: -1;
  position: absolute;
  content: "";
  width: 100%;
  height: 120%;
  color: #FFF;  
  top: 0;
  left: 0;
 	background-color: #DDD;
  -webkit-transform: translateY(100%);
  transform: translateY(100%);
  transition-duration: .25s;
  border-radius: 8px 8px 0 0;
}

.tabs > li:hover:before {
  -webkit-transform: translateY(70%);
  transform: translateY(70%);
}
.tabs > li.active {
  color: #FFF;
}
.tabs > li.active:before {
  transition-duration: .5s;
 	background-color: #444;
  -webkit-transform: translateY(0);
  transform: translateY(0);
}

.tab__content {
  background-color: white;
  position: relative;
  width: 100%;
  border-radius: 5px 5px 0px 0px;
 	background-color: #444;
-webkit-box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
-moz-box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
box-shadow: 0px 12px 34px -8px rgba(0,0,0,0.28);
 
}
.tab__content > li {
  width: 100%;
  position: absolute;
  border-radius: 5px;
  color: black;
  top: 0;
  left: 0;
  background-color: #444;
  display: none;
  list-style: none;
}
.tab__content > li .content__wrapper {
  text-align: center;
  border-radius: 5px;
  padding-top: 24px;
  background-color: #444;
}


	form input {
		border: none;
		padding: 12px;
		background: #EEE;
		font-size: 16px;
		margin: 12px 0px;
		width: 300px;
		font-weight: 100;
    	outline: none;
	}

	form input:first-child {margin-top: 8px;}
	form input:last-child {margin-top: 16px; margin-bottom: 0px;}

	form input:focus {background-color: #FFF;}
	form input:hover {background-color: #FFF;}
	form input:placeholder {color: blue;}

	form [type="submit"]:focus,
	form [type="submit"]:hover {background: teal;}

	form [type="submit"] {
		background: teal;
		color: #FFF;
		padding: 24px;
		width: 100%;
		cursor: pointer;
	}

	::-webkit-input-placeholder {color: #DDD;}
	:-moz-placeholder           {color: #DDD;}
	::-moz-placeholder          {color: #DDD;}
	:-ms-input-placeholder      {color: #DDD;}

    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #909090;
    opacity: 1; /* Firefox */
}

	</style>


  
</head>

<body>

<div class="mbr-table mbr-table_top">
            <img id="T1" style="padding-bottom: 0em;" src="assets/images/img/header.png" style="align:center; height: 100%;width: 100%;" class="img-fluid">
            </div>

  <section class="loginWrapper">
  
	<ul class="tabs">
		<li class="active" style="color: #fff">فرد</li>
		<li style="color: #fff">شريك</li>
	</ul>

	<ul class="tab__content">
    
		<li class="active">
			<div class="content__wrapper">
              <form action="test/bookingsystem/insertReg.php" method="POST">
                    <input type="text" placeholder="الاسم" name="name" required>
                    <input type="email" placeholder="البريد الالكتروني" name="email" required>
                    <input type="tel" placeholder=" رقم الجوال  - مثال 966540869636" name="mobile" pattern ="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{4}" required>
                    <input type="hidden" name="type" value="فرد">
                    <input class="formBtn" type="submit" value="سجل معنا"/>

				</form>
			</div>
		</li>
   
		<li>
			<div class="content__wrapper">
              <form action="test/bookingsystem/insertReg.php" method="POST">
              <input type="text" placeholder="اسم ممثل الرعاية الصحية" name="name" required>
              <input type="email" placeholder="البريد الالكتروني" name="email" required>
              <input type="tel" placeholder=" رقم الجوال  - مثال 966540869636" name="mobile" pattern ="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{4}" required>
              <input type="hidden" name="type" value="شريك">
              <input class="formBtn" type="submit" value="سجل معنا"/>
				</form>
			</div>
		</li>
  
	</ul>

</section>

<br><br><br><br>


<section class="mbr-section mbr-section--relative mbr-section--fixed-size" data-rv-view="2" style="background-color: #80325b;text-align:center;">
    

    <div >
        <div class="mbr-header mbr-header--inline row" style="padding-top: 0.0px; padding-bottom: 0.0px;">
            
            
            

            <div style="text-align: right; padding-right: 0px;padding-top: 0px;" class="col-sm-4">
                           

                <a >
                  <img id="T1" style="padding-top: 30px;padding-right: 70px;text-align:center;" src="assets/images/img/TimeFooter.png" class="img-fluid">
                   
                </a>
                
                 <a href="privacy.html">
                  <img  style="padding-top: 30px;padding-right: 70px;text-align:center;" src="assets/images/img/privacy.png" class="img-fluid">
                   
                </a>

                
            </div>
            
             <div style="padding-left: 0px;padding-top: 40px; vertical-align: middle; text-align:center;" class="mbr-social-icons mbr-social-icons--style-1 col-sm-4">
             
              <a title="Facebook" target="_blank" href="https://www.facebook.com/inhomed/"><img src="assets/images/img/Facebookicon.png" /></a>

              <a title="Twitter" target="_blank" href="https://twitter.com/inhomed"><img src="assets/images/img/twittericon.png" /></a>
                <a title="Instagram" target="_blank" href="https://www.instagram.com/inhomed/"><img src="assets/images/img/instagramicon.png" /></a>



            <!--<a class="mbr-social-icons__icon socicon-bg-twitter mbr-editable-button" title="Twitter" target="_blank" href="https://twitter.com/jeddahawards"><i class="socicon socicon-twitter"></i></a> 
                
            <a class="mbr-social-icons__icon socicon-bg-facebook mbr-editable-button" title="Facebook" target="_blank" href="https://www.facebook.com/jeddahawards/"><i class="socicon socicon-facebook"></i></a>
            
            <a class="mbr-social-icons__icon socicon-bg-instagram mbr-editable-button" title="Instagram" target="_blank" href="https://www.instagram.com/jeddahawards/"><i class="socicon socicon-instagram"></i></a>-->
            </div>

            <div style="text-align: right; padding-right: 0px;padding-top: 0px;vertical-align: middle;text-align:center;" class="col-sm-4">
                <a >
                    <!--<img src="assets/images/img/inhomedFooter.png">-->
                    <img id="T1" style="padding-top: 30px;padding-right: 70px;text-align:center;" src="assets/images/img/inhomedFooter.png" class="img-fluid">
                    <img id="T2" style="padding-top: 30px;padding-right: 0px;padding-left: 10px;text-align:center;" src="assets/images/img/mob/contacts.png" class="img-fluid">
                </a>

                
            </div>

            

        </div>
    </div>
</section>


    
 <section data-rv-view="15" style="background-color: #80325b;" id="timea" class="Images mbr-section mbr-section--no-padding">
      <div class="container">  
<!--<img id="T1" style="padding-bottom: 0em; " src="assets/images/img/FooterlastSize.png" class="img-fluid">-->
<img id="T2" style="padding-bottom: 0em; " src="assets/images/img/mob/footertopmobile.png" class="img-fluid">
            </div>
            
             
    </section>


<section data-rv-view="15" style="background-color: #662547;" id="timea" class="Images mbr-section mbr-section--no-padding">
      <div class="container">  
<img id="T1" style="padding-bottom: 0em; " src="assets/images/img/copyright.png" class="img-fluid">
<img id="T2" style="padding-bottom: 0em; " src="assets/images/img/mob/copyrightmobile.png" class="img-fluid">
            </div>
            
             
    </section>

	
 




</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

  

<script >

$(document).ready(function(){

// Variables
var clickedTab = $(".tabs > .active");
var tabWrapper = $(".tab__content");
var activeTab = tabWrapper.find(".active");
var activeTabHeight = activeTab.outerHeight();

// Show tab on page load
activeTab.show();

// Set height of wrapper on page load
tabWrapper.height(activeTabHeight);

$(".tabs > li").on("click", function() {
    
    // Remove class from active tab
    $(".tabs > li").removeClass("active");
    
    // Add class active to clicked tab
    $(this).addClass("active");
    
    // Update clickedTab variable
    clickedTab = $(".tabs .active");
    
    // fade out active tab
    activeTab.fadeOut(250, function() {
        
        // Remove active class all tabs
        $(".tab__content > li").removeClass("active");
        
        // Get index of clicked tab
        var clickedTabIndex = clickedTab.index();

        // Add class active to corresponding tab
        $(".tab__content > li").eq(clickedTabIndex).addClass("active");
        
        // update new active tab
        activeTab = $(".tab__content > .active");
        
        // Update variable
        activeTabHeight = activeTab.outerHeight();
        
        // Animate height of wrapper to new tab height
        tabWrapper.stop().delay(50).animate({
            height: activeTabHeight
        }, 500, function() {
            
            // Fade in active tab
            activeTab.delay(50).fadeIn(250);
            
        });
    });
});
});	  

</script>

</html>
