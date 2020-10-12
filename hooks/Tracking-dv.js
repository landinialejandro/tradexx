$j(function() {
    normalizeView();

    prepend_btn('Dimensions', "Unit Setting...", "cm", "");
    prepend_btn('Volume', "Unit Setting...", "cm3", "");

    inline_fields(['Warehouse', 'Tracking'], "Warehouse & Tracking", [4, 5])
    inline_fields(['Dimensions', 'Volume', 'Weight'], "Dimensions & Vol & Weight", [3, 3, 3])
    inline_fields(['Freight', 'Status', 'Zone'], "Freight & Status & Zone", [3, 3, 3])

    var $dim = $j('#Dimensions');
    $dim.focusout(function() {
        var ret = { text: '', calc: '', err: true };
        ret = format_medidas($dim.val());
        if (ret.err) {
            $dim.parent().parent().toggleClass('has-error');
        } else {
            $dim.val(ret.text);
            $j("#Volume").val(ret.calc);
        }
    });
});

function format_medidas(text) {
    const coma = /\,/g;
    const punto = /\./g;
    const regex = /[+-]?\d+(?:(\.|\,)\d+)?/g;
    var error = false;
    var res = text.replace(coma, '.');
    var result = []
    result = res.match(regex);

    if (result && result.length == 3) {
        //cantidad de numero ok
        var a = Number(result[0]).toFixed(2);
        var b = Number(result[1]).toFixed(2);
        var c = Number(result[2]).toFixed(2);
        var out = `${a.replace(punto, ',')} x ${b.replace(punto, ',')} x ${c.replace(punto, ',')}`;

        var vol = a * b * c
    } else {
        error = true;
        console.log('no se puede verificar las dimesiones');
    }
    return { text: out, calc: vol, err: error };
}