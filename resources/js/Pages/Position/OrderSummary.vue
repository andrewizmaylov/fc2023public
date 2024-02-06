<template>
    <section aria-labelledby="summary-heading"
             class="mt-16 rounded-lg bg_contrast px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
        <h2 id="summary-heading"
            class="text-lg font-medium">{{ $t('partners.order_summary') }}</h2>
		
        <dl class="mt-6 space-y-4">
            <div class="flex items-center justify-between"
                 v-if="order_rules.delivery.active || order_rules.taxes.active">
                <dt class="text-sm text-gray-600">{{ $t('partners.subtotal') }}</dt>
                <dd class="text-sm font-medium">{{ order_summary }}</dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4"
                 v-if="order_rules.delivery.active">
                <dt class="flex items-center text-sm text-gray-600">
                    <span>{{ $t('partners.shipping_estimate') }}</span>
                    <a href="#"
                       class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">{{ $t('partners.learn_more_shipping') }}</span>
                        <QuestionMarkCircleIcon class="h-5 w-5"
                                                aria-hidden="true"/>
                    </a>
                </dt>
                <dd class="text-sm font-medium">{{ shipping_estimate }}</dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4"
                 v-if="order_rules.taxes.active">
                <dt class="flex text-sm text-gray-600">
                    <span>{{ $t('partners.tax_estimate') }}</span>
                    <a href="#"
                       class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">{{ $t('partners.learn_more_tax') }}</span>
                        <QuestionMarkCircleIcon class="h-5 w-5"
                                                aria-hidden="true"/>
                    </a>
                </dt>
                <dd class="text-sm font-medium">{{ tax_estimate }}</dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                <dt class="text-base font-medium">{{ $t('partners.order_total') }}</dt>
                <dd class="text-base font-medium">{{ order_total }}</dd>
            </div>
        </dl>

        <section class="flex items-center justify-between">
            <SubmitWithLoginPrompt :button_title="$t('partners.checkout')"
                                   @update_info="placeOrder"/>
            <span class="text-green-500 text_12"
                  v-if="success">{{ message }}</span>
        </section>
    </section>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {computed, ref} from 'vue';
import { QuestionMarkCircleIcon } from '@heroicons/vue/20/solid';
import useOrderComposable from '@/Pages/Order/Composables/useOrderComposable.js';
import SubmitWithLoginPrompt from '@/Pages/Shared/SubmitWithLoginPrompt.vue';
import {page} from '@/Pages/Shared/helpers.js';
let {current_order_list} = useOrderComposable();
const props = defineProps(['items', 'order_rules']);

let {t} = useI18n();

let order_summary = computed(() => {
    let sum = 0;
    current_order_list.value?.forEach(id => {
        sum += props.items.find(item => item.id === id)?.details?.price ?? 0;
    });
    return sum;
});

let shipping_estimate = computed(() => {
    let sum = 0;
    if (!props.order_rules.taxes.delivery) return sum;
	
    current_order_list.value?.forEach(id => {
        sum += (props.items.find(item => item.id === id)?.details?.price) * props.order_rules.delivery.coefficient + props.order_rules.delivery.value;
    });
	
    return sum;
});

let tax_estimate = computed(() => {
    let sum = 0;
    if (!props.order_rules.taxes.active) return sum;
	
    current_order_list.value?.forEach(id => {
        sum += (props.items.find(item => item.id === id)?.details?.price) * props.order_rules.taxes.coefficient + props.order_rules.taxes.value;
    });
	
    return sum;
});

let order_total = computed(() => {
    return order_summary.value + shipping_estimate.value + tax_estimate.value;
});


let success = ref(false);
let message = ref('');

function showMessage(msg) {
    message.value = msg;
    success.value = true;
    setTimeout(() => success.value = false, 3000);
}

const placeOrder = () => {
    if (current_order_list.value.length === 0) {
        showMessage(t('partners.select_before_place_order'));
        return;
    }
	
    axios.post(route('sponsorships.store'), {
        user_id: page.props.auth.user.id,
        details: current_order_list.value,
    }).then(() => {
        showMessage(t('success'));
    });
};
</script>