<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }
		/* This variable is for alternating comment background */
		$oddcomment = 'odd';
?>

<!-- You can start editing here. -->

<div class="boxcomments" >
<?php if ($comments) : ?>
<?php 
	/* Count the totals */
	$numPingBacks = 0;
	$numComments  = 0;
	/* Loop through comments to count these totals */
	foreach ($comments as $comment) {
		if (get_comment_type() != "comment") { $numPingBacks++; }
		else { $numComments++; }
	}
?>

<?php 
	/* This is a loop for printing comments */
	if ($numComments != 0) : ?>
	<h2><?php comments_number('No comments', '1 comment', '% comments' );?> за &#8220;<?php the_title(); ?>&#8221;</h2>
		<ol class="commentlist">
		<?php foreach ($comments as $comment) : ?>
		<?php if (get_comment_type()=="comment") : ?>
			<li class="<?php if ( $comment->comment_author_email == get_the_author_email() ) echo 'mycomment'; else echo $oddcomment; ?> clear" id="comment-<?php comment_ID() ?>">
				<span class="gravatar">
				<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '60'); } ?>
				</span>
				<p>From <strong class="author-name"><?php comment_author_link() ?></strong> on <span class="comment-date"><?php comment_date('M j, Y') ?></span> </p>
				<?php if ($comment->comment_approved == '0') : ?>
				<em>Your comment is awaiting approval. If you have registered not to wait for approval.</em>
				<?php endif; ?>
				<?php comment_text() ?>
			</li>
	<?php /* Changes every other comment to a different class */	
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'odd';
	?>
	<?php endif; endforeach; ?>
		</ol>
	
	<?php endif; ?>
	<?php
	/* This is a loop for printing trackbacks if there are any */
	if ($numPingBacks != 0) : ?>
	<ol class="cloop">
		<li><h2><?php _e($numPingBacks); ?> Trackback(s)</h2></li>
		<?php foreach ($comments as $comment) : ?>
		<?php if (get_comment_type()!="comment") : ?>
		<li id="comment-<?php comment_ID() ?>">
			<?php comment_date('M j, Y') ?>: <?php comment_author_link() ?>

			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>
		</li>
	<?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>	
	<?php endif; endforeach; ?>
	</ol>
<?php endif; ?>
<?php else : 

	/* No comments at all means a simple message instead */ 
?>
<?php endif; ?>

<?php if (comments_open()) : ?>
	<h3><?php comment_form_title( 'Your comment', 'Your coment on %s' ); ?></h3>
	<?php if (get_option('comment_registration') && !$user_ID ) : ?>
		<p id="comments-blocked">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=
		<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if ($user_ID) : ?>
	<p>You are logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
		<?php echo $user_identity; ?></a>. To exit, <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">clich here</a>.
	</p>
<?php else : ?>	
		<p><label for="author">Name<?php if ($req) _e(' (require)'); ?></label>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></p>	
		<p><label for="email">E-mail (will not be published)<?php if ($req) _e(' (require)'); ?></label>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" size="22" /></p>		
		<p><label for="url">Website</label>
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>
<?php endif; ?>
		<p><textarea name="comment" id="comment" cols="5" rows="10" tabindex="4"></textarea></p>
		<p><input name="submit" type="submit" id="submit" tabindex="5" value=" send " />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
	<?php do_action('comment_form', $post->ID); ?>
	</form>
<?php endif; // If registration required and not logged in ?>
<?php else : // Comments are closed ?>
	<!--<p id="comments-closed">Sorry, comments for this entry are closed at this time.</p>-->
<?php endif; ?></div>