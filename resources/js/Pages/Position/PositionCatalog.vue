<template>
    <div class="text_ld font-play">
        <h1 class="header_34">{{ $t('partners.position_header') }}</h1>
        <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
            <section aria-labelledby="cart-heading"
                     class="lg:col-span-7">
                <h2 id="cart-heading"
                    class="sr-only">{{ ('partners.selected') }}</h2>
					
                <ul role="list"
                    class="divide-y divide-gray-200 border-b border-t border-gray-200">
                    <PositionCard v-for="position in positions"
                                  :position="position"
                                  :key="position.id" />
                </ul>
            </section>
				
            <!-- Order summary -->
            <OrderSummary :items="positions"
                          :order_rules="order_rules"/>
        </form>
    </div>

</template>
<script setup>
import PositionCard from '@/Pages/Position/Components/PositionCard.vue';
import OrderSummary from '@/Pages/Position/OrderSummary.vue';


const order_rules = {
    delivery: {
        active: false,
        value: 0,
        coefficient: .005,
        text: 'Правила расчета стоимости доставки',
    },
    taxes: {
        active: false,
        value: 0,
        coefficient: .2,
        text: 'Правила расчета налогов',
    }
};

defineProps(['positions']);
</script>