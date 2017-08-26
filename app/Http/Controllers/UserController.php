<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 24.8.2017
 * Time: 11:25
 */

namespace TakeTick\Http\Controllers;

use TakeTick\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * UserController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login()
    {
        $emailAttempt = Auth::attempt([
            'email' => $this->request->input('username'),
            'password' => $this->request->input('password')
        ]);
        if(!$emailAttempt) {
            $nicknameAttempt = Auth::attempt([
                'nickname' => $this->request->input('username'),
                'password' => $this->request->input('password')
            ]);
            if(!$nicknameAttempt) {
                throw new \Exception(_('Username and password does not match.'));
            }
        }
        return response()->json([
            'redirect' => '/'
        ]);
    }
}