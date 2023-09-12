<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
{
    /**
    * 調味料データを取得します
    *
    * @param Request $request
    * @return View
    */
    public function getSeasoningsInventory(Request $request) : View
    {
        $inventory_service = new InventoryService();
        $query = $inventory_service->getSeasoningsInventoryList($request);
        return view('/inventory/index', compact('query'));
    }
}
