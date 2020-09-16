<?php
get_header();
while(have_posts()) {
	the_post();
 pageBanner();
   ?>
<!-- 	<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div> 
    </div>   
  </div> -->
  <div class="container container--narrow page-section">
  	<div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> 
      	<span class="metabox__main">
            <?php the_title(); ?>
        </span></p>
    </div>
  	<div class="generic-content">
     <?php the_content();	 ?>
    </div>
    <?php 
          $relatedProfessors = new WP_Query(array(
                'posts_per_page' => -1, // -1 to show all
                'post_type' => 'professor',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                      'key' => 'related_programs',
                      'compare' => 'LIKE',
                      'value' => '"' . get_the_ID() .'"',
                      )
                  )
                ));
         if ($relatedProfessors->have_posts()) {
            echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
          echo '<ul class="profess-cards">';
          while($relatedProfessors->have_posts()) {
            $relatedProfessors->the_post();
            ?>
            <li class="professor-card__list-item">
              <a class="professor-card" href="<?php the_permalink() ?>"> 
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
                <span class="professor-card__name">
                  <?php the_title(); ?>
                </span>
                
              </a>
            </li>
            <?php
          }
          echo '</ul>';
         }
        
        wp_reset_postdata(); //resets the global post objects such is the_ID
        $relatedCampuses = get_field('related_campus');
        
        if ($relatedCampuses) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . '  is Available at these Campuses:</h2>' ;
          echo '<ul class="min min-list link-list">';
          foreach($relatedCampuses as $campus) {
            ?> <li><a href="<?php echo get_the_permalink($campus);?>"> <?php echo get_the_title($campus)?></a></li>  
            <?php
          }
        }

         ?>
        
  </div>
	<?php 
}
get_footer();
?>