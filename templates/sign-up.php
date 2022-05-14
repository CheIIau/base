<form class="form container" action="/sign-up.php" method="post">
    <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <?php $classname = isset($errors['email']) ? 'form__item--invalid' : '';
    $value = isset($form['email']) ? $form['email'] : '' ?>
    <div class="form__item <?= $classname ?>">
        <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" value="<?= $value ?>" placeholder="Введите e-mail">
        <?php if (isset($errors['Email'])) : ?>
            <span class="form__error">Введите e-mail</span>
        <?php endif; ?>
    </div>
    <div class="form__item">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль">
        <?php if (isset($errors['Пароль'])) : ?>
            <span class="form__error">Введите пароль</span>
        <?php endif; ?>
    </div>
    <?php $classname = isset($errors['Имя']) ? 'form__item--invalid' : '';
    $value = isset($form['name']) ? $form['name'] : '' ?>
    <div class="form__item <?= $classname ?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" value="<?= $value ?>" placeholder="Введите имя">
        <?php if (isset($errors['Имя'])) : ?>
            <span class="form__error">Введите имя</span>
        <?php endif; ?>

    </div>
    <?php $classname = isset($errors['Контактные данные']) ? 'form__item--invalid' : '';
    $value = isset($form['message']) ? $form['message'] : '' ?>
    <div class="form__item <?= $classname ?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= $value ?></textarea>
        <?php if (isset($errors['Контактные данные'])) : ?>
            <span class="form__error">Введите контактные данные</span>
        <?php endif; ?>
    </div>
    <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" value="" name='avatar'>
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
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
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>