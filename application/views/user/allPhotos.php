<div style="height: 9rem"></div>
<div class="container">
	<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
		require 'application/config/database.php';
		require_once 'application/function/DbOperations.php';

		if (!isset($_SESSION['LimitStart']) && !isset($_SESSION['LimitEnd']))
		{
			$_SESSION['LimitStart'] = 0;
			$_SESSION['LimitEnd'] = 5;
		}

		$ImageInfo = GetImageInfo($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $_SESSION['LimitStart'], $_SESSION['LimitEnd']);
		$Comments = GetComments($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD);
		$CountStep = 0; ?>

		<?php foreach ($ImageInfo as $image):
			$CountStep++;
		?>
	<div class="picgallery">
		<div class="login"><?php echo $image['login']; ?></div>
		<img class="pic" src="<?php echo $image['image']; ?>">
		<div class="infoPicture">
			<?php if (isset($_SESSION['logIn']) && $_SESSION['logIn'] == true): ?>
				<?php $CountLikes = CheckLikes($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $image['id'], $_SESSION['user']);?>
				<?php if ($CountLikes === true): ?>
					<img onclick="addLike(<?php echo '\'' . $image['id'] . '\''; ?>)" class="like" id="like_<?php echo $image['id']; ?>" src="/application/images/heart-2.png"/>
				<?php else: ?>
					<img onclick="addLike(<?php echo '\'' . $image['id'] . '\''; ?>)" class="like" id="like_<?php echo $image['id']; ?>" src="/application/images/heart.png">
				<?php endif;?>
			<?php else: ?>
				<img class="like" src="/application/images/heart.png"/>
			<?php endif; ?>
			<?php $form = 'form'; ?>
			<label for="new_comment_<?php echo $image['id']; ?>" onclick="disp(document.getElementById(<?php echo '\'' . $form . $image['id'] . '\''; ?>))"
				   class="comment"><img id="comment_<?php echo $image['id']; ?>" src="/application/images/chat.png"/></label>
			<span class="numberLike" id="numberLike_<?php echo $image['id']; ?>">
				<?php echo CountNumberLikes($DB_DSN_CREATED, $DB_USER, $DB_PASSWORD, $image['id']); ?> likes</span>
		</div>
<!--		<div>-->
<!--			<button onclick="getComment.php">Тут кнопка закгрузить еще</button>-->
<!--		</div>-->
		<div id="firstcomment_<?php echo $image['id']; ?>">
			<?php foreach ($Comments as $line): ?>
				<?php if ($image['id'] == $line['imageId']):?>
						<div class="allcomments" style="color: #000000">
							<b style="color: #000000"><?php echo $line['isLiked']; ?></b> <?php echo $line['comment']; ?></div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<form id="form<?php echo $image['id']; ?>" method="post" style="display: none;">
			<?php if ($_SESSION['logIn']):?>
					<input type="text" maxlength="255" onkeypress="{if (event.keyCode === 13)
					{ event.preventDefault(); addComment(<?php echo '\'' . $image['id'] . '\''; ?>, this, <?php echo '\'' . $_SESSION['user'] . '\''; ?>)}}"
					class="inputcomment" id="new_comment_<?php echo $image['id']; ?>" name="new_comment_<?php echo $image['id']; ?>" placeholder="Add a comment...">
			<?php endif; ?>
		</form>
	</div>
	<?php endforeach; ?>
	</div>
	<div style="text-align: center; text-decoration: none">
		<?php if (count($ImageInfo) == 5 && !$_SESSION['LimitStart']): ?>
			<a href="/action/nextOrPreviousPage?nextPage=1" style="color: black">Next</a>
		<?php elseif (count($ImageInfo) < 5 && $_SESSION['LimitStart']): ?>
			<a href="/action/nextOrPreviousPage?previousPage=0" style="color: black">Previous</a>
		<?php else: ?>
			<a href="/action/nextOrPreviousPage?nextPage=1" style="color: black">Next | </a>
			<a href="/action/nextOrPreviousPage?previousPage=0" style="color: black">Previous</a>
		<?php endif; ?>
	</div>
<div style="height: 3rem"></div>