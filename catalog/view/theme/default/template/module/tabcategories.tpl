<?php if(!empty($categories)) { ?>
	<ul class="nav nav-tabs">
		<?php foreach ($categories as $key => $category) { ?>
	  		<li class="<?php if($key == 0) { echo 'active'; } ?>">
	  			<a data-toggle="tab" href="#<?php echo $category['category_id']; ?>">
	  				<?php echo $category['name']; ?>
	  			</a>
	  		</li>
	  	<?php } ?>
	</ul>
	<div class="tab-content">
		<?php foreach ($categories as $key => $category) { ?>
			<div id="<?php echo $category['category_id']; ?>" class="tab-pane fade in <?php if($key == 0) { echo ' active'; } ?>">
				<h3><?php echo $category['name']; ?></h3>
				<a title="<?php echo $category['name']; ?>" href="<?php echo $category['href']; ?>">
					<img src="<?php echo $category['thumb']; ?>" class="img-responsive" />
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>