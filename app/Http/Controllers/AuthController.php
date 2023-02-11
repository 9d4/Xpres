<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index(Request $request) {
        if ($request->query('from') == 'semaphore') {
            return $this->callbackFromSemaphore($request);
        }

        if ($request->query('with') == 'semaphore') {
            return $this->loginWithSemaphore($request);
        }

        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only([
            'username',
            'password',
        ]);

        if (!auth()->attempt($credentials)) {
            return back()->with('error', true);
        }

        return back();
    }

    public function callbackFromSemaphore(Request $request) {
        $authCode = $request->query('code');
        $state = $request->query('state');

        if ($state !== $request->session()->get('login_semaphore') || $authCode == "") {
            return redirect()->route('login');
        }

        $postData = [
            'code' => $authCode,
            'redirect_uri' => url('/login?from=semaphore'),
            'grant_type' => 'authorization_code',
        ];

        $authReq = Http::withBasicAuth(env('SEMAPHORE_CLIENT_ID'), env('SEMAPHORE_CLIENT_SECRET'))
            ->asForm()
            ->post(env('SEMAPHORE_URL') . '/oauth2/token', $postData);


        $backLoginWithError = function () {
            return redirect()->route('login')->with(['err_login_semaphore' => 1]);
        };

        if ($authReq->status() != 200) return $backLoginWithError();

        $accessToken = $authReq->json('access_token');
        if (!$accessToken) return $backLoginWithError();

        // Get user email
        $userdataReq = Http::withToken($accessToken)->get(env('SEMAPHORE_URL') . '/api/oauth2/userinfo');
        if ($userdataReq->status() != 200) return $backLoginWithError();

        $userEmail = $userdataReq->json('email');
        if (!$userEmail) return $backLoginWithError();

        // find user and log in
        $user = User::query()->where('email', $userEmail)->first();
        if (!$user) return $backLoginWithError();

        auth()->login($user);
        return redirect('/');
    }

    /**
     * Redirect to semaphore login
     */
    public function loginWithSemaphore(Request $request)
    {
        $state = Str::random(16);

        $request->session()->put(['login_semaphore' => $state]);
        $query = array(
            'client_id' => env('SEMAPHORE_CLIENT_ID'),
            'redirect_uri' => url('/login?from=semaphore'),
            'response_type' => 'code',
            'scope' => 'email',
            'state' => $state,
        );

        $targetAuthorization = env('SEMAPHORE_URL'). '/oauth2/authorize?' . http_build_query($query);
        return redirect($targetAuthorization, 302);
    }
}
