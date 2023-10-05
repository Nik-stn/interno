<?php

define( 'INTERNO_THEME_ROOT', get_template_directory_uri() );
define( 'INTERNO_IMG_DIR', INTERNO_THEME_ROOT . '/img' );

// правильный способ подключить стили и скрипты темы
add_action( 'wp_enqueue_scripts', 'theme_add_scripts' );
add_theme_support( 'post-thumbnails' );

function theme_add_scripts() {
	// подключаем файл стилей темы
	wp_enqueue_style( 'style-swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css' );
	wp_enqueue_style( 'style-main', get_template_directory_uri() . '/css/style.css' );

	// подключаем js файл темы
	wp_enqueue_script( 'script-swiper', get_template_directory_uri() . '/script/swiper-bundle.min.js', array(), '1.0', true );  
	wp_enqueue_script( 'script-main', get_template_directory_uri() . '/script/script.js', array(), '1.0');
	wp_enqueue_script( 'script-custom-swiper', get_template_directory_uri() . '/script/custom-swiper.js', array(), '1.0', true );
}

add_action( 'init', 'register_post_types' );

function register_post_types(){

	register_post_type( 'feedback', [
		'labels' => [
			'name'               => 'Отзывы', // основное название для типа записи
			'singular_name'      => 'Отзывы', // название для одной записи этого типа
			'add_new'            => 'Добавить отзыв', // для добавления новой записи
			'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
			'new_item'           => 'Новый отзыв', // текст новой записи
			'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
			'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Отзывы', // название меню
		],
		'public'                 => false,
		'show_ui'             => true, // зависит от public
		'menu_icon'           => 'dashicons-admin-customizer',
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields',
	] );

	register_post_type( 'news', [
		'labels' => [
			'name'               => 'Новости', // основное название для типа записи
			'singular_name'      => 'Новости', // название для одной записи этого типа
			'add_new'            => 'Добавить новости', // для добавления новой записи
			'add_new_item'       => 'Добавление новости', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование новости', // для редактирования типа записи
			'new_item'           => 'Новая новости', // текст новой записи
			'view_item'          => 'Смотреть новости', // для просмотра записи этого типа.
			'search_items'       => 'Искать новости', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Новости', // название меню
		],
		'public'                 => false,
		'show_ui'             => true, // зависит от public
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields',
	] );

}

function getFeedBack() {

	$args = array(
		'orderby'     => 'date',
		'order'       => 'ASC',
		'post_type'   => 'feedback',
	);

	return get_posts($args);
}

function getNews() {

	$args = array(
		'orderby'     => 'date',
		'order'       => 'DECS',
		'post_type'   => 'news',
	);

	return get_posts($args);
}

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){

	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => "blog-sidebar",
		'description'   => 'Description',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h4 class="widget__title">',
		'after_title'   => "</h4>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar'  => '', // WP 5.6
	) );

	register_sidebar( array(
		'name'          => 'Social network',
		'id'            => "social-network",
		'description'   => 'Description',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="post__social">',
		'after_widget'  => "</div>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar'  => '', // WP 5.6
	) );
}

add_filter( 'get_search_form', 'my_search_form' );
function my_search_form( $form ) {

	$form = '
	<form  class="modal-search__content" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">Search query:</label>
		<input class="modal-search__input" type="text" value="' . get_search_query() . '" name="s" id="s" />
		<button class="modal-search__btn" type="submit" id="searchsubmit"></button>
		<button type="button" class="modal-search__close" onclick="closeModal()"></button>
	</form>';

	return $form;
}

add_action( 'after_setup_theme', 'main_menu' );

function main_menu() {
	register_nav_menu( 'primary', 'Main Menu' );
}

add_action( 'after_setup_theme', 'mobile_menu' );

function mobile_menu() {
	register_nav_menu( 'mob', 'Mobile Menu' );
}