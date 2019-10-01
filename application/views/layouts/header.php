<header>
	<div class="headercontainer">
		<div class="title">Camagru</a></div>
		<nav>
			<?php if (isset($_SESSION['logIn']) && $_SESSION['logIn'] == true): ?>
				<a id="" href="/account/myGallery">My gallery</a>
				<a id="" href="/action/nextOrPreviousPage?firstPage=1">Gallery</a>
				<a id="" href="/action/logOut">Sign Out</a>
			<?php else: ?>
				<a id="" href="/">Home</a>
				<a id="" href="/user/allPhotos">Gallery</a>
			<?php endif; ?>
		</nav>
	</div>
</header>