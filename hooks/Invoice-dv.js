$j(function() {
    normalizeView();

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
            'usrAdd', 'whenAdd', 'usrUpdated', 'whenUpdated'
        ]
    }]

    addTabs(AppGini.currentTableName(), addTab);

    inline_fields(['Title', 'Customer'], "Customer", [1, 8])
    inline_fields(['Phone', 'Email'], "Contact", [3, 6])
    inline_fields(['Address', 'City', 'Country'], "Address", [3, 3, 3])
    inline_fields(['AmountDUE', 'AmountPAID', 'Balance'], "Amount(due/paid/balance)", [3, 3, 3])

});