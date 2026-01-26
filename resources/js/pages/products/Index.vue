<script setup lang="ts">
import { ref, watch, onMounted, nextTick } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { refDebounced, useIntersectionObserver } from "@vueuse/core";
import StoreLayout from "@/layouts/StoreLayout.vue";
import ProductCard from "@/components/ProductCard.vue";

const page = usePage();

// Props from server
const products = ref(page.props.products);
const store = page.props.store ?? null;

const search = ref("");
const debouncedSearch = refDebounced(search, 600);

const isLoading = ref(false);
const loadMoreTrigger = ref<HTMLElement | null>(null);

// Clean URL (remove query params)
const cleanUrl = () => {
    const url = new URL(window.location.href);
    if (url.search) window.history.replaceState({}, "", url.origin + url.pathname);
};

// Build request params
const buildParams = (overrides: Record<string, any> = {}) => {
    const params: Record<string, any> = {
        search: debouncedSearch.value?.trim() || undefined,
        page: undefined,
        ...overrides,
    };
    Object.keys(params).forEach((k) => {
        if (params[k] === "" || params[k] === undefined || params[k] === null) {
            delete params[k];
        }
    });
    return params;
};

// Merge new products into existing list
const upsertProducts = (pageData: any, append: boolean) => {
    const incoming = pageData.props.products;
    if (!append) {
        products.value = incoming;
        return;
    }
    const newData = incoming.data ?? [];
    products.value.data = [...(products.value.data ?? []), ...newData];
    products.value.links = incoming.links;
    products.value.meta = incoming.meta;
};

// Fetch products
const fetchProducts = async ({ page = 1, append = false }: { page?: number; append?: boolean } = {}) => {
    if (isLoading.value) return;

    isLoading.value = true;

    await router.get(route("products.index"), buildParams({ page }), {
        preserveScroll: true,
        preserveState: true,
        only: ["products"],
        replace: true,
        onSuccess: (pageData) => {
            upsertProducts(pageData, append);
            cleanUrl();
        },
        onFinish: () => (isLoading.value = false),
    });
};

// Infinite scroll
const loadMore = async () => {
    if (isLoading.value) return;
    const meta = products.value?.meta;
    const current = meta?.current_page ?? 1;
    const last = meta?.last_page ?? 1;
    if (current >= last) return;

    await fetchProducts({ page: current + 1, append: true });
};

// Watch search input
watch(debouncedSearch, async () => {
    await fetchProducts({ page: 1, append: false });
});

// Intersection observer for load more
onMounted(async () => {
    await nextTick();
    useIntersectionObserver(loadMoreTrigger, ([e]) => {
        if (e.isIntersecting) loadMore();
    });
});
</script>

<template>
  <StoreLayout title="Hantaro - Products">
    <div class="bg-gray-100 min-h-screen">

      <!-- Search Input -->
      <!-- <div class="border-b py-3">
        <div class="container mx-auto">
          <div class="relative">
            <input
              v-model="search"
              id="product_search_input"
              type="text"
              placeholder="Search foods..."
              class="w-full rounded-full border border-gray-400 py-2 pl-4 pr-10 text-sm focus:ring-primary"
            />
            <button
              v-if="search"
              @click="search = ''"
              class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
            >
              ✕
            </button>
          </div>
        </div>
      </div> -->

      <!-- Product Grid -->
      <div class="grid grid-cols-1 gap-4 mt-1">
        <ProductCard v-for="product in products.data" :key="product.id" :product="product" />
      </div>

      <!-- Loading placeholder -->
      <div ref="loadMoreTrigger" class="h-8 mt-4">
        <div v-if="isLoading" class="mt-6 grid grid-cols-1 gap-3">
          <div v-for="i in 2" :key="i" class="animate-pulse rounded-lg bg-white p-3 shadow">
            <div class="h-28 w-full rounded-md bg-gray-200 md:h-32 lg:h-36"></div>
            <div class="mt-3 space-y-2">
              <div class="h-3 w-3/4 rounded bg-gray-200"></div>
              <div class="h-3 w-1/2 rounded bg-gray-200"></div>
              <div class="h-3 w-2/5 rounded bg-gray-200"></div>
            </div>
            <div class="mt-3 h-4 w-1/3 rounded bg-gray-300"></div>
            <div class="mt-4 h-8 w-full rounded-full bg-gray-200"></div>
          </div>
        </div>
      </div>

      <!-- No products found -->
      <div v-if="!isLoading && (!products || products.length === 0)" class="py-20 text-center text-gray-500">
        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
        <h3 class="mt-6 text-xl font-medium text-gray-900">No products found</h3>
        <p class="mt-2 text-gray-600">Try adjusting your filters to find more products.</p>
      </div>

    </div>
  </StoreLayout>
</template>
