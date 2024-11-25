<?php
//Template Name: Demo Page
get_header();
?>
<!-- properties prt start -->
<section class="prpts_sec">
		<div class="container">
			<div class="prpts_ottr">
				<form class="prpts_frm" role="search" method="get" action="<?php the_permalink();?>">
					<div class="prpts_frm_txt">
						<span><img src="<?php echo bloginfo('template_url');?>/assets/images/ba_dsh.png" alt="img"></span>
							<div class="cmn_hdr">
								<h6><?php the_field('property_section_heading');?></h6>
							</div>
						<span><img src="<?php echo bloginfo('template_url');?>/assets/images/ba_dsh.png" alt="img"></span>
					</div>
					<div class="prpts_frm_bxs">
						<div class="form-bx">
							<!-- Property Category: Price -->
							<?php
							$price_parent = get_term_by('slug', 'price', 'property_category');
							?>
							<select name="price" class="form-control">
								<option value=""><?php echo esc_html($price_parent->name); ?></option>
								<?php
								$price_categories = get_terms(array(
									'taxonomy' => 'property_category',
									'parent' => $price_parent->term_id,
									'hide_empty' => true,
								));
								foreach ($price_categories as $price) : ?>
									<option value="<?php echo esc_attr($price->slug); ?>">
										<?php echo esc_html($price->name); ?>
									</option>
									<?php
									// Get child categories of each price category
									$child_prices = get_terms(array(
										'taxonomy' => 'property_category',
										'parent' => $price->term_id,
										'hide_empty' => true,
									));
									foreach ($child_prices as $child) : ?>
										<option value="<?php echo esc_attr($child->slug); ?>">— <?php echo esc_html($child->name); ?></option>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</select>

							<!-- Property Category: Type -->
							<?php
							$type_parent = get_term_by('slug', 'type', 'property_category');
							?>
							<select name="type" class="form-control">
								<option value=""><?php echo esc_html($type_parent->name); ?></option>
								<?php
								$type_categories = get_terms(array(
									'taxonomy' => 'property_category',
									'parent' => $type_parent->term_id,
									'hide_empty' => true,
								));
								foreach ($type_categories as $type) : ?>
									<option value="<?php echo esc_attr($type->slug); ?>">
										<?php echo esc_html($type->name); ?>
									</option>
									<?php
									// Get child categories of each type category
									$child_types = get_terms(array(
										'taxonomy' => 'property_category',
										'parent' => $type->term_id,
										'hide_empty' => true,
									));
									foreach ($child_types as $child) : ?>
										<option value="<?php echo esc_attr($child->slug); ?>">— <?php echo esc_html($child->name); ?></option>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</select>

							<!-- Property Category: Bedrooms -->
							<?php
							$bedrooms_parent = get_term_by('slug', 'bedrooms', 'property_category');
							?>
							<select name="bedrooms" class="form-control">
								<option value=""><?php echo esc_html($bedrooms_parent->name); ?></option>
								<?php
								$bedroom_categories = get_terms(array(
									'taxonomy' => 'property_category',
									'parent' => $bedrooms_parent->term_id,
									'hide_empty' => true,
								));
								foreach ($bedroom_categories as $bedroom) : ?>
									<option value="<?php echo esc_attr($bedroom->slug); ?>">
										<?php echo esc_html($bedroom->name); ?>
									</option>
									<?php
									// Get child categories of each bedroom category
									$child_bedrooms = get_terms(array(
										'taxonomy' => 'property_category',
										'parent' => $bedroom->term_id,
										'hide_empty' => true,
									));
									foreach ($child_bedrooms as $child) : ?>
										<option value="<?php echo esc_attr($child->slug); ?>">— <?php echo esc_html($child->name); ?></option>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</select>
							
							<!-- Property Category: Bathrooms -->
							<?php
							$bathrooms_parent = get_term_by('slug', 'bathrooms', 'property_category');
							?>
							<select name="bathrooms" class="form-control">
								<option value=""><?php echo esc_html($bathrooms_parent->name); ?></option>
								<?php
								$bathroom_categories = get_terms(array(
									'taxonomy' => 'property_category',
									'parent' => $bathrooms_parent->term_id,
									'hide_empty' => true,
								));
								foreach ($bathroom_categories as $bathroom) : ?>
									<option value="<?php echo esc_attr($bathroom->slug); ?>">
										<?php echo esc_html($bathroom->name); ?>
									</option>
									<?php
									// Get child categories of each bathroom category
									$child_bathrooms = get_terms(array(
										'taxonomy' => 'property_category',
										'parent' => $bathroom->term_id,
										'hide_empty' => true,
									));
									foreach ($child_bathrooms as $child) : ?>
										<option value="<?php echo esc_attr($child->slug); ?>">— <?php echo esc_html($child->name); ?></option>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</select>

							<!-- More filters -->

							<select class="form-control">
								<option value="filter">More filters
								</option>
								<option value="filter">More filters
								</option>
								<option value="filter">More filters
								</option>
							</select>

							<!-- Submit Button -->
							<button type="submit" class="cmn_btn prpt_btn">
								<i class="fas fa-search"></i> Search
							</button>
						</div>
					</div>
				</form>
				<!-- Function handling for form -->
				<?php
				if ( isset($_GET['bathrooms']) || isset($_GET['bedrooms']) || isset($_GET['price']) || isset($_GET['type']) ) {
					$tax_query = array('relation' => 'AND');

					// Filter by Bathrooms
					if (!empty($_GET['bathrooms'])) {
						$tax_query[] = array(
							'taxonomy' => 'property_category',
							'field'    => 'slug',
							'terms'    => sanitize_text_field($_GET['bathrooms']),
						);
					}
					// Filter by Bedrooms
					if (!empty($_GET['bedrooms'])) {
						$tax_query[] = array(
							'taxonomy' => 'property_category',
							'field'    => 'slug',
							'terms'    => sanitize_text_field($_GET['bedrooms']),
						);
					}
					// Filter by Price
					if (!empty($_GET['price'])) {
						$tax_query[] = array(
							'taxonomy' => 'property_category',
							'field'    => 'slug',
							'terms'    => sanitize_text_field($_GET['price']),
						);
					}
					// Filter by Type
					if (!empty($_GET['type'])) {
						$tax_query[] = array(
							'taxonomy' => 'property_category',
							'field'    => 'slug',
							'terms'    => sanitize_text_field($_GET['type']),
						);
					}

					// Prepare the query for properties
					$args = array(
						'post_type' => 'property',
						'posts_per_page' => 10,  // Set the number of results per page
						'tax_query' => $tax_query,
					);
					$filtered_properties = new WP_Query($args);

					if ($filtered_properties->have_posts()) {
						echo '<div class="properties-list">';
						while ($filtered_properties->have_posts()) {
							$filtered_properties->the_post();

							// Get the permalink
							$permalink = get_permalink(); // Store the permalink
							
							// Assuming you have custom fields or other logic to define these variables
							$custom_field1 = get_post_meta(get_the_ID(), 'custom_field1', true);
							$custom_field2 = get_post_meta(get_the_ID(), 'custom_field2', true);
							$custom_field3 = get_post_meta(get_the_ID(), 'custom_field3', true);
							$custom_field4 = get_post_meta(get_the_ID(), 'custom_field4', true);
							$custom_field5 = get_post_meta(get_the_ID(), 'custom_field5', true);
							$imagepath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); // Get the featured image

							// Display the property information
							echo '<a href="' . esc_url($permalink) . '" class="sptlght_flx_prt wow fadeInUp" data-wow-delay="0.2s">';
							echo '<div class="sptlght_prt_img srimg">';
							echo '<div class="sptlght_prt_pic srpic">';
							echo '<img src="' . esc_url($imagepath[0]) . '" alt="img">';
							echo '</div>';
							echo '</div>';
							echo '<div class="apt_sl slp">';
							echo '<div class="apt_sl_lft lrp">';
							echo '<div class="cmn_hdr hng">';
							echo '<h6>' . esc_html(get_the_title()) . '</h6>';
							echo '</div>';
							echo '<span class="apt_lft_spn splf">' . esc_html(get_the_content()) . '</span>';
							echo '</div>';
							echo '<div class="apt_sl_rght">';
							echo '<span class="apt_rght_spn rtspn">' . esc_html($custom_field1) . '</span>';
							echo '<span class="apt_rght_spn rtspn">' . esc_html($custom_field2) . '</span>';
							echo '</div>';
							echo '</div>';
							echo '<div class="apt_sl_itms search">';
							echo '<div class="apt_itm_cst ctitm">';
							echo esc_html(get_the_excerpt());
							echo '</div>';
							echo '<div class="apt_itm_nmbrs mb">';
							echo '<span>';
							echo '<img src="' . esc_url(get_bloginfo('template_url') . '/assets/images/bd.png') . '" alt="img">';
							echo esc_html($custom_field3);
							echo '</span>';
							echo '<span>';
							echo '<img src="' . esc_url(get_bloginfo('template_url') . '/assets/images/bth.png') . '" alt="img">';
							echo esc_html($custom_field4);
							echo '</span>';
							echo '<span>';
							echo '<img src="' . esc_url(get_bloginfo('template_url') . '/assets/images/msq.png') . '" alt="img">';
							echo esc_html($custom_field5);
							echo '</span>';
							echo '</div>';
							echo '</div>';
							echo '</a>'; // Closing the link
						}
						echo '</div>'; // Closing properties-list
					} else {
						echo '<p>No properties found matching your criteria.</p>';
					}
					wp_reset_postdata();
				}
				?>
			</div>
		</div>
	</section>
	<!-- properties prt end -->
<?php
get_footer();
?>