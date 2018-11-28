<?php
/**
 * @bucknelius 
 *  SELECT * FROM `orders` WHERE `payment_module_code` = 'cash' AND `date_purchased` LIKE '%2018-08-07%'
 */

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');

  error_reporting(-1);
  
  define('STRICT_ERROR_REPORTING', true);
  define('NUMBER_OF_ROWS', 25);
  
  $currencies = new currencies();
  $invoice_totals = array();
  $invoice_cogs_array = array();
  

if(!empty($_POST)){
	$messageIdent = md5($_POST['drawerdate_field'] . $_POST['hundos_field'] . $_POST['twenties_field'] . $_POST['comment_field']);
	$sessionMessageIdent = isset($_SESSION['messageIdent'])?$_SESSION['messageIdent']:'';
}
if(($messageIdent!=$sessionMessageIdent) && isset($_POST) && ($_POST['drawerdate_field'] > 1)){		//if its different:
		$_SESSION['messageIdent'] = $messageIdent;
			$currencies = new currencies();
			$drawerdate = $_POST['drawerdate_field'];
			$drawerdate = str_replace("T", " ", $_POST['drawerdate_field']); //datetime-local 		
			$updatesql = "INSERT INTO `drawers` 
			(`id`, `drawertype`, `drawerdate`, `hundos`, `fifties`, `twenties`, `tens`, `fives`, `twos`, `ones`, 
			`qrolls`, `drolls`, `nrolls`, `prolls`, 
			`odcoins`, `hdcoins`, `qcoins`, `dcoins`, `ncoins`, `pcoins`, 
			`total`, `initials`,  `comments`)
			VALUES (NULL,'" .  $_POST['drawertype_field'] . "','" .  $drawerdate . "',' " .  $_POST['hundos_field'] . "','" .  $_POST['fifties_field'] . "','" .  $_POST['twenties_field'] . "','" .  $_POST['tens_field'] . "','" .  $_POST['fives_field'] . "','" .  $_POST['twos_field'] . "','" .  $_POST['ones_field'] 
			. "','" .  $_POST['qrolls_field'] . "','" .  $_POST['drolls_field'] . "','" .  $_POST['nrolls_field'] . "','" .  $_POST['prolls_field'] . "','" 
			.  $_POST['odcoins_field'] . "','" .  $_POST['hdcoins_field'] . "','" .  $_POST['qcoins_field'] . "','" .  $_POST['dcoins_field'] . "','" .  $_POST['ncoins_field'] . "','" .  $_POST['pcoins_field'] . "','" 
			.  $_POST['total_field'] . "','" .  $_POST['initials_field'] . "','" .  $_POST['comments_field'] . "')";  //$_POST['total_field'] . ")"; //build db insert query
			
			if ($db->Execute($updatesql) == TRUE) { // triple = is identical to and of the same type
				echo "New record created successfully";
			} else {
				echo "Error: " . $updatesql . "<br>" . $con->error;}
			unset($_POST); //clear $_POST

	} 
	global $db;
	$sql =  'SELECT * FROM `drawers` ORDER By `drawerdate` DESC	LIMIT ' . NUMBER_OF_ROWS;
	$drawercountsarray = array();
	$result = $db->Execute($sql);
	
	/*echo '<pre>';
	print_r($result);
	echo '</pre>';*/
	
	if ($result->RecordCount() > 0) //within foreach($exp_by_ln as $exl)
		  {
			  $dateSortOrder = 0;
				  // Fetch one and one row
				   //while ($row=mysqli_fetch_assoc($result)) //runs while the expression evaluates to TRUE //works w/ old db connection
				   while (!$result->EOF) //runs while the expression evaluates to TRUE
					{
						/*echo '<pre>';
						print_r($result);
						echo '</pre>';*/
						
						$dateSortOrder++;
						//for($i = $result->fields['id'][0]; $result->fields['id'] > 0; $i--){
						$drawercountsarray[$dateSortOrder]['id'] = $result->fields['id'];
						$drawercountsarray[$dateSortOrder]['dateSortOrder'] = $dateSortOrder;
						$drawercountsarray[$dateSortOrder]['drawertype'] = $result->fields['drawertype'];
						$drawercountsarray[$dateSortOrder]['drawerdate'] = $result->fields['drawerdate'];
						$drawercountsarray[$dateSortOrder]['hundos'] = $result->fields['hundos'];
						//$drawercountsarray[$dateSortOrder][] = $result->fields['hundos'];
						$drawercountsarray[$dateSortOrder]['fifties'] = $result->fields['fifties'];
						$drawercountsarray[$dateSortOrder]['twenties'] = $result->fields['twenties'];
						$drawercountsarray[$dateSortOrder]['tens'] = $result->fields['tens'];
						$drawercountsarray[$dateSortOrder]['fives'] = $result->fields['fives'];
						$drawercountsarray[$dateSortOrder]['twos'] = $result->fields['twos'];
						$drawercountsarray[$dateSortOrder]['ones'] = $result->fields['ones'];
						$drawercountsarray[$dateSortOrder]['qrolls'] = $result->fields['qrolls'];
						$drawercountsarray[$dateSortOrder]['drolls'] = $result->fields['drolls'];
						$drawercountsarray[$dateSortOrder]['nrolls'] = $result->fields['nrolls'];
						$drawercountsarray[$dateSortOrder]['prolls'] = $result->fields['prolls'];
						$drawercountsarray[$dateSortOrder]['odcoins'] = $result->fields['odcoins'];
						$drawercountsarray[$dateSortOrder]['hdcoins'] = $result->fields['hdcoins'];
						$drawercountsarray[$dateSortOrder]['qcoins'] = $result->fields['qcoins'];
						$drawercountsarray[$dateSortOrder]['dcoins'] = $result->fields['dcoins'];
						$drawercountsarray[$dateSortOrder]['ncoins'] = $result->fields['ncoins'];
						$drawercountsarray[$dateSortOrder]['pcoins'] = $result->fields['pcoins'];
						$drawercountsarray[$dateSortOrder]['total'] = $result->fields['total'];
						$drawercountsarray[$dateSortOrder]['initials'] = $result->fields['initials'];
						$drawercountsarray[$dateSortOrder]['comments'] = $result->fields['comments']; //
						$drawercountsarray[$dateSortOrder]['lastopenclose'] = ''; //
						$drawercountsarray[$dateSortOrder]['negations'] = ''; //
						//$drawercountsarray[$result->fields['dateSortOrder']]['comments'] = $result->fields[0]['id']; // 
						//}
					
						//echo 'turd ' . $i++ . '</br>';
						
						$result -> MoveNext (); //new for zen-cart db // Does not... //works w/ old db connection
					} //close while
		  } else {
			echo '<p>Sorry, no currencies found.</p>';
		}
		/*echo '<pre>drawer counter:';
		print_r($drawercountsarray);
		echo '</pre>';*/
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
<p id="finalcountdown" align="center"></p>
<form action="" method="post">
<table class="table" name="table2" border="1" style="width: 3500px;" cellspacing="0" cellpadding="0">
<tbody>

<colgroup>
 <col width="20">
 <col width="30">
 <col width="10">
</colgroup>

<script>
// Set the date we're counting down to
//var countDownDate = new Date().getTime();
//countDownDate = countDownDate.setSeconds(getSeconds() + 90);

	var countDownDate = new Date();
	countDownDate.setSeconds(countDownDate.getSeconds() + 900);

	//var countDownDate = countDownDate.setSeconds(countDownDate.getSeconds() + 90);

	// Update the count down every 1 second
	var x = setInterval(function() {

		// Get todays date and time
		var now = new Date().getTime();
		
		// Find the distance between now and the count down date
		var distance = countDownDate - now;
		
		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		
		// Output the result in an element with id="finalcountdown"
		//document.getElementById("finalcountdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
		document.getElementById("finalcountdown").innerHTML = "time you have to count the drawer " + minutes + "m " + seconds + "s ";
		
		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("finalcountdown").innerHTML = "SESSION EXPIRED AFTER 15 minutes - OPEN ADMIN IN ANOTHER TAB BEFORE SUBMITTING COUNTS";
		}
	}, 1000);
</script>
<script>
$(document).keydown(
    function(e)
    {    
		//select all text on over keys
	        $(function () {
            var focusedElement;
            $(document).on('focus', 'input', function () {
                if (focusedElement == this) return; //already focused, return so user can now place cursor at specific point in input.
                focusedElement = this;
                setTimeout(function () { focusedElement.select(); }, 50); //select all text in any field on focus for easy re-entry. Delay sightly to allow focus to "stick" before selecting.
            });
        });
	
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
	 <!--<td class="id"></td>--><!-- id is the id from the db value id, sortid is the value from the loop sorted by date-->
	 <td class="sortid"></td>
	 <div class="header">
	 <td class="drawertype">Type</td>
	 <td class="pageHeading date" style="width: 151px;"> Date</span></td>
	 <td class="pageHeading bills" style="text-align: center; width: 4%;">2's</td>
	 <td class="pageHeading bills" width="5%" style="text-align: center;">100's</td>
	 <td class="pageHeading bills" width="4%">50's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 4%;">20's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 4%;">10's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 4%;">5's</td>
	 <td class="pageHeading bills" style="text-align: center; width: 4%;">1's</td>
	 <td class="pageHeading" style="text-align: center; width: 5px;">Q-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">D-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">N-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">P-rolls</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">$1-coins</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">$.5-coins</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 4%;">Quarter-coins</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">Dimes</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 4%;">Nickles</td>
	 <td class="pageHeading" style="font-size:12px; text-align: center; width: 4%;">Pennies</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">Total</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">Initials</td>
	 <td class="pageHeading" style="text-align: center; width: 4%;">Comments</td>
	 <td class="pageHeading" style="text-align: center; width: 50%;">Variance</td>
	 </div>
  </tr>

  <tr>
<?php
/*echo '<pre>drawercountsarray:';
print_r($drawercountsarray);
echo '</pre>';*/


//##################################################################################################################################################################
// PRINT INPUT FIELDS
//##################################################################################################################################################################
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
	echo '<td class="numinputs bills">' . zen_draw_input_field('twos_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="twos" length="8"') . '</td>';
	echo '<td class="numinputs bills">' . zen_draw_input_field('hundos_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="hundos" length="8"') . '</td>';
	echo '<td class="numinputs bills">' . zen_draw_input_field('fifties_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="fifties" length="8"') . '</td>';
	echo '<td class="numinputs bills">' . zen_draw_input_field('twenties_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="twenties" length="8"') . '</td>';
	echo '<td class="numinputs bills">' . zen_draw_input_field('tens_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="tens" length="8"') . '</td>';
	echo '<td class="numinputs bills">' . zen_draw_input_field('fives_field', '', 'onkeyup=totalit(); class="move numinputs billsinput" id="fives" length="8"') . '</td>';
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
	echo '<td>' . zen_draw_input_field('total_field', '', 'onkeyup=totalit(); class="move" id="total" length="8" required') . '</td>';
	echo '<td>' . zen_draw_input_field('initials_field', '', 'class="move" length="8" required') . '</td>';
	echo '<td>' . zen_draw_input_field('comments_field', '', 'class="move" length="8"') . '</td>';
	echo '<td><div class="buttonRow forward"><input type="submit" name="SubmitButton"/></div></td></form>';
	echo '</tr>';
	//echo '</form>'; //assumed duplicate


//##################################################################################################################################################################
// DISPLAY SQL QUERY RESULTS FIELDS
//##################################################################################################################################################################

/*echo '<pre>de drawercountsarray:';
print_r($drawercountsarray);
echo '</pre>';*/

//$eachDrawerDateArray = array();
		$negations = 0;
		$j = 0;
	foreach($drawercountsarray as $key => $v){ //https://stackoverflow.com/questions/28216877/add-values-to-an-array-inside-a-foreach-loop

	//initialize variables for each $key/$i
		//$i = $v['dateSortOrder'];
		$lastopenclose = 0;
		$negations = 0;
		echo '<br /><br />---111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111<br />';
	echo '<br />$i (array/row index) is ' . $i . '$j (hopeful index of last open/close) is ' . $j . ' - $key is ' . $key . '<br />';
	echo  $v['drawertype'] . ' - '; //'$key[$v][\'drawertype\'] is ' .
	echo '[$v] drawerdate is ' . $v[drawerdate] . '<br />';
	
		/*if($v['drawertype'] == 'drawerpurchase' || $v['drawertype'] == 'ownersdraw'){
			$j--;
			$k--;
			//$negations += $drawercountsarray[$i]['total'];
			$negations += $v['total'];
			echo '$j is ' . $j . ' $negations is ' . $negations . '<br />';
		}else{
			$j++;
			$negations = 0;
		}*/
		
		//(do while) loop to look for next open/close and set as lastopenclose
		//drawer types are open, close, deposit, drawer purchase, owners draw, owners contribution, other
		
		//types that are a statement of current balance open close
		
		//types that increase amount in drawer -- owners contribution (possibly other)
				//yet to be developed cash sales between 2 open/closes
		
		//types that decrease amount in drawer -- deposit, drawer purchase (possibly other)
		
		//calculate variance by
 		//$variance = $drawercountsarray[$i]['total'] - $drawercountsarray[$i]['lastopenclose'] - $drawercountsarray[$i]['negations'];
 		//$variance = $drawercountsarray[$i]['beginbal'] - $drawercountsarray[$i]['negations'] + $drawercountsarray[$i]['contributions'] - drawercountsarray[$i]['lastopenclose'];
		
		//type = open -- drawercountsarray[1]['total'] = $100
		
		//type = drawer purchase = drawercountsarray[2]['total'] 1.07
		
		//type = drawer purchase = drawercountsarray[3]['total'] 25
		
		//type = drawer purchase = drawercountsarray[4]['total'] 126.07
		
		//looks ahead in the array

		//do{
		//for($j = $key; (($v['drawertype'] != 'open' && $v['drawertype'] != 'close') && $key < NUMBER_OF_ROWS); $k++) {
		for($i = $key; (($drawercountsarray[$i]['drawertype'] != 'open' && $drawercountsarray[$i]['drawertype'] != 'close') && $i < NUMBER_OF_ROWS); $i++) {
			echo '<br /> i is ' . $i . ' ---2222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222<br />';
			//$key++;
			//$i++;
			//$negations = 0;
			echo $v['drawertype'];
			echo ' $key of ' . $key . ' has a total of ' . $v['total'] . '<br />';
			
			//echo '<pre>' . print_r($v) . '</pre>';
			//$lastopenclose = $key[$v]['total'];
			//$lastopenclose = $key[$i]['total'];
			//$lastopenclose = $drawercountsarray[$i]['total'];
			//$lastopenclose = $total;
			//echo 'key is ' . $key . ' - lastopenclose is ' . $lastopenclose . '<br />';
			
				for($j = $i; (($drawercountsarray[$j]['drawertype'] == 'drawerpurchase' || $drawercountsarray[$j]['drawertype'] == 'ownersdraw' || $drawercountsarray[$j]['drawertype'] == 'deposit') && $j < NUMBER_OF_ROWS); $j++){
					if($drawercountsarray[$j]['negations'] == 0) {
						//$j--;
						//$i++;
						$l = 0;
						//$negations += $drawercountsarray[$i]['total'];
						echo '<br /> j is ' . $j . ' ---3333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333<br />';
						echo 'for drawertype ' . $drawercountsarray[$j]['drawertype'] . '<br />';
						echo '&nbsp;&nbsp;&nbsp; about to increase negations by ' . $v['total'] . ' from key of ' . $key . '<br />';
						$negations += $drawercountsarray[$j]['total'];
						echo '$negations is ' . $negations . '<br /><br />';
						for($k = $j; (($drawercountsarray[$k]['drawertype'] == 'drawerpurchase' || $drawercountsarray[$k]['drawertype'] == 'ownersdraw' || $drawercountsarray[$k]['drawertype'] == 'deposit') && $k >= $key);$l++, $k--){
							echo '<br /> k is ' . $k . ' key is ' . $key . '&nbsp;---444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444<br />';
							$drawercountsarray[$k]['negations'] = $negations;
							//$drawercountsarray[$j]['negations'] = $negations;
						} //end 4444444 loop
						$drawercountsarray[$j-$l]['negations'] = $negations;
					} //end if negations == 0					
					//break;
				} //end 333333333 loop
				//$key--;
				//$drawercountsarray[$key]['negations'] = $negations;
				//$key++;
				//$v['negations'] = $negations;
			
		} //end 22222222 loop
			//incase loops exits because open or close set lastopenclose
			$lastopenclose = $v['total'];
			$drawercountsarray[[$v]['dateSortOrder']]['lastopenclose'] = $negations;
			
		//} while(($key[$v]['drawertype'] != 'open' && $key[$v]['drawertype'] != 'close') && $key < NUMBER_OF_ROWS);
		//} // while(($v['drawertype'] != 'open' && $v['drawertype'] != 'close') && $key < NUMBER_OF_ROWS);
			
		$drawercountsarray[[$v][dateSortOrder]]['lastopenclose'] = $lastopenclose;
		//$drawercountsarray[[$v]['dateSortOrder']]['lastopenclose'] = $negations;

		
		if(empty([$v]['lastopenclose'])){
			//echo '<br />empty($key[$v][\'dateSortOrder\'][\'lastopenclose\']) is empty for ' . empty($key[$v]['lastopenclose']);
		}else{
			echo 'YESSSSSS ' . [$v]['lastopenclose'];
		}		
		
		//$j++;
		//$drawercountsarray[[$j][dateSortOrder]]['negations'] = $negations;
		//$drawercountsarray[$j]['negations'] = $negations;
	
	} // end foreach loop
	
		echo '<pre>drawercountsarray is ' . $i;
		print_r($drawercountsarray);
		echo '</pre>';
		
	
	
	foreach($drawercountsarray as $drawerday){
	//foreach($drawercountsarray as $drawercountday){ //how it was
		
		//$i++;
		$i = $drawerday['dateSortOrder'];
		//$index = '';
		$lastopenclose = '';
		echo '<tr>';
		//echo '<td class="id">' . $drawerday['id']. '</td>';
		echo '<td class="id">' . $drawerday['dateSortOrder']. '</td>';
		echo '<td class="drawertype">' . $drawerday['drawertype']. '</td>';
		$dayofweek = date('w', strtotime($drawerday['drawerdate']));
		$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');
		echo '<td class="date"> <div class="date" style="text-align: left; width:50px;">' . $days[$dayofweek] . '</div>           <div class="date"> ' . zen_datetime_long($drawerday['drawerdate']). '</div></td>';
		//$dayofweek = date('w', strtotime($drawerday['drawerdate']));
		//$dayofweek    = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));
		echo '<td class="billnums nums" id="two">' . $drawerday['twos']. '</td>';
		echo '<td class="billnums nums" id="hun">' . $drawerday['hundos']. '</td>';
		echo '<td class="billnums nums" id="fif">' . $drawerday['fifties']. '</td>';
		echo '<td class="billnums nums" id="twen">' . $drawerday['twenties']. '</td>';
		echo '<td class="billnums nums" id="te">' . $drawerday['tens']. '</td>';
		echo '<td class="billnums nums" id="fiv">' . $drawerday['fives']. '</td>';
		echo '<td class="billnums nums" id="one">' . $drawerday['ones']. '</td>';
		echo '<td class="nums" id="qr">' . $drawerday['qrolls']. '</td>';
		echo '<td class="nums" id="dr">' . $drawerday['drolls']. '</td>';
		echo '<td class="nums" id="nr">' . $drawerday['nrolls']. '</td>';
		echo '<td class="nums" id="pr">' . $drawerday['prolls']. '</td>';
		echo '<td class="coinnums nums" id="od">' . $drawerday['odcoins']. '</td>';
		echo '<td class="coinnums nums" id="hd">' . $drawerday['hdcoins']. '</td>';
		echo '<td class="coinnums nums" id="qc">' . $drawerday['qcoins']. '</td>';
		echo '<td class="coinnums nums" id="dc">' . $drawerday['dcoins']. '</td>';
		echo '<td class="coinnums nums" id="nc">' . $drawerday['ncoins']. '</td>';
		echo '<td class="coinnums nums" id="pc">' . $drawerday['pcoins']. '</td>';
		echo '<td id="tot">' . $drawerday['total']. '</td>';
		echo '<td id="initals">' . $drawerday['initials']. '</td>';
		echo '<td id="com">' . $drawerday['comments']. '</td>';
		
		$variance = $drawercountsarray[$i]['total'] - $drawercountsarray[$i]['lastopenclose'] - $drawercountsarray[$i]['negations'];
		
		$drawercountsarray[$dateSortOrder]['variance'] = $variance;
		
		echo '<td id="variance" bordercolor = "white">';
	if($drawerday['drawertype'] == 'open' || $drawerday['drawertype'] == 'close'){
			echo '<div class="variance">' . sprintf("% 8.2f", $drawercountsarray[$i]['total']) . '</div>' .				
				' - <div class="variance">' . sprintf("% 8.2f", $drawercountsarray[$i]['lastopenclose']) .  '</div>' .
				' - <div class="variance">' . sprintf("% 8.2f", $drawercountsarray[$i]['negations']) .  '</div>' .
				' = <div class="variance">' . sprintf("% 8.2f", $variance) . '</div>';	
		echo '<td>last open/close amt</td>';
	}
	echo '</td>';
		$dayinquestion = strtotime($drawerday['drawerdate']);
		$dayinquestion = date("Y-m-d", strtotime($drawerday['drawerdate']));
		echo '</tr>';
	}

echo '<tr><td></td><td colspan = "100%">Brian moved the input fields to the top (first row of this table; below the headers)</td></tr>';


//print_r($dayinquestion);

?>
  </tr>
 
<!-- body_text_eof //-->
  </tr>


<?php
//echo '<td>' . zen_draw_input_field('total_field', '0', 'length="8"') . '</td>';

?>
  </tbody>
</table>
<!-- body_eof //-->
<?php
/*echo 'drawercountsarray 2 total is ' . $drawercountsarray[2]['total'];
echo '<pre>eachDrawerDateArray: ';
print_r($eachDrawerDateArray);
echo '</pre>';*/

?>

<style>
    .table {
        display: block;
        max-width: 100%;
		align: center;
		padding: 0px;
		vertical-align: middle;
		overflow: scroll; <!-- Available options: visible, hidden, scroll, auto -->
    }
	table, td{
		vertical-align: middle !important;
	}
	table, td.pageHeading.dateinput {
		font-size:9px !important;
		max-width: 2.6%
	}
	.pageHeading {
		background: lightgrey;
	}
	.content{
		overflow: auto;
	}
	.id{
		padding: 0px !important;
		max-width: 1%;
	}
	.drawertype{
		max-width: 4%;
	}
	.date {
		padding: 0px !important;		
	}

	.dateinputcell{
		padding: 0px !important;
		padding-top: 8px !important;

	}
	.dateinput{
		vertical-align: middle !important;
	}
	.bills {
		padding: 0px !important;
		max-width: 4%;
		color: green;
	}
	.coinrolls {
		padding: 0px !important;
		max-width: 4%;
	}
	.coins {
		padding: 0px !important;
		max-width: 4%
	}
	.numinputs{
		padding: 0px !important;
		text-align: center;
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
		max-width: 4%;
	}
	div.variance{
		width: 40px;
		display: inline-table;
		text-align: right;
	}
	div.date{
		display: inline-table;
		text-align: right;
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