            <div class="project-geo section-margin scrollspy-item" id="p-3">
                <div class="container">
                    <h2 class="h1 title">Расположение и инфраструктура</h2>
                </div>
                <div class="map" id="map"></div>
                <script>
                    var initYandexMapJK = setInterval(() => {
                        try {
                            <?echo $userProps['UF_MAP_CODE']['~VALUE']['TEXT']?>
                            clearInterval(initYandexMapJK);
                        } catch(e) {
                            
                        }
                    }, 3000);
                </script>
                <? if ($userProps['UF_MAP_LABELS']['VALUE']) : ?>
                    <?
                    $mapLabels = [];
                    if (CModule::IncludeModule('highloadblock')) {
                        $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(9)->fetch();
                        $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                        $strEntityDataClass = $obEntity->getDataClass();
                    }
                    if (CModule::IncludeModule('highloadblock')) {
                        $rsData = $strEntityDataClass::getList(array(
                                'select' => array('ID','UF_DESCRIPTION', 'UF_NAME', 'UF_FULL_DESCRIPTION', 'UF_XML_ID', 'UF_FILE'),
                                'order' => array('ID' => 'ASC'),
                                'filter' => array('UF_XML_ID' => $userProps['UF_MAP_LABELS']['VALUE']),
                                'limit' => '50',
                        ));
                        while ($arItem = $rsData->Fetch()) {
                            $mapLabels[] = $arItem;
                        }
                    }
                    ?>			
					<div class="container">
						<div class="geo-labels">
							<div class="f-row">
							<?foreach($mapLabels as $index => $label) : ?>
								<?if ($index === 0) :?>
									<div class="cols col-1-3">
								<?endif; ?>
									<div class="geo-label">											
										<?$lbSVG = CFile::GetPath($label['UF_FILE']);?>
										<?if($lbSVG):?>
											<img src="<?=$lbSVG?>" />
										<?else:?>
											<span class="geo-label__ic" style="background: <?=$label['UF_DESCRIPTION']?>"> </span>
										<?endif;?>
										<?=$label['UF_NAME']?>
									</div>
								<?if (($index+1) % 4 === 0) :?>
									</div>
								<?endif;?>
								<?if (($index+1) % 4 === 0) :?>
									<div class="cols col-1-3">
								<? endif; ?>
							<?endforeach;?>
									</div>
						</div>
						</div>
					</div>		
                <? endif; ?>
            </div>