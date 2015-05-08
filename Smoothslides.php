<?php
/**
 * Author: DarkDrim
 */

namespace darkdrim\smoothslides;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/**
 * Class Smoothslides
 *
 * @package darkdrim\smoothslides
 */
class Smoothslides extends Widget
{
    /**
     * Current Smoothslides widget version
     */
    const VERSION = '1.0';

    public $options = [];

    public $items = [];

    /**
     * Initializes the widget.
     * This renders the open tag.
     */
    public function init()
    {
        parent::init();

        if (empty($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->id;
        }

        if ($this->useHtmlData) {
            if (isset($this->options['data'])) {
                $this->items = (array)$this->options['data'];
                unset($this->options['data']);
            }
            if (isset($this->options['spinner'])) {
                $this->spinner = (array)$this->options['spinner'];
                unset($this->options['spinner']);
            }
            foreach ($this->options as $option => $value) {
                $this->htmlOptions['data-' . $option] = $value;
            }
            $this->options = [];
        }

        $this->htmlOptions['data-auto'] = 'false'; // disable auto init

        if (!empty($this->items)) {
            $this->options['data'] = $this->items;
        }
        if (!empty($this->spinner)) {
            $this->options['spinner'] = $this->spinner;
        }

        echo Html::beginTag($this->tagName, $this->htmlOptions) . "\n";
    }

    /**
     * Runs the widget.
     * This registers the necessary javascript code and renders the close tag.
     */
    public function run()
    {
        parent::run();

        echo Html::endTag($this->tagName);

        $this->registerJs();
    }

    /**
     * @param int $position
     * @param null $key
     */
    public function registerJs($position = View::POS_READY, $key = null)
    {
        $view = $this->getView();

        FotoramaAsset::register($view)->version = self::$useCDN;

        $options = empty($this->options) ? '' : Json::encode($this->options);
        $id = $this->htmlOptions['id'];
        $js = <<<EOD
jQuery("#{$id}").fotorama({$options});
EOD;
        $view->registerJs($js, $position, $key);
    }
} 
