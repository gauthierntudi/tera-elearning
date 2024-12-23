<div class="dashboard__sidebar -base scroll-bar-1 border-right-light lg:px-30">

            <div class="sidebar -base-sidebar">
              <div class="sidebar__inner">
                <div>
                  <!-- <div class="text-16 lh-1 fw-500 text-dark-1 mb-30">General</div>
                  <div> -->

                    <div class="sidebar__item ">
                      <a href="home#allFormations" class="-dark-sidebar-white d-flex  border items-center text-17 lh-1 fw-500">
                        <i class="text-20 icon-play-button mr-15 text-capitilize"></i>
                        formations
                      </a>
                      

                    </div>
                    <div class="border-light">
                        <?php 
                          $formations = get_formations();

                          foreach ($formations as $key => $value) {
                            $id = $value['id'];
                            $title = $value['title'];
                            
                            echo "<p>
                              <a href='formation?id=$id'>$title</a>
                            </p>";
                          }
                        ?>
                    </div>

                    <!-- <div class="sidebar__item ">
                      <a href="#" class="-dark-sidebar-white d-flex items-center text-17 lh-1 fw-500">
                        <i class="text-20 far fa-heart mr-15"></i>
                        Mes Favoris
                      </a>
                    </div> -->

                    <!-- <div class="sidebar__item ">
                      <a href="#!" class="-dark-sidebar-white d-flex items-center text-17 lh-1 fw-500">
                        <i class="text-20 icon-list mr-15"></i>
                        Cours PDF
                      </a>
                    </div> -->

                    <!-- <div class="sidebar__item ">
                      <a href="#" class="-dark-sidebar-white d-flex items-center text-17 lh-1 fw-500">
                        <i class="text-20 icon-setting mr-15"></i>
                        Paramètres
                      </a>
                    </div> -->

                  </div>
                </div>

              
              </div>
            </div>