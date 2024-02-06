<template>
    <Head :title="$t('pages.order')" />
	
    <div class="p-6 text_ld font-play">
        <BreadCrumbs :breadcrumbs="breadcrumbs"
                     :element="appointment" />
		
        <div class="mt-6">
            <h6 class="text_12 mb-1">{{$t('merch.order_date')}}{{ getHumanDate(appointment) }}</h6>
            <OrderUserForm :user="appointment.user"/>
        </div>
    </div>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {Head} from '@inertiajs/vue3';
import BreadCrumbs from '@/Pages/Shared/BreadCrumbs.vue';
import useDateComposable from '@/Pages/News/Composables/useDateComposable.js';
import OrderUserForm from '@/Pages/Order/Components/OrderUserForm.vue';
const {t} = useI18n();

const props = defineProps(['appointment']);
let {getHumanDate} = useDateComposable(props.appointmint);
const breadcrumbs = [
    { id: 1, name: t('pages.appointment'), href: 'appointments.index' },
];

</script>