<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assests/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Réseau Social</title>
</head>

<body>
    <header>
        <h1>Au bout de ma life</h1>
    </header>

    <main>
        <!-- Section d'ajout de post -->
        <section>
            <h2>Ajout de post</h2>
            <form action="/AddPost" method="post">
                <label for="title">Title</label>
                <input type="text" name="title" required>
                <label for="content">Content</label>
                <textarea name="content" id="content" required></textarea>
                <button type="submit">Publier</button>
            </form>
        </section>

        <!-- Section d'affichage des posts -->
        <section>
            <h2>Posts</h2>
            <?php foreach ($posts as $post) : ?>
                <article>
                    <!-- Formulaire d'édition de post -->
                    <?php if (isset($_POST['update']) && $_POST['update'] == $post->getId()) : ?>
                        <form action="/EditPost" method="post">
                            <input type="hidden" name="post_id" value="<?= $post->getId() ?>">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required>
                            <label for="content">Content</label>
                            <textarea name="content" id="content" required><?= htmlspecialchars($post->getContent()) ?></textarea>
                            <button type="submit">Valider</button>
                        </form>
                    <?php else : ?>
                        <!-- Affichage du post -->
                        <h3><?= htmlspecialchars($post->getTitle()) ?></h3>
                        <p><?= htmlspecialchars($post->getContent()) ?></p>

                        <!-- Boutons de like pour le post -->
                        <div class="like-buttons">
                            <?php $likeCount = LikeRepository::getLikeCount($post->getId(), 'post'); ?>
                            <form action="/toggleLike" method="post">
                                <input type="hidden" name="target_id" value="<?= $post->getId() ?>">
                                <input type="hidden" name="type" value="post">
                                <button type="submit">
                                    <?= LikeRepository::hasUserLiked($_SESSION['user_id'], $post->getId(), 'post') ? 'Je n\'aime plus' : 'J\'aime' ?>
                                    (<?= $likeCount ?>)
                                </button>
                            </form>
                        </div>

                        <!-- Boutons de modification et suppression du post -->
                        <?php if ($post->getUserID() == $_SESSION["user_id"]) : ?>
                            <form action="/DeletePost" method="post">
                                <button type="submit" name="remove" value="<?= $post->getId() ?>">Supprimer</button>
                            </form>
                            <form action="" method="post">
                                <button type="submit" name="update" value="<?= $post->getId() ?>">Modifier</button>
                            </form>
                        <?php endif ?>
                    <?php endif ?>

                    <!-- Section des commentaires -->
                    <div class="comments">
                        <h4>Commentaires</h4>
                        <?php
                        $comments = CommentRepository::getComments($post->getId());
                        if (empty($comments)):
                        ?>
                            <p>Aucun commentaire</p>
                        <?php else: ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment">
                                    <!-- Contenu du commentaire -->
                                    <p><?= htmlspecialchars($comment['content']) ?></p>
                                    <small>Par utilisateur <?= htmlspecialchars($comment['user_id']) ?> le <?= htmlspecialchars($comment['created_at']) ?></small>

                                    <!-- Boutons de like pour le commentaire -->
                                    <div class="like-buttons">
                                        <?php $commentLikeCount = LikeRepository::getLikeCount($comment['id'], 'comment'); ?>
                                        <form action="/toggleLike" method="post">
                                            <input type="hidden" name="target_id" value="<?= $comment['id'] ?>">
                                            <input type="hidden" name="type" value="comment">
                                            <button type="submit">
                                                <?= LikeRepository::hasUserLiked($_SESSION['user_id'], $comment['id'], 'comment') ? 'Je n\'aime plus' : 'J\'aime' ?>
                                                (<?= $commentLikeCount ?>)
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Boutons de modification et suppression du commentaire -->
                                    <?php if ($comment['user_id'] == $_SESSION["user_id"]): ?>
                                        <form action="/DeleteComment" method="post">
                                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                            <button type="submit">Supprimer</button>
                                        </form>
                                        <form action="/EditComment" method="post">
                                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                            <textarea name="content" required><?= htmlspecialchars($comment['content']) ?></textarea>
                                            <button type="submit">Modifier</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Formulaire pour ajouter un nouveau commentaire -->
                        <form action="/AddComment" method="post">
                            <input type="hidden" name="post_id" value="<?= $post->getId() ?>">
                            <textarea name="content" required placeholder="Ajouter un commentaire..."></textarea>
                            <button type="submit">Commenter</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>Copyright - 2024 - Eva Margot</p>
    </footer>
</body>

</html>