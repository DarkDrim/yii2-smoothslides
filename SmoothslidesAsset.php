<?php
/**
 * Author: DarkDrim
 */

namespace darkdrim\smoothslides;

use yii\web\AssetBundle;

/**
 * Class SmoothslidesAsset
 *
 * @package darkdrim\smoothslides
 */
class SmoothslidesAsset extends AssetBundle
{
	public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/smoothslides.theme']);
        $this->setupAssets('js', ['js/smoothslides.min']);
        parent::init();
    }
} 
