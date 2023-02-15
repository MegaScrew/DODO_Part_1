<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule('crm');
$res = \Bitrix\Crm\Category\DealCategory::getAll(true);

$values = [];
foreach ($res as $key => $value) {
	$values[$value['ID']] = $value['NAME'];
}

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"TEMPLATE_TITLE_PAGE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage('TEMPLATE_TITLE_PAGE'),
			"TYPE" => "STRING",
			"DEFAULT" => "Заголовок страницы"
		),
		"TEMPLATE_DEAL_CATEGORY" => array (
			"PARENT" => "LIST",
			"NAME" => GetMessage('TEMPLATE_DEAL_CATEGORY'),
			"TYPE" => "LIST",
			"VALUES" => $values,
			"MULTIPLE" => "N",
		)
	),
);
?>