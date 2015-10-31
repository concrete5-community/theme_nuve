<?php

namespace Concrete\Package\ThemeBoileplate;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use \Concrete\Core\Backup\ContentImporter as ContentImporter;
use Concrete\Package\ThemeBoileplate\Src\Helper\RbInstaller;

defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_boileplate';
	protected $appVersionRequired = '5.7.5';
	protected $pkgVersion = '0.1';
	protected $pkg;
	
	public function getPackageDescription() {
		return t("A perfectly crafted template that use all the power of concret5.7");
	}

	public function getPackageName() {
		return t("Boileplate Theme");
	}
 	public function on_start() {
 		$al = AssetList::getInstance();
 		$al->register( 'javascript', '', 'js/.js',null, $this );
 		$al->register( 'css', '', 'themes/Boileplate/css/addons/.css', null, $this );

 	}
	public function install() {

	// Get the package object
		$this->pkg = parent::install();

	// Installing
		 $this->installOrUpgrade();
	}

	public function upgrade () {
		$this->pkg = $this;
		$this->installOrUpgrade();
	}

	private function installOrUpgrade() {

		$ci = new RbInstaller($this->pkg);
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/themes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_templates.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/blocktypes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/attributes.xml');


	}

}
