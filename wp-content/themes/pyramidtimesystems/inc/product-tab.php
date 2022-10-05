<?php
	// Front-end
	// Callback function for display product specification
	function func_display_product_specs(){
		global $product;

	    if('variable' != $product->get_type() && $care_instruction = get_post_meta($product->get_id(), '_specification_instruction', true)){
	        echo $care_instruction;
	    }
	}

	// calback function for display download pdf
	function func_download_template(){ 
		global $product;
		$downloads = $product->get_downloads();
	?>		
		<div id="pdf_box">
		    <div class="pdf_data">
		      <ul class="pdf_file">
		           <?php
		           		$wc_pdf_names = get_post_meta(get_the_id(), '_wc_file_names_pdf', true);
		           		$wc_pdf_urls = get_post_meta(get_the_id(), '_wc_file_urls_pdf', true);	         
/*
		           		echo "<pre>"; print_r($wc_pdf_names);
		           		echo "<pre>"; print_r($wc_pdf_urls);*/
		           		
		           		array_map(function($name_key, $name_value, $url_key, $url_value){
		           		    $ProductID = attachment_url_to_postid($url_value);
		           			$path = get_attached_file($ProductID);
		           			$size = size_format(filesize($path));
		           			
		           		    if($name_key == $url_key):
		           	?>
		           <li>
		            <table width="100%">
		                <tbody>
							<tr>
								<td width="80%"> 
									<img src="http://pyramidtimesystems.demo1.bytestechnolab.com/wp-content/uploads/2022/01/pdf-file.png">            
										<a align="absmiddle" href="<?php echo $url_value; ?>" target="_blank"><?php echo $name_value; ?>
										</a>
										<span>(<?php echo $size; ?>)</span>
								</td>
								<td width="20%" style="text-align:center;">
									<a align="absmiddle" class="download-file" download="<?php echo $name_value; ?>" title="<?php echo $name_value; ?>" href="<?php echo $url_value; ?>">Download
									</a>
								</td>
							</tr>
		                 </tbody>
		             </table>
		          </li>
		          <?php
		          endif;
		           			},array_keys($wc_pdf_names), array_values($wc_pdf_names), array_keys($wc_pdf_urls), array_values($wc_pdf_urls));

		       ?>                       
		        </ul>             
		    </div>
		</div>
	<?php }	

	// function func_accessories_template(){
	// 	 'woocommerce_output_related_products');
	// }

?>