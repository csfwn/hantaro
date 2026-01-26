<script setup lang="ts">
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import StoreLayout from "@/layouts/StoreLayout.vue";
import { ChevronLeft } from 'lucide-vue-next';

const page = usePage();

// Cart info from backend
const cart = computed(() => page.props.cart || {});
const cartItems = computed(() =>
  Object.values(cart.value).map(item => ({
    ...item,
    price: Number(item.price), // ensure number
  }))
);

// Cart total
const cartTotal = computed(() =>
  cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
);

// Cart quantity
const cartQuantity = computed(() =>
  cartItems.value.reduce((sum, item) => sum + item.quantity, 0)
);

// Payment method
const paymentMethod = ref<'cash' | 'qr'>('cash');

// Customer info
const customerName = ref('');
const customerPhone = ref('');
const customerAddress = ref('');

// Validation errors
const errors = ref<any>({});

// Smart go back function
const goBack = () => {
  if (history.length > 1) history.back();
  else router.visit('/');
};

// Submit payment
function proceedPayment() {
  errors.value = {}; // reset errors

  if (!customerName.value) errors.value.name = 'Sila isi nama anda';

  // Phone validation: required + start with 60 + 8–13 digits
  if (!customerPhone.value) {
    errors.value.phone = 'Sila isi nombor telefon';
  } else if (!/^60\d{8,13}$/.test(customerPhone.value)) {
    errors.value.phone = 'Nombor telefon mesti bermula dengan 60 dan mengandungi 8–13 digit';
  }

  if (!customerAddress.value) errors.value.address = 'Sila isi alamat';

  if (Object.keys(errors.value).length > 0) return;

  router.post(route('checkout.process'), {
    payment_method: paymentMethod.value,
    customer_name: customerName.value,
    customer_phone: customerPhone.value,
    customer_address: customerAddress.value,
    items: cartItems.value.map(item => ({
      product_id: item.id,
      quantity: item.quantity,
    })),
  });
}
</script>

<template>
  <StoreLayout title="Hantaro - Review Cart">
    <div class="min-h-screen bg-gray-100 space-y-3 p-2 pb-24">
      <!-- Back + Heading -->
      <div class="flex items-center gap-3 mb-4">
        <button @click="goBack" class="rounded-full hover:bg-gray-200 transition">
          <ChevronLeft size="20" />
        </button>
        <h2 class="text-lg font-bold">Maklumat Tempahan</h2>
      </div>

      <!-- Cart List -->
      <div class="bg-white rounded-xl shadow p-4 space-y-3">
        <div v-for="item in cartItems" :key="item.id" class="flex justify-between items-center">
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

      <!-- Customer Info Form -->
      <div class="bg-white rounded-xl shadow p-4 space-y-4">
        <h3 class="font-semibold">Maklumat Pelanggan</h3>

        <div>
          <label class="block font-medium text-sm mb-1">Nama</label>
          <input type="text" v-model="customerName" class="w-full border rounded-lg p-2" />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Nombor Telefon</label>
          <input type="text" v-model="customerPhone" class="w-full border rounded-lg p-2"
            placeholder="Contoh: 60123456789" />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone }}</p>
        </div>

        <div>
          <label class="block font-medium text-sm mb-1">Alamat</label>
          <textarea v-model="customerAddress" class="w-full border rounded-lg p-2" rows="3"></textarea>
          <p v-if="errors.address" class="text-red-500 text-xs mt-1">{{ errors.address }}</p>
        </div>
      </div>

      <!-- Payment Method -->
      <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-semibold mb-2">Pilih Kaedah Pembayaran</h3>
        <div class="flex gap-4">
          <label class="flex items-center gap-2">
            <input type="radio" value="cash" v-model="paymentMethod" />
            Tunai
          </label>

          <label class="flex items-center gap-2">
            <input type="radio" value="qr" v-model="paymentMethod" />
            QR Code
          </label>
        </div>
      </div>

      <!-- Proceed Button -->
      <button
        class="fixed bottom-4 left-4 right-4 bg-primary text-white py-3 rounded-xl font-bold text-md hover:bg-yellow-600 transition flex items-center justify-center gap-2"
        @click="proceedPayment">
        <!-- WhatsApp image -->
        <img src="/images/whatsapp.png" alt="WhatsApp" class="w-5 h-5" />
        Hantar ke Whatsapp
      </button>
    </div>

  </StoreLayout>
</template>
