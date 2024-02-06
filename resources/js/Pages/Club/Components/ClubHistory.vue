<template>
    <TextEditor :input="club"
                :model="MODEL"
                v-if="page.props.is_admin"/>
	
    <p v-html="htmlOutput(club.text.schema)"
       class="max-w-[800px]"
       v-else/>
</template>
<script setup>

import TextEditor from '@/Pages/Shared/TextEditor.vue';
import {htmlOutput} from '@/Pages/Utilities/HtmlOutput.js';
import {page} from '@/Pages/Shared/helpers.js';

defineProps(['club']);
const MODEL = 'Club';
</script>