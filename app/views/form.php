<div class="container">
    <?php if ($_SESSION['error']) { ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
    <?php } ?>

    <?php if ($_SESSION['success']) { ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <form action="/" method="post" <?php if (!$_SESSION['id']) { ?>  enctype="multipart/form-data" <?php } ?> >
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="id" name="id" type="hidden" value="<?= $_SESSION['id'] ?>">
                        <input class="form-control" id="name" name="name" placeholder="Имя" type="text" required
                               value="<?= $_SESSION['name'] ?>">
                    </div>
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="email" name="email" placeholder="Электронная почта" type="email"
                               required value="<?= $_SESSION['email'] ?>">
                    </div>
            </div>
            <textarea class="form-control form-group" id="text" name="text" placeholder="Текст отзыва"
                      rows="5" required><?= $_SESSION['text'] ?></textarea>

                <?php if (!$_SESSION['id']) { ?>
                <div class="col-sm-6 form-group">
                    Прикрепить рисунок (jpg, gif, png):
                    <input class="form-control form-group" id="img" name="img" type="file" accept="image/jpeg,image/png,image/gif">
                </div>
            <?php } ?>



            <div class="row">
                <div class="col-md-6 form-group">
                    <br>
                    <button class="btn" id="preview">Предпросмотр</button>
                    <button class="btn" type="submit" id="submit">Отправить отзыв</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>