<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'DatabaseAUTO';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Brand: <?php echo json_encode(array('id' => $rdata['Brand'], 'value' => $rdata['Brand'], 'text' => $jdata['Brand'])); ?>,
			Model: <?php echo json_encode(array('id' => $rdata['Model'], 'value' => $rdata['Model'], 'text' => $jdata['Model'])); ?>,
			System: <?php echo json_encode(array('id' => $rdata['System'], 'value' => $rdata['System'], 'text' => $jdata['System'])); ?>,
			Part: <?php echo json_encode(array('id' => $rdata['Part'], 'value' => $rdata['Part'], 'text' => $jdata['Part'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

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

		/* saved value for System */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'System' && d.id == data.System.id)
				return { results: [ data.System ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Part */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Part' && d.id == data.Part.id)
				return { results: [ data.Part ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

