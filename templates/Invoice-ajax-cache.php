<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Invoice';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Title: <?php echo json_encode($jdata['Title']); ?>,
			Customer: <?php echo json_encode(array('id' => $rdata['Customer'], 'value' => $rdata['Customer'], 'text' => $jdata['Customer'])); ?>,
			Phone: <?php echo json_encode($jdata['Phone']); ?>,
			Email: <?php echo json_encode($jdata['Email']); ?>,
			Address: <?php echo json_encode($jdata['Address']); ?>,
			City: <?php echo json_encode($jdata['City']); ?>,
			Country: <?php echo json_encode($jdata['Country']); ?>,
			related: <?php echo json_encode(array('id' => $rdata['related'], 'value' => $rdata['related'], 'text' => $jdata['related'])); ?>
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
				$j('#Title' + d[rnd]).html(data.Title);
				$j('#Phone' + d[rnd]).html(data.Phone);
				$j('#Email' + d[rnd]).html(data.Email);
				$j('#Address' + d[rnd]).html(data.Address);
				$j('#City' + d[rnd]).html(data.City);
				$j('#Country' + d[rnd]).html(data.Country);
				return true;
			}

			return false;
		});

		/* saved value for related */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'related' && d.id == data.related.id)
				return { results: [ data.related ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

