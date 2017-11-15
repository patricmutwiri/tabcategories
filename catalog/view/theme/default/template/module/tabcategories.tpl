<?php if(!empty($categories)) { ?>
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ($categories as $key => $category) { ?>
	  		<li class="nav-item">
	  			<a data-toggle="tab" role="tab" class="nav-link<?php if($key == 0) { echo ' active'; } ?>" href="#c<?php echo $category['category_id']; ?>">
	  				<?php echo $category['name']; ?>
	  			</a>
	  		</li>
	  	<?php } ?>
	</ul>
	<div class="tab-content">
		<?php foreach ($categories as $key => $category) { ?>
			<div role="tabpanel" id="c<?php echo $category['category_id']; ?>" class="tab-pane fade in <?php if($key == 0) { echo ' active'; } ?>">
				<h5><?php echo $category['name']; ?></h5>
				<a title="<?php echo $category['name']; ?>" href="<?php echo $category['href']; ?>">
					<img src="<?php echo $category['thumb']; ?>" class="img-responsive" />
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>