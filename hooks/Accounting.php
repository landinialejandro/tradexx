<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function Accounting_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function Accounting_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function Accounting_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function Accounting_before_insert(&$data, $memberInfo, &$args) {

		$accounting = getDataTable('Accounting',$data['selectedID']);
		//TODO: verificar que el registro sea ingresado desde invoice.
		//'Embedded'=1, 'AutoClose'=1, 'filter_invoice'=id invoice
		return TRUE;
	}

	function Accounting_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function Accounting_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function Accounting_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function Accounting_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function Accounting_after_delete($selectedID, $memberInfo, &$args) {

	}

	function Accounting_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function Accounting_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function Accounting_batch_actions(&$args) {

		return array();
	}
