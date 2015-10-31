<?php
defined('C5_EXECUTE') or die("Access Denied.");

// -- Include different elements of the page -- \\
$this->inc('elements/head.php'); 
$this->inc('elements/header.php'); 
 
?>

<main class="full main-container">
	<?php $this->inc('elements/multiple_area.php',array('c'=>$c,'area_name'=>'Main','attribute_handle'=>'Boileplate_number_of_main_areas'));  ?>		
</main>


<?php $this->inc('elements/footer.php'); 