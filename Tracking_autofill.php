<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('Tracking');
	if(!$table_perms[0]) { die('// Access denied!'); }

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'Warehouse':
			if(!$id) {
				?>
				$j('#WhID<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#Date<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#Freight<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `Warehouse`.`id` as 'id', `Warehouse`.`Warehouse` as 'Warehouse', if(`Warehouse`.`Date`,date_format(`Warehouse`.`Date`,'%m/%d/%Y'),'') as 'Date', `Warehouse`.`Freight` as 'Freight' FROM `Warehouse`  WHERE `Warehouse`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#WhID<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['id']))); ?>&nbsp;');
			$j('#Date<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Date']))); ?>&nbsp;');
			$j('#Freight<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Freight']))); ?>&nbsp;');
			<?php
			break;

		case 'Customer':
			if(!$id) {
				?>
				$j('#Zone<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `Customers`.`id` as 'id', `Customers`.`Title` as 'Title', `Customers`.`Customer` as 'Customer', if(`Customers`.`Birthdate`,date_format(`Customers`.`Birthdate`,'%m/%d/%Y'),'') as 'Birthdate', IF(    CHAR_LENGTH(`CustomerClass1`.`Type`), CONCAT_WS('',   `CustomerClass1`.`Type`), '') as 'Type', `Customers`.`Phone` as 'Phone', `Customers`.`Email` as 'Email', `Customers`.`Address` as 'Address', IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') as 'City', IF(    CHAR_LENGTH(`Province1`.`Province`), CONCAT_WS('',   `Province1`.`Province`), '') as 'Province', IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') as 'Country', `Customers`.`Status` as 'Status' FROM `Customers` LEFT JOIN `CustomerClass` as CustomerClass1 ON `CustomerClass1`.`id`=`Customers`.`Type` LEFT JOIN `City` as City1 ON `City1`.`id`=`Customers`.`City` LEFT JOIN `Province` as Province1 ON `Province1`.`id`=`Customers`.`Province` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Customers`.`Country`  WHERE `Customers`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#Zone<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Province']))); ?>&nbsp;');
			<?php
			break;


	}

?>