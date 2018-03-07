<?php 
    global $count;
    $count++;
?>
<tr class="<?php echo ($count % 2 == 0) ? 'par' : 'impar'; ?>">
    <td><h4><?php echo $count; ?></h4></td>
    <td><h4 class="nuevos-enlaces"><a href="<?php echo get_post_permalink(); ?>"><?php the_title(); ?></a></td>
    <td class="nuevos-enlaces"><h4><?php the_author_posts_link(); ?></h4></td>
    <td class="colored"><h4><?php the_time('j-m-Y'); ?></h4></td>
</tr>