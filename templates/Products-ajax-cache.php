<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Products';

		/* data for selected record, or defaults if none is selected */
		var data = {
			invoice: <?php echo json_encode(array('id' => $rdata['invoice'], 'value' => $rdata['invoice'], 'text' => $jdata['invoice'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for invoice */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'invoice' && d.id == data.invoice.id)
				return { results: [ data.invoice ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

