<?php
namespace CleanTheme\Components;


class ProjectSlide {
    public static function render($parent_class = null, $slide_data = null) {
        if (empty($slide_data)) {
            return;
        }

        $link = $slide_data['project_link'];
        $title = $slide_data['project_title'];
        $description = $slide_data['description'];
        $image = $slide_data['image'];

        
        ?>
        <div class=" <?= $parent_class ?> project-slide relative o-hid w-full flex-col j-end">
                            
            <?php if (!empty($image)): ?>
                <div class="project-slide__img-wrap absolute wh-full inset">
                    <?= wp_get_attachment_image($image['ID'], 'large', false, ['class' => 'project-slide__img w-full cover-image']); ?>
                </div>
            <?php endif; ?>

            <div class="project-slide__content flex-col relative">
                <?php if (!empty($title)): ?>
                    <h4 class="project-slide__slide-title fz-h3"><?= esc_html($title) ?></h4>
                <?php endif; ?>
                
                <?php if (!empty($description)): ?>
                    <div class="project-slide__desc fz-p">
                        <?= wp_kses_post($description) ?>
                    </div>
                <?php endif; ?>
            </div>

            <a href="<?= esc_url($link) ?>" class="project-slide__link absolute inset wh-full" target="_blank" rel="noopener noreferrer">
                <?= $title ?>
            </a>
        </div>
        <?php
    }
}