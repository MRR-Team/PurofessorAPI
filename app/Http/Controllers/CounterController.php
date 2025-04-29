<?php

namespace App\Http\Controllers;

use App\Http\Actions\BestCounterAction;
use App\Models\Champion;
use Illuminate\Http\JsonResponse;

class CounterController extends Controller
{
   public function __invoke(BestCounterAction $bestCounterAction, String $role, Champion $enemyChampion):JsonResponse{
       return response()->json($bestCounterAction($role, $enemyChampion));
   }
}
