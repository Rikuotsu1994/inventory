<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\InventoryService;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
    * システムにログインします
    *
    * @param LoginRequest $request
    * @return RedirectResponse
    */
    public function postLoginInventory (LoginRequest $request): RedirectResponse
    {
        $login_service = new InventoryService();
        $login_view = $login_service->loginAttempt($request);
        return $login_view;
    }

    /**
    * システムからログアウトします
    *
    * @return RedirectResponse
    */
    public function getLogoutInventory(): RedirectResponse
    {
        $logout_service = new InventoryService();
        $logout_view = $logout_service->logoutAttemp();
        return $logout_view;
        }
}
