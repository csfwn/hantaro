<script setup lang="ts">
import { ref, computed } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import StoreLayout from "@/layouts/StoreLayout.vue"
import { ChevronLeft } from 'lucide-vue-next'
import { PhoneInput } from '@/components/ui/phone-input'

const page = usePage()

/* =========================
   CART
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

// const paymentMethod = ref<number>(page.props.channels?.[0]?.id || 0)

const customerName = ref(customer.value.name || '')
const customerEmail = ref(customer.value.email || '')
const customerPhone = ref(customer.value.phone || '')
const customerAddress = ref(customer.value.address || '')

/* =========================
   UI STATE
========================= */
const errors = ref<Record<string, string>>({})
const isLoading = ref(false)

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

  if (!customerName.value) errors.value.name = 'Sila isi nama anda'
  if (!customerPhone.value) errors.value.phone = 'Sila isi nombor telefon'
  if (!customerAddress.value) errors.value.address = 'Sila isi alamat'

  if (Object.keys(errors.value).length > 0) {
    isLoading.value = false
    return
  }

  router.post(route('checkout.process'), {
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
  <StoreLayout title="Review Cart" :store="store">
    <div class="min-h-screen bg-gray-100 space-y-3 p-2 pb-28">

      <!-- HEADER -->
      <div class="flex items-center gap-3 mb-4">
        <button
          @click="goBack"
          :disabled="isLoading"
          class="rounded-full p-1 transition disabled:opacity-50"
          :style="{ color: 'var(--primary)' }"
        >
          <ChevronLeft size="22" />
        </button>
        <h2 class="text-lg font-bold text-gray-900">
          Order Details
        </h2>
      </div>

      <!-- CART LIST -->
      <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <div
          v-for="item in cartItems"
          :key="item.id"
          class="flex justify-between items-center"
        >
          <div>
            <h3 class="font-semibold text-gray-900">
              {{ item.name }}
            </h3>
            <p class="text-xs text-gray-500">
              RM {{ item.price.toFixed(2) }} × {{ item.quantity }}
            </p>
          </div>

          <div class="font-bold" :style="{ color: 'var(--primary)' }">
            RM {{ (item.price * item.quantity).toFixed(2) }}
          </div>
        </div>

        <div class="border-t pt-2 text-right font-bold"
             :style="{ color: 'var(--primary)' }">
          Total: RM {{ cartTotal.toFixed(2) }}
        </div>
      </div>

      <!-- CUSTOMER INFO -->
      <div class="bg-white rounded-xl shadow p-4 space-y-4">
        <h3 class="font-semibold text-gray-900">Customer Info</h3>

        <div>
          <label class="block text-sm font-medium mb-1">Name</label>
          <input
            v-model="customerName"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2 focus:ring-2"
            :style="{ '--tw-ring-color': 'var(--primary)' }"
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">
            {{ errors.name }}
          </p>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Whatsapp No</label>
          <PhoneInput
            v-model="customerPhone"
            name="customer_phone"
            :disabled="isLoading"
          />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">
            {{ errors.phone }}
          </p>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input
            v-model="customerEmail"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2 focus:ring-2"
            :style="{ '--tw-ring-color': 'var(--primary)' }"
          />
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Address</label>
          <textarea
            v-model="customerAddress"
            rows="3"
            :disabled="isLoading"
            class="w-full border rounded-lg p-2 focus:ring-2"
            :style="{ '--tw-ring-color': 'var(--primary)' }"
          />
          <p v-if="errors.address" class="text-red-500 text-xs mt-1">
            {{ errors.address }}
          </p>
        </div>
      </div>

      <!-- PAYMENT -->
      <!-- <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <h3 class="font-semibold">Choose Payment Method</h3>

        <label
          v-for="channel in page.props.channels"
          :key="channel.id"
          class="flex items-center justify-between rounded-xl border p-4 cursor-pointer transition"
          :class="paymentMethod === channel.id
            ? 'ring-2'
            : 'border-gray-200'"
          :style="paymentMethod === channel.id
            ? { borderColor: 'var(--primary)', '--tw-ring-color': 'var(--primary)' }
            : {}"
        >
          <div class="flex items-center gap-3">
            <div
              class="w-5 h-5 rounded-full border flex items-center justify-center"
              :style="paymentMethod === channel.id
                ? { borderColor: 'var(--primary)' }
                : {}"
            >
              <div
                v-if="paymentMethod === channel.id"
                class="w-3 h-3 rounded-full"
                :style="{ backgroundColor: 'var(--primary)' }"
              />
            </div>

            <div>
              <p class="font-medium text-sm">{{ channel.name }}</p>
              <p class="text-xs text-gray-500">
                Secure & trusted payment
              </p>
            </div>
          </div>

          <input
            type="radio"
            class="hidden"
            :value="channel.id"
            v-model="paymentMethod"
          />
        </label>
      </div> -->

      <!-- PAY BUTTON -->
      <button
        :disabled="isLoading"
        @click="proceedPayment"
        class="fixed bottom-4 left-4 right-4 py-3 rounded-xl font-bold
               flex items-center justify-center gap-2
               text-white transition active:scale-95"
        :style="{
          backgroundColor: isLoading ? '#ccc' : 'var(--primary)'
        }"
      >
        <svg
          v-if="isLoading"
          class="animate-spin h-5 w-5 text-white"
          viewBox="0 0 24 24"
        >
          <circle class="opacity-25" cx="12" cy="12" r="10"
                  stroke="currentColor" stroke-width="4" fill="none" />
          <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
        </svg>

        <span>
          {{ isLoading ? 'Processing…' : `Pay Now (RM ${cartTotal.toFixed(2)})` }}
        </span>
      </button>

    </div>
  </StoreLayout>
</template>
