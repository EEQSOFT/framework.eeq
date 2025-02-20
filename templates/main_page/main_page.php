<p class="info">
    <?= PAGE_MAIN_PAGE_INFO ?><br><br>
    <a href="https://github.com/EEQSOFT">EEQSOFT at GitHub.com</a>
</p>

<p><?= PAGE_MAIN_PAGE_FORM ?></p>

<?php if (!is_null($array['error'])) { ?>
    <p class="bad">
        <?= $array['error'] ?>
    </p>
<?php } ?>

<form method="post">
    <?= FORM_MAIN_PAGE_NAME ?> <input type="text" name="name" value="<?= $array['name'] ?>" size="20"><br><br>
    <input type="submit" name="submit" value="<?= FORM_MAIN_PAGE_CONFIRM_BUTTON ?>"> <input type="reset" name="reset" value="<?= FORM_MAIN_PAGE_CLEAR_BUTTON ?>">
    <input type="hidden" name="token" value="<?= $array['token'] ?>"><br><br>
</form>
