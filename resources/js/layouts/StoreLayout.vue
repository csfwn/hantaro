<script setup lang="ts">
import { computed } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'
import { ShoppingCart, Share2 } from 'lucide-vue-next'

const page = usePage()

/* =========================
   CART (REACTIVE & SAFE)
========================= */
const cart = computed<Record<string, any>>(
  () => page.props.cart || {}
)

const cartItems = computed(() =>
  Object.values(cart.value)
)

const cartQuantity = computed(() =>
  cartItems.value.reduce(
    (sum: number, item: any) => sum + item.quantity,
    0
  )
)

const cartTotal = computed(() =>
  cartItems.value.reduce(
    (sum: number, item: any) =>
      sum + item.quantity * Number(item.price),
    0
  )
)

/* =========================
   STORE & UI
========================= */
const store = computed(() => page.props.store || null)
const showFooter = computed(() => !page.url.includes('/carts/review'))

/* =========================
   SHARE STORE
========================= */

const stripHtml = (html) => {
  const div = document.createElement('div')
  div.innerHTML = html
  return div.textContent || div.innerText || ''
}

const shareStore = async () => {
  const shareData = {
    title: store.value?.data?.name,
    text: stripHtml(store.value?.data?.description),
    url: store.value?.data?.store_url,
  }

  if (navigator.share) {
    try {
      await navigator.share(shareData)
    } catch {
      // user cancelled
    }
  } else {
    await navigator.clipboard.writeText(shareData.url)
    alert('Link copied!')
  }
}
</script>

<template>
  <div class="bg-gray-100 min-h-screen pb-24">

    <!-- HEADER -->
    <header class="bg-white shadow px-4 py-3 flex items-center justify-between">
      <!-- Left: Logo & Store Info -->
      <a class="flex items-center gap-3">
        <img
          :src="store?.data?.store_logo_url"
          alt="Store Logo"
          class="w-20 h-20 rounded-full object-cover border"
        />
        <div class="leading-tight">
          <h1 class="text-base font-bold text-gray-800">
            {{ store?.data?.name || 'Hantaro' }}
          </h1>
          <p
            class="text-xs text-gray-500"
            v-html="store?.data?.description"
          />
        </div>
      </a>

      <!-- Right: Share -->
      <button
        @click="shareStore"
        class="p-2 rounded-full hover:bg-gray-100 active:bg-gray-200"
        aria-label="Share store"
      >
        <Share2 class="w-5 h-5 text-gray-700" />
      </button>
    </header>

    <!-- PAGE CONTENT -->
    <main class="p-4">
      <slot />
    </main>

    <!-- FOOTER CART -->
    <footer
      v-if="showFooter"
      class="fixed bottom-0 left-0 right-0 z-50 bg-white shadow-md p-4 flex justify-between items-center"
    >
      <div class="text-red-600 font-bold text-lg italic">
        RM {{ cartTotal.toFixed(2) }}
      </div>

      <Link
        :href="cartQuantity > 0 ? route('carts.review') : '#'"
        :class="[
          'px-5 py-2 rounded-lg font-semibold italic flex items-center gap-2 transition',
          cartQuantity > 0
            ? 'bg-black text-white hover:bg-yellow-600'
            : 'bg-gray-300 text-gray-500 cursor-not-allowed'
        ]"
        @click.prevent="cartQuantity === 0"
      >
        <ShoppingCart :size="16" />
        Seterusnya ({{ cartQuantity }})
      </Link>
    </footer>

  </div>
</template>
