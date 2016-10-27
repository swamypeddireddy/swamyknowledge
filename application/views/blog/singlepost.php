 
          <h2><?= $disc_post->title; ?></h2>
          <p><?= $disc_post->post; ?></p>
          <hr>
          <span id="disclike-panel-<?php echo $disc_post->idblog; ?>">

          <?php if (count($getPersonLikesPerPost) > 0) { ?>
          <a href="javascript: void(0)" id="post_id<?php echo $disc_post->idblog; ?>" class="discUnlike">Unlike</a>
          <?php } else { ?>
          <a href="javascript: void(0)" id="post_id<?php echo $disc_post->idblog; ?>" class="discLikeThis">Like</a>
          <?php } ?>

          </span>

          <div class="commentPanel" align="left">
<?php //echo "<pre>"; print_r($totalLikesPerPost); exit; ?>
          <span id="disclike-stats-<?php echo $disc_post->idblog; ?>"> <?php if(count($totalLikesPerPost)>0){ echo $totalLikesPerPost->likes; } else{ echo 0; } ?> </span> people like this.

          <span id="disclike-loader-<?php echo $disc_post->idblog; ?>">&nbsp;</span>
          </div>
          <hr>
          <h3>Comments</h3>

          <?php
          //if there is comments then print the comments
          if (count($disc_comments) > 0) {

          foreach ($disc_comments as $row) {
          ?>
          <div class="message-box" id="message_<?php echo $row->idblogcomments; ?>">
              <p>
                  <a href="#">
                  
                  
                <img class="media-object" src="<?php
                            if (isset($row->image) && $row->image != '') {
                                echo base_url('documents/profile_photos/'.$row->image);
                            } else {
                                echo base_url('documents/profile_photos/default.png');
                            }
                            ?>" width="40px" height="40px">
                </a>
                
              <strong><?= $row->firstname ?></strong> said at <?= date('d-m-Y h:i A', strtotime($row->createddate)) ?><br>
          <div class="message-content">
          <?= $row->comment; ?>
          </div>
          </p>
          <?php if ($row->idblogcomments != 0 && ($this->session->userdata('session_userId') == $row->iduser)) { ?>

         <!-- <button class="btn btn-primary btnEditAction" name="edit" onClick="showDiscEditBox(this,<?php //echo $row->idblogcomments; ?>)">Edit</button>
          <button class="btn btn-danger btnDeleteAction" name="delete" onClick="callCrudAction('delete',<?php //echo $row->idblogcomments; ?>)">Delete</button> -->
          <?php } ?>
          </div>

          <hr>
          <?php
          }
          } else { //when there is no comment
          echo "<p>Currently, there are no comment.</p>";
          }

          if ($this->session->userdata('session_userId')) {//if user is loged in, display comment box
          ?>
          <!--                                            <div id="frmAdd">
          <textarea name="txtmessage" id="txtmessage" cols="80" rows="5"></textarea>

          <p><button id="btnAddAction" name="submit" onClick="callCrudAction('add','')">Add</button></p>

          </div>-->
          <img src="<?php echo base_url(); ?>assets/img/LoaderIcon.gif" id="loaderIcon" style="display:none" />
          <div id="frmAdd">
          <form action="<?= base_url() ?>blog/add_comment/<?= $disc_post->idblog; ?>" method="post">
          <div class="form_settings">
          <p>
          <span>Comment</span>
          <textarea class="textarea" rows="8" cols="100" name="comment" required></textarea>
          </p>
          <p style="padding-top: 15px">
          <span>&nbsp;</span>
          <input class="btn btn-primary submit" type="submit" name="add" value="Add comment" />
          <br />
          </p>
          </div>
          </form>
               
              
              
          </div>

          <?php
          } else {//if no user is loged in, then show the loged in button
          ?>
          <a href="<?= base_url() ?>users/login">Login to comment</a>
          <?php
          } ?>
<script type="text/javascript">
    $(document).ready(function () {
  

        /// like 

        //start of discussions comments and forum likes and unlikes
        $('.discLikeThis').on("click", function (e) {

            var getID = $(this).attr('id').replace('post_id', '');

alert(getID);
            $("#disclike-loader-" + getID).html('<img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="" />');
   $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>Blog/disc_like",
                data: {postId: getID},
                success: function (response) {
                     if(response>0){
                         

                $('#disclike-stats-' + getID).html(response);

                $('#disclike-panel-' + getID).html('<a href="javascript: void(0)" id="post_id' + getID + '" class="discUnlike">Unlike</a>');

                $("#disclike-loader-" + getID).html('');
            
                     }else{
                          
                     }
                }
            });
            
            
            
        });

        /// unlike 

        $('.discUnlike').on("click", function (e) {

            var getID = $(this).attr('id').replace('post_id', '');
      $("#disclike-loader-" + getID).html('<img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="" />');
       $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>Blog/disc_unlike",
                data: {postId: getID},
                success: function (response) {
                     if(response==1){
                          $('#disclike-stats-' + getID).html(response);

                $('#disclike-panel-' + getID).html('<a href="javascript: void(0)" id="post_id' + getID + '" class="discLikeThis">Like</a>');

                $("#disclike-loader-" + getID).html('');
            
                     }else{
                          
                     }
                }
            });
            
        });
 
        //end of forum comments and forum likes and unlikes
    });
 

     
</script>