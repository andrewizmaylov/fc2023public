<template>
    <section>
        <span class="btn_main btn_ld my-6 cursor-pointer"
              @click="confirmOrder">
            {{ button_title }}
        </span>
        <section v-if="show_login_prompt"
                 class="flex items-center spase-x-2 mt-4">
            <p class="text_ld"
               v-html="$t('login_prompt')"/>
            <span class="btn_ld btn_main cursor-pointer"
                  @click="router.get(route('login'))">{{ $t('auth.login')}}</span>
        </section>
    </section>
</template>
<script setup>
import {ref} from 'vue';
import {router} from '@inertiajs/vue3';
import {page} from '@/Pages/Shared/helpers.js';
const emits = defineEmits(['update_info']);
let show_login_prompt = ref(false);
defineProps(['button_title']);

function confirmOrder() {
    if (! page.props?.auth?.user?.id) {
        show_login_prompt.value = true;
    } else {
        emits('update_info');
    }
}
</script>