<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/views/header.php';

$controller = new \app\controllers\Feedback();

$action = 'Index';
if (!$_POST && !$_GET['id']) {
    $action = 'Index';
} elseif ($_GET['id'] && isset($_GET['valid'])) {
    $action = 'Moderate';
} elseif ($_GET['id']) {
    $action = 'Edit';
}elseif ($_POST && !$_POST['id']){
    $action = 'Create';
}elseif ($_POST && $_POST['id']){
    $action = 'Update';
}

try {
    $controller->action($action);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Что-то не так с базой' . $e->getMessage() . '</div>';
} catch (\ErrorException $e) {
    echo '<div class="alert alert-danger">Ошибка приложения: ' . $e->getMessage() . '</div>';
}

require_once __DIR__ . '/app/views/form.php';
include_once __DIR__ . '/app/views/preview-modal.php';
require_once __DIR__ . '/app/views/footer.php';
$_SESSION['success'] = null;