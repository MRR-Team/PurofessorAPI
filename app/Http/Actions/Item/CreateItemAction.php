<?php

namespace App\Http\Actions\Item;

use App\Models\Item;

class CreateItemAction
{
    public function __invoke(array $itemData): Item
    {
        $item = new Item($itemData);
        $item->save();
        activity()
            ->performedOn($item)
            ->log('New item created');
        return $item;
    }
}
