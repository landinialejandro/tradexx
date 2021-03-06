<?php

// Data functions (insert, update, delete, form) for table Status

// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

function Status_insert() {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('Status');
	if(!$arrPerm[1]) return false;

	$data = array();
	$data['TrackID'] = $_REQUEST['Tracking'];
		if($data['TrackID'] == empty_lookup_value) { $data['TrackID'] = ''; }
	$data['Invoice'] = $_REQUEST['Invoice'];
		if($data['Invoice'] == empty_lookup_value) { $data['Invoice'] = ''; }
	$data['Tracking'] = $_REQUEST['Tracking'];
		if($data['Tracking'] == empty_lookup_value) { $data['Tracking'] = ''; }
	$data['Dimensions'] = $_REQUEST['Tracking'];
		if($data['Dimensions'] == empty_lookup_value) { $data['Dimensions'] = ''; }
	$data['RWeight'] = $_REQUEST['Tracking'];
		if($data['RWeight'] == empty_lookup_value) { $data['RWeight'] = ''; }
	$data['VWeight'] = $_REQUEST['Tracking'];
		if($data['VWeight'] == empty_lookup_value) { $data['VWeight'] = ''; }
	$data['Total'] = $_REQUEST['Tracking'];
		if($data['Total'] == empty_lookup_value) { $data['Total'] = ''; }
	$data['FreightType'] = $_REQUEST['FreightType'];
		if($data['FreightType'] == empty_lookup_value) { $data['FreightType'] = ''; }
	$data['DeliveryDate'] = mysql_datetime($_REQUEST['DeliveryDate']);
		if($data['DeliveryDate'] == empty_lookup_value) { $data['DeliveryDate'] = ''; }
	$data['Delivered'] = $_REQUEST['Delivered'];
		if($data['Delivered'] == empty_lookup_value) { $data['Delivered'] = ''; }
	if($data['FreightType']== '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Freight Type': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}

	// hook: Status_before_insert
	if(function_exists('Status_before_insert')) {
		$args = array();
		if(!Status_before_insert($data, getMemberInfo(), $args)) { return false; }
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('Status', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// automatic TrackID if passed as filterer
	if($_REQUEST['filterer_TrackID']) {
		sql("update `Status` set `TrackID`='" . makeSafe($_REQUEST['filterer_TrackID']) . "' where `id`='" . makeSafe($recID, false) . "'", $eo);
	}

	// automatic Invoice if passed as filterer
	if($_REQUEST['filterer_Invoice']) {
		sql("update `Status` set `Invoice`='" . makeSafe($_REQUEST['filterer_Invoice']) . "' where `id`='" . makeSafe($recID, false) . "'", $eo);
	}

	// hook: Status_after_insert
	if(function_exists('Status_after_insert')) {
		$res = sql("select * from `Status` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!Status_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('Status', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) Status_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function Status_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = array(); // array of curl handlers for launching insert requests
	$eo = array('silentErrors' => true);
	$uploads_dir = realpath(dirname(__FILE__) . '/../' . $Translation['ImageFolder']);
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function Status_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('Status');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Status' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Status' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: Status_before_delete
	if(function_exists('Status_before_delete')) {
		$args=array();
		if(!Status_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `Status` where `id`='$selected_id'", $eo);

	// hook: Status_after_delete
	if(function_exists('Status_after_delete')) {
		$args=array();
		Status_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='Status' and pkValue='$selected_id'", $eo);
}

function Status_update($selected_id) {
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('Status');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Status' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Status' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) { // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['TrackID'] = makeSafe($_REQUEST['Tracking']);
		if($data['TrackID'] == empty_lookup_value) { $data['TrackID'] = ''; }
	$data['Invoice'] = makeSafe($_REQUEST['Invoice']);
		if($data['Invoice'] == empty_lookup_value) { $data['Invoice'] = ''; }
	$data['Tracking'] = makeSafe($_REQUEST['Tracking']);
		if($data['Tracking'] == empty_lookup_value) { $data['Tracking'] = ''; }
	$data['Dimensions'] = makeSafe($_REQUEST['Tracking']);
		if($data['Dimensions'] == empty_lookup_value) { $data['Dimensions'] = ''; }
	$data['RWeight'] = makeSafe($_REQUEST['Tracking']);
		if($data['RWeight'] == empty_lookup_value) { $data['RWeight'] = ''; }
	$data['VWeight'] = makeSafe($_REQUEST['Tracking']);
		if($data['VWeight'] == empty_lookup_value) { $data['VWeight'] = ''; }
	$data['Total'] = makeSafe($_REQUEST['Tracking']);
		if($data['Total'] == empty_lookup_value) { $data['Total'] = ''; }
	$data['FreightType'] = makeSafe($_REQUEST['FreightType']);
		if($data['FreightType'] == empty_lookup_value) { $data['FreightType'] = ''; }
	if($data['FreightType']=='') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Freight Type': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['DeliveryDate'] = mysql_datetime($_REQUEST['DeliveryDate']);
		if($data['DeliveryDate'] == empty_lookup_value) { $data['DeliveryDate'] = ''; }
	$data['Delivered'] = makeSafe($_REQUEST['Delivered']);
		if($data['Delivered'] == empty_lookup_value) { $data['Delivered'] = ''; }
	$data['selectedID'] = makeSafe($selected_id);

	// hook: Status_before_update
	if(function_exists('Status_before_update')) {
		$args = array();
		if(!Status_before_update($data, getMemberInfo(), $args)) { return false; }
	}

	$o = array('silentErrors' => true);
	sql('update `Status` set       `Tracking`=' . (($data['Tracking'] !== '' && $data['Tracking'] !== NULL) ? "'{$data['Tracking']}'" : 'NULL') . ', `Dimensions`=' . (($data['Dimensions'] !== '' && $data['Dimensions'] !== NULL) ? "'{$data['Dimensions']}'" : 'NULL') . ', `RWeight`=' . (($data['RWeight'] !== '' && $data['RWeight'] !== NULL) ? "'{$data['RWeight']}'" : 'NULL') . ', `VWeight`=' . (($data['VWeight'] !== '' && $data['VWeight'] !== NULL) ? "'{$data['VWeight']}'" : 'NULL') . ', `Total`=' . (($data['Total'] !== '' && $data['Total'] !== NULL) ? "'{$data['Total']}'" : 'NULL') . ', `FreightType`=' . (($data['FreightType'] !== '' && $data['FreightType'] !== NULL) ? "'{$data['FreightType']}'" : 'NULL') . ', `DeliveryDate`=' . (($data['DeliveryDate'] !== '' && $data['DeliveryDate'] !== NULL) ? "'{$data['DeliveryDate']}'" : 'NULL') . ', `Delivered`=' . (($data['Delivered'] !== '' && $data['Delivered'] !== NULL) ? "'{$data['Delivered']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!='') {
		echo $o['error'];
		echo '<a href="Status_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: Status_after_update
	if(function_exists('Status_after_update')) {
		$res = sql("SELECT * FROM `Status` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!Status_after_update($data, getMemberInfo(), $args)) { return; }
	}

	// mm: update ownership data
	sql("update `membership_userrecords` set `dateUpdated`='" . time() . "' where `tableName`='Status' and `pkValue`='" . makeSafe($selected_id) . "'", $eo);

}

function Status_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('Status');
	if(!$arrPerm[1] && $selected_id=='') { return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_Invoice = thisOr(undo_magic_quotes($_REQUEST['filterer_Invoice']), '');
	$filterer_Tracking = thisOr(undo_magic_quotes($_REQUEST['filterer_Tracking']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: Invoice
	$combo_Invoice = new DataCombo;
	// combobox: Tracking
	$combo_Tracking = new DataCombo;
	// combobox: FreightType
	$combo_FreightType = new Combo;
	$combo_FreightType->ListType = 0;
	$combo_FreightType->MultipleSeparator = ', ';
	$combo_FreightType->ListBoxHeight = 10;
	$combo_FreightType->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/Status.FreightType.csv')) {
		$FreightType_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/Status.FreightType.csv')));
		$combo_FreightType->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($FreightType_data)));
		$combo_FreightType->ListData = $combo_FreightType->ListItem;
	}else{
		$combo_FreightType->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions(";;AIR FREIGHT;;OCEAN FREIGHT")));
		$combo_FreightType->ListData = $combo_FreightType->ListItem;
	}
	$combo_FreightType->SelectName = 'FreightType';
	$combo_FreightType->AllowNull = false;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm[2]) {
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Status' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Status' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID) {
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID) {
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) {
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("SELECT * FROM `Status` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'Status_view.php', false);
		}
		$combo_Invoice->SelectedData = $row['Invoice'];
		$combo_Tracking->SelectedData = $row['Tracking'];
		$combo_FreightType->SelectedData = $row['FreightType'];
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	} else {
		$combo_Invoice->SelectedData = $filterer_Invoice;
		$combo_Tracking->SelectedData = $filterer_Tracking;
		$combo_FreightType->SelectedText = ( $_REQUEST['FilterField'][1]=='9' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
	}
	$combo_Invoice->HTML = '<span id="Invoice-container' . $rnd1 . '"></span><input type="hidden" name="Invoice" id="Invoice' . $rnd1 . '" value="' . html_attr($combo_Invoice->SelectedData) . '">';
	$combo_Invoice->MatchText = '<span id="Invoice-container-readonly' . $rnd1 . '"></span><input type="hidden" name="Invoice" id="Invoice' . $rnd1 . '" value="' . html_attr($combo_Invoice->SelectedData) . '">';
	$combo_Tracking->HTML = '<span id="Tracking-container' . $rnd1 . '"></span><input type="hidden" name="Tracking" id="Tracking' . $rnd1 . '" value="' . html_attr($combo_Tracking->SelectedData) . '">';
	$combo_Tracking->MatchText = '<span id="Tracking-container-readonly' . $rnd1 . '"></span><input type="hidden" name="Tracking" id="Tracking' . $rnd1 . '" value="' . html_attr($combo_Tracking->SelectedData) . '">';
	$combo_FreightType->Render();

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_Invoice__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['Invoice'] : $filterer_Invoice); ?>"};
		AppGini.current_Tracking__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['Tracking'] : $filterer_Tracking); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(Invoice_reload__RAND__) == 'function') Invoice_reload__RAND__();
				if(typeof(Tracking_reload__RAND__) == 'function') Tracking_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function Invoice_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#Invoice-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_Invoice__RAND__.value, t: 'Status', f: 'Invoice' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="Invoice"]').val(resp.results[0].id);
							$j('[id=Invoice-container-readonly__RAND__]').html('<span id="Invoice-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Invoice_view_parent]').hide(); }else{ $j('.btn[id=Invoice_view_parent]').show(); }


							if(typeof(Invoice_update_autofills__RAND__) == 'function') Invoice_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { /* */ return { s: term, p: page, t: 'Status', f: 'Invoice' }; },
					results: function(resp, page) { /* */ return resp; }
				},
				escapeMarkup: function(str) { /* */ return str; }
			}).on('change', function(e) {
				AppGini.current_Invoice__RAND__.value = e.added.id;
				AppGini.current_Invoice__RAND__.text = e.added.text;
				$j('[name="Invoice"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Invoice_view_parent]').hide(); }else{ $j('.btn[id=Invoice_view_parent]').show(); }


				if(typeof(Invoice_update_autofills__RAND__) == 'function') Invoice_update_autofills__RAND__();
			});

			if(!$j("#Invoice-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_Invoice__RAND__.value, t: 'Status', f: 'Invoice' },
					success: function(resp) {
						$j('[name="Invoice"]').val(resp.results[0].id);
						$j('[id=Invoice-container-readonly__RAND__]').html('<span id="Invoice-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Invoice_view_parent]').hide(); }else{ $j('.btn[id=Invoice_view_parent]').show(); }

						if(typeof(Invoice_update_autofills__RAND__) == 'function') Invoice_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_Invoice__RAND__.value, t: 'Status', f: 'Invoice' },
				success: function(resp) {
					$j('[id=Invoice-container__RAND__], [id=Invoice-container-readonly__RAND__]').html('<span id="Invoice-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Invoice_view_parent]').hide(); }else{ $j('.btn[id=Invoice_view_parent]').show(); }

					if(typeof(Invoice_update_autofills__RAND__) == 'function') Invoice_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function Tracking_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#Tracking-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_Tracking__RAND__.value, t: 'Status', f: 'Tracking' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="Tracking"]').val(resp.results[0].id);
							$j('[id=Tracking-container-readonly__RAND__]').html('<span id="Tracking-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Tracking_view_parent]').hide(); }else{ $j('.btn[id=Tracking_view_parent]').show(); }


							if(typeof(Tracking_update_autofills__RAND__) == 'function') Tracking_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { /* */ return { s: term, p: page, t: 'Status', f: 'Tracking' }; },
					results: function(resp, page) { /* */ return resp; }
				},
				escapeMarkup: function(str) { /* */ return str; }
			}).on('change', function(e) {
				AppGini.current_Tracking__RAND__.value = e.added.id;
				AppGini.current_Tracking__RAND__.text = e.added.text;
				$j('[name="Tracking"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Tracking_view_parent]').hide(); }else{ $j('.btn[id=Tracking_view_parent]').show(); }


				if(typeof(Tracking_update_autofills__RAND__) == 'function') Tracking_update_autofills__RAND__();
			});

			if(!$j("#Tracking-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_Tracking__RAND__.value, t: 'Status', f: 'Tracking' },
					success: function(resp) {
						$j('[name="Tracking"]').val(resp.results[0].id);
						$j('[id=Tracking-container-readonly__RAND__]').html('<span id="Tracking-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Tracking_view_parent]').hide(); }else{ $j('.btn[id=Tracking_view_parent]').show(); }

						if(typeof(Tracking_update_autofills__RAND__) == 'function') Tracking_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_Tracking__RAND__.value, t: 'Status', f: 'Tracking' },
				success: function(resp) {
					$j('[id=Tracking-container__RAND__], [id=Tracking-container-readonly__RAND__]').html('<span id="Tracking-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Tracking_view_parent]').hide(); }else{ $j('.btn[id=Tracking_view_parent]').show(); }

					if(typeof(Tracking_update_autofills__RAND__) == 'function') Tracking_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/Status_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/Status_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Product details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return Status_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return Status_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return Status_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly .= "\tjQuery('#Tracking').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#Tracking_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#FreightType').replaceWith('<div class=\"form-control-static\" id=\"FreightType\">' + (jQuery('#FreightType').val() || '') + '</div>'); jQuery('#FreightType-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('#DeliveryDate').parents('.input-group').replaceWith('<div class=\"form-control-static\" id=\"DeliveryDate\">' + (jQuery('#DeliveryDate').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#Delivered').prop('disabled', true);\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert) {
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
		$locale = isset($Translation['datetimepicker locale']) ? ", locale: '{$Translation['datetimepicker locale']}'" : '';
		$jsEditable .= "\tjQuery('#DeliveryDate').addClass('always_shown').parents('.input-group').datetimepicker({ toolbarPlacement: 'top', sideBySide: true, showClear: true, showTodayButton: true, showClose: true, icons: { close: 'glyphicon glyphicon-ok' }, format: AppGini.datetimeFormat('dt') {$locale} });";
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(Invoice)%%>', $combo_Invoice->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Invoice)%%>', $combo_Invoice->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(Invoice)%%>', urlencode($combo_Invoice->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(Tracking)%%>', $combo_Tracking->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Tracking)%%>', $combo_Tracking->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(Tracking)%%>', urlencode($combo_Tracking->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(FreightType)%%>', $combo_FreightType->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(FreightType)%%>', $combo_FreightType->SelectedData, $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('Invoice' => array('Invoice', 'Invoice'), 'Tracking' => array('Tracking', 'Freight'), );
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Invoice)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Tracking)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(FreightType)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(DeliveryDate)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Delivered)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Invoice)%%>', safe_html($urow['Invoice']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Invoice)%%>', html_attr($row['Invoice']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Invoice)%%>', urlencode($urow['Invoice']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Tracking)%%>', safe_html($urow['Tracking']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Tracking)%%>', html_attr($row['Tracking']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Tracking)%%>', urlencode($urow['Tracking']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(FreightType)%%>', safe_html($urow['FreightType']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(FreightType)%%>', html_attr($row['FreightType']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(FreightType)%%>', urlencode($urow['FreightType']), $templateCode);
		$templateCode = str_replace('<%%VALUE(DeliveryDate)%%>', app_datetime($row['DeliveryDate'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(DeliveryDate)%%>', urlencode(app_datetime($urow['DeliveryDate'], 'dt')), $templateCode);
		$templateCode = str_replace('<%%CHECKED(Delivered)%%>', ($row['Delivered'] ? "checked" : ""), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Invoice)%%>', ( $_REQUEST['FilterField'][1]=='3' && $_REQUEST['FilterOperator'][1]=='<=>' ? $combo_Invoice->SelectedData : ''), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Invoice)%%>', urlencode( $_REQUEST['FilterField'][1]=='3' && $_REQUEST['FilterOperator'][1]=='<=>' ? $combo_Invoice->SelectedData : ''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Tracking)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Tracking)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(FreightType)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(FreightType)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(DeliveryDate)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(DeliveryDate)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%CHECKED(Delivered)%%>', '', $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans) {
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';

	$templateCode .= "\tTracking_update_autofills$rnd1 = function() {\n";
	$templateCode .= "\t\t\$j.ajax({\n";
	if($dvprint) {
		$templateCode .= "\t\t\turl: 'Status_autofill.php?rnd1=$rnd1&mfk=Tracking&id=' + encodeURIComponent('".addslashes($row['Tracking'])."'),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET'\n";
	} else {
		$templateCode .= "\t\t\turl: 'Status_autofill.php?rnd1=$rnd1&mfk=Tracking&id=' + encodeURIComponent(AppGini.current_Tracking{$rnd1}.value),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "',\n";
		$templateCode .= "\t\t\ttype: 'GET',\n";
		$templateCode .= "\t\t\tbeforeSend: function() { \$j('#Tracking$rnd1').prop('disabled', true); \$j('#TrackingLoading').html('<img src=loading.gif align=top>'); },\n";
		$templateCode .= "\t\t\tcomplete: function() { " . (($arrPerm[1] || (($arrPerm[3] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm[3] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm[3] == 3)) ? "\$j('#Tracking$rnd1').prop('disabled', false); " : "\$j('#Tracking$rnd1').prop('disabled', true); ")."\$j('#TrackingLoading').html(''); \$j(window).resize(); }\n";
	}
	$templateCode .= "\t\t});\n";
	$templateCode .= "\t};\n";
	if(!$dvprint) $templateCode .= "\tif(\$j('#Tracking_caption').length) \$j('#Tracking_caption').click(function() { /* */ Tracking_update_autofills$rnd1(); });\n";


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('Status');
	if($selected_id) {
		$jdata = get_joined_record('Status', $selected_id);
		if($jdata === false) $jdata = get_defaults('Status');
		$rdata = $row;
	}
	$templateCode .= loadView('Status-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: Status_dv
	if(function_exists('Status_dv')) {
		$args=array();
		Status_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>