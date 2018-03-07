<?php
    $args = array(
      'id_form'           => 'commentform',
      'class_form'      => 'comment-form',
      'id_submit'         => 'submit',
      'class_submit'      => 'btn btn-default wow bounceIn animated',
      'name_submit'       => 'submit',
      'title_reply'       => __( 'Leave a Reply' ),
      'title_reply_to'    => __( 'Leave a Reply to %s' ),
      'cancel_reply_link' => __( 'Cancel Reply' ),
      'label_submit'      => __( 'Post Comment' ),
      'format'            => 'xhtml',
      'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );
    comment_form($args);
    $args = array(
        'style' => 'div',
        'type' => 'comment',
        'callback' => 'custom_comments',
        'reply_text' => 'responder'
    );
    wp_list_comments();
?>


