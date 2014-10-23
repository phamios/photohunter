<!-- Static navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?php echo $site_name?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">PhotoHunter</a>
    </div>
    <div class="navbar-collapse collapse">

        <!-- Left nav -->
        <ul class="nav navbar-nav">
            <?php foreach($list_menu as $menu):?>
                <li><a href="#"><?php echo $menu->cate_name; ?></a>
                    <ul class="dropdown-menu">
                        <?php foreach($sub_menu as $sub):?>
                            <?php if($sub->cate_root == $menu->id):?>
                                <li><a href="<?php echo site_url('photo/'.create_slug($sub->cate_name).'-'.$sub->id.'.html');?>" ><?php echo $sub->cate_name;?></a></li>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </li>
            <?php endforeach;?>
        </ul>

        <!-- Right nav -->
        <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $facebook_link;?>">Facebook</a></li>
            <li><a href="<?php echo $twitter_link;?>">Twitter</a></li>
            <li><a href="<?php echo $skype_link;?>">Skype</a></li>
            <li><a href="<?php echo $download_link;?>">Cost</a></li> 
            <li></li>
        </ul>

    </div><!--/.nav-collapse -->
</div>