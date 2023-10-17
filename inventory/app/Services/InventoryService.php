<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\SeasoningRequest;
use App\Repositories\InventoryRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    * @return Collection
    */
    public function getSeasoningsInventoryList (): Collection
    {
        $inventory_repository = new InventoryRepository();
        $query = $inventory_repository->searchSeasoningsInventory(Auth::id());
        return $query;
    }
    /**
    * 調味料データを登録します
    *
    * @param SeasoningRequest $request
    * @return String
    */
    public function createSeasoningInventory (SeasoningRequest $request): String
    {
        if(isset($request->seasoning_image)) {
            $file = $request->file('seasoning_image');
            $dir = 'users_image'. Auth::id();
            $file_name = $file->hashName();
            $request->file('seasoning_image')->storeAs('public/' . $dir, $file_name);
            $image_path = $dir . '/' . $file_name;
         } else {
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
    /**
    * 調味料データを削除します
    *
    * @param Request $request
    * @return String
    * @throws Exception データ削除に失敗した場合にthrow
    */
    public function deleteSeasoningInventory (Request $request): String
    {
        $param = [
            'id' => $request->seasoning_id,
            'users_id' => Auth::id(),
        ];
        $inventory_repository = new InventoryRepository();
        $deleteseasoning = $inventory_repository->deleteSeasoning($param);
        if(!($deleteseasoning)) {
            throw new Exception();
        };
        if (isset($request->seasoning_picture_id)) {
            $this->deleteSeasoningImage($request->seasoning_picture_id);
        };
        $message = '調味料を削除しました。';
        return $message;
    }
    /**
    * 調味料データを更新します
    *
    * @param SeasoningRequest $request
    * @return String
    * @throws Exception データ更新に失敗した場合にthrow
    */
    public function updateSeasoningInventory (SeasoningRequest $request): String
    {
        $param = [
            'id' => $request->seasoning_id,
            'users_id' => Auth::id(),
            'name' => $request->seasoning_name,
            'inventory' => $request->seasoning_inventory,
            'remarks' => $request->remarks,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ];
        $inventory_repository = new InventoryRepository();
        if ((is_null($request->seasoning_picture_id)) && (isset($request->seasoning_image))) {
            $image_path = $this->createSeasoningImage($request);
            $param['image'] = $image_path;
        };
        if ((isset($request->seasoning_picture_id)) && (isset($request->seasoning_image))) {
            $image_path = $this->createSeasoningImage($request);
            $param['image'] = $image_path;
        };
        if (($request->image_delete_flag) && (isset($request->seasoning_picture_id))) {
            $param['image'] = null;
        };
        $updateseasoning = $inventory_repository->updateSeasoning($param);
        if(!($updateseasoning)) {
            if (isset($request->seasoning_image)) {
                $this->deleteSeasoningImage($image_path);
            };
            throw new Exception();
        };
        if (isset($request->seasoning_picture_id)) {
            $this->deleteSeasoningImage($request->seasoning_picture_id);
        };
        $message = '調味料を更新しました。';
        return $message;
    }
    /**
    * 調味料データの画像を登録します
    *
    * @param Object $request
    * @return String
    */
    protected function createSeasoningImage(Object $request): String
    {
        $file = $request->file('seasoning_image');
        $dir = 'users_image'. Auth::id();
        $file_name = $file->hashName();
        $request->file('seasoning_image')->storeAs('public/' . $dir, $file_name);
        $image_path = $dir . '/' . $file_name;
        return $image_path;
    }
    /**
    * 調味料データの画像を削除します
    *
    * @param String $path
    * @return Void
    */
    protected function deleteSeasoningImage(String $path): Void
    {
        Storage::disk('public')->delete($path);
    }
}