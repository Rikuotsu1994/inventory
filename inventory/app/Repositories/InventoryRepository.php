<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Amounts;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InventoryRepository
{
    /**
    * ログインユーザの調味料データを取得します
    *
    * @param Int $id
    * @return Collection
    */
    public function searchSeasoningsInventory(Int $id): Collection
    {
        $nestedSubQuery = function ($subQuery) use ($id){
            $cond = ['seasonings.users_id' => $id, 'markets.users_id' => $id];

            $first = DB::table('seasonings') 
                ->select( 'seasonings.id as seasoning_id', 'seasonings.name as seasoning_name', 'seasonings.inventory as number_of_seasoning',
                'seasonings.image as seasoning_image',
                'seasonings.remarks as seasonings_remark', 'markets.id as market_id', 'markets.name as market_name', DB::raw('null as seasoning_amount'))
                ->crossJoin('markets')
                ->where($cond);
                $subQuery->from('amounts')
                ->select('seasonings.id as seasoning_id', 'seasonings.name as seasoning_name', 'seasonings.inventory as number_of_seasoning',
                'seasonings.image as seasoning_image',
                'seasonings.remarks as seasonings_remark', 'markets.id as market_id',
                'markets.name as market_name', 'amounts.amount as seasoning_amount')
                ->rightJoin('seasonings', 'amounts.seasonings_id', '=', 'seasonings.id')
                ->rightJoin('markets','amounts.markets_id','=','markets.id')
                ->where($cond)
                ->whereNotNull('seasonings.id')
                ->union($first);
        };

        $subQuery = DB::table($nestedSubQuery, 'nestedsubquery')
            ->selectRaw('seasoning_id,seasoning_name,number_of_seasoning,seasoning_image,seasonings_remark,market_id,market_name,max(seasoning_amount) as seasoning_amount')
            ->groupBy('seasoning_id','seasoning_name','number_of_seasoning','seasoning_image','seasonings_remark','market_id','market_name');

        $query = DB::table($subQuery, 'subquery')
            ->selectRaw('seasoning_id,seasoning_name,number_of_seasoning,seasoning_image,seasonings_remark,market_id,market_name,seasoning_amount')
            ->orderBy('seasoning_id','asc')
            ->orderByRaw('seasoning_amount is null asc')
            ->orderBy('seasoning_amount','asc')
            ->orderBy('market_id','asc')
            ->get();

        if($query->isEmpty()) {
            $query = DB::table('seasonings') 
            ->select( 'seasonings.id as seasoning_id', 'seasonings.name as seasoning_name', 'seasonings.inventory as number_of_seasoning',
            'seasonings.image as seasoning_image',
            'seasonings.remarks as seasonings_remark', DB::raw('null as market_id'), DB::raw('null as market_name'), DB::raw('null as seasoning_amount'))
            ->where('seasonings.users_id',$id)
            ->orderBy('seasoning_id','asc')
            ->get();
        }
        return $query;
    }
    /**
    * 調味料データを登録します
    *
    * @param Array $array
    * @return Void
    */
    public function createSeasoning(Array $array): Void
    {
        DB::table('seasonings')->insert($array);
    }
    /**
    * 調味料データを削除します
    *
    * @param Array $seasoning
    * @return Int
    */
    public function deleteSeasoning(Array $seasoning): Int
    {
        $deleteseasoning = DB::table('seasonings')->where('id',$seasoning["id"])->where('users_id',$seasoning["users_id"])->delete();
        return $deleteseasoning;
    }
    /**
    * 調味料データを更新します
    *
    * @param Array $seasoning
    * @return Int
    */
    public function updateSeasoning(Array $seasoning): Int
    {
        $updateseasoning = DB::table('seasonings')->where('id',$seasoning["id"])->where('users_id',$seasoning["users_id"])
        ->update($seasoning);
        return $updateseasoning;
    }
    /**
    * 金額データを更新します
    *
    * @param Request $request
    * @return Amounts
    */
    public function upsertAmount(Request $request): Amounts
    {
        $upsertamount = Amounts::updateOrCreate(
            ['seasonings_id' => $request->seasoning_id, 'markets_id' => $request->market_id],
            ['amount' => $request->seasoning_amount]);
        return $upsertamount;
    }
    /**
    * 金額データを削除します
    *
    * @param Request $request
    * @return Int
    */
    public function deleteAmount(Request $request): Int
    {
        $upsertamount = Amounts::where('seasonings_id',$request->seasoning_id)
        ->where('markets_id' , $request->market_id)
        ->delete();
        return $upsertamount;
    }
    /**
    * ログインユーザのお店データを取得します
    *
    * @param Int $id
    * @return Collection
    */
    public function searchMarket(Int $id): Collection
    {
        $query = DB::table('markets')->select('markets.id as market_id', 'markets.name as market_name')
        ->where('users_id',$id)->get();
        return $query;
    }
    /**
    * お店データを登録します
    *
    * @param Array $array
    * @return Void
    */
    public function createMarket(Array $array): Void
    {
        DB::table('markets')->insert($array);
    }
    /**
    * お店データを更新します
    *
    * @param Array $market
    * @return Int
    */
    public function updateMarket(Array $market): Int
    {
        $updateseasoning = DB::table('markets')->where('id',$market["id"])->where('users_id',$market["users_id"])
        ->update($market);
        return $updateseasoning;
    }
    /**
    * お店データを削除します
    *
    * @param Array $market
    * @return Int
    */
    public function deleteMarket(Array $market): Int
    {
        $deletemarket = DB::table('markets')->where('id',$market["id"])->where('users_id',$market["users_id"])
        ->delete();
        return $deletemarket;
    }
}