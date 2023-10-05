<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version
 */
_deprecated_file(
	/* translators: %s: Template name. */
	sprintf( __( 'Theme without %s' ), basename( __FILE__ ) ),
	'3.0.0',
	null,
	/* translators: %s: Template name. */
	sprintf( __( 'Please include a %s template in your theme.' ), basename( __FILE__ ) )
);

// Do not delete these lines.
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.' ); ?></p>
	<?php
	return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments">
		<?php
		if ( '1' === get_comments_number() ) {
			printf(
				/* translators: %s: Post title. */
				__( 'One response to %s' ),
				'&#8220;' . get_the_title() . '&#8221;'
			);
		} else {
			printf(
				/* translators: 1: Number of comments, 2: Post title. */
				_n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number() ),
				number_format_i18n( get_comments_number() ),
				'&#8220;' . get_the_title() . '&#8221;'
			);
		}
		?>
	</h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link(); ?></div>
		<div class="alignright"><?php next_comments_link(); ?></div>
	</div>
<?php else : // This is displayed if there are no comments so far. ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // Comments are closed. ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( 'Comments are closed.' ); ?></p>

	<?php endif; ?>
<?php endif; ?>

<?php 
add_filter( 'comment_form_default_fields', 'comment_form_default_add_phone_field' );

/**
 * Добавляет поле "Телефон" в форму комментирования для незарегистрированных пользователей.
 *
 * @param array $fields Дефолтные поля
 *
 * @return array
 */
function comment_form_default_add_phone_field( $fields ) {

	$fields['phone'] = '<input class="contact-form__input" placeholder="Phone" id="phone" name="phone" type="text" size="30"/>';

	return $fields;
}

add_action( 'comment_post', 'save_extend_comment_meta_data' );

/**
 * Сохраняет содержимое поля "Телефон" в метаполе.
 *
 * @param int $comment_id Идентификатор комментария
 */
function save_extend_comment_meta_data( $comment_id ) {
	if ( ! empty( $_POST['phone'] ) ) {
		$phone = sanitize_text_field( $_POST['phone'] );
		add_comment_meta( $comment_id, 'phone', $phone );
	}
}

add_filter('comment_form_fields', 'interno_reorder_comment_fields' );
function interno_reorder_comment_fields( $fields ){
	// die(print_r( $fields )); // посмотрим какие поля есть

	$new_fields = array(); // сюда соберем поля в новом порядке

	$myorder = array('author','email','url', 'phone', 'comment'); // нужный порядок

	foreach( $myorder as $key ){
		$new_fields[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	// если остались еще какие-то поля добавим их в конец
	if( $fields )
		foreach( $fields as $key => $val )
			$new_fields[ $key ] = $val;

	return $new_fields;
}

?>

<?php 

$fields   =  array(
    'author' =>  '<input class="contact-form__input" placeholder="Name"  id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' />',

    'email'  => '<input class="contact-form__input" placeholder="Email" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req  . ' />',

    'url'    => '<input class="contact-form__input" placeholder="Website" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" />',

    'phone'    => '<input class="contact-form__input" placeholder="Phone" id="phone" name="name" ' . ( $html5 ? 'type="phone"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" />',

    'cookies' => '<div class="contact-form__checkbox"><input type="checkbox" id="saveData" class="checkbox"><label for="saveData">Save my name, email, and website in this browser for the next time I comment.</label></div>',

);

$args = array(
    'comment_field' => '<textarea id="comment" name="name" aria-required="true" class="contact-form__textarea" placeholder="Hello Iam Intrested in.."></textarea>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
    'comment_notes_before' => '',
    'class_form' => 'contact-form post__form',
    'title_reply' => 'Leave a Reply',
    'title_reply_before' => '<h3 class="comments-title">',
    'title_reply_after' => '</h3>',
    'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="btn-primary">Send Now</button>',
    'submit_field' => '<div class="ontact-form__btn">%1$s %2$s</div>',
    'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);
comment_form($args); ?>
