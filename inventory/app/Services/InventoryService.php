<?php

namespace App\Services;

use App\Repositories\InventoryRepository;
use Exception;
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
    * システムからログアウトします
    *
    * @return RedirectResponse
    */
    public function logoutAttemp (): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
    /**
    * ログインユーザの調味料データを取得します
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
    /**
    * 画像の保存と調味料データの登録を行います
    *
    * @param Request $request
    * @return String
    */
    public function createSeasoningInventory (Request $request): String
    {
        try {
            if(isset($request->seasoning_image)) {
                $extension = $request->seasoning_image->extension();
                $extension_check = [
                    'jpg','jpeg','png'
                ];
                if(in_array($extension, $extension_check, true)) {
                    $file = $request->file('seasoning_image');
                    $dir = 'users_image'. Auth::id();
                    $file_name = $file->hashName();
                    $request->file('seasoning_image')->storeAs('public/' . $dir, $file_name);
                    $image_path = $dir . '/' . $file_name;
                }
                else {
                    throw new Exception();
                }
            } else
                {
                    $image_path = null;
                };

            $param = [
                'users_id' => Auth::id(),
                'name' => $request->seasoning_name,
                'inventory' => $request->seasoning_inventory,
                'image' => $image_path,
                'remarks' => $request->remarks,
            ];
            $inventory_repository = new InventoryRepository();
            $inventory_repository->createSeasoning($param);
            $message = '調味料を登録しました。';
            return $message;
        }
        catch (Exception $e) {
            $message = '調味料の登録に失敗しました。';
            return $message;
        }
    }
}