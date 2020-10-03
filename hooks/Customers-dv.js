$j(function() {
    normalizeView();
    inline_fields(['Title', 'Customer', 'Type'], 'Customer', [1, 5, 3]);
    inline_fields(['City', 'Province', 'Country'], 'City, Prov, Country', [3, 3, 3]);
    inline_fields(['Phone', 'Email', 'Status'], 'Contact', [3, 3, 3]);
});