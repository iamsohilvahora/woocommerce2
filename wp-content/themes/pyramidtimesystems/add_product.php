<?php
/* Template Name: Frontend Product */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<form method="post" class="product_form" enctype='multipart/form-data'>
			<div><h4>Product Data</h4></div>
			<div>
				<div><label>Product Name</label></div>
				<div><input type="text" name="proname" class="product_name" id="product_name" required /></div>
			</div>
			<div>
				<div><label>Product Description</label></div>
				<div><textarea name="prodesc" class="product_desc" id="product_desc" required></textarea></div>
			</div>
			<div>
				<div><label>Product Price</label></div>
				<div><input type="text" name="proprice" class="product_price" id="product_price" required /></div>
			</div>

			<div>
				<div><label>Select Product Categories</label></div>
				<div>
			  	<?php
					$taxonomy     = 'product_cat';
					$orderby      = 'name';  
					$show_count   = 0;      // 1 for yes, 0 for no
					$pad_counts   = 0;      // 1 for yes, 0 for no
					$hierarchical = 1;      // 1 for yes, 0 for no  
					$title        = '';  
					$empty        = 0;

					$args = array(
						'taxonomy'     => $taxonomy,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty
					);
					$all_categories = get_categories($args);
					foreach ($all_categories as $cat){
						if($cat->category_parent == 0){
							$category_id = $cat->term_id; 

						 	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$category_id}' />".' '.$cat->name;
						 	echo "<br />";

							$args2 = array(
								'taxonomy'     => $taxonomy,
								'child_of'     => 0,
								'parent'       => $category_id,
								'orderby'      => $orderby,
								'show_count'   => $show_count,
								'pad_counts'   => $pad_counts,
								'hierarchical' => $hierarchical,
								'title_li'     => $title,
								'hide_empty'   => $empty
							);
						 	$sub_cats = get_categories($args2);
						 	if($sub_cats){
						    	foreach($sub_cats as $sub_category){
						        	echo "<input type='checkbox' name='procat[]' class='product_cat' id='product_cat' value='{$sub_category->term_id}' />".' '."<b>$sub_category->name</b>";
						        	echo "<br />";
						     	}   
						 	}
						}       
					}
			    ?>
				</div>
			</div>

			<?php
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			$taxonomy_terms = array();
			if(!empty($attribute_taxonomies)): ?>
			<div>
			    <?php
			  	foreach($attribute_taxonomies as $tax): ?>
					<div>
						<div><label>Select <?php echo $tax->attribute_name; ?> Attributes</label></div>
						<?php 
						if(taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))): ?>
						<div>
							<?php
							echo "<select name='{$tax->attribute_name}[]'>";
							echo "<option value=''>Select Attribute Value</option>";
						    $taxonomy_terms = get_terms(wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name');
						    foreach($taxonomy_terms as $term){
								echo "<option value='{$term->name}'>$term->name</option>";
						    }
							echo "</select>";
						?>
						</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<div>
			  <div><label>Uplaod Product Featured Image</label></div>
			  <div><input type="file" name="productFeaturedImg" id="fileToUpload" accept="image/*" required></div>
			</div>

			<div>
			  <div><label>Uplaod Product Gallery</label></div>
			  <div><input type="file" name="productGallery[]" accept="image/*" multiple required></div>
			</div>

			<input type="submit" value="Submit" class="product_submit" id="add_product" />
		</form>
	</main>
</div>
<?php get_footer(); ?>