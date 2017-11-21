<?php if(!empty($categories)) { ?>
	<ul class="visible-xs tabcategories nav nav-tabs" role="tablist">
		<?php foreach ($categories as $key => $category) { ?>
		<?php if ($key < 4) { ?>
	  		<li class="tabcategory-li nav-item<?php if($key == 0) { echo ' active'; } ?>">
	  			<a data-toggle="tab" role="tab" class="nav-link<?php if($key == 0) { echo ' active'; } ?>" href="#c<?php echo $category['category_id']; ?>">
	  				<?php echo ucwords(strtolower($category['name'])); ?>
	  			</a>
	  		</li>
	  	<?php } ?>
	  	<?php } ?>
	</ul>
	<div class="visible-xs tab-content col-xs-12 noPaddin">
		<?php foreach ($categories as $key => $category) { ?>
			<div role="tabpanel" id="c<?php echo $category['category_id']; ?>" class="col-xs-12 noPaddin tab-pane fade in <?php if($key == 0) { echo ' active'; } ?>">
				<?php foreach ($category['products'] as $key => $product) { ?>
					<div class="tabProductX product-layout product-list col-xs-6 col-sm-6 col-md-3">
						<div class="product-thumb">
					    <div class="image tabCatImage col-xs-12">
					    	<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
					    </div>
					      	<div class="caption col-xs-12">
						        <h4 class="text-center"><a class="text-center" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
						        <?php if ($product['price']) { ?>
							        <p class="text-center">
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
<style type="text/css">
	.tabCatImage img{
		max-height: 200px;
		width: auto;
	}
    .tabcategories.nav-tabs li a {
    	border-radius: 0;
    	border-color: #ddd;
    }
    .tabcategory-li.active a.active {
        border-color: black;
    }
    .tabcategories > li.active > a, 
    .tabcategories > li.active > a:hover, 
    .tabcategories > li.active > a:focus{
    	border: 1px solid #000;
    }
    .tabcategories.nav-tabs {
    	border-bottom: 1px solid #000;
    	width: 768px;
		overflow: hidden;
	}
	.tabcategories.nav-tabs li{
		margin-bottom: 0px;
	}
	.tabProductX.product-list .product-thumb h4 a, .product-content h1{
		font-size: 100% !important;
		padding-top: 15px;
	}
	.tabProductX .caption{
		height: 100px;
	}
	@media(max-width: 768px){
		div.tabProductX .product-thumb .caption {
			height: 100px;
		}
		div.tabProductX .button-group.col-xs-12 {
			padding: 0px;
		}
	}
</style>