<?php

namespace App\Services;

class HostsHelper
{
    /**
     * get host from a url
     *
     * @param string $urlString
     * @return string
     */
    public static function getHostFromString(string $urlString): string
    {
        $hostDetails = parse_url($urlString);
        if (array_key_exists('host', $hostDetails)) {
            return $hostDetails['host'];
        }
        if (array_key_exists('path', $hostDetails)) {
            return $hostDetails['path'];
        }
        return $urlString;
    }

    /**
     * Get search criteria for host that's mapped with db's domain/subdomain
     *
     * @param string $host
     * @return array
     */
    public static function getSearchCriteriaForAHost(string $host): array
    {
        if (strpos($host, 'localhost') !== false ) {
            return ['subdomain' => 'test'];
        } else {

            $domain = self::getHostFromString($host);
            if (strpos($domain, env('BRAND_SITE')) !== false) {
                return ['subdomain' => substr($domain, 0, strpos($domain, '.'))];
            }
            return ['domain' => $domain];
        }


    }
}
