<form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php $classname = isset($errors['Наименование']) ? 'form__item--invalid' : '';
        $value = isset($lot['name']) ? $lot['name'] : '' ?>
        <div class="form__item <?= $classname ?>">
            <label for="name">Наименование</label>
            <input id="name" type="text" name="name" value="<?= $value ?>" placeholder="Введите наименование лота">
            <?php if (isset($errors['Наименование'])) : ?>
                <span class="form__error">Введите наименование лота</span>
            <?php endif; ?>
        </div>
        <?php $classname = isset($errors['Категория']) ? 'form__item--invalid_select' : '';
        $value = isset($lot['category']) ? $lot['category'] : '' ?>
        <div class="form__item ">
            <label for="category">Категория</label>
            <select class="<?= $classname ?>" id="category" name="category">
                <option>Выберите категорию</option>
                <?php foreach ($categories as $key => $value) : ?>
                    <option><?= $value['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['Категория'])) : ?>
                <span class="form__error">Выберите категорию</span>
            <?php endif; ?>
        </div>
    </div>
    <?php $classname = isset($errors['Описание']) ? 'form__item--invalid' : '';
    $value = isset($lot['detail']) ? $lot['detail'] : '' ?>
    <div class="form__item form__item--wide <?= $classname ?>">
        <label for="detail">Описание</label>
        <textarea id="detail" name="detail" placeholder="Напишите описание лота"><?= $value ?></textarea>
        <?php if (isset($errors['Описание'])) : ?>
            <span class="form__error">Напишите описание лота</span>
        <?php endif; ?>
    </div>
    <div class="form__item form__item--file">
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" name='url' id="photo2">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>

    <div class="form__container-three ">
        <?php $classname = isset($errors['Начальная цена']) ? 'form__item--invalid' : '';
        $value = isset($lot['cost_start']) ? $lot['cost_start'] : '' ?>
        <div class="form__item form__item--small <?= $classname ?>">
            <label for="cost_start">Начальная цена</label>
            <input id="cost_start" type="number" name="cost_start" value="<?= $value ?>" placeholder="0">
            <?php if (isset($errors['Начальная цена'])) : ?>
                <span class="form__error">Введите начальную цену</span>
            <?php endif; ?>
        </div>
        <?php $classname = isset($errors['Шаг ставки']) ? 'form__item--invalid' : '';
        $value = isset($lot['cost_step']) ? $lot['cost_step'] : '' ?>
        <div class="form__item form__item--small <?= $classname ?>">
            <label for="cost_step">Шаг ставки</label>
            <input id="cost_step" type="number" name="cost_step" value="<?= $value ?>" placeholder="0">
            <?php if (isset($errors['Начальная цена'])) : ?>
                <span class="form__error">Шаг ставки</span>
            <?php endif; ?>
        </div>
        <?php $classname = isset($errors['Дата окончания торгов']) ? 'form__item--invalid' : '';
        $value = isset($lot['date_finished']) ? $lot['date_finished'] : '' ?>
        <div class="form__item  <?= $classname ?>">
            <label for="date_finished">Дата окончания торгов</label>
            <input class="form__input-date" id="date_finished" type="date" name="date_finished" value="<?= $value ?>">
            <?php if (isset($errors['Дата окончания торгов'])) : ?>
                <span class="form__error">Введите дату завершения торгов</span>
            <?php endif; ?>
        </div>
    </div>
    <?php if (isset($errors)) : ?>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте следующие ошибки в форме :</span>
        <ul>
            <?php foreach ($errors as $key => $value) : ?>
                <li><strong><?= $key ?>:</strong> <?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <button type="submit" class="button">Добавить лот</button>
</form>