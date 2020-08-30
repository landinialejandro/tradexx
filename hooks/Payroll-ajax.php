<?php
$currDir = dirname(__FILE__) . "/..";
include("$currDir/defaultLang.php");
include("$currDir/language.php");
include("$currDir/lib.php");

handle_maintenance();

header('Content-type: application/json');

$tn = 'Payroll';
$table_perms = getTablePermissions($tn);
if (!$table_perms[0]) {
    die('// Access denied!');
}

$id = new Request('id');

if (empty($id)) {
    die('// i need ID!');
}
$data = getDataTable($tn, $id->raw);

echo json_encode($data);
