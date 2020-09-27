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

$cmd = new Request('cmd');
if ($cmd->raw === '') {
    die('// Algo está mal!');
}

if ($cmd->raw === 'get-hours') {
    $id = new Request('id');
    if (empty($id)) {
        die('// i need ID!');
    }
    $data = getDataTable($tn, $id->raw);
}

$c = $cmd->raw;
if ($c === 'startw' || $c === 'stopw' || $c === 'get-status') {

    $mi = getMemberInfo();

    //obtengo el id del empleado por medio del login
    $emp = sqlValue("SELECT `Staff`.`id` FROM `Staff` WHERE `Staff`.`userName` = '{$mi['username']}'");
    if (!$emp) {
        //employee not registered.
        $data['custom_msg'] = [
            "message" => "<h3>Unknown user</h3>",
            "class" => "danger",
            "dismiss_seconds" => "0"
        ];
    }
    //verificar si hay un inicio abierto
    $s = sqlValue("SELECT MAX(`Payroll`.`id`) FROM `Payroll` WHERE `Payroll`.`stop` IS NULL AND `Payroll`.`employee` = $emp");
    if ($s) {
        //ya hay un inicio de tares abierto
        $data['custom_msg'] = [
            "message" => "<h3>you already have a task start open</h3>",
            "class" => "danger",
            "dismiss_seconds" => "0"
        ];
    }
    if ($c === 'startw' && !$s && $emp) {
        $payroll = [
            "employee" => $emp,
            "date" => "",
            "start" => "",
            "comment" => "Inicio automatizado!",
            "status" => "UNPAID"
        ];
        //ver parseCode function
        $payroll['date'] = parseMySQLDate(@date('Y-m-d'), '1');
        $payroll['start'] = @date('H:i:s');

        $insert = insert($tn, $payroll, $e);
        if (!$insert) {
            // fallo en agregar en Payroll
            $data['custom_msg'] = [
                "message" => "<h3>Error agregando $tn: $e </h3>",
                "class" => "danger",
                "dismiss_seconds" => "0"
            ];
        } else {
            $data['custom_msg'] = [
                "message" => "<h3>Bienvenido! {$mi['username']}</h3>",
                "class" => "success",
                "dismiss_seconds" => "3"
            ];
            // mm: save ownership data
            $recID = db_insert_id(db_link());
            set_record_owner($tn, $recID, getLoggedMemberID());
        }
    }
    if ($c === 'stopw' && $s && $emp) {
        $data = getDataTable_Values($tn, $s);

        $data['stop'] = @date('h:i:s a');

        $interval = formatDateDiff($data['start'], $data['stop']);
        $deciamal_h = $interval["value"]["i"] / 60;
        $horas = round($interval["value"]["h"] + $deciamal_h, 2);
        $data['value'] = $interval["human"];
        $data['horas'] = $horas;

        $data['comment'] = $data['comment'] . " - FIN Automatizado";

        $selected_id = $data['id'];

        $o = array('silentErrors' => true);
        sql('update `Payroll` set       `employee`=' . (($data['employee'] !== '' && $data['employee'] !== NULL) ? "'{$data['employee']}'" : 'NULL') . ', `date`=' . (($data['date'] !== '' && $data['date'] !== NULL) ? "'{$data['date']}'" : 'NULL') . ', `start`=`start`' . ', `stop`=' . "'{$data['stop']}'" . ', `horas`=' . (($data['horas'] !== '' && $data['horas'] !== NULL) ? "'{$data['horas']}'" : 'NULL') . ', `comment`=' . (($data['comment'] !== '' && $data['comment'] !== NULL) ? "'{$data['comment']}'" : 'NULL') . ', `status`=' . (($data['status'] !== '' && $data['status'] !== NULL) ? "'{$data['status']}'" : 'NULL') . " where `id`='" . makeSafe($selected_id) . "'", $o);
        if ($o['error'] != '') {
            echo $o['error'];
            echo '<a href="Payroll_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
            exit;
        }

        // mm: update ownership data
        sql("update `membership_userrecords` set `dateUpdated`='" . time() . "' where `tableName`='Payroll' and `pkValue`='" . makeSafe($selected_id) . "'", $eo);
    }
    if ($c === 'get-status') {
        unset($data['custom_msg']);
        $data['status'] = false; //no hay un registro de trabajo iniciado.
        if ($s && $emp) {
            $data['status'] = true; //si hay un registro de trabajo iniciado.
        }
    }
}

echo json_encode($data);
