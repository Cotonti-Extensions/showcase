<?php

namespace cot\plugins\showcase\inc;

use Cot;
use cot\traits\GetInstanceTrait;

class ShowcaseService
{
    use GetInstanceTrait;

    public function getScreenshot(string $url, int $width = 1920, int $height = 1080): string //int $width = 200, int $height = 150): string
    {
        if (mb_stripos($url, 'http://') === false && mb_stripos($url, 'https://') === false) {
            $url = 'https://' . $url;
        }
        $url = urlencode($url);

        $result = 'https://api.apiflash.com/v1/urltoimage?access_key=' . Cot::$cfg['plugin']['showcase']['ApiFlashAccessKey']
            . '&wait_until=page_loaded'
            . "&url={$url}"
            . "&width={$width}&height={$height}"
            . '&ttl=2592000'; // the screenshot is cached for 30 days

        return $result;
    }
}