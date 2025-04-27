<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeController extends Controller
{
    public function __invoke()
    {
        $user = User::with(['projects' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'experiences' => function (HasMany $query) {
            $query->where('visible', '=', true)
                ->orderBy('start_date', 'desc');
        }])->first();

        return new UserResource($user);
    }
}
