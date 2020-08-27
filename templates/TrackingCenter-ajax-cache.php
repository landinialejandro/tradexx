<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'TrackingCenter';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Name: <?php echo json_encode(array('id' => $rdata['Name'], 'value' => $rdata['Name'], 'text' => $jdata['Name'])); ?>,
			Zone: <?php echo json_encode($jdata['Zone']); ?>,
			Tracking: <?php echo json_encode(array('id' => $rdata['Tracking'], 'value' => $rdata['Tracking'], 'text' => $jdata['Tracking'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Name */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Name' && d.id == data.Name.id)
				return { results: [ data.Name ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Name autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'Name' && d.id == data.Name.id) {
				$j('#Zone' + d[rnd]).html(data.Zone);
				return true;
			}

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

