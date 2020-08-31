$j(function() {
    normalizeView();
    inline_fields(['Title', 'Customer'], "Customer", [1, 8])
    inline_fields(['Phone', 'Email'], "Contact", [3, 6])
    inline_fields(['Address', 'City', 'Country'], "Address", [3, 3, 3])
    inline_fields(['AmountDUE', 'AmountPAID', 'Balance'], "Amount(due/paid/balance)", [3, 3, 3])
});