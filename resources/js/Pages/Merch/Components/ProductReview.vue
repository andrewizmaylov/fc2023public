<template>
    <div class="mt-4">
        <h2 class="sr-only">{{ $t('merch.reviews') }}</h2>
        <div class="flex items-center">
            <p class="text-sm text_ld opacity-80">
                {{ product.rating }}
                <span class="sr-only"> out of 5 stars</span>
            </p>
            <div class="ml-1 flex items-center">
                <StarIcon v-for="rating in [0, 1, 2, 3, 4]"
                          :key="rating"
                          :class="[product.rating > rating ? 'text-yellow-400' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']"
                          aria-hidden="true" />
            </div>
            <div aria-hidden="true"
                 class="ml-4 text-sm text-gray-300">·</div>
            <div class="ml-4 flex">
                <a href="#"
                   class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $t('merch.all_reviews') }}</a>
            </div>
        </div>
    </div>
</template>
<script setup>
import {StarIcon} from '@heroicons/vue/20/solid/index.js';

defineProps(['product']);
</script>