<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'CCJournal';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Card: <?php echo json_encode(array('id' => $rdata['Card'], 'value' => $rdata['Card'], 'text' => $jdata['Card'])); ?>,
			Logged: <?php echo json_encode(array('id' => $rdata['Logged'], 'value' => $rdata['Logged'], 'text' => $jdata['Logged'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Card */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Card' && d.id == data.Card.id)
				return { results: [ data.Card ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Logged */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Logged' && d.id == data.Logged.id)
				return { results: [ data.Logged ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

