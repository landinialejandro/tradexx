$j(function() {
    normalizeView();
    var status = $j("#Status").select2('data');
    var paid = $j("#PaymentStatus").select2('data');
    var addTab = [{
        name: "status",
        title: "Status",
        icon: "far fa-compass",
        fields: [
            'AmountDUE', 'AmountPAID', 'Balance'
        ]
    }, {
        name: "trazability",
        title: "Trazability",
        icon: "far fa-map",
        fields: [
            'usrAdd', 'whenAdd', 'usrUpdated', 'whenUpdated', 'related'
        ]
    }]

    inline_fields(['Phone', 'Email'], "Contact", [3, 6])
    inline_fields(['Address', 'City', 'Country'], "Address", [3, 3, 3])
    inline_fields(['AmountDUE', 'AmountPAID', 'Balance'], "Amount(due/paid/balance)", [3, 3, 3])
    inline_fields(['usrAdd', 'whenAdd'], "Created By", [3, 3])
    inline_fields(['usrUpdated', 'whenUpdated'], "Updated By", [3, 3])
    inline_fields(['Title', 'Customer'], "Customer!", [1, 8])
    if (!is_add_new() && status.id !== 'CLOSED') {
        add_action_button({ class: "btn btn-secondary", title: "", text: "Close Invoice", type: "button", onclick: "closeInvoice();" }, "");
    }
    if (!is_add_new() && status.id === 'CLOSED' && paid.id !== 'PAID') {
        add_action_button({ class: "btn btn-success", title: "", text: "Cash Pay Invoice", type: "button", onclick: "payInvoice('CC-CASH');" }, "");
        add_action_button({ class: "btn btn-success", title: "", text: "VISA Pay Invoice", type: "button", onclick: "payInvoice('CC-VISA');" }, "");
    }
    addTabs(AppGini.currentTableName(), addTab);

    // if (status.id === 'CLOSED') {
    //     $j("div[id$='dv_form'], .children-tabs")
    //         .prepend(overlayTemplateBaned)
    //         .addClass('overlay-wrapper');

    // }
});

function closeInvoice() {
    $j("#Status").closest('.container-fluid')
        .prepend(overlayTemplateLoad)
        .addClass('overlay-wrapper');
    if (confirm("Close Invoice?")) {
        $j("#Status").select2('data', { text: "CLOSED", id: "CLOSED" });
        setTimeout(() => {
            $j('#update').trigger('click');
        }, 100);
    }
}

function payInvoice(m) {
    if (confirm("PAY Invoice?")) {
        $j.ajax({
            type: "POST",
            url: "hooks/Accounting-ajax.php",
            data: { cmd: "PAY", id: selected_id(), m: m },
            dataType: "json",
            success: function(res) {
                show_notification(res.custom_msg);
                if (res.balance === 'PAID') {
                    $j("#PaymentStatus").select2('data', { text: "PAID", id: "PAID" });
                }
            }
        });
    }
}