<?php if(!empty(count($categories)) { ?>
		<ul class="nav nav-tabs">
			<?php foreach ($categories as $category) { ?>
		  		<li class=""><a data-toggle="tab" href="#<?php echo $category['category_id']; ?>">Home</a></li>
		  	<?php } ?>
		</ul>
	<?php } ?>		
	<div class="tab-content">
		<?php foreach ($categories as $category) { ?>
		  <div id="<?php echo $category['category_id']; ?>" class="tab-pane fade in">
		    <h3><?php echo $category['name']; ?></h3>
		    <a title="<?php echo $category['name']; ?>" href="<?php echo $category['href']; ?>">
		    	<img src="<?php echo $category['thumb']; ?>" class="img-responsive" />
		    </a>
		  </div>
		<?php } ?>
	</div>
<?php } 
} ?>