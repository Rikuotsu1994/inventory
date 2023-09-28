<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasoningRequest;
use App\Services\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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

    /**
    * 調味料データを登録します
    *
    * @param SeasoningRequest $request
    * @return RedirectResponse
    */
    public function postSeasoningsCreate(SeasoningRequest $request) :RedirectResponse
    {
        $inventory_service = new InventoryService();
        $message = $inventory_service->createSeasoningInventory($request);
        return redirect('/inventory')->with(compact('message'));
    }
}
