<?php

namespace BladeSvg;

use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Htmlable;

class Svg implements Htmlable
{
    private $imageName;
    private $renderMode;
    private $factory;
    private $attrs = [];

    public function __construct($imageName, $renderMode, $factory, $attrs = [])
    {
        $this->imageName = $imageName;
        $this->renderMode = $renderMode;
        $this->factory = $factory;
        $this->attrs = $attrs;
    }

    public function toHtml()
    {
        return new HtmlString(call_user_func([
            'inline' => [$this, 'renderInline'],
            'sprite' => [$this, 'renderFromSprite'],
        ][$this->renderMode]));
    }

    public function __call($method, $args)
    {
        if (count($args) === 0) {
            $this->attrs[] = Str::snake($method, '-');
        } else {
            $this->attrs[Str::snake($method, '-')] = $args[0];
        }
        return $this;
    }

    public function inline()
    {
        $this->renderMode = 'inline';
        return $this;
    }

    public function sprite()
    {
        $this->renderMode = 'sprite';
        return $this;
    }

    public function renderInline()
    {
        return str_replace(
            '<svg',
            sprintf('<svg%s', $this->renderAttributes()),
            $this->factory->getSvg($this->imageName)
        );
    }

    public function renderFromSprite()
    {
        return vsprintf('<svg%s><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="%s#%s"></use></svg>', [
            $this->renderAttributes(),
            $this->factory->spritesheetUrl(),
            $this->factory->spriteId($this->imageName)
        ]);
    }

    private function renderAttributes()
    {
        if (count($this->attrs) == 0) {
            return '';
        }

        return ' '.collect($this->attrs)->map(function ($value, $attr) {
            if (is_int($attr)) {
                return $value;
            }
            return sprintf('%s="%s"', $attr, $value);
        })->implode(' ');
    }
}
