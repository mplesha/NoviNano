<?php
		$header_image = get_header_image();
		if ($header_image)
			echo '<img class="header-image" src="'.esc_url($header_image).'" alt="" />';
		
		?>