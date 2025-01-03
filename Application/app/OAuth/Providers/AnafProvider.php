<?php

namespace App\OAuth\Providers;

use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AnafProvider extends GenericProvider
{
    /**
     * Inject 'token_content_type=jwt' into the authorization query.
     * 
     * @param array $options
     * 
     * @return array
     */
    protected function getAuthorizationParameters(array $options): array
    {
        $options = parent::getAuthorizationParameters($options);

        $options['token_content_type'] = 'jwt';

        return $options;
    }

    /**
     * Add `token_content_type=jwt` to the token request.
     * 
     * @param string $grant
     * @param array $options
     * 
     * @return AccessTokenInterface
     */
    public function getAccessToken($grant, array $options = []): AccessTokenInterface
    {
        // Add token_content_type=jwt to the options
        $options['token_content_type'] = 'jwt';

        // Call the parent implementation
        return parent::getAccessToken($grant, $options);
    }
}