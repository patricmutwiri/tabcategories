<?php if(!empty($categories)) { ?>
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ($categories as $key => $category) { ?>
	  		<li class="nav-item<?php if($key == 0) { echo ' active'; } ?>">
	  			<a data-toggle="tab" role="tab" class="nav-link<?php if($key == 0) { echo ' active'; } ?>" href="#c<?php echo $category['category_id']; ?>">
	  				<?php echo $category['name']; ?>
	  			</a>
	  		</li>
	  	<?php } ?>
	</ul>
	<div class="tab-content col-xs-12 noPaddin">
		<?php foreach ($categories as $key => $category) { ?>
			<div role="tabpanel" id="c<?php echo $category['category_id']; ?>" class="col-xs-12 noPaddin tab-pane fade in <?php if($key == 0) { echo ' active'; } ?>">
				<?php foreach ($category['products'] as $key => $product) { ?>
					<div class="product-layout product-list col-xs-6 col-sm-6 col-md-3">
						<div class="product-thumb">
					    <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
					      	<div class="caption">
						        <h4 class="text-center"><a class="text-center" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
						        <?php if ($product['rating']) { ?>
							        <div class="rating text-center">
										<?php for ($i = 1; $i <= 5; $i++) { ?>
											<?php if ($product['rating'] < $i) { ?>
												<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
											<?php } else { ?>
												<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
											<?php } ?>
										<?php } ?>
							        </div>
						        <?php } ?>
						        <?php if ($product['price']) { ?>
							        <p class="price text-center">
										<?php if (!$product['special']) { ?>
											<?php echo $product['price']; ?>
										<?php } else { ?>
											<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
										<?php } ?>
										<?php if ($product['tax']) { ?>
											<span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
										<?php } ?>
							        </p>
						        <?php } ?>
					      	</div>
					      <div class="button-group col-xs-12">
					        <button type="button" class="col-xs-4" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
					        <button type="button" class="col-xs-4" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
					        <button type="button" class="col-xs-4" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
					      </div>
					  	</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>