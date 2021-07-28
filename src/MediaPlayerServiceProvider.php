<?php

namespace Abovesky\DcatAdmin\MediaPlayer;

use Abovesky\DcatAdmin\MediaPlayer\Grid\AudioDisplayer;
use Abovesky\DcatAdmin\MediaPlayer\Grid\VideoDisplayer;
use Abovesky\DcatAdmin\MediaPlayer\Show\AudioField;
use Abovesky\DcatAdmin\MediaPlayer\Show\VideoField;
use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Grid\Column;
use Dcat\Admin\Show\Field;

class MediaPlayerServiceProvider extends ServiceProvider
{
    public function init()
    {
        parent::init();

        if ($views = $this->getViewPath()) {
            $this->loadViewsFrom($views, 'dcat-media-player');
        }

        Admin::booting(function () {
            Column::extend('video', VideoDisplayer::class);
            Column::extend('audio', AudioDisplayer::class);
            Field::extend('video', VideoField::class);
            Field::extend('audio', AudioField::class);
        });
    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
