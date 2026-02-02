<script setup lang="ts">
import { computed } from 'vue'
import { usePage, Link } from '@inertiajs/vue3'
import { ShoppingCart, Share2 } from 'lucide-vue-next'

import Classic from '@/store-templates/Classic.vue'
import Linktree from '@/store-templates/Linktree.vue'
import Catalog from '@/store-templates/Catalog.vue'

/* =========================
   PROPS
========================= */
const props = defineProps({
  store: Object,
})

/* =========================
   PAGE & CART
========================= */
const page = usePage()

const cart = computed<Record<string, any>>(
  () => page.props.cart || {}
)

const cartItems = computed(() => Object.values(cart.value))

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

const showFooter = computed(() => !page.url.includes('/carts/review'))

/* =========================
   THEME (IMPORTANT)
========================= */
const primaryColor = computed(
  () => props.store?.data?.theme?.primary || '#000000'
)

/* =========================
   SHARE STORE
========================= */
const stripHtml = (html: string) => {
  const div = document.createElement('div')
  div.innerHTML = html
  return div.textContent || div.innerText || ''
}

const shareStore = async () => {
  const shareData = {
    title: props.store?.data?.name,
    text: stripHtml(props.store?.data?.description),
    url: props.store?.data?.store_url,
  }

  if (navigator.share) {
    try {
      await navigator.share(shareData)
    } catch {}
  } else {
    await navigator.clipboard.writeText(shareData.url)
    alert('Link copied!')
  }
}

/* =========================
   TEMPLATE MAP
========================= */
const templates = {
  classic: Classic,
  linktree: Linktree,
  catalog: Catalog,
}
</script>

<template>
  <!-- ROOT WRAPPER (IMPORTANT: DEFINE --primary HERE) -->
  <div
    class="bg-gray-100 min-h-screen pb-24"
    :style="{ '--primary': primaryColor }"
  >
    <!-- STORE TEMPLATE -->
    <component
      :is="templates[store?.data?.template] || templates.classic"
      :store="store"
    >
      <slot />
    </component>

    <!-- FOOTER CART -->
    <footer
      v-if="showFooter"
      class="fixed bottom-0 left-0 right-0 z-50
             bg-white shadow-md p-4
             flex justify-between items-center"
    >
      <!-- TOTAL PRICE -->
      <div
        class="font-bold text-lg"
        style="color: var(--primary)"
      >
        RM {{ cartTotal.toFixed(2) }}
      </div>

      <!-- CHECKOUT BUTTON -->
      <Link
        :href="cartQuantity > 0 ? route('carts.review') : '#'"
        :class="[
          'px-5 py-2 rounded-lg font-semibold flex items-center gap-2 transition',
          cartQuantity > 0
            ? 'text-white active:scale-95'
            : 'bg-gray-300 text-gray-500 cursor-not-allowed'
        ]"
        :style="cartQuantity > 0
          ? { backgroundColor: 'var(--primary)' }
          : {}"
        @click.prevent="cartQuantity === 0"
      >
        Checkout ({{ cartQuantity }})
      </Link>
    </footer>
  </div>
</template>
