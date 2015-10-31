<?php
defined('C5_EXECUTE') or die("Access Denied.");

// -- Include different elements of the page -- \\
$this->inc('elements/head.php'); 
$this->inc('elements/header.php'); 
 
?>

<main class="full main-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<hr class="space-m">
		    <h1><?php echo t('404 Error')?></h1>
		    <p><?php echo t('Page not found.')?></p>					
		    <hr class="space-m">
			</div>
		</div>
	</div>

</main>


<?php $this->inc('elements/footer.php'); 
