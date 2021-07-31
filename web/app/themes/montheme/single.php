<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
    switch(get_post_type(get_the_ID())) {
        /*TODO: add views for other custom post types*/
        default:
            get_template_part('templates/single/default_single');
            break;
    }

    ?>
<?php endwhile; else : ?>
    <div class="lc_content_full lc_swp_boxed">
        <p><?php esc_html__('Sorry, no posts matched your criteria.', 'heritage'); ?></p>
    </div>
<?php endif; ?>


<?php get_footer(); ?>