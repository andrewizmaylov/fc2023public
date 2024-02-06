<template>
    <Head :title="$t('pages.merch')" />
	
    <section class="mb-12">
        <h1 class="text_34 font-play font-bold opacity-80 uppercase mb-4 text_ld">{{ $t('pages.merch') }}</h1>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8"
             v-if="output?.length">
            <section v-for="product in output"
                     :key="product.id">
                <EditElementComponent :model="MODEL"
                                      :element="product"/>
                <ProductCard :product="product"
                             class="group relative" />
            </section>
        </div>
    </section>
</template>

<script setup>
import {Head} from '@inertiajs/vue3';
import {ref, onMounted, computed} from 'vue';
import ProductCard from '@/Pages/Merch/Components/ProductCard.vue';
import EditElementComponent from '@/Pages/Shared/EditElementComponent.vue';

const props = defineProps(['merch']);
const MODEL = 'Merch';

let list = ref([]);
onMounted(() => {
    axios.get(route('get_merch')).then(response => list.value = response.data);
});

let output = computed(() => props.merch ?? list.value);

    // {
    //     id: 1,
    //     name: 'Basic Tee',
    //     href: '#',
    //     slug: 'basic_tee',
    //     imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
    //     imageAlt: 'Front of men\'s Basic Tee in black.',
    //     price: '$35',
    //     color: 'Black',
    // },

</script>