<script setup lang="ts">
import { ref, watch, onMounted, nextTick, reactive, computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { refDebounced, useIntersectionObserver } from "@vueuse/core";
import StoreLayout from "@/layouts/StoreLayout.vue";
import ProductCard from "@/components/ProductCard.vue";

const page = usePage();

// Props from server
const products = ref(page.props.products);
const store = page.props.store ?? null;

/* ======================
   SEARCH & PAGINATION
====================== */
const search = ref("");
const debouncedSearch = refDebounced(search, 600);
const isLoading = ref(false);
const loadMoreTrigger = ref<HTMLElement | null>(null);

const cleanUrl = () => {
  const url = new URL(window.location.href);
  if (url.search) window.history.replaceState({}, "", url.origin + url.pathname);
};

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

const loadMore = async () => {
  if (isLoading.value) return;
  const meta = products.value?.meta;
  const current = meta?.current_page ?? 1;
  const last = meta?.last_page ?? 1;
  if (current >= last) return;

  await fetchProducts({ page: current + 1, append: true });
};

watch(debouncedSearch, async () => {
  await fetchProducts({ page: 1, append: false });
});

onMounted(async () => {
  await nextTick();
  useIntersectionObserver(loadMoreTrigger, ([e]) => {
    if (e.isIntersecting) loadMore();
  });
});

/* ======================
   CART LOGIC (NEW)
====================== */

// productId -> qty
const cart = reactive<Record<number, number>>({});

// receive qty from ProductCard
const updateQty = (productId: number, qty: number) => {
  if (qty <= 0) {
    delete cart[productId];
  } else {
    cart[productId] = qty;
  }
};

const totalQty = computed(() =>
  Object.values(cart).reduce((sum, q) => sum + q, 0)
);

const totalPrice = computed(() => {
  return products.value.data.reduce((sum: number, product: any) => {
    const qty = cart[product.id] || 0;
    return sum + qty * product.price;
  }, 0);
});

const goCheckout = () => {
  router.post(route("checkout.store"), {
    store_id: store.data.id,
    items: cart,
  });
};
</script>

<template>
  <StoreLayout title="Hantaro - Products" :store="store">
    <div class="bg-gray-100 min-h-screen pb-24">
      <!-- Product Grid -->
      <div class="grid grid-cols-2 gap-3 mt-2">
        <ProductCard v-for="product in products.data" :key="product.id" :product="product"
          @update:qty="updateQty(product.id, $event)" />
      </div>

      <!-- Loading placeholder -->
      <div ref="loadMoreTrigger" class="h-8 mt-4">
        <div v-if="isLoading" class="mt-4 grid grid-cols-2 gap-3">
          <div v-for="i in 4" :key="i" class="animate-pulse rounded-xl bg-white p-3 shadow">
            <div class="aspect-square w-full bg-gray-200 rounded-lg"></div>
            <div class="mt-3 h-3 w-3/4 bg-gray-200 rounded"></div>
            <div class="mt-2 h-3 w-1/2 bg-gray-200 rounded"></div>
          </div>
        </div>

      </div>

      <!-- No products -->
      <div v-if="!isLoading && products.data.length === 0" class="py-20 text-center text-gray-500">
        <h3 class="mt-6 text-xl font-medium text-gray-900">No products found</h3>
      </div>
    </div>

    <!-- CHECKOUT BAR -->
    <div v-if="totalQty > 0" class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t shadow-lg">
      <div class="mx-auto max-w-md px-4 py-3 flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">
            {{ totalQty }} item{{ totalQty > 1 ? 's' : '' }}
          </p>
          <p class="text-lg font-bold text-gray-900">
            RM {{ totalPrice.toFixed(2) }}
          </p>
        </div>

        <button class="rounded-full bg-black px-6 py-3 text-white font-medium active:scale-95 transition"
          @click="goCheckout">
          Next
        </button>
      </div>
    </div>
  </StoreLayout>
</template>
