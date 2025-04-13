<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?= $page['rootPath'] ?>assets/style.css">

		<title><?= $page['title'] ?> - qrdev.fr</title>

		<meta name="author" content="Quentin RIBAC">
		<meta name="description" content="Quentin RIBAC - blog PHP & JS - cours de développement web pour débutants en français">

		<meta property="og:url" content="https://qrdev.fr<?= $page['sitePath'] ?>">
		<meta property="og:title" content="<?= $page['title'] ?> - qrdev.fr">
		<meta property="og:type" content="website">
		<meta property="og:description" content="<?= $page['description'] ?: 'Quentin RIBAC - blog PHP & JS - cours de développement web pour débutant\'es en français' ?>">
	</head>
	<body>
		<main>
			<header>
				<aside id="header-card">
					<div>
						<img src="<?= $page['rootPath'] ?>assets/img/quentinRIBAC_square.jpg" alt="photo de mon visage sur fond orange" id="profile-pic">
					</div>
					<div>
						<div id="header-title">
							<a href="<?= $page['rootPath'] ?>index.html">
								qrdev.fr
							</a>
						</div>
						<hr>
						<div id="header-subtitle">
							Quentin RIBAC — PHP &amp; JS
						</div>
					</div>
				</aside>
				<nav>
					<?php foreach($pages as $navpage): if ($navpage['inNav']): ?>
						<a href="<?= $navpage['sitePath'] ?>">
							<?= $navpage['title'] ?>
						</a>
					<?php endif; endforeach; ?>
					</ul>
				</nav>
			</header>
			<section>
