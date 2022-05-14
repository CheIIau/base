<div class="container">
    <section class="lots">
        <h2>История просмотров</h2>
        <ul class="lots__list">
            <?php if ($visitedArr) : ?>
                <?php for ($i = count($visitedArr) - 1; $i >= 0; $i--) :
                    $id = $visitedArr[$i]; ?>
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="<?= $lots[$id]['url']; ?>" width="350" height="260" alt="<?= $lots[$id]['category']; ?>">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category"><?= $lots[$id]['category']; ?></span>
                            <h3 class="lot__title">
                                <a class="text-link" href="lot.php?id=<?= $id ?>"><?= htmlspecialchars($lots[$id]['name']); ?></a>
                            </h3>
                            <div class="lot__state">
                                <div class="lot__rate">
                                    <span class="lot__amount">Стартовая цена</span>
                                    <span class="lot__cost"><?= formatPrice($lots[$id]['cost_start']); ?>
                                        <b class="rub">р</b>
                                    </span>
                                </div>
                                <?php $time_limited = getExpirationTime(); ?>
                                <div class="lot__timer timer">
                                    <?= "$time_limited[0] Часов : $time_limited[1] Мин" ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endfor ?>
            <?php else : ?>
                <h3 class="history--empty">История просмотров пуста</h3>
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