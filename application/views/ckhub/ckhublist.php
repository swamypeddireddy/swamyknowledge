<section>

<div class="khub_page">
<div class="main">

<div class="wrapper">

<div class="wrapper_search">
    
    
    <form method="post" action="<?php echo base_url().'ckhub/'; ?>">
                <input type="search" name="title" value="<?php if(isset($chubsearch)){ echo $chubsearch; } ?>" placeholder="Knowldge Hug Search ... "/>
            
                
                <div class="submit-container">
					<input name="hubsearch" value="" class="submit" type="submit">
				</div>
             
                
               
                </form>
</div>


<h3>Knowldge hub</h3>

  <ul class="tabs">
    <li class="active"><a href="#tab1">Templates</a></li>
    <li><a href="#tab2">Links</a></li>
    <li><a href="#tab3">News</a></li>
  </ul>
  <div class="clr"></div>
  <div class="block">
    <article id="tab1" style="display: block;">
     <?php if(count($templates)>0){ 
        foreach($templates as $templatesData){ ?> 
     
      <ul>
       
          <li><span class="list_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span><a href="<?php echo base_url(); ?>/documents/templates/<?php echo $templatesData->document; ?>" download><?php echo $templatesData->name; ?></a></li>

      </ul>
     <?php } }else{ ?>
        <ul>
       
          <li>No Templates Uploaded.</li>

      </ul>
        <?php } ?>
    </article>
    <article id="tab2" style="display: none;">
          <?php if(count($links)>0){ 
        foreach($links as $linksData){ ?> 
     
      <ul>
      <li><span class="list_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span><a href="<?php echo $linksData->link; ?>" target="_blank"><?php echo $linksData->name; ?></a></li>
      </ul>
          <?php } } else{ ?>
        <ul>
       
          <li>No Links Uploaded.</li>

      </ul>
        <?php } ?>
    </article>
    <article id="tab3" style="display: none;">
          <?php if(count($news)>0){ 
        foreach($news as $newsData){ ?> 
      <p><?php echo $newsData->title; ?></p>
     <?php } } else{ ?>
        <ul>
       
          <li>No News Uploaded.</li>

      </ul>
        <?php } ?>
    </article>
  </div>
</div>


</div>
</div>
</section>