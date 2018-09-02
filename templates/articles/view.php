<?php include __DIR__ . '/../header.php'; ?>
    <tr>
        <td>
<!--            <h1>--><?//= $article['name'] ?><!--</h1>-->
<!--            <p>--><?//= $article['text'] ?><!--</p>-->
<!--            <p>Автор: --><?//= $nickname['author_id']?><!--</p>-->
            <h1><?= $article->getName()?></h1>
            <p><?= $article->getText() ?></p>
            <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
        </td>
        <?php include __DIR__ . '/../sidebar.php'; ?>
<?php include __DIR__ . '/../footer.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: drive867
 * Date: 15.08.2018
 * Time: 14:33
 */