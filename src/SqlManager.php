<?php
namespace ellsif\sql_manager;

/**
 * SQL管理クラス
 */
class SqlManager
{
    /**
     * SQL管理画面を表示する。
     *
     * オプション指定
     * - className デフォルトはSqlManage
     */
    public static function execute($outputDir, $nameSpace = '', $options = [])
    {
        $className = $options['className'] ?? 'SqlManage';
        $sqlSettings = [];
        $error = null;
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            try {
                $settings = json_decode($_POST['settings'], true);
                $outputDir = rtrim($outputDir, "/");
                if (!file_exists($outputDir)) {
                    mkdir($outputDir, 0755, true);
                }
                $outputFile = $outputDir . '/' . $className . '.php';
                ob_start();
                include dirname(__FILE__) . '/views/SqlManage.php';
                $src = ob_get_contents();
                ob_end_clean();
                if (file_put_contents($outputFile, $src) === false){
                    throw new \Exception('save ' . $outputFile . 'failed');
                }
                header("HTTP/1.1 301");
                header( "Location: " . $_SERVER['REQUEST_URI']);
                exit(0);
            } catch(\Exception $e) {
                $error = 'Save failed: ' . $e->getMessage();
            }

        }
        // 管理画面を表示
        if ($nameSpace) {
            $className = '\\' . $nameSpace . '\\' . $className;
        }
        if (class_exists($className) && method_exists($className, 'getSettings')) {
            $sqlSettings = $className::getSettings();
        }
        extract([
            'settings' => $sqlSettings,
            'error' => $error,
        ]);
        include dirname(__FILE__) . '/views/index.php';
    }
}