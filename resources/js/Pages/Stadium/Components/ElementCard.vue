<template>
    <div class="w-full ringed rounded h-40 grid place-items-center text-600 bg-gray-100 cursor-pointer hover:opacity-90">
        <h4 class="text_34 font-play font-bold opacity-80 text-center">{{ element.name }}</h4>
    </div>
</template>
<script setup>
defineProps(['element']);
</script>