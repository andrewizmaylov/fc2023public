<template>
    <form>
        <!-- Color picker -->
        <div v-if="product?.details?.colors">
            <h2 class="text-sm font-medium text-gray-900">{{ $t('merch.colors') }}</h2>
			
            <RadioGroup v-model="selectedColor"
                        class="mt-2">
                <RadioGroupLabel class="sr-only">{{ $t('merch.choose_color') }}</RadioGroupLabel>
                <div class="flex items-center space-x-3">
                    <RadioGroupOption as="template"
                                      v-for="color in colors"
                                      :key="color.name"
                                      :value="color"
                                      v-slot="{ active, checked }">
                        <div :class="[
                            color.selectedColor, active && checked ? 'ring ring-offset-1' : '',
                            !active && checked ? 'ring-2' : '',
                            'relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none'
                        ]">
                            <RadioGroupLabel as="span"
                                             class="sr-only">{{ color.name }}</RadioGroupLabel>
                            <span aria-hidden="true"
                                  :class="[color.bgColor, 'h-8 w-8 rounded-full border border-black border-opacity-10']" />
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
		
        <!-- Size picker -->
        <div class="mt-8"
             v-if="product?.details?.sizes">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-medium text-gray-900">{{ $t('merch.size') }}</h2>
                <a href="#"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $t('merch.sizes') }}</a>
            </div>
			
            <RadioGroup v-model="selectedSize"
                        class="mt-2">
                <RadioGroupLabel class="sr-only">{{ $t('merch.choose_size') }}</RadioGroupLabel>
                <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
                    <RadioGroupOption as="template"
                                      v-for="size in sizes"
                                      :key="size.name"
                                      :value="size"
                                      :disabled="!size.inStock"
                                      v-slot="{ active, checked }">
                        <div :class="[
                            size.inStock ?  'cursor-pointer focus:outline-none' : 'cursor-not-allowed opacity-25',
                            active ? 'ring-2 ring-indigo-500 ring-offset-2' : '',
                            checked ? 'border-transparent bg-indigo-600 text-white hover:bg-indigo-700' : 'border-gray-200 bg-white text-gray-900 hover:bg-gray-50',
                            'flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase sm:flex-1'
                        ]">
                            <RadioGroupLabel as="span">{{ size.name }}</RadioGroupLabel>
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
		
        <section class="flex items-center justify-between">
            <SubmitWithLoginPrompt :button_title="$t('merch.add_chart')"
                                   @update_info="placeOrder"/>
            <span class="text-green-500 text_12"
                  v-if="success">{{ $t('success') }}</span>
        </section>
    </form>
</template>
<script setup>
import {ref} from 'vue';
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue';
import {page} from '@/Pages/Shared/helpers.js';
import SubmitWithLoginPrompt from '@/Pages/Shared/SubmitWithLoginPrompt.vue';
const props = defineProps(['product']);

let colors = [
    { name: 'Black', bgColor: 'bg-gray-900', selectedColor: 'ring-gray-900' },
    { name: 'Heather Grey', bgColor: 'bg-gray-400', selectedColor: 'ring-gray-400' },
];
let sizes = [
    { name: 'XXS', inStock: true },
    { name: 'XS', inStock: true },
    { name: 'S', inStock: true },
    { name: 'M', inStock: true },
    { name: 'L', inStock: true },
    { name: 'XL', inStock: false },
];

const selectedColor = ref(colors[0]);
const selectedSize = ref(sizes[2]);

let success = ref(false);
const placeOrder = () => {
    axios.post(route('orders.store'), {
        user_id: page.props.auth.user.id,
        merch_id: props.product.id,
    }).then(() => {
        success.value = true;
        setTimeout(() => success.value = false, 3000);
    });
};

</script>
