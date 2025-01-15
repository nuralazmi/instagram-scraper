<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ScrapperService
{

    /**
     * @var string
     */
    protected string $endpoint = 'https://www.instagram.com/graphql/query';


    /**
     * @param string $username
     * @param string|null $after
     * @return array
     */
    public function getPostsByUsername(string $username, string $after = null): array
    {
        $request = Http::post($this->endpoint, [
            'doc_id' => '8902380376464356',
            'variables' => json_encode([
                'data' => [
                    "count" => 6,
                ],
                "username" => $username,
                "after" => $after,
                "__relay_internal__pv__PolarisIsLoggedInrelayprovider" => true,
                "__relay_internal__pv__PolarisFeedShareMenurelayprovider" => true,
            ]),
        ]);
        $response = $request->json();
        $items = $response['data']['xdt_api__v1__feed__user_timeline_graphql_connection']['edges'] ?? [];
        $items = array_map(function ($item) {
            return [
                'username' => $item['node']['user']['username'] ?? null,
                'profile_image' => $item['node']['user']['profile_pic_url'] ?? null,
                'is_private' => $item['node']['user']['is_private'] ?? null,
                'code' => $item['node']['code'] ?? null,
                'id' => $item['node']['id'] ?? null,
                'comment_count' => $item['node']['comment_count'] ?? null,
                'like_count' => $item['node']['like_count'] ?? null,
                'post_image' => $item['node']['display_uri'] ?? null,
            ];
        }, $items);

        $after = $response['data']['xdt_api__v1__feed__user_timeline_graphql_connection']['page_info']['end_cursor'] ?? null;

        return [
            'items' => $items,
            'after' => $after,
        ];
    }

}
