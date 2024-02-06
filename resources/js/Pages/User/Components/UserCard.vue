<template>
    <div class="ringed px-3">
        <div class="aspect-w-1 aspect-h-1 rounded-full overflow-hidden mx-auto shrink-0 m-[14px] ringed shadow">
            <img class=" w-full h-full object-cover"
                 :src="user.profile_photo_url"
                 alt="avatar">

        </div>

        <section class="text-center text_ld">
            <h5 class="text_16 font-semibold">{{ full_name }}</h5>
            <h6 class="text_11 uppercase"
                v-if="user?.roles?.length">{{ user?.roles[0]?.full_name }}</h6>
        </section>

    </div>
</template>
<script setup>
import {computed} from 'vue';

const props = defineProps(['user']);
let full_name = computed(() => (props.user?.contact?.first_name ?? 'john') +' '+ (props.user?.contact?.last_name ?? 'dow'));
</script>