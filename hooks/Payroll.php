<?php
// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

function Payroll_init(&$options, $memberInfo, &$args)
{

	return TRUE;
}

function Payroll_header($contentType, $memberInfo, &$args)
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

function Payroll_footer($contentType, $memberInfo, &$args)
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

function Payroll_before_insert(&$data, $memberInfo, &$args)
{

	return TRUE;
}

function Payroll_after_insert($data, $memberInfo, &$args)
{

	return TRUE;
}

function Payroll_before_update(&$data, $memberInfo, &$args)
{
	/* retrieve Payroll info */
	///////////////////////////
	$Payroll = getDataTable('Payroll', $data['selectedID']);

	if (is_null($Payroll['stop'])) {
		//TODO: convertir el tiempo en un decimal
		$interval = formatDateDiff($Payroll['start'], $data['stop']);
		$deciamal_h = $interval["value"]["i"] / 60;
		$horas = round($interval["value"]["h"] + $deciamal_h, 2);
		$data['value'] = $interval["human"];
		$data['horas'] = $horas;
	} elseif ($memberInfo['admin']) {
		$start = ($data['start'] ? $data['start'] : $Payroll['start']);
		$stop = ($data['stop'] ? $data['stop'] : $Payroll['stop']);
		$interval = formatDateDiff($start, $stop);
		$deciamal_h = $interval["value"]["i"] / 60;
		$horas = round($interval["value"]["h"] + $deciamal_h, 2);
		$data['value'] = $interval["human"];
		$data['horas'] = $horas;
	} else {
		return false;
	}
	return true;
}

function Payroll_after_update($data, $memberInfo, &$args)
{
	return TRUE;
}

function Payroll_before_delete($selectedID, &$skipChecks, $memberInfo, &$args)
{

	return TRUE;
}

function Payroll_after_delete($selectedID, $memberInfo, &$args)
{
}

function Payroll_dv($selectedID, $memberInfo, &$html, &$args)
{
}

function Payroll_csv($query, $memberInfo, &$args)
{

	return $query;
}
function Payroll_batch_actions(&$args)
{

	return array();
}
