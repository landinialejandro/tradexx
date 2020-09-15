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

$tn = 'Payroll';
$table_perms = getTablePermissions($tn);
if (!$table_perms[0]) {
    die('// Access denied!');
}
$id = new Request('id');
$cmd = new Request('cmd');

if ($cmd !== 'PAY') {
    die('// Algo está mal!');
}

$Invoice = getDataTable('Invoice', $id->raw);

if ($Invoice['type'] !== 'Quote') {
    //TODO:controlar valores devueltos
    $ap = sqlValue('SELECT `id` FROM `AccountPlan` WHERE `code` = "C-CASH"');
    $ap = getDataTable_Values('AccountPlan', $ap);



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
    $insert = insert('Accounting', $accouting, $e);
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
        "message" => "<h3>Los presupuesto no llevan pago.</h3>",
        "class" => "warning",
        "dismiss_seconds" => "3"
    ];
}

echo json_encode($data);
