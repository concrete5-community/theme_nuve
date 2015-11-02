<?php defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
$pageTheme = $c->getCollectionThemeObject();

$number_of_areas = $c->getAttribute($attribute_handle);
// Si l'attribut est un 'select' :
if (is_object($number_of_areas)) $number_of_areas = $number_of_areas->current()->getSelectAttributeOptionValue();
// Si l'attribut n'a pas été séléctionné, il est égal à 1
$number_of_areas = $number_of_areas === false ? 1 : $number_of_areas;

if ($number_of_areas > 0 ) {
    for ($i=0; $i <= $number_of_areas; $i++) {
        // Ce qui va suivre le nom de l'area (area, area-1, area-2, ...)
        $id = $i > 0 ?  $area_name . ' - ' . $i : $area_name;
        $area = new Area($id);
        $visible = $i === 0 ? 'visible' : '';
        $styleSet = $pageTheme->getAreaStyles($area,$c);

        echo "<section class=\"cd-section $id $visible\">";
        echo "<div class=\"cd-section-inner\">";
        echo "<div class=\"cd-section-style\" style=\"$styleSet\">";
        echo "<div class=\"vertical-align\">";
	    $area->enableGridContainer();
	    $area->display($c);
      echo "</div>";
      echo "</div>";
	    echo "</section>";
    }
}

?>
