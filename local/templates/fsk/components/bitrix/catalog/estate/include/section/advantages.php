<?
            $advantages = [];
            if (CModule::IncludeModule('highloadblock')) {
                $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
            }
            if (CModule::IncludeModule('highloadblock')) {
                $rsData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_FILE','UF_DESCRIPTION', 'UF_NAME', 'UF_XML_ID', 'UF_ALT_FIELD'),
                        'order' => array('ID' => 'ASC'),
                        'filter' => array('UF_XML_ID' => $userProps['UF_ADVANTAGES_GALLERY']['VALUE']),
                        'limit' => '50',
                ));
                while ($arItem = $rsData->Fetch()) {
                    $advantages[] = $arItem;
                }
                foreach ($advantages as $aKey => $aItem) {
                    $hiXMLIDs[] = $advantages[$aKey]['UF_XML_ID'];
                }
                $customerSorted = array_replace(array_flip($userProps['UF_ADVANTAGES_GALLERY']['VALUE']), array_flip($hiXMLIDs));
                $advantages = array_replace(array_flip($customerSorted), $advantages);
            }
            ?>
			<div class="scrollspy-item" id="p-4">
	            <div class="container advantages-new-top" >
	              <h2 class="h1 title advantages-new__title">Преимущества</h2>
	                  <?if(count($advantages)>1){?>
	                      <div class="advantages-new-slider__prev"><svg version="1.1" viewBox="0 0 7 12"><path fill="currentColor" stroke="none" pid="0" d="M.47 1.53A.75.75 0 111.53.47l5 5a.75.75 0 010 1.06l-5 5a.75.75 0 01-1.06-1.06L4.94 6 .47 1.53z" _fill="#fff" fill-rule="nonzero"></path></svg></div>
	                      <div class="advantages-new-slider__next"><svg version="1.1" viewBox="0 0 7 12"><path fill="currentColor" stroke="none" pid="0" d="M.47 1.53A.75.75 0 111.53.47l5 5a.75.75 0 010 1.06l-5 5a.75.75 0 01-1.06-1.06L4.94 6 .47 1.53z" _fill="#fff" fill-rule="nonzero"></path></svg></div>
	                  <?}?>
	            </div>
	            <div class="advantages-new">
	              <div class="advantages-new-slider">
	                <? foreach($advantages as $advantagesItem) {?>
	                    <div class="advantages-new-slide">
	                      <div class="advantages-new-slide-imgbox">
	                        <?$img = \CFile::ResizeImageGet($advantagesItem['UF_FILE'], array('width'=>590, 'height'=>330), BX_RESIZE_IMAGE_EXACT, true)['src']?>
	                        <img class="lazyload" data-lazy="<?=$img;?>" alt="<?echo ($advantagesItem['UF_ALT_FIELD']) ? $advantagesItem['UF_ALT_FIELD'] : 'advantage'?>">
	                      </div>
	                      <div class="advantages-new-slide-content">
	                        <div class="advantages-new-slide-content-description">
	                          <h3 class="advantages-new-slide-content__title"><?=$advantagesItem['UF_NAME'];?></h3>
	                          <p>
	                              <?=$advantagesItem['UF_DESCRIPTION'];?>
	                          </p>
	                        </div>
	                      </div>
	                    </div>
	                    <?}?>
	              </div>
	            </div>
            </div>
            <?
            if (CSite::InDir('/newbuild/zoom_apart/')) {?>
            <div class="container section-margin scrollspy-item" id="p-11">
                <h2 class="h1 title">Типы номеров</h2>
                <div class="types-block tabs">
                	<div class="types-block-nav-wrap">
                		<div class="types-block-nav__active">18.6 м<sup>2</sup></a></div>
	                    <div class="types-block-nav">
	                        <a href="#tab1" class="types-block-nav__item tabs-navigation-item active">18.6 м<sup>2</sup></a>
                            <a href="#tab5" class="types-block-nav__item tabs-navigation-item">18.6 м<sup>2</sup>  (Тип 2)</a>
                            <a href="#tab4" class="types-block-nav__item tabs-navigation-item">24.6 м<sup>2</sup></a>
	                        <a href="#tab2" class="types-block-nav__item tabs-navigation-item">27.2 м<sup>2</sup></a>
                            <a href="#tab6" class="types-block-nav__item tabs-navigation-item">30.7 м<sup>2</sup></a>
	                        <a href="#tab3" class="types-block-nav__item tabs-navigation-item">32.2 м<sup>2</sup></a>
	                    </div>
	                </div>
                    <div class="types-block-tabs">
                        <div class="types-block-tabs-tab tabs-tab active" id="tab1">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/0.png" alt="">
                                    <div class="scheme-tooltip" style="top:110px;left:245px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:330px;left:260px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip" style="top:250px;left:240px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:470px;left:130px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:80px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip right" style="top:50px;left:160px"><span>Вместительный гардероб</span></div>
                                    <div class="scheme-tooltip right" style="top:390px;left:80px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/1/7.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab2">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/0.jpg" alt="">
                                    <div class="scheme-tooltip right" style="top:380px;left:135px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:200px;left:60px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:270px;left:130px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:50px;left:170px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:430px;left:300px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:120px;left:300px"><span>Рабочая зона</span></div>
                                    <div class="scheme-tooltip" style="top:200px;left:300px"><span>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/2/6.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab3">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:420px;left:135px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:110px;left:100px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:250px;left:150px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:40px;left:170px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:380px;left:260px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:150px;left:260px"><span>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/3/8.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab4">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/0.jpg" alt="">
                                    <div class="scheme-tooltip" style="top:350px;left:285px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:50px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip" style="top:130px;left:290px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:40px;left:140px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip right" style="top:450px;left:40px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip" style="top:160px;left:210px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/4/4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab5">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:370px;left:90px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:170px;left:290px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:160px;left:60px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip" style="top:100px;left:280px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:420px;left:300px"><span>Место для уличной одежды</span></div>
                                    <div class="scheme-tooltip right" style="top:150px;left:160px"><span>Рабочее пространство.</br>Smart TV</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/5/8.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="types-block-tabs-tab tabs-tab" id="tab6">
                            <div class="types-block-tabs-tab-nav">
                                <div class="types-block-tabs-tab-nav__item plan">Планировка</div>
                                <div class="types-block-tabs-tab-nav__item gallery active">Интерьеры</div>
                            </div>
                            <div class="types-block-tabs-tab-scheme">
                                <div class="types-block-tabs-tab-scheme-wrap">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/0.png" alt="">
                                    <div class="scheme-tooltip right" style="top:330px;left:95px"><span>Эргономичный санузел</br> с тропическим душем</span></div>
                                    <div class="scheme-tooltip" style="top:130px;left:290px"><span>Спальная зона с</br> индивидуальным светом</span></div>
                                    <div class="scheme-tooltip right" style="top:140px;left:60px"><span>Обеденная зона</span></div>
                                    <div class="scheme-tooltip right" style="top:30px;left:180px"><span>Окна с функцией микропроветривания</br> и шторы "блэк-аут"</span></div>
                                    <div class="scheme-tooltip" style="top:250px;left:260px"><span>Зона отдыха</span></div>
                                    <div class="scheme-tooltip right" style="top:180px;left:160px"><span>Smart TV</span></div>
                                    <div class="scheme-tooltip" style="top:440px;left:260px"><span>Вместительный гардероб</span></div>
                                </div>
                            </div>
                            <div class="types-block-tabs-tab-slider">
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/1.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/2.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/3.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/4.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/5.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/6.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/7.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/8.jpg" alt="">
                                </div>
                                <div class="types-block-tabs-tab-slider-item">
                                    <img src="/local/templates/fsk/img/zoom-apart/6/9.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container section-margin scrollspy-item" id="p-12">
                <h2 class="h1 title">Доходность апартаментов</h2>
                <div class="profit-wrap">
                    <div class="profit-block">
                        <div class="profit-block__title">Программа Zoom Invest</div>
                        <div class="profit-block__text">Программа с высоким потенциальным доходом для инвесторов, ориентированных на максимальную прибыль!</div>
                        <div class="profit-block-row">
                            <span>Доходность</span>
                            <span>до 17% годовых</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Срок окупаемости</span>
                            <span>6 лет</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Максимальный доход в месяц</span>
                            <span>58 000 р.</span>
                        </div>
                        <div class="profit-block-row">
                            <span>Средний доход в год / 3 года</span>
                            <span>453 000 р. / 1 480 000 р.</span>
                        </div>
                        <a class="btn btn--bg profit-block__btn popup-btn-FORM11" href="#modal-FORM11">
                            <svg class="svg btn__ic" style="width: 20px;height: 20px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g transform="translate(-1292 -4412)"><g transform="translate(1292 4412)" fill="none"><path d="M10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0Z" stroke="none"></path><path d="M 10 1.5 C 5.313079833984375 1.5 1.5 5.313079833984375 1.5 10 C 1.5 14.68692016601563 5.313079833984375 18.5 10 18.5 C 14.68692016601563 18.5 18.5 14.68692016601563 18.5 10 C 18.5 5.313079833984375 14.68692016601563 1.5 10 1.5 M 10 0 C 15.52285003662109 0 20 4.477149963378906 20 10 C 20 15.52285003662109 15.52285003662109 20 10 20 C 4.477149963378906 20 0 15.52285003662109 0 10 C 0 4.477149963378906 4.477149963378906 0 10 0 Z" stroke="none" fill="#fff"></path></g><g transform="translate(-0.77 -0.826)"><line y1="7" x2="6.77" transform="translate(1299.5 4419.326)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.5"></line><g transform="translate(1298.77 4418.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"></circle><circle cx="1" cy="1" r="0.5" fill="none"></circle></g><g transform="translate(1304.77 4424.826)" fill="#fff" stroke="#fff" stroke-width="1"><circle cx="1" cy="1" r="1" stroke="none"></circle><circle cx="1" cy="1" r="0.5" fill="none"></circle></g></g></g></svg>
                            Получить расчет
                        </a>
                    </div>
                    
                    <div class="profit-graf">
                        <div class="profit-graf__title">Прогноз роста цены юнита</div>
                        <div class="profit-graf__text">График роста стоимости вашего апартамента за период от начала строительства до сдачи в эксплуатацию. Ваш актив увеличится в стоимости до <b>+40%.</b></div>
                        <div class="profit-graf__img">
                            <svg class="desctop-graf" xmlns="http://www.w3.org/2000/svg" width="509" height="200" viewBox="0 0 509 200" fill="none" preserveAspectRatio="none">
                                <path d="M5 195L150.5 103L333 48L502.5 4.5" stroke="#727272"/>
                                <circle cx="5" cy="195" r="5" fill="#E84001"/>
                                <circle cx="504" cy="5" r="5" fill="#E84001"/>
                                <circle cx="150" cy="103" r="5" fill="#E84001"/>
                                <circle cx="333" cy="48" r="5" fill="#E84001"/>
                            </svg>
                            <svg class="mobile-graf" width="306" height="190" viewBox="0 0 306 190" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                                <path d="M4.84375 183.971L91.213 97.4632L199.545 45.7468L300.161 4.84375" stroke="#727272"/>
                                <circle cx="91.1758" cy="98.9219" r="5" fill="#E84001"/>
                                <circle cx="300.32" cy="5" r="5" fill="#E84001"/>
                                <circle cx="195.746" cy="47.6016" r="5" fill="#E84001"/>
                                <circle cx="5" cy="184.129" r="5" fill="#E84001"/>
                            </svg>
                            <div class="profit-graf__img-text">Расчет на основе стоимости юнита 2&nbsp;340&nbsp;000&nbsp;руб. </br>Не является офертой.</div>
                            <div class="graf-value graf-value-1">2 340 000</div>
                            <div class="graf-value graf-value-2">3 042 000</div>
                            <div class="graf-value graf-value-3">3 159 000</div>
                            <div class="graf-value graf-value-4">3 276 000</div>
                            <div class="graf-percent graf-percent-1">+40%</div>
                            <div class="graf-percent graf-percent-2">+35%</div>
                            <div class="graf-percent graf-percent-3">+30%</div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container section-margin scrollspy-item" id="p-13">
                <h2 class="h1 title">Сравнение доходности</h2>
                <div class="compare-block">
                    <div class="compare-block-wrap">
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Тип инвестиций</div>
                            <div class="compare-block-row-col compare-block-row-4-col">Доходность</div>
                            <div class="compare-block-row-col compare-block-row-4-col">Безоп-ть вложений</div>
                            <!--<div class="compare-block-row-col">Стабильность</div>-->
                            <!--<div class="compare-block-row-col">Доступность</div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">Силы и время</div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Квартира</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3114" data-name="Group 3114" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#b70000"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>4-6%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Средняя</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3111" data-name="Group 3111" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#b70000"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Много</span>
                            </div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Депозит в банке</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3112" data-name="Group 3112" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#fbda07"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>5-7%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Низкая</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3109" data-name="Group 3109" transform="translate(-1410 -4805)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Мало</span>
                            </div>
                        </div>
                        <div class="compare-block-row">
                            <div class="compare-block-row-col compare-block-row-4-col">Апартаменты</div>
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3113" data-name="Group 3113" transform="translate(1425 4820) rotate(180)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>до 17%</span>
                            </div>
                            <div class="compare-block-row-col compare-block-row-4-col">Высокая</div>
                            <!--<div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>
                            <div class="compare-block-row-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.174" height="19.174" viewBox="0 0 16.174 19.174">
                                  <g id="Group_3083" data-name="Group 3083" transform="translate(-1043 -3717.826)">
                                    <g id="Ellipse_60" data-name="Ellipse 60" transform="translate(1043 3722)" fill="#fff" stroke="#e94200" stroke-width="1">
                                      <circle cx="7.5" cy="7.5" r="7.5" stroke="none"/>
                                      <circle cx="7.5" cy="7.5" r="7" fill="none"/>
                                    </g>
                                    <g id="Group_3077" data-name="Group 3077" transform="translate(0 1)">
                                      <line id="Line_352" data-name="Line 352" x2="4" y2="7" transform="translate(1046.5 3725.91)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                      <line id="Line_353" data-name="Line 353" x1="8" y2="15.41" transform="translate(1050.5 3717.5)" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"/>
                                    </g>
                                  </g>
                                </svg>
                            </div>-->
                            <div class="compare-block-row-col compare-block-row-4-col">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                  <g id="Group_3109" data-name="Group 3109" transform="translate(-1410 -4805)">
                                    <circle id="Ellipse_62" data-name="Ellipse 62" cx="7.5" cy="7.5" r="7.5" transform="translate(1410 4805)" fill="#87b700"/>
                                    <g id="Group_3108" data-name="Group 3108" transform="translate(0.021 0.035)">
                                      <line id="Line_359" data-name="Line 359" y2="6.986" transform="translate(1417.479 4808.034)" fill="none" stroke="#fff" stroke-width="2"/>
                                      <path id="Polygon_2" data-name="Polygon 2" d="M2.5,0,5,5H0Z" transform="translate(1419.979 4817.965) rotate(180)" fill="#fff"/>
                                    </g>
                                  </g>
                                </svg>
                                <span>Мало</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?}?>