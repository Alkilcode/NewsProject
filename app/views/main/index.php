<?php

/**@var array $sidebar  */
/**@var string $role  */        //роли пользователя
/**@var string $news  */
?>

<div class="page">
    <div class="container">
        <div class="page_wrapper">
        <aside class="sidebar">
        <?php if (!empty($sidebar)) : ?>

        <nav>
            <ul>
                <?php foreach ($sidebar as $item) : ?>
                <li>
                    <a href="<?= $item["link"]?>">
                    <?= $item["title"]?>
                    </a>
                </li>

                <?php endforeach; ?>
            </ul>

        </nav>

            <? endif; ?>
        </aside>
               <main>
                   <div class="news_header">
                       <h2>Новости</h2>
                       <a class="btn" href="/news/add">Добавить</a>
                   </div>
               </main>
        </div>
    </div>
</div>