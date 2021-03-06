<?php
$this->title = "Гарантии магазина Game Shop";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Описание гарантий на покупку, быстрой доставки, 
    лицензий и качества продаваемых товаров в магазине Game Shop. Надежно и безопасно!'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'game shop, гарантии на игры, дешевые онлайн игры для pc, 
    купить стим игры, купить steam ключи, магазин компьютерных игр, origin, uplay, battle net'
]);
?>

<div class="garant">
    <div class="garantpost">
        <h2>Аттестат Webmoney</h2>
        <p>Мы прошли аттестацию в платёжной системе Webmoney, предоставив нотариально заверенные
            документы. Это гарантирует, что обладатель персонального сертификата является реальной
            личностью и несет ответственность за деятельность магазина. </p>
    </div>
    <div class="garantpost">
        <h2>Официальные ключи</h2>
        <p>Все цифровые товары приобретены у официальных издателей игр в РФ - это 1С, Бука, Новый
            Диск, Electronic Arts, Funcom и другие. На ключи активации пожизненная гарантия. Налажена
            прямая связь с дилерами для оперативного решения любого вопроса. </p>
    </div>
    <div class="garantpost">
        <h2>Низкие цены</h2>
        <p>Оптовая закупка, нет больших накруток на стоимость товара, отсутствие арендной платы
            за площадь магазина – это залог низких цен. Все новинки и предзаказы можно приобрести
            по доступной цене. </p>
    </div>
    <div class="garantpost">
        <h2>Моментальная доставка</h2>
        <p>После совершения оплаты вы моментально переходите в новую вкладку с оплаченным товаром.
            Также, Вы получаете письмо на почту со всей информацией о совершении оплаты и
            купленном товаре. </p>
        <p>Или вы можете забрать в разделе <a href="<?= Yii::$app->urlManager->createUrl(["site/cart"]); ?>">«Мои
                покупки»</a>.</p>
    </div>
    <div class="garantpost">
        <h2>Большой ассортимент</h2>
        <p>В нашем магазине вы найдете свыше более 3000+ различных игр. Вы можете приобрести
            последние новинки и предзаказы по доступным ценам. </p>
    </div>
    <div class="garantpost">
        <h2>Множество способов оплаты</h2>
        <p>Мы принимаем множество способов оплаты:</p>
        <table>
            <tr>
                <td>WebMoney</td>
                <td>QIWI</td>
                <td>Яндекс.Деньги</td>
            </tr>
            <tr>
                <td>VISA</td>
                <td>MasterCard</td>
                <td>МТС</td>
            </tr>
            <tr>
                <td>Мегафон</td>
                <td>Билайн</td>
                <td>Биткоин</td>
            </tr>
            <tr>
                <td>WM-карта</td>
                <td>Терминал</td>
                <td>Приватбанк</td>
            </tr>
            <tr>
                <td>СБЕРБАНК</td>
                <td>Альфа-Банк</td>
                <td>Paypal</td>
            </tr>
            <tr>
                <td>ВТБ 24</td>
                <td>Промсвязьбанк</td>
                <td>BANK связной</td>
            </tr>
        </table>
        <p>и другие!</p>
    </div>
    <div class="garantpost">
        <h2>Отзывы клиентов</h2>
        <p>Мы имеем множество положительных отзывов, оставленных покупателями
            после оплаты товара. Убедитесь сами. <a href="<?= Yii::$app->urlManager->createUrl(["site/reviews"]); ?>">«Отзывы»</a>
        </p>
    </div>
    <div class="garantpost">
        <h2>Техническая поддержка</h2>
        <p>У нас работает квалифицированная техническая поддержка, которая оперативно ответит
            на ваш запрос. В штате несколько сотрудников, которые постараются помочь вам в
            рабочее время. <a href="<?= Yii::$app->urlManager->createUrl(["site/contact"]); ?>">«Контакты»</a></p>
    </div>
    <div class="garantpost gplast">
        <h2>Скидки</h2>
        <p>Регулярные скидки на игры до 75% и выше! Следите за новостями и будьте в
            курсе событий. Актуальные скидки можно посмотреть на странице <a
                href="<?= Yii::$app->urlManager->createUrl(["site/sale"]); ?>">«Скидки»</a>.</p>
    </div>
    <h2>Приятных покупок!</h2>
</div>