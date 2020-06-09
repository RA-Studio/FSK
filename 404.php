<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

/**/$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);
?>
    <div class="page-error">
        <div class="container">
            <div class="page-error__inner">
                <div class="page-error__title">404</div>
                <div class="page-error__message">
                    <!--<p>Ой, что то пошло не так :( </p>-->
                    <p>Страница не найдена, но у нас есть много других интересных страниц!</p>
                </div>
                <div class="page-error__btns">
                    <a class="btn btn--transp" href="/"> <img class="svg btn__ic ic-home" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-home.svg" alt="home" width="20" height="20">Вернуться на главную</a>
                    <a class="btn btn--bg" href="/newbuild/"> <img class="svg btn__ic ic-arrow" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-arrow.svg" alt="link" width="20" height="20">Наши объекты</a>
                </div>
            </div>
        </div>
        <!-- /.container-->
    </div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>