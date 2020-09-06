<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Invoice.php");
	include("$currDir/Invoice_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Invoice');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Invoice";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`Invoice`.`id`" => "id",
		"`Invoice`.`type`" => "type",
		"`Invoice`.`number`" => "number",
		"if(`Invoice`.`Date`,date_format(`Invoice`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"IF(    CHAR_LENGTH(`Customers1`.`Title`), CONCAT_WS('',   `Customers1`.`Title`), '') /* Title */" => "Title",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') /* Phone */" => "Phone",
		"IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') /* Email */" => "Email",
		"IF(    CHAR_LENGTH(`Customers1`.`Address`), CONCAT_WS('',   `Customers1`.`Address`), '') /* Address */" => "Address",
		"IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') /* City */" => "City",
		"IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') /* Country */" => "Country",
		"`Invoice`.`PaymentStatus`" => "PaymentStatus",
		"`Invoice`.`AmountDUE`" => "AmountDUE",
		"`Invoice`.`AmountPAID`" => "AmountPAID",
		"`Invoice`.`Balance`" => "Balance",
		"`Invoice`.`Status`" => "Status",
		"`Invoice`.`tax`" => "tax",
		"`Invoice`.`Total`" => "Total",
		"`Invoice`.`usrAdd`" => "usrAdd",
		"`Invoice`.`whenAdd`" => "whenAdd",
		"`Invoice`.`usrUpdated`" => "usrUpdated",
		"`Invoice`.`whenUpdated`" => "whenUpdated",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`) || CHAR_LENGTH(`Invoice1`.`number`), CONCAT_WS('',   `Invoice1`.`id`, ' - ', `Invoice1`.`number`), '') /* Realted */" => "realted",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`Invoice`.`id`',
		2 => 2,
		3 => '`Invoice`.`number`',
		4 => '`Invoice`.`Date`',
		5 => '`Customers1`.`Title`',
		6 => '`Customers1`.`Customer`',
		7 => '`Customers1`.`Phone`',
		8 => '`Customers1`.`Email`',
		9 => '`Customers1`.`Address`',
		10 => 10,
		11 => 11,
		12 => 12,
		13 => '`Invoice`.`AmountDUE`',
		14 => '`Invoice`.`AmountPAID`',
		15 => '`Invoice`.`Balance`',
		16 => 16,
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`Invoice`.`id`" => "id",
		"`Invoice`.`type`" => "type",
		"`Invoice`.`number`" => "number",
		"if(`Invoice`.`Date`,date_format(`Invoice`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"IF(    CHAR_LENGTH(`Customers1`.`Title`), CONCAT_WS('',   `Customers1`.`Title`), '') /* Title */" => "Title",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') /* Phone */" => "Phone",
		"IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') /* Email */" => "Email",
		"IF(    CHAR_LENGTH(`Customers1`.`Address`), CONCAT_WS('',   `Customers1`.`Address`), '') /* Address */" => "Address",
		"IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') /* City */" => "City",
		"IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') /* Country */" => "Country",
		"`Invoice`.`PaymentStatus`" => "PaymentStatus",
		"`Invoice`.`AmountDUE`" => "AmountDUE",
		"`Invoice`.`AmountPAID`" => "AmountPAID",
		"`Invoice`.`Balance`" => "Balance",
		"`Invoice`.`Status`" => "Status",
		"`Invoice`.`tax`" => "tax",
		"`Invoice`.`Total`" => "Total",
		"`Invoice`.`usrAdd`" => "usrAdd",
		"`Invoice`.`whenAdd`" => "whenAdd",
		"`Invoice`.`usrUpdated`" => "usrUpdated",
		"`Invoice`.`whenUpdated`" => "whenUpdated",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`) || CHAR_LENGTH(`Invoice1`.`number`), CONCAT_WS('',   `Invoice1`.`id`, ' - ', `Invoice1`.`number`), '') /* Realted */" => "realted",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`Invoice`.`id`" => "ID",
		"`Invoice`.`type`" => "Type",
		"`Invoice`.`number`" => "Number",
		"`Invoice`.`Date`" => "Date",
		"IF(    CHAR_LENGTH(`Customers1`.`Title`), CONCAT_WS('',   `Customers1`.`Title`), '') /* Title */" => "Title",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') /* Phone */" => "Phone",
		"IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') /* Email */" => "Email",
		"IF(    CHAR_LENGTH(`Customers1`.`Address`), CONCAT_WS('',   `Customers1`.`Address`), '') /* Address */" => "Address",
		"IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') /* City */" => "City",
		"IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') /* Country */" => "Country",
		"`Invoice`.`PaymentStatus`" => "Payment Status",
		"`Invoice`.`AmountDUE`" => "Due amount",
		"`Invoice`.`AmountPAID`" => "Amount paid",
		"`Invoice`.`Balance`" => "Balance",
		"`Invoice`.`Status`" => "Status",
		"`Invoice`.`tax`" => "Tax",
		"`Invoice`.`Total`" => "Total",
		"`Invoice`.`usrAdd`" => "Created By",
		"`Invoice`.`whenAdd`" => "When is Added",
		"`Invoice`.`usrUpdated`" => "UsrUpdated",
		"`Invoice`.`whenUpdated`" => "WhenUpdated",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`) || CHAR_LENGTH(`Invoice1`.`number`), CONCAT_WS('',   `Invoice1`.`id`, ' - ', `Invoice1`.`number`), '') /* Realted */" => "Realted",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`Invoice`.`id`" => "id",
		"`Invoice`.`type`" => "type",
		"`Invoice`.`number`" => "number",
		"if(`Invoice`.`Date`,date_format(`Invoice`.`Date`,'%m/%d/%Y'),'')" => "Date",
		"IF(    CHAR_LENGTH(`Customers1`.`Title`), CONCAT_WS('',   `Customers1`.`Title`), '') /* Title */" => "Title",
		"IF(    CHAR_LENGTH(`Customers1`.`Customer`), CONCAT_WS('',   `Customers1`.`Customer`), '') /* Customer */" => "Customer",
		"IF(    CHAR_LENGTH(`Customers1`.`Phone`), CONCAT_WS('',   `Customers1`.`Phone`), '') /* Phone */" => "Phone",
		"IF(    CHAR_LENGTH(`Customers1`.`Email`), CONCAT_WS('',   `Customers1`.`Email`), '') /* Email */" => "Email",
		"IF(    CHAR_LENGTH(`Customers1`.`Address`), CONCAT_WS('',   `Customers1`.`Address`), '') /* Address */" => "Address",
		"IF(    CHAR_LENGTH(`City1`.`City`), CONCAT_WS('',   `City1`.`City`), '') /* City */" => "City",
		"IF(    CHAR_LENGTH(`Country1`.`Country`), CONCAT_WS('',   `Country1`.`Country`), '') /* Country */" => "Country",
		"`Invoice`.`PaymentStatus`" => "PaymentStatus",
		"`Invoice`.`AmountDUE`" => "AmountDUE",
		"`Invoice`.`AmountPAID`" => "AmountPAID",
		"`Invoice`.`Balance`" => "Balance",
		"`Invoice`.`Status`" => "Status",
		"`Invoice`.`tax`" => "tax",
		"`Invoice`.`Total`" => "Total",
		"`Invoice`.`usrAdd`" => "usrAdd",
		"`Invoice`.`whenAdd`" => "whenAdd",
		"`Invoice`.`usrUpdated`" => "usrUpdated",
		"`Invoice`.`whenUpdated`" => "whenUpdated",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`) || CHAR_LENGTH(`Invoice1`.`number`), CONCAT_WS('',   `Invoice1`.`id`, ' - ', `Invoice1`.`number`), '') /* Realted */" => "realted",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('Customer' => 'Customer', 'realted' => 'Realted', );

	$x->QueryFrom = "`Invoice` LEFT JOIN `Customers` as Customers1 ON `Customers1`.`id`=`Invoice`.`Customer` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`Invoice`.`realted` LEFT JOIN `City` as City1 ON `City1`.`id`=`Customers1`.`City` LEFT JOIN `Country` as Country1 ON `Country1`.`id`=`Customers1`.`Country` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
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
	$x->ScriptFileName = "Invoice_view.php";
	$x->RedirectAfterInsert = "Invoice_view.php?SelectedID=#ID#";
	$x->TableTitle = "INVOICE";
	$x->TableIcon = "resources/table_icons/Invoices.png";
	$x->PrimaryKey = "`Invoice`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("ID", "Type", "Number", "Date", "Customer", "Phone", "Email", "Country", "Payment Status", "Due amount", "Amount paid", "Balance", "Status", "Tax", "Total", "Realted");
	$x->ColFieldName = array('id', 'type', 'number', 'Date', 'Customer', 'Phone', 'Email', 'Country', 'PaymentStatus', 'AmountDUE', 'AmountPAID', 'Balance', 'Status', 'tax', 'Total', 'realted');
	$x->ColNumber  = array(1, 2, 3, 4, 6, 7, 8, 11, 12, 13, 14, 15, 16, 17, 18, 23);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Invoice_templateTV.html';
	$x->SelectedTemplate = 'templates/Invoice_templateTVS.html';
	$x->TemplateDV = 'templates/Invoice_templateDV.html';
	$x->TemplateDVP = 'templates/Invoice_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = true;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Invoice`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Invoice' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Invoice`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Invoice' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Invoice`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Invoice_init
	$render=TRUE;
	if(function_exists('Invoice_init')) {
		$args=array();
		$render=Invoice_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `Invoice`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select sum(`Invoice`.`AmountDUE`), sum(`Invoice`.`AmountPAID`) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)) {
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Invoice-id"></td>';
			$sumRow .= '<td class="Invoice-type"></td>';
			$sumRow .= '<td class="Invoice-number"></td>';
			$sumRow .= '<td class="Invoice-Date"></td>';
			$sumRow .= '<td class="Invoice-Customer"></td>';
			$sumRow .= '<td class="Invoice-Phone"></td>';
			$sumRow .= '<td class="Invoice-Email"></td>';
			$sumRow .= '<td class="Invoice-Country"></td>';
			$sumRow .= '<td class="Invoice-PaymentStatus"></td>';
			$sumRow .= "<td class=\"Invoice-AmountDUE text-right\">{$row[0]}</td>";
			$sumRow .= "<td class=\"Invoice-AmountPAID text-right\">{$row[1]}</td>";
			$sumRow .= '<td class="Invoice-Balance"></td>';
			$sumRow .= '<td class="Invoice-Status"></td>';
			$sumRow .= '<td class="Invoice-tax"></td>';
			$sumRow .= '<td class="Invoice-Total"></td>';
			$sumRow .= '<td class="Invoice-realted"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Invoice_header
	$headerCode='';
	if(function_exists('Invoice_header')) {
		$args=array();
		$headerCode=Invoice_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Invoice_footer
	$footerCode='';
	if(function_exists('Invoice_footer')) {
		$args=array();
		$footerCode=Invoice_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>