<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'CustomerAuto';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Customer: <?php echo json_encode(array('id' => $rdata['Customer'], 'value' => $rdata['Customer'], 'text' => $jdata['Customer'])); ?>,
			Brand: <?php echo json_encode(array('id' => $rdata['Brand'], 'value' => $rdata['Brand'], 'text' => $jdata['Brand'])); ?>,
			Model: <?php echo json_encode(array('id' => $rdata['Model'], 'value' => $rdata['Model'], 'text' => $jdata['Model'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Customer */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Customer' && d.id == data.Customer.id)
				return { results: [ data.Customer ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Brand */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Brand' && d.id == data.Brand.id)
				return { results: [ data.Brand ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Model */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Model' && d.id == data.Model.id)
				return { results: [ data.Model ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

