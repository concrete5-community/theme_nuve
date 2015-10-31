<?php defined('C5_EXECUTE') or die("Access Denied.");

//  Make test to know if they are blocks in the inf-bar to add padding and other styling

$header_info = new GlobalArea('Header Info');
$Header_social = new GlobalArea('Header Social');
$header_image = new Area('Header Image');

$blocks_in_info_bar = $header_info->getTotalBlocksInArea($c) > 0 || $Header_social->getTotalBlocksInArea($c) > 0 || $c->isEditMode();
$blocks_in_header_image = $header_image->getTotalBlocksInArea($c) > 0 || $c->isEditMode();

$page_header_image_attribute = 'Boileplate_header_image';
$img = $c->getAttribute($page_header_image_attribute);
if (is_object($img)) :
    $iv = $img->getVersion();
    $path = $iv->getRelativePath();
    $img_width = $iv->getAttribute('width');
    // We iagine that a image pattern (repeatable) is small than 150px
    $is_pattern = $img_width < 150;
endif;

$display_header_content_in_image = isset($path);

$video_background = $c->getAttribute('Boileplate_youtube_backround_url');

?>

<header>
    <div class="info-bar <?php if($blocks_in_info_bar): ?>with-blocks<?php endif ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-10 header-info">
                    <?php $header_info->display() ?>                            
                </div>
                <div class="col-md-2 header-social">
                    <?php $Header_social->display()?>                            
                </div>
            </div><!-- /.row -->        
        </div><!-- /.container -->
    </div><!-- /.info-bar -->
    
    <div class="page-header <?php if($path): ?>with-image<?php endif ?>" <?php if($path): ?>style="background-image:url(<?php echo $path ?>)"<?php endif ?>>
        <?php if ($video_background) : ?><div id="video_header_bg" class="elementPlayer" ><?php endif ?>
        <div class="container">
            <div class="row">
                <?php if($display_header_content_in_image) : ?>
                <div class="intro-content-in-image">
                    <?php
                        $a = new Area('Header Content');
                        $a->enableGridContainer();
                        $a->display($c);
                    ?>                     
                </div>
                <a href="#" class="gotobottom"><i class="fa fa-arrow-circle-o-down"></i></a>
                <?php endif ?>
                <div class="col-md-4 logo">
                    <?php
                    $a = new GlobalArea('Site Name');
                    $a->display();
                    ?>                    
                </div>
                <nav class="col-md-8 main-nav">
                    <?php
                    $a = new GlobalArea('Header Navigation');
                    $a->display();
                    ?>
                </nav>                
            </div><!-- /.row -->
        </div><!-- /.container -->
         <?php if ($video_background) : ?></div><?php endif ?>
    </div><!-- /.page-header -->
</header>
<?php if ($video_background) : ?>
    <a id="mb_YTPlayer" class="player" data-property="{videoURL:'<?php echo $video_background ?>',containment:'#video_header_bg',startAt:0,mute:false,autoPlay:true,loop:true,opacity:1}"></a>
<?php endif ?>  

<article class="header-image <?php if ($blocks_in_header_image) : ?>with-blocks <?php endif ?>">
    <?php $header_image->display($c)?> 
</article>

<?php if(!$display_header_content_in_image): // ?>
<article class="intro-content"><!-- A header with grid container -->
    <?php
        $a = new Area('Header Content');
        $a->enableGridContainer();
        $a->display($c);
    ?> 
</article>
<?php endif ?>