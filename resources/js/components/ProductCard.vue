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
let clickSound: HTMLAudioElement | null = null;
let audioInitialized = false;

// Initialize audio
function initializeAudio() {
  if (!audioInitialized) {
    try {
      clickSound = new Audio('data:audio/wav;base64,UklGRmQFAABXQVZFZm10IBAAAAABAAEARKwAAIhYAQACABAAZGF0YUAFAAC/v7+/v7+/v7+/v7+/v7+/wMDAwMDAwMDAwMDAwMDBwcHBwcHBwcHBwsLCwsLCwsLCw8PDw8PDw8PDxMTExMTExMTFxcXFxcXFxsbGxsbGxsbHx8fHx8fHyMjIyMjIyMnJycnJycrKysrKysrLy8vLy8vMzMzMzMzMzc3Nzc3Nzs7Ozs7Oz8/Pz8/P0NDQ0NDQ0dHR0dHR0tLS0tLS09PT09PU1NTU1NTV1dXV1dbW1tbW19fX19fY2NjY2NnZ2dnZ2tra2trb29vb29zc3Nzc3d3d3d3e3t7e3t/f39/f4ODg4ODh4eHh4eLi4uLi4+Pj4+Pk5OTk5OXl5eXl5ubm5ubn5+fn5+jo6Ojp6enp6erq6urq6+vr6+vs7Ozs7O3t7e3t7u7u7u7v7+/v7/Dw8PDw8fHx8fHy8vLy8vPz8/Pz9PT09PT19fX19fb29vb2+Pj4+Pj5+fn5+fr6+vr6+/v7+/v8/Pz8/P39/f39/v7+/v7///+/v7+/v7+/v7+/v7+/v7/AwMDAwMDAwMDAwMDAwcHBwcHBwcHBwcLCwsLCwsLCwsPDw8PDw8PDxMTExMTExMTFxcXFxcXFxsbGxsbGxsfHx8fHx8jIyMjIyMjJycnJycnKysrKysrLy8vLy8vMzMzMzMzNzc3Nzc3Ozs7Ozs7Pz8/Pz9DQ0NDQ0NHR0dHR0tLS0tLS09PT09PU1NTU1NXV1dXV1tbW1tbX19fX19jY2NjY2dnZ2dna2tra2tvb29vb3Nzc3Nzd3d3d3d7e3t7e39/f39/g4ODg4OHh4eHh4uLi4uLj4+Pj4+Tk5OTk5eXl5eXm5ubm5ufn5+fn6Ojo6Onp6enp6urq6urr6+vr6+zs7Ozs7e3t7e3u7u7u7u/v7+/v8PDw8PDx8fHx8fLy8vLy8/Pz8/P09PT09PX19fX19vb29vb4+Pj4+Pn5+fn5+vr6+vr7+/v7+/z8/Pz8/f39/f3+/v7+/v///w==');
      clickSound.volume = 0.3;
      clickSound.load();
      audioInitialized = true;
    } catch (e) {
      console.warn('Audio initialization failed:', e);
    }
  }
}

// Debounce timer
let debounceTimer: number | null = null;
const DEBOUNCE_DELAY = 300;

// Play sound effect
function playSound() {
  if (!audioInitialized) {
    initializeAudio();
  }

  if (clickSound) {
    try {
      clickSound.currentTime = 0;
      clickSound.play().catch(() => {});
    } catch (e) {}
  }
}

// Haptic feedback (vibration) - Works immediately without user interaction!
function playHaptic() {
  if ('vibrate' in navigator) {
    navigator.vibrate(30); // Short 30ms vibration
  }
}

// Combined feedback
function playFeedback() {
  playSound();    // Will work after first user interaction
  playHaptic();   // Works immediately on mobile!
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

// Initialize audio on first interaction
onMounted(() => {
  const initOnInteraction = () => {
    initializeAudio();
  };
  
  document.addEventListener('click', initOnInteraction, { once: true });
  document.addEventListener('touchstart', initOnInteraction, { once: true });
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
            class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 active:scale-90 transition-all duration-150 select-none"
            :class="{ 'animate-press': isAnimating && animationType === 'decrement' }"
            @click.stop="decrement"
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
              'scale-110 border-green-400': isAnimating && animationType === 'increment',
              'scale-90 border-red-400': isAnimating && animationType === 'decrement'
            }"
          />

          <!-- INCREMENT BUTTON -->
          <button 
            class="w-7 h-7 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 active:scale-90 transition-all duration-150 select-none"
            :class="{ 'animate-press': isAnimating && animationType === 'increment' }"
            @click.stop="increment"
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
</style>