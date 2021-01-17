<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
}
}
?><!DOCTYPE html>
<html>
<head>
    <title>2M | sympcheck</title>
    <link rel="stylesheet" type="text/css" href="assets/css/Header.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	<meta charset="utf-8"/>
    <style type="text/css">
    
    .map {
      float: right;
    }

  </style>
</head>
<body style = "background-color: white ;">
<div class="border"></div>
	<div id="hints"></div>
	<div class="medictab">
		
			<center><img src="product-images/img/2M.png" >
		 <marquee behavior="alternate" height="-400px" width="1300px" Style ="font-size:24px;
  color:#C6302C; font-weight:bold;">Protéger les gens | Sauver des vies    </marquee></center>
	</div>

	
	<div class="navigation" id="navigation">
		<ul>
			<li><a href="index.php">Acceuil</a></li>
			<li>
				<a href="masse.php">Masse corporelle</a></li>
				<li >
				<a href="medicament.php">Medicament</a>
				
			</li>
			<li><a href="sympcheck.php " class="active" >Vérificateur de symptômes</a></li>
		
		<div style= "float :right; ">
			
			<li><a href="signup.html" style="border-left: 1px solid powderblue;" class="active">Sign Up</a></li>
			<li><a href="login.html">Login</a></li>
		

		</ul>
	</div><br><br><br>	


<img src="product-images/img/crop_human.jpg" alt="" usemap="#Map" class="map" />
<map name="Map" id="Map">

    <div id="1"><area alt="hand" title="" href="#" shape="poly" coords="153,141,174,131,182,275,161,270"  /></div><p id="text1"></p>

    <div id="2"><area alt="hand" title="" href="#" shape="poly" coords="46,135,74,147,63,274,41,269" /></div><p id="text2"></p>

    <div id="3"><area alt="shoulder" title="" href="#" shape="poly" coords="46,117,67,132,90,98,83,89" /></div><p id="text3"> </p>

    <div id="4"><area alt="shoulder" title="" href="#" shape="poly" coords="159,128,174,115,139,92,131,107" /></div><p id="text4"></p>

    <div id="5"><area alt="chest" title="" href="#" shape="poly" coords="78,122,145,124,146,151,80,153" /></div><p id="text5"></p>

    <div id="6"><area alt="stomach" title="" href="#" shape="poly" coords="79,168,146,174,148,211,76,213" /></div><p id="text6"></p>

    <div id="7"><area alt="thigh" title="" href="#" shape="poly" coords="110,252,108,296,76,290,74,248" /></div><p id="text7"></p>

    <div id="8"><area alt="thigh" title="" href="#" shape="poly" coords="116,253,152,246,148,290,117,292" /></div><p id="text8"></p>

    <div id="9"><area alt="knee" title="" href="#" shape="poly" coords="86,315,110,320,110,347,86,348" /></div><p id="text9"></p>

    <div id="10"><area alt="knee" title="" href="#" shape="poly" coords="115,317,138,310,140,350,119,350" /></div><p id="text10"></p>

    <div id="11"><area alt="lower-leg" title="" href="#" shape="poly" coords="84,360,107,361,111,449,82,449" /></div><p id="text11"></p>

    <div id="12"><area alt="lower-leg" title="" href="#" shape="poly" coords="119,363,145,364,144,448,118,449" /></div><p id="text12"></p>

    <div id="13"><area alt="neck" title="" href="#" shape="poly" coords="96,81,127,81,124,89,98,91" /></div><p id="text13"></p>

    <div id="14"><area alt="head" title="" href="#" shape="poly" coords="91,31,136,31,129,74,94,72" /></div><p id="text14"></p>
    
</map>

<script>
var item1 = document.getElementById("1");
item1.addEventListener("mouseover", fun1, false);
item1.addEventListener("mouseout", func1, false);

function fun1()
{   
   document.getElementById("text1").setAttribute("style", "display:block;");
   document.getElementById("text1").innerHTML="Hand";
}

function func1()
{  
    document.getElementById("text1").setAttribute("style", "display:none;");
}

var item2 = document.getElementById("2");
item2.addEventListener("mouseover", fun2, false);
item2.addEventListener("mouseout", func2, false);

function fun2()
{   
   document.getElementById("text2").setAttribute("style", "display:block;");
   document.getElementById("text2").innerHTML="Hand";
}

function func2()
{  
    document.getElementById("text2").setAttribute("style", "display:none;");
}

var item3 = document.getElementById("3");
item3.addEventListener("mouseover", fun3, false);
item3.addEventListener("mouseout", func3, false);

function fun3()
{   
   document.getElementById("text3").setAttribute("style", "display:block;");
   document.getElementById("text3").innerHTML="Shoulder";
}

function func3()
{  
    document.getElementById("text3").setAttribute("style", "display:none;")
}

var item4 = document.getElementById("4");
item4.addEventListener("mouseover", fun4, false);
item4.addEventListener("mouseout", func4, false);

function fun4()
{   
   document.getElementById("text4").setAttribute("style", "display:block;");
   document.getElementById("text4").innerHTML="Shoulder";
}

function func4()
{  
    document.getElementById("text4").setAttribute("style", "display:none;")
}

var item5 = document.getElementById("5");
item5.addEventListener("mouseover", fun5, false);
item5.addEventListener("mouseout", func5, false);

function fun5()
{   
   document.getElementById("text5").setAttribute("style", "display:block;");
   document.getElementById("text5").innerHTML="Chest";
}

function func5()
{  
    document.getElementById("text5").setAttribute("style", "display:none;");
}

var item6 = document.getElementById("6");
item6.addEventListener("mouseover", fun6, false);
item6.addEventListener("mouseout", func6, false);

function fun6()
{   
   document.getElementById("text6").setAttribute("style", "display:block;");
   document.getElementById("text6").innerHTML="Stomach";
}

function func6()
{  
    document.getElementById("text6").setAttribute("style", "display:none;")
}

var item7 = document.getElementById("7");
item7.addEventListener("mouseover", fun7, false);
item7.addEventListener("mouseout", func7, false);

function fun7()
{   
   document.getElementById("text7").setAttribute("style", "display:block;");
   document.getElementById("text7").innerHTML="Thigh";
}

function func7()
{  
    document.getElementById("text7").setAttribute("style", "display:none;");
}

var item8 = document.getElementById("8");
item8.addEventListener("mouseover", fun8, false);
item8.addEventListener("mouseout", func8, false);

function fun8()
{   
   document.getElementById("text8").setAttribute("style", "display:block;");
   document.getElementById("text8").innerHTML="Thigh";
}

function func8()
{  
    document.getElementById("text8").setAttribute("style", "display:none;")
}

var item9 = document.getElementById("9");
item9.addEventListener("mouseover", fun9, false);
item9.addEventListener("mouseout", func9, false);

function fun9()
{   
   document.getElementById("text9").setAttribute("style", "display:block;");
   document.getElementById("text9").innerHTML="Knee";
}

function func9()
{  
    document.getElementById("text9").setAttribute("style", "display:none;")
}

var item10 = document.getElementById("10");
item10.addEventListener("mouseover", fun10, false);
item10.addEventListener("mouseout", func10, false);

function fun10()
{   
   document.getElementById("text10").setAttribute("style", "display:block;")
   document.getElementById("text10").innerHTML="Knee";
}

function func10()
{  
    document.getElementById("text10").setAttribute("style", "display:none;")
}

var item11 = document.getElementById("11");
item11.addEventListener("mouseover", fun11, false);
item11.addEventListener("mouseout", func11, false);

function fun11()
{   
   document.getElementById("text11").setAttribute("style", "display:block;");
   document.getElementById("text11").innerHTML="Lower-leg";
}

function func11()
{  
    document.getElementById("text11").setAttribute("style", "display:none;")
}

var item12 = document.getElementById("12");
item12.addEventListener("mouseover", fun12, false);
item12.addEventListener("mouseout", func12, false);

function fun12()
{   
   document.getElementById("text12").setAttribute("style", "display:block;");
   document.getElementById("text12").innerHTML="Lower-leg";
}

function func12()
{  
    document.getElementById("text12").setAttribute("style", "display:none;")
}

var item13 = document.getElementById("13");
item13.addEventListener("mouseover", fun13, false);
item13.addEventListener("mouseout", func13, false);

function fun13()
{   
   document.getElementById("text13").setAttribute("style", "display:block;");
   document.getElementById("text13").innerHTML="Neck";
}

function func13()
{  
    document.getElementById("text13").setAttribute("style", "display:none;")
}

var item14 = document.getElementById("14");
item14.addEventListener("mouseover", fun14, false);
item14.addEventListener("mouseout", func14, false);

function fun14()
{   
   document.getElementById("text14").setAttribute("style", "display:block;");
   document.getElementById("text14").innerHTML="Head";
}

function func14()
{  
    document.getElementById("text14").setAttribute("style", "display:none;")
}
</script>
</body>
</html>