<template>
  <div class="min-h-screen bg-white">
    <header class="p-4 border-b">
      <h1 class="text-xl font-bold">{{ store.name }}</h1>
    </header>

    <div class="p-4">
      <slot />
    </div>
  </div>
</template>

<script setup>
defineProps({ store: Object })
</script>
