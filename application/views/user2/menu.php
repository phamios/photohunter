<ul class="nav"> 
    <li >
        <a href="<?php echo site_url(); ?>">Home</a>
    </li>
    <?php if ($list_menu): ?>
        <?php foreach ($list_menu as $menu): ?>
            <li class="dropdown"><a href="<?php echo site_url('photo/' . create_slug($menu->cate_name) . '-' . $menu->id . '.html'); ?>"><?php echo $menu->cate_name; ?></a>
                <ul>
                    <?php foreach ($sub_menu as $sub): ?>
                        <?php if ($sub->cate_root == $menu->id): ?>
                            <li><a href="<?php echo site_url('photo/' . create_slug($sub->cate_name) . '-' . $sub->id . '.html'); ?>" ><?php echo $sub->cate_name; ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
    <li >
        <a href="<?php echo site_url(); ?>">Contact</a>
    </li>
    <li >
        <a href="<?php echo $facebook_link; ?>">Facebook</a>
    </li>

</ul>
