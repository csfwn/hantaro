<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laraditz\TikTok\Facades\TikTok;
use Laraditz\TikTok\Models\TiktokShop;

class TikTokProductTestController extends Controller
{
    private int $pageSize = 10;

    public function sync(Request $request)
    {
        $shops = $this->getShops();

        $result = [];

        foreach ($shops->cursor() as $shop) {
            $tikTok = TikTok::make(shop_id: $shop->id);

            $hasNextPage = true;
            $nextPageToken = '';
            $page = 1;
            $productCount = 0;

            while ($hasNextPage) {
                try {
                    $productData = $this->getProducts(
                        tikTok: $tikTok,
                        pageToken: $nextPageToken,
                    );

                    $products = data_get($productData, 'products', []);
                    $totalCount = data_get($productData, 'total_count', 0);
                    $nextPageToken = data_get($productData, 'next_page_token');

                    // collect result for testing
                    $result[$shop->id]['products'][] = $products;

                    // pagination logic (same as command)
                    if ($page === 1 && $totalCount === count($products)) {
                        $hasNextPage = false;
                    } elseif (empty($products) || empty($nextPageToken)) {
                        $hasNextPage = false;
                    }

                    $productCount += count($products);

                    if ($productCount >= $totalCount) {
                        $hasNextPage = false;
                    }

                } catch (\Throwable $e) {
                    return response()->json([
                        'error' => $e->getMessage(),
                    ], 500);
                }

                $page++;

                if ($page > 1000) {
                    $hasNextPage = false;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    }

    private function getProducts($tikTok, string $pageToken)
    {
        $query = [
            'page_size' => $this->pageSize,
            'page_token' => $pageToken,
        ];

        $body = [
            'status' => 'ALL',
        ];

        $response = $tikTok->product()->list(
            query: $query,
            body: $body
        );

        return data_get($response, 'data');
    }

    private function getShops()
    {
        $activeShopIds = config('params.tiktok.active_shop_id');

        $query = TiktokShop::query();

        if ($activeShopIds) {
            $query->whereIn('id', explode(',', $activeShopIds));
        }

        return $query;
    }
}
