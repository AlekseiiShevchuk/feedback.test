<?php if (!\app\traits\Policy::isAdmin()) {
    include_once __DIR__ . '/auth-modal.php';
} ?>
</body>
</html>