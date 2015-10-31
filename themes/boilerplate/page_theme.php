<?php
namespace Concrete\Package\ThemeBoileplate\Theme\Boileplate;

defined('C5_EXECUTE') or die('Access Denied.');

class PageTheme extends \Concrete\Core\Page\Theme\Theme  {

	public function registerAssets() {

        $this->requireAsset('javascript', 'jquery');

        $this->requireAsset('css', 'font-awesome');
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
        $area_classes = array('primary','secondary','tertiary','quaternary','white','black');
        for ($i=1; $i < 8; $i++) {
            $main_area['Main - ' . $i] = $area_classes;
        }
        // Default array
        $other_area = array(
            'Header Info' => array('header-info-wrapped'),
        );

        return array_merge($main_area,$other_area);
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
