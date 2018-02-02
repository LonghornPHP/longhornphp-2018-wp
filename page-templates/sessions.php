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
                $keynote_speakers = get_speakers_by_type(['keynote-speaker']);
                $keynote_speakers = fill_speakers_with_talks($keynote_speakers);
                $tutorial_speakers = get_speakers_by_type(['tutorial-speaker']);
                $tutorial_speakers = fill_speakers_with_talks($tutorial_speakers);
                $regular_speakers = get_speakers_by_type(['regular-speaker']);
                $regular_speakers = fill_speakers_with_talks($regular_speakers);
                $speakers = array_merge($keynote_speakers, $tutorial_speakers, $regular_speakers);
            ?>

            <div class="list-group">
                <?php foreach ($speakers as $speaker) : ?>
                    <?php foreach ($speaker->sessions as $session) : ?>
                        <?php include get_template_directory() . '/template-parts/session-card.php'; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>

<?php
get_footer();
