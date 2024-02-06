<template>
    <div class="mt-8 flow-root text_ld"
         v-if="show_user">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="(row, index) in user_object"
                            :key="index">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium sm:pl-0">{{ row.key }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm opacity-50">{{ row.value }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup>
import {ref, onMounted} from 'vue';
import {useI18n} from 'vue-i18n';
const {t} = useI18n();
const props = defineProps(['user']);
let user_object = ref([]);
let show_user = ref(false);
onMounted(() => {
    user_object.value.push({key: 'email', value: props.user.email});
    user_object.value.push({key: t('form_base.full_name'), value: props.user?.contact ? props.user.contact?.first_name+' '+props.user.contact?.last_name : null});
    user_object.value.push({key: t('form_base.tg'), value: props.user?.contact?.tg ?? null});
    user_object.value.push({key: t('form_base.country'), value: props.user?.address?.country ?? null});
    user_object.value.push({key: t('form_base.zip'), value: props.user?.address?.zip ?? null});
    user_object.value.push({key: t('form_base.city'), value: props.user?.address?.city ?? null});
    user_object.value.push({key: t('form_base.street_01'), value: props.user?.address?.street_01 ?? null});
    user_object.value.push({key: t('form_base.street_02'), value: props.user?.address?.street_02 ?? null});
	
    show_user.value = true;
});
</script>