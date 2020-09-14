<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function InvoiceDetails_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function InvoiceDetails_header($contentType, $memberInfo, &$args) {
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

	function InvoiceDetails_footer($contentType, $memberInfo, &$args) {
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

	function InvoiceDetails_before_insert(&$data, $memberInfo, &$args) {
		//verificar que el invoice este en estado open para poder insertar
		$invoice = getDataTable_Values('Invoice',$data['invoice']);
		if (!($invoice && $invoice['Status'] === 'OPEN') ){
			$_SESSION['custom_msg'] = [
				"message" => "<h3>Error al intentar agregar un artículo al INVOICE, Estado: {$invoice['Status']} </h3>",
				"class" => "danger",
				"dismiss_seconds" => "0"
			];
			return FALSE;
		}


		return TRUE;
	}

	function InvoiceDetails_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function InvoiceDetails_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function InvoiceDetails_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function InvoiceDetails_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function InvoiceDetails_after_delete($selectedID, $memberInfo, &$args) {

	}

	function InvoiceDetails_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	function InvoiceDetails_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function InvoiceDetails_batch_actions(&$args) {

		return array();
	}
