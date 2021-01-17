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
?><html>
<head>

<link rel="icon" href="icon-favicon.png" type="image/png" sizes="32x32">

	<meta charset="utf-8"/>
	<title>2M Medical Center| Acceuil </title>
	<link rel="stylesheet" type="text/css" href="assets/css/Header.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<base href="index.php"/>
</head>
<body>
	<div class="border"></div>
	<div id="hints"></div>
	<div class="medictab">
		
			<center><img src="product-images/img/2M.png" >
			 <marquee behavior="alternate" height="-400px" width="1300px" Style ="font-size:24px;
  color:#C6302C; font-weight:bold;">Protéger les gens | Sauver des vies    </marquee>
		</center>
		
	</div>


	<div class="navigation" id="navigation">
	
		<ul>
			<li> 
			<a href="index.php" class="active">Acceuil</a></li>
			<li>
		    <a href="masse.php" >Masse corporelle</a></li>

			<li><a href="medicament.php" >Médicament</a></li>

			<li><a href="sympcheck.php">Vérificateur de symptômes</a></li>
			<div style= "float :right; ">
			
			<li><a href="signup.html" style="border-left: 1px solid powderblue;" class="active">Sign Up</a></li>
			<li><a href="login.html">Login</a></li>
		<div>
</li>

		</ul>

	</div>
	<br> <br> <br> <br>
<img style ="float:left; margin-left: 170px;" src="product-images/img/about.png" >
	<br><br>
	<center>
	<h1 style="font-weight: bold; 

   ">Welcome To</h1>
		<img src="product-images/img/2M2.png" >
			<h1 style="font-weight: bold; 

   "> Medical Center</h1>
		
	
</center>	</div>

<div class = "test">

 </div>


<br><br><br><br><br><br><br>

		<center><img src="product-imagesimg/Qq.png" ></center>
		<br>
		<hr style = "background-color: black;
    height: 6px;   width:70%;  border-radius: 30px;">
	<center>
	<img  style ="    border-radius: 10px;border: 5px solid #bd1414 ;    height: 300px;"src="product-images/img/health.png" >
	</center>
	
<div style="max-width: 100%; position: relative;">

      


    	<div id="asider" style="padding: 50px; margin-left:10px;max-width:660px; display:inline-block; float:right; overflow: auto;"> 
    		<span>
    			 <hr style = "background-color: #cc0a0a;
    height: 5px;     border-radius: 30px;">
	
    				
    			
    		</span>
    	</div>
	</br>
	</br>
	<div id="footer">
		<p style="text-align: center; font-size: 15px;">
		
	</br>
Merci pour votre visite
</p>
		<p style="text-align: center; font-weight: bold;
    font-size: 24px;">2M Medical Center </p>
		<p style="font-size: 11px; text-align: center;  font-weight: bold;"> Visit Again | Stay Healthy </p>
		<hr/>
		<p style="text-align:center; padding-bottom:20px;color : white;
				"> <strong  style="color:white"> Copyright AYEDI Mahdi | GHALI Mohamed Mehdi © FILS 1240F </strong> </p>
	</div>


</body>
</html>
