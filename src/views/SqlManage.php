<?php
$nameSpace = $nameSpace ?? '';
$className = $className ?? 'SqlManage';
$settings = $settings ?? [];
echo "<?php\n";
?><?php if ($nameSpace) : ?>
namespace <?php echo $nameSpace ?>;
<?php endif ?>
use ellsif\sql_manager\SqlManageBase;

class <?php echo $className ?> extends SqlManageBase
{
<?php foreach($settings as $idx => $setting) : ?>
	public const <?php echo $setting['name'] ?> = "<?php echo $setting['label'] ?>";
<?php endforeach ?>

    public static function getSettings()
    {
        return
<?php var_export($settings) ?>;
    }
}