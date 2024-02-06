<template>
    <section class="flex items-center justify-between">
        <h1 class="text_34 font-play font-bold opacity-80 uppercase my-4 text_ld">{{ $t('pages.'+model.toLowerCase())}}</h1>
        <Link class="btn_interface_blue btn_interface_rectangle text_14"
              :href="route(model_route(model.toLowerCase()) + '.index')">{{ $t('pages.'+model.toLowerCase())}}: {{ $t('all_button') }}
        </Link>
    </section>
</template>
<script setup>
import {model_route} from '@/Pages/Shared/useForms.js';
import {Link} from '@inertiajs/vue3';
defineProps(['model']);
</script>