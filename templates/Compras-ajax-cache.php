<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Compras';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Customer: <?php echo json_encode(array('id' => $rdata['Customer'], 'value' => $rdata['Customer'], 'text' => $jdata['Customer'])); ?>,
			Employee: <?php echo json_encode(array('id' => $rdata['Employee'], 'value' => $rdata['Employee'], 'text' => $jdata['Employee'])); ?>,
			Description: <?php echo json_encode(array('id' => $rdata['Description'], 'value' => $rdata['Description'], 'text' => $jdata['Description'])); ?>
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

		/* saved value for Employee */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Employee' && d.id == data.Employee.id)
				return { results: [ data.Employee ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Description */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Description' && d.id == data.Description.id)
				return { results: [ data.Description ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

