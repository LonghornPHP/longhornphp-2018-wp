<?php
/* Template Name: Schedule */
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

            <?php foreach (['thursday', 'friday', 'saturday'] as $day) : ?>
                <?php $rooms = get_field($day . '_schedule_room_names', 'options'); ?>

                <?php the_field($day . '_schedule_intro', 'options'); ?>

                <?php if (have_rows($day . '_schedule_sessions', 'options')) : ?>
                    <table class="table table-bordered" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width: 120px; vertical-align: middle;">Start</th>
                                <th rowspan="2" style="width: 120px; vertical-align: middle;">End</th>
                                <th style="text-align: center;" colspan="<?php echo count($rooms); ?>">
                                Room Name</th>
                            </tr>
                            <tr>
                                <?php foreach ($rooms as $room) : ?>
                                    <th>
                                        <?php echo esc_html( $room['room_name'] ); ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (have_rows($day . '_schedule_sessions', 'options')) : the_row(); ?>
                                <tr>
                                    <td><?php the_sub_field('start_time'); ?></td>
                                    <td><?php the_sub_field('end_time'); ?></td>
                                    <?php if (have_rows('tracks')) : ?>
                                        <?php while (have_rows('tracks')) : the_row(); ?>
                                            <?php if (get_sub_field('event_type') === 'Custom') : ?>
                                                <td
                                                    <?php if (get_sub_field('fills_block')) : ?>
                                                        colspan="<?php echo count($rooms); ?>"
                                                        align="center"
                                                        style="vertical-align: middle;"
                                                    <?php endif; ?>
                                                    >
                                                    <?php the_sub_field('event_name'); ?>
                                                </td>
                                            <?php else : ?>
                                                <?php $session = get_sub_field('session'); ?>
                                                <td>
                                                    <a href="<?php the_field('sessions_page', 'options'); ?>#<?php echo esc_attr( $session->post_name ); ?>">
                                                        <?php echo esc_html($session->post_title); ?>
                                                    </a>
                                                    <br>
                                                    <?php $speakers = get_field('speaker_session_relationship', $session->ID); ?>
                                                    <?php if (!empty($speakers)) : ?>
                                                        <small>by <a href="<?php the_field('speakers_page', 'options'); ?>#<?php echo esc_attr( $speakers[0]->post_name ); ?>">
                                                            <?php echo esc_html($speakers[0]->post_title); ?>
                                                        </a></small>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

            <?php endforeach; ?>

        </main>
    </div>

    <div class="sponsors-list text-center mt-5">
        <h2 class="mb-4">Sponsors</h2>
        <?php get_template_part( 'template-parts/sponsors' ); ?>
    </div>
</div>

<?php
get_footer();
