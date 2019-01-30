<?php

function getArticles() {
	require 'db.php';
	$req = $bdd->prepare('SELECT id, title FROM article ORDER BY id DESC');
	$req->execute();
	$data = $req->fetchAll(PDO::FETCH_OBJ);	
	return $data;
	$req->closeCursor();
}

function getArticle($id) {
	require 'db.php';
	$req = $bdd->prepare('SELECT * FROM article WHERE id=?');
	$req->execute(array($id));
		if ($req->rowCount() == 1) {
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data;
		}else{
			header('Location : home.php');
			$req->closeCursor();
		}

}

function addComment($article_id, $commentaire, $author){
	require 'db.php';
	$req = $bdd->prepare('INSERT INTO commentaire (article_id, comment, author) VALUES ? ? ');
	$req->execute(array($article_id, $comment, $author));
	$req->closeCursor();
}


function getComment($id) {
	require 'db.php';
	$req = $bdd->prepare('SELECT * FROM commeentaires WHERE article_id=?');
	$req->execute(array($id));
		if ($req->rowCount() == 1) {
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data;
			$req->closeCursor();
}