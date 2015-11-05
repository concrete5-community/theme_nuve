<?php
defined('C5_EXECUTE') or die("Access Denied.");
// -- Include different elements of the page -- \\
$this->inc('elements/head.php');
?>
<?php $this->inc('elements/multiple_area.php',array('c'=>$c,'area_name'=>'Main','attribute_handle'=>'number_of_main_areas'));  ?>

<nav>
	<ul class="cd-vertical-nav">
		<li><a href="#0" class="cd-prev inactive"><?php echo ('Next') ?></a></li>
		<li><a href="#0" class="cd-next"><?php echo t('Prev') ?></a></li>
	</ul>
</nav> <!-- .cd-vertical-nav -->

<?php $this->inc('elements/footer.php');
