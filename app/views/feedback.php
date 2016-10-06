<div class="container">
    <div class="container">
        <b>Имя: </b><?= $feedback->name ?> | <b> Дата: </b><?= $feedback->create_date ?> |
        <b>Email: </b><?= $feedback->email ?>

        <?php if ($feedback->update_date) {
            echo '| <span class="bg-info"> Отредактировано Администратором </span>';
        } ?>

        <?php
        if (\app\traits\Policy::isAdmin()) {
            echo '| <a href="/?id=' . $feedback->id . '">Редактировать </a>';
            if (0 == $feedback->valid) {
                echo '| <a href="/?id=' . $feedback->id . '&valid=1">Одобрить</a>';
            } elseif (1 == $feedback->valid) {
                echo '| <a href="/?id=' . $feedback->id . '&valid=0">Скрыть</a>';
            }

        }
        ?>
    </div>
    <div class="container">
        <div class="media">
        <?php if ($feedback->image) { ?>
            <div class="media-left">
                <img src="<?= $feedback->image ?>" class="media-object">
            </div>
        <?php } ?>
            <div class="media-body">
                <h4 class="media-heading">Отзыв:</h4>
                <p><?= $feedback->text ?></p>
            </div>
        </div>

    </div>
    <hr>
</div>

