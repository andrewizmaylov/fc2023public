<template>
    <section class="flex items-center space-x-8 opacity_80 text-[8px] uppercase mb-2 font-bold tracking-wide"
             v-if="$page.props?.is_admin">
        <h6 class="text-blue-400 dark:text-white hover:text-blue-500 hover:dark:text-blue-500 cursor-pointer"
            @click="editModel(element, route)">
            {{ $t('edit_button') }}
        </h6>
        <h6 class="text_ld">
            [ {{ element.published_at ? $t('was_published') : $t('was_unpublished') }} ]
        </h6>
    </section>
</template>
<script setup>
import {computed} from 'vue';
import {editModel} from '@/Pages/Shared/helpers.js';
import {model_route} from '@/Pages/Shared/useForms.js';

const props = defineProps(['model', 'element']);
const route = computed(() => model_route(props.model.toLowerCase()));
</script>