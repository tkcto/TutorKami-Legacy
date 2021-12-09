<?php 

include('includes/head.php');

include('includes/header.php');?>

<section class="banner">

   <article class="banner_text">

      <div class="container">

         <div class="row">

            <div style="width:100%">

            <?php 

            // Get Header Text

            $arrHeadText = system::FireCurl(CMS_URL.'?cms_id=21&lang='.$_SESSION['lang_code']);

            foreach($arrHeadText->data as $head){

              echo $head->pmt_pagedetail;

            } 

            ?>

				<script>
					function checkField()
					{
						if($("#subject_id").val() == "" && $("#location_id").val() == "")
						{
							alert("Please select from the dropdown only!");
							return false
						}
						else
						{
							return true;
						}
					}
				</script>
               <div class="form_div" style="width: 100%">

                  <form action="search_tutor.php" method="get" onsubmit="return checkField();">
			
                    <input type="hidden" name="subject_id" id="subject_id" value="">

                    <input type="hidden" name="location_id" id="location_id" value="">

                     <div class="form-group">

                        <div class="row">
							<table style="width:100%">
								<tr>
									<td>
									   <div >
											<?php
												$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
											?>
										  <div class="input-group" style="margin-bottom: 0px;">
											
											<span class="input-group-addon customInput" style="padding-left:10px;"><i class="fa fa-search"></i></span>
							
											 <!-- <input type="text" name="subject" class="my_form_control ui-autocomplete-input customInput" id="subject" placeholder="<?php echo HOME_SEARCH_EXAMPLE; ?>"> -->
											 <input type="text" name="subject" class="my_form_control autocomplete customInput" id="subject" placeholder="<?php echo "Subject";//echo HOME_SEARCH_EXAMPLE; ?>">

										  </div>                              
									
									   </div>
									</td>
									<td>
									   <div>

										  <div class="input-group ui-widget" style="margin-bottom: 0px;">

											 <span class="input-group-addon customInput" style="padding-left:10px"><i class="glyphicon glyphicon-map-marker"></i></span>
											 
											 <input type="text" name="location" class="my_form_control ui-autocomplete-input customInput" id="location" placeholder="<?php echo "Your location";//echo HOME_SEARCH_LOCATION_PLACEHOLDER; ?>" />
										  </div>

									   </div>
									</td>
									<td>
										<div>

											<button type="submit" class="btn btn-md search_btn" style="height:100%; width:100%; padding: 25px 10px 25px 10px"><?php echo HOME_SEARCH_TUTOR_PLACEHOLDER; ?></button>
										</div>
									</td>
								</tr>
							</table>

                        </div>

                     </div>

                  </form>

               </div>

            </div>

         </div>

      </div>

   </article> 

   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

      <!-- Indicators -->

      <ol class="carousel-indicators">

        <?php 

         // Get Slider

         $arrSlider = system::FireCurl(LIST_SLIDER);

         $i = 0;

         foreach($arrSlider->data as $sl){

         ?>

         <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i==0) {?> class="active" <?php } ?>></li>

         <?php $i++; } ?>

      </ol> 

      <!-- Wrapper for slides -->

      <!-- man -->
      <!-- <ol class="carousel-indicators">
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item">
          <img src="admin/upload/nonsliderimage.jpg" alt="tutorkami">
          <div class="carousel-caption">
            
          </div>
        </div>
      </div> -->
      <!-- man -->

      <div class="carousel-inner" role="listbox">

        <?php 

         // Get Slider

         $j = 0;

         foreach($arrSlider->data as $sl){

         ?>

         <div class="item <?php if($j==0) {?> active <?php } ?>">

            <img src="admin/<?php echo $sl->sl_image;?>" alt="...">

            <div class="carousel-caption">

            </div>

         </div>

         <?php $j++; } ?>

         

      </div>

   </div>

</section>

<section class="how_works">

   <div class="container">

   <div class="col-md-2"></div>

   <?php 

         // Get How it works

         $arrHowitworks = system::FireCurl(CMS_URL.'?cms_id=1&lang='.$_SESSION['lang_code']);

         

         foreach($arrHowitworks->data as $how){?>

       <div class=" col-md-12 tutor_button">

			<!--<h3 class="get_tutor1 sticky">

            <a href="request_a_tutor_form.php" class="green_btn pull-right">GET A TUTOR</a></h3>-->

			<div class="row  b_margin_50">

					<h1 class="header"><?=$how->pmt_subtitle?></h1>

			</div>

		</div>

      <div class="row">

        <?php

             echo $how->pmt_pagedetail;

         

         }

         ?>

      </div>

   </div>

</section>

<section class="orange_sec">

   <div class="container">

      <div class="row">

         <div class="col-md-10 col-md-offset-1">

            <div class="pin_box">

               <?php 

               // Get What is tutorkami

               $arrWhatistutorkami = system::FireCurl(CMS_URL.'?cms_id=2&lang='.$_SESSION['lang_code']);

               

               foreach($arrWhatistutorkami->data as $what){?>

                   

               <h1 class="header"><?=$what->pmt_subtitle?></h1>

               <hr class="myhr">

               <?php 

               echo $what->pmt_pagedetail;

               }

               ?>

               </div>

         </div>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <?php 

         // Get Why Tutorkami

         $arrWhytutorkami = system::FireCurl(CMS_URL.'?cms_id=3&lang='.$_SESSION['lang_code']);

         

         foreach($arrWhytutorkami->data as $why){?>

      <div class="row  b_margin_50">

         <div class="col-md-12">

            <h1 class="header"><?=$why->pmt_subtitle?></h1>

         </div>

      </div>

      <div class="row">

        <?php

             echo $why->pmt_pagedetail;

         

         }

        ?>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

           <?php 

            // Get Our Guarantee

            $arrOurGuarantee = system::FireCurl(CMS_URL.'?cms_id=4&lang='.$_SESSION['lang_code']);

            

            foreach($arrOurGuarantee->data as $guarant){ ?>

            <h1 class="header"><?=$guarant->pmt_subtitle?></h1>

            <?php

                echo $guarant->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="how_works bott_border">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">

          <?php 

            // Get Tutor Text

            $arrTutorText = system::FireCurl(CMS_URL.'?cms_id=22&lang='.$_SESSION['lang_code']);

            

            foreach($arrTutorText->data as $ttext){ ?>

            <h1 class="header"><?php echo $ttext->pmt_subtitle;?></h1>

            <p class="subHead"><?php echo $ttext->pmt_pagedetail;?></p>

            <?php

            }

           ?>

         </div>

      </div>

      <div class="row">

         <div class="col-md-12">

            <ul class="tutor_list">

              <?php 

                 // Get Slider

                 $arrTutor = system::FireCurl(LIST_TUTOR);

                 $i = 0;

                 foreach($arrTutor->data as $tutor){

                   $arrState = system::FireCurl(LIST_STATE_URL.'?state_id='.$tutor->ud_state);

                 foreach($arrState->data as $state){

                     $statename = $state->st_name;

                   }

                   $pix = sprintf("%'.07d\n", $tutor->u_profile_pic);

                 ?>  

               <li style="cursor:pointer">

                  <a href="tutor_profile.php?did=<?php echo $tutor->u_displayid; ?>" target="_blank">

                    <img src="<?php if($tutor->u_profile_pic!='') { echo APP_ROOT."images/profile/".$pix."_0.jpg"; } else { if($tutor->u_gender=='M') echo 'images/tutor_ma.png'; else echo 'images/tutor_mi1.png'; }?>" class="img-responsive center-block" alt=""/>

                    <p class="orange_head"><?=$tutor->u_displayname?></p>

                     <span><?=$tutor->ud_address?></span>

                  </a>

               </li>

               <?php } ?>

             </ul>

            <p class="m_top_30"><a href="search_tutor.php" class="orange_btn"><?php echo BUTTON_VIEW_MORE_TUTOR; ?></a></p>

         </div>

      </div>

   </div>

</section>

<section class="how_works">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get People Saying

            $arrPeopleSaying = system::FireCurl(CMS_URL.'?cms_id=5&lang='.$_SESSION['lang_code']);

            

            foreach($arrPeopleSaying->data as $saying){ ?>

            <h1 class="header"><?=$saying->pmt_subtitle?></h1>

            <?php

             echo $saying->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="join">

   <div class="container">

      <div class="row">

         <div class="col-md-12">

            <?php 

            // Get Are you a tutor

            $arrIsTutor = system::FireCurl(CMS_URL.'?cms_id=6&lang='.$_SESSION['lang_code']);

            

            foreach($arrIsTutor->data as $tutor){

                echo $tutor->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<section class="how_works gray_bg">

   <div class="container">

      <div class="row">

         <div class="col-md-8 col-md-offset-2">



            <h1 class="header">

            <?php 

            // Get Are you a tutor

            $arrNewsText = system::FireCurl(CMS_URL.'?cms_id=23&lang='.$_SESSION['lang_code']);

            

            foreach($arrNewsText->data as $newst){

              echo $newst->pmt_pagedetail;

            }?>

            </h1>

         </div>

      </div>

      <div class="row">

      <?php // Get Latest News

          if($_SESSION['lang_code']=='' || $_SESSION['lang_code']==$defaultLang){                 

            $lang_url = str_replace('{lang}/', '', LIST_LATESTNEWS_URL);

          }

          else{

            $lang_url = str_replace('{lang}', $_SESSION['lang_code'], LIST_LATESTNEWS_URL);

          }

          $arrLatestNews = system::FireCurl($lang_url);

          // var_dump($lang_url);

           $n = 1;

           $count = sizeof($arrLatestNews->data);

        

           foreach($arrLatestNews->data as $news){

             $post_id = $news->ID;

           ?>

          <div class="col-md-4">

            <div class="thum_bg">

             <a href="<?=$news->post_url?>"><img src="<?=$news->thumbnail_url?>" class="img-responsive" alt="" width="100%"/></a>

             <h4><?=$news->title?></h4>

             <p><?= $news->date?> | <?=$news->author?> | <?=$news->comments_count?> Comment(s)</p>

             <p><?=$news->content?></p>

           </div>

         </div>

      

         <?php if($n%3==0) echo '</div><div class="row hidden-xs">';?>

         

         <?php //if((($n!=0) && (($n+1)%3==0)) || ($n == $count-1))  echo '</div>';?>

       

       <?php $n++ ; } ?>

      </div>

   </div>

</section>



<section class="qe">

   <div class="container">

      <div class="row">

         <div class="col-md-12" style="position:relative;">

            <?php 

            // Get Questions or Enquires

            $arrEnquery = system::FireCurl(CMS_URL.'?cms_id=7&lang='.$_SESSION['lang_code']);

            

            foreach($arrEnquery->data as $entry){

                echo $entry->pmt_pagedetail;

            

            }

           ?>

         </div>

      </div>

   </div>

</section>

<?php include('includes/footer.php');?>

<script>

   $(function() {

      function log( message ) {

         $( "<div>" ).text( message ).prependTo( "#log" );

         $( "#log" ).scrollTop( 0 );

      }



      /*$("#subject").autocomplete({

         source: function( request, response ) {

            $.ajax( {

               url: "<?php echo SEARCH_SUBJECT_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          // alert(ui.item.id)

          $('#subject_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });*/

     

      $(document).ready(function(){

        $('.carousel').carousel({

          interval: 2000

        });



//         $('#carousel-example-generic1').carousel({

//         	interval: false

//       });

      

      });    

   

      /*$("#location").autocomplete({

         source: function( request, response ) {

            $.ajax( {

               url: "<?php echo SEARCH_LOCATION_URL; ?>",

               dataType: "json",

               data: {

                  term: request.term

               },

               success: function( data ) {

                  response( data );

               }

            });

         },

         minLength: 2,

         select: function( event, ui ) {

          $('#location_id').val(ui.item.id);

            // log( "Selected: " + ui.item.value + " aka " + ui.item.id );

         }

      });*/

   });
	
	<?php
		$connect = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME);
		$sqlS = "SELECT ts.ts_id, tc.tc_title, ts.ts_title FROM tk_tution_subject ts
				LEFT JOIN tk_tution_course tc ON tc.tc_id = ts.ts_tc_id AND tc.tc_status = 'A'
				WHERE ts.ts_status = 'A'";
		$sqlL = "SELECT tc.city_id, tc.city_name, st.st_name
				FROM tk_cities tc
				LEFT JOIN tk_states st
				ON st.st_id = tc.city_st_id
				WHERE tc.city_status = '1'";
				
		$subjectid = array();
		$locationid = array();
	?>
   var subjects = 	[
						<?php
							$res = mysqli_query($connect, $sqlS);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($subjectid, $row['ts_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['ts_title']." ".$row['tc_title']."'";
								$i++;
							}
						?>
					];
	var subjects_id = ['<?php echo join("', '", $subjectid); ?>'];
	
	var locations = 	[
						<?php
							$res = mysqli_query($connect, $sqlL);
							$i = 0;
							while($row = mysqli_fetch_array($res))
							{
								array_push($locationid, $row['city_id']);
								
								if($i != 0)
								{
									echo ",";
								}
								
								echo "'".$row['city_name'].", ".$row['st_name']."'";
								$i++;
							}
						?>
					];
	var locations_id = ['<?php echo join("', '", $locationid); ?>'];
	
	function autocomplete(inp, type) {
		var arr = [];
		var arrId = [];
		var hiddenInput;
		
		if(type == "s")
		{
			arr = subjects;
			arrId = subjects_id;
			hiddenInput = "#subject_id";
		}
		else if(type == "l")
		{
			arr = locations;
			arrId = locations_id;
			hiddenInput = "#location_id";
		}
		/*the autocomplete function takes two arguments,
		the text field element and an array of possible autocompleted values:*/
		var currentFocus;
		/*execute a function when someone writes in the text field:*/
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			/*close any already open lists of autocompleted values*/
			closeAllLists();
			if (!val) { return false;}
			currentFocus = -1;
			/*create a DIV element that will contain the items (values):*/
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items");
			a.setAttribute("style", "border:0");
			/*append the DIV element as a child of the autocomplete container:*/
			this.parentNode.appendChild(a);
			/*for each item in the array...*/
			for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].toUpperCase().includes(val.toUpperCase())) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = arr[i].substr(0, val.length);
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arrId[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
					b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.innerHTML.split("<input")[0];
						$(hiddenInput).val(this.getElementsByTagName("input")[0].value);
						//alert(this.getElementsByTagName("input")[0].value);
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
				}
			}
		});
		/*execute a function presses a key on the keyboard:*/
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1 && x) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
			}
		});
		function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}
		function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function (e) {
			closeAllLists(e.target);
		});
	}
	
	autocomplete(document.getElementById("subject"), 's');
	autocomplete(document.getElementById("location"), 'l');
</script>

<style>

	.autocomplete {
				/*the container must be positioned relative:*/
				position: relative;
				display: inline-block;
			}
			
	.autocomplete-items {
		overflow: auto;
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		height: 300px;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		top: 100%;
		left: 0;
		right: 0;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #fff; 
		border-bottom: 1px solid #d4d4d4; 
		color: #000;
		text-align: left;
	}

	.autocomplete-items div:hover {
		/*when hovering an item:*/
		background-color: #e9e9e9; 
	}

	.autocomplete-active {
		/*when navigating through the items using the arrow keys:*/
		background-color: DodgerBlue !important; 
		color: #ffffff; 
	}
</style>

<script>

  equalheight = function(container){



    var currentTallest = 0,

    currentRowStart = 0,

    rowDivs = new Array(),

    $el,

    topPosition = 0;

    $(container).each(function() {



     $el = $(this);

     $($el).height('auto')

     topPostion = $el.position().top;



     if (currentRowStart != topPostion) {

       for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

         rowDivs[currentDiv].height(currentTallest);

       }

       rowDivs.length = 0; // empty the array

       currentRowStart = topPostion;

       currentTallest = $el.height();

       rowDivs.push($el);

     } else {

       rowDivs.push($el);

       currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

     }

     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {

       rowDivs[currentDiv].height(currentTallest);

     }

   });

  }



  $(window).load(function() {

    equalheight('.how_works .thum_bg');

  });





  $(window).resize(function(){

    equalheight('.how_works .thum_bg');

  });

 // $('.carousel-example-generic1').carousel('pause');  

</script>



