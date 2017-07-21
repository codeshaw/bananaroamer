<!DOCTYPE html>

<html >

<head>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?php wp_head(); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        TRACKING.init(["0QMDKF0I6jklMx12jKlxxsLpTLdAv8PgH"]);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA61W21e0bNtRILW4NQw5LcLBbtArFKu_g&callback=initMap"
            async defer>
    </script>

</head>

<body >

<!-- Not using a header tag as I want to use the same crappy div structure -->
<div class="image_a">
    <div class="header">
        <h1 class="title"><?php bloginfo('name'); ?></h1>
        <h3 class="title"><?php bloginfo('description'); ?></h3>
        <?php if ( has_nav_menu( 'primary-menu' ) ) wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
    </div>
    <?php if (!is_singular()) : ?>
    <div class="post">
        <div class="postHeader">
            <h1>Current Tracked Location</h1>
        </div>
        <div id="map"></div>
    </div>
    <?php endif; ?>
</div>

<!-- MAIN LOOP -->
<?php if (have_posts()) :

    while (have_posts()) : the_post(); ?>
        <div class="<?php wanderlost_get_background();?>">

            <div <?php post_class('post'); ?>>

                <div class="postHeader">
                    <h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <h4><?php the_date(); ?> at <?php the_time(); ?> by <?php the_author(); ?></h4>
                </div>

                <?php the_content(); ?>

                <?php if (is_singular()) wp_link_pages(); ?>

                <?php if (get_post_type() == 'post') : ?>

                    <div class="meta">

                        <p><a href="<?php the_permalink(); ?>"
                              title="<?php the_title_attribute(); ?>"><?php the_time(get_option('date_format')); ?></a>
                        </p>

                        <?php if (is_singular('post')) : ?>
                            <p>In <?php the_category(', '); ?></p>
                            <p><?php the_tags(' #', ' #', ' '); ?></p>
                        <?php endif; ?>

                    </div> <!-- .meta -->

                <?php endif; ?>

            </div>
        </div>

    <?php endwhile;
    else : ?>

        <div class="post">
            <p>Sorry, the page you requested cannot be found.</p>
        </div> <!-- .post -->

<?php endif; ?>
<!-- END MAIN LOOP -->

<?php if ((!is_singular()) && ($wp_query->post_count >= get_option('posts_per_page'))) : ?>
    <div class="<?php wanderlost_get_background();?>">
        <div class="pagination">
            <p>
            <?php previous_posts_link('&larr; ' . __('Newer posts', 'bananaroamer')); ?>
            <?php next_posts_link(__('Older posts', 'bananaroamer') . ' &rarr;'); ?>
            </p>
        </div> <!-- .pagination -->
    </div>
<?php endif; ?>

<!--<footer>-->
<!--    <p>&copy; --><?php //echo date( 'Y' ); ?><!-- <a href="--><?php //echo esc_url( home_url() ); ?><!--">--><?php //bloginfo( 'name' ); ?><!--</a>-->
<!--    Theme by <a href="http://www.bananaroamer.com">Bradshaw</a></p>-->
<!--</footer> <!-- footer -->-->

<?php wp_footer(); ?>

</body>
</html>