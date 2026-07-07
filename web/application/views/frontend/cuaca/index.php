 <section class="white-wrapper">
     <div class="container">
         <div id="content">
             <div class="row">
                 <div class="blog-masonry">
                     <div class="col-lg-12">
                         <div class="general-title">
                             <h2 style="color: #e98024; font-weight: 300;"> INFORMASI CUACA</h2>
                             <hr>
                             <p style="color: #2a3052; font-size: 20px; margin-top: 20px; margin-bottom: 30px ; font-weight: 600;"> Informasi Cuaca yang ada di Kota Surakarta</p>
                         </div>
                         <div>
                             <?php $this->load->view('frontend/cuaca/prakiraan', $prakiraan) ?>
                         </div>
                         <div> &nbsp; </div>
                         <div>
                             <p style="color: #444; font-size: 18px; font-weight: 600; text-align: center;
                                   ">Sumber : BMKG</p>
                         </div>

                     </div><!-- end col-lg-12 -->
                 </div><!-- end blog-masonry -->
             </div><!-- end row -->
         </div><!-- end content -->
     </div>
 </section>
 <!-- Content END-->