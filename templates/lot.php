<section class="lot-item container">
    <?php if (isset($lot)) : ?>
        <h2><?= $lot['name'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= $lot['url'] ?>" width="730" height="548" alt="<?= $lot['category'] ?>">
                </div>
                <p class="lot-item__category">Категория: <span><?= $lot['category'] ?></span></p>
                <p class="lot-item__description"><?= $lot['detail'] ?></p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        <?= "$time_limited[0]:$time_limited[1]:$time_limited[2]:$time_limited[3]" ?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Изначальная цена</span>
                            <span class="lot-item__cost"><?= $lot['cost_start'] ?></span>
                        </div>
                        <div class="lot-item__box">
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?= $lot['cost_start'] + $cost_step ?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Шаг ставки <span><?= $lot['cost_step'] ?></span>
                            </div>
                        </div>
                    </div>
                    <form class="lot-item__form" action="/lot.php?id=<?= $_GET['id'] ?>" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost" placeholder="<?= $max_bet + $cost_step ?>">
                        </p>
                        <button type="submit" class="button" value="1">Сделать ставку</button>
                    </form>
                    <?php if (isset($errors)) : ?>
                        <span class="form__error form__error--bottom">Пожалуйста, исправьте следующие ошибки :</span>
                        <ul>
                            <?php foreach ($errors as $key => $value) : ?>
                                <li><strong><?= $key ?>:</strong> <?= $value ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif ?>
                </div>
                <div class="history">
                    <h3>История ставок (<span><?= count($rates) ?></span>)</h3>
                    <table class="history__list">
                        <?php if (count($rates)) : ?>
                            <?php foreach ($rates as $key => $rate) : ?>
                                <tr class="history__item">
                                    <td class="history__name"><?= $rate['name'] ?></td>
                                    <td class="history__price"><?= $rate['cost'] ?></td>
                                    <td class="history__time"><?= $rate['date_create'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php include_once '404.php' ?>
    <?php endif; ?>
</section>