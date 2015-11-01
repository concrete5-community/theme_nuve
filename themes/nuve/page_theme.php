<?php
namespace Concrete\Package\ThemeNuve\Theme\Nuve;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

        $this->requireAsset('javascript', 'jquery');
				$this->requireAsset('javascript', 'velocity');
				$this->requireAsset('javascript', 'velocity.ui');
				$this->requireAsset('javascript', 'main');
				$this->requireAsset('javascript', 'modernizr');

        $this->requireAsset('css', 'font-awesome');
				$this->requireAsset('css', 'reset');
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
}
