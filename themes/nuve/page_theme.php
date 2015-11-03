<?php
namespace Concrete\Package\ThemeNuve\Theme\Nuve;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Package\ThemeAnitya\Src\Models\MclOptions;
use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use stdClass;
use Package;
use Loader;
use CollectionAttributeKey;

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

				$this->requireAsset('core/lightbox');
        $this->requireAsset('javascript', 'jquery');
				$this->requireAsset('javascript', 'velocity');
				$this->requireAsset('javascript', 'velocity.ui');
				$this->requireAsset('javascript', 'main');
				$this->requireAsset('javascript', 'modernizr');
				$this->requireAsset('javascript', 'isotope');
        $this->requireAsset('javascript', 'imageloaded');
				$this->requireAsset('javascript', 'element-masonry');
				$this->requireAsset('javascript', 'nuve');

        $this->requireAsset('css', 'font-awesome');
				$this->requireAsset('css', 'reset');
				$this->requireAsset('css', 'bootstrap-custom');
				$this->requireAsset('css', 'animate');
				$this->requireAsset('css', 'nuve-style');
	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
			$elements_colors = array('element-primary','element-secondary','element-tertiary','element-quaternary','element-light');
			$columns = $margin = array();
			for ($i=1; $i < 7; $i++) $columnsClasses[] = "$i-column";

        return array(
					'page_list' => array_merge(
							// Accordions & tabs colors
							$elements_colors,
							// Carousel dots
							array(
							'tag-sorting','keyword-sorting',
							// Layout
							'no-gap'
							),
							// # columns for carousel
							$columnsClasses),
					'horizontal_rule' => array('space-s','space-m','space-l','space-xl','thin','primary','secondary','tertiary','quaternary','dotted','hr-bold'),

        );
    }

    public function getThemeResponsiveImageMap()
    {
        return array(
            'large' => '900px',
            'medium' => '768px',
            'small' => '0'
        );
    }
		public function getPageTags ($pages) {
	    $tagsObject = new StdClass();
	    $tagsObject->tags = $tagsObject->pageTags = array();
	    $ak = CollectionAttributeKey::getByHandle('tags');
	    $db = Loader::db();

	    foreach ($pages as $key => $page):
	    		if ($page->getAttribute('tags')) :

	    				$v = array($page->getCollectionID(), $page->getVersionID(), $ak->getAttributeKeyID());
	    				$avID = $db->GetOne("SELECT avID FROM CollectionAttributeValues WHERE cID = ? AND cvID = ? AND akID = ?", $v);
	    				if (!$avID) continue;

	    				$query = $db->GetAll("
	    						SELECT opt.value
	    						FROM atSelectOptions opt,
	    						atSelectOptionsSelected sel

	    						WHERE sel.avID = ?
	    						AND sel.atSelectOptionID = opt.ID",$avID);

	    				foreach($query as $opt) {
	    						$handle = preg_replace('/\s*/', '', strtolower($opt['value']));
	    						$tagsObject->pageTags[$page->getCollectionID()][] =  $handle ;
	    						$tagsObject->tags[$handle] = $opt['value'];
	    				}
	    		endif ;
	    endforeach;
	    return $tagsObject;
	  }

		function getAreaStyles ($a,$c) {
			// $c = $a->getAreaCollectionObject();
			$style = $c->getAreaCustomStyle($a);
			if (is_object($style)) {
					$set = $style->getStyleSet();
					return $this->getAreaCSS($set);
			}
			return '';
		}
		public function getAreaCSS($set)
    {
        $groups = array();
        if ($set->getBackgroundColor()) {
            $groups[''][] = 'background-color:' . $set->getBackgroundColor();
        }
        $f = $set->getBackgroundImageFileObject();
        if (is_object($f)) {
            $groups[''][] = 'background-image: url(' . $f->getRelativePath() . ')';
            $groups[''][] = 'background-repeat: ' . $set->getBackgroundRepeat();
        }
        if ($set->getBaseFontSize()) {
            $groups[''][] = 'font-size:' . $set->getBaseFontSize();
        }
        if ($set->getTextColor()) {
            $groups[''][] = 'color:' . $set->getTextColor();
        }
        if ($set->getPaddingTop()) {
            $groups[''][] = 'padding-top:' . $set->getPaddingTop();
        }
        if ($set->getPaddingRight()) {
            $groups[''][] = 'padding-right:' . $set->getPaddingRight();
        }
        if ($set->getPaddingBottom()) {
            $groups[''][] = 'padding-bottom:' . $set->getPaddingBottom();
        }
        if ($set->getPaddingLeft()) {
            $groups[''][] = 'padding-left:' . $set->getPaddingLeft();
        }
        if ($set->getBorderWidth()) {
            $groups[''][] = 'border-width:' . $set->getBorderWidth();
        }
        if ($set->getBorderStyle()) {
            $groups[''][] = 'border-style:' . $set->getBorderStyle();
        }
        if ($set->getBorderColor()) {
            $groups[''][] = 'border-color:' . $set->getBorderColor();
        }
        if ($set->getAlignment()) {
            $groups[''][] = 'text-align:' . $set->getAlignment();
        }
        if ($set->getBorderRadius()) {
            $groups[''][] = 'border-radius:' . $set->getBorderRadius();
            $groups[''][] = '-moz-border-radius:' . $set->getBorderRadius();
            $groups[''][] = '-webkit-border-radius:' . $set->getBorderRadius();
            $groups[''][] = '-o-border-radius:' . $set->getBorderRadius();
            $groups[''][] = '-ms-border-radius:' . $set->getBorderRadius();
        }
        if ($set->getRotate()) {
            $groups[''][] = 'transform: rotate(' . $set->getRotate() . 'deg)';
            $groups[''][] = '-moz-transform: rotate(' . $set->getRotate() . 'deg)';
            $groups[''][] = '-webkit-transform: rotate(' . $set->getRotate() . 'deg)';
            $groups[''][] = '-o-transform: rotate(' . $set->getRotate() . 'deg)';
            $groups[''][] = '-ms-transform: rotate(' . $set->getRotate() . 'deg)';
        }
        if ($set->getBoxShadowSpread()) {
            $groups[''][] = 'box-shadow: ' . $set->getBoxShadowHorizontal() . ' ' . $set->getBoxShadowVertical() . ' ' . $set->getBoxShadowBlur() . ' ' . $set->getBoxShadowSpread() . ' ' . $set->getBoxShadowColor();
        }
        if ($set->getLinkColor()) {
            $groups[' a'][] = 'color:' . $set->getLinkColor() . ' !important';
        }

        $css = '';
        foreach($groups as $suffix => $styles) {
            $css .= implode(';', $styles);
        }

        return $css;
    }
		// Block Custom classes
		function setBlock ($b) {

			$new = false;
			// On definie le style de bloc que si il est completement different de celui déjà réglé dans la page
			if (!is_object($this->block)) {
				$this->block = $b;
				$new = true;
			}
			if ($b->getBlockTypeHandle() != $this->block->getBlockTypeHandle() ||
				  $b->getBlockID() != $this->block->getBlockID() ||
					$new
				 ):

				// on extrait les classes
				// Et on les sauvegardes
				$style = $b->getCustomStyle();
				$this->cc = (is_object($b) && is_object($style)) ? $style->getStyleSet()->getCustomClass() : '';
				$this->cs =  is_object($style) ? $style : false;

			endif;
		}

		function getClassSettingsString ($b) {
			$this->setBlock ($b);
			return $this->cc;
		}

		function getClassSettingsArray ($b) {
			$this->setBlock ($b);
			return explode(' ',  $this->cc);
		}

		function getClassSettingsPrefixInt ($b,$prefix,$string = false) {
			$this->setBlock ($b);
			$_string = $tring ? $string : $this->cc;
      preg_match('/' . $prefix . '-(\w+)/',$_string,$found);
      return isset($found[1]) ? (int)$found[1] : false;
	  }

		## return words AFTER $prefix (element-)primary
		function getClassSettingsPrefixString ($b,$prefix,$string = false) {
			$this->setBlock ($b);
			$_string = $tring ? $string : $this->cc;
      preg_match('/' . $prefix . '-(\w+)/',$_string,$found);
	    return isset($found[1]) ? $found[1] : false;
	  }

		function getCustomStyleImage ($b) {
			$this->setBlock ($b);
			if ($this->cs) {
			    $set = $this->cs->getStyleSet();
			    $image = $set->getBackgroundImageFileObject();
			    if (is_object($image)) {
			        return $image;
			    }
			}
			return false;
		}

		function getClassSettingsObject ($block, $defaultColumns = 3, $defaultMargin = 10  ) {
			$this->setBlock ($block);
			$styleObject = new StdClass();

			if ($this->cs) :
				// We get string as 'first-class second-class'
				$classes = $this->cc;
				// And get array with each classes : 0=>'first-class', 1=>'second-class'
				$classesArray = explode(' ', $classes);
				$styleObject->classesArray = $classesArray;

				// get Columns number
				preg_match("/(\d)-column/",$classes,$columns);
				$styleObject->columns = isset($columns[1]) ? (int)$columns[1] : (int)$defaultColumns;
				// Get margin number
				// If columns == 1 then we set margin to 0
				// If more columns, set margin to asked or to default.
				preg_match("/carousel-margin-(\d+)/",$classes,$margin);
				$styleObject->margin = $styleObject->columns > 1 ? (isset($margin[1]) ? (int)$margin[1] : (int)$defaultMargin ) : 0 ;
				// Get the 'no-text' class
				// The title is displayed by default
				$styleObject->displayTitle = array_search('no-text',$classesArray) === false;
			else :
				$styleObject->columns = (int)$defaultColumns;
				$styleObject->margin = (int)$defaultMargin;
				$styleObject->classesArray = array();
			endif;

			return $styleObject;

		}

	  function contrast ($hexcolor, $dark = '#000000', $light = '#FFFFFF') {
	      return (hexdec($hexcolor) > 0xffffff/2) ? $dark : $light;
	  }
}
