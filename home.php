<style type="text/css">

.medium-size {
    max-width: 2000%; /* Adjust the percentage as needed */
    height: auto;
}

#banner {
    text-align: center;
}

#main-slider {
    margin: 0 auto;
    max-width: 1000px; /* Adjust the maximum width as needed */
}


</style>

  <section id="banner">
  <!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img class="medium-size" src="<?php echo web_root; ?>plugins/home-plugins/img/slides/PESO SAN JUAN BANNER.jpg" alt="" />
                <div class="flex-caption">
                </div>
              </li>
              <li>
                <img class="medium-size" src="<?php echo web_root; ?>plugins/home-plugins/img/slides/LGU SAN JUAN BANNER.jpg" alt="" />
                <div class="flex-caption">
                <h3>innovation</h3> 
                <p>We create the opportunities</p> 
                </div>
              </li>
            </ul>
        </div>
  <!-- end slider -->
  </section> 

  
  <section id="content">

  <div class="container">
      <div class="row">
      <div class="col-md-12">
        <div class="aligncenter"><h2 class="aligncenter">Company</h2><!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores quae porro consequatur aliquam, incidunt eius magni provident, doloribus omnis minus ovident, doloribus omnis minus temporibus perferendis nesciunt.. --></div>
        <br/>
      </div>
    </div>


    <div class="row">
    <?php 
      $sql = "SELECT * FROM `tblcompany`";
      $mydb->setQuery($sql);
      $comp = $mydb->loadResultList();


      foreach ($comp as $company ) {
        # code...
    
    ?>
                    <div class="col-sm-4 info-blocks">
                        <i class="icon-info-blocks fa fa-building-o"></i>
                        <div class="info-blocks-in">
                            <h3><?php echo '<a href="'.web_root.'index.php?q=hiring&search='.$company->COMPANYNAME.'">'.$company->COMPANYNAME.'</a>';?></h3>
                            <!-- <p><?php echo $company->COMPANYMISSION;?></p> -->
                            <p>Address :<?php echo $company->COMPANYADDRESS;?></p>
                            <p>Contact No. :<?php echo $company->COMPANYCONTACTNO;?></p>
                        </div>
                    </div>

            <?php } ?> 
  </div>
  </section>
  
  <section class="section-padding gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title text-center">
            <h2 >Popular Jobs</h2>  
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ">
          <?php 
            $sql = "SELECT * FROM `tblcategory`";
            $mydb->setQuery($sql);
            $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
              echo '<div class="col-md-3" style="font-size:15px;padding:5px">* <a href="'.web_root.'index.php?q=category&search='.$result->CATEGORY.'">'.$result->CATEGORY.'</a></div>';
            }
          ?>
        </div>
      </div>
    </div>
  </section>