<template>
    <Head :title="$t('pages.partners')" />
	
    <section class="p-6 font-play">
        <h6 class="header_68">{{ $t('pages.partners') }}</h6>
        <MenuTabs :tabs="tabs"
                  :tab_selected="tab_selected"
                  @update_selected="updateSelected"/>
	    
        <ClubPresentation v-if="tab_selected === 1"/>
	    
        <PositionCatalog :positions="positions"
                         v-if="tab_selected === 2" />
		
    </section>
<!--    <div class="p-4">-->
<!--        <section class="grid grid-cols-2 gap-4">-->
<!--            <PositionCard class="col-span-1 cursor-pointer"-->
<!--                          @click="router.get(route('positions.edit', {slug: position.slug}))"-->
<!--                          v-for="position in positions"-->
<!--                          :key="position.id"-->
<!--                          :position="position"/>-->
<!--        </section>-->
<!--		-->
<!--        <section class="mt-6 flex w-full">-->
<!--            <Link class="btn_main btn_ld ml-auto"-->
<!--                  :href="route('positions.create')">{{ $t('create_button') }}</Link>-->
<!--        </section>-->
<!--    </div>-->
</template>
<script setup>
import {useI18n} from 'vue-i18n';
import {Head, Link, router} from '@inertiajs/vue3';
import PositionCard from '@/Pages/Position/Components/PositionCard.vue';
import MenuTabs from '@/Components/MenuTabs.vue';

import {onMounted, ref} from 'vue';
import ClubPresentation from '@/Pages/Shared/ClubPresentation.vue';
import {defineTab} from '@/Pages/Shared/helpers.js';
import PositionCatalog from '@/Pages/Position/PositionCatalog.vue';

const props = defineProps(['positions', 'defined_tab']);
const {t} = useI18n();
const tabs = [
    {id: 1, name: t('tabs.partners_presentation'), show: true, route: 'club.partners_presentation'},
    {id: 2, name: t('tabs.catalog'), show: true, route: 'club.partners_catalog'},
    // {id: 2, name: t('tabs.faq'), show: true},
];
let tab_selected = ref(1);
function updateSelected(e) {
    tab_selected.value = e.id;
}

onMounted(() => {
    tab_selected.value = defineTab(tabs, props.defined_tab);
});
</script>