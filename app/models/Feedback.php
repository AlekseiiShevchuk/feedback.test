<?php

namespace app\models;

use app\Db;
use app\Model;
use app\traits\imageHandler;


class Feedback extends Model
{
    const TABLE = 'feedbacks';
    public $name;
    public $email;
    public $text;
    public $image;
    public $update_date;


    public function updateStatus()
    {
        $sql = 'UPDATE ' . static::TABLE .
            ' SET valid = ' . $this->valid .
            ' WHERE id = ' . $this->id;
        $db = Db::instance();
        $db->execute($sql);
    }

    public function update()
    {
        $sql = 'UPDATE ' . static::TABLE .
            ' SET name = "' . $this->name .
            '" , email ="'. $this->email .
            '" , text = "' . $this->text .
            '" , update_date = ' . $this->update_date .
            ' WHERE id = ' . $this->id;
        $db = Db::instance();
        $db->execute($sql);
    }

    public function validate()
    {
        // name validation
        $validateResult = false;
        if (!$_POST['name']) {
            $validateResult .= 'Имя обязательно к заполнению <br> ';
        } else {
            $this->name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        }
        // feedback text validation
        if (!$_POST['text']) {
            $validateResult .= 'Текст сообщения обязателен к заполнению <br> ';
        } else {
            $this->text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        }
        // e-mail validation
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->email = $email;
        } else {
            $validateResult .= 'Email не верный или не заполнен <br> ';
        }

        if ($validateResult === false && $_FILES["img"]["name"]) {
            $target_file = IMG_FOLDER . DIRECTORY_SEPARATOR . time() . '_' . basename($_FILES["img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // проверяем фейковость картинки
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
            // Поверяем формат
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $uploadOk = 0;
            }
            // если есть ошибки при загрузке
            if ($uploadOk == 0) {
                $validateResult .= 'Не удалось загрузить или обработать картинку! <br> ';
                // если нет ошибок то отправляем файл на обработку
            } else {
                $result = imageHandler::makeSmallerIfNecessary($_FILES["img"]["tmp_name"],320,240,$target_file);
                if(true == $result){
                    $this->image = $target_file;
                }else{
                    $validateResult .= 'Не удалось загрузить или обработать картинку! <br> ';
                }


            }
        }

        if ($validateResult) {
            $_SESSION['error'] = $validateResult;
            $_SESSION['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $_SESSION['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $_SESSION['text'] = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
            echo '<script>document.location.href = "/";</script>';
        } else {
            $_SESSION['success'] = 'Ваш отзыв успешно отправлен и ожидает проверки модератора!';
            if($this->id){
                $_SESSION['success'] = 'Отзыв успешно обновлен';
            }

        }

    }
}