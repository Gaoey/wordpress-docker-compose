<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * Catmandu
 * @since 1.0.0
 * @author CodeManas 2020. All Rights reserved.
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <section class="error-404 not-found">
                <h1 class="page-title-404">404</h1>
                <h3><?php esc_html_e( 'We sincerely apologize.', 'catmandu' ); ?></h3>
                <p><?php esc_html_e( 'The page you are looking for is no longer here. Maybe it was never here in the first place. Try searching again with the field below !', 'catmandu' ); ?></p>

				<?php get_search_form(); ?>
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
