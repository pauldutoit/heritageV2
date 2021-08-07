<?php get_header(); ?>

    <div class="lc_content_full lc_swp_boxed lc_basic_content_padding">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            $has_thumbnail_class = "";
            if(has_post_thumbnail()) {
                $has_thumbnail_class = "has_thumbnail";
                the_post_thumbnail('full');
            }
            ?>


        <?php
            $locale = __('Cart', 'heritage') . __('My account', 'heritage');

            ?>
            <div class="single_post_title <?php echo esc_attr(/*HERITAGE_get_titles_alignment_class())*/"center").esc_attr($has_thumbnail_class); ?>">
                <?php
                if (is_page_template("default")) {
                    ?>

                    <h1> <?php trim(the_title()) ?> </h1> <?php
                }
                ?>

                <?php get_template_part('templates/utils/post_meta');  ?>
            </div>
            <div class="standard_page_content">
                <?php the_content();  ?>
            </div>
            <?php get_template_part('templates/utils/sharing_icons'); ?>
            <?php comments_template(); ?>
        <?php endwhile; else : ?>
            <p><?php esc_html__('Sorry, no posts matched your criteria.', 'heritage'); ?></p>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>