<?php

namespace App\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use SleepingOwl\Admin\Http\Controllers\AdminController;

/**
 * Class Controller
 * @package App\Admin\Http\Controllers
 */
class Controller extends AdminController
{

    /**
     * Receiving slug for urls on ajax requests
     *
     * @return JsonResponse
     */
    public function generateSlug()
    {
        return response()->json([
            'status' => true,
            'data' => Str::slug(request('text')),
        ], JsonResponse::HTTP_OK);
    }
}
