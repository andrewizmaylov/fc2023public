<template>
    <nav aria-label="Breadcrumb"
         class="text_ld">
        <ol role="list"
            class="flex items-center space-x-4">
            <li v-for="breadcrumb in breadcrumbs"
                :key="breadcrumb.id">
                <div class="flex items-center">
                    <span @click="proceedUrl(breadcrumb)"
                          class="mr-4 text-sm font-medium cursor-pointer">{{ breadcrumb.name }}</span>
                    <svg viewBox="0 0 6 20"
                         aria-hidden="true"
                         class="h-5 w-auto text-gray-300">
                        <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z"
                              fill="currentColor" />
                    </svg>
                </div>
            </li>
            <li class="text-sm mr-4">
                <span aria-current="page"
                      class="font-medium opacity-80">{{ name }}</span>
            </li>
            <li class="text-sm flex items-center"
                v-if="$page.props?.is_admin && model">
                <svg viewBox="0 0 6 20"
                     aria-hidden="true"
                     class="h-5 w-auto text-gray-300">
                    <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z"
                          fill="currentColor" />
                </svg>
                <h6 class="text-blue-400 dark:text-white hover:text-blue-500 hover:dark:text-blue-500 cursor-pointer  ml-4"
                    @click="editModel(element, model)">
                    {{ $t('edit_button') }}
                </h6>
            </li>
        </ol>
    </nav>
</template>
<script setup>
import {editModel, page, proceedUrl} from '@/Pages/Shared/helpers.js';
import {computed, ref, onMounted} from 'vue';
const props = defineProps(['breadcrumbs', 'element', 'model']);

let name = computed(() => {
    return props.model === 'games' ?
        props?.element?.first_team?.name + ' | ' + props?.element?.second_team?.name :
        props?.element?.name;
});


</script>