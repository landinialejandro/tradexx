<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Claim';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Warehouse: <?php echo json_encode(array('id' => $rdata['Warehouse'], 'value' => $rdata['Warehouse'], 'text' => $jdata['Warehouse'])); ?>,
			Tracking: <?php echo json_encode(array('id' => $rdata['Tracking'], 'value' => $rdata['Tracking'], 'text' => $jdata['Tracking'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Warehouse */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Warehouse' && d.id == data.Warehouse.id)
				return { results: [ data.Warehouse ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Tracking */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Tracking' && d.id == data.Tracking.id)
				return { results: [ data.Tracking ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

