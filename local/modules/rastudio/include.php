<?
global $DBType, $DB, $APPLICATION;

define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']);
define('LOCAL_DIR', ROOT_DIR . '/local');
define('BOBOX_DIR', LOCAL_DIR . '/templates/bobox');
define('RS_MODULE_DIR', LOCAL_DIR . '/modules/rastudio');
define('LOG_MODULE_DIR', LOCAL_DIR );
define('OUT_LIST_PRODUCT_TEMPLATE', BOBOX_DIR."/components/bitrix/catalog.element/bobobCatalogElement/include/listblock/out/index.php" );

require_once (ROOT_DIR . '/bitrix/modules/main/admin_tools.php');
require_once (ROOT_DIR . '/bitrix/modules/main/filter_tools.php');
IncludeModuleLangFile(__DIR__);

CModule::AddAutoloadClasses('rastudio', [
    '\\RaStudio\\Config' => 'lib/Config.php',
    '\\RaStudio\\Api\\Config' => 'lib/api/Config.php',
    '\\RaStudio\\Api\\RestApi' => 'lib/api/RestApi.php',
    '\\RaStudio\\Api\\ShopWorker' => 'lib/api/ShopWorker.php',
    /*General*/
    '\\RaStudio\\Helper' => 'lib/Helper.php',
    '\\RaStudio\\GeoLocation' => 'lib/GeoLocation.php',
    '\\RaStudio\\GeoLocationExternal' => 'lib/GeoLocationExternal.php',
    '\\RaStudio\\Highload' => 'lib/Highload.php',
    '\\RaStudio\\SkuOffer' => 'lib/SkuOffer.php',
    '\\RaStudio\\Catalog' => 'lib/Catalog.php',
    '\\RaStudio\\Directory' => 'lib/Directory.php',
    '\\RaStudio\\File' => 'lib/File.php',
    '\\RaStudio\\FileStatic' => 'lib/FileStatic.php',
    '\\RaStudio\\XmlParser' => 'lib/XmlParser.php',
    '\\RaStudio\\Cart' => 'lib/Cart.php',
    /*General*/

    /*Ajax*/
    '\\RaStudio\\Ajax\\AjaxSlack' => 'lib/ajax/AjaxSlack.php',
    '\\RaStudio\\Ajax\\Response' => 'lib/ajax/Response.php',
    '\\RaStudio\\Ajax\\AjaxFilter' => 'lib/ajax/AjaxFilter.php',
    '\\RaStudio\\Ajax\\AjaxBuild' => 'lib/ajax/AjaxBuild.php',
    '\\RaStudio\\Ajax\\AjaxOrder' => 'lib/ajax/AjaxOrder.php',
    /*Ajax*/

    /*Api*/
    '\\RaStudio\\Api\\LoggerAdapter' => 'lib/api/LoggerAdapter.php',
    '\\RaStudio\\Api\\ParseDiscount' => 'lib/api/ParseDiscount.php',
    '\\RaStudio\\Api\\ApiController' => 'lib/api/ApiController.php',
    /*Api*/

    /*Event*/
    '\\RaStudio\\Event\\IBlockElement' => 'lib/event/IBlockElement.php',
    /*Event*/
    
    /*Table*/
    '\\RaStudio\\Table\\OrderTable' => 'lib/table/OrderTable.php',
    /*Table*/

]);
