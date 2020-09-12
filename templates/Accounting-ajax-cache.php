<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Accounting';

		/* data for selected record, or defaults if none is selected */
		var data = {
			invoice: <?php echo json_encode(array('id' => $rdata['invoice'], 'value' => $rdata['invoice'], 'text' => $jdata['invoice'])); ?>,
			account_plan: <?php echo json_encode(array('id' => $rdata['account_plan'], 'value' => $rdata['account_plan'], 'text' => $jdata['account_plan'])); ?>,
			master_acount: <?php echo json_encode($jdata['master_acount']); ?>,
			account: <?php echo json_encode($jdata['account']); ?>,
			sub_account: <?php echo json_encode($jdata['sub_account']); ?>,
			type: <?php echo json_encode($jdata['type']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for invoice */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'invoice' && d.id == data.invoice.id)
				return { results: [ data.invoice ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for account_plan */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'account_plan' && d.id == data.account_plan.id)
				return { results: [ data.account_plan ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for account_plan autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'account_plan' && d.id == data.account_plan.id) {
				$j('#master_acount' + d[rnd]).html(data.master_acount);
				$j('#account' + d[rnd]).html(data.account);
				$j('#sub_account' + d[rnd]).html(data.sub_account);
				$j('#type' + d[rnd]).html(data.type);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

