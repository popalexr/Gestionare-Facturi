<?php

namespace App\Http\Controllers\Anaf;

use App\Http\Controllers\Controller;
use App\OAuth\Providers\AnafProvider;
use Illuminate\Http\Request;

class AnafOAuthController extends Controller
{
    /**
     * Generate the provider with ANAF - SPV endpoints
     */
    public function generateProvider(): AnafProvider
    {
        return new AnafProvider(
            [
                'clientId'                => config('spv.client.id'),
                'clientSecret'            => config('spv.client.secret'),
                'redirectUri'             => route('anaf.callback'),
                'urlAuthorize'            => config('spv.url.authorize'),
                'urlAccessToken'          => config('spv.url.token'),
                'urlResourceOwnerDetails' => '',
            ],
            [
                'auth' => 'basic' // Use basic authentication
            ]
        );
    }

    /**
     * Redirect to ANAF - SPV authorize page
     */
    public function authorize()
    {
        $provider = $this->generateProvider();

        $authorizationUrl = $provider->getAuthorizationUrl();

        // Save the state in session for security checks
        session(['oauth2state' => $provider->getState()]);

        cache()->put('oauth2state', $provider->getState(), 60 * 10); // Store the state for 10 minutes

        return redirect($authorizationUrl);
    }

    /**
     * Get the access token from ANAF - SPV (callback)
     */
    public function callback(Request $request)
    {
        $provider = $this->generateProvider();

        // Validate state to prevent CSRF attacks
        $sessionState = session('oauth2state');
        if(empty($request->get('state')) || $request->get('state') !== $sessionState) {
            session()->forget('oauth2state');
            
            return redirect()->route('dashboard')->with('error', 'Invalid or missing OAuth state.');
        }

        // Check if there is an authorization code
        if(empty($request->get('code'))) {
            return redirect()->route('dashboard')->with('error', 'Invalid or missing authorization code.');
        }

        try {
            // Get an access token using the authorization code grant
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->get('code'),
            ]);

            // Save the access token in session
            cache()->put('oauth2token', $accessToken, $accessToken->getExpires() ?? 60 * 10); // Store the token until it expires or for 10 minutes.

            return redirect()->route('dashboard')->with('success', 'You have successfully connected to ANAF - SPV.');
        }
        catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'An error occured while connecting to ANAF - SPV.');
        }
    }
}
