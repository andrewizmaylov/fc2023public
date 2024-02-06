<script setup>
import {Link} from '@inertiajs/vue3';
import {product_price} from '@/Pages/Merch/Composables/useMerch.js';

defineProps({
    product: {
        type: Object,
        required: true
    }
});
</script>
<template>
    <section class="text_ld">
        <div class="w-full overflow-hidden rounded-md group-hover:opacity-75 lg:h-80 h-60 ringed shadow grid place-items-center p-1 bg-white">
            <img :src="product.image_url"
                 :alt="product.imageAlt"
                 class="h-auto w-full object-cover object-center"/>
        </div>
        <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm opacity-75">
                    <Link :href="route('merch.show', {slug: product.slug})">
                        <span aria-hidden="true"
                              class="absolute inset-0"/>
                        {{ product.name }}
                    </Link>
                </h3>
                <p class="mt-1 text-sm opacity-50">{{ product.color }}</p>
            </div>
            <p class="text-sm font-medium opacity-90">{{ product_price(product) }}</p>
        </div>
    </section>
</template>
