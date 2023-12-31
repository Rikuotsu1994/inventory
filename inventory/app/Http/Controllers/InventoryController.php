<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AmountRequest;
use App\Http\Requests\MarketRequest;
use App\Http\Requests\SeasoningRequest;
use App\Services\InventoryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->createSeasoningInventory($request);
            DB::commit();
            return redirect('/inventory')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/inventory')->with(['message' => "調味料の登録に失敗しました。" ]);
        }
    }
    /**
    * 調味料データを削除します
    *
    * @param Request $request
    * @return RedirectResponse
    */
    public function postSeasoningsDelete(Request $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->deleteSeasoningInventory($request);
            DB::commit();
            return redirect('/inventory')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/inventory')->with(['message' => "調味料の削除に失敗しました。" ]);
        }
    }
    /**
    * 調味料データを更新します
    *
    * @param SeasoningRequest $request
    * @return RedirectResponse
    */
    public function postSeasoningsUpdate(SeasoningRequest $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->updateSeasoningInventory($request);
            DB::commit();
            return redirect('/inventory')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/inventory')->with(['message' => "調味料の更新に失敗しました。" ]);
        }
    }
    /**
    * 金額データを更新します
    *
    * @param AmountRequest $request
    * @return RedirectResponse
    */
    public function postAmountUpsert(AmountRequest $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->upsertSeasoningAmount($request);
            DB::commit();
            return redirect('/inventory')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/inventory')->with(['message' => "金額の更新に失敗しました。" ]);
        }
    }
    /**
    * お店データを取得します
    *
    * @return View
    */
    public function getMarket() : View
    {
        $inventory_service = new InventoryService();
        $query = $inventory_service->getMaraketList();
        return view('/inventory/markets', compact('query'));
    }
        /**
    * お店データを登録します
    *
    * @param MarketRequest $request
    * @return RedirectResponse
    */
    public function postMarketCreate(MarketRequest $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->createMarketName($request);
            DB::commit();
            return redirect('/markets')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/markets')->with(['message' => "お店の登録に失敗しました。" ]);
        }
    }
    /**
    * お店データを更新します
    *
    * @param MarketRequest $request
    * @return RedirectResponse
    */
    public function postMarketUpdate(MarketRequest $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->updateMarketName($request);
            DB::commit();
            return redirect('/markets')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/markets')->with(['message' => "お店の更新に失敗しました。" ]);
        }
    }
    /**
    * お店データを削除します
    *
    * @param Request $request
    * @return RedirectResponse
    */
    public function postMarketDelete(Request $request) :RedirectResponse
    {
        try {
            DB::beginTransaction();
            $inventory_service = new InventoryService();
            $message = $inventory_service->deleteMarketName($request);
            DB::commit();
            return redirect('/markets')->with(compact('message'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/markets')->with(['message' => "お店の削除に失敗しました。" ]);
        }
    }
    /**
    * ユーザデータを取得します
    *
    * @return View
    */
    public function getUser() : View
    {
        $inventory_service = new InventoryService();
        $query = $inventory_service->getUserInfo();
        return view('/inventory/user', compact('query'));
    }
}
