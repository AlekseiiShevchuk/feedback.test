<div class="container">
    Сортировать по:
    <a href="/?sort=create_date%20DESC">Дате</a> |
    <a href="/?sort=name">Имени</a> |
    <a href="/?sort=email">Email</a>
    <hr>
</div>
<?php
foreach ($feedbacks as $feedback) {
    include 'feedback.php';
}