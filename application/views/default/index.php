<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $site_title; ?></title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="<?php echo $site_des; ?>" />
        <meta name="keywords" content="<?php echo $site_keyword; ?>" />
        <meta name="author" content="<?php echo $site_name; ?>" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('src/default'); ?>/js/jquery.montage.min.js"></script>
        
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/default'); ?>/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/default'); ?>/css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css' />
        
         <!-- ----------Box Light -->
    <script type="text/javascript" src="<?php echo base_url('src/home'); ?>/lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="<?php echo base_url('src/home'); ?>/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/home'); ?>/source/jquery.fancybox.css?v=2.1.5" media="screen" />

    <script type="text/javascript" src="<?php echo base_url('src/menu2'); ?>/menu.js"></script>
    <link type="text/css" href="<?php echo base_url('src/menu2'); ?>/menu.css" rel="stylesheet" />
    
    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        } 
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
                /*
                 *  Simple image gallery. Uses default settings
                 */

                 $('.fancybox').fancybox();

                /*
                 *  Different effects
                 */

             });
    </script> 
        
    </head>
    <body style="background:#000;">
        <div class="container">
            <?php $this->load->view('default/header'); ?>

            <div class="am-container" id="am-container">
               
            </div>
            <div class="animation_image" style="display:none" align="center"><img src="<?php echo base_url('ajax-loader.gif'); ?>"></div> 
             
        </div>
        
         

        <?php
        $total_groups = ceil($total_records / 5);
        $cate_id = (int) end(explode("-", $this->uri->segment(2)));
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                var track_load = 0; //total loaded record group(s)
                var loading = false; //to prevents multipal ajax loads
                var total_groups = <?php echo $total_groups; ?>; //total record group(s)

                $('#am-container').load("<?php echo site_url('ajax_load/index/' . $cate_id); ?>", {'group_no': track_load}, function () {
                    track_load++;
                }); //load first group

                $(window).scroll(function () { //detect page scroll

                    if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
                    {

                        if (track_load <= total_groups && loading == false) //there's more data to load
                        {
                            loading = true; //prevent further ajax loading
                            $('.animation_image').show(); //show loading image

                            //load data from the server using a HTTP POST request
                            $.post('<?php echo site_url('ajax_load'); ?>', {'group_no': track_load}, function (data) {

                                $("#am-container").append(data); //append received data into the element

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
    </body>
</html>