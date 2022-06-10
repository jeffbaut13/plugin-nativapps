
<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<?php
    
	global $post;
    $args = array(
        'post_type'=>'libro', 
        'post_status'=>'publish', 
        'posts_per_page'=>50, 
        'orderby'=>'meta_value',
        'meta_key' => 'cyb_autor',
		'meta_key' => 'cyb_name',
		'meta_key' => 'cyb_genero',
        'order'=>'ASC'
    );
    $query = new WP_Query($args);

		$query->the_post();
		$autor = get_post_meta($post->ID, 'cyb_autor', true);
		$fecha = get_post_meta($post->ID, 'cyb_fecha', true);
		$genero = get_post_meta($post->ID, 'cyb_genero', true);
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_image_src( $thumbID, 'full' ); // Sustituir por thumbnail, medium, large o full
		$pathImgDestacada = $imgDestacada[0];

    ?>
    <div id="large-th">
            <div class="container">
                <h1> <?php the_title(); ?></h1>
                <br>
                <div id="list-th">        
					<div class="book read">
							<div class="cover">
								<img src="<?php echo $pathImgDestacada; ?>">
							</div>
							<div class="description">
								<p class="title"><?php get_the_title() ?><br>
									<span class="author"><?php echo "<b>Autor - </b>".$autor ?></span>
									<span class="fecha"><?php echo "Publicado en: ".$fecha ?></span>
									<div class="redondo" >
										<span class="genero"><?php echo $genero ?></span>
									</div>
								</p>
                			</div>
					</div>
				</div>
            </div>
	</div>
	<div id="large-th">

		<div class="container">
			<h1 style="margin:0;">Libros disponibles</h1>
			<br>
			<div id="list-th"> 
		
				<?php
				
				global $post;
				$args = array(
					'post_type'=>'libro', 
					'post_status'=>'publish', 
					'posts_per_page'=>50, 
					'orderby'=>'meta_value',
					'meta_key' => 'cyb_autor',
					'meta_key' => 'cyb_autor',
					'meta_key' => 'cyb_name',
					'meta_key' => 'cyb_genero',
					'order'=>'ASC'
				);
				$query = new WP_Query($args);

				echo '<div>';
				if($query->have_posts()):
					while($query->have_posts()): $query->the_post();
					$au = get_post_meta($post->ID, 'cyb_autor', true);
					$fa = get_post_meta($post->ID, 'cyb_fecha', true);
					$ge = get_post_meta($post->ID, 'cyb_genero', true);
					$thumb = get_post_thumbnail_id( $post->ID );
					$imgDe = wp_get_attachment_image_src( $thumb, 'full' ); // Sustituir por thumbnail, medium, large o full
					$ImgDestacada = $imgDe[0];
					?>	
					<div class="book read">
							<div class="cover">
								<img src="<?php echo $ImgDestacada; ?>">
							</div>
							<div class="description">
								<a href="<?php get_the_permalink()?>" class="title"><?php get_the_title() ?><br>
									<span class="author"><?php echo "<b>Autor - </b>".$au ?></span>
									<span class="fecha"><?php echo "Publicado en: ".$fa ?></span>
									<div class="redondo" >
										<span class="genero"><?php echo $ge ?></span>
									</div>

								</a>
                			</div>
					</div>
					<?php

					endwhile;
				else: 
					_e('Sorry, nothing to display.', 'cyb_textdomain');
				endif;
				echo '</div>';
				
				?>
				<div>
		<h5 style="margin:0;">Lista de Libros disponibles</h5>
	
		<?php
		
		$content = '<ul>';
		if($query->have_posts()):
			while($query->have_posts()): $query->the_post();

				// display event
				echo '<li><a href="'.get_the_permalink().'">'. get_the_title() .'</a> - <b>'.get_post_meta($post->ID, 'cyb_autor', true).'</b></li>'; 
			endwhile;
		else: 
			_e('Sorry, nothing to display.', 'cyb_textdomain');
		endif;
		echo '</ul>';
		
		?>
	</div>
			</div>	
		</div>
	</div>

<?php endwhile; ?>
<?php else: ?>
	<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
<?php endif; ?>
<?php get_footer(); ?>