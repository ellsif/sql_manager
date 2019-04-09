<?php
namespace ellsif\sql_manager;


/**
 * SQL管理規定クラス
 */
abstract class SqlManageBase
{
    /**
     * SQL文を取得する。
     */
    public static function getSql($label)
    {
        foreach (self::getSettings() as $setting) {
            if ($setting['label'] == $label) {
                return $setting['sql'];
            }
        }
        throw new \DomainException('Unknown SQL: ' . $label);
    }

    /**
     * SQL設定のリストを取得する。
     */
    abstract public static function getSettings();
}