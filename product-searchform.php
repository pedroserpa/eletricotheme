<?php
$form = '<form class="woocommerce-product-search" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" class="search-field" id="woocommerce-product-search-field-0" placeholder="' . __( 'Search', 'woocommerce' ) . '" />
		<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>';
echo $form;