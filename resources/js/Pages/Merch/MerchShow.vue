<template>
    <div class="p-6 text_ld font-play">
        <BreadCrumbs :breadcrumbs="breadcrumbs"
                     :element="input"
                     :model="'Merch'"/>

        <div class="lg:grid lg:auto-rows-min lg:grid-cols-12 lg:gap-x-8 mt-6">
            <div class="lg:col-span-5 lg:col-start-8">
                <div class="flex justify-between text_ld">
                    <h1 class="text-xl font-medium">{{ input.name }}</h1>
                    <p class="text-xl font-medium">{{ product_price(input) }}</p>
                </div>
                <!-- Product details -->
                <div class="mt-1">
                    <h2 class="text-sm font-medium text_ld sr-only">{{ $t('form_base.description') }}</h2>

                    <div class="prose prose-sm mt-4 text_ld opacity-80"
                         v-html="input.description" />
                </div>
                <!-- Reviews -->
                <ProductReview :product="input"
                               v-if="input?.reviews?.length"/>
            </div>
					
            <!-- Image gallery -->
            <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                <h2 class="sr-only">{{ $t('merch.images') }}</h2>
						
                <div class="bg-white rounded overflow-hidden grid place-items-center mb-6 cursor-pointer"
                     @click="setDefaultImage">
                    <img :src="input.image_url"
                         alt="merchImage"
                         id="merchImage">
                </div>
                <ImageSlider :images="input.details.images"
                             v-if="input?.details?.images?.length"/>
            </div>
					
            <div class="mt-8 lg:col-span-5">
                <MerchForm :product="input" />
            </div>
        </div>
    </div>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {onMounted, ref} from 'vue';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';
import {product_price} from '@/Pages/Merch/Composables/useMerch.js';
import ProductReview from '@/Pages/Merch/Components/ProductReview.vue';
import ImageSlider from '@/Pages/Shared/ImageSlider.vue';
import MerchForm from '@/Pages/Merch/Components/MerchForm.vue';
import {cloud_path} from '@/Pages/Shared/helpers.js';
const {t} = useI18n();

const breadcrumbs = [
    { id: 1, name: t('pages.merch'), href: 'club.merch_index' },
];

const props = defineProps(['input']);

let timeout = ref(null);
function setDefaultImage() {
    clearTimeout(timeout.value);
    document.getElementById('merchImage').src = props.input.image_url;
}
onMounted(() => {
    Event.on('load_image_to_preview', (image) => {
        clearTimeout(timeout.value);
        document.getElementById('merchImage').src = cloud_path + image.link;
        timeout.value = setTimeout(() => setDefaultImage(), 5000);
    });
});
</script>