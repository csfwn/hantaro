<?php

namespace App\Services;

use App\Models\Product;
use Laraditz\TikTok\Facades\TikTok;
use Laraditz\TikTok\Models\TiktokShop;

class TikTokProductSyncService
{
    public function process(): void
    {
        $shops = TiktokShop::query()->get();

        foreach ($shops as $shop) {
            $this->syncShop($shop);
        }
    }

    private function syncShop(TiktokShop $shop): void
    {
        $tiktok = TikTok::make(shop_id: $shop->id);

        $nextPageToken = '';
        $hasNextPage = true;

        while ($hasNextPage) {
            $response = $tiktok->product()->list(
                query: [
                    'page_size' => 50,
                    'page_token' => $nextPageToken,
                ],
                body: [
                    'status' => 'ALL',
                ]
            );

            $data = data_get($response, 'data');
            $products = data_get($data, 'products', []);
            $nextPageToken = data_get($data, 'next_page_token');

            foreach ($products as $product) {
                $this->syncProduct($product, $shop->id);
            }

            if (empty($products) || empty($nextPageToken)) {
                $hasNextPage = false;
            }
        }
    }

    private function syncProduct(array $product, string $shopId): void
    {
        foreach ($product['skus'] ?? [] as $skuData) {
            $sellerSku = data_get($skuData, 'seller_sku');

            if (!$sellerSku) {
                continue;
            }

            $stock = collect(data_get($skuData, 'inventory', []))
                ->sum('quantity');

            $price = (float) data_get($skuData, 'price.tax_exclusive_price', 0);

            Product::updateOrCreate(
                ['sku' => $sellerSku],
                [
                    'name'      => data_get($product, 'title'), 
                    'price'     => $price,
                    'stock'     => $stock,
                    'is_active' => data_get($product, 'status') === 'ACTIVATE',
                    'tiktok_shop_id'  => $shopId,
                ]
            );
        }
    }

}
