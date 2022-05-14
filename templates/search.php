<div class="container">
    <section class="lots">
        <h2>Результаты поиска по запросу «<span><?= $search ?></span>»</h2>
        <ul class="lots__list">
            <?php foreach ($lots as $key => $value) : ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?= $value['url']; ?>" width="350" height="260" alt="<?= $value['category']; ?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?= $value['category']; ?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $value['id'] ?>"><?= $value['name']; ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?= $value['cost_start']; ?><b class="rub">р</b></span>
                            </div>
                            <?php $time_limited = getExpirationTime($value['date_finished']); ?>
                            <div class="lot__timer timer">
                                <?= "$time_limited[0] Дней $time_limited[1] Часов : $time_limited[2] Мин" ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php if (!count($lots)) : ?>
                <h3>По вашему запросу ничего не найдено :(</h3>
            <?php endif; ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
</div>