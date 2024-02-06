<template>
    <Head :title="$t('pages.order')" />
	
    <div class="p-6 text_ld font-play">
        <BreadCrumbs :breadcrumbs="breadcrumbs"
                     :element="order.merch" />
		
        <div class="lg:grid lg:auto-rows-min lg:grid-cols-12 lg:gap-x-8 mt-6">
            <div class="lg:col-span-5 lg:col-start-8">
                <div class="flex justify-between text_ld">
                    <h1 class="text-xl font-medium">{{ order.merch.name }}</h1>
                    <p class="text-xl font-medium">{{ product_price(order.merch) }}</p>
                </div>
                <h6 class="text_12 mb-1">{{$t('merch.order_date')}}{{ getHumanDate(order) }}</h6>
                <OrderUserForm :user="order.user"/>
            </div>
			
            <!-- Image gallery -->
            <div class="mt-8 lg:col-span-7 lg:col-start-1 lg:row-span-3 lg:row-start-1 lg:mt-0">
                <h2 class="sr-only">{{ $t('merch.images') }}</h2>
				
                <div class="bg-white rounded overflow-hidden grid place-items-center mb-6 cursor-pointer">
                    <img :src="order.merch.image_url"
                         alt="merchImage"
                         id="merchImage">
                </div>
            </div>
			
            <div class="mt-8 lg:col-span-5">
            
            </div>
        </div>
    </div>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {Head, Link} from '@inertiajs/vue3';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';
import {product_price} from '../Merch/Composables/useMerch.js';
import OrderUserForm from '@/Pages/Order/Components/OrderUserForm.vue';
import useDateComposable from '@/Pages/News/Composables/useDateComposable.js';
const {t} = useI18n();

const props = defineProps(['order']);
let {getHumanDate} = useDateComposable(props.order);
const breadcrumbs = [
    { id: 1, name: t('pages.order'), href: 'orders.index' },
];

</script>