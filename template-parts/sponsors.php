<?php $tiers = ['diamond', 'platinum', 'gold', 'silver', 'bronze', 'community', 'kickstarter']; ?>
<?php $home_tiers = ['diamond', 'platinum', 'gold', 'silver']; ?>

<?php foreach ($tiers as $tier) : ?>
    <?php if (is_front_page() && !in_array($tier, $home_tiers)) { continue; } ?>
    <?php $sponsors = new WP_Query(lphp_get_sponsorship_tier_query($tier)); ?>
    <?php if ($sponsors->have_posts()) : ?>
        <div class="sponsorship-tier text-center">
            <h3 class="tier-title"><?php echo ucfirst($tier); ?></h3>
            <div class="row justify-content-center">
                <?php while ($sponsors->have_posts()) : $sponsors->the_post(); ?>
                    <div class="col-sm-6 col-lg-3 sponsor">
                        <?php $link = get_post_meta( get_the_ID(), 'sponsor_link', true ); ?>
                        <?php if ($link) : ?>
                        <a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'sponsor_link', true ); ?>">
                        <?php endif; ?>
                            <?php if (!has_post_thumbnail()) : ?>
                                <strong class="sponsor-title"><?php the_title(); ?></strong>
                            <?php endif; ?>
                            <?php if (has_post_thumbnail() && $tier !== 'kickstarter') : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php endif; ?>
                        <?php if ($link) : ?>
                        </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php unset($sponsors); ?>
<?php endforeach; ?>