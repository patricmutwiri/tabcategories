<?php if(!empty(count($categories)) { ?>
		<ul class="nav nav-tabs">
			<?php foreach ($categories as $key => $category) { ?>
		  		<li class=""><a data-toggle="tab" href="#<?php echo $category['category_id']; ?>">Home</a></li>
		  	<?php } ?>
		</ul>
	<?php } ?>		
	<div class="tab-content">
		<?php foreach ($categories as $key => $category) { ?>
		  <div id="<?php echo $category['category_id']; ?>" class="tab-pane fade in">
		    <h3><?php echo $category['category_name']; ?></h3>
		    <a href="<?php echo $this->url->link('product/category', 'path='.$category['category_id'].''); ?>">
		    	<img src="<?php echo $category['thumb']; ?>" class="img-responsive" />
		    </a>
		  </div>
		<?php } ?>
	</div>
<?php } 
} ?>