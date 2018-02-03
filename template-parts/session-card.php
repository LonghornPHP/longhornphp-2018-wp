<li class="list-group-item session-card" id="<?php echo esc_attr( $session->post_name ); ?>">
    <div class="d-flex align-items-start collapsed" data-toggle="collapse" data-target="#<?php echo esc_attr( $session->post_name ); ?>-description" aria-expanded="false" aria-controls="<?php echo esc_attr( $session->post_name ); ?>-description">
        <!-- <div class="toggle">
            <i class="far fa-caret-square-right"></i>
        </div> -->

        <div class="meta">
            <?php $has_thumbnail = count($session->speakers) && has_post_thumbnail( $session->speakers[0]->ID ); ?>
            <?php if ($has_thumbnail) : ?>
                <div class="float-left img-wrap">
                    <?php echo get_the_post_thumbnail( $session->speakers[0]->ID, 'thumbnail' ); ?>
                </div>
            <?php endif; ?>

            <div class="<?php echo $has_thumbnail ? 'title pl-3 float-right' : ''; ?>">
                <h4><?php echo esc_html( $session->post_title ); ?></h4>
                <?php if (count($session->speakers)) : ?>
                    <h5>
                        <a href="<?php the_field('speakers_page', 'options'); ?>#<?php echo esc_attr( $session->speakers[0]->post_name ); ?>">
                            <?php echo esc_html( $session->speakers[0]->post_title ); ?>
                        </a>
                    </h5>
                <?php endif; ?>
            </div>
        </div>

        <?php $type = get_the_terms( $session->ID, 'session_type' ); ?>
        <?php if (!empty($type)) : ?>
        <div class="ml-auto">
            <span class="session-type badge badge-pill <?php echo esc_html( $type[0]->slug ); ?>">
                <?php echo esc_html( $type[0]->name ); ?>
            </span>
        </div>
        <?php endif; ?>
    </div>

    <div class="collapse description" id="<?php echo esc_attr( $session->post_name ); ?>-description">
        <?php echo apply_filters('the_content', $session->post_content); ?>
    </div>
</li>