<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Render;

use Dcat\Admin\Admin;
use Dcat\Admin\Support\LazyRenderable;
use Illuminate\Support\Str;

class VideoLazyRender extends LazyRenderable
{
    public static $js = [
        '@extension/abovesky/dcat-media-player/DPlayer/DPlayer.min.js',
    ];

    protected function addScript()
    {
        $this->id = 'dplayer-' . Str::random(8);

        Admin::script(
            <<<JS
window.dplayer = new DPlayer({
    container: document.getElementById('$this->id'),
    video: {
        url: '$this->url',
    },
});
JS
        );
    }

    public function render()
    {
        $this->addScript();

        return "<div id='$this->id'></div>";
    }
}
