<?php
// This script and data application were generated by AppGini 5.84
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/InvoiceDetails.php");
	include("$currDir/InvoiceDetails_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('InvoiceDetails');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "InvoiceDetails";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`InvoiceDetails`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') /* Invoice */" => "invoice",
		"`InvoiceDetails`.`order`" => "order",
		"IF(    CHAR_LENGTH(`Products1`.`code`) || CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`code`, ' - ', `Products1`.`item`), '') /* Product */" => "product",
		"`InvoiceDetails`.`qty`" => "qty",
		"IF(    CHAR_LENGTH(`Products1`.`itemSale`), CONCAT_WS('',   `Products1`.`itemSale`), '') /* ItemSale */" => "itemSale",
		"`InvoiceDetails`.`SubTotal`" => "SubTotal",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`InvoiceDetails`.`id`',
		2 => '`Invoice1`.`id`',
		3 => '`InvoiceDetails`.`order`',
		4 => 4,
		5 => '`InvoiceDetails`.`qty`',
		6 => '`Products1`.`itemSale`',
		7 => 7,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`InvoiceDetails`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') /* Invoice */" => "invoice",
		"`InvoiceDetails`.`order`" => "order",
		"IF(    CHAR_LENGTH(`Products1`.`code`) || CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`code`, ' - ', `Products1`.`item`), '') /* Product */" => "product",
		"`InvoiceDetails`.`qty`" => "qty",
		"IF(    CHAR_LENGTH(`Products1`.`itemSale`), CONCAT_WS('',   `Products1`.`itemSale`), '') /* ItemSale */" => "itemSale",
		"`InvoiceDetails`.`SubTotal`" => "SubTotal",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`InvoiceDetails`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') /* Invoice */" => "Invoice",
		"`InvoiceDetails`.`order`" => "Order",
		"IF(    CHAR_LENGTH(`Products1`.`code`) || CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`code`, ' - ', `Products1`.`item`), '') /* Product */" => "Product",
		"`InvoiceDetails`.`qty`" => "Qty",
		"IF(    CHAR_LENGTH(`Products1`.`itemSale`), CONCAT_WS('',   `Products1`.`itemSale`), '') /* ItemSale */" => "ItemSale",
		"`InvoiceDetails`.`SubTotal`" => "SubTotal",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`InvoiceDetails`.`id`" => "id",
		"IF(    CHAR_LENGTH(`Invoice1`.`id`), CONCAT_WS('',   `Invoice1`.`id`), '') /* Invoice */" => "invoice",
		"`InvoiceDetails`.`order`" => "order",
		"IF(    CHAR_LENGTH(`Products1`.`code`) || CHAR_LENGTH(`Products1`.`item`), CONCAT_WS('',   `Products1`.`code`, ' - ', `Products1`.`item`), '') /* Product */" => "product",
		"`InvoiceDetails`.`qty`" => "qty",
		"IF(    CHAR_LENGTH(`Products1`.`itemSale`), CONCAT_WS('',   `Products1`.`itemSale`), '') /* ItemSale */" => "itemSale",
		"`InvoiceDetails`.`SubTotal`" => "SubTotal",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('invoice' => 'Invoice', 'product' => 'Product', );

	$x->QueryFrom = "`InvoiceDetails` LEFT JOIN `Invoice` as Invoice1 ON `Invoice1`.`id`=`InvoiceDetails`.`invoice` LEFT JOIN `Products` as Products1 ON `Products1`.`id`=`InvoiceDetails`.`product` ";
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
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "InvoiceDetails_view.php";
	$x->RedirectAfterInsert = "InvoiceDetails_view.php?SelectedID=#ID#";
	$x->TableTitle = "Datails";
	$x->TableIcon = "resources/table_icons/basket_put.png";
	$x->PrimaryKey = "`InvoiceDetails`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150);
	$x->ColCaption = array("Order", "Product", "Qty", "ItemSale", "SubTotal");
	$x->ColFieldName = array('order', 'product', 'qty', 'itemSale', 'SubTotal');
	$x->ColNumber  = array(3, 4, 5, 6, 7);

	// template paths below are based on the app main directory
	$x->Template = 'templates/InvoiceDetails_templateTV.html';
	$x->SelectedTemplate = 'templates/InvoiceDetails_templateTVS.html';
	$x->TemplateDV = 'templates/InvoiceDetails_templateDV.html';
	$x->TemplateDVP = 'templates/InvoiceDetails_templateDVP.html';

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
		$x->QueryWhere="where `InvoiceDetails`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='InvoiceDetails' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `InvoiceDetails`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='InvoiceDetails' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`InvoiceDetails`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: InvoiceDetails_init
	$render=TRUE;
	if(function_exists('InvoiceDetails_init')) {
		$args=array();
		$render=InvoiceDetails_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: InvoiceDetails_header
	$headerCode='';
	if(function_exists('InvoiceDetails_header')) {
		$args=array();
		$headerCode=InvoiceDetails_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: InvoiceDetails_footer
	$footerCode='';
	if(function_exists('InvoiceDetails_footer')) {
		$args=array();
		$footerCode=InvoiceDetails_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>