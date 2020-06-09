<?php

namespace RaStudio;

use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;

class Catalog {

    public static function pushViewedProduct($ID) {
        CatalogViewedProductTable::refresh($ID, \CSaleBasket::GetBasketUserID());
    }

    public static function getViewedProductID($count = 4, $select = false ) {
        
        if( $select === false || !is_array($select) ) $select = array('PRODUCT_ID', 'ELEMENT_ID');
        
        $basketUserId = (int)\CSaleBasket::GetBasketUserID(false);
        if ($basketUserId > 0) {

            $viewedIterator = CatalogViewedProductTable::getList(array(
                'select' => $select,
                'filter' => array('=FUSER_ID' => $basketUserId, '=SITE_ID' => SITE_ID),
                'order' => array('DATE_VISIT' => 'DESC'),
                'limit' => $count
            ));

            while ( $arFields = $viewedIterator->fetch() ) {
                $arViewed[] = $arFields;
            }
            
        }
        return $arViewed;
    }

}