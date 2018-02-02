<?php
/* Template Name: Sessions */
get_header();
?>

<div class="container archive speakers">
    <div class="row">
        <main class="site-main col-sm-12">
            <?php if ( have_posts() ) : ?>

                <header class="page-header mb-5">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <hr>
                </header>

                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>

                <?php endwhile;

            endif; ?>

            <?php
                $keynotes = get_sessions_by_type(['keynote']);
                $keynotes = fill_sessions_with_speakers($keynotes);
                $tutorials = get_sessions_by_type(['tutorial']);
                $tutorials = fill_sessions_with_speakers($tutorials);
                $regulars = get_sessions_by_type(['regular']);
                $regulars = fill_sessions_with_speakers($regulars);
            ?>

            <div class="session-list">
                <h2>Keynotes</h2>
                <div class="list-group">
                    <?php foreach ($keynotes as $session) : ?>
                        <?php include get_template_directory() . '/template-parts/session-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="session-list">
                <h2>Tutorials</h2>
                <div class="list-group">
                    <?php foreach ($tutorials as $session) : ?>
                        <?php include get_template_directory() . '/template-parts/session-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="session-list">
                <h2>Talks</h2>
                <div class="list-group">
                    <?php foreach ($regulars as $session) : ?>
                        <?php include get_template_directory() . '/template-parts/session-card.php'; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
get_footer();
