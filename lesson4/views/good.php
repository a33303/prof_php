<?php
/** @var \App\models\Good  $good*/
?>

<h1>Товар <?= $good->name ?></h1>
<br>
<a href="?c=good&a=update&id=<?= $good->id ?>">Изменить</a>