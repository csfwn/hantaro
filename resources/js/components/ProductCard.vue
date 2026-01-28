<script setup lang="ts">
import { ref, onMounted } from "vue";
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

// Animation states
const isAnimating = ref(false);
const animationType = ref<'increment' | 'decrement' | null>(null);

// Audio setup


// Debounce timer
let debounceTimer: number | null = null;
const DEBOUNCE_DELAY = 300;


// Haptic feedback (vibration)
function playHaptic() {
  if ('vibrate' in navigator) {
    try {
      navigator.vibrate(30);
    } catch (e) {
      // Silent fail
    }
  }
}

// Combined feedback
function playFeedback() {
  playHaptic();
}

// Trigger animation
function triggerAnimation(type: 'increment' | 'decrement') {
  animationType.value = type;
  isAnimating.value = true;
  
  setTimeout(() => {
    isAnimating.value = false;
  }, 300);
}

// Sync quantity to session cart
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

// Button handlers
function increment() {
  qty.value++;
  playFeedback();
  triggerAnimation('increment');
  syncQty();
}

function decrement() {
  if (qty.value > 0) {
    qty.value--;
    playFeedback();
    triggerAnimation('decrement');
    syncQty();
  }
}

// Initialize audio on first user interaction
onMounted(() => {
  const initOnInteraction = () => {
  };
  
  ['click', 'touchstart', 'keydown'].forEach(event => {
    document.addEventListener(event, initOnInteraction, { once: true });
  });
});
</script>

<template>
  <div class="bg-white rounded-2xl shadow p-4 flex gap-4 hover:shadow-lg transition">
    <!-- IMAGE -->
    <Link :href="route('products.show', product.id)" class="w-20 h-20 flex-shrink-0">
      <img :src="product.main_image_url" class="w-full h-full object-cover rounded-xl" alt="Product Image" />
    </Link>

    <!-- PRODUCT INFO -->
    <div class="flex flex-col flex-1 justify-between">
      <h2 class="text-md font-semibold leading-tight line-clamp-2">{{ product.name }}</h2>
      <div class="text-xs text-gray-500 mt-1" v-html="product.description" />

      <!-- PRICE + QTY -->
      <div class="mt-3 flex items-center justify-between w-full">
        <p class="text-red-600 text-md font-bold">RM {{ product.price }}</p>

        <div class="flex items-center gap-2">
          <!-- DECREMENT BUTTON -->
          <button 
            class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 active:scale-90 transition-all duration-150 select-none touch-manipulation"
            :class="{ 'animate-press bg-red-200': isAnimating && animationType === 'decrement' }"
            @click.stop.prevent="decrement"
            type="button"
          >
            –
          </button>

          <!-- QUANTITY INPUT -->
          <input 
            type="number" 
            min="0" 
            disabled 
            v-model.number="qty" 
            class="w-12 h-7 text-center border rounded-lg text-sm transition-all duration-300"
            :class="{ 
              'scale-110 border-green-400 bg-green-50': isAnimating && animationType === 'increment',
              'scale-90 border-red-400 bg-red-50': isAnimating && animationType === 'decrement'
            }"
          />

          <!-- INCREMENT BUTTON -->
          <button 
            class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 active:scale-90 transition-all duration-150 select-none touch-manipulation"
            :class="{ 'animate-press bg-green-200': isAnimating && animationType === 'increment' }"
            @click.stop.prevent="increment"
            type="button"
          >
            +
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes press {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(0.85);
  }
  100% {
    transform: scale(1);
  }
}

.animate-press {
  animation: press 0.3s ease-in-out;
}

/* Ensure animations work on mobile */
* {
  -webkit-tap-highlight-color: transparent;
}

button {
  -webkit-user-select: none;
  user-select: none;
}
</style>