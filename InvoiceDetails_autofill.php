<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('InvoiceDetails');
	if(!$table_perms[0]) { die('// Access denied!'); }

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'product':
			if(!$id) {
				?>
				$j('#itemSale<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `Products`.`id` as 'id', `Products`.`code` as 'code', `Products`.`item` as 'item', `Products`.`cost` as 'cost', `Products`.`profit` as 'profit', `Products`.`itemSale` as 'itemSale', `Products`.`uploads` as 'uploads' FROM `Products`  WHERE `Products`.`id`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#itemSale<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['itemSale']))); ?>&nbsp;');
			<?php
			break;


	}

?>