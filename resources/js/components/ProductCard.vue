<script setup lang="ts">
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";

interface Product {
  id: number;
  name: string;
  price: number;
  main_image_url: string;
  description?: string;
  store?: any;
  is_popular?: boolean; // Add this field to mark popular products
  discount_percentage?: number; // Optional discount badge
}

const props = defineProps<{ product: Product }>();
const page = usePage();

const cart = page.props.cart || {};
const qty = ref(cart[props.product.id]?.quantity ?? 0);

let debounceTimer: number | null = null;
const DEBOUNCE_DELAY = 250;

function syncQty() {
  if (debounceTimer) clearTimeout(debounceTimer);

  debounceTimer = window.setTimeout(() => {
    router.post(
      route("carts.add"),
      {
        store_id: props.product.store?.id ?? null,
        items: [{ product_id: props.product.id, quantity: qty.value }],
        increment: false,
      },
      {
        preserveScroll: true,
        onSuccess: () =>
          router.reload({ only: ["cart", "cartQuantity", "cartTotal"] }),
      }
    );
  }, DEBOUNCE_DELAY);
}

function increment() {
  qty.value++;
  syncQty();
}

function decrement() {
  if (qty.value <= 0) return;
  qty.value--;
  syncQty();
}
</script>

<template>
  <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl
           flex flex-col overflow-hidden
           border border-gray-100
           transition-all duration-300 ease-out
           hover:-translate-y-1">
    <!-- IMAGE SECTION -->
    <div class="relative aspect-[4/3] bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
      <!-- Most Popular Badge -->
      <div class="absolute top-3 left-3 z-10
         text-white text-xs font-bold
         px-3 py-1.5 rounded-full
         shadow-lg
         flex items-center gap-1.5
         animate-pulse-subtle" :style="{
          background: `linear-gradient(
      135deg,
      var(--primary),
      color-mix(in srgb, var(--primary) 85%, black)
    )`
        }">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        Most Popular
      </div>


      <!-- Discount Badge -->
      <div v-if="product.discount_percentage" class="absolute top-3 right-3 z-10
               bg-red-500 text-white
               text-xs font-bold
               px-2.5 py-1 rounded-lg
               shadow-md">
        -{{ product.discount_percentage }}%
      </div>

      <!-- Product Image -->
      <img :src="product.main_image_url" :alt="product.name" class="w-full h-full object-cover
               group-hover:scale-105
               transition-transform duration-500 ease-out" />

      <!-- Overlay on hover -->
      <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5
               transition-colors duration-300" />
    </div>

    <!-- CONTENT SECTION -->
    <div class="p-4 flex flex-col flex-1">
      <!-- Product Name -->
      <h3 class="text-sm font-semibold text-gray-900">
        {{ product.name }}
      </h3>

      <!-- Price Section -->
      <div>
        <div class="flex items-baseline gap-2">
          <p class="font-bold text-sm" style="color: var(--primary)">
            RM {{ Number(product.price).toFixed(2) }}
          </p>

          <!-- Optional: Show original price if there's a discount -->
          <!-- <p
            v-if="product.discount_percentage"
            class="text-xs text-gray-400 line-through"
          >
            RM {{ (Number(product.price) / (1 - product.discount_percentage / 100)).toFixed(2) }}
          </p> -->
        </div>
      </div>
    </div>

    <!-- QUANTITY CONTROL BAR -->
    <div class="border-t border-gray-100 bg-gradient-to-b from-gray-50/50 to-gray-50
             px-3 py-2
             flex items-center justify-between gap-3">
      <!-- Decrement Button -->
      <button @click="decrement" :disabled="qty === 0" class="w-10 h-10 rounded-xl
               bg-white border-2 border-gray-200
               text-gray-700 text-xl font-bold
               disabled:opacity-30 disabled:cursor-not-allowed
               active:scale-95 hover:border-red-400 hover:text-red-500
               transition-all duration-200
               shadow-sm hover:shadow
               flex items-center justify-center" aria-label="Decrease quantity">
        −
      </button>

      <!-- Quantity Display -->
      <div class="flex-1 flex flex-col items-center">
        <span class="text-xs text-gray-500 font-medium">Qty</span>
        <span class="text-base font-bold text-gray-900 tabular-nums">
          {{ qty }}
        </span>
      </div>

      <!-- Increment Button -->
      <button @click="increment" class="w-10 h-10 rounded-xl
               text-white text-xl font-bold
               active:scale-95 transition
               transition-all duration-200
               shadow-md hover:shadow-lg
               flex items-center justify-center" aria-label="Increase quantity"
        style="background-color: var(--primary)">
        +
      </button>
    </div>
  </div>
</template>

<style scoped>
* {
  -webkit-tap-highlight-color: transparent;
}

@keyframes pulse-subtle {

  0%,
  100% {
    opacity: 1;
  }

  50% {
    opacity: 0.9;
  }
}

.animate-pulse-subtle {
  animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Smooth number transitions */
.tabular-nums {
  font-variant-numeric: tabular-nums;
}
</style>