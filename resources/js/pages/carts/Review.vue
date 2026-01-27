<script setup lang="ts">
import { ref, computed } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import StoreLayout from "@/layouts/StoreLayout.vue"
import { ChevronLeft } from 'lucide-vue-next'
import { PhoneInput } from '@/components/ui/phone-input'

const page = usePage()

// Cart info from backend
const cart = computed(() => page.props.cart || {})
const paymentMethod = ref<number>(page.props.channels?.[0]?.id || 0)
const customer = computed(() => page.props.customer || {})

const cartItems = computed(() =>
  Object.values(cart.value).map(item => ({
    ...item,
    price: Number(item.price),
  }))
)

const cartTotal = computed(() =>
  cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
)

// Customer info
const customerName = ref(customer.value.name || '')
const customerEmail = ref(customer.value.email || '')
const customerPhone = ref(customer.value.phone || '')
const customerAddress = ref(customer.value.address || '')

// Validation errors
const errors = ref<Record<string, string>>({})

// Back button
const goBack = () => {
  if (history.length > 1) history.back()
  else router.visit('/')
}

// Submit payment
function proceedPayment() {
  errors.value = {}
  const phoneEl = document.querySelector(
    'input[name="customer_phone"]'
  ) as HTMLInputElement | null

  customerPhone.value = phoneEl?.value || ''

  if (!customerName.value) errors.value.name = 'Sila isi nama anda'
  if (!customerPhone.value) errors.value.phone = 'Sila isi nombor telefon'
  if (!customerAddress.value) errors.value.address = 'Sila isi alamat'

  if (Object.keys(errors.value).length > 0) return

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
    <div class="min-h-screen bg-gray-100 space-y-3 p-2 pb-24 ">

      <!-- Back + Heading -->
      <div class="flex items-center gap-3 mb-4">
        <button @click="goBack" class="rounded-full hover:bg-gray-200 transition">
          <ChevronLeft size="20" />
        </button>
        <h2 class="text-lg font-bold ">Maklumat Tempahan</h2>
      </div>

      <!-- Cart List -->
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

        <div class="border-t  pt-2 text-right font-bold text-red-600">
          Jumlah: RM {{ cartTotal.toFixed(2) }}
        </div>
      </div>

      <!-- Customer Info -->
      <div class="bg-white rounded-xl shadow p-4 space-y-4">
        <h3 class="font-semibold">Maklumat Pelanggan</h3>

        <div>
          <label class="block font-medium text-sm mb-1">Nama</label>
          <input
            type="text"
            v-model="customerName"
            class="w-full border  rounded-lg p-2"
            placeholder="Name"
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">
            {{ errors.name }}
          </p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Nombor Telefon</label>
          <PhoneInput
            id="phone"
            type="phone"
            name="customer_phone"
            required
            autofocus
            :tabindex="1"
            class=" "
            placeholder="eg. 012-73456789"
          />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">
            {{ errors.phone }}
          </p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Email</label>
          <input
            type="email"
            v-model="customerEmail"
            class="w-full border  rounded-lg p-2"
            placeholder="Email"
          />
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Alamat</label>
          <textarea
            v-model="customerAddress"
            class="w-full border  rounded-lg p-2"
            rows="3"
            placeholder="Alamat"
          ></textarea>
          <p v-if="errors.address" class="text-red-500 text-xs mt-1">
            {{ errors.address }}
          </p>
        </div>
      </div>

      <!-- Payment Method -->
      <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-semibold mb-2">Pilih Kaedah Pembayaran</h3>
        <div class="flex flex-col gap-2">
          <label
            v-for="channel in page.props.channels"
            :key="channel.id"
            class="flex items-center gap-2"
          >
            <input type="radio" :value="channel.id" v-model="paymentMethod" />
            {{ channel.name }}
          </label>
        </div>
      </div>

      <!-- Proceed Button -->
      <button
        class="fixed bottom-4 left-4 right-4 bg-black text-white py-3 rounded-xl font-bold text-md hover:bg-yellow-600 transition "
        @click="proceedPayment"
      >
        Bayar Sekarang (RM {{ cartTotal.toFixed(2) }})
      </button>

    </div>
  </StoreLayout>
</template>
