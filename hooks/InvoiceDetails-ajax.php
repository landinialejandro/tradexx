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

$tn = 'InvoiceDetails';
$table_perms = getTablePermissions($tn);
if (!$table_perms[0]) {
    die('// Access denied!');
}

$id = new Request('id');
$cmd = new Request('cmd');

