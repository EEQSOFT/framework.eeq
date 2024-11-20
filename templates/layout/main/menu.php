<ul>
    <li<?php if ($array['active_menu'] === 'main_page') { echo ' class="active"'; } ?>><a href="<?= $array['url'] ?>/"><?= MENU_MAIN_PAGE ?></a></li>
    <li><a href="<?= $array['main_url'] ?>/"><?= LANGUAGE_NAME[1] ?></a> | <a href="<?= $array['main_url'] ?>/pl/"><?= LANGUAGE_NAME[2] ?></a></li>
</ul>
