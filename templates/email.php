<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <meta charset="utf-8">
</head>

<body style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color:#f0f2ea; margin:0; padding:0; color:#333333;">
    <h1>Поздравляем с победой</h1>
    <p>Здравствуйте, <?= $user_name ?></p>
    <p>Ваша ставка для лота <a href="http://php7test/lot.php?id=<?= $lot_id; ?>"><?= $lot_name ?></a> победила.</p>
    <p>Перейдите по ссылке <a href="http://php7test/myrates.php">мои ставки</a>,
        чтобы связаться с автором объявления</p>
    <small>Интернет Аукцион "YetiCave"</small>
</body>

</html>