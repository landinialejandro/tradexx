<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Payroll.php");
	include("$currDir/Payroll_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Payroll');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Payroll";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Payroll`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Employee */" => "employee",
		"if(`Payroll`.`date`,date_format(`Payroll`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Payroll`.`start`" => "start",
		"`Payroll`.`stop`" => "stop",
		"`Payroll`.`horas`" => "horas",
		"`Payroll`.`comment`" => "comment",
		"`Payroll`.`value`" => "value",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Payroll`.`id`',
		2 => '`Staff1`.`Employee`',
		3 => '`Payroll`.`date`',
		4 => 4,
		5 => 5,
		6 => '`Payroll`.`horas`',
		7 => 7,
		8 => 8,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Payroll`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Employee */" => "employee",
		"if(`Payroll`.`date`,date_format(`Payroll`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Payroll`.`start`" => "start",
		"`Payroll`.`stop`" => "stop",
		"`Payroll`.`horas`" => "horas",
		"`Payroll`.`comment`" => "comment",
		"`Payroll`.`value`" => "value",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Payroll`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Employee */" => "Employee",
		"`Payroll`.`date`" => "Date",
		"`Payroll`.`start`" => "Start",
		"`Payroll`.`stop`" => "Stop",
		"`Payroll`.`horas`" => "horas",
		"`Payroll`.`comment`" => "Comment",
		"`Payroll`.`value`" => "Value",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Payroll`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Staff1`.`Employee`), CONCAT_WS('',   `Staff1`.`Employee`), '') /* Employee */" => "employee",
		"if(`Payroll`.`date`,date_format(`Payroll`.`date`,'%m/%d/%Y'),'')" => "date",
		"`Payroll`.`start`" => "start",
		"`Payroll`.`stop`" => "stop",
		"`Payroll`.`horas`" => "horas",
		"`Payroll`.`comment`" => "comment",
		"`Payroll`.`value`" => "value",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('employee' => 'Employee', );

	$x->QueryFrom = "`Payroll` LEFT JOIN `Staff` as Staff1 ON `Staff1`.`id`=`Payroll`.`employee` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 300;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "Payroll_view.php";
	$x->RedirectAfterInsert = "Payroll_view.php?SelectedID=#ID#";
	$x->TableTitle = "PAYROLL";
	$x->TableIcon = "resources/table_icons/Subscriptions.png";
	$x->PrimaryKey = "`Payroll`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Employee", "Date", "Start", "Stop", "horas", "Comment");
	$x->ColFieldName = array('employee', 'date', 'start', 'stop', 'horas', 'comment');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Payroll_templateTV.html';
	$x->SelectedTemplate = 'templates/Payroll_templateTVS.html';
	$x->TemplateDV = 'templates/Payroll_templateDV.html';
	$x->TemplateDVP = 'templates/Payroll_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = false;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Payroll`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Payroll' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Payroll`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Payroll' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Payroll`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Payroll_init
	$render=TRUE;
	if(function_exists('Payroll_init')) {
		$args=array();
		$render=Payroll_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')) {
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])) {
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id) {   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != '') {
				$QueryWhere = 'where `Payroll`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select sum(`Payroll`.`horas`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Payroll-employee"></td>';
			$sumRow .= '<td class="Payroll-date"></td>';
			$sumRow .= '<td class="Payroll-start"></td>';
			$sumRow .= '<td class="Payroll-stop"></td>';
			$sumRow .= "<td class=\"Payroll-horas text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="Payroll-comment"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Payroll_header
	$headerCode='';
	if(function_exists('Payroll_header')) {
		$args=array();
		$headerCode=Payroll_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Payroll_footer
	$footerCode='';
	if(function_exists('Payroll_footer')) {
		$args=array();
		$footerCode=Payroll_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>