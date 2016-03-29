<?php
namespace App\Twig;

use Twig_Extension;

class WordPress extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('wp_has_action', function ($tag, $function_to_check = false) {
                return has_action( $tag, $function_to_check );
            }),

            new \Twig_SimpleFunction('wp_do_action', function ($tag, $arg = '') {
                do_action( $tag, $arg );
                return true;
            }),

            new \Twig_SimpleFunction('wp_do_action_ref_array', function ($tag, $args) {
                do_action_ref_array( $tag, $args );
                return true;
            }),

            new \Twig_SimpleFunction('wp_did_action', function ($tag) {
                return did_action( $tag );
            }),

            new \Twig_SimpleFunction('wp_get_attached_file', function ($attachment_id, $unfiltered = false) {
                return get_attached_file( $attachment_id, $unfiltered );
            }),

            new \Twig_SimpleFunction('wp_is_attachment', function ($attachment = '') {
                return is_attachment($attachment);
            }),

            new \Twig_SimpleFunction('wp_is_local_attachment', function ($url) {
                return is_local_attachment( $url );
            }),

            new \Twig_SimpleFunction('wp_attachment_is_image', function ($post = 0) {
                return wp_attachment_is_image( $post );
            }),

            new \Twig_SimpleFunction('wp_attachment_is_image', function ($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
                return wp_get_attachment_image( $attachment_id, $size, $icon, $attr );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_link', function ($id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false, $attr = '') {
                return wp_get_attachment_link( $id, $size, $permalink, $icon, $text );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_image_src', function ($attachment_id, $size = 'thumbnail', $icon = false) {
                return wp_get_attachment_image_src( $attachment_id, $size, $icon );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_metadata', function ($post_id = 0, $unfiltered = false) {
                return wp_get_attachment_metadata( $post_id, $unfiltered );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_thumb_file', function ($post_id = 0) {
                return wp_get_attachment_thumb_file( $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_thumb_url', function ($post_id = 0) {
                return wp_get_attachment_thumb_url( $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_attachment_url', function ($post_id = 0) {
                return wp_get_attachment_url( $post_id );
            }),

            new \Twig_SimpleFunction('wp_check_for_changed_slugs', function ($post_id, $post, $post_before) {
                wp_check_for_changed_slugs( $post_id, $post, $post_before );
                return true;
            }),

            new \Twig_SimpleFunction('wp_count_posts', function ($type = 'post', $perm = '') {
                return wp_count_posts( $type, $perm );
            }),

            new \Twig_SimpleFunction('wp_get_mime_types', function () {
                return wp_get_mime_types();
            }),

            new \Twig_SimpleFunction('wp_mime_type_icon', function ($mime = 0) {
                return wp_mime_type_icon( $mime );
            }),

            new \Twig_SimpleFunction('wp_generate_attachment_metadata', function ($attachment_id, $file) {
                return wp_generate_attachment_metadata( $attachment_id, $file );
            }),

            new \Twig_SimpleFunction('wp_prepare_attachment_for_js', function ($attachment) {
                return wp_prepare_attachment_for_js( $attachment );
            }),

            new \Twig_SimpleFunction('wp_get_bookmark', function ($bookmark, $output = OBJECT, $filter = 'raw') {
                return get_bookmark( $bookmark, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_bookmarks', function ($args = '') {
                return get_bookmarks( $args );
            }),

            new \Twig_SimpleFunction('wp_cat_is_ancestor_of', function ($cat1, $cat2) {
                return cat_is_ancestor_of( $cat1, $cat2 );
            }),

            new \Twig_SimpleFunction('wp_get_ancestors', function ($object_id = 0, $object_type = '', $resource_type = '') {
                return get_ancestors( $object_id, $object_type, $resource_type );
            }),

            new \Twig_SimpleFunction('wp_get_cat_ID', function ($cat_name) {
                return get_cat_ID( $cat_name );
            }),

            new \Twig_SimpleFunction('wp_get_cat_name', function ($cat_id) {
                return get_cat_name( $cat_id );
            }),

            new \Twig_SimpleFunction('wp_get_categories', function ($args = '') {
                return get_categories( $args );
            }),

            new \Twig_SimpleFunction('wp_get_category', function ($category, $output = OBJECT, $filter = 'raw') {
                return get_category( $category, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_category_by_path', function ($category_path, $full_match = true, $output = OBJECT) {
                return get_category_by_path( $category_path, $full_match, $output );
            }),

            new \Twig_SimpleFunction('wp_get_category_by_slug', function ($slug) {
                return get_category_by_slug( $slug );
            }),

            new \Twig_SimpleFunction('wp_get_the_category_by_ID', function ($cat_ID) {
                return get_the_category_by_ID( $cat_ID );
            }),

            new \Twig_SimpleFunction('wp_get_the_category_by_ID', function ($separator = '', $parents='', $post_id = false) {
                return get_the_category_list( $separator, $parents, $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_category_link', function ($category_id) {
                return get_category_link( $category_id );
            }),

            new \Twig_SimpleFunction('wp_get_category_parents', function ($id, $link = false, $separator = '/', $nicename = false, $visited = array()) {
                return get_category_parents( $id, $link, $separator, $nicename, $visited );
            }),

            new \Twig_SimpleFunction('wp_get_the_category', function ($id = false) {
                return get_the_category( $id );
            }),

            new \Twig_SimpleFunction('wp_single_cat_title', function ($prefix = '', $display = true) {
                return single_cat_title( $prefix, $display );
            }),

            new \Twig_SimpleFunction('wp_in_category', function ($category, $post = null) {
                return in_category( $category, $post );
            }),

            new \Twig_SimpleFunction('wp_is_category', function ($category = '') {
                return is_category( $category );
            }),

            new \Twig_SimpleFunction('wp_dropdown_categories', function ($args = '') {
                return wp_dropdown_categories( $args );
            }),

            new \Twig_SimpleFunction('wp_get_approved_comments', function ($post_id, $args = array()) {
                return get_approved_comments($post_id, $args);
            }),

            new \Twig_SimpleFunction('wp_get_avatar', function ($id_or_email, $size = 96, $default = '', $alt = '', $args = null) {
                return get_avatar( $id_or_email, $size, $default, $alt, $args );
            }),

            new \Twig_SimpleFunction('wp_get_comment', function (&$comment = null, $output = OBJECT) {
                return get_comment( $comment, $output );
            }),

            new \Twig_SimpleFunction('wp_get_comment_text', function ($comment_ID = 0, $args = array()) {
                return get_comment_text( $comment_ID, $args );
            }),

            new \Twig_SimpleFunction('wp_get_comment_meta', function ($comment_id, $key = '', $single = false) {
                return get_comment_meta( $comment_id, $key, $single );
            }),

            new \Twig_SimpleFunction('wp_get_comments', function ($args = '') {
                return get_comments( $args );
            }),

            new \Twig_SimpleFunction('wp_get_enclosed', function ($post_id) {
                return get_enclosed( $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_lastcommentmodified', function ($timezone = 'server') {
                return get_lastcommentmodified( $timezone );
            }),

            new \Twig_SimpleFunction('wp_get_pung', function ($post_id) {
                return get_pung( $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_to_ping', function ($post_id) {
                return get_to_ping( $post_id );
            }),

            new \Twig_SimpleFunction('wp_have_comments', function () {
                return have_comments();
            }),

            new \Twig_SimpleFunction('wp_get_comment_author', function ($comment_ID = 0) {
                return get_comment_author( $comment_ID );
            }),

            new \Twig_SimpleFunction('wp_is_trackback', function () {
                return is_trackback();
            }),

            new \Twig_SimpleFunction('wp_trackback', function ($trackback_url, $title, $excerpt, $ID) {
                return trackback( $trackback_url, $title, $excerpt, $ID );
            }),

            new \Twig_SimpleFunction('wp_trackback_url', function () {
                return trackback_url();
            }),

            new \Twig_SimpleFunction('wp_allow_comment', function ($commentdata) {
                return wp_allow_comment( $commentdata );
            }),

            new \Twig_SimpleFunction('wp_count_comments', function ($post_id = 0) {
                return wp_count_comments( $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_comment_status', function ($comment_id) {
                return wp_get_comment_status( $comment_id );
            }),

            new \Twig_SimpleFunction('wp_get_current_commenter', function () {
                return wp_get_current_commenter();
            }),

            new \Twig_SimpleFunction('wp_comment_class', function ($class = '', $comment = null, $post_id = null, $echo = true) {
                return comment_class( $class, $comment_id, $post_id, $echo );
            }),

            new \Twig_SimpleFunction('wp_get_comment_date', function ($d = '', $comment_ID = 0) {
                return get_comment_date( $d, $comment_ID );
            }),

            new \Twig_SimpleFunction('wp_get_comment_time', function ($d = '', $gmt = false, $translate = true) {
                return get_comment_time( $d, $gmt, $translate );
            }),

            new \Twig_SimpleFunction('wp_paginate_comments_links', function ($args = array()) {
                return paginate_comments_links( $args );
            }),

            new \Twig_SimpleFunction('wp_get_comment_pages_count', function ($comments, $per_page, $threaded) {
                return get_comment_pages_count($comments, $per_page, $threaded);
            }),

            new \Twig_SimpleFunction('wp_has_nav_menu', function ($location) {
                return has_nav_menu( $location );
            }),

            new \Twig_SimpleFunction('wp_has_tag', function ($tag = '', $post = null) {
                return has_tag( $tag, $post );
            }),

            new \Twig_SimpleFunction('wp_is_category', function ($category = '') {
                return is_category( $category );
            }),

            new \Twig_SimpleFunction('wp_is_404', function () {
                return is_404();
            }),

            new \Twig_SimpleFunction('wp_is_admin', function () {
                return is_admin();
            }),

            new \Twig_SimpleFunction('wp_is_archive', function () {
                return is_archive();
            }),

            new \Twig_SimpleFunction('wp_is_attachment', function () {
                return is_attachment();
            }),

            new \Twig_SimpleFunction('wp_is_author', function ($author = '') {
                return is_author($author);
            }),

            new \Twig_SimpleFunction('wp_is_category', function ($category = '') {
                return is_category($category);
            }),

            new \Twig_SimpleFunction('wp_is_comments_popup', function () {
                return is_comments_popup();
            }),

            new \Twig_SimpleFunction('wp_is_customize_preview', function () {
                return is_customize_preview();
            }),

            new \Twig_SimpleFunction('wp_is_feed', function ($feeds = '') {
                return is_feed( $feeds );
            }),

            new \Twig_SimpleFunction('wp_is_front_page', function () {
                return is_front_page();
            }),

            new \Twig_SimpleFunction('wp_is_home', function () {
                return is_home();
            }),

            new \Twig_SimpleFunction('wp_is_page', function () {
                return is_page();
            }),

            new \Twig_SimpleFunction('wp_is_page_template', function () {
                return is_page_template();
            }),

            new \Twig_SimpleFunction('wp_is_paged', function () {
                return is_paged();
            }),

            new \Twig_SimpleFunction('wp_is_preview', function () {
                return is_preview();
            }),

            new \Twig_SimpleFunction('wp_is_search', function () {
                return is_search();
            }),

            new \Twig_SimpleFunction('wp_is_search', function ($post = '') {
                return is_single($post);
            }),

            new \Twig_SimpleFunction('wp_is_sticky', function ($post_id = 0) {
                return is_sticky($post_id);
            }),

            new \Twig_SimpleFunction('wp_is_tag', function ($tag = '') {
                return is_tag( $tag );
            }),

            new \Twig_SimpleFunction('wp_is_trackback', function () {
                return is_trackback();
            }),

            new \Twig_SimpleFunction('wp_is_date', function () {
                return is_date();
            }),

            new \Twig_SimpleFunction('wp_is_year', function () {
                return is_year();
            }),

            new \Twig_SimpleFunction('wp_is_month', function () {
                return is_month();
            }),

            new \Twig_SimpleFunction('wp_is_day', function () {
                return is_day();
            }),

            new \Twig_SimpleFunction('wp_is_time', function () {
                return is_time();
            }),

            new \Twig_SimpleFunction('wp_get_author_feed_link', function ($author_id, $feed = '') {
                return get_author_feed_link( $author_id, $feed );
            }),

            new \Twig_SimpleFunction('wp_get_bloginfo_rss', function ($show = '') {
                return get_bloginfo_rss( $show );
            }),

            new \Twig_SimpleFunction('wp_get_category_feed_link', function ($cat_id, $feed = '') {
                return get_category_feed_link( $cat_id, $feed );
            }),

            new \Twig_SimpleFunction('wp_get_comment_link', function ($comment = null, $args = array()) {
                return get_comment_link( $comment, $args );
            }),

            new \Twig_SimpleFunction('wp_get_comment_author_rss', function () {
                return get_comment_author_rss();
            }),

            new \Twig_SimpleFunction('wp_get_post_comments_feed_link', function ($post_id = 0, $feed = '') {
                return get_post_comments_feed_link( $post_id, $feed );
            }),

            new \Twig_SimpleFunction('wp_get_search_comments_feed_link', function ($search_query = '', $feed = '') {
                return get_search_comments_feed_link( $search_query, $feed );
            }),

            new \Twig_SimpleFunction('wp_get_search_feed_link', function ($search_query = '', $feed = '') {
                return get_search_feed_link( $search_query, $feed );
            }),

            new \Twig_SimpleFunction('wp_get_the_category_rss', function ($type = null) {
                return get_the_category_rss( $type );
            }),

            new \Twig_SimpleFunction('wp_get_the_title_rss', function () {
                return get_the_title_rss();
            }),

            new \Twig_SimpleFunction('wp_get_post_custom', function ($post_id = 0) {
                return get_post_custom($post_id);
            }),

            new \Twig_SimpleFunction('wp_get_post_custom_keys', function ($post_id = 0) {
                return get_post_custom_keys($post_id);
            }),

            new \Twig_SimpleFunction('wp_get_post_custom_values', function ($key = '', $post_id = 0) {
                return get_post_custom_values($key, $post_id);
            }),

            new \Twig_SimpleFunction('wp_get_post_meta', function ($post_id, $key = '', $single = false) {
                return get_post_meta($post_id, $key, $single);
            }),

            new \Twig_SimpleFunction('wp_apply_filters', function ($tag, $value) {
                return apply_filters($tag, $value);
            }),

            new \Twig_SimpleFunction('wp_apply_filters_ref_array', function ($tag, $args) {
                return apply_filters_ref_array( $tag, $args );
            }),

            new \Twig_SimpleFunction('wp_remote_get', function ($url, $args = array()) {
                return wp_remote_get( $url, $args );
            }),

            new \Twig_SimpleFunction('wp_remote_retrieve_body', function ($response) {
                return wp_remote_retrieve_body($response);
            }),

            new \Twig_SimpleFunction('wp_get_http_headers', function ($url, $deprecated = false) {
                return wp_get_http_headers( $url, $deprecated );
            }),

            new \Twig_SimpleFunction('wp_remote_fopen', function ($uri) {
                return wp_remote_fopen($uri);
            }),

            new \Twig_SimpleFunction('wp_remote_get', function ($url, $args = array()) {
                return wp_remote_get( $url, $args );
            }),

            new \Twig_SimpleFunction('wp_remote_retrieve_body', function ($response) {
                return wp_remote_retrieve_body($response);
            }),

            new \Twig_SimpleFunction('wp_get_http_headers', function ($url, $deprecated = false) {
                return wp_get_http_headers( $url, $deprecated );
            }),

            new \Twig_SimpleFunction('wp_remote_fopen', function ($uri) {
                return wp_remote_fopen($uri);
            }),

            new \Twig_SimpleFunction('wp_get_locale', function () {
                return get_locale();
            }),

            new \Twig_SimpleFunction('wp_is_rtl', function () {
                return is_rtl();
            }),

            new \Twig_SimpleFunction('wp_admin_url', function ($path = '', $scheme = 'admin') {
                return admin_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_bool_from_yn', function ($yn) {
                return bool_from_yn( $yn );
            }),

            new \Twig_SimpleFunction('wp_content_url', function ($path = '') {
                return content_url( $path );
            }),

            new \Twig_SimpleFunction('wp_get_bloginfo', function ($show = '', $filter = 'raw') {
                return get_bloginfo( $show, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_bloginfo', function ($show = '', $filter = 'raw') {
                return get_bloginfo( $show, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_num_queries', function () {
                return get_num_queries();
            }),

            new \Twig_SimpleFunction('wp_get_post_stati', function ($args = array(), $output = 'names', $operator = 'and') {
                return get_post_stati( $args, $output, $operator );
            }),

            new \Twig_SimpleFunction('wp_get_post_statuses', function () {
                return get_post_statuses();
            }),

            new \Twig_SimpleFunction('wp_get_query_var', function ($var, $default = '') {
                return get_query_var( $var, $default );
            }),

            new \Twig_SimpleFunction('wp_home_url', function ($path = '', $scheme = null) {
                return home_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_includes_url', function () {
                return includes_url();
            }),

            new \Twig_SimpleFunction('wp_is_blog_installed', function () {
                return is_blog_installed();
            }),

            new \Twig_SimpleFunction('wp_is_main_site', function ($site_id = null) {
                return is_main_site( $site_id );
            }),

            new \Twig_SimpleFunction('wp_is_main_query', function () {
                return is_main_query();
            }),

            new \Twig_SimpleFunction('wp_is_multisite', function () {
                return is_multisite();
            }),

            new \Twig_SimpleFunction('wp_is_ssl', function () {
                return is_ssl();
            }),

            new \Twig_SimpleFunction('wp_is_wp_error', function ($thing) {
                return is_wp_error( $thing );
            }),

            new \Twig_SimpleFunction('wp_network_admin_url', function ($path = '', $scheme = 'admin') {
                return network_admin_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_network_home_url', function ($path = '', $scheme = null) {
                return network_home_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_network_home_url', function ($path = '', $scheme = null) {
                return network_home_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_network_site_url', function ($path = '', $scheme = null) {
                return network_site_url( $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_cache_get', function ($key, $group = '', $force = false, &$found = null) {
                return wp_cache_get( $key, $group, $force, $found );
            }),

            new \Twig_SimpleFunction('wp_footer', function () {
                ob_start();
                wp_footer();
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_head', function () {
                ob_start();
                wp_head();
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_is_mobile', function () {
                return wp_is_mobile();
            }),

            new \Twig_SimpleFunction('wp_reset_postdata', function () {
                wp_reset_postdata();
                return;
            }),

            new \Twig_SimpleFunction('wp_reset_query', function ($location, $status = 302) {
                wp_safe_redirect( $location, $status );
                return;
            }),

            new \Twig_SimpleFunction('wp_get_site_option', function ($option, $default = false, $deprecated = true) {
                return get_site_option( $option, $default , $deprecated );
            }),

            new \Twig_SimpleFunction('wp_get_site_url', function ($blog_id = null, $path = '', $scheme = null) {
                return get_site_url( $blog_id, $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_get_admin_url', function ($blog_id = null, $path = '', $scheme = 'admin') {
                return get_admin_url( $blog_id, $path, $scheme );
            }),

            new \Twig_SimpleFunction('wp_get_user_option', function ($option, $user = 0, $deprecated = '') {
                return get_user_option( $option, $user, $deprecated );
            }),

            new \Twig_SimpleFunction('wp_get_option', function ($option, $user = 0, $deprecated = '') {
                return get_option( $option, $user = 0, $deprecated = '' );
            }),

            new \Twig_SimpleFunction('wp_get_the_ID', function () {
                return get_the_ID();
            }),

            new \Twig_SimpleFunction('wp_get_the_author', function () {
                return get_the_author();
            }),

            new \Twig_SimpleFunction('wp_get_the_author_posts', function () {
                return get_the_author_posts();
            }),

            new \Twig_SimpleFunction('wp_get_the_content', function ($more_link_text = null, $strip_teaser = false) {
                return get_the_content( $more_link_text, $strip_teaser );
            }),

            new \Twig_SimpleFunction('wp_get_the_title', function ($post = 0) {
                return get_the_title( $post );
            }),

            new \Twig_SimpleFunction('wp_get_post_revision', function (&$post, $output = OBJECT, $filter = 'raw') {
                return wp_get_post_revision( $post, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_post_revisions', function ($post_id = 0, $args = null) {
                return wp_get_post_revisions( $post_id, $args );
            }),

            new \Twig_SimpleFunction('wp_is_post_revision', function ($post) {
                return wp_is_post_revision( $post );
            }),

            new \Twig_SimpleFunction('wp_paginate_links', function ($args = '') {
                return paginate_links( $args );
            }),

            new \Twig_SimpleFunction('wp_get_all_page_ids', function () {
                return get_all_page_ids();
            }),

            new \Twig_SimpleFunction('wp_get_ancestors', function ($object_id = 0, $object_type = '', $resource_type = '') {
                return get_ancestors( $object_id, $object_type, $resource_type );
            }),

            new \Twig_SimpleFunction('wp_get_page_link', function ($post = false, $leavename = false, $sample = false) {
                return get_page_link($post, $leavename, $sample);
            }),

            new \Twig_SimpleFunction('wp_get_pagenum_link', function ($pagenum = 1, $escape = true) {
                return get_pagenum_link($pagenum, $escape);
            }),

            new \Twig_SimpleFunction('wp_get_page_by_path', function ($page_path, $output = OBJECT, $post_type = 'page') {
                return get_page_by_path( $page_path, $output, $post_type );
            }),

            new \Twig_SimpleFunction('wp_get_page_by_title', function ($page_title, $output = OBJECT, $post_type = 'page') {
                return get_page_by_title( $page_title, $output, $post_type );
            }),

            new \Twig_SimpleFunction('wp_get_page_children', function ($page_id, $pages) {
                return get_page_children( $page_id, $pages );
            }),

            new \Twig_SimpleFunction('wp_get_page_hierarchy', function (&$pages, $page_id = 0) {
                return get_page_hierarchy( $pages, $page_id );
            }),

            new \Twig_SimpleFunction('wp_get_page_uri', function ($page_id = 0) {
                return get_page_uri( $page_id );
            }),

            new \Twig_SimpleFunction('wp_get_pages', function ($args = array()) {
                return get_pages( $args );
            }),

            new \Twig_SimpleFunction('wp_is_page', function ($page = '') {
                return is_page( $page );
            }),

            new \Twig_SimpleFunction('wp_link_pages', function ($args = '') {
                return wp_link_pages( $args );
            }),

            new \Twig_SimpleFunction('wp_list_pages', function ($args = '') {
                return wp_list_pages( $args );
            }),

            new \Twig_SimpleFunction('wp_page_menu', function ($args = array()) {
                return wp_page_menu( $args );
            }),

            new \Twig_SimpleFunction('wp_dropdown_pages', function ($args = '') {
                return wp_dropdown_pages( $args );
            }),

            new \Twig_SimpleFunction('wp_is_email', function($email){
                return is_email( $email );
            }),

            new \Twig_SimpleFunction('wp_kses_version', function(){
                return wp_kses_version();
            }),

            new \Twig_SimpleFunction('wp_plugins_url', function ($path = '', $plugin = '') {
                return plugins_url( $path, $plugin );
            }),

            new \Twig_SimpleFunction('wp_get_admin_page_title', function () {
                return get_admin_page_title();
            }),

            new \Twig_SimpleFunction('wp_is_plugin_active', function ($plugin) {
                return is_plugin_active($plugin);
            }),

            new \Twig_SimpleFunction('wp_is_plugin_inactive', function ($plugin) {
                return is_plugin_inactive($plugin);
            }),

            new \Twig_SimpleFunction('wp_get_plugins', function ($plugin_folder = '') {
                return get_plugins( $plugin_folder );
            }),

            new \Twig_SimpleFunction('wp_get_adjacent_post', function ($in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category') {
                return get_adjacent_post($in_same_term, $excluded_terms, $previous, $taxonomy);
            }),

            new \Twig_SimpleFunction('wp_get_boundary_post', function ($in_same_cat = false, $excluded_categories = '', $start = true) {
                return get_boundary_post($in_same_cat, $excluded_categories, $start);
            }),

            new \Twig_SimpleFunction('wp_get_the_content', function ($more_link_text = null, $strip_teaser = false) {
                return get_the_content($more_link_text, $strip_teaser);
            }),

            new \Twig_SimpleFunction('wp_get_children', function ($args = '', $output = OBJECT) {
                return get_children($args, $output);
            }),

            new \Twig_SimpleFunction('wp_get_extended', function ($post) {
                return get_extended($post);
            }),

            new \Twig_SimpleFunction('wp_get_next_post', function ($in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {
                return get_next_post($in_same_term, $excluded_terms, $taxonomy);
            }),

            new \Twig_SimpleFunction('wp_get_next_posts_link', function ($label = null, $max_page = 0) {
                return get_next_posts_link($label, $max_page);
            }),

            new \Twig_SimpleFunction('wp_get_next_post_link', function ($format = '%link &raquo;', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {
                return get_next_post_link($format, $link, $in_same_term = false, $excluded_terms, $taxonomy);
            }),

            new \Twig_SimpleFunction('wp_get_permalink', function ($post = 0, $leavename = false) {
                return get_permalink($post, $leavename);
            }),

            new \Twig_SimpleFunction('wp_get_the_excerpt', function ($deprecated = '') {
                return get_the_excerpt($deprecated);
            }),

            new \Twig_SimpleFunction('wp_get_the_post_thumbnail', function ($post = null, $size = 'post-thumbnail', $attr = '') {
                return get_the_post_thumbnail($post, $size, $attr);
            }),

            new \Twig_SimpleFunction('wp_get_post', function ($post = null, $output = OBJECT, $filter = 'raw') {
                return get_post($post, $output, $filter);
            }),

            new \Twig_SimpleFunction('wp_get_post_field', function ($field, $post, $context = 'display') {
                return get_post_field( $field, $post, $context );
            }),

            new \Twig_SimpleFunction('wp_get_post_ancestors', function ($post) {
                return get_post_ancestors( $post );
            }),

            new \Twig_SimpleFunction('wp_get_post_mime_type', function ($ID = '') {
                return get_post_mime_type( $ID );
            }),

            new \Twig_SimpleFunction('wp_get_post_status', function ($ID = '') {
                return get_post_status( $ID );
            }),

            new \Twig_SimpleFunction('wp_get_post_format', function ($post = null) {
                return get_post_format( $post );
            }),

            new \Twig_SimpleFunction('wp_get_edit_post_link', function ($id = 0, $context = 'display') {
                return get_edit_post_link( $id, $context );
            }),

            new \Twig_SimpleFunction('wp_get_delete_post_link', function ($id = 0, $deprecated = '', $force_delete = false) {
                return get_delete_post_link( $id, $deprecated, $force_delete );
            }),

            new \Twig_SimpleFunction('wp_get_previous_post', function ($in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {
                return get_previous_post( $in_same_term, $excluded_terms, $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_previous_post_link', function ($format = '&laquo; %link', $link = '%title', $in_same_term = false, $excluded_terms = '', $taxonomy = 'category') {
                return get_previous_post_link( $format, $link, $in_same_term, $excluded_terms, $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_previous_posts_link', function ($label = null) {
                return get_previous_posts_link( $label );
            }),

            new \Twig_SimpleFunction('wp_get_posts', function ($args = null) {
                return get_posts( $args );
            }),

            new \Twig_SimpleFunction('wp_have_posts', function () {
                return have_posts();
            }),

            new \Twig_SimpleFunction('wp_is_single', function ($post = '') {
                return is_single();
            }),

            new \Twig_SimpleFunction('wp_is_sticky', function ($post_id = 0) {
                return is_sticky($post_id);
            }),

            new \Twig_SimpleFunction('wp_get_the_ID', function () {
                return get_the_ID();
            }),

            new \Twig_SimpleFunction('wp_the_post', function () {
                the_post();
                return true;
            }),

            new \Twig_SimpleFunction('wp_wp_get_recent_posts', function ($args = array(), $output = ARRAY_A) {
                return wp_get_recent_posts( $args, $output );
            }),

            new \Twig_SimpleFunction('wp_has_post_thumbnail', function ($post = null) {
                return has_post_thumbnail( $post );
            }),

            new \Twig_SimpleFunction('wp_has_excerpt', function ($id = 0) {
                return has_excerpt( $id );
            }),

            new \Twig_SimpleFunction('wp_has_post_format', function ($format = array(), $post = null) {
                return has_post_format($format,$post);
            }),

            new \Twig_SimpleFunction('wp_is_post_type_archive', function ($post_types = '') {
                return is_post_type_archive( $post_types );
            }),

            new \Twig_SimpleFunction('wp_post_type_archive_title', function ($prefix = '') {
                return post_type_archive_title( $prefix, false );
            }),

            new \Twig_SimpleFunction('wp_post_type_exists', function ($post_type) {
                return post_type_exists( $post_type );
            }),

            new \Twig_SimpleFunction('wp_get_post_type', function ($post = null) {
                return get_post_type( $post );
            }),

            new \Twig_SimpleFunction('wp_get_post_types', function ($args = array(), $output = 'names', $operator = 'and') {
                return get_post_types( $args, $output, $operator );
            }),

            new \Twig_SimpleFunction('wp_get_post_type_archive_link', function ($post_type) {
                return get_post_type_archive_link( $post_type );
            }),

            new \Twig_SimpleFunction('wp_get_post_type_capabilities', function ($args) {
                return get_post_type_capabilities( $args );
            }),

            new \Twig_SimpleFunction('wp_is_post_type_hierarchical', function ($post_type) {
                return is_post_type_hierarchical( $post_type );
            }),

            new \Twig_SimpleFunction('wp_check_admin_referer', function () {
                return check_admin_referer();
            }),

            new \Twig_SimpleFunction('wp_check_admin_referer', function ($action = -1, $query_arg = false, $die = true) {
                return check_ajax_referer( $action, $query_arg, $die );
            }),

            new \Twig_SimpleFunction('wp_create_nonce', function ($action = -1) {
                return wp_create_nonce( $action );
            }),

            new \Twig_SimpleFunction('wp_get_original_referer', function () {
                return wp_get_original_referer();
            }),

            new \Twig_SimpleFunction('wp_get_referer', function () {
                return wp_get_referer();
            }),

            new \Twig_SimpleFunction('wp_nonce_field', function ($action = -1, $name = "_wpnonce", $referer = true) {
                return wp_nonce_field( $action, $name, $referer, false );
            }),

            new \Twig_SimpleFunction('wp_nonce_url', function ($actionurl, $action = -1, $name = '_wpnonce') {
                return wp_nonce_url( $actionurl, $action, $name );
            }),

            new \Twig_SimpleFunction('wp_nonce_url', function ($jump_back_to = 'current') {
                return wp_original_referer_field( false, $jump_back_to );
            }),

            new \Twig_SimpleFunction('wp_referer_field', function () {
                return wp_referer_field( false );
            }),

            new \Twig_SimpleFunction('wp_verify_nonce', function ($nonce, $action = -1) {
                return wp_verify_nonce( $nonce, $action );
            }),

            new \Twig_SimpleFunction('wp_is_serialized', function ($data) {
                return is_serialized( $data );
            }),

            new \Twig_SimpleFunction('wp_is_serialized_string', function ($data) {
                return is_serialized_string( $data );
            }),

            new \Twig_SimpleFunction('wp_do_shortcode', function ($content, $ignore_html = false) {
                return do_shortcode($content, $ignore_html);
            }),

            new \Twig_SimpleFunction('wp_get_shortcode_regex', function ($tagnames = null) {
                return get_shortcode_regex($tagnames);
            }),

            new \Twig_SimpleFunction('wp_strip_shortcodes', function ($content) {
                return strip_shortcodes( $content );
            }),

            new \Twig_SimpleFunction('wp_get_tag', function ($tag, $output = OBJECT, $filter = 'raw') {
                return get_tag( $tag, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_tag_link', function ($tag) {
                return get_tag_link($tag);
            }),

            new \Twig_SimpleFunction('wp_get_tags', function ($args = '') {
                return get_tags( $args );
            }),

            new \Twig_SimpleFunction('wp_get_the_tag_list', function ($before = '', $sep = '', $after = '', $id = 0) {
                return get_the_tag_list( $before, $sep, $after );
            }),

            new \Twig_SimpleFunction('wp_get_the_tags', function ($id = 0) {
                return get_the_tags($id);
            }),

            new \Twig_SimpleFunction('wp_has_term', function ($tag = '', $post = null) {
                return has_term($tag, $post);
            }),

            new \Twig_SimpleFunction('wp_is_tag', function ($tag = '') {
                return is_tag( $tag );
            }),

            new \Twig_SimpleFunction('wp_single_tag_title', function ($prefix = '', $display = true) {
                return single_tag_title( $prefix, $display );
            }),

            new \Twig_SimpleFunction('wp_tag_description', function ($tag = 0) {
                return tag_description( $tag );
            }),

            new \Twig_SimpleFunction('wp_get_object_taxonomies', function ($object, $output = 'names') {
                return get_object_taxonomies( $object, $output );
            }),

            new \Twig_SimpleFunction('wp_get_edit_term_link', function ($term_id, $taxonomy, $object_type = '') {
                return get_edit_term_link( $term_id, $taxonomy, $object_type );
            }),

            new \Twig_SimpleFunction('wp_get_taxonomy', function ($taxonomy) {
                return get_taxonomy( $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_taxonomy', function ($taxonomy) {
                return get_taxonomy( $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_taxonomies', function ($args = array(), $output = 'names', $operator = 'and') {
                return get_taxonomies( $args, $output, $operator );
            }),

            new \Twig_SimpleFunction('wp_get_term', function ($term, $taxonomy = '', $output = OBJECT, $filter = 'raw') {
                return get_term( $term, $taxonomy, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_the_term_list', function ($term, $taxonomy = '', $output = OBJECT, $filter = 'raw') {
                return get_the_term_list( $id, $taxonomy, $before, $sep, $after );
            }),

            new \Twig_SimpleFunction('wp_get_term_by', function ($field, $value, $taxonomy = '', $output = OBJECT, $filter = 'raw') {
                return get_term_by( $field, $value, $taxonomy, $output, $filter );
            }),

            new \Twig_SimpleFunction('wp_get_the_terms', function ($post, $taxonomy) {
                return get_the_terms( $post, $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_term_children', function ($term_id, $taxonomy) {
                return get_term_children( $term_id, $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_term_link', function ($term, $taxonomy = '') {
                return get_term_link( $term, $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_get_terms', function ($taxonomies, $args = '') {
                return get_terms( $taxonomies, $args );
            }),

            new \Twig_SimpleFunction('wp_is_tax', function ($taxonomy = '', $term = '') {
                return is_tax( $taxonomy, $term );
            }),

            new \Twig_SimpleFunction('wp_is_taxonomy_hierarchical', function ($taxonomy) {
                return is_taxonomy_hierarchical( $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_taxonomy_exists', function ($taxonomy) {
                return taxonomy_exists( $taxonomy );
            }),

            new \Twig_SimpleFunction('wp_term_exists', function ($term, $taxonomy = '', $parent = null) {
                return term_exists( $term, $taxonomy, $parent );
            }),

            new \Twig_SimpleFunction('wp_get_object_terms', function ($object_ids, $taxonomies, $args = array()) {
                return wp_get_object_terms( $object_ids, $taxonomies, $args );
            }),

            new \Twig_SimpleFunction('wp_get_post_categories', function ($post_id = 0, $args = array()) {
                return wp_get_post_categories($post_id, $args);
            }),

            new \Twig_SimpleFunction('wp_get_post_tags', function ($post_id = 0, $args = array()) {
                return wp_get_post_tags( $post_id, $args );
            }),

            new \Twig_SimpleFunction('wp_get_post_terms', function ($post_id = 0, $taxonomy = 'post_tag', $args = array()) {
                return wp_get_post_terms( $post_id, $taxonomy, $args );
            }),

            new \Twig_SimpleFunction('wp_count_terms', function ($taxonomy, $args = array()) {
                return wp_count_terms( $taxonomy, $args );
            }),

            new \Twig_SimpleFunction('wp_has_term', function ($term = '', $taxonomy = '', $post = null) {
                return has_term( $term, $taxonomy, $post );
            }),

            new \Twig_SimpleFunction('wp_is_object_in_term', function ($object_id, $taxonomy, $terms = null) {
                return is_object_in_term( $object_id, $taxonomy, $terms = null );
            }),

            new \Twig_SimpleFunction('wp_body_class', function ($class = '') {
                ob_start();
                body_class($class);
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_comment_form', function ($args = array(), $post_id = null) {
                ob_start();
                comment_form($args, $post_id);
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_comments_template', function ($file = '/comments.php', $separate_comments = false) {
                ob_start();
                comments_template($file, $separate_comments);
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_get_footer', function ($name = null) {
                ob_start();
                get_footer( $name );
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_get_header', function ($name = null) {
                ob_start();
                get_header( $name );
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_get_sidebar', function ($name = null) {
                ob_start();
                get_sidebar( $name );
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_get_search_form', function () {
                return get_search_form( false );
            }),

            new \Twig_SimpleFunction('wp_get_body_class', function ($class = '') {
                return get_body_class($class);
            }),

            new \Twig_SimpleFunction('wp_get_search_form', function ($feature) {
                return current_theme_supports( $feature );
            }),

            new \Twig_SimpleFunction('wp_dynamic_sidebar', function ($index = 1) {
                return dynamic_sidebar( $index );
            }),

            new \Twig_SimpleFunction('wp_get_header_image', function () {
                return get_header_image();
            }),

            new \Twig_SimpleFunction('wp_get_header_textcolor', function () {
                return get_header_textcolor();
            }),

            new \Twig_SimpleFunction('wp_get_post_class', function ($class = '', $post_id = null) {
                return get_post_class($class, $post_id);
            }),

            new \Twig_SimpleFunction('wp_get_stylesheet_directory_uri', function () {
                return get_stylesheet_directory_uri();
            }),

            new \Twig_SimpleFunction('wp_get_stylesheet_uri', function () {
                return get_stylesheet_uri();
            }),

            new \Twig_SimpleFunction('wp_get_template_directory_uri', function () {
                return get_template_directory_uri();
            }),

            new \Twig_SimpleFunction('wp_get_template_part', function ($slug, $name = null) {
                ob_start();
                get_template_part($slug, $name);
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_get_themes', function ($args = array()) {
                return wp_get_themes( $args );
            }),

            new \Twig_SimpleFunction('wp_get_theme_support', function ($feature) {
                return get_theme_support( $feature );
            }),

            new \Twig_SimpleFunction('wp_get_theme_mod', function ($name, $default = false) {
                return get_theme_mod( $name, $default );
            }),

            new \Twig_SimpleFunction('wp_get_theme_mods', function () {
                return get_theme_mods();
            }),

            new \Twig_SimpleFunction('wp_get_theme_root', function ($stylesheet_or_template = false) {
                return get_theme_root( $stylesheet_or_template );
            }),

            new \Twig_SimpleFunction('wp_get_theme_roots', function () {
                return get_theme_roots();
            }),

            new \Twig_SimpleFunction('wp_get_theme_root_uri', function () {
                return get_theme_root_uri();
            }),

            new \Twig_SimpleFunction('wp_has_header_image', function () {
                return has_header_image();
            }),

            new \Twig_SimpleFunction('wp_is_child_theme', function () {
                return is_child_theme();
            }),

            new \Twig_SimpleFunction('wp_is_active_sidebar', function ($index) {
                return is_active_sidebar( $index );
            }),

            new \Twig_SimpleFunction('wp_is_admin_bar_showing', function () {
                return is_admin_bar_showing();
            }),

            new \Twig_SimpleFunction('wp_is_customize_preview', function () {
                return is_customize_preview();
            }),

            new \Twig_SimpleFunction('wp_is_dynamic_sidebar', function () {
                return is_dynamic_sidebar();
            }),

            new \Twig_SimpleFunction('wp_nav_menu', function ($args) {
                return wp_nav_menu( $args );
            }),

            new \Twig_SimpleFunction('wp_language_attributes', function ($doctype = 'html') {
                ob_start();
                language_attributes( $doctype );
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_load_template', function ($_template_file, $require_once = true) {
                ob_start();
                load_template( $_template_file, $require_once );
                return ob_end_clean();
            }),

            new \Twig_SimpleFunction('wp_get_registered_nav_menus', function () {
                return get_registered_nav_menus();
            }),

            new \Twig_SimpleFunction('wp_get_archives', function ($args = '') {
                return wp_get_archives( $args );
            }),

            new \Twig_SimpleFunction('wp_get_nav_menu_items', function ($menu, $args = array()) {
                return wp_get_nav_menu_items($menu, $args);
            }),

            new \Twig_SimpleFunction('wp_get_theme', function ($stylesheet = null, $theme_root = null) {
                return wp_get_theme( $stylesheet, $theme_root );
            }),

            new \Twig_SimpleFunction('wp_get_theme', function ($args = array()) {
                return wp_nav_menu( $args );
            }),

            new \Twig_SimpleFunction('wp_page_menu', function ($args = array()) {
                return wp_page_menu( $args );
            }),

            new \Twig_SimpleFunction('wp_get_the_title', function ($post = 0) {
                return get_the_title( $post );
            }),

            new \Twig_SimpleFunction('wp_current_time', function ($type, $gmt = 0) {
                return current_time( $type, $gmt );
            }),

            new \Twig_SimpleFunction('wp_date_i18n', function ($dateformatstring, $unixtimestamp = false, $gmt = false) {
                return date_i18n( $dateformatstring, $unixtimestamp, $gmt );
            }),

            new \Twig_SimpleFunction('wp_get_calendar', function ($initial) {
                return get_calendar( $initial, false );
            }),

            new \Twig_SimpleFunction('wp_get_date_from_gmt', function ($string, $format = 'Y-m-d H:i:s') {
                return get_date_from_gmt( $string, $format );
            }),

            new \Twig_SimpleFunction('wp_get_lastpostdate', function ($timezone) {
                return get_lastpostdate( $timezone );
            }),

            new \Twig_SimpleFunction('wp_get_lastpostmodified', function ($timezone) {
                return get_lastpostmodified( $timezone );
            }),

            new \Twig_SimpleFunction('wp_get_day_link', function ($year, $month, $day) {
                return get_day_link( $year, $month, $day );
            }),

            new \Twig_SimpleFunction('wp_get_gmt_from_date', function ($string) {
                return get_gmt_from_date( $string );
            }),

            new \Twig_SimpleFunction('wp_get_gmt_from_date', function ($string) {
                return get_gmt_from_date( $string );
            }),

            new \Twig_SimpleFunction('wp_get_month_link', function ($year, $month) {
                return get_month_link( $year, $month );
            }),

            new \Twig_SimpleFunction('wp_get_the_date', function ($format, $post_id) {
                return get_the_date( $format, $post_id );
            }),

            new \Twig_SimpleFunction('wp_get_the_time', function ($format, $post) {
                return get_the_time( $format, $post );
            }),

            new \Twig_SimpleFunction('wp_get_the_modified_time', function ($d) {
                return get_the_modified_time( $d );
            }),

            new \Twig_SimpleFunction('wp_get_weekstartend', function ($mysqlstring, $start_of_week) {
                return get_weekstartend( $mysqlstring, $start_of_week );
            }),

            new \Twig_SimpleFunction('wp_get_year_link', function ($year) {
                return get_year_link( $year );
            }),

            new \Twig_SimpleFunction('wp_get_year_link', function ($year) {
                return get_year_link( $year );
            }),

            new \Twig_SimpleFunction('wp_human_time_diff', function ($from, $to) {
                return human_time_diff( $from, $to );
            }),

            new \Twig_SimpleFunction('wp_is_new_day', function () {
                return is_new_day();
            }),

            new \Twig_SimpleFunction('wp_is_new_day', function ($timezone) {
                return iso8601_timezone_to_offset( $timezone );
            }),

            new \Twig_SimpleFunction('wp_is_new_day', function ($date_string, $timezone = 'user') {
                return iso8601_to_datetime( $date_string, $timezone );
            }),

            new \Twig_SimpleFunction('wp_mysql2date', function ($format, $date, $translate = true) {
                return mysql2date( $format, $date, $translate );
            }),

            new \Twig_SimpleFunction('wp_get_transient', function ($transient) {
                return get_transient( $transient );
            }),

            new \Twig_SimpleFunction('wp_get_transient', function ($transient) {
                return get_transient( $transient );
            }),

            new \Twig_SimpleFunction('wp_author_can', function ($post, $capability) {
                return author_can( $post, $capability );
            }),

            new \Twig_SimpleFunction('wp_current_user_can', function ($capability) {
                return current_user_can( $capability );
            }),

            new \Twig_SimpleFunction('wp_current_user_can_for_blog', function ($blog_id, $capability) {
                return current_user_can_for_blog($blog_id, $capability);
            }),

            new \Twig_SimpleFunction('wp_get_role', function ($role) {
                return get_role( $role );
            }),

            new \Twig_SimpleFunction('wp_get_super_admins', function () {
                return get_super_admins();
            }),

            new \Twig_SimpleFunction('wp_is_super_admin', function ($user_id = false) {
                return is_super_admin( $user_id );
            }),

            new \Twig_SimpleFunction('wp_user_can', function ($user, $capability) {
                return user_can( $user, $capability );
            }),

            new \Twig_SimpleFunction('wp_user_can', function ($strategy = 'time') {
                return count_users( $strategy );
            }),

            new \Twig_SimpleFunction('wp_count_user_posts', function ($userid, $post_type = 'post', $public_only = false) {
                return count_user_posts( $userid , $post_type );
            }),

            new \Twig_SimpleFunction('wp_count_many_users_posts', function ($users, $post_type = 'post', $public_only = false) {
                return count_many_users_posts( $users, $post_type, $public_only );
            }),

            new \Twig_SimpleFunction('wp_email_exists', function ($email) {
                return email_exists( $email );
            }),

            new \Twig_SimpleFunction('wp_get_currentuserinfo', function () {
                return get_currentuserinfo();
            }),

            new \Twig_SimpleFunction('wp_get_current_user_id', function () {
                return get_current_user_id();
            }),

            new \Twig_SimpleFunction('wp_get_user_by', function ($field, $value) {
                return get_user_by($field, $value);
            }),

            new \Twig_SimpleFunction('wp_get_userdata', function ($user_id) {
                return get_userdata( $user_id );
            }),

            new \Twig_SimpleFunction('wp_get_users', function ($args = array()) {
                return get_users( $args );
            }),

            new \Twig_SimpleFunction('wp_username_exists', function ($username) {
                return username_exists( $username );
            }),

            new \Twig_SimpleFunction('wp_validate_username', function ($username) {
                return validate_username( $username );
            }),

            new \Twig_SimpleFunction('wp_get_current_user', function () {
                return wp_get_current_user();
            }),

            new \Twig_SimpleFunction('wp_get_author_posts_url', function ($author_id, $author_nicename = '') {
                return get_author_posts_url( $author_id, $author_nicename );
            }),

            new \Twig_SimpleFunction('wp_get_the_modified_author', function () {
                return get_the_modified_author();
            }),

            new \Twig_SimpleFunction('wp_is_multi_author', function () {
                return is_multi_author();
            }),

            new \Twig_SimpleFunction('wp_is_multi_author', function ($user_id, $key = '', $single = false) {
                return get_user_meta($user_id, $key, $single);
            }),

            new \Twig_SimpleFunction('wp_get_the_author_meta', function ($field = '', $user_id = false) {
                return get_the_author_meta($field, $user_id);
            }),

            new \Twig_SimpleFunction('wp_is_user_logged_in', function () {
                return is_user_logged_in();
            }),

            new \Twig_SimpleFunction('wp_is_user_logged_in', function ($args = array()) {
                return wp_login_form( $args );
            }),

            new \Twig_SimpleFunction('wp_loginout', function ($redirect = '') {
                return wp_loginout( $redirect, false );
            }),

            new \Twig_SimpleFunction('wp_is_active_widget', function ($callback = false, $widget_id = false, $id_base = false, $skip_inactive = true) {
                return is_active_widget( $callback, $widget_id, $id_base, $skip_inactive );
            }),

            new \Twig_SimpleFunction('wp_is_active_widget', function ($callback = false, $widget_id = false, $id_base = false, $skip_inactive = true) {
                return is_active_widget( $callback, $widget_id, $id_base, $skip_inactive );
            }),

            new \Twig_SimpleFunction('wp_the_widget', function ($widget, $instance = array(), $args = array()) {
                ob_start();
                the_widget( $widget, $instance, $args );
                return ob_get_clean();
            }),

            new \Twig_SimpleFunction('wp_is_active_widget', function ($callback = false, $widget_id = false, $id_base = false, $skip_inactive = true) {
                return is_active_widget( $callback, $widget_id, $id_base, $skip_inactive );
            }),
        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('wp_maybe_serialize', function($data){
                maybe_serialize( $data );
            }),

            new \Twig_SimpleFilter('wp_maybe_unserialize', function($original){
                maybe_unserialize( $original );
            }),

            new \Twig_SimpleFilter('wp_absint', function($maybeint){
                return absint( $maybeint );
            }),

            new \Twig_SimpleFilter('wp_add_magic_quotes', function($array){
                return add_magic_quotes( $array );
            }),

            new \Twig_SimpleFilter('wp_addslashes_gpc', function($gpc){
                return addslashes_gpc( $gpc );
            }),

            new \Twig_SimpleFilter('wp_antispambot', function($emailaddy, $hex_encoding = 0){
                return antispambot( $emailaddy, $hex_encoding );
            }),

            new \Twig_SimpleFilter('wp_backslashit', function($string){
                return backslashit( $string );
            }),

            new \Twig_SimpleFilter('wp_balanceTags', function($text, $force = false){
                return balanceTags( $text, $force );
            }),

            new \Twig_SimpleFilter('wp_convert_chars', function($content, $deprecated = ''){
                return convert_chars( $content, $deprecated );
            }),

            new \Twig_SimpleFilter('wp_convert_smilies', function($text){
                return convert_smilies( $text );
            }),

            new \Twig_SimpleFilter('wp_ent2ncr', function($text){
                return ent2ncr( $text );
            }),

            new \Twig_SimpleFilter('wp_esc_attr', function($text){
                return esc_attr( $text );
            }),

            new \Twig_SimpleFilter('wp_esc_html', function($text){
                return esc_html( $text );
            }),

            new \Twig_SimpleFilter('wp_esc_js', function($text){
                return esc_js( $text );
            }),

            new \Twig_SimpleFilter('wp_esc_textarea', function($text){
                return esc_textarea( $text );
            }),

            new \Twig_SimpleFilter('wp_esc_sql', function($sql){
                return esc_sql( $sql );
            }),

            new \Twig_SimpleFilter('wp_esc_url', function($url, $protocols = null, $_context = 'display'){
                return esc_url( $url, $protocols, $_context );
            }),

            new \Twig_SimpleFilter('wp_esc_url_raw', function($url, $protocols){
                return esc_url_raw( $url, $protocols );
            }),

            new \Twig_SimpleFilter('wp_format_to_edit', function($content, $rich_text = false){
                return format_to_edit( $content, $rich_text );
            }),

            new \Twig_SimpleFilter('wp_htmlentities2', function($myHTML){
                return htmlentities2( $myHTML );
            }),

            new \Twig_SimpleFilter('wp_make_clickable', function($text){
                return make_clickable( $text );
            }),

            new \Twig_SimpleFilter('wp_popuplinks', function($text){
                return popuplinks( $text );
            }),

            new \Twig_SimpleFilter('wp_remove_accents', function($string){
                return remove_accents( $string );
            }),

            new \Twig_SimpleFilter('wp_sanitize_email', function($email){
                return sanitize_email( $email );
            }),

            new \Twig_SimpleFilter('wp_sanitize_file_name', function($name){
                return sanitize_file_name( $name );
            }),

            new \Twig_SimpleFilter('wp_sanitize_html_class', function($class, $fallback = ''){
                return sanitize_html_class( $class, $fallback );
            }),

            new \Twig_SimpleFilter('wp_sanitize_key', function($key){
                return sanitize_key( $key );
            }),

            new \Twig_SimpleFilter('wp_sanitize_mime_type', function($mime_type){
                return sanitize_mime_type( $mime_type );
            }),

            new \Twig_SimpleFilter('wp_sanitize_option', function($option, $value){
                return sanitize_option( $option, $value );
            }),

            new \Twig_SimpleFilter('wp_sanitize_sql_orderby', function($orderby){
                return sanitize_sql_orderby( $orderby );
            }),

            new \Twig_SimpleFilter('wp_sanitize_text_field', function($str){
                return sanitize_text_field( $str ) ;
            }),

            new \Twig_SimpleFilter('wp_sanitize_text_field', function($title, $fallback_title = '', $context = 'save'){
                return sanitize_title( $title, $fallback_title, $context );
            }),

            new \Twig_SimpleFilter('wp_sanitize_title_for_query', function($title){
                return sanitize_title_for_query( $title );
            }),

            new \Twig_SimpleFilter('wp_sanitize_title_with_dashes', function($title, $raw_title = '', $context = 'display'){
                return sanitize_title_with_dashes( $title, $raw_title, $context );
            }),

            new \Twig_SimpleFilter('wp_sanitize_user', function($username, $strict = false){
                return sanitize_user( $username, $strict );
            }),

            new \Twig_SimpleFilter('wp_sanitize_title_with_dashes', function($str){
                return seems_utf8( $str );
            }),

            new \Twig_SimpleFilter('wp_stripslashes_deep', function($value){
                return stripslashes_deep( $value );
            }),

            new \Twig_SimpleFilter('wp_trailingslashit', function($string){
                return trailingslashit( $string );
            }),

            new \Twig_SimpleFilter('wp_untrailingslashit', function($string){
                return untrailingslashit( $string );
            }),

            new \Twig_SimpleFilter('wp_urlencode_deep', function($value){
                return urlencode_deep( $value );
            }),

            new \Twig_SimpleFilter('wp_url_shorten', function($url, $length = 35){
                return url_shorten($url, $length);
            }),

            new \Twig_SimpleFilter('wp_url_shorten', function($utf8_string, $length = 0){
                return utf8_uri_encode( $utf8_string, $length );
            }),

            new \Twig_SimpleFilter('wp_wpautop', function($pee, $br = true){
                return wpautop( $pee, $br );
            }),

            new \Twig_SimpleFilter('wp_filter_kses', function($data){
                return wp_filter_kses( $data );
            }),

            new \Twig_SimpleFilter('wp_filter_post_kses', function($data){
                return wp_filter_post_kses( $data );
            }),

            new \Twig_SimpleFilter('wp_filter_nohtml_kses', function($data){
                return wp_filter_nohtml_kses( $data );
            }),

            new \Twig_SimpleFilter('wp_iso_descrambler', function($string){
                return wp_iso_descrambler( $string );
            }),

            new \Twig_SimpleFilter('wp_kses', function($string, $allowed_html, $allowed_protocols = array()){
                return wp_kses($string, $allowed_html, $allowed_protocols);
            }),

            new \Twig_SimpleFilter('wp_kses', function($string, $allowed_html, $allowed_protocols = array()){
                return wp_kses($string, $allowed_html, $allowed_protocols);
            }),

            new \Twig_SimpleFilter('wp_kses_array_lc', function($inarray){
                return wp_kses_array_lc( $inarray );
            }),

            new \Twig_SimpleFilter('wp_kses_attr', function($element, $attr, $allowed_html, $allowed_protocols){
                return wp_kses_attr( $element, $attr, $allowed_html, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_attr', function($element, $attr, $allowed_html, $allowed_protocols){
                return wp_kses_attr( $element, $attr, $allowed_html, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_bad_protocol', function($string, $allowed_protocols){
                return wp_kses_bad_protocol( $string, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_bad_protocol_once', function($string, $allowed_protocols, $count = 1){
                return wp_kses_bad_protocol_once( $string, $allowed_protocols, $count );
            }),

            new \Twig_SimpleFilter('wp_kses_bad_protocol_once2', function($string, $allowed_protocols){
                return wp_kses_bad_protocol_once2( $string, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_check_attr_val', function($value, $vless, $checkname, $checkvalue){
                return wp_kses_check_attr_val( $value, $vless, $checkname, $checkvalue );
            }),

            new \Twig_SimpleFilter('wp_kses_decode_entities', function($string){
                return wp_kses_decode_entities( $string );
            }),

            new \Twig_SimpleFilter('wp_kses_hair', function($attr, $allowed_protocols){
                return wp_kses_hair( $attr, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_hook', function($string, $allowed_html, $allowed_protocols){
                return wp_kses_hook( $string, $allowed_html, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_html_error', function($string){
                return wp_kses_html_error( $string );
            }),

            new \Twig_SimpleFilter('wp_kses_html_error', function($string){
                return wp_kses_js_entities( $string );
            }),

            new \Twig_SimpleFilter('wp_kses_no_null', function($string){
                return wp_kses_no_null( $string );
            }),

            new \Twig_SimpleFilter('wp_kses_normalize_entities', function($string){
                return wp_kses_normalize_entities( $string );
            }),

            new \Twig_SimpleFilter('wp_kses_normalize_entities2', function($matches){
                return wp_kses_normalize_entities2( $matches );
            }),

            new \Twig_SimpleFilter('wp_kses_normalize_entities2', function($matches){
                return wp_kses_normalize_entities2( $matches );
            }),

            new \Twig_SimpleFilter('wp_kses_split', function($string, $allowed_html, $allowed_protocols){
                return wp_kses_split( $string, $allowed_html, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_split2', function($string, $allowed_html, $allowed_protocols){
                return wp_kses_split2( $string, $allowed_html, $allowed_protocols );
            }),

            new \Twig_SimpleFilter('wp_kses_split2', function($string){
                return wp_kses_stripslashes( $string );
            }),

            new \Twig_SimpleFilter('wp_make_link_relative', function($link){
                return wp_make_link_relative( $link );
            }),

            new \Twig_SimpleFilter('wp_normalize_path', function($path){
                return wp_normalize_path($path);
            }),

            new \Twig_SimpleFilter('wp_rel_nofollow', function($text){
                return wp_rel_nofollow( $text );
            }),

            new \Twig_SimpleFilter('wp_rel_nofollow', function($text, $num_words = 55, $more = null){
                return wp_trim_words( $text, $num_words, $more );
            }),

            new \Twig_SimpleFilter('wp_zeroise', function($number, $threshold){
                return zeroise( $number, $threshold );
            }),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return __CLASS__;
    }
}