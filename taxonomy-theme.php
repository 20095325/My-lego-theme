<?php
  get_header();
  get_template_part('template-parts/banner', 'title');
?>


<div class="container pt-4">
  <div class="row row-cols-2 row-cols-lg-3">
    <!--Theme-->
    <div class="col-4 col-lg-2">
      Theme
      <div class="input-group mb-3">
        <select class="form-select" id="inputGroupSelect02">
        <option>Star Wars</option>
        <option>Harry Potter</option>
        <option>Marvel</option>
        <option>Warner Bros</option>
        </select>
        
      </div>     
    </div>
    <!--End Theme-->

    <!--Year-->
    <div class="col-4 col-lg-1">
      Year
      <div class="input-group mb-3">
        <select class="form-select" id="inputGroupSelect02">
          <option selected>Year</option>
            <?php
              $latestYear = (int)date('Y');
              $lastYear = $latestYear - 15;
              for($i=$latestYear;$i>=$lastYear;$i--)
              {
                  echo '<option value='.$i.'>'.$i.'</option>';
              } 
            ?>          
        </select>        
      </div>
    </div>
    <!--End Year-->

    <!--Range Slider-->
    <div class="col-4 col-lg-3">
      Number of parts
      <div class="range_container">
        <div class="sliders_control">
        <div class="row">
          <div class="col-12 col-lg-12">
                <input id="fromSlider" type="range" value="100" min="0" max="700" />
                <input id="toSlider" type="range" value="300" min="0" max="700" />
          </div>
          <div class="col-4 col-lg-6">
            <input class="form_control_container__time__input" type="number" id="fromInput" value="100" min="0" max="700" />
          </div>
          <div class="col-4 col-lg-3"></div>
          <div class="col-4 col-lg-3">           
            <input class="form_control_container__time__input" type="number" id="toInput" value="300" min="0" max="700" />
          </div>
        </div>         
        </div>
        
      </div>
    </div>
    <!--End Range Slider-->
    
    <!--Sort by-->
    <div class="col-4 col-lg-2">
      Sort by
      <div class="input-group mb-3">
        <select class="form-select" id="inputGroupSelect02">
          <option>Most recent</option>
          <option>Oldest</option>
          <option>Accending</option>
          <option>Decending</option>
        </select>        
      </div>     
    </div>
     <!--End Sort by-->
    
     <!--Search -->
    <div class="col-4 col-lg-2">
      <div class="input-group mb-3">
        Search
        <input type="text" class="" style="padding:5px;" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
        <!--<button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>-->
      </div>
    </div>
     <!--End Search -->

  </div>
</div>


<div class="container">
 <div class="row row-cols-auto justify-content-md-center">
  <!--Sets list-->
  <?php 
  if(have_posts()):
      while(have_posts()) : the_post();
      $post_id = get_the_ID();
      ?>   
        <div class="col" style="padding:1%;">
            <div class="card" style="width: 25rem;">
            <?php $image_url = get_the_post_thumbnail_url();?>
            <?php if (!$image_url):?>
              <img src="<?php echo get_stylesheet_directory_uri();?>/images/no-image.png" class="img-fluid" alt="<?php echo the_title(); ?>"> 
            <?php else:?>
              <img src="<?php echo $image_url; ?>" class="img-fluid" alt="<?php echo the_title(); ?>"> 
            <?php endif; ?>         
              <div class="card-body">
                <p class="card-text">              
                
                  <h3 class="text-center"><?php echo the_title(); ?></h3>
          <p class="text-center"><?php echo get_post_meta( $post_id, 'set_number', true); ?>
          | 
          <?php
              $terms = get_the_terms($post_id, 'theme');
              if (!empty($terms))
              {
                foreach($terms as $term){
                  echo $term->name;
                }
              }					
          ?>

          </p>
          <div class="d-grid gap-2 col-6 mx-auto">
            <a role="button" href="<?php echo get_post_permalink();?>" class="btn btn-primary btn-sm">View Set -></a>
          </div>
                </p>
              </div>
            </div>       
        </div>
    <!--End Sets list-->
    <?php
    endwhile;
    else: 
    ?>
    <!--if no posts available or empty-->
      <div class="col-12 col-md-4" style="padding:1%;">
        <div class="alert alert-secondary" role="alert">
        No post available.
        </div>   
      </div>
      <!--End if no posts available or empty-->
    <?php
    endif;

    if(have_posts()):
    ?>
    <!--Pagination-->
      <div class="col-12 col-md-12"></div>
          <div class="col text-center">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
            </nav>
          </div>            
        </div>
        <?php endif?>
      </div>    
      <!--End Pagination-->
    
    <?php legotheme_pagination(); ?>
 <?php get_footer();