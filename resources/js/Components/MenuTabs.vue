<template>
    <section class="flex items-center space-x-4 my-6 overflow-auto">
        <span class="cursor-pointer shrink-0"
              :class="tab_selected === tab.id ? 'btn_main btn_ld':'btn_ld_border'"
              v-for="tab in tabs"
              :key="tab.id"
              v-show="tab.show"
              @click="selectTab(tab)">{{ tab.name }}</span>
    </section>
</template>
<script setup>
import {router} from '@inertiajs/vue3';
defineProps(['tabs', 'tab_selected', 'model']);
let emit = defineEmits(['update_selected']);
function selectTab(tab) {
    if (tab.props) {
        emit('update_selected', tab);
    } else {
        router.get(route(tab.route));
    }
}
</script>

