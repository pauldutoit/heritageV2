<div class="lc_content_full lc_swp_boxed lc_basic_content_padding">

        <?php
        $has_thumbnail_class = "";
        if(has_post_thumbnail()) {
            $has_thumbnail_class = "has_thumbnail";
            the_post_thumbnail('full');
        }
        ?>

        <div class="single_post_title <?php echo esc_attr(esc_attr($has_thumbnail_class)); ?>">
            <h1> <?php the_title(); ?> </h1>
            <?php get_template_part('templates/utils/post_meta');  ?>
        </div>

        <div class="clearfix">
            <div class="post_content_left">
                <?php get_template_part('templates/utils/sharing_icons'); ?>
                <?php get_template_part('templates/utils/author_info'); ?>
            </div>
            <div class="post_content_right">
                <?php the_content(); ?>
                <?php get_template_part('templates/utils/post_tags'); ?>
            </div>
        </div>

        <?php
        $args = array(
            'before'           => '<div class="pagination_links">' . esc_html__('Pages:', 'heritage'),
            'after'            => '</div>',
            'link_before'      => '<span class="pagination_link">',
            'link_after'       => '</span>',
            'next_or_number'   => 'number',
            'nextpagelink'     => esc_html__('Next page', 'heritage'),
            'previouspagelink' => esc_html__('Previous page', 'heritage'),
            'pagelink'         => '%',
            'echo'             => 1
        );
        ?>
        <?php wp_link_pages( $args ); ?>


        <?php get_template_part('templates/utils/related_posts'); ?>
        <?php comments_template(); ?>
</div>