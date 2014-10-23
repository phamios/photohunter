<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $site_title; ?></title>
        <meta name="description" content="<?php echo $site_des; ?>" />
        <meta name="keywords" content="<?php echo $site_keyword; ?>" />
        <meta name="author" content="<?php echo $site_name; ?>" />
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/home'); ?>/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/home'); ?>/css/component.css" />
        <script src="<?php echo base_url('src/home'); ?>/js/modernizr.custom.js"></script>

        <script src="<?php echo base_url('src');?>/jquery.min.js"></script>

        <!-- ----------Box Light -->
        <script type="text/javascript" src="<?php echo base_url('src/home'); ?>/lib/jquery.mousewheel-3.0.6.pack.js"></script>

        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="<?php echo base_url('src/home'); ?>/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/home'); ?>/source/jquery.fancybox.css?v=2.1.5" media="screen" />


        <style type="text/css">
            .fancybox-custom .fancybox-skin {
                box-shadow: 0 0 50px #222;
            } 
        </style>

        <script type="text/javascript">
            $(document).ready(function () {
                /*
                 *  Simple image gallery. Uses default settings
                 */

                $('.fancybox').fancybox();
            });
        </script> 
        <link href="<?php echo base_url('src/menu/'); ?>/libs/demo-assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
        <!-- SmartMenus jQuery Bootstrap Addon CSS -->
        <link href="<?php echo base_url('src/menu/'); ?>/addons/bootstrap/jquery.smartmenus.bootstrap.css" rel="stylesheet">

    </head>
    <body>
        <?php $this->load->view('home/menu'); ?>
        <div class="container">
            <?php $this->load->view('home/header_load'); ?>
            <div id="grid-gallery" class="grid-gallery">
                <section class="grid-wrap">
                    <ul class="grid">
                        <li class="grid-sizer"></li><!-- for Masonry column width -->
                        <div id="content_gallery" class="content_gallery">

                        </div>

                    </ul>
                </section><!-- // grid-wrap -->

            </div><!-- // grid-gallery -->
        </div>
        <div class="animation_image" style="display:none" align="center"><img src="<?php echo base_url('ajax-loader.gif'); ?>"></div> 
        <script src="<?php echo base_url('src/home'); ?>/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo base_url('src/home'); ?>/js/masonry.pkgd.min.js"></script>
        <script src="<?php echo base_url('src/home'); ?>/js/classie.js"></script>
        <script src="<?php echo base_url('src/home'); ?>/js/cbpGridGallery.js"></script>
        <script>
            new CBPGridGallery(document.getElementById('grid-gallery'));
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

                $('#content_gallery').load("<?php echo site_url('ajax_load/index/' . $cate_id); ?>", {'group_no': track_load}, function () {
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

                                $("#content_gallery").append(data); //append received data into the element

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



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="<?php echo base_url('src/menu/'); ?>/libs/demo-assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- SmartMenus jQuery plugin -->
        <script type="text/javascript" src="<?php echo base_url('src/menu/'); ?>/jquery.smartmenus.js"></script>

        <!-- SmartMenus jQuery Bootstrap Addon -->
        <script type="text/javascript" src="<?php echo base_url('src/menu/'); ?>/addons/bootstrap/jquery.smartmenus.bootstrap.js"></script>

        <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', '<?php echo $ga_tracking; ?>', 'auto');
        ga('send', 'pageview');

        </script>

    </body>
</html>
