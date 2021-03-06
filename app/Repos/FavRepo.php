<?php

namespace App\Repos;

use App\Models\Fav;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class FavRepo
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        try {
            return Fav::get(['recipe_id', 'user_id']);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return collect();
        }
    }
}
