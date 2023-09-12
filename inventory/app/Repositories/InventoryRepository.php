<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class InventoryRepository
{
    /**
    * ログインユーザのIDと利用者IDが一致する調味料データを取得します
    *
    * @param int $id
    * @return Collection
    */
    public function searchSeasoningsInventory(int $id): Collection
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

        return $query;
  }
}