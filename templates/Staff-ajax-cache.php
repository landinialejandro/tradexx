<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Staff';

		/* data for selected record, or defaults if none is selected */
		var data = {
			City: <?php echo json_encode(array('id' => $rdata['City'], 'value' => $rdata['City'], 'text' => $jdata['City'])); ?>,
			Province: <?php echo json_encode(array('id' => $rdata['Province'], 'value' => $rdata['Province'], 'text' => $jdata['Province'])); ?>,
			Country: <?php echo json_encode(array('id' => $rdata['Country'], 'value' => $rdata['Country'], 'text' => $jdata['Country'])); ?>,
			Department: <?php echo json_encode(array('id' => $rdata['Department'], 'value' => $rdata['Department'], 'text' => $jdata['Department'])); ?>,
			Position: <?php echo json_encode(array('id' => $rdata['Position'], 'value' => $rdata['Position'], 'text' => $jdata['Position'])); ?>,
			Supervisor: <?php echo json_encode(array('id' => $rdata['Supervisor'], 'value' => $rdata['Supervisor'], 'text' => $jdata['Supervisor'])); ?>,
			Manager: <?php echo json_encode(array('id' => $rdata['Manager'], 'value' => $rdata['Manager'], 'text' => $jdata['Manager'])); ?>,
			Director: <?php echo json_encode(array('id' => $rdata['Director'], 'value' => $rdata['Director'], 'text' => $jdata['Director'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

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

		/* saved value for Department */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Department' && d.id == data.Department.id)
				return { results: [ data.Department ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Position */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Position' && d.id == data.Position.id)
				return { results: [ data.Position ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Supervisor */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Supervisor' && d.id == data.Supervisor.id)
				return { results: [ data.Supervisor ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Manager */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Manager' && d.id == data.Manager.id)
				return { results: [ data.Manager ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Director */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Director' && d.id == data.Director.id)
				return { results: [ data.Director ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

