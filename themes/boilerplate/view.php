<?php
defined('C5_EXECUTE') or die("Access Denied.");

// -- Include different elements of the page -- \\
$this->inc('elements/head.php'); 
$this->inc('elements/header.php'); 
?>

<main class="full main-container">
	<?php print $innerContent; ?>		
</main>


<?php $this->inc('elements/footer.php'); 
