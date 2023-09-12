<?php

namespace App\Services;

use App\Repositories\InventoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class InventoryService
{
    /**
    * システムにログインします
    *
    * @param Request $request
    * @return RedirectResponse
    */
    public function loginAttempt (Request $request): RedirectResponse
    {
        $param = $request->only(['email','password']);
        if (Auth::attempt($param)) {
            $request->session()->regenerate();
            return redirect()->intended('inventory');
        }
        throw ValidationException::withMessages([
            'login_failed' =>trans('IDまたはパスワードの組み合わせに誤りがあります'),
        ]);
        return back();
    }

    /**
    * ログインユーザの利用者IDをInventoryRepositoryに渡して調味料データを取得します
    *
    * @param Request $request
    * @return Collection
    */
    public function getSeasoningsInventoryList (Request $request): Collection
    {
        $id = Auth::id();
        $inventory_repository = new InventoryRepository();
        $query = $inventory_repository->searchSeasoningsInventory($id);
        return $query;
    }
}