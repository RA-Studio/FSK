<?php
namespace RaStudio\Ajax;

use \Bitrix\Main\Application;
use \RaStudio\Helper;
use \RaStudio\Table\OrderTable;
use \Bitrix\Main\Mail\Event as Event;

\CModule::IncludeModule("iblock");
\CModule::IncludeModule("main");

class AjaxOrder {
    public static function actionCreatedOrder() {
        $response = new Response();
        $appContext = Application::getInstance()->getContext();
        $request = $appContext->getRequest();
        $postList = $request->getPostList()->toArray();
        global $USER;

        if($postList['json']) {
            $postList = json_decode($postList['json'], true);
        }

        $userId = '';
        if ($USER->IsAuthorized()) $userId = $USER->GetID();

        $error = false;

        if(!$postList['first_name']) $error = "first_name";
        if(!$postList['last_name']) $error = "last_name";
        if(empty($postList['product']))  $error = "empty";
        if(empty($postList['email']))  $error = "email";
        if(empty($postList['tel']))  $error = "tel";

        
        if($error != false) {
            return $response->shapeError([], $error);
        }


        $arSelect = array (
			"ID",
			"IBLOCK_ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PREVIEW_PICTURE",
            "PROPERTY_GALLEREYA",
            'PROPERTY_PRICE',
        );

        $arFilter = Array("IBLOCK_ID"=>$postList['iblock'], "ACTIVE"=>"Y", "ID" => $postList['product']);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        $arElement = [];
        $basketPrice = $postList['price'];
        $basket = [];
        while($ob = $res->GetNextElement()){
            $arElement = $ob->GetFields();
            $arElement['PROPERTIES'] = $ob->GetProperties();

        }



        if($basketPrice < 1) return $response->shapeError([], 'nonexistent');//94

        $email = $postList['email'];
        $field = [
            'user' => $userId,
            'email' => $email,
            'first_name' => $postList['first_name'],
            'last_name' => $postList['last_name'],
            'product'=> $postList['product'],
            'basket' => $postList['basket']?$postList['basket']:$postList['product'],
            'price' => $basketPrice,
            'phone' => Helper::parsePhone($postList['tel']),
            'comment' => str_replace('\n', '</br>', $postList['comment']),
        ];

        $result = OrderTable::save($field);
        $order = $result['result'];
        $hash = $result[OrderTable::COL_HASH];

        if (!$order->isSuccess()) {
            return $response->shapeError([], $order->getErrorMessages());
        }
        $orderId = $order->getId();

        $CURRENT_PAGE = (\CMain::IsHTTPS()) ? "https://" : "http://";
        $CURRENT_PAGE .= $_SERVER["HTTP_HOST"];

        $mess = "
            <p>".$postList['first_name']." ".$postList['last_name'].", Вы успешно забронировали квартиру!</p>
            <p>Наш менеджер свяжется с Вами в ближайшее время.</p>
        ";
        if ($USER->IsAuthorized()) $mess .= " или в <a href='$CURRENT_PAGE/lk/order/'>личном кабинете";

        $arEventFields = array(
            "MESSAGE" => $mess,
            "EMAIL" => $postList['email'],
            "EVENT_NAME" => "Вы успешно забронировали квартиру!",
            "NAME" => $postList['first_name'],
            "LAST_NAME"=>$postList['last_name'],
            "PHONE"=>$postList['tel'],
            "PRICE"=>$postList['price'],
            "ARTICLE"=>$arElement['CODE'],
            "ORDER_ID"=>$orderId,
            "BASKET"=>json_encode($arElement),
        );
        /*Event::send(array(
            "EVENT_NAME" => "EVENT_SEND_MESSAGE",
            "LID" => "s1",
            "C_FIELDS" => $arEventFields,
        ));*/
        $_SESSION['RESERVE_SENT'] = '';
        $_SESSION['RESERVE_SEND_TIME']=time();

/*
        $textDone = '
            <svg style="width: 80px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <circle style="fill:#25AE88;" cx="25" cy="25" r="25"/>
                <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points=" 38,15 22,33 12,25 "/>
            </svg></br><br>
        '
        ."Ваш заказ № $orderId успешно оформлен!<br>Данные по заказу высланы вам на почту: $email"
        ."<br>Отследить заказ вы можете по <a href='/lk/order/detail/?order=$hash'>ссылке</a>";
        if ($USER->IsAuthorized()) $textDone .= " или в <a href='/lk/order/'>личном кабинете";
*/
        return $response->shapeOk(['ORDER_ID'=>$orderId], 'ok');
        //return $response->shapeError(['user' => 'no'], 'пользователь не авторизирован');
    }
}
?>