<?php
namespace CleanTheme\Components;

class ActionIcon
{
    public static function render($parent_class = null, $data = null)
    {
        if (empty($data) || empty($data['enable'])) {
            return;
        }

        $type = $data['action_style'] ?? 'arrows';
        $message = $data['message'] ?? null;
        $dir = null;
        $class_name = $parent_class . ' action-icon action-icon--type-' . $type;

        $last_arrow_attr = null;

        if ($type == 'arrows') {
            $dir = $data['direction'] ?? 'down';
            $class_name .= ' action-icon--dir-' . $dir;

            if ($dir == 'down' || $dir == 'right') $last_arrow_attr = 'animate';
        }
        ?>
            <div class="<?=  $class_name ?>">
                <?php if ($type == 'arrows'): ?>
                    <div class="action-icon__arrows">
                        <div class="action-icon__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                                <path d="M8 15L0.999999 8L8 1" stroke="#EF3F50" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="action-icon__arrow" data-animate="<?= $last_arrow_attr ?>" data-dir="<?= $dir ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                                <path d="M8 15L0.999999 8L8 1" stroke="#EF3F50" stroke-opacity="0.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <!-- /.action-icon__arrows -->
                <?php endif ?>

                <?php if($message): ?>
                    <div class="action-icon__text absolute"><?=  $message ?></div>
                <?php endif ?>
            </div>
        <?php
    }
}