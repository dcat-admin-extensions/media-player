<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Grid;

use Abovesky\DcatAdmin\MediaPlayer\MediaPlayer;
use Abovesky\DcatAdmin\MediaPlayer\Render\AudioLazyRender;

class AudioDisplayer extends Displayer
{
    public function renderBody()
    {
        $url = MediaPlayer::getValidUrl($this->value, $this->server);

        return AudioLazyRender::make(['url' => $url]);
    }

    public function onHideEvent()
    {
        return <<<JS
window.aplayer.destroy();
JS;
    }
}
