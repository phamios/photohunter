<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $site_title; ?></title>
        <meta name="description" content="<?php echo $site_des; ?>" />
        <meta name="keywords" content="<?php echo $site_keyword; ?>" />
        <meta name="author" content="<?php echo $site_name; ?>" />
        <link rel="stylesheet" href="<?php echo base_url('src/user2'); ?>/css/jquery-tilesgallery.css">
        <script src="<?php echo base_url('src/user2'); ?>/js/vendor/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url('src/user2'); ?>/js/jquery.tiles-gallery.js"></script>
        
        
        <link rel="icon" type="image/png" href="<?php echo base_url('fav.png');?>" /> 
        <meta property="og:title" content="<?php echo $site_title; ?>" />
        <meta property="og:url" content="<?php echo site_url();?>" />
        <meta property="og:image" content="<?php echo base_url('src/photo/Lyna04.png_1413218281.jpg')?>" />
        
        <script>
            $(function () {
                $(".tiles").tilesGallery({
                    tileMinHeight: 200
                });
            });
        </script>

        <?php
        $total_groups = ceil($total_records / 5);
        $cate_id = (int) end(explode("-", $this->uri->segment(2)));
        ?>

        <script type="text/javascript">
            $(document).ready(function () {

                var track_load = 0; //total loaded record group(s)
                var loading = false; //to prevents multipal ajax loads
                var total_groups = <?php echo $total_groups; ?>; //total record group(s)

                $(window).scroll(function () { //detect page scroll

                    if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
                    {

                        if (track_load <= total_groups && loading == false) //there's more data to load
                        {
                            loading = true; //prevent further ajax loading
                            $('.animation_image').show(); //show loading image

                            //load data from the server using a HTTP POST request
                            $.post('<?php echo site_url('ajax_load'); ?>', {'group_no': track_load}, function (data) {

                                $("#example_2").append(data); //append received data into the element

                                //hide loading image
                                $('.animation_image').hide(); //hide loading image once data is received

                                track_load++; //loaded group increment
                                loading = false;

                            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?

                                alert(thrownError); //alert with HTTP error
                                $('.animation_image').hide(); //hide loading image
                                loading = false;

                            });

                        }
                    }
                });
            });
        </script>

        <script src="<?php echo base_url('src/swipebox/'); ?>/lib/jquery-2.0.3.js"></script>
        <script src="<?php echo base_url('src/swipebox/'); ?>/src/js/jquery.swipebox.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('src/swipebox/'); ?>/src/css/swipebox.css">
        <script type="text/javascript">
            (function ($) {
                $('.swipebox').swipebox();
            })(jQuery);
        </script>
        
        <link rel="stylesheet" href="<?php echo base_url('src'); ?>/menu.css">
        <link rel="stylesheet" href="<?php echo base_url('src'); ?>/style.css">
    </head>
    <body>
        <div class="header_top">
            <h1><span class="site_web_title"><?php echo $site_name ?></span></h1>
        <p>
           <?php $this->load->view('user2/menu');?>
        </p>
        </div>
        <div id="example" class="tiles">
            <?php foreach ($list_images as $images): ?>
                <a class="swipebox" href="<?php echo base_url('src/photo/' . $images->gallery_name) ?>">
                    <p class='caption'><span><?php echo $images->cate_name;?></span></p>
                    <img src="<?php echo base_url('src/photo/' . $images->gallery_name) ?>" alt="image" />
                </a>
            <?php endforeach; ?>
        </div>  
        <div class="break_down"></div>
        <script>
            $(function () {
                $(".tiles_2").tilesGallery({
                    tileMinHeight: 200
                });
            });
        </script>

        <div id="example_2" class="tiles_2" style="clear:both;">

        </div> 
        
        <div class="break_down"></div>
        <div class="footer">
            Copyright <a href="<?php echo site_url();?>"><?php echo $site_title; ?></a>
            
        </div>

    </body>
</html>
