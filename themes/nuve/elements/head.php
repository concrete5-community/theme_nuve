<?php defined('C5_EXECUTE') or die("Access Denied.");
?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php Loader::element('header_required', array('pageTitle' => $pageTitle));?>
    <?php echo $html->css($view->getStylesheet('main.less')); ?>
</head>
<body class="<?php echo $c->isEditMode() ? 'edit-mode' : '' ?>" data-hijacking="off" data-animation="scaleDown">
    <div class="<?php echo $c->getPageWrapperClass()?> <?php echo $c->getAttribute('boxed_layout_mode') ? 'boxed-wrapper' : '' ?>">
