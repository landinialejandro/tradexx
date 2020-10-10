$j(function() {
    normalizeView();
    active_upload_frame('Products');
});

function active_upload_frame(tn = false, fn = 'uploads', f = 'images') {
    if (tn) {
        var $actionButtons = $j('#' + tn + '_dv_action_buttons .sticky-top');
        $actionButtons.prepend(' <div id="imagesThumbs"></div>');
        $actionButtons.append('<p></p><div id="uploadFrame" class="col-12"></div>');
        $j('#uploadFrame').load('LAT/multipleUpload/multipleUpload.php', { f: '/' + f + '/' + tn });
        //$j('#uploads').attr('readonly', true);
    }
}