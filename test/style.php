<?
if (isset($_GET['template'])) {
    if ($_GET['template']) define('SITE_TEMPLATE_ID',$_GET['template']);
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle('Тестовая страница');
}
?>

<h1 title="h1">Страница теста основных элементов верстки</h1>
<section>
    <h2 title="section h2">О странице</h2>
    <p title="section p">
        Эта тестовая страница, содержащая основной набор базовых элементов html, предназначенная для проверки
        влияния верстки на них. Данный блок тестируюет верстку типовых для статьи элементов - заголовков h1-h5, абзацев,
        цитат, списков. Например этот текст написан одним абзацем. Его заголовок "О странице" заключен в h2,
        сам блок помещен в тег section, а заголовок самой старницы вынесен над элементом section в h1. Все заголовки представлены в <a href="#head">блоке заголовков</a> ниже.  Для удобаства section заголовков имеет в начале и конце теги hr, для отделения от соседних блоков. Элементы формы
        рассматриваются в <a href="#form">блоке форм</a>.
    </p>
    <h3 title="section h3">Список тегов блока</h3>
    <ul>
        <li>
            <b title="section ul li b">h*</b> - теги заголовков представляющих уровни вложенности.
        </li>
        <li>
            <b title="section ul li b">p</b> - определяет параграф или текстовый абзац.
        </li>
        <li>
            <b title="section ul li b">ul</b> - неупорядоченный список.
        </li>
        <li>
            <b title="section ul li b">li</b> - элемент списка.
        </li>
        <li>
            <b title="section ul li b">а</b> - ссылка.
        </li>
    </ul>
</section>
<section>
    <a name="head"></a>
    <hr>
    <h1 title="section h1">Заголовок</h1>
    <h2 title="section h2">Подзаголовок</h2>
    <h3 title="section h3">Подзаголовок уровня 3</h3>
    <h4 title="section h4">Подзаголовок уровня 4</h4>
    <h5 title="section h5">Подзаголовок уровня 5</h4>
    <hr>
</section>
<section>
    <a name="form"></a>
    <h2 title="section h2">Блок с формой</h2>
    <form>
        
        <h3 title="section form h3">Элементы без label</h3>
        <input type="text" title='section form input[type="text"]' placeholder="input с placeholder, но без значения">
        <input type="text" title='section form input[type="text"]' value="input с placeholder, и значением" placeholder="input с placeholder, и значением">
        <input type="tel" title='section form input[type="tel"]' placeholder="+7 (987) 654-32-10">
        <input type="tel" title='section form input[type="tel"]' value="+79876543210" placeholder="+7 (987) 654-32-10">
        <select title='section form select'>
            <option>Вариант 1</option>
            <option>Вариант 2</option>
            <option>Вариант 3</option>
        </select>
        <input type="submit" title='section form input[type="submit"]' value="Submit">
        <button type="submit" title='section form button' value="Submit">Submit кнопкой</button>
        
        
        <h3 title="section form h3">Элементы внутри label</h3>
        <label>Input<input type="text" title='section form label input[type="text"]' placeholder="input с placeholder, но без значения"></label>
        <label>
            Radio1 1
            <input type="radio" name="radio1" value="1">
        </label>
        <label>
            Radio1 2
            <input type="radio" name="radio1" value="2">
        </label>
        <label>
            Checkbox
            <input type="checkbox">
        </label>
        
        <h3 title="section form h3">Элементы со связанными label</h3>
        <h4 title="section form h4">label перед элементом</h4>
        
        <label for="input1">Input</label>
        <input id="input1" type="text" title='section form label input[type="text"]' placeholder="input с placeholder, но без значения">
        
        <label for="radio21">Radio2 1</label>
        <input id="radio21" type="radio" name="radio2" value="1">
        
        <label for="radio22">Radio2 2</label>
        <input id="radio22" type="radio" name="radio2" value="2">
        
        <label for="checkbox1">Checkbox</label>
        <input id="checkbox1" type="checkbox">
        
        <h4 title="section form h4">label после элементоа</h4>
        
        
        <input id="input2" type="text" title='section form label input[type="text"]' placeholder="input с placeholder, но без значения"><label for="input2">Input</label>
        
        
        <input id="radio31" type="radio" name="radio2" value="1"><label for="radio31">Radio3 1</label>
        
        
        <input id="radio32" type="radio" name="radio2" value="2"><label for="radio32">Radio3 2</label>
        
        
        <input id="checkbox2" type="checkbox"><label for="checkbox2">Checkbox</label>
        
    </form>
</section>

<?
if (isset($_GET['template'])) {
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
}
?>