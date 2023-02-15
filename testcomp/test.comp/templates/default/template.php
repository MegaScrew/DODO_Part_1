<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$APPLICATION->SetTitle($arResult['TEMPLATE_TITLE_PAGE']);	
	$list = [];
	foreach ($arResult['DEALS'] as $key => $value) {
	$rsUser = CUser::GetByID($value['CREATED_BY']);
	$arUser = $rsUser->Fetch();
		$list[] = [
			'data' => [
				'ID' => $value['ID'],
	            'DEAL_NAME' => '<a href="https://b24-test.dodoteam.ru/crm/deal/details/'.$value['ID'].'/">'.$value['TITLE'].'</a>',
	            'DATE_CREATE' => $value['DATE_CREATE'],
	            'CREATED_BY' => '<a href=https://b24-test.dodoteam.ru/company/personal/user/'.$value['CREATED_BY'].'/>'.$arUser['NAME'].' '.$arUser['LAST_NAME'].'</a>'
			],
			'actions' => [
				[
					'text' => 'Открыть',
					'onclick' => 'document.location.href="https://b24-test.dodoteam.ru/crm/deal/details/'.$value['ID'].'/"'
				]
			]	
		];
	}

$grid_options = new Bitrix\Main\Grid\Options('report_list');
$sort = $grid_options->GetSorting(['sort' => ['ID' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
$nav_params = $grid_options->GetNavParams();

$nav = new Bitrix\Main\UI\PageNavigation('report_list');
$nav->allowAllRecords(true)
    ->setPageSize($nav_params['nPageSize'])
    ->initFromUri();

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
    'GRID_ID' => 'report_list', 
    'COLUMNS' => [
        ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true], 
        ['id' => 'DEAL_NAME', 'name' => 'Название сделки', 'sort' => 'DEAL_NAME', 'default' => true], 
        ['id' => 'DATE_CREATE', 'name' => 'Дата создания', 'sort' => 'DATE_CREATE', 'default' => true], 
        ['id' => 'CREATED_BY', 'name' => 'Кто создал', 'sort' => 'CREATED_BY', 'default' => true],  
    ], 
    'ROWS' => $list,
    'SHOW_ROW_CHECKBOXES' => true, 
    'NAV_OBJECT' => $nav, 
    'AJAX_MODE' => 'Y', 
    'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''), 
    'PAGE_SIZES' => [ 
        ['NAME' => "5", 'VALUE' => '5'], 
        ['NAME' => '10', 'VALUE' => '10'], 
        ['NAME' => '20', 'VALUE' => '20'], 
        ['NAME' => '50', 'VALUE' => '50'], 
        ['NAME' => '100', 'VALUE' => '100'] 
    ], 
    'AJAX_OPTION_JUMP'          => 'N', 
    'SHOW_CHECK_ALL_CHECKBOXES' => true, 
    'SHOW_ROW_ACTIONS_MENU'     => true, 
    'SHOW_GRID_SETTINGS_MENU'   => true, 
    'SHOW_NAVIGATION_PANEL'     => true, 
    'SHOW_PAGINATION'           => true, 
    'SHOW_SELECTED_COUNTER'     => true, 
    'SHOW_TOTAL_COUNTER'        => true, 
    'SHOW_PAGESIZE'             => true, 
    'SHOW_ACTION_PANEL'         => true, 
    'ACTION_PANEL'              => [ 
        'GROUPS' => [ 
            'TYPE' => [ 
                'ITEMS' => [ 
                    [ 
                        'ID'    => 'set-type', 
                        'TYPE'  => 'DROPDOWN', 
                        'ITEMS' => [ 
                            ['VALUE' => '', 'NAME' => '- Выбрать -'], 
                            ['VALUE' => 'plus', 'NAME' => 'Поступление'], 
                            ['VALUE' => 'minus', 'NAME' => 'Списание'] 
                        ] 
                    ], 
                ], 
            ] 
        ], 
    ], 
    'ALLOW_COLUMNS_SORT'        => true, 
    'ALLOW_COLUMNS_RESIZE'      => true, 
    'ALLOW_HORIZONTAL_SCROLL'   => true, 
    'ALLOW_SORT'                => true, 
    'ALLOW_PIN_HEADER'          => true, 
    'AJAX_OPTION_HISTORY'       => 'N' 
    ]
);

?>