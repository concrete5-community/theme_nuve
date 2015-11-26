<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();

$number_of_areas = $c->getAttribute($attribute_handle);
if (is_object($number_of_areas)) $number_of_areas = $number_of_areas->current()->getSelectAttributeOptionValue();
$number_of_areas = $number_of_areas === false ? 1 : $number_of_areas;

if ($number_of_areas > 0 ) {
    for ($i=0; $i <= $number_of_areas; $i++) {
        $id = $i > 0 ?  $area_name . ' - ' . $i : $area_name;
        $handle = strtolower($area_name) . '-' . $i;
        $area = new Area($id);
        $visible = $i === 0 ? 'visible' : '';
        $styleSet = $pageTheme->getAreaStyles($area,$c);

        echo "<section class=\"cd-section $handle $visible\">";
        echo "<div class=\"cd-section-inner\">";
        echo "<div class=\"cd-section-style cd-section-style-$handle\" style=\"$styleSet\">";
        echo "<div class=\"vertical-align\">";
        echo "<div>";
    	    $area->enableGridContainer();
    	    $area->display($c);
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
  	    echo "</section>";
    }
}

?>
