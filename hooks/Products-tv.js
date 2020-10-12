function thisTable() {
    return 'Products';
}
$j(function() {
    removeEmpty();
    showTumbs();
    $j('.dl-horizontal').addClass('row');
    $j('dt').addClass('col-3');
    $j('dd').addClass('col-9').removeClass('text-right');
});