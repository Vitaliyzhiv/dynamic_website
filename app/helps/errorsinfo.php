<?php if (count($errors) > 0): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php foreach ($errors as $error): ?>
            <strong>Ошибка!</strong> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?><br>
        <?php endforeach; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif; ?>