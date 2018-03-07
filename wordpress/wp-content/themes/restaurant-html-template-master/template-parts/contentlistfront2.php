<?php
$img_url = get_template_directory_uri() . '/images/default.jpg';
if(has_post_thumbnail()){
    $img_url = get_the_post_thumbnail_url();
}
?>
<li class="col-mg-6 wow dif-par fadeInLeft especial" data-wow-duration="300ms" data-wow-delay="300ms">
    <div class="content-right nuevos-enlaces">
        <a href="<?php echo get_post_permalink(); ?>" class="title-bold-font"><h3 class="content-link"><?php the_title(); ?></h3></a><hr>
        <span class="cosica"><?php the_excerpt(); ?></span>
    </div>
    <div class="blog-img-2">
        <img class="front-page-pic" src="<?php echo $img_url; ?>" alt="blog-img">
    </div>
    <div class="content-extra nuevos-enlaces title-font">
        <i class="front-page-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 44); ?></i>&nbsp;&nbsp;<br>
        <?php the_author_posts_link(); ?><br><br>
        <span class="cosica"><?php the_time('j-m-Y'); ?></span>
    </div>
</li>