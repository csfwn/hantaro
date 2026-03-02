<script lang="ts" setup>
import { ref, watch } from 'vue'
import PhoneInput from 'base-vue-phone-input'
import { Input } from '@/components/ui/input'
import { useFocus } from '@vueuse/core'
import { ChevronsUpDown } from 'lucide-vue-next'
import FlagComponent from '@/components/FlagComponent.vue'
import { Button } from '@/components/ui/button'

/* =========================
   PROPS & EMITS
========================= */
const props = defineProps<{
  modelValue?: string
  name?: string
  placeholder?: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

/* =========================
   STATE
========================= */
const open = ref(false)
const phoneInput = ref(null)
const { focused } = useFocus(phoneInput)

// INTERNAL VALUE (E.164)
const e164PhoneNumber = ref(props.modelValue || '')

/* =========================
   SYNC FROM PARENT → CHILD
========================= */
watch(
  () => props.modelValue,
  (val) => {
    if (val !== e164PhoneNumber.value) {
      e164PhoneNumber.value = val || ''
    }
  }
)

/* =========================
   SYNC FROM CHILD → PARENT
========================= */
watch(e164PhoneNumber, (val) => {
  emit('update:modelValue', val)
})

/* =========================
   UI IMPORTS
========================= */
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'

import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
} from '@/components/ui/command'
</script>

<template>
  <div>
    <!-- Hidden input for backend -->
    <input
      v-if="name"
      type="hidden"
      :name="name"
      :value="e164PhoneNumber"
    />

    <PhoneInput
      noUseBrowserLocale
      fetchCountry
      country-locale="ms-MY"
      country-code="MY"
      class="flex"
      :ignored-countries="['AC']"
      @update="(data) => (e164PhoneNumber = data.e164 ?? '')"
    >
      <!-- COUNTRY SELECT -->
      <template #selector="{ inputValue, updateInputValue, countries }">
        <Popover v-model:open="open">
          <PopoverTrigger>
            <Button
              type="button"
              variant="outline"
              class="flex gap-1 rounded-e-none rounded-s-lg px-3"
            >
              <FlagComponent :country="inputValue" />
              <ChevronsUpDown class="h-4 w-4 opacity-50" />
            </Button>
          </PopoverTrigger>

          <PopoverContent class="w-[300px] p-0">
            <Command>
              <CommandInput placeholder="Search country..." />
              <CommandEmpty>No country found.</CommandEmpty>

              <CommandList>
                <CommandGroup>
                  <CommandItem
                    v-for="option in countries"
                    :key="option.iso2"
                    @select="() => {
                      updateInputValue(option.iso2)
                      open = false
                      focused = true
                    }"
                    class="gap-2"
                  >
                    <FlagComponent :country="option.iso2" />
                    <span class="flex-1 text-sm">
                      {{ option.name }}
                    </span>
                    <span class="text-muted-foreground text-sm">
                      {{ option.dialCode }}
                    </span>
                  </CommandItem>
                </CommandGroup>
              </CommandList>
            </Command>
          </PopoverContent>
        </Popover>
      </template>

      <!-- PHONE INPUT -->
      <template #input="{ inputValue, updateInputValue, placeholder: defaultPlaceholder }">
        <Input
          ref="phoneInput"
          class="rounded-e-lg rounded-s-none"
          type="tel"
          :model-value="inputValue"
          @input="updateInputValue"
          :placeholder="placeholder ?? defaultPlaceholder"
        />
      </template>
    </PhoneInput>
  </div>
</template>
