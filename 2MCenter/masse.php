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
			<a href="index.php" >Acceuil</a></li>
			<li>
				<a href="masse.php" class="active">Masse corporelle</a></li>

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
	
<div style="    margin-left: 260px;">
<h2>L’indice de masse corporelle </h2>
<br>

<p>
L’indice de masse corporelle (IMC) permet d’évaluer rapidement votre corpulence simplement avec votre poids et votre taille.
<br>
 <b>Calculez rapidement votre IMC et découvrez dans quelle catégorie vous vous situez.</b>
<br>

<br>
L’IMC permet de déterminer si l’on est situation de maigreur, de surpoids ou d’obésité par exemple.


En anglais on parle de BMI pour <b>Body Mass Index. </b></p>
<b><p>Click sur le button : </p></b></div>

	<br>
<center><button  id="button" type="button" style ="background-color: #bd1414; color:white ; border : 2px solid black; border-radius: 9px;padding: 8px;
    width: 20%;">Calculer Maintenant!</button></center>
	<br>
<center><img style ="height : 500px; border:2px solid black ;"src ="product-images/img/imc.jpg" ></center>
<br>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span><br>
    
	Age:<br>
	  <input type="text" name="age" id="age1" placeholder="Your age"  onblur="age_validate()"  onfocus="validate_age()" required><br><p id="p1"></p> 
	Gender:<br>
	  <input type="radio" name="gender" id="gen1" value="Male" >Male
	  <input type="radio" name="gender" id="gen2" value="Female" >Female<br><p id="p2"></p>
	Height:<br>
	  <input type="text" name="height" id="hei1" placeholder="centimeters" onfocus="validate_height()" onblur="height_validate()"><br><p id="p3"></p>
	Weight:<br>
	  <input type="text" name="weight" id="wei1" placeholder="Kilogram" onfocus="validate_weight()" onblur="weight_validate()"><br><p id="p4"></p>
	  <input type="submit" value="Calculate" onclick="return evalute()">
	
	<p>
    <span id="output"></span><br>
    <span id="comment"></span>
  </p>
  </div>

</div>

<script>


var modal = document.getElementById('myModal');

var btn = document.getElementById("button");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
    document.getElementById("age1").value = "";
    document.getElementById("hei1").value = "";
    document.getElementById("wei1").value = "";
    document.getElementById("gen1").checked = false;
    document.getElementById("gen2").checked = false;
    document.getElementById("p1").innerHTML = "";
    document.getElementById("p2").innerHTML = "";
    document.getElementById("p3").innerHTML = "";
    document.getElementById("p4").innerHTML = "";
    document.getElementById("output").innerHTML = "";
    document.getElementById("comment").innerHTML = "";
}

span.onclick = function() {
    modal.style.display = "none";
}


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


function evalute()
{
  
  var m=document.getElementById("gen1");
  var f=document.getElementById("gen2");
  if (m.checked == false && f.checked == false)
  {
  document.getElementById("p2").innerHTML="Plz.. select gender";
  return false;
  }

  var h=document.getElementById("hei1").value;
  var w=document.getElementById("wei1").value;   
  h=h/100;
  var bmi=(w*1)/(h*h);
  bmi=parseInt(bmi);
  var output = bmi.toPrecision(4);
  document.getElementById("output").innerText=(bmi);

  if (output < 18.5){
		document.getElementById("comment").style='color:#21618C;';
    document.getElementById("comment").innerText = "This means you are Underweight";
  }

  else if (output >= 18.5 && output <= 25){
    document.getElementById("comment").style='color:#52BE80;';
		document.getElementById("comment").innerText = "This means you are Normal";
  }

  else if (output >= 25 && output <= 30) {
		document.getElementById("comment").style='color:#E59866;';
    document.getElementById("comment").innerText = "This means you are Obese";
  }

  else if (output > 30){
		document.getElementById("comment").style='color:#D35400;';
    document.getElementById("comment").innerText = "This means you are Overweight"; 
  }

  return true;
}

function age_validate(){
   var a=document.getElementById("age1");
   if (a.value==""){
   document.getElementById("p1").innerHTML="Plz.. fill age";
   }   
}

//function gen_validate(){}

function height_validate(){
   var h=document.getElementById("hei1").value;
   if (h==""){
   document.getElementById("p3").innerText="Plz.. fill height";
   }   
}
function weight_validate(){
   var w=document.getElementById("wei1").value;
   if (w==""){
   document.getElementById("p4").innerText="Plz.. fill weight";
   }   
}
function validate_age(){
   document.getElementById('p1').innerHTML="";

}
function validate_height(){
   document.getElementById('p3').innerHTML="";
 
}
function validate_weight(){
   document.getElementById('p4').innerHTML="";

}
</script>
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
