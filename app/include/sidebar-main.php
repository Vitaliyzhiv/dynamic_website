<?php foreach ($topics as $topic): ?>
    <li><a href="<?= BASE_URL . "category.php?topic_id=" . $topic['id'] ?>"><?= $topic['name']; ?></a></li>
<?php endforeach; ?>