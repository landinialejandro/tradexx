<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Tracking';

		/* data for selected record, or defaults if none is selected */
		var data = {
			WhID: <?php echo json_encode($jdata['WhID']); ?>,
			Date: <?php echo json_encode($jdata['Date']); ?>,
			Warehouse: <?php echo json_encode(array('id' => $rdata['Warehouse'], 'value' => $rdata['Warehouse'], 'text' => $jdata['Warehouse'])); ?>,
			Customer: <?php echo json_encode(array('id' => $rdata['Customer'], 'value' => $rdata['Customer'], 'text' => $jdata['Customer'])); ?>,
			Employee: <?php echo json_encode(array('id' => $rdata['Employee'], 'value' => $rdata['Employee'], 'text' => $jdata['Employee'])); ?>,
			Freight: <?php echo json_encode($jdata['Freight']); ?>,
			Zone: <?php echo json_encode($jdata['Zone']); ?>
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

		/* saved value for Warehouse autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'Warehouse' && d.id == data.Warehouse.id) {
				$j('#WhID' + d[rnd]).html(data.WhID);
				$j('#Date' + d[rnd]).html(data.Date);
				$j('#Freight' + d[rnd]).html(data.Freight);
				return true;
			}

			return false;
		});

		/* saved value for Customer */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Customer' && d.id == data.Customer.id)
				return { results: [ data.Customer ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Customer autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'Customer' && d.id == data.Customer.id) {
				$j('#Zone' + d[rnd]).html(data.Zone);
				return true;
			}

			return false;
		});

		/* saved value for Employee */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Employee' && d.id == data.Employee.id)
				return { results: [ data.Employee ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

