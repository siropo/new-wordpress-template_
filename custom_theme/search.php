<?
	get_header();
?>
<!-- content -->
	<div id="wrapper-content" class="clear">
		<!-- content articles -->
		<section id="content">
			<? 
				if ( is_home() ) {
					query_posts( array( 'cat' => '-5', 'posts_per_page' => 5, 'id' => 'title', 'order' => 'DESC' ) );
				}
			?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="">
				<div class="img-post">
				<?

					if ( has_post_thumbnail() ) {
						echo get_the_post_thumbnail(get_the_ID(), array(60,60) );
					} else {
		
				?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/site_parts/noimage.gif" width="60" height="60" title="" alt="">
				<? } ?>
				
				</div>
				<div class="entry">
					<header>
						<h2 class="word-wrap"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					</header>
						<?php the_excerpt(); ?>
				</div>
			</article>
			<?php endwhile; else: ?>
			<div class="post">
				<div class="entry">
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				</div>
			</div>
			<?php endif; ?>
			<? wp_reset_query(); ?>
		</section>
		<aside id="sidebar">
			sidebar
			<? get_sidebar(); ?>
		</aside>
	</div>
<?
	get_footer();
?>