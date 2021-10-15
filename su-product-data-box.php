<?php 
function VS_woo_loop_product_title() {
	global $product; //gets current product global var
    $terms = get_the_terms( $product->get_id(), 'product_cat' ); //get category terms
	$swish_amount = get_post_meta( $product->get_id(), 'swish_amount', true ); //get swish amount meta
    if ( $terms && ! is_wp_error( $terms ) ) : //continues if no errors
    //only displayed if the product has at least one category
	$pid = $product->get_id(); //gets product id
	$author     = get_user_by( 'id', $product->post->post_author ); //get product author/vendor
    	$store_info = dokan_get_store_info( $author->ID ); //gets author id
?>
                <span class="details">
                    <?php printf( '<a href="%s">%s</a>', dokan_get_store_url( $author->ID ), $author->display_name ); ?>
                </span>
 		
<div class="product_data_box webqo-hidden">
<table>
		<div class="swish-cost-product"><span><?php echo $swish_amount ?></span><img src="https://swishup.uk/wp-content/uploads/2020/11/swish-coin.png" class="swish-coin"></img></div>
	<?php
		$colour_count = 0; 
		$colours = array(); 
		echo "<h2 class='data-box-title'>PRODUCT DETAILS</h2>";
        foreach ( $terms as $term ) {?>
		
		
		<?php if($term->name!="Clothing"){ //dont echo the clothing category
		$parent_term_id = $term->parent; //get the id of the parent term
		$parent_term = get_term($parent_term_id)->name; //get the name of the term
		if($parent_term == "Colour"){ //as there may be multiple colours
			$colours[] = $term->name; //add them all to an array
		}
		else if($parent_term == "Size"){ //like colours, there may be multiple
			$sizes[] = $term->name; //put size names in an array
		}
			
		else{
?>
			<tr>
			<?php echo '<td><p>'.$parent_term.": ".$term->name.'</p></td>';
			}?>
			</tr>
			<?php
		}
	}
	
?>
	<tr>
			<?php 
		?> <td><p class="colour-value-overview">Colour(s): </p>
			<?php
			$amount_of_colours = sizeof($colours); //get amount of colours
			$colours_loop_count = 0; 
				foreach($colours as $colour){ //for each colour in array
					if($amount_of_colours - 1 > $colours_loop_count && $amount_of_colours > 1){ //if we are not on the last colour
					echo '<p class="colour-value-overview">'.$colour.', </p>'; //add a comma after the colour value
					$colours_loop_count += 1; //increase count
					}
					else if($amount_of_colours == $colours_loop_count){ //if we are on the last colour
						echo '<p class="colour-value-overview">'.$colour.'</p>'; //add a period after the colour value
					}
					else{
						echo '<p class="colour-value-overview">'.$colour.'</p>'; //if there is just one colour
					}
				}
			
	?>
	</tr>
	<tr>
			<?php 
		?> <td><p class="colour-value-overview">Size(s): </p>
			<?php
			$amount_of_sizes = sizeof($sizes);//get amount of sizes
			$sizes_loop_count = 0;
				foreach($sizes as $size){ //for each size in array
					if($amount_of_sizes - 1 > $sizes_loop_count && $amount_of_sizes > 1){ //if we are not on the last size
					echo '<p class="colour-value-overview">'.$size.', </p>'; //add a comma after the size value
					$sizes_loop_count += 1;
					}
					else if($amount_of_sizes == $sizes_loop_count){ //if we are on the last size
						echo '<p class="colour-value-overview">'.$size.'</p>'; //add a period after the size value
					}
					else{
						echo '<p class="colour-value-overview">'.$size.'</p>'; //if there is just one size
					}
				}
	?>
	</tr>
</table> 
</div>
<?php }?>