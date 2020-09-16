<?php
$rootDir = dirname(__FILE__) . '/..';
if (!function_exists('sql')) {
    include("$currDir/defaultLang.php");
    include("$currDir/language.php");
    include("$rootDir/lib.php");
}
if (!function_exists('getDataTable')) {
    include("$rootDir/LAT/myLib.php");
}
handle_maintenance();

header('Content-type: application/json');

$tn = 'Accounting';
$table_perms = getTablePermissions($tn);
if (!$table_perms[0]) {
    die('// Access denied!');
}

$id = new Request('id');
$cmd = new Request('cmd');
$m = new Request('m'); //cuenta de pago

if ($cmd->raw !== 'PAY') {
    die('// Algo está mal!');
}


$Invoice = getDataTable('Invoice', $id->raw);

if ($Invoice['type'] !== 'Quote') {
    //TODO:controlar valores devueltos
    $ap = sqlValue("SELECT `id` FROM `AccountPlan` WHERE `code` = '{$m->raw}'");
    $ap = getDataTable_Values('AccountPlan', $ap);

    //TODO: Agregar una configuración para el codigo COBRO.
    $ma = sqlValue("SELECT `id` FROM `MasterAccount` WHERE `code` = 'COBRO' ");
    //controlar si ya hay un pago realizado.
    $pago = sqlValue("SELECT `id` FROM $tn WHERE `invoice`= '{$Invoice['id']}' AND `master_account` = '{$ma}' ");
    if (!$pago){
        $accouting = [
            // agregar movimiento a cashflow si no es QUOTE
            "invoice" => $Invoice['id'],
            "date" => toMySQLDate($Invoice['Date']),
            "description" => "MOVIMIENTO AUTOMATICO: {$ap['description']}  Invoice:" . $Invoice['number'],
            "account_plan" => $ap['id'],
            "master_account" => $ap['master_account'],
            "account" => $ap['account'],
            "sub_account" => $ap['sub_account'],
            "type" => $ap['type'],
            "amount" => $Invoice['Total'],
            "status" => "CLOSED"
        ];
        $insert = insert($tn, $accouting, $e);
        if (!$insert) {
            // fallo en agregar en accounting
            $data['custom_msg'] = [
                "message" => "<h3>Error agregando accounting: $e </h3>",
                "class" => "danger",
                "dismiss_seconds" => "0"
            ];
        }else{
            $data['custom_msg'] = [
                "message" => "<h3>Movimiento agregado correctamente.</h3>",
                "class" => "success",
                "dismiss_seconds" => "3"
            ];
        }
    }else{
        $data['custom_msg'] = [
            "message" => "<h3>Ya existe un pago realizado y no es posible generar uno Automaticamente,<br>por favor genere un movimiento manual.</h3>",
            "class" => "warning",
            "dismiss_seconds" => "5"
        ];
    }
}else{
    $data['custom_msg'] = [
        "message" => "<h3>Los presupuesto no llevan pago.</h3>",
        "class" => "warning",
        "dismiss_seconds" => "3"
    ];
}

echo json_encode($data);
