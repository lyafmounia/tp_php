<?php
if (!isset($_GET['id']) OR !is_numeric($_GET['id'])) 
	header('Location:home.php');
else{
	extract($_GET);
	$id = strip_tags($id);

	require_once('functions.php');

	if (!empty($_POST)) {
		extract($_POST);
		$errors = array();

		$author = strip_tags($author);
		$comment = strip_tags($comment);

		if (empty($comment)) {
			array_push($errors, 'Entrez un pseudo');
		}
		if (empty($comment)) {
			array_push($errors, 'Entrez un commentaire');
		}
		if (count($errors) == 0) {
			$comment = addComment($id, $comment, $author);
			$success = 'Votre commentaire a été publié ';
			unset($author);
			unset($comment);
		}
		
	}

	$article = getArticle($id);
	$comment = getComment($id);
}

require 'header.php';

?>

<div class="container-fluid">
	
	<h1><?= $article['title']; ?></h1>
	<p><?= $article['content']; ?></p>
	<hr>

	<?php 
		if (isset($success)) {
			echo $success;
		}

			if (!empty($errors)):?>
				<?php foreach ($errors as $error):?>
					<div class="row">
						<div class="col-md-6">
							<div class="alert alert-danger"><?= echo $error; ?></div>							
						</div>					
					</div>
					<p> <?= $error ?></p>
				<?php endforeach; ?>

	<?php endif; ?>

	 

	<div class="row">
		<div class="col-md-6">
			<form action="article.php?id=<?=$article->id ?>" method="post">
				<p>
					<label for="author">Pseudo :</label>
					<input type="text" name="author" id="author" value="<?php if(isset($author)) echo $author ?>">
				</p>
				<p>
					<label for="comment">Commentaire :</label><br>
					<textarea name="comment" id="comment" cols="30" rows="10" <?php if(isset($comment)) echo $comment ?>></textarea>
				</p>
				<button type="submit" class="btn btn-success">Envoyer</button>
			</form>

			<h2>Commentaires</h2>

			<?php foreach ($comments as $comm): ?>
				<h3> <?= $comm->author ?></h3>
				<p><?= $comm->comment ?> </p>
			<?php endforeach; ?>
			
		</div>
		
	</div>

</div>