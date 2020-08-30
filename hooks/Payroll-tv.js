$j(function() {
    //normalizeView();
    $j('#quick-search').remove();
    if (typeof tv_editlets !== "undefined") {
        tv_editlets(AppGini.currentTableName(), ['employee', 'date', 'horas']);
    }
    labelize_table();
});

function tv_callback(result, settings, submitdata) {
    $j.get('hooks/Payroll-ajax.php', { id: submitdata.id })
        .done(function(data) {
            $j('#Payroll-horas-' + submitdata.id + ' > a').text(data.horas);
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