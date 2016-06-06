<?php
?>
<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0"
       xmlns="http://backend.userland.com/rss2"
       xmlns:yandex="http://news.yandex.ru">
    <channel>
        <title>Високий Вал</title>
        <link>http://val.ua</link>
        <description>Високий Вал — Інтернет-видання, яке ставить за мету максимально широко та об`єктивно відображати політичне, економічне, культурне життя Чернігівської області і України</description>
        <copyright>Copyright 2009, val.ua</copyright>;

        <?php foreach ($newsFeed as $key => $news): ?>
            <item>
                <title><?= $news->title_uk; ?></title>
                <link><?= Yii::app()->createAbsoluteUrl('/site/news', array('id'=>$news->id)); ?></link>
                <description><?=htmlspecialchars($this->getShortDescription(strip_tags($news->description_uk), 300))."..."; ?></description>
                <category><?= $news->category->name_uk; ?></category>
                <pubDate><?= date("D, d M Y H:i:s +0200", strtotime($news->date)); ?></pubDate>
                <yandex:full-text><?= htmlspecialchars(strip_tags($news->description_uk)); ?></yandex:full-text>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>