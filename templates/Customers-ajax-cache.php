<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Customers';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Type: <?php echo json_encode(array('id' => $rdata['Type'], 'value' => $rdata['Type'], 'text' => $jdata['Type'])); ?>,
			City: <?php echo json_encode(array('id' => $rdata['City'], 'value' => $rdata['City'], 'text' => $jdata['City'])); ?>,
			Province: <?php echo json_encode(array('id' => $rdata['Province'], 'value' => $rdata['Province'], 'text' => $jdata['Province'])); ?>,
			Country: <?php echo json_encode(array('id' => $rdata['Country'], 'value' => $rdata['Country'], 'text' => $jdata['Country'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Type */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Type' && d.id == data.Type.id)
				return { results: [ data.Type ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for City */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'City' && d.id == data.City.id)
				return { results: [ data.City ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Province */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Province' && d.id == data.Province.id)
				return { results: [ data.Province ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Country */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Country' && d.id == data.Country.id)
				return { results: [ data.Country ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

