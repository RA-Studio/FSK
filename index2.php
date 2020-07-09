<?
//include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

/*CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");*/

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?
$APPLICATION->SetTitle("Ведутся технические работы...");


?>
<style>
    .header{
        display: none !important;
    }
</style>
    <div class="page-error">
        <div class="container">
            <div class="page-error__inner">
                <div class="page-error__title" style="
    font-size: 50px;
    margin-bottom: 30px;
">Ведутся технические работы...
                </div>
                <div class="page-error__message">
                    <!--<p>Ой, что то пошло не так :( </p>-->
                    <p style="
    font-size: 50px;
">Отдел продаж: <a href="+7 (812) 703-55-55">+7 (812) 703-55-55</a></p>
                </div>

            </div>
        </div>
        <!-- /.container-->
    </div>
<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
