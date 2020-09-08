<?php
// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

function Invoice_init(&$options, $memberInfo, &$args)
{

	return TRUE;
}

function Invoice_header($contentType, $memberInfo, &$args)
{
	$header = '';

	switch ($contentType) {
		case 'tableview':
			$header = '';
			break;

		case 'detailview':
			$header = '';
			break;

		case 'tableview+detailview':
			$header = '';
			break;

		case 'print-tableview':
			$header = '';
			break;

		case 'print-detailview':
			$header = '';
			break;

		case 'filters':
			$header = '';
			break;
	}

	return $header;
}

function Invoice_footer($contentType, $memberInfo, &$args)
{
	$footer = '';

	switch ($contentType) {
		case 'tableview':
			$footer = '';
			break;

		case 'detailview':
			$footer = '';
			break;

		case 'tableview+detailview':
			$footer = '';
			break;

		case 'print-tableview':
			$footer = '';
			break;

		case 'print-detailview':
			$footer = '';
			break;

		case 'filters':
			$footer = '';
			break;
	}

	return $footer;
}

function Invoice_before_insert(&$data, $memberInfo, &$args)
{

	return TRUE;
}

function Invoice_after_insert($data, $memberInfo, &$args)
{

	return TRUE;
}

function Invoice_before_update(&$data, $memberInfo, &$args)
{
	/* retrieve Invoice info */
	///////////////////////////
	$Invoice = getDataTable('Invoice', $data['selectedID']);

	if ($Invoice['Status'] === 'CLOSED') {
		$_SESSION['custom_msg'] = [
			"message" => "<h4>La orden está cerrada, no se puede relizar cambios</h4>",
			"class" => "danger",
			"dismiss_seconds" => "0"
		];
		return FALSE;
	}

	if ($Invoice['type'] !== $data['type']) {
		$_SESSION['custom_msg'] = [
			"message" => "<h4>No es posible cambiar el tipo de documento una vez generado.<br>
							Por favor generar otro ducumento o relice una copia de este.</h4>",
			"class" => "danger",
			"dismiss_seconds" => "0"
		];
		return FALSE;
	}

	if ($data['Status'] === 'CLOSED' && $Invoice['Status'] === 'OPEN') {
		// Cierra orden
		$_SESSION['custom_msg'] = [
			"message" => "<h4>La orden se está cerrando</h4>",
			"class" => "success",
			"dismiss_seconds" => "5"
		];

		if (empty($data['total'])){
			//el valor de la orden tiene que ser mayor que cero.
			$_SESSION['custom_msg'] = [
				"message" => "<h4>No se puede cerrar una orden vacia, pero se puede anular, por favor cambie el estado o Anule el documento.</h4>",
				"class" => "warning",
				"dismiss_seconds" => "7"
			];	
			return false;
		}

		if ($Invoice['type'] !== 'Quote') {
			//TODO:controlar valores devueltos
			$ma = sqlValue('SELECT `id` FROM `MasterAccount` where `code` = "VENTA"', $e);
			$ac = sqlValue('SELECT `id` FROM `Account` where `code` = "VENTA"', $e);
			$sa = sqlValue('SELECT `id` FROM `SubAccount` where `code` = "VENTA"', $e);
			$ty = sqlValue('SELECT `id` FROM `Type` where `type` = "Negativo"', $e);

			$accouting = [
				// agregar movimiento a cashflow si no es QUOTE
				"invoice" => $data['selectedID'],
				"date" => $data['Date'],
				"description" => 'MOVIMIENTO por venta. Invoice:' . $data['number'],
				"master_acount" => $ma,
				"account" => $ac,
				"sub_account" => $sa,
				"type" => $ty,
				"amount" => $data['total']
			];
			$insert = insert('Accounting', $accouting, $e);
			if (!$insert) {
				// fallo en agregar en accounting
				$_SESSION['custom_msg'] = [
					"message" => "<h3>Error agregadno acounting: $e </h3>",
					"class" => "danger",
					"dismiss_seconds" => "0"
				];
			} else {
				$_SESSION['custom_msg'] = [
					"message" => "<h3>Movimiento agregado correctamente.</h3>",
					"class" => "success",
					"dismiss_seconds" => "3"
				];
			}
			return $insert;
		}
	}

	return TRUE;
}

function Invoice_after_update($data, $memberInfo, &$args)
{

	return TRUE;
}

function Invoice_before_delete($selectedID, &$skipChecks, $memberInfo, &$args)
{

	return TRUE;
}

function Invoice_after_delete($selectedID, $memberInfo, &$args)
{
}

function Invoice_dv($selectedID, $memberInfo, &$html, &$args)
{
}

function Invoice_csv($query, $memberInfo, &$args)
{

	return $query;
}
function Invoice_batch_actions(&$args)
{

	return array();
}
