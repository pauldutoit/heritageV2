<?php
?>
<?php
if ( !have_comments() && !comments_open(get_the_ID()) )
{
    return;
}
?>
<div id="comments">
    <?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php esc_html__('This post is password protected. Enter the password to view any comments.', 'heritage'); ?></p>
</div><!-- #comments -->
<?php
/* Stop the rest of comments.php from being processed,
 * but don't kill the script entirely -- we still have
 * to fully load the template.
 */
return;
endif;
?>

<?php
// You can start editing here -- including this comment!
?>
<?php if ( have_comments() ) :
    $titles_align = HERITAGE_get_titles_alignment_class();
    ?>
    <h3 id="comments-title" class="<?php echo esc_attr($titles_align); ?>">
        <?php
        echo esc_html__("Comments ", "heritage")."&#40;".get_comments_number()."&#41";
        ?>

    </h3>

    <?php if ( get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous">
            <?php
            $allowed_tags = array(
                'span' => array(
                    'class'	=> array()
                )
            );

            previous_comments_link(wp_kses(__('<span class="meta-nav">&larr;</span> Older Comments', 'heritage'), $allowed_tags));
            ?>
        </div>

        <div class="nav-next">
            <?php
            $allowed_tags = array(
                'span' => array(
                    'class'	=> array()
                )
            );

            next_comments_link(wp_kses(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'heritage'), $allowed_tags)); ?>
        </div>
    </div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

    <ul class="commentlist">
        <?php
        wp_list_comments(
            array(
                'callback' => 'HERITAGE_comment'
            )
        );
        ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous">
            <?php
            $allowed_tags = array(
                'span' => array(
                    'class'	=> array()
                )
            );

            previous_comments_link(wp_kses(__('<span class="meta-nav">&larr;</span> Older Comments', 'heritage'), $allowed_tags));
            ?>
        </div>

        <div class="nav-next">
            <?php
            $allowed_tags = array(
                'span' => array(
                    'class'	=> array()
                )
            );
            next_comments_link(wp_kses(__( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'heritage' ), $allowed_tags));
            ?>
        </div>
    </div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

    <?php
    /* If there are no comments and comments are closed, let's leave a little note, shall we?
     * But we only want the note on posts and pages that had comments in the first place.
     */
    if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="nocomments"><?php esc_html__( 'Comments are closed.' , 'heritage' ); ?></p>
    <?php endif;  ?>

<?php endif; // end have_comments() ?>

<?php
$titles_align = HERITAGE_get_titles_alignment_class();

$cmt_form_class = $titles_align;
$cmt_form_class .= "_btnform";
$cmt_form_class .= ' comment-form'; /*add default comment form class now*/

$commentFormArgs = array(
    'class_form'			=> $cmt_form_class,
    'title_reply'       	=> esc_html__('Leave a Comment', 'heritage'),
    'title_reply_before'	=> '<h3 id="reply-title" class="comment-reply-title '.$titles_align.'">',
    'title_reply_after'		=> '</h3>',
    'class_submit'			=> 'lc_button'
);
comment_form($commentFormArgs);

?>

</div>
<!-- #comments -->
