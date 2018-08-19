<?php
/**
 * @bucknelius
 *  SELECT * FROM `orders` WHERE `payment_module_code` = 'cash' AND `date_purchased` LIKE '%2018-08-07%'
 * git status
 * git add filename.php
 * git commit -m "insert my comment here"
 */
 

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  error_reporting(-1);
  
  define('STRICT_ERROR_REPORTING', true);
  $currencies = new currencies();
  $invoice_totals = array();
  $invoice_cogs_array = array();
  //$_POST = array();

	$con=mysqli_connect("localhost","db_cuser","DBPassword!","db_drawercounter");

	if (mysqli_connect_errno())
	  {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	  if ($result=mysqli_query($con,$sql))
  {
	  while ($obj=mysqli_fetch_object($result))
		{
			//printf("%s \n",$obj->pebs_man_code);
		}
	  // Free result set
	  mysqli_free_result($result);
  }
if(isset($_POST)){
	$messageIdent = md5($_POST['drawerdate_field'] . $_POST['hundos_field'] . $_POST['twenties_field'] . $_POST['comment_field']);
	$sessionMessageIdent = isset($_SESSION['messageIdent'])?$_SESSION['messageIdent']:'';
}
if(($messageIdent!=$sessionMessageIdent) && isset($_POST) && ($_POST['drawerdate_field'] > 1)){//if its different:
//if (isset($_POST['SubmitButton'])) {
	//switch ($target) {
		$_SESSION['messageIdent'] = $messageIdent;
		//case 'drawerCountAction':
			$currencies = new currencies();
			//echo '<pre>asdfa';
			
			//print_r($_POST);
			//echo '</pre>';
			//$drawerdate = new DateTime('2000-01-01');
			$drawerdate = $_POST['drawerdate_field'];
			$drawerdate = str_replace("T", " ", $_POST['drawerdate_field']); //datetime-local 
			
			//build db insert query
			$updatesql = "INSERT INTO `drawers` 
			(`id`, 
			`drawertype`,
			`drawerdate`, 
			`hundos`, 
			`fifties`, 
			`twenties`, 
			`tens`, 
			`fives`, 
			`twos`, 
			`ones`,
			`qrolls`, 
			`drolls`, 
			`nrolls`, 
			`prolls`, 
			`odcoins`, 
			`hdcoins`, 
			`qcoins`, 
			`dcoins`, 
			`ncoins`, 
			`pcoins`, 
			`total`, 
			`initials`, 
			`comments`)
			VALUES (NULL,'" .
			$_POST['drawertype_field'] . "','" .
			$drawerdate . "',' " .
			$_POST['hundos_field'] . "','" .
			$_POST['fifties_field'] . "','" .
			$_POST['twenties_field'] . "','" . 
			$_POST['tens_field'] . "','" . 
			$_POST['fives_field'] . "','" . 
			$_POST['twos_field'] . "','" . 
			$_POST['ones_field'] . "','" . 
			$_POST['qrolls_field'] . "','" . 
			$_POST['drolls_field'] . "','" . 
			$_POST['nrolls_field'] . "','" . 
			$_POST['prolls_field'] . "','" . 
			$_POST['odcoins_field'] . "','" . 
			$_POST['hdcoins_field'] . "','" . 
			$_POST['qcoins_field'] . "','" . 
			$_POST['dcoins_field'] . "','" . 
			$_POST['ncoins_field'] . "','" . 
			$_POST['pcoins_field'] . "','" . 
			$_POST['total_field'] . "','" . 
			$_POST['initials_field'] . "','" . 
			$_POST['comments_field'] . "')"; 
			//$_POST['total_field'] . ")"; 
			
			//echo $updatesql . '<br /><br />';
			if ($con->query($updatesql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $updatesql . "<br>" . $con->error;
				//echo '<br>INSERT INTO `drawers` (`id`, `drawerdate`, `hundos`, `fifties`, `twenties`, `tens`, `fives`, `twos`, `ones`, `Total`) VALUES (NULL, '2018-08-02 11:16:12', '', '', '', '', '', '', '', '');
			}
			unset($_POST); //clear $_POST

} //else{
	//echo 'Duplicate entry';
//}
	$sql =  'SELECT * '
        . ' from drawers d';
		//. ' where 1';
		$drawercountsarray = array();
					//$sql = "SELECT * from product_machine where eastern_cat_code = '$eastern_cat_code'";
		if ($result=mysqli_query($con,$sql)) //within foreach($exp_by_ln as $exl)
		  {
				  // Fetch one and one row
				   while ($row=mysqli_fetch_assoc($result)) //runs while the expression evaluates to TRUE
					{
						//echo '<pre>';
						//print_r($result);
						//echo '</pre>';
						$drawercountsarray[$row['id']]['id'] = $row['id'];
						$drawercountsarray[$row['id']]['drawertype'] = $row['drawertype'];
						$drawercountsarray[$row['id']]['drawerdate'] = $row['drawerdate'];
						$drawercountsarray[$row['id']]['hundos'] = $row['hundos'];
						//$drawercountsarray[$row['id']][] = $row['hundos'];
						$drawercountsarray[$row['id']]['fifties'] = $row['fifties'];
						$drawercountsarray[$row['id']]['twenties'] = $row['twenties'];
						$drawercountsarray[$row['id']]['tens'] = $row['tens'];
						$drawercountsarray[$row['id']]['fives'] = $row['fives'];
						$drawercountsarray[$row['id']]['twos'] = $row['twos'];
						$drawercountsarray[$row['id']]['ones'] = $row['ones'];
						$drawercountsarray[$row['id']]['qrolls'] = $row['qrolls'];
						$drawercountsarray[$row['id']]['drolls'] = $row['drolls'];
						$drawercountsarray[$row['id']]['nrolls'] = $row['nrolls'];
						$drawercountsarray[$row['id']]['prolls'] = $row['prolls'];
						$drawercountsarray[$row['id']]['odcoins'] = $row['odcoins'];
						$drawercountsarray[$row['id']]['hdcoins'] = $row['hdcoins'];
						$drawercountsarray[$row['id']]['qcoins'] = $row['qcoins'];
						$drawercountsarray[$row['id']]['dcoins'] = $row['dcoins'];
						$drawercountsarray[$row['id']]['ncoins'] = $row['ncoins'];
						$drawercountsarray[$row['id']]['pcoins'] = $row['pcoins'];
						$drawercountsarray[$row['id']]['total'] = $row['total'];
						$drawercountsarray[$row['id']]['initials'] = $row['initials'];
						$drawercountsarray[$row['id']]['comments'] = $row['comments'];
						
						//echo '<td>date is ' . $row['drawerdate'] . '</td>';
						//echo '<td>date is ' . $drawerdate . '</td>';
						//echo '<td>' . $hundos . '</td>';
						//echo '<td>' . $fifties . '</td>';
						//echo '</tr>';
					}
			mysqli_free_result($result);
		  }
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo 'Drawer Counter'; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script language="javascript">
function totalit(){
	//alert("hi there");
	//alert((document.getElementById("hundos").value*100) + " is type " + typeof (reduce(document.getElementById("hundos"))));
	totalval = parseFloat(0);
	//alert("1 type of " + typeof(totalval));
	totalval += parseFloat(document.getElementById("hundos").value*100 || 0); // ? parseFloat(document.getElementById("hundos").value)*100 : NaN);
	//alert("2 type of " + typeof(totalval));
	totalval += parseFloat(document.getElementById("fifties").value*50 || 0); // ? parseFloat(document.getElementById("fifties").value)*50 : NaN); //+
	//alert("3 type of " + typeof(totalval));
	totalval += parseFloat(document.getElementById("twenties").value*20 || 0);
	totalval += parseFloat(document.getElementById("tens").value*10 || 0);
	totalval += parseFloat(document.getElementById("fives").value*5 || 0);
	totalval += parseFloat(document.getElementById("twos").value*2 || 0);
	totalval += parseFloat(document.getElementById("ones").value || 0);
	totalval += parseFloat(document.getElementById("qrolls").value*10 || 0);
	totalval += parseFloat(document.getElementById("drolls").value*5 || 0);
	totalval += parseFloat(document.getElementById("nrolls").value*2 || 0);
	totalval += parseFloat(document.getElementById("prolls").value*.5 || 0);
	totalval += parseFloat(document.getElementById("odcoins").value || 0);
	totalval += parseFloat(document.getElementById("hdcoins").value*.5 || 0);
	totalval += parseFloat(document.getElementById("qcoins").value*.25 || 0);
	totalval += parseFloat(document.getElementById("dcoins").value*.10 || 0);
	totalval += parseFloat(document.getElementById("ncoins").value*.05 || 0);
	totalval += parseFloat(document.getElementById("pcoins").value*.01 || 0); 
	//totalval = hundosval+fiftiesval;
	document.getElementById("total").value = totalval.toFixed(2);
	//msg = "hundos val is " + hundosval + "\n" +
	//"fiftiesval is " + fiftiesval + "\n" +
	//"totalval is " + totalval;
	//msg = "isNan on \n\"" +
	//document.getElementById("fifties").value + 
	//"\"\nis \n" + 
	//isNaN(document.getElementById("fifties").value);
	//alert(totalval);
}
</script>

</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<form action="" method="post">
<table class="table" name="table2" border="1" style="width: 3500px;" cellspacing="0" cellpadding="0">
<tbody>
<colgroup>
 <col width="20">
 <col width="30">
 <col width="10">
</colgroup>
<script>
$(document).keydown(
    function(e)
    {    
        if (e.keyCode == 39) {      
			//alert("smell my rubber fingers");
			//alert().nextAll('input');
            $(".move:focus").parent().next().find('input').focus();

        }
        if (e.keyCode == 37) {      
            $(".move:focus").parent().prev().find('input').focus();

        }
    }
);
</script>
  <tr>
	 <td class="pageHeading" valign="right" align="center" colspan="3"><?php echo ' '; ?></td>
     <td class="pageHeading" valign="right" align="center" colspan="7"><?php echo 'Bills'; ?></td>
	 <td class="pageHeading" valign="right" align="center" colspan="4"><?php echo 'Rolls'; ?></td>
	 <td class="pageHeading" valign="right" align="center" colspan="6"><?php echo 'Coins'; ?></td>
  </tr>
  <tr class="fixed_headers" >
	 <td class="id"></td>
	 <div class="header">
	 <td class="drawertype">Type</td>
	 <td class="pageHeading date" style="width: 151px;"> Date</span></td>
	 <td class="pageHeading bills" width="5%" style="text-align: center; width: 5px;">100's</td>
	 <td class="pageHeading bills" width="10px;">50's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 10px;">20's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 10px;">10's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 10px;">5's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 10px;">2's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 10px;">1's</td>
	 <td class="pageHeading" style="text-align: center; width: 5px;">Q-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">D-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">N-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">P-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">$1-coins</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">$.5-coins</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 10px;">Quarter-coins</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">Dimes</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 10px;">Nickles</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 10px;">Pennies</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">Total</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">Initials</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">Comments</td>
	 <td class="pageHeading" style="text-align: center; width: 10px;">Close</td>
	 </div>
  </tr>

  <tr>
<?php
/*echo '<pre>bdbdbd';
//print_r($drawercountsarray);
echo '</pre>';*/
$eachDrawerDateArray = array();

	foreach($drawercountsarray as $drawercountday){
	echo '<tr>';
	echo '<td class="id">' . $drawercountday['id']. '</td>';
	echo '<td class="drawertype">' . $drawercountday['drawertype']. '</td>';
	echo '<td class="date">' . zen_datetime_long($drawercountday['drawerdate']). '</td>';
	echo '<td class="billnums nums" id="hun">' . $drawercountday['hundos']. '</td>';
	echo '<td class="billnums nums" id="fif">' . $drawercountday['fifties']. '</td>';
	echo '<td class="billnums nums" id="twen">' . $drawercountday['twenties']. '</td>';
	echo '<td class="billnums nums" id="te">' . $drawercountday['tens']. '</td>';
	echo '<td class="billnums nums" id="fiv">' . $drawercountday['fives']. '</td>';
	echo '<td class="billnums nums" id="two">' . $drawercountday['twos']. '</td>';
	echo '<td class="billnums nums" id="one">' . $drawercountday['ones']. '</td>';
	echo '<td class="nums" id="qr">' . $drawercountday['qrolls']. '</td>';
	echo '<td class="nums" id="dr">' . $drawercountday['drolls']. '</td>';
	echo '<td class="nums" id="nr">' . $drawercountday['nrolls']. '</td>';
	echo '<td class="nums" id="pr">' . $drawercountday['prolls']. '</td>';
	echo '<td class="coinnums nums" id="od">' . $drawercountday['odcoins']. '</td>';
	echo '<td class="coinnums nums" id="hd">' . $drawercountday['hdcoins']. '</td>';
	echo '<td class="coinnums nums" id="qc">' . $drawercountday['qcoins']. '</td>';
	echo '<td class="coinnums nums" id="dc">' . $drawercountday['dcoins']. '</td>';
	echo '<td class="coinnums nums" id="nc">' . $drawercountday['ncoins']. '</td>';
	echo '<td class="coinnums nums" id="pc">' . $drawercountday['pcoins']. '</td>';
	echo '<td id="tot">' . $drawercountday['total']. '</td>';
	echo '<td id="initals">' . $drawercountday['initials']. '</td>';
	echo '<td id="com">' . $drawercountday['comments']. '</td>';
	
	//echo '<td id="close">' . date_format(zen_datetime_long($drawercountday['drawerdate']),'%%Y%%m%%d') . '</td>';
	echo '<td id="close">' . date("Y-m-d", strtotime($drawercountday['drawerdate'])) . '</td>';
	//echo '<td>' . $drawercountday['one-rolls']. '</td>';
	$dayinquestion = strtotime($drawercountday['drawerdate']);
	$dayinquestion = date("Y-m-d", strtotime($drawercountday['drawerdate']));
	//$sql = "";
	//$db->Execute($sql);
	/*if(!isset($eachDrawerDateArray[date("Y-m-d", $dayinquestion)])){
		if($drawercountday['drawertype'] == 'open'){
			$eachDrawerDateArray[date("Y-m-d", $dayinquestion]['open'])] = $drawercountday['total'];
		}
		elseif($drawercountday['drawertype'] == 'close'){
			$eachDrawerDateArray[date("Y-m-d", $dayinquestion]['close'])] = $drawercountday['total'];
		}
	
		//query sql for drawerdate sales here
		
		$variance = $variance - $eachDrawerDateArray[date("Y-m-d", strtotime($drawercountday['drawerdate']))]['close'] - $eachDrawerDateArray[date("Y-m-d", strtotime($drawercountday['drawerdate']))]['open']
	}*/
	
	//echo '<td>' . $drawercountday['drawerdate']. '</td>';
	echo '</tr>';
}

print_r($dayinquestion);

?>
  </tr>
 
<!-- body_text_eof //-->
  </tr>
<?php
$drawertypeoptions = array(
	array('id' => 'open', 'text' => 'open'),
	array('id' => 'close', 'text' => 'close'),
	array('id' => 'deposit', 'text' => 'deposit'),
	array('id' => 'drawerpurchase', 'text' => 'drawer purchase'),
	array('id' => 'refund', 'text' => 'refund'),
	array('id' => 'ownerscontribution', 'text' => 'Owner\'s Contribution'),
	array('id' => 'ownersdraw', 'text' => 'Owner\'s Draw'),
	array('id' => 'other', 'text' => 'other')
	);
echo '<tr>';
//echo '<td>';
$timestamp = date("Y-m-d\TH:i:s");
echo '<td class="id"></td>';
echo '<td class="drawertype">' . zen_draw_pull_down_menu('drawertype_field', $drawertypeoptions, '0') . '</td>';
echo '<td class="date dateinputcell"><input class="date dateinput" type="datetime-local" name= "drawerdate_field" value="' . $timestamp . '"></td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('hundos_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="hundos" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('fifties_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="fifties" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('twenties_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="twenties" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('tens_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="tens" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('fives_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="fives" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('twos_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="twos" length="8"') . '</td>';
echo '<td class="numinputs bills">' . zen_draw_input_field('ones_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="ones" length="8"') . '</td>';
echo '<td class="numinputs coinrolls">' . zen_draw_input_field('qrolls_field', '', 'onkeyup=totalit(); class="move numinputs rollsinput" id="qrolls" length="8"') . '</td>';
echo '<td class="numinputs coinrolls">' . zen_draw_input_field('drolls_field', '', 'onkeyup=totalit(); class="move numinputs rollsinput" id="drolls" length="8"') . '</td>';
echo '<td class="numinputs coinrolls">' . zen_draw_input_field('nrolls_field', '', 'onkeyup=totalit(); class="move numinputs rollsinput" id="nrolls" length="8"') . '</td>';
echo '<td class="numinputs coinrolls">' . zen_draw_input_field('prolls_field', '', 'onkeyup=totalit(); class="move numinputs rollsinput" id="prolls" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('odcoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="odcoins" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('hdcoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="hdcoins" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('qcoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="qcoins" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('dcoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="dcoins" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('ncoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="ncoins" length="8"') . '</td>';
echo '<td class="numinputs coins">' . zen_draw_input_field('pcoins_field', '', 'onkeyup=totalit(); class="move numinputs coinsinput" id="pcoins" length="8"') . '</td>';
echo '<td>' . zen_draw_input_field('total_field', '', 'onkeyup=totalit(); id="total" length="8" required') . '</td>';
echo '<td>' . zen_draw_input_field('initials_field', '', 'length="8" required') . '</td>';
echo '<td>' . zen_draw_input_field('comments_field', '', 'length="8"') . '</td>';



//echo '<td>' . zen_draw_input_field('total_field', '0', 'length="8"') . '</td>';
echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><div class="buttonRow forward"><input type="submit" name="SubmitButton"/></div><td><tr>';
echo '</tr></form>';
?>
  </tbody>
</table>
<!-- body_eof //-->


<style>
    .table {
        display: block;
        max-width: 100%;
		align: center;
		<!--max-height: 100%;-->
        overflow: scroll; <!-- Available options: visible, hidden, scroll, auto -->
    }
	.pageHeading {
		background: lightgrey;
	}
	.content{
		overflow: auto;
	}
	.id{
		padding: 0px !important;
		max-width: 15px;
	}
	.drawertype{
		max-width: 65px;
	}
	.date {
		padding: 0px !important;
		padding-top: 12px !important;		
		max-width: 165px;
	}
	.dateinput {
		font-size:9px !important;
	}
	.dateinputcell{
		padding: 0px !important;
		padding-top: 8px !important;
	}
	.bills {
		padding: 0px !important;
		max-width: 70px;
		color: green;
	}
	.coinrolls {
		padding: 0px !important;
		max-width: 70px;
	}
	.coins {
		padding: 0px !important;
		max-width: 70px;
	}
	.numinputs{
		padding: 0px !important;
		max-width: 45px;
		padding: 0px;
	}
	.nums{
		padding: 0px !important;
		padding-top: 12px !important;
		text-align: center;
	}
	.billnums{
		padding: 0px !important;
		padding-top: 12px !important;
		background-color: #85bb65 ;
	}
	.coinnums{
		padding: 0px !important;
		padding-top: 12px !important;
		background-color: silver;
		max-width: 75px !important;
	}
@header_background_color: #333;
@header_text_color: #FDFDFD;
@alternate_row_background_color: #DDD;

@table_width: 750px;
@table_body_height: 300px;
@column_one_width: 200px;
@column_two_width: 200px;
@column_three_width: 350px;

.fixed_headers {
  width: @table_width;
  table-layout: fixed;
  border-collapse: collapse;
  
  th { text-decoration: underline; }
  th, td {
    padding: 5px;
    text-align: left;
  }
  
  td:nth-child(1), th:nth-child(1) { min-width: @column_one_width; }
  td:nth-child(2), th:nth-child(2) { min-width: @column_two_width; }
  td:nth-child(3), th:nth-child(3) { width: @column_three_width; }

  thead {
    background-color: @header_background_color;
    color: @header_text_color;
    tr {
      display: block;
      position: relative;
    }
  }
  tbody {
    display: block;
    overflow: auto;
    width: 100%;
    height: @table_body_height;
    tr:nth-child(even) {
      background-color: @alternate_row_background_color;
    }
  }
}

.old_ie_wrapper {
  height: @table_body_height;
  width: @table_width;
  overflow-x: hidden;
  overflow-y: auto;
  tbody { height: auto; }
}	
input[type="text"] {
     width: 100%; 
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;
}
</style>

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>