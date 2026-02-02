<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import StoreLayout from "@/layouts/StoreLayout.vue"
import { ChevronLeft } from 'lucide-vue-next'
import { PhoneInput } from '@/components/ui/phone-input'

const page = usePage()

/* =========================
   CART (MULTI-ITEM SAFE)
========================= */
const cart = computed<any>(() => page.props.cart || {})

const cartItems = computed(() =>
  Object.values(cart.value.items || {}).map((item: any) => ({
    ...item,
    price: Number(item.price),
  }))
)

const cartTotal = computed(() =>
  cartItems.value.reduce(
    (sum: number, item: any) => sum + item.price * item.quantity,
    0
  )
)

/* =========================
   STORE & CUSTOMER
========================= */
const store = computed(() => page.props.store || null)
const customer = computed(() => page.props.customer || {})

const paymentMethod = ref<number>(page.props.channels?.[0]?.id || 0)

const customerName = ref(customer.value.name || '')
const customerEmail = ref(customer.value.email || '')
const customerPhone = ref(customer.value.phone || '')
const customerAddress = ref(customer.value.address || '')

/* =========================
   UI STATE
========================= */
const errors = ref<Record<string, string>>({})
const isLoading = ref(false)

function lockUI() {
  isLoading.value = true
}

onMounted(() => {
  window.addEventListener('beforeunload', lockUI)
})

onUnmounted(() => {
  window.removeEventListener('beforeunload', lockUI)
})

/* =========================
   NAVIGATION
========================= */
const goBack = () => {
  if (isLoading.value) return
  if (history.length > 1) history.back()
  else router.visit('/')
}

/* =========================
   CHECKOUT
========================= */
function proceedPayment() {
  if (isLoading.value) return

  errors.value = {}
  isLoading.value = true

  const phoneEl = document.querySelector(
    'input[name="customer_phone"]'
  ) as HTMLInputElement | null

  customerPhone.value = phoneEl?.value || ''

  if (!customerName.value) errors.value.name = 'Sila isi nama anda'
  if (!customerPhone.value) errors.value.phone = 'Sila isi nombor telefon'
  if (!customerAddress.value) errors.value.address = 'Sila isi alamat'

  if (Object.keys(errors.value).length > 0) {
    isLoading.value = false
    return
  }

  router.post(route('checkout.process'), {
    payment_method: paymentMethod.value,
    customer_name: customerName.value,
    customer_email: customerEmail.value,
    customer_phone: customerPhone.value,
    customer_address: customerAddress.value,
    items: cartItems.value.map(item => ({
      product_id: item.id,
      quantity: item.quantity,
    })),
  })
}
</script>

<template>
  <StoreLayout title="Hantaro - Review Cart">
    <div class="min-h-screen bg-gray-100 space-y-3 p-2 pb-24 relative">

      <!-- LOADING OVERLAY -->
      <div
        v-if="isLoading"
        class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center"
      >
        <div class="bg-white rounded-xl px-6 py-4 flex items-center gap-3 shadow-lg">
          <svg class="animate-spin h-6 w-6 text-black" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
            <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
          </svg>
          <span class="font-semibold">Mengarahkan ke pembayaran...</span>
        </div>
      </div>

      <!-- HEADER -->
      <div class="flex items-center gap-3 mb-4">
        <button
          @click="goBack"
          :disabled="isLoading"
          class="rounded-full hover:bg-gray-200 transition disabled:opacity-50"
        >
          <ChevronLeft size="20" />
        </button>
        <h2 class="text-lg font-bold">Maklumat Tempahan</h2>
      </div>

      <!-- CART LIST -->
      <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <div
          v-for="item in cartItems"
          :key="item.id"
          class="flex justify-between items-center"
        >
          <div>
            <h3 class="font-semibold">{{ item.name }}</h3>
            <p class="text-xs text-gray-500">
              RM {{ item.price.toFixed(2) }} x {{ item.quantity }}
            </p>
          </div>
          <div class="font-bold">
            RM {{ (item.price * item.quantity).toFixed(2) }}
          </div>
        </div>

        <div class="border-t pt-2 text-right font-bold text-red-600">
          Jumlah: RM {{ cartTotal.toFixed(2) }}
        </div>
      </div>

      <!-- CUSTOMER INFO -->
      <div class="bg-white rounded-xl shadow p-4 space-y-4">
        <h3 class="font-semibold">Maklumat Pelanggan</h3>

        <div>
          <label class="block font-medium text-sm mb-1">Nama</label>
          <input
            type="text"
            v-model="customerName"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2"
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Nombor Telefon</label>
          <PhoneInput
            name="customer_phone"
            :disabled="isLoading"
            placeholder="eg. 012-3456789"
          />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone }}</p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Email</label>
          <input
            type="email"
            v-model="customerEmail"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2"
          />
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Alamat</label>
          <textarea
            v-model="customerAddress"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2"
            rows="3"
          />
          <p v-if="errors.address" class="text-red-500 text-xs mt-1">{{ errors.address }}</p>
        </div>
      </div>

      <!-- PAYMENT -->
      <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-semibold mb-2">Pilih Kaedah Pembayaran</h3>
        <label
          v-for="channel in page.props.channels"
          :key="channel.id"
          class="flex items-center gap-2"
        >
          <input
            type="radio"
            :value="channel.id"
            v-model="paymentMethod"
            :disabled="isLoading"
          />
          {{ channel.name }}
        </label>
      </div>

      <!-- PAY BUTTON -->
      <button
        :disabled="isLoading"
        @click="proceedPayment"
        class="fixed bottom-4 left-4 right-4 py-3 rounded-xl font-bold
               bg-black text-white hover:bg-yellow-600
               disabled:bg-gray-400"
      >
        Bayar Sekarang (RM {{ cartTotal.toFixed(2) }})
      </button>

    </div>
  </StoreLayout>
</template>
