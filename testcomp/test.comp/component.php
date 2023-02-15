<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
echo '<pre>';
print_r($arParams);
echo '</pre>';
*/
$arResult['TEMPLATE_TITLE_PAGE'] = $arParams["TEMPLATE_TITLE_PAGE"];

if (\Bitrix\Main\Loader::includeModule('crm')) 
{
  	$arFilter = array(
		"%STAGE_ID"=> 'C'.$arParams["TEMPLATE_DEAL_CATEGORY"], //выбираем направление сделки 
		"CHECK_PERMISSIONS"=>"N" //не проверять права доступа текущего пользователя
	);            
	$arSelect = array(
		"ID",
		"TITLE",
		"DATE_CREATE",
		"CREATED_BY"
	);            
	$res = CCrmDeal::GetList(Array(), $arFilter, $arSelect);
        while ($item = $res->GetNext()) {
		$arResult['DEALS'][] = $item;
	}
}

/*
echo '<pre>';
print_r($arResult);
echo '</pre>';
*/

$this->IncludeComponentTemplate();
?>