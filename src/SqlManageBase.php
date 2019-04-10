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
    public static function getSql($label, $args = null)
    {
        $sql = self::getSetting($label)['sql'];
        if ($args) {
            $sql = vsprintf($sql, $args);
        }
        return $sql;
    }

    /**
     * SQL設定を取得する。
     */
    public static function getSetting($label)
    {
        foreach (static::getSettings() as $setting) {
            if ($setting['label'] == $label) {
                return $setting;
            }
        }
        throw new \DomainException('Unknown SQL: ' . $label);
    }

    /**
     * SQL設定のリストを取得する。
     */
    abstract public static function getSettings();
}