<template>
  <div class="min-h-screen px-4 py-6">
    <div class="text-center">
      <img
        v-if="store.store_logo_url"
        :src="store.store_logo_url"
        class="mx-auto h-24 w-24 rounded-full"
      />

      <h1 class="mt-4 text-xl font-bold">{{ store.name }}</h1>

      <div
        v-if="store.description"
        v-html="store.description"
        class="mt-2 text-gray-600"
      />
    </div>

    <!-- Linktree links -->
    <div class="mt-6 space-y-3">
      <a
        v-for="(link, i) in store.links"
        :key="i"
        :href="link.url"
        target="_blank"
        class="block rounded-full py-3 text-center text-white"
        :style="{ backgroundColor: store.theme?.primary || '#000' }"
      >
        {{ link.label }}
      </a>
    </div>

    <!-- Products -->
    <div class="mt-10">
      <slot />
    </div>
  </div>
</template>

<script setup>
defineProps({ store: Object })
</script>
