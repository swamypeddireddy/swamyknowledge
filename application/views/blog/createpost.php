<div class="user-information">
    <div class="main">
        
  <h2>Create Blog</h2>
   <?php   if ($this->session->flashdata('success')) {
        ?>
        <div class="alert alert-success" style="padding-top:0px;">
            <p align="center"><?php echo $this->session->flashdata('success'); ?></p>
        </div>
    <?php }
    ?>            
    <?php
    if ($this->session->flashdata('fail')) {
        ?>
        <div class="alert alert-info" style="padding-top:0px;">
            <p align="center"><?php echo $this->session->flashdata('fail'); ?></p>
        </div>		
        <?php
    }
    ?>
<?php
$attributes = array('id' => 'target');
echo form_open('Blog/createPost', $attributes); ?>

                           <div class="form-group row">
                              
                              <label for="name" class="col-lg-2 control-label" >Category Name<span style='color:red'>*</span></label>
                              <div class="col-lg-10">
                                
                                   <input required="" type="text" class="ask_input_i" name="name" id="category_name" value="<?php echo set_value('name')?>">
                                                                  
                              </div>
                           </div> 

                            <div class="form-group row">
                              
                              <label for="description" class="col-lg-2 control-label" >Description<span style='color:red'>*</span></label>
                              <div class="col-lg-10">
                                
                                 
                                   <textarea required="" type="input"  name="description" id="description" value="<?php echo set_value('description')?>" width="100%"/></textarea>
                                                                  
                              </div>
                         </div>





    <div class="form-group" style="float:right;margin-right:333px">
        <input type="submit" name="post" value="submit" />
    
    </div>
</form>
    </div> </div>

<script src="<?php echo base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
               
                <script src="<?php echo base_url(); ?>/assets/ckfinder/ckfinder.js"></script>
                <script>

                
                    CKEDITOR.replace('description');
                              /*var editor = CKEDITOR.replace( 'editor1', {
                 
              });
              CKFinder.setupCKEditor( editor, '../' );
                               // Add Upload tab*/

                </script>
                <style>

                  .cke_wysiwyg_frame
                  {
                    width:100%;
                    height:100%;

                  }

                </style>
