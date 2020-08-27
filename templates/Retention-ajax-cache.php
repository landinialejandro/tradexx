<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Retention';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Customer: <?php echo json_encode(array('id' => $rdata['Customer'], 'value' => $rdata['Customer'], 'text' => $jdata['Customer'])); ?>,
			Phone: <?php echo json_encode($jdata['Phone']); ?>,
			Email: <?php echo json_encode($jdata['Email']); ?>,
			Zone: <?php echo json_encode($jdata['Zone']); ?>,
			Assigned: <?php echo json_encode(array('id' => $rdata['Assigned'], 'value' => $rdata['Assigned'], 'text' => $jdata['Assigned'])); ?>
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

		/* saved value for Customer autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'Customer' && d.id == data.Customer.id) {
				$j('#Phone' + d[rnd]).html(data.Phone);
				$j('#Email' + d[rnd]).html(data.Email);
				$j('#Zone' + d[rnd]).html(data.Zone);
				return true;
			}

			return false;
		});

		/* saved value for Assigned */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Assigned' && d.id == data.Assigned.id)
				return { results: [ data.Assigned ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

