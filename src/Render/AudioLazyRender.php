<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Render;

use Dcat\Admin\Admin;
use Dcat\Admin\Support\LazyRenderable;
use Illuminate\Support\Str;

class AudioLazyRender extends LazyRenderable
{
    public static $js = [
        '@extension/abovesky/dcat-media-player/APlayer/APlayer.min.js',
    ];

    public static $css = [
        '@extension/abovesky/dcat-media-player/APlayer/APlayer.min.css',
    ];

    protected function addScript()
    {
        $this->id = 'aplayer-' . Str::random(8);

        Admin::script(
            <<<JS
window.aplayer = new APlayer({
    container: document.getElementById('$this->id'),
    listFolded: true,
    audio: [{
        name: '',
        artist: '',
        url: '$this->url',
        cover: ''
    }]
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
