<?php

namespace App\Http\Actions\Item;

use App\Models\Item;

class UpdateItemAction
{
    public function __invoke(Item $item, array $itemData): Item
    {
        $item->update($itemData);
        activity()
            ->performedOn($item)
            ->log('Item updated');
        return $item;
    }
}
