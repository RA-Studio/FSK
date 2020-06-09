<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="page desktop-padding">
    <div class="container">
        <pre style="display: none"><?=$arResult["DETAIL_PICTURE"]["SRC"]?></pre>
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
        <div class="p-hero" style="background-image: url('<?=$arResult["DETAIL_PICTURE"]["SRC"]?>')">
            <div class="p-hero__inner">
                <div class="p-hero__top">31 января 2020</div>
                <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
                    <h1 class="h2 p-hero__title"><?=$arResult["NAME"]?></h1>
                <?endif;?>
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main_breadcrumbs", Array(
                        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                ),
                        false
                );?>
                <!--<div class="breadcrumbs" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        <a rel="nofollow" itemprop="item" title="Главная" href="/"><span itemprop="name">Главная</span>
                        <meta itemprop="position" content="1"></a>
                    </span>
                    <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        <a rel="nofollow" itemprop="item" title="Новости" href="news.html">
                            <span itemprop="name">Новости</span>
                        <meta itemprop="position" content="2">
                        </a>
                    </span>
                    <span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
                        <a rel="nofollow" itemprop="item" title="Страница новости" href="#">
                            <span itemprop="name">Новость про время работы.</span>
                        <meta itemprop="position" content="3">
                        </a>
                    </span>
                </div>-->
                <div class="p-hero__bottom">16 августа 2019</div>
            </div>
        </div>
        <?endif?>
        <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
            <span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
        <?endif;?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
            <p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
        <?endif;?>
        <?if($arResult["NAV_RESULT"]):?>
            <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
            <?echo $arResult["NAV_TEXT"];?>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
        <?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
            <div class="content">
                <?echo $arResult["DETAIL_TEXT"];?>
            </div>
        <?endif?>
        <!-- Другие новости -->
        <?php
        CModule::IncludeModule('iblock');
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE", "ACTIVE_FROM", "SHOW_COUNTER");
        $arFilter = Array("IBLOCK_ID"=>3, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "!ID"=>$arResult["ID"]);
        $res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>2), $arSelect);
        ?>

        <?php if($res->arResult): ?>
            <div class="section-margin">
                <h2 class="h1 title title-margin">Другие новости</h2>
                <div class="p-list">
                    <div class="f-row">
                        <?php while($ob = $res->GetNextElement()): $arFields = $ob->GetFields(); ?>
                            <div class="cols col-1-2">
                                <div class="p-item">

                                    <div class="p-item__img">
                                        <a href="<?=$arFields['DETAIL_PAGE_URL'];?>">
                                            <img src="<?=$arFields["PREVIEW_PICTURE"] ? CFile::GetPath($arFields["PREVIEW_PICTURE"]) : CFile::GetPath($arFields["DETAIL_PICTURE"]);?>" alt="">
                                        </a>
                                    </div>
                                    <div class="p-item__content">
                                        <span class="p-item__date"><?=$arFields['ACTIVE_FROM'];?></span>
                                        <div class="p-item__title">
                                            <a href="<?=$arFields['DETAIL_PAGE_URL'];?>"><?=$arFields['NAME'];?></a>
                                        </div>
                                        <a class="btn btn--transp" href="<?=$arFields['DETAIL_PAGE_URL'];?>">
                                            <img class="svg btn__ic ic-read" src="<?=SITE_TEMPLATE_PATH?>/img/icons/ic-read.svg" alt="link" width="15" height="19">
                                            Подробнее
                                        </a>
                                    </div>

                                    <!--<div class="stati-page-recommend-items-item__img">
                                        <img src="<?/*=$arFields["PREVIEW_PICTURE"] ? CFile::GetPath($arFields["PREVIEW_PICTURE"]) : CFile::GetPath($arFields["DETAIL_PICTURE"]);*/?>" alt="">
                                    </div>
                                    <div class="stati-page-recommend-items-item-info">
                                        <div class="stati-page-recommend-items-item-info-values">
                                            <div class="stati-page-recommend-items-item-info-values__date">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M10 18.3334C5.39752 18.3334 1.66669 14.6025 1.66669 10C1.66669 5.39752 5.39752 1.66669 10 1.66669C14.6025 1.66669 18.3334 5.39752 18.3334 10C18.3334 14.6025 14.6025 18.3334 10 18.3334ZM10 16.6667C11.7681 16.6667 13.4638 15.9643 14.7141 14.7141C15.9643 13.4638 16.6667 11.7681 16.6667 10C16.6667 8.23191 15.9643 6.53622 14.7141 5.28598C13.4638 4.03573 11.7681 3.33335 10 3.33335C8.23191 3.33335 6.53622 4.03573 5.28598 5.28598C4.03573 6.53622 3.33335 8.23191 3.33335 10C3.33335 11.7681 4.03573 13.4638 5.28598 14.7141C6.53622 15.9643 8.23191 16.6667 10 16.6667ZM10.8334 10H14.1667V11.6667H9.16669V5.83335H10.8334V10Z" fill="#333333"></path>
                                                </svg>
                                                <span><?/*=$arFields['ACTIVE_FROM'];*/?></span>
                                            </div>
                                            <div class="stati-page-recommend-items-item-info-values__view">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M10 2.5C14.4934 2.5 18.2317 5.73333 19.0159 10C18.2325 14.2667 14.4934 17.5 10 17.5C5.50669 17.5 1.76836 14.2667 0.984192 10C1.76753 5.73333 5.50669 2.5 10 2.5ZM10 15.8333C11.6996 15.833 13.3487 15.2557 14.6774 14.196C16.0061 13.1363 16.9358 11.6569 17.3142 10C16.9344 8.34442 16.0041 6.86667 14.6755 5.80835C13.347 4.75004 11.6986 4.17377 10 4.17377C8.30144 4.17377 6.6531 4.75004 5.32451 5.80835C3.99591 6.86667 3.06566 8.34442 2.68586 10C3.06427 11.6569 3.99392 13.1363 5.32265 14.196C6.65137 15.2557 8.30047 15.833 10 15.8333ZM10 13.75C9.00546 13.75 8.05164 13.3549 7.34838 12.6516C6.64511 11.9484 6.25003 10.9946 6.25003 10C6.25003 9.00544 6.64511 8.05161 7.34838 7.34835C8.05164 6.64509 9.00546 6.25 10 6.25C10.9946 6.25 11.9484 6.64509 12.6517 7.34835C13.3549 8.05161 13.75 9.00544 13.75 10C13.75 10.9946 13.3549 11.9484 12.6517 12.6516C11.9484 13.3549 10.9946 13.75 10 13.75ZM10 12.0833C10.5526 12.0833 11.0825 11.8638 11.4732 11.4731C11.8639 11.0824 12.0834 10.5525 12.0834 10C12.0834 9.44747 11.8639 8.91756 11.4732 8.52686C11.0825 8.13616 10.5526 7.91667 10 7.91667C9.44749 7.91667 8.91759 8.13616 8.52689 8.52686C8.13619 8.91756 7.91669 9.44747 7.91669 10C7.91669 10.5525 8.13619 11.0824 8.52689 11.4731C8.91759 11.8638 9.44749 12.0833 10 12.0833Z" fill="#333333"></path>
                                                </svg>
                                                <span><?/*=$arFields['SHOW_COUNTER'];*/?></span>
                                            </div>
                                        </div>
                                        <div class="stati-page-recommend-items-item-info__title"><?/*=$arFields['NAME'];*/?></div>
                                        <div class="stati-page-recommend-items-item-info__text"><?/*=$arFields['PREVIEW_TEXT'];*/?></div>
                                        <div class="stati-page-recommend-items-item-info__btn">Подробнее</div>
                                    </div>-->

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!--<div class="section-margin">
            <h2 class="h1 title title-margin">Другие новости</h2>
            <div class="p-list">
                <div class="f-row">
                    <div class="cols col-1-2">
                        <div class="p-item">
                            <div class="p-item__img"><a href="#"><img class="img" src="img/img-thumb-1.jpg" alt="news1"></a></div>
                            <div class="p-item__content"><span class="p-item__date">31 января 2020</span>
                                <div class="p-item__title"><a href="news-page.html">Длинный заголовок какой-то новости или акции, которая длится очень долго и...</a></div><a class="btn btn--transp" href="news-page.html"><img class="svg btn__ic ic-read" src="img/icons/ic-read.svg" alt="link" width="15" height="19">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <?foreach($arResult["FIELDS"] as $code=>$value):
            if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
            {
                ?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
                if (!empty($value) && is_array($value))
                {
                    ?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
                }
            }
            else
            {
                ?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
            }
            ?><br />
        <?endforeach;
        foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

            <?=$arProperty["NAME"]?>:&nbsp;
            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
            <?else:?>
                <?=$arProperty["DISPLAY_VALUE"];?>
            <?endif?>
            <br />
        <?endforeach;
        if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
        {
            ?>
            <div class="news-detail-share">
                <noindex>
                <?
                $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                        "HANDLERS" => $arParams["SHARE_HANDLERS"],
                        "PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
                        "PAGE_TITLE" => $arResult["~NAME"],
                        "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                        "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                        "HIDE" => $arParams["SHARE_HIDE"],
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
                </noindex>
            </div>
            <?
        }
        ?>
    </div>