<?php defined('C5_EXECUTE') or die("Access Denied.");
if(!$c->isEditMode()) :
  $transition_handle = $c->getAttribute('scroll_transition');
  if (is_object($transition_handle)) $transition_handle = $transition_handle->current()->getSelectAttributeOptionValue();
  $hijacking = $c->getAttribute('hijacking') ? 'on' : 'off';
else :
  $transition_handle = 'none';
  $hijacking = 'off';
endif;
$primary_color = $c->getAttribute('primary_color');
if (is_object($primary_color)) $primary_color = $primary_color->current()->getSelectAttributeOptionValue();
else $primary_color = 'blue_grey';
$accent_color = $c->getAttribute('accent_color');
if (is_object($accent_color)) $accent_color = $accent_color->current()->getSelectAttributeOptionValue();
else $accent_color = 'pink';

?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.<?php echo $primary_color . '-' . $accent_color?>.min.css">
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?php Loader::element('header_required', array('pageTitle' => $pageTitle));?>
    <?php echo $html->css($view->getStylesheet('main.less')); ?>
</head>
<body class="<?php echo $c->isEditMode() ? 'edit-mode' : '' ?>" data-hijacking="<?php echo $hijacking?>" data-animation="<?php echo $transition_handle?>">
  <div class="<?php echo $c->getPageWrapperClass()?>">
