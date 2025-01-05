<?php

namespace ParcelPanel\Libs;

class Cache {
    const DEFAULT_CACHE_FILE_NAMES = [
        [
            "name" => "object-cache-pro/object-cache-pro.php",
            "flush_type" => "flush_group",
        ],
        [
            "name" => "redis-cache-pro/redis-cache-pro.php",
            "flush_type" => "flush_group",
        ],
        [
            "name" => "redis-cache-develop/redis-cache.php",
            "flush_type" => "flush_group",
        ],
        [
            "name" => "pressable-cache-management/pressable-cache-management.php",
            "flush_type" => "flush_all",
        ],
    ];

    // 清理缓存
    public static function cache_flush()
    {
        $fileNames = get_option(\ParcelPanel\OptionName\CACHE_PLUGIN_FILE_NAMES);

        if (empty($fileNames)) {
            // 维护一个默认的配置表
            update_option(\ParcelPanel\OptionName\CACHE_PLUGIN_FILE_NAMES, wp_json_encode(self::DEFAULT_CACHE_FILE_NAMES));
            $fileNamesArr = self::DEFAULT_CACHE_FILE_NAMES;
        } else {
            try {
                $fileNamesArr = json_decode($fileNames, true);
            } catch (\Exception $e) {
                $fileNamesArr = self::DEFAULT_CACHE_FILE_NAMES;
            }
        }

        if (!$fileNamesArr) {
            $fileNamesArr = self::DEFAULT_CACHE_FILE_NAMES;
        }

        foreach ($fileNamesArr as $value) {
            $flushType = $value['flush_type'];

            if (!is_plugin_active($value['name'])) {
                continue;
            }

            switch ($flushType) {
                case "flush_all":
                    wp_cache_flush();
                    break;
                default:
                    wp_cache_flush_group('parcelpanel');
                    break;
            }
        }
    }
}
