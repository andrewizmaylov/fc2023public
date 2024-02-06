<template>
    <h4 class="header_34">{{ $t('team.book_appointment') }}</h4>
    <p class="text_16 mb-6 text_ld italic opacity-50"
       v-html="$t('team.appointment_message')" />
    <section class="md:w-2/3 w-full mb-16">
        <section class="grid sm:grid-cols-3 grid-cols-1 gap-4">
            <TextInputSet class="col-span-1"
                          :name="'first_name'"
                          :error="form.errors.first_name"
                          v-model="form.first_name"/>
            <TextInputSet class="col-span-1"
                          :name="'second_name'"
                          :error="form.errors.second_name"
                          v-model="form.second_name"/>
            <TextInputSet class="col-span-1"
                          :name="'last_name'"
                          :error="form.errors.last_name"
                          v-model="form.last_name"/>
        </section>
        <section class="grid sm:grid-cols-3 grid-cols-1 gap-4 mt-4">
            <TextInputSet class="sm:col-span-2 col-span-1"
                          :name="'email'"
                          :input_type="'email'"
                          :error="form.errors.email"
                          v-model="form.email"/>
            <TextInputSet class="col-span-1"
                          :name="'birthday'"
                          :input_type="'date'"
                          :error="form.errors.birthday"
                          v-model="form.birthday"/>
        </section>
        <section class="grid sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
            <TextInputSet class="col-span-1"
                          :name="'tg'"
                          :error="form.errors.tg"
                          v-model="form.tg"/>
	        
            <SelectInputSet class="col-span-1"
                            :name="'team_selector'"
                            :error="form.errors.team_id"
                            :options="teams"
                            v-model="form.team_id" />
        </section>
	    
	    
        <FormSubmission :form="form"
                        @create="submitForm"
                        @update="submitForm"
                        :button_text="$t('team.book_appointment')"/>

    </section>
</template>
<script setup>
import {RolesEnum} from '@/Enums/RolesEnum.js';
import SelectInputSet from '@/Components/SelectInputSet.vue';
import TextInputSet from '@/Components/TextInputSet.vue';
import {useForm} from '@inertiajs/vue3';
import {onMounted} from 'vue';
import {page} from '@/Pages/Shared/helpers.js';
import FormSubmission from '@/Components/FormSubmission.vue';

defineProps(['teams']);

let form = useForm({
    id: '',
    email: '',
    first_name: '',
    second_name: '',
    last_name: '',
    birthday: '',
    tg: '',
    role: RolesEnum.INTERN,
    team_id: null,
});

onMounted(() => {
    if (page.props.auth?.user) {
        form.id = page.props.auth.user.id;
        form.email = page.props.auth.user.email;
        form.first_name = page.props.auth.user?.contact?.first_name ?? null;
        form.second_name = page.props.auth.user?.contact?.second_name ?? null;
        form.last_name = page.props.auth.user?.contact?.last_name ?? null;
        form.birthday = page.props.auth.user?.contact?.birthday ?? null;
        form.tg = page.props.auth.user?.contact?.tg ?? null;
    }
});

function submitForm() {
    console.log('gver');
    form.post(route('appointments.store'), {
        errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {
            Event.emit('form_updated');
        }
    });
}
</script>