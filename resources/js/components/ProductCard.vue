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

// Debug state
const debugInfo = ref<string[]>([]);

function addDebug(msg: string) {
  console.log('[Cart Debug]', msg);
  debugInfo.value.push(`${new Date().toLocaleTimeString()}: ${msg}`);
  if (debugInfo.value.length > 5) debugInfo.value.shift();
}

// Audio setup
let clickSound: HTMLAudioElement | null = null;
let audioInitialized = ref(false);
let audioContext: AudioContext | null = null;

// Initialize audio context (Web Audio API - more reliable)
function initAudioContext() {
  try {
    if (!audioContext) {
      const AudioContextClass = window.AudioContext || (window as any).webkitAudioContext;
      if (AudioContextClass) {
        audioContext = new AudioContextClass();
        addDebug('AudioContext created');
        
        // Resume if suspended
        if (audioContext.state === 'suspended') {
          audioContext.resume().then(() => {
            addDebug('AudioContext resumed');
          });
        }
      }
    }
  } catch (e) {
    addDebug(`AudioContext error: ${e}`);
  }
}

// Play beep using Web Audio API
function playWebAudioBeep() {
  try {
    if (!audioContext) {
      initAudioContext();
    }
    
    if (audioContext && audioContext.state === 'running') {
      const oscillator = audioContext.createOscillator();
      const gainNode = audioContext.createGain();
      
      oscillator.connect(gainNode);
      gainNode.connect(audioContext.destination);
      
      oscillator.type = 'sine';
      oscillator.frequency.value = 800;
      gainNode.gain.value = 0.1;
      
      oscillator.start(audioContext.currentTime);
      oscillator.stop(audioContext.currentTime + 0.05);
      
      addDebug('Web Audio beep played');
      return true;
    }
  } catch (e) {
    addDebug(`Web Audio error: ${e}`);
  }
  return false;
}

// Initialize HTML5 audio
function initializeAudio() {
  if (!audioInitialized.value) {
    try {
      clickSound = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSyAzvLZiTYIGWi77eeeTRAMT6fj8LdjHAU4kNfyz3ssBSR3x/DdkEAKFF607OunVRQKRp/g8r5sIQUsf87y2Yk2CBlou+3nnk0QDE+n4/C3YxwFOI/X8tB7LQUkd8fw3ZA/ChRevOzrp1UUCkaf4PK+bCEFLH/O8tmJNggZaLvt555NEAxPp+PwtmMcBTiP1/LQey0FJHfH8N2QPwoUXrzs66dVFApGn+DyvmwhBSx/zvLZiTYIGWi77eeeTRAMT6fj8LZjHAU4j9fy0HstBSR3x/DdkD8KFF687OunVRQKRp/g8r5sIQUsf87y2Yk2CBlou+3nnk0QDE+n4/C2YxwFOI/X8tB7LQUkd8fw3ZA/ChRevOzrp1UUCkaf4PK+bCEFLH/O8tmJNggZaLvt555NEAxPp+PwtmMcBTiP1/LQey0FJHfH8N2QPwoUXrzs66dVFApGn+DyvmwhBSx/zvLZiTYIGWi77eeeTRAMT6fj8LZjHAU4j9fy0HstBSR3x/DdkD8KFF687OunVRQKRp/g8r5sIQUsf87y2Yk2CBlou+3nnk0QDE+n4/C2YxwFOI/X8tB7LQUkd8fw3ZA/ChRevOzrp1UUCkaf4PK+bCEFLH/O8tmJNggZaLvt555NEAxPp+PwtmMcBTiP1/LQey0FJHfH8N2QPwoUXrzs66dVFApGn+DyvmwhBSx/zvLZiTYIGWi77eeeTRAMT6fj8LZjHAU4j9fy0HstBSR3x/DdkD8KFF687OunVRQKRp/g8r5sIQU=');
      clickSound.volume = 0.3;
      clickSound.load();
      audioInitialized.value = true;
      addDebug('HTML5 Audio initialized');
    } catch (e) {
      addDebug(`Audio init error: ${e}`);
    }
  }
}

// Debounce timer
let debounceTimer: number | null = null;
const DEBOUNCE_DELAY = 300;

// Play sound effect
function playSound() {
  addDebug('playSound called');
  
  // Try Web Audio API first (more reliable)
  const webAudioSuccess = playWebAudioBeep();
  
  if (!webAudioSuccess) {
    // Fallback to HTML5 Audio
    if (!audioInitialized.value) {
      initializeAudio();
    }

    if (clickSound) {
      try {
        clickSound.currentTime = 0;
        const playPromise = clickSound.play();
        
        if (playPromise !== undefined) {
          playPromise
            .then(() => {
              addDebug('HTML5 Audio played successfully');
            })
            .catch((error) => {
              addDebug(`HTML5 Audio failed: ${error.name}`);
            });
        }
      } catch (e) {
        addDebug(`HTML5 Audio error: ${e}`);
      }
    }
  }
}

// Haptic feedback (vibration)
function playHaptic() {
  addDebug('playHaptic called');
  
  if ('vibrate' in navigator) {
    try {
      const success = navigator.vibrate(30);
      addDebug(`Vibration ${success ? 'success' : 'failed'}`);
    } catch (e) {
      addDebug(`Vibration error: ${e}`);
    }
  } else {
    addDebug('Vibration not supported');
  }
}

// Combined feedback
function playFeedback() {
  playSound();
  playHaptic();
}

// Trigger animation
function triggerAnimation(type: 'increment' | 'decrement') {
  addDebug(`Animation triggered: ${type}`);
  animationType.value = type;
  isAnimating.value = true;
  
  setTimeout(() => {
    isAnimating.value = false;
    addDebug('Animation ended');
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
        onSuccess: () => {
          addDebug('Cart updated successfully');
          router.reload({ only: ["cart", "cartQuantity", "cartTotal"] });
        },
        onError: (errors) => {
          addDebug(`Cart update error: ${JSON.stringify(errors)}`);
        }
      }
    );
  }, DEBOUNCE_DELAY);
}

// Button handlers
function increment() {
  addDebug('Increment clicked');
  qty.value++;
  playFeedback();
  triggerAnimation('increment');
  syncQty();
}

function decrement() {
  addDebug('Decrement clicked');
  if (qty.value > 0) {
    qty.value--;
    playFeedback();
    triggerAnimation('decrement');
    syncQty();
  }
}

// Initialize on mount
onMounted(() => {
  addDebug('Component mounted');
  
  // Check browser capabilities
  addDebug(`Vibrate API: ${('vibrate' in navigator) ? 'YES' : 'NO'}`);
  addDebug(`AudioContext: ${(window.AudioContext || (window as any).webkitAudioContext) ? 'YES' : 'NO'}`);
  
  // Initialize audio on first user interaction
  const initOnInteraction = () => {
    addDebug('First user interaction detected');
    initializeAudio();
    initAudioContext();
  };
  
  // Listen for various interaction events
  ['click', 'touchstart', 'keydown'].forEach(event => {
    document.addEventListener(event, initOnInteraction, { once: true });
  });
});
</script>

<template>
  <div class="bg-white rounded-2xl shadow p-4 flex flex-col gap-4 hover:shadow-lg transition">
    <!-- DEBUG INFO (Remove in production) -->
    <div class="text-xs bg-yellow-50 p-2 rounded border border-yellow-200">
      <div class="font-bold mb-1">🐛 Debug Info:</div>
      <div v-for="(info, i) in debugInfo" :key="i" class="text-gray-600">{{ info }}</div>
      <div class="mt-2 flex gap-2">
        <span>Audio: {{ audioInitialized ? '✅' : '❌' }}</span>
        <span>Animating: {{ isAnimating ? '✅' : '❌' }}</span>
        <span>Type: {{ animationType || 'none' }}</span>
      </div>
    </div>

    <div class="flex gap-4">
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