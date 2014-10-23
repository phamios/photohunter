<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $site_title; ?></title>
        <meta name="description" content="Gamma Gallery - A Responsive Image Gallery Experiment"/>
        <meta name="keywords" content="html5, responsive, image gallery, masonry, picture, images, sizes, fluid, history api, visibility api"/>
        <meta name="author" content="Codrops"/>
        <link rel="shortcut icon" href="../favicon.ico"> 

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/home3'); ?>/css/style.css"/> 


        <link type="text/css" href="<?php echo base_url('src/home3'); ?>/menu/menu.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url('src/home3'); ?>/menu/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url('src/home3'); ?>/menu/menu.js"></script>


 
        <script src="<?php echo base_url('src/'); ?>/swipebox/lib/ios-orientationchange-fix.js"></script>
	<script src="<?php echo base_url('src/'); ?>/swipebox/lib/jquery-2.1.0.min.js"></script>
	<script src="<?php echo base_url('src/'); ?>/swipebox/src/js/jquery.swipebox.js"></script>
	<script type="text/javascript">
		;( function( $ ) {

			/* Basic Gallery */
			$( '.swipebox' ).swipebox();
			
			/* Video */
			$( '.swipebox-video' ).swipebox();

			/* Dynamic Gallery */
			$( '#gallery' ).click( function( e ) {
				e.preventDefault();
				$.swipebox( [
					{ href : 'http://swipebox.csag.co/mages/image-1.jpg', title : 'My Caption' },
					{ href : 'http://swipebox.csag.co/images/image-2.jpg', title : 'My Second Caption' }
				] );
			} );

		} )( jQuery );
	</script>

    </head>
    <body>
        <div class="container">
            <?php $this->load->view('front/header'); ?>

            <div class="main">
                <header class="clearfix">

                    <h1><?php echo $site_name ?><span><?php echo $site_des; ?></span></h1>

                    <div class="support-note">
                        <span class="note-ie">

                        </span>
                    </div>

                </header>

                <div class="gamma-container gamma-loading" id="gamma-container">

                    <div id="container">

                    </div> 
                </div>

            </div><!--/main-->


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

                $('#container').load("<?php echo site_url('ajax_load/index/' . $cate_id); ?>", {'group_no': track_load}, function () {
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

                                $("#container").append(data); //append received data into the element

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
