<?php
get_header();
 pageBanner(array(
      'title' => 'Past Events',
      'subtitle' => 'Recap of our past events'
    
    ));
?>

  <div class="container container--narrow page-section">
    <?php  
    $today =  date('Ymd');
  	$pastEvents = new WP_Query(array(
  						'paged' => get_query_var('paged', 1),//get the last ???
	                    // 'posts_per_page' => 1, // -1 to show all
	                    'post_type' => 'event',
	                    'meta_key' => 'event_date',
	                    'orderby' => 'meta_value_num',
	                    'order' => 'ASC',
	                    'meta_query' => array(
	                        array(
	                          'key' => 'event_date',
	                          'compare' => '<',
	                          'value' => $today,
	                          'type' => 'numeric'
	                          ),
	                        array()
	                      )
	                    ));
    while( $pastEvents->have_posts() ) {
      $pastEvents->the_post();
      get_template_part('template-parts/content-event');
    }
    echo paginate_links(array(
    	'total' => $pastEvents->max_num_pages
    	));
    ?>

  </div>

<?php
get_footer();

?>s