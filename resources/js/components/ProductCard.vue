<script setup lang="ts">
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

interface Product {
  id: number;
  name: string;
  price: number;
  main_image_url: string;
  description?: string;
  store?: any;
}

const props = defineProps<{ product: Product }>();
const page = usePage();

// Initialize quantity from session cart
const cart = page.props.cart || {};
const qty = ref(cart[props.product.id]?.quantity ?? 0);

// Debounce timer
let debounceTimer: number | null = null;
const DEBOUNCE_DELAY = 300;

// Sync quantity to session cart
function syncQty() {
  if (debounceTimer) clearTimeout(debounceTimer);

  debounceTimer = window.setTimeout(() => {
    router.post(
      route("carts.add"),
      {
        store_id: props.product.store?.id ?? null,
        items: [{ product_id: props.product.id, quantity: qty.value }],
        increment: false, // replace quantity, don't add
      },
      {
        preserveScroll: true,
        onSuccess: () =>
          router.reload({ only: ["cart", "cartQuantity", "cartTotal"] }),
      }
    );
  }, DEBOUNCE_DELAY);
}

// Button handlers
function increment() {
  qty.value++;
  syncQty();
}

function decrement() {
  if (qty.value > 0) qty.value--;
  syncQty();
}
</script>

<template>
  <div class="bg-white rounded-2xl shadow p-4 flex gap-4 hover:shadow-lg transition">
    <!-- IMAGE -->
    <Link :href="route('products.show', product.id)" class="w-20 h-20 flex-shrink-0">
      <img :src="product.main_image_url" class="w-full h-full object-cover rounded-xl" alt="Product Image" />
    </Link>

    <!-- PRODUCT INFO -->
    <div class="flex flex-col flex-1 justify-between">
      <!-- <Link :href="route('products.show', product.id)" class="block"> -->
        <h2 class="text-md font-semibold leading-tight line-clamp-2">{{ product.name }}</h2>
        <div class="text-xs text-gray-500 mt-1" v-html="product.description" />
      <!-- </Link> -->

      <!-- PRICE + QTY -->
      <div class="mt-3 flex items-center justify-between w-full">
        <p class="text-red-600 text-md font-bold">RM {{ product.price }}</p>

        <div class="flex items-center gap-2">
          <button class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center"
            @click.stop="decrement">
            –
          </button>

          <input type="number" min="0" disabled v-model.number="qty" class="w-12 h-7 text-center border rounded-lg text-sm" />

          <button class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center"
            @click.stop="increment">
            +
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
