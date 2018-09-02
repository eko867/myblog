    <?php include __DIR__.'/../header.php'; ?>

        <tr>
            <td>
                <?php foreach ($articles as $article): ?>
                    <h2>
<!--                    old version without ORM
                        <a href="/articles/<?/*=$article['id'] */?>" >
                            <?/*= $article['name'] */?>
                        </a>
-->
                        <a href="/articles/<?= $article->getId() ?>" >
                           <?= $article->getName() ?>
                        </a>
                    </h2>


<!--                <p><? //= $article['text'] ?></p>   -->
                    <p><?= $article->getText() ?></p>
                <hr>
                <?php endforeach; ?>
            </td>

    <?php include __DIR__.'/../sidebar.php'; ?>
    <?php include __DIR__.'/../footer.php'; ?>
