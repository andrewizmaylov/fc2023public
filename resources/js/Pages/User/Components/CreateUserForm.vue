<template>
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
                        :name="'role_selector'"
                        :error="form.errors.role"
                        :options="roles"
                        :i18_key="'roles'"
                        v-model="form.role"
                        v-if="!form.id && roles?.length"/>
    </section>
	
    <section class="grid sm:grid-cols-2 grid-cols-1 gap-4 mt-4"
             v-if="team_selector">
        <SelectInputSet class="col-span-2"
                        :name="'team_selector'"
                        :error="form.errors.team_id"
                        :options="teams"
                        v-model="form.team_id" />
    </section>
	
    <FormSubmission :form="form"
                    @update="updateForm(form, MODEL)"
                    @create="submitForm(form, MODEL)"/>
</template>
<script setup>
import TextInputSet from '@/Components/TextInputSet.vue';
import SelectInputSet from '@/Components/SelectInputSet.vue';
import FormSubmission from '@/Components/FormSubmission.vue';
import useFormComposable from '@/Pages/Shared/useFormComposable.js';
import {useForm} from '@inertiajs/vue3';
import {onMounted} from 'vue';

const props = defineProps(['user', 'roles', 'defined_role', 'team_selector', 'teams']);
const MODEL = 'User';
let {updateForm, submitForm} = useFormComposable(MODEL);

function updateProfilePhotoField(file) {
    form.profile_photo_path = file.link;
    document.getElementById('submit_form_button').click();
}

let form = useForm({
    id: '',
    email: '',
    profile_photo_path: '',
    first_name: '',
    second_name: '',
    last_name: '',
    birthday: '',
    tg: '',
    role: null,
    team_id: null,
});

onMounted(() => {
    Event.on('update_profile_photo', (file) => {
        updateProfilePhotoField(file);
    });
	
    if (props.user) {
        form.id = props.user.id;
        form.email = props.user.email;
        form.profile_photo_path = props.user.profile_photo_path ?? null;
        form.first_name = props.user?.contact?.first_name ?? null;
        form.second_name = props.user?.contact?.second_name ?? null;
        form.last_name = props.user?.contact?.last_name ?? null;
        form.birthday = props.user?.contact?.birthday ?? null;
        form.tg = props.user?.contact?.tg ?? null;
        form.role = props.user?.roles[0]?.id ?? null;
    }
	
    if (props.defined_role) {
        form.role = props.defined_role;
    }
});
</script>