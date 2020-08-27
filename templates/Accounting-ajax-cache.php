<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Accounting';

		/* data for selected record, or defaults if none is selected */
		var data = {
			master_acount: <?php echo json_encode(array('id' => $rdata['master_acount'], 'value' => $rdata['master_acount'], 'text' => $jdata['master_acount'])); ?>,
			account: <?php echo json_encode(array('id' => $rdata['account'], 'value' => $rdata['account'], 'text' => $jdata['account'])); ?>,
			sub_account: <?php echo json_encode(array('id' => $rdata['sub_account'], 'value' => $rdata['sub_account'], 'text' => $jdata['sub_account'])); ?>,
			type: <?php echo json_encode($jdata['type']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for master_acount */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'master_acount' && d.id == data.master_acount.id)
				return { results: [ data.master_acount ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for account */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'account' && d.id == data.account.id)
				return { results: [ data.account ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for sub_account */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'sub_account' && d.id == data.sub_account.id)
				return { results: [ data.sub_account ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

