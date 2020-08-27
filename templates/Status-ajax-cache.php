<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Status';

		/* data for selected record, or defaults if none is selected */
		var data = {
			TrackID: <?php echo json_encode($jdata['TrackID']); ?>,
			Invoice: <?php echo json_encode(array('id' => $rdata['Invoice'], 'value' => $rdata['Invoice'], 'text' => $jdata['Invoice'])); ?>,
			Tracking: <?php echo json_encode(array('id' => $rdata['Tracking'], 'value' => $rdata['Tracking'], 'text' => $jdata['Tracking'])); ?>,
			Dimensions: <?php echo json_encode($jdata['Dimensions']); ?>,
			RWeight: <?php echo json_encode($jdata['RWeight']); ?>,
			VWeight: <?php echo json_encode($jdata['VWeight']); ?>,
			Total: <?php echo json_encode($jdata['Total']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Invoice */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Invoice' && d.id == data.Invoice.id)
				return { results: [ data.Invoice ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Tracking */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Tracking' && d.id == data.Tracking.id)
				return { results: [ data.Tracking ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Tracking autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'Tracking' && d.id == data.Tracking.id) {
				$j('#TrackID' + d[rnd]).html(data.TrackID);
				$j('#Dimensions' + d[rnd]).html(data.Dimensions);
				$j('#RWeight' + d[rnd]).html(data.RWeight);
				$j('#VWeight' + d[rnd]).html(data.VWeight);
				$j('#Total' + d[rnd]).html(data.Total);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

