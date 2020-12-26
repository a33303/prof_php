<?php
namespace App\controllers;

use App\models\Comment;
use App\models\Good;

class GoodController extends Controller
{
    public function allAction()
    {
        $goodsObj = (new Good())->getAll();
        return $this->render(
            'goods',
            [
                'goods' => $goodsObj,
                'title' => 'Католог',
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = (new Good())->getOne($id);
        return $this->render(
            'good',
            [
                'good' => $good,
            ]
        );
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->render('user_add');
        }
        $user = new User();
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->save();
    }
    //доделать добавление товара addAction!!!

    public function updateCommentAction()
    {
        if (empty($_GET['id'])) {
            $this->setMSG('Не передан id');
            header('Location: ?c=good&a=addComment');

            return '';
        }

        $id = (int) $_GET['id'];
        /** @var Comment $good */
        $comment = (new Comment())->getOne($id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->render(
                'comment_update',
                [
                    'comment' => $comment
                ]
            );
        }

        $comment->id = $_POST['id'];
        $comment->name = $_POST['name'];
        $comment->save();

        $this->setMSG('Комментарий изменен');
        header('Location: ?c=good&a=addComment&id' . $id);

        return '';
    }

    public function addCommentAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->render('comment_add');
        }

        $comment = new Comment();
        $comment->id = $_POST['id'];
        $comment->name = $_POST['name'];
        $comment->save();

        $this->setMSG('Комментарий добавлен');
        header('Location: ?c=good&a=addComment&id' . $id);

        return '';
    }
}