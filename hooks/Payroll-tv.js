$j(function() {
    //normalizeView();
    $j('#quick-search').remove();
    if (typeof tv_editlets !== "undefined") {
        tv_editlets(AppGini.currentTableName(), ['employee', 'date', 'horas', 'comment', 'value', 'status']);
    }
    labelize_table();
});

function tv_callback(result, settings, submitdata) {
    $j.get('hooks/Payroll-ajax.php', { id: submitdata.id, cmd: "get-hours" })
        .done(function(res) {
            if (res.custom_msg) {
                show_notification(res.custom_msg);
            }
            $j('#Payroll-horas-' + submitdata.id + ' > a').text(res.horas);
        });
}

function wrapObject(selector = false) {
    if (selector) {
        $j(selector).each(function() {
            $j(this).removeClass('row');
            $j(this).children().wrapAll('<div class="row"/>');
        });
    }
}