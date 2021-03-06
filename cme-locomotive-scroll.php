<?php

/**
 * caught my eye Locomotive Scroll Plugin for WordPress
 *
 * @link              https://www.caughtmyeye.cc
 * @since             0.0.1
 * @package           Cme_Locomotive_Scroll_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       caught my eye Locomotive Scroll Plugin
 * Plugin URI:        https://www.caughtmyeye.cc
 * Description:       Allows Locomotive Scroll to work in WordPress.
 * Version:           0.0.1
 * Author:            caught my eye
 * Author URI:        https://www.caughtmyeye.cc
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cme-locomotive-scroll-plugin
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('CME_LOCOMOTIVE_SCROLL_NAME', 'cme-locomotive-scroll');
define('CME_LOCOMOTIVE_SCROLL_VERSION', '3.5.4');

define('CME_LOCOMOTIVE_SCROLL_PLUGIN_VERSION', '0.0.1');

/**
 * Enqueue Locomotive Scroll Stuff
 */

// CSS
function enqueue_locomotive_scroll_styles()
{
    wp_register_style(CME_LOCOMOTIVE_SCROLL_NAME, 'https://cdn.jsdelivr.net/gh/locomotivemtl/locomotive-scroll/dist/locomotive-scroll.css', array(), CME_LOCOMOTIVE_SCROLL_VERSION, 'all');

    wp_enqueue_style(CME_LOCOMOTIVE_SCROLL_NAME);
}
add_action('wp_enqueue_scripts', 'enqueue_locomotive_scroll_styles');

// JS
function enqueue_locomotive_scroll_javascript()
{
    // Put in footer, but before inline script to instantiate LocomotiveScroll.
    wp_register_script(CME_LOCOMOTIVE_SCROLL_NAME, 'https://cdn.jsdelivr.net/gh/locomotivemtl/locomotive-scroll/dist/locomotive-scroll.min.js', array(), CME_LOCOMOTIVE_SCROLL_VERSION, true);

    wp_enqueue_script(CME_LOCOMOTIVE_SCROLL_NAME);

    $script = '
    (function() {
        let bodyDataScrollContainer = document.querySelector("body");
        bodyDataScrollContainer.setAttribute("data-scroll-container", "");

        let mainDataScrollSection = document.querySelector("main");
        mainDataScrollSection.setAttribute("data-scroll-section", "");
    })();

    const scroll = new LocomotiveScroll({
        el: document.querySelector("[data-scroll-container]"),
        smooth: true
    });
    ';

    wp_add_inline_script(CME_LOCOMOTIVE_SCROLL_NAME, $script, 'after');

}
add_action('wp_enqueue_scripts', 'enqueue_locomotive_scroll_javascript');
