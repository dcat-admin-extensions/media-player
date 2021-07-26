<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Grid;

use Abovesky\DcatAdmin\MediaPlayer\MediaPlayer;
use Abovesky\DcatAdmin\MediaPlayer\Render\VideoLazyRender;

class VideoDisplayer extends Displayer
{
    public function renderBody()
    {
        $url = MediaPlayer::getValidUrl($this->value, $this->server);

        return VideoLazyRender::make(['url' => $url]);
    }

    public function onHideEvent()
    {
        return <<<JS
window.dplayer.destroy();
JS;
    }
}
