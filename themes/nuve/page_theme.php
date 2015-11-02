<?php
namespace Concrete\Package\ThemeNuve\Theme\Nuve;

defined('C5_EXECUTE') or die('Access Denied.');

use Page;

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

        $this->requireAsset('javascript', 'jquery');
				$this->requireAsset('javascript', 'velocity');
				$this->requireAsset('javascript', 'velocity.ui');
				$this->requireAsset('javascript', 'main');
				$this->requireAsset('javascript', 'modernizr');

        $this->requireAsset('css', 'font-awesome');
				$this->requireAsset('css', 'reset');
				$this->requireAsset('css', 'bootstrap-custom');
				$this->requireAsset('css', 'nuve-style');
	}

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeBlockClasses()
    {
        return array(
            'page_list' => array('simple-block'),
        );
    }

    public function getThemeAreaClasses()
    {
			// For multiple area
			$main_area = array('Main');
			$area_classes = array(
					// Colors
					'area-primary','area-secondary','area-tertiary','area-quaternary','area-white','area-black','area-body',
					// Spacing
					'area-space-s','area-space-m','area-space-l','area-space-xl',
					// Topics
					'topic-get-in-touch','topic-idea','topic-help','topic-config','topic-news','topic-conversation',
					// Animation
					'wow','flipInX','fadeInDown','zoomIn'
					);
			for ($i=1; $i < 8; $i++) {
					$main_area['Main - ' . $i] = $area_classes;
					$main_area['Main Column ' . $i] = $area_classes;
					$main_area['Main Column 1 - ' . $i] = $area_classes;
					$main_area['Main Column 2 - ' . $i] = $area_classes;
					$main_area['Main Column 3 - ' . $i] = $area_classes;
					$main_area['Main Column 4 - ' . $i] = $area_classes;
			}
        // Default array
        $other_area = array(
            'Header Info' => array('header-info-wrapped')
        );

        // return array_merge($main_area,$other_area);
    }

    public function getThemeEditorClasses()
    {
        return array(
            array('title' => t('Button Primary'), 'menuClass' => '', 'spanClass' => 'btn btn-primary')
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
}
