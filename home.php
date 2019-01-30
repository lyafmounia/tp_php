<?php

 require_once 'functions.php';
/*require 'header.php';*/ 

$articles = getArticles();
require 'header.php';
?>


	<div class="container-fluid">
		<h2>Articles :</h2>
		<?php 

			foreach ($articles as $article): ?>
			<h2><?= $article->title ; ?>  </h2>
			<a href="article.php?id=<?= $article->id ?>"class="btn btn-primary">Lire la suite</a>
			<?php endforeach; ?>
	</div>
		

</html>

