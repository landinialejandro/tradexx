$j(function() {
    $j('td.Invoice-PaymentStatus a').each(function() {
        var text = $j(this).text();
        var color = text === "PAID" ? "success" : "danger";
        var $span = $j('<span/>', { class: "badge badge-" + color, text: text });
        $j(this).replaceWith($span);
        //console.log($j(this).text());
    })
    $j('td.Invoice-Status a').each(function() {
        var text = $j(this).text();
        var color = "success";
        switch (text) {
            case "OPEN":
                color = "danger";
                break;
            case "CANCEL":
                color = "warning";
                break;
            default:
                break;
        }
        var $span = $j('<span/>', { class: "badge badge-" + color, text: text });
        $j(this).replaceWith($span);
        //console.log($j(this).text());
    })

});