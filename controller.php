<?php

namespace Concrete\Package\ThemeNuve;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use \Concrete\Core\Backup\ContentImporter as ContentImporter;
use Concrete\Package\ThemeNuve\Src\Helper\RbInstaller;
use PageType;

defined('C5_EXECUTE') or die('Access Denied.');


class Controller extends \Concrete\Core\Package\Package {

	protected $pkgHandle = 'theme_nuve';
	protected $appVersionRequired = '5.7.5';
	protected $pkgVersion = '0.2.3';
	protected $pkgAllowsFullContentSwap = true;
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
		$al->register( 'javascript', 'imageloaded', 'js/imageloaded.js', array('version' => '3.1.8'), $this );
		$al->register( 'javascript', 'isotope', 'js/isotope.pkgd.min.js', array('version' => '2.1.1'), $this );
		$al->register( 'javascript', 'element-masonry', 'js/element-masonry.js', array('version' => '1'), $this );
		$al->register( 'javascript', 'nuve', 'js/nuve.js',array(), $this );

		$al->register( 'css', 'nuve-style', 'themes/nuve/css/static/style.css', array(), $this );
		$al->register( 'css', 'bootstrap-custom', 'themes/nuve/css/static/bootstrap.custom.min.css', array(), $this );
		$al->register( 'css', 'animate', 'themes/nuve/css/static/animate.css', array(), $this );
 	}
	public function install($data = array()) {
	// Get the package object
		$this->pkg = parent::install();

	// Installing
		 $this->installOrUpgrade($data);
	}

	public function upgrade () {
		$this->pkg = $this;
		$this->installOrUpgrade();
	}

	private function installOrUpgrade($data = array()) {

		$ci = new RbInstaller($this->pkg);
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/themes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/attributes.xml');
		$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_templates.xml');
		if (!isset($data['pkgDoFullContentSwap']) || $data['pkgDoFullContentSwap'] === '0') :
			$ci->importContentFile($this->getPackagePath() . '/config/install/base/pages.xml');
			if (!is_object(PageType::getByHandle('blog_entry')))
				$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_type_blog.xml');
			if (!is_object(PageType::getByHandle('work')))
				$ci->importContentFile($this->getPackagePath() . '/config/install/base/page_type_work.xml');
		endif;
	}

}
