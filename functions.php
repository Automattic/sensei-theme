<?php

/**
 * Course functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Course
 * @since   Course 1.0
 */


if ( ! function_exists( 'course_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Course 1.0
	 *
	 * @return void
	 */
	function course_support() {

		add_theme_support( 'sensei-learning-mode' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
		add_editor_style( 'learning-mode.css' );
	}

endif;

add_action( 'after_setup_theme', 'course_support' );

function lesson_icons($icon, $status)
{
	$path = '/assets/images/learning-mode/lesson-status/' . $status . '.svg';
	if (file_exists(get_template_directory() .  $path)) {
		return '<img src="' . get_template_directory_uri() . $path . '" />';
	}
	return $icon;
}

add_filter( 'sensei_learning_mode_lesson_status_icon', 'lesson_icons', 10, 2);


if (!function_exists( 'course_scripts' )) :

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since Course 1.0
	 *
	 * @return void
	 */
	function course_scripts() {

		// Register theme stylesheet.
		wp_register_style(
			'course-style',
			get_stylesheet_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);

		wp_register_style(
			'course-sensei-learning-mode',
			get_stylesheet_directory_uri() . '/learning-mode.css',
			array(),
			wp_get_theme()->get(
				'Version'
			)
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'course-style' );

		// TODO: Only Load it if the the page is using learning mode
		wp_enqueue_style( 'course-sensei-learning-mode' );

		// Enqueque theme scripts.
		wp_enqueue_script( 'course-header', get_template_directory_uri() . '/assets/js/header.js', [], wp_get_theme()->get( 'Version' ), true );
	}

endif;

add_action( 'wp_enqueue_scripts', 'course_scripts' );

function course_theme_init() {
	register_block_style(
		'core/navigation-link',
		array(
			'name'  => 'navigation-link-button',
			'label' => __( 'Button', 'course' ),
		)
	);
}

add_action( 'init', 'course_theme_init' );
