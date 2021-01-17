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
		<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<base href="index.php"/>
</head>
<body>
	<div class="border"></div>
	<div id="hints"></div>
	<div class="medictab">
		
			<center><img src="img/2M.png" >
			 <marquee behavior="alternate" height="-400px" width="1300px" Style ="font-size:24px;
  color:#C6302C; font-weight:bold;">Protéger les gens | Sauver des vies    </marquee>
		</center>
		
	</div>


	<div class="navigation" id="navigation">
	
		<ul>
			<li> 
			<a href="index.php" >Acceuil</a></li>
			<li>
				<a href="masse.php" >Masse corporelle</a></li>

			<li><a href="medicament.php" class="active" >Médicament</a></li>

			<li><a href="sympcheck.php">Vérificateur de symptômes</a></li>
			<div style= "float :right; ">
			
			<li><a href="signup.html" style="border-left: 1px solid powderblue;" class="active">Sign Up</a></li>
			<li><a href="login.html">Login</a></li>
		<div>
</li>

		</ul>

	</div>
	<br> <br> <br> <br>

<div id="shopping-cart">


<a id="btnEmpty" style = "background-color:#0e0d0d;
	  padding: 7px 100px;
    color: white;  border: #0e0d0d 1px solid;" href="medicament.php?action=empty">Vider La Panier</a>


<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">produit</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantite</th>
<th style="text-align:right;" width="10%">Prix d'unite</th>
<th style="text-align:right;" width="10%">prix</th>
<th style="text-align:center;" width="5%">supprimer</th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="medicament.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">FACTURE</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
  <?php
} else {
?>
<br>
<?php
}
?>
</div>

<div id="product-grid">
	<div style = "   background: black; color:white;
    border: 2px solid black;
	border-radius : 5px;
    padding: 10px 0 ;
    font-weight:bold;
    font-size: 15px;
	
    text-align: center;">Médicaments et produits pharmaceutiques  </div>
	<center>
 <img height=250px weight=130px src="product-images/capture.png" alt="service client"> </center>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) {
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item" style ="  background-color: #cdcdcd;border: black 1px solid;
">
		
		
			<form method="post" action="medicament.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image" style="
    background: #465aea;
    
    border: black 1px solid;" ><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"    style="  color: white;
    text-align: center;
    font-weight: bold;">
	
	<?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"
			   style=" color: #000000;
    font-weight: bold;"
			
			><?php echo "$".$product_array[$key]["price"]; ?></div>
			
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" 
			style="padding: 6px 0px;
    border-radius: 111px;
    border: #000000 2px solid;text-align:center; color: #465aea;"
	
			/>
			<input type="submit" value="Ajouter" class="btnAddAction" style ="  background-color: red;
    border: #0e0d0d 2px solid;
    color: #ffffff;"/></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
	
</div>
    
</BODY>


 <!-- Footer -->
 <footer>
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

 
          
				
				
            </footer>

</HTML>
