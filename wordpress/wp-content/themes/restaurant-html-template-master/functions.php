<?php

function load_external_jQuery() { // load external file  
    wp_deregister_script( 'jquery' ); // desregistramos el jQuery de wordpress
    wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", array(), false, false); // registramos el jQuery de google
    wp_enqueue_script('jquery'); // encolamos el jQuery en wordpress
}  
add_action('wp_enqueue_scripts', 'load_external_jQuery');

function theme_scripts(){
    wp_register_script('jquery-1.10.2.min.js', get_template_directory_uri() . '/js/vendor/jquery-1.10.2.min.js',array(), false, true);
    wp_enqueue_script('jquery-1.10.2.min.js');
    
    wp_register_script('jquery-1.10.2.js', get_template_directory_uri() . '/js/vendor/jquery-1.10.2.js',array(), false, true);
    wp_enqueue_script('jquery-1.10.2.js');
    
    wp_register_script('jquery.nav.js', get_template_directory_uri() . '/js/jquery.nav.js',array(),false,true);
    wp_enqueue_script('jquery.nav.js');
    
    wp_register_script('jquery.sticky.js', get_template_directory_uri() . '/js/jquery.sticky.js',array(),false,true);
    wp_enqueue_script('jquery.sticky.js');
    
    wp_register_script('bootstrap.min.js', get_template_directory_uri(). '/js/bootstrap.min.js',array(),false,true);
    wp_enqueue_script('bootstrap.min.js');

    wp_register_script('plugins.js', get_template_directory_uri(). '/js/plugins.js',array(),false,true);
    wp_enqueue_script('plugins.js'); 
    
    wp_register_script('wow.min.js', get_template_directory_uri(). '/js/wow.min.js',array(),false,true);
    wp_enqueue_script('wow.min.js'); 
    
    wp_register_script('main.js', get_template_directory_uri(). '/js/main.js',array(),false,true);
    wp_enqueue_script('main.js'); 
    
    wp_register_script('modernizr-2.6.2.min.js', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js',array(),false,true);
    wp_enqueue_script('modernizr-2.6.2.min.js');
    
    wp_register_script('especialito.js', get_template_directory_uri() . '/js/especialito.js',array(),false,true);
    wp_enqueue_script('especialito.js');
    
    wp_register_script('canvas.js', get_template_directory_uri() . '/js/canvas.js', array(), false, true);
    wp_enqueue_script('canvas.js');
}

add_action('wp_enqueue_scripts','theme_scripts');

// Fotos representativas
add_theme_support('post-thumbnails');

//Modificar la imagen del post (single.php) para que sea responsive
function insertImgResponsive($content){
    $content = mb_convert_encoding($content , 'HTML-ENTITIES' , 'UTF-8'); //Codificamos a utf-8
    $document = new DOMDocument(); //Creamos un objeto tipo DOM
    libxml_use_internal_errors(true); //Activamos los errores internos para que se descativen los externos
    $document->loadHTML(utf8_decode($content)); // Cargamos el contenido en el document
    $imgs = $document->getElementsByTagName('img'); // Obtenemos todas las imagenes
    foreach($imgs as $img){
        $img->setAttribute('class' , 'img-responsive');
        $img->setAttribute('width' , '100%');
        $img->setAttribute('height' , '');
        //Cambiamos los atributos a todas las imagenes del post
    }
    $content = $document->saveHTML(); // guardamos el codigo html
    return $content;
}

add_filter('the_content' , 'insertImgResponsive');

//Añadimos al excerpt un enlace al final que nos lleva al post completo (single.php)
function mi_excerpt_leermas() {
    global $post;
	return '<span class="nuevos-enlaces"><a class="" href="'. get_permalink($post->ID) . '">  Leer más...</a></span>';
}
add_filter('excerpt_more', 'mi_excerpt_leermas');

//Customizamos el tamaño del excerpt a razón de la pagina en la que estemos
function custom_excerpt_length( $length ) {
    global $wp_query;
    $page_title = $wp_query->post->post_title;
    $page_id = $_GET['page_id'];
    if($page_title === 'Home' || $oage_title === '404' || $page_id == 45){
        return 15;
    }else{
        return 50;
    }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function my_comment_form($fields){
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$nick = $user->exists()?$user->display_name: '';
	$req = get_option('require_name_email');
	$fields['author'] = '<div class="form-group wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="600ms" style="visibility: visible; animation-duration: 500ms; animation-delay: 600ms; animation-name: fadeInDown;">
                        <input type="text" id="author" placeholder="* Write your name here..." name="author" value="'.esc_attr($commenter['comment_author']).'" class="form-control" placeholder="Write your email address here...">
                        </div>';
	$fields['email'] = '<div class="form-group wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="800ms" style="visibility: visible; animation-duration: 500ms; animation-delay: 800ms; animation-name: fadeInDown;">
                        <input type="email" class="form-control" id="email" name="email" value="'.esc_attr($commenter['comment_author_email']).'" placeholder="* Write your email here...">
                        </div>';
	$fields['url'] = '<div class="form-group wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="800ms" style="visibility: visible; animation-duration: 500ms; animation-delay: 800ms; animation-name: fadeInDown;">
                    <input type="text" class="form-control" id="url" name="url" value="'.esc_attr($commenter['comment_author_url']).'" placeholder="* Write your url here...">
                    </div>';
	$fields['comment_field'] = '<div class="form-group wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="800ms" style="visibility: visible; animation-duration: 500ms; animation-delay: 800ms; animation-name: fadeInDown;">
                                <textarea rows="3" id="comment" name="comment" class="blog-leave-comment-textarea form-control" max-length="200" required></textarea>
                                </div>';

	return $fields;
}

function my_comment_formBackUp($fields){
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$nick = $user->exists()?$user->display_name: '';
	$req = get_option('require_name_email');
	$fields['author'] = '<input type="text" class="form-control" id="author" placeholder="Name" name="author" value="'.esc_attr($commenter['comment_author']).'" size="20" required>';
	$fields['email'] = '<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="'.esc_attr($commenter['comment_author_email']).'" size="20" required>';
	$fields['url'] = '<input type="text" class="form-control" id="url" placeholder="url" name="url" value="'.esc_attr($commenter['comment_author_url']).'" size="20" required>';
	$fields['comment_field'] = '<textarea rows="3" id="comment" name="comment" class="blog-leave-comment-textarea form-control" max-length="200" required></textarea>';

	return $fields;
}
add_filter('comment_form_default_fields','my_comment_form');


//Quitamos uno de los textarea que aparecen en Los comentarios + hacemos que se muestre cuando estamos logged
function my_form_default($defaults){
    if(!is_user_logged_in()){
        if(isset($defaults['comment_field'])){
            $defaults['comment_field'] = "";
        }
    }else{
        $defaults['comment-field'] = '<textarea rows="3" id="comment" name="comment" class="form-control" max-length="200" required></textarea>';
    }
    return $defaults;
}
add_filter('comment_form_defaults', 'my_form_default');

//Custom comments
function custom_comments($comment, $args, $depth){
    ?>
        <div class="<?php echo ($depth > 1) ? 'comment-reply': 'comentario' ?>">    
            
        <?php
            $arg = array('class' => 'img-circle');
            echo get_avatar($comment , 60 , null, 'fotico comentario' , $arg); 
        ?>
        
        <span class="infoComment">
            <?php comment_author(); comment_date();?>
        </span>
        
        <?php
            comment_text();
        ?>
        <?php 
            comment_reply_link(
                array_merge( 
                    $args, 
                    array(
                        'add_below' => $add_below, 
                        'depth' => $depth, 
                        'max_depth' => $args['max_depth'],
                        'before' => '<div class="reply-button">',
                        'after' => '</div>'
                    )
                )
            );
        ?>
    <?php
}

//Habilitar widgets 
function create_widget_area(){
    //Registramos el sidebar
    register_sidebar(array(
        'name' => 'Sidebar Widget',
        'id' => 'sidebar',
        'description' => 'Sidebar Widget Area', //nombre que aparecerá en el back-end
        'before_widget' => '<div class="sidebar-widget %2$s">', //la etiqueta html que irá antes del widget, pero no cerramos la etiqueta por si el creador del wifget necesita meter alguna clase, por ello usamos %2$s
        'afetr_widget' => '</div>', //la etiqueta html que irá después del widget
    ));
    //Registramos el footer
    register_sidebar(array(
        'name' => 'Footer Widget',
        'id' => 'footer',
        'description' => 'Footer Widget Area', //nombre que aparecerá en el back-end
        'before_widget' => '<div class="footer-widget %2$s">', //la etiqueta html que irá antes del widget, pero no cerramos la etiqueta por si el creador del wifget necesita meter alguna clase, por ello usamos %2$s
        'afetr_widget' => '</div>', //la etiqueta html que irá después del widget
    ));
    //Registramos el header
    register_sidebar(array(
        'name' => 'Header Widget',
        'id' => 'header',
        'description' => 'Footer Widget Area', //nombre que aparecerá en el back-end
        'before_widget' => '<div class="header-widget %2$s">', //la etiqueta html que irá antes del widget, pero no cerramos la etiqueta por si el creador del wifget necesita meter alguna clase, por ello usamos %2$s
        'afetr_widget' => '</div>', //la etiqueta html que irá después del widget
    ));
}
add_action('widgets_init', 'create_widget_area');

//Activamos los custom posts formats
add_theme_support('post-formats', array('link', 'quote', 'aside', 'gallery', 'image', 'video', 'audio'));

//Campos customizados social media
function add_social_media_customs_fields($user_methods){
    $user_methods['facebook'] = __('Facebook Account: ');
    $user_methods['twitter'] = __('Twitter Account: ');
    //Borrar un campo que no queremos : unset $user_acontact('field');
    return $user_methods;
}
add_action('user_contactmethods', 'add_social_media_customs_fields');

function skill_fields( $user ) { ?>
    <h3>Personal Skills</h3>
        <table class="form-table">
            <tr>
                <th><label for="skill1d">Skill 1 Description</label></th>
                <td>
                    <input type="text" name="skill1d" id="skill1d" value="<?php echo esc_attr( get_the_author_meta( 'skill1d', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="description">Please enter your skill description.</span>
                </td>
                <th><label for="skill1v">Skill 1 Value</label></th>
                <td>
                    <input type="text" name="skill1v" id="skill1v" value="<?php echo esc_attr( get_the_author_meta( 'skill1v', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="value">Please enter your skill value.</span>
                </td>
            </tr>
            
            <tr>
                <th><label for="skill2d">Skill 2 Description</label></th>
                <td>
                    <input type="text" name="skill2d" id="skill2d" value="<?php echo esc_attr( get_the_author_meta( 'skill2d', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="description">Please enter your skill description.</span>
                </td>
                <th><label for="skill2v">Skill 2 Value</label></th>
                <td>
                    <input type="text" name="skill2v" id="skill2v" value="<?php echo esc_attr( get_the_author_meta( 'skill2v', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="value">Please enter your skill value.</span>
                </td>
            </tr>
            
            <tr>
                <th><label for="skill3d">Skill 3 Description</label></th>
                <td>
                    <input type="text" name="skill3d" id="skill3d" value="<?php echo esc_attr( get_the_author_meta( 'skill3d', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="description">Please enter your skill description.</span>
                </td>
                <th><label for="skill3v">Skill 3 Value</label></th>
                <td>
                    <input type="text" name="skill3v" id="skill3v" value="<?php echo esc_attr( get_the_author_meta( 'skill3v', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="value">Please enter your skill value.</span>
                </td>
            </tr>
            
            <tr>
                <th><label for="skill4d">Skill 4 Description</label></th>
                <td>
                    <input type="text" name="skill4d" id="skill4d" value="<?php echo esc_attr( get_the_author_meta( 'skill4d', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="description">Please enter your skill description.</span>
                </td>
                <th><label for="skill4v">Skill 4 Value</label></th>
                <td>
                    <input type="text" name="skill4v" id="skill4v" value="<?php echo esc_attr( get_the_author_meta( 'skill4v', $user->ID ) ); ?>" class="regular-text" />
                    <br />
                    <span class="value">Please enter your skill value.</span>
                </td>
            </tr>
            
    </table>
<?php 
}
add_action('show_user_profile' , 'skill_fields');
add_action('edit_user_profile' , 'skill_fields');

function save_skill_fields($user_id){
    if(!current_user_can('edit_user', $user_id)){
        return;
    }
    update_user_meta($user_id, 'skill1d', $_POST['skill1d']);
    update_user_meta($user_id, 'skill1v', $_POST['skill1v']);
    update_user_meta($user_id, 'skill2d', $_POST['skill2d']);
    update_user_meta($user_id, 'skill2v', $_POST['skill2v']);
    update_user_meta($user_id, 'skill3d', $_POST['skill3d']);
    update_user_meta($user_id, 'skill3v', $_POST['skill3v']);
    update_user_meta($user_id, 'skill4d', $_POST['skill4d']);
    update_user_meta($user_id, 'skill4v', $_POST['skill4v']);
}
add_action('personal_options_update', 'save_skill_fields');
add_action('edit_user_profile_update', 'save_skill_fields');

/* Contar las views de los posts */

function getPostViews($postID){
    $counter = 'post_views_count';
    $count = get_post_meta($postID, $counter, true);
    if($count == ''){
        add_post_meta($postID, $counter, true);
        return '0 views';
    }elseif($count == 1){
        return '1 view';
    }else{
        return $count . ' views';
    }
}

function setPostViews($postID){
    $counter = 'post_views_count'; //Cogemos el campo del backend
    $count = get_post_meta($postID, $counter, true); //Sacamos el valor del campo anterior
    if($count == ''){ //Comprobamos si el campo esta seteado, y si no lo está lo seteamos y le ponemos 0
        $count = 0;
        add_post_meta($postID, $counter, $count);
    }else{ //Si está seteado, le aumentamos el valor
        $count++;
        update_post_meta($postID, $counter, $count);
    }
}

/* Cambiar el logo y su url en el login form */
function change_login_logo(){
    echo '<style type="text/css">
            #login h1 a{
                background-image : url(' . get_template_directory_uri() . '/images/betterpics/logo-admin2.png);
                background-repeat: no-repeat;
                background-position: cover;
            }
          </style>';
}
add_action('login_enqueue_scripts', 'change_login_logo');

function change_logo_url(){
    return home_url();
}
add_filter('login_headerurl', 'change_logo_url');

/* Custom Posts Fields */
function my_posts_types(){
    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        //'excerpt',
        //'custom-fields',
        'comments',
        'revisions',
        //'post-formats'
    );
    
    $labels = array(
        'name' => _x('Recipes' , 'plural'),
        'singular_name' => _x('Recipe' , 'singular'),
        'menu_name' => _x('Recipes' , 'admin menu'),
        'name_admin_bar' => _x('Recipes' , 'admin bar'),
        'add_new' => _x('New Recipe' , 'add new'),
        //
        'add_new_item' => __('Insert new recipe'),
        'new_item' => __('New recipe'),
        'edit_item' => __('Edit recipe'),
        'view_item' => __('View recipe'),
        'all_items' => __('View all recipes'),
        'search_items' => __('Search recipes'),
        'not_found' => __('Recipes not found')
    );
    
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true, //La query soportara post personalizados
        'rewrite' => array('slug' => 'Tour'),
        'has_archive' => true, //Permitimos archivos adjuntos
        'hierarchical' => false, //No tendra post hijos
        'menu_position' => 5 ,
        'exclude_from_search' => false, //No se excluira de la busqueda
        'capability_type'     => 'post', //Las capacidades que se tendran sobre este post (editar, reescribir, etc), en este caso las de un post normal
    );
    
    register_post_type('my_recipe' , $args);
}

add_action('init' , 'my_posts_types');

function add_cats_to_custom_post_type(){
    register_taxonomy_for_object_type('category' , 'my_recipe');
    register_taxonomy_for_object_type('post_tag' , 'my_recipe');
}

add_action('init' , 'add_cats_to_custom_post_type');

function add_my_recipes_metabox(){
    $screens = array('my_recipe');
    foreach ($screens as $screen) {
        add_meta_box('my_recipe_metabox' , __('My recipe details'), 'add_fields_to_metabox', $screen, 'normal', 'default');
    }
}

add_action('add_meta_boxes' , 'add_my_recipes_metabox');

function add_fields_to_metabox($post){
    wp_nonce_field(basename(__FILE__), 'my_tour_metabox_nonce');
    $name = get_post_meta($post->ID, 'my_recipe_name', true);
    $time = get_post_meta($post->ID, 'my_recipe_time', true);
    $ingredients = get_post_meta($post->ID, 'my_recipe_ingredients', true);
    $amount = get_post_meta($post->ID, 'my_recipe_amount', true);
    ?>
        <label for="my_recipe_name">Name:</label>
        <input type="text" id="my_recipe_name" name="my_recipe_name" size="20" value="<?php echo $name ?>"/>&nbsp;&nbsp;
        <label for="my_recipe_time">Time:</label>
        <input type="time" id="my_recipe_time" name="my_recipe_time" size="20" value="<?php echo $time ?>"/>&nbsp;&nbsp;
        <label for="my_recipe_ingredients">Ingredients:</label>
        <textarea id="my_recipe_ingredients" name="my_recipe_ingredients" style="width: 400px !important;" size="100" value=""><?php echo $ingredients ?></textarea>&nbsp;&nbsp;
        <label for="my_recipe_amount">Dinners:</label>
        <input type="number" id="my_recipe_amount" name="my_recipe_amount" size="20" value="<?php echo $amount ?>"/>
    <?php
}

function save_my_recipe_fields($post_id){
    $is_revision = wp_is_post_revision($post_id);
    $is_autosave = wp_is_post_autosave($post_id);
    $is_nonce_valid = (isset($_POST['my_recipe_metabox_nonce']) && wp_verify_nonce($_POST['my_recipe_metabox_nonce'] , basename(__FILE__)));
    if($is_revision && $is_autosave && $is_nonce_valid){
        return;
    }
    $name = sanitize_text_field($_POST['my_recipe_name']);
    $time = sanitize_text_field($_POST['my_recipe_time']);
    $ingredients = sanitize_text_field($_POST['my_recipe_ingredients']);
    $amount = sanitize_text_field($_POST['my_recipe_amount']);
    
    update_post_meta($post_id , 'my_recipe_name' , $name);
    update_post_meta($post_id , 'my_recipe_time' , $time);
    update_post_meta($post_id , 'my_recipe_ingredients' , $ingredients);
    update_post_meta($post_id , 'my_recipe_amount' , $amount);
}

add_action('save_post' , 'save_my_recipe_fields');

function get_paginate_page_links( $type = 'plain', $endsize = 1, $midsize = 1 ) {
    global $wp_query, $wp_rewrite;
    
    /* Obtenemos el número actual de página -> en una plantilla tipo index  
      OJO! si queremos obtener el número de página de una página estática -> tipo front page - 
      tenemos que cambiar 'paged' por 'page'.
    */
    $current = get_query_var( 'paged' ) > 1 ? get_query_var('paged') : 1;

    // Saneamos los valores de los argumentos de entrada
    if ( ! in_array( $type, array( 'plain', 'list', 'array' ) ) ) $type = 'plain';
    // absint es una función WP que convierte un número a su entero no negativo, hace lo mismo que abs(intval($num))
    $endsize = absint( $endsize );
    $midsize = absint( $midsize );

    // Establecemos los valores de los argumentos de la función paginate_links()
    $pagination = array(
        'base'      => @add_query_arg( 'paged', '%#%' ),
        'format'    => '',
        'total'     => $wp_query->max_num_pages,
        'current'   => $current,
        'show_all'  => false,
        'end_size'  => $endsize,
        'mid_size'  => $midsize,
        'type'      => $type,
        'prev_text' => '<button class="boton-pag button button-dark button-sm">Previous</button>',
        'next_text' =>  '<button class="boton-pag button button-dark button-sm">Next</button>',
        'before_page_number' => '<button class="boton-pag button-o button-sm button-dark hover-fade">',
        'after_page_number' => '</button>'
    );
    // El método using_permalinks() del objeto wp_rewrite de WP devuelve TRUE si nuestro sitio usa alguna clase de permalinks
    if ( $wp_rewrite->using_permalinks() ) {
        /* Si usamos permalinks hay que rehacer la URL donde pasaremos el número de página, quitando el argumento s de la url por defecto
         que puede estar a partir de la última barra de directorio en la propia url
         
        user_trailingslashit -> Si los permalinks están configuarados para acabar en /, le añade la barra a la url que genere para los page links
        si no está configurado para ello, se la quita en caso de que exista
        trailingslashit( '/home/julien/bin/dotfiles' );  ---> '/home/julien/bin/dotfiles/'
         
        */
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ).'page/%#%/', 'paged' );
    } 
        /* Si estamos en el template search o archive tenemos que tener en cuenta 
        la variable s que es la que tiene el valor de búsqueda */ 
    if ( ! empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
    }
    return paginate_links( $pagination );
}

/* Tags List */

function list_tags_with_count() {
    $tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
    foreach ( (array) $tags as $tag ) {
        echo '<li><a href="' . get_tag_link ($tag->term_id) . '" rel="tag">' . $tag->name . '&nbsp;&nbsp;&nbsp;<span class="list-num">' . $tag->count . '</span></a></li>';
    }
}

/*Para sacar los custom post types en archives*/

function namespace_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'my_recipe'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

/*Extra*/
add_action('pre_get_posts', function($q){
    if(!is_admin() && $q->is_main_query() && !$q->is_tax() && $q->is_home()){
        $q->set('post_type', array('post', 'my_recipe'));
    }
});