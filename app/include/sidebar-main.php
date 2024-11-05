<?php foreach ($topics as $topic): ?>
    <li><a href="<?= BASE_URL . "/admin/topics/edit.php?id=" . $topic['id'] ?>"><?= $topic['name']; ?></a></li>
<?php endforeach; ?>