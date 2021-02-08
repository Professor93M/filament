<?php

namespace Filament\Fields;

use Filament\FieldConcerns;
use Illuminate\Support\Str;

class Tabs extends Field
{
    use FieldConcerns\HasId;
    use FieldConcerns\HasLabel;

    public static function make($label = null)
    {
        $tabs = (new static())->label($label);

        if ($label) $tabs = $tabs->id((string) Str::of($label)->slug());

        return $tabs;
    }

    public function getTabsConfig()
    {
        return collect($this->fields)
            ->mapWithKeys(fn ($tab) => [$this->id . '.' . $tab->id => __($tab->label)])
            ->toArray();
    }

    public function tabs($tabs)
    {
        $this->fields($tabs);

        return $this;
    }
}
