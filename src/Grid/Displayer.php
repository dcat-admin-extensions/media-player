<?php

namespace Abovesky\DcatAdmin\MediaPlayer\Grid;

use Dcat\Admin\Grid\Displayers\AbstractDisplayer;
use Dcat\Admin\Widgets\Modal as WidgetModal;

abstract class Displayer extends AbstractDisplayer
{
    protected $title = '预览';

    protected $xl = false;

    protected $icon = 'fa fa-play';

    protected $button = '预览';

    protected $server;

    public function server(string $server)
    {
        $this->server = $server;
    }

    public function title(string $title)
    {
        $this->title = $title;
    }

    public function xl()
    {
        $this->xl = true;
    }

    public function icon(string $icon)
    {
        $this->icon = $icon;
    }

    public function button($button)
    {
        $this->button = $button;
    }

    public function display($callbackOrServer = null)
    {
        if ($callbackOrServer && $callbackOrServer instanceof \Closure) {
            $callbackOrServer->call($this->row, $this);
        } elseif ($callbackOrServer && is_string($callbackOrServer)) {
            $this->server = $callbackOrServer;
        }

        if (empty($this->value)) {
            return '';
        }

        return WidgetModal::make()
            ->when(true, function ($modal) {
                $this->xl ? $modal->xl() : $modal->lg();
            })
            ->title($this->title)
            ->body($this->renderBody())
            ->delay(300)
            ->button($this->renderButton())
            ->onHide($this->onHideEvent());
    }

    abstract public function renderBody();

    protected function renderButton()
    {
        $icon = $this->icon ? "<i class='{$this->icon}'></i>" : '';

        return "<a href='javascript:void(0)'>{$icon}&nbsp;&nbsp;{$this->button}</a>";
    }

    abstract public function onHideEvent();
}
