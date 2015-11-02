<?php

namespace Concrete\Package\ThemeNuve;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use \Concrete\Core\Backup\ContentImporter as ContentImporter;
use Concrete\Package\ThemeNuve\Src\Helper\RbInstaller;

defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_nuve';
	protected $appVersionRequired = '5.7.5';
	protected $pkgVersion = '0.1.1';
	protected $pkg;

	public function getPackageDescription() {
		return t("A One page theme with sections navigation");
	}

	public function getPackageName() {
		return t("Nuve Theme");
	}
 	public function on_start() {
 		$al = AssetList::getInstance();
 		$al->register( 'javascript', 'main', 'js/main.js',array(), $this );
		$al->register( 'javascript', 'modernizr', 'js/modernizr.js',array(), $this );
		$al->register( 'javascript', 'velocity', 'js/velocity.min.js',array(), $this );
		$al->register( 'javascript', 'velocity.ui', 'js/velocity.ui.min.js',array(), $this );
 		$al->register( 'css', 'reset', 'themes/nuve/css/static/reset.css', array(), $this );
		$al->register( 'css', 'nuve-style', 'themes/nuve/css/static/style.css', array(), $this );
		$al->register( 'css', 'bootstrap-custom', 'themes/nuve/css/static/bootstrap.custom.min.css', array(), $this );

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
