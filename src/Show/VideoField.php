<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Show;

use Abovesky\DcatAdmin\MediaPlayer\MediaPlayer;
use Dcat\Admin\Admin;
use Dcat\Admin\Show\AbstractField;
use Illuminate\Support\Str;

class VideoField extends AbstractField
{
    private $id;
    private $url;

    protected static function requireAssets()
    {
        Admin::js(['@extension/abovesky/dcat-media-player/DPlayer/DPlayer.min.js']);
    }

    protected function addScript()
    {
        $this->id = 'dplayer-' . Str::random(8);

        Admin::script(
            <<<JS
const dp = new DPlayer({
    container: document.getElementById('$this->id'),
    video: {
        url: '$this->url',
    },
});

$(document).on('pjax:beforeReplace', function() {
    dp.destroy();
});
JS
        );
    }

    public function render($server = '')
    {
        $this->url = MediaPlayer::getValidUrl($this->value, $server);

        if (empty($this->url)) {
            return '';
        }

        $this->requireAssets();
        $this->addScript();

        return "<div id='$this->id'></div>";
    }
}
