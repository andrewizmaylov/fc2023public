<template>
    <Head :title="$t('pages.fans')" />
	
    <section class="p-6 font-play">
        <h6 class="header_68">{{ $t('pages.fans') }}</h6>
        <MenuTabs :tabs="tabs"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>

        <FansInfo v-if="tab_selected === 1"/>

        <FAQ v-if="tab_selected === 2"/>

        <FansMerch v-if="tab_selected === 3"/>
    </section>
</template>
<script setup>
import {Head} from '@inertiajs/vue3';
import {useI18n} from 'vue-i18n';
import {onMounted, ref} from 'vue';
import MenuTabs from '@/Components/MenuTabs.vue';
import FansInfo from '@/Pages/Stadium/Components/FansInfo.vue';
import FansMerch from '@/Pages/Fans/FansMerch.vue';
import FAQ from '@/Pages/Fans/FAQ.vue';
import {defineTab} from '@/Pages/Shared/helpers.js';

const props = defineProps(['defined_tab']);

const {t} = useI18n();
const tabs = [
    {id: 1, name: t('tabs.fans_info'), show: true, route: 'club.fans_info'},
    {id: 2, name: t('tabs.faq'), show: true, route: 'club.faq'},
    {id: 3, name: t('pages.merch'), show: true, route: 'club.merch_index'},
];
let tab_selected = ref(3);
function updateSelected(e) {
    tab_selected.value = e.id;
}

onMounted(() => {
    tab_selected.value = defineTab(tabs, props.defined_tab);
});
</script>