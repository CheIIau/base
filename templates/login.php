<form class="form container" action="/login.php" method="post">
    <!-- form--invalid -->
    <h2>Вход</h2>
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
    <div class="form__item form__item--last">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль">
        <?php if (isset($errors['Пароль'])) : ?>
            <span class="form__error">Введите пароль</span>
        <?php endif; ?>
    </div>
    <?php if (isset($errors)) : ?>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте следующие ошибки в форме :</span>
        <ul>
            <?php foreach ($errors as $key => $value) : ?>
                <li><strong><?= $key ?>:</strong> <?= $value ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <button type="submit" class="button">Войти</button>
</form>