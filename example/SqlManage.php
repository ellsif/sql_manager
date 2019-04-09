<?php
namespace ellsif\sql_manager;
use ellsif\sql_manager\SqlManageBase;

class SqlManage extends SqlManageBase
{
	public const GET_PRODUCT_DETAILS = "Get active Product details by PK";
	public const GET_PRODUCTS_LIST = "Search Products by keyword";
	public const UPDATE_PRODUCT_STOCK = "Update product stock by PK";

    public static function getSettings()
    {
        return
array (
  0 => 
  array (
    'name' => 'GET_PRODUCT_DETAILS',
    'label' => 'Get active Product details by PK',
    'sql' => 'SELECT * FROM Product
WHERE id = ? AND key = ? AND del_flg <> 1',
    'note' => 'get product details by PK',
  ),
  1 => 
  array (
    'name' => 'GET_PRODUCTS_LIST',
    'label' => 'Search Products by keyword',
    'sql' => 'SELECT * FROM Product
WHERE
  (name LIKE ? OR detail LIKE ?) AND
  del_flg <> 1
ORDER BY creaded DESC
OFFSET ? LIMIT ?',
    'note' => '',
  ),
  2 => 
  array (
    'name' => 'UPDATE_PRODUCT_STOCK',
    'label' => 'Update product stock by PK',
    'sql' => 'UPDATE Product SET stock = ?
WHERE id = ?',
    'note' => '',
  ),
);
    }
}