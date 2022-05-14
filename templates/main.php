<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $key => $value) : ?>
            <li class="promo__item promo__item--<?= $value['symbol_code']; ?>">
                <a class="promo__link" href="lots.php?category=<?echo $key+1; ?>">
                <?= $value['name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($lots as $key => $value) : ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $value['url']; ?>" width="350" height="260" alt="<?= $value['category']; ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $value['category']; ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="lot.php?id=<?= $value['id'] ?>"><?= htmlspecialchars($value['name']); ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= formatPrice($value['cost_start']); ?>
                                <b class="rub">р</b>
                            </span>
                        </div>
                        <?php $time_limited = getExpirationTime($value['date_finished']); ?>
                        <div class="lot__timer timer">
                            <?= "$time_limited[0] Дней $time_limited[1] Часов : $time_limited[2] Мин" ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<?php if ($pages_count > 1) : ?>
    <ul class="pagination-list">
        <?php if ($cur_page > 1) : ?>
            <li class="pagination-item pagination-item-prev"><a href="/?page=
            <?= $cur_page - 1 ?>">Назад</a></li>
        <?php else : ?>
            <li class="pagination-item pagination-item-prev">Начало</li>
        <?php endif; ?>
        <?php foreach ($pages as $page) : ?>
            <li class="pagination-item 
            <?php if ($page == $cur_page) : ?>
                pagination-item-active
            <?php endif; ?>>">
                <a href="/?page=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endforeach; ?>
        <?php if ($cur_page < $pages_count) : ?>
            <li class="pagination-item pagination-item-next"><a href="/?page=
            <?php if ($cur_page == 0) {
                $cur_page = 1;
            } ?><?= $cur_page + 1 ?>">Вперед</a></li>
        <?php else : ?>
            <li class="pagination-item pagination-item-next">Конец</li>
        <?php endif; ?>
    </ul>
<?php endif; ?>