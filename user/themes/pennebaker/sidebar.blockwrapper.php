<section class="widget <?php echo $block->css_classes; ?>">
    <div class="inner">
    <?php if($block->_show_title): ?>
        <h1><?php echo $block->title; ?></h1>
    <?php endif; ?>
    
    <?php echo $content; ?>
    </div>
</section>