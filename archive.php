<?php get_header(); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
        <?php /* If this is a category archive */ if (is_category()) { ?>
            <h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            <h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            <h2 class="pagetitle">Author Archive</h2>
          <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h2 class="pagetitle">Blog Archives</h2>
          <?php } ?>
          
        <?php the_title(); ?></h3>
    <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
<?php get_footer(); ?>