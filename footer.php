
<?php /* Inserted by Landini Admin Template on 2020-09-29 01:30:02 */ ?>
		<?php if (activate_LAT("footer",$x,false)) return; ?>
<?php /* End of Landini Admin Template code */ ?>
			<!-- Add footer template above here -->
			<div class="clearfix"></div>
			<?php if(!$_REQUEST['Embedded']) { ?>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php } ?>

			<?php if(!$_REQUEST['Embedded']) { ?>
				<!-- AppGini powered by notice -->
				<div style="height: 60px;" class="hidden-print"></div>
				<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
					<p class="navbar-text"><small>
						Powered by <a class="navbar-link" href="https://bigprof.com/appgini/" target="_blank">BigProf AppGini 5.84</a>
					</small></p>
				</nav>
			<?php } ?>

		</div> <!-- /div class="container" -->
		<?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/footer-extras.php')) { include(dirname(__FILE__).'/hooks/footer-extras.php'); } ?>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
	</body>
</html>