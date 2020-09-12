<?php

// Data functions (insert, update, delete, form) for table Account

// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

function Account_insert() {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('Account');
	if(!$arrPerm[1]) return false;

	$data = array();
	$data['Account'] = $_REQUEST['Account'];
		if($data['Account'] == empty_lookup_value) { $data['Account'] = ''; }
	$data['masterAccount'] = $_REQUEST['masterAccount'];
		if($data['masterAccount'] == empty_lookup_value) { $data['masterAccount'] = ''; }
	$data['code'] = $_REQUEST['code'];
		if($data['code'] == empty_lookup_value) { $data['code'] = ''; }

	// hook: Account_before_insert
	if(function_exists('Account_before_insert')) {
		$args = array();
		if(!Account_before_insert($data, getMemberInfo(), $args)) { return false; }
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('Account', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// hook: Account_after_insert
	if(function_exists('Account_after_insert')) {
		$res = sql("select * from `Account` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!Account_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('Account', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) Account_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function Account_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = array(); // array of curl handlers for launching insert requests
	$eo = array('silentErrors' => true);
	$uploads_dir = realpath(dirname(__FILE__) . '/../' . $Translation['ImageFolder']);
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function Account_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('Account');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Account' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Account' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: Account_before_delete
	if(function_exists('Account_before_delete')) {
		$args=array();
		if(!Account_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: AccountPlan
	$res = sql("select `id` from `Account` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `AccountPlan` where `account`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "AccountPlan", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "AccountPlan", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='Account_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='Account_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	// child table: SubAccount
	$res = sql("select `id` from `Account` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `SubAccount` where `account`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "SubAccount", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks) {
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "SubAccount", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='Account_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='Account_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `Account` where `id`='$selected_id'", $eo);

	// hook: Account_after_delete
	if(function_exists('Account_after_delete')) {
		$args=array();
		Account_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='Account' and pkValue='$selected_id'", $eo);
}

function Account_update($selected_id) {
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('Account');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Account' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Account' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) { // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['Account'] = makeSafe($_REQUEST['Account']);
		if($data['Account'] == empty_lookup_value) { $data['Account'] = ''; }
	$data['masterAccount'] = makeSafe($_REQUEST['masterAccount']);
		if($data['masterAccount'] == empty_lookup_value) { $data['masterAccount'] = ''; }
	$data['code'] = makeSafe($_REQUEST['code']);
		if($data['code'] == empty_lookup_value) { $data['code'] = ''; }
	$data['selectedID'] = makeSafe($selected_id);

	// hook: Account_before_update
	if(function_exists('Account_before_update')) {
		$args = array();
		if(!Account_before_update($data, getMemberInfo(), $args)) { return false; }
	}

	$o = array('silentErrors' => true);
	sql('update `Account` set       `Account`=' . (($data['Account'] !== '' && $data['Account'] !== NULL) ? "'{$data['Account']}'" : 'NULL') . ', `masterAccount`=' . (($data['masterAccount'] !== '' && $data['masterAccount'] !== NULL) ? "'{$data['masterAccount']}'" : 'NULL') . ', `code`=' . (($data['code'] !== '' && $data['code'] !== NULL) ? "'{$data['code']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!='') {
		echo $o['error'];
		echo '<a href="Account_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: Account_after_update
	if(function_exists('Account_after_update')) {
		$res = sql("SELECT * FROM `Account` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!Account_after_update($data, getMemberInfo(), $args)) { return; }
	}

	// mm: update ownership data
	sql("update `membership_userrecords` set `dateUpdated`='" . time() . "' where `tableName`='Account' and `pkValue`='" . makeSafe($selected_id) . "'", $eo);

}

function Account_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('Account');
	if(!$arrPerm[1] && $selected_id=='') { return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_masterAccount = thisOr(undo_magic_quotes($_REQUEST['filterer_masterAccount']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: masterAccount
	$combo_masterAccount = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm[2]) {
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Account' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Account' and pkValue='".makeSafe($selected_id)."'");
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

		$res = sql("SELECT * FROM `Account` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'Account_view.php', false);
		}
		$combo_masterAccount->SelectedData = $row['masterAccount'];
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	} else {
		$combo_masterAccount->SelectedData = $filterer_masterAccount;
	}
	$combo_masterAccount->HTML = '<span id="masterAccount-container' . $rnd1 . '"></span><input type="hidden" name="masterAccount" id="masterAccount' . $rnd1 . '" value="' . html_attr($combo_masterAccount->SelectedData) . '">';
	$combo_masterAccount->MatchText = '<span id="masterAccount-container-readonly' . $rnd1 . '"></span><input type="hidden" name="masterAccount" id="masterAccount' . $rnd1 . '" value="' . html_attr($combo_masterAccount->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_masterAccount__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['masterAccount'] : $filterer_masterAccount); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(masterAccount_reload__RAND__) == 'function') masterAccount_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function masterAccount_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#masterAccount-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_masterAccount__RAND__.value, t: 'Account', f: 'masterAccount' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="masterAccount"]').val(resp.results[0].id);
							$j('[id=masterAccount-container-readonly__RAND__]').html('<span id="masterAccount-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=MasterAccount_view_parent]').hide(); }else{ $j('.btn[id=MasterAccount_view_parent]').show(); }


							if(typeof(masterAccount_update_autofills__RAND__) == 'function') masterAccount_update_autofills__RAND__();
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
					data: function(term, page) { /* */ return { s: term, p: page, t: 'Account', f: 'masterAccount' }; },
					results: function(resp, page) { /* */ return resp; }
				},
				escapeMarkup: function(str) { /* */ return str; }
			}).on('change', function(e) {
				AppGini.current_masterAccount__RAND__.value = e.added.id;
				AppGini.current_masterAccount__RAND__.text = e.added.text;
				$j('[name="masterAccount"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=MasterAccount_view_parent]').hide(); }else{ $j('.btn[id=MasterAccount_view_parent]').show(); }


				if(typeof(masterAccount_update_autofills__RAND__) == 'function') masterAccount_update_autofills__RAND__();
			});

			if(!$j("#masterAccount-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_masterAccount__RAND__.value, t: 'Account', f: 'masterAccount' },
					success: function(resp) {
						$j('[name="masterAccount"]').val(resp.results[0].id);
						$j('[id=masterAccount-container-readonly__RAND__]').html('<span id="masterAccount-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=MasterAccount_view_parent]').hide(); }else{ $j('.btn[id=MasterAccount_view_parent]').show(); }

						if(typeof(masterAccount_update_autofills__RAND__) == 'function') masterAccount_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_masterAccount__RAND__.value, t: 'Account', f: 'masterAccount' },
				success: function(resp) {
					$j('[id=masterAccount-container__RAND__], [id=masterAccount-container-readonly__RAND__]').html('<span id="masterAccount-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=MasterAccount_view_parent]').hide(); }else{ $j('.btn[id=MasterAccount_view_parent]').show(); }

					if(typeof(masterAccount_update_autofills__RAND__) == 'function') masterAccount_update_autofills__RAND__();
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
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/Account_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/Account_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'ACCOUNT details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return Account_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return Account_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
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
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return Account_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
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
		$jsReadOnly .= "\tjQuery('#Account').replaceWith('<div class=\"form-control-static\" id=\"Account\">' + (jQuery('#Account').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#masterAccount').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#masterAccount_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#code').replaceWith('<div class=\"form-control-static\" id=\"code\">' + (jQuery('#code').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert) {
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(masterAccount)%%>', $combo_masterAccount->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(masterAccount)%%>', $combo_masterAccount->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(masterAccount)%%>', urlencode($combo_masterAccount->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('masterAccount' => array('MasterAccount', 'Master account'), );
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
	$templateCode = str_replace('<%%UPLOADFILE(Account)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(masterAccount)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(code)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Account)%%>', safe_html($urow['Account']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Account)%%>', html_attr($row['Account']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Account)%%>', urlencode($urow['Account']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(masterAccount)%%>', safe_html($urow['masterAccount']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(masterAccount)%%>', html_attr($row['masterAccount']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(masterAccount)%%>', urlencode($urow['masterAccount']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(code)%%>', safe_html($urow['code']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(code)%%>', html_attr($row['code']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(code)%%>', urlencode($urow['code']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Account)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Account)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(masterAccount)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(masterAccount)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(code)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(code)%%>', urlencode(''), $templateCode);
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


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('Account');
	if($selected_id) {
		$jdata = get_joined_record('Account', $selected_id);
		if($jdata === false) $jdata = get_defaults('Account');
		$rdata = $row;
	}
	$templateCode .= loadView('Account-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: Account_dv
	if(function_exists('Account_dv')) {
		$args=array();
		Account_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>