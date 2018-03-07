<form role="search" method="get" class="search-form title-font" action="<?php echo home_url( '/' ); ?>">
    <input type="hidden" name="post_type" value="custom-post-type">
    <input type="text" class="search-field title-font form-control" placeholder="<?php _e('What to find'); ?> ..." value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <input type="submit" class="search-submit title-font sidebar-button form-control" value="<?php _e('Search'); ?>" />
</form>