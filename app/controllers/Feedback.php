<?php

namespace app\controllers;


use app\traits\Policy;

class Feedback
{

    public function action($action)
    {
        $methodName = 'action' . $action;
        return $this->$methodName();
    }

    protected function beforeAction()
    {
        $_SESSION['id'] = null;
        $_SESSION['name'] = null;
        $_SESSION['email'] = null;
        $_SESSION['text'] = null;
        $_SESSION['error'] = null;
    }

    protected function actionIndex()
    {
        $this->beforeAction();
        $orderBy = 'create_date DESC';
        if(
            $_GET['sort'] == 'email' ||
            $_GET['sort'] == 'name' ||
            $_GET['sort'] == 'create_date DESC'
        ){
            $_SESSION['sort'] = $_GET['sort'];
        }
        if($_SESSION['sort']){
            $orderBy = $_SESSION['sort'];
        }
        $feedbacks = \app\models\Feedback::findAll($orderBy);
        require_once __DIR__ . '/../views/feedback-list.php';
    }

    protected function actionModerate()
    {
        $this->beforeAction();

        if(!Policy::isAdmin()){
            throw new \ErrorException('Прости, но для таких действий надо быть админом!');
        }

        $id = (int)$_GET['id'];
        if(0 == $_GET['valid'] || 1 == $_GET['valid']){
            $valid = $_GET['valid'];
        }else{
            throw new \ErrorException('Что-то пошло не так');
        }
        $feedback = \app\models\Feedback::findById($id);
        if(!$feedback) {
            throw new \ErrorException('Такого отзыва не существует',404);
        }

        $feedback->valid = $valid;
        $feedback->updateStatus();
        echo '<script>document.location.href = "/";</script>';
        exit;
    }

    protected function actionEdit()
    {
        $id = (int)$_GET['id'];
        $feedback = \app\models\Feedback::findById($id);
        if(!$feedback) {
            throw new \ErrorException('Такого отзыва не существует');
        }
        $_SESSION['id'] = $feedback->id;
        $_SESSION['name'] = $feedback->name;
        $_SESSION['email'] = $feedback->email;
        $_SESSION['text'] = $feedback->text;
    }

    protected function actionCreate()
    {
        $this->beforeAction();
        $feedback = new \app\models\Feedback();
        $feedback->validate();
        $feedback->insert();
        $feedbacks = \app\models\Feedback::findAll();
        require_once __DIR__ . '/../views/feedback-list.php';
    }

    protected function actionUpdate()
    {
        $this->beforeAction();

        if(!Policy::isAdmin()){
            throw new \ErrorException('Прости, но для таких действий надо быть админом!');
        }
        $id = (int)$_POST['id'];
        $feedback = \app\models\Feedback::findById($id);
        if(!$feedback) {
            throw new \ErrorException('Такого отзыва не существует');
        }
        $feedback->validate();
        $feedback->update_date = time();
        $feedback->update();
        $feedbacks = \app\models\Feedback::findAll();
        require_once __DIR__ . '/../views/feedback-list.php';
    }




}