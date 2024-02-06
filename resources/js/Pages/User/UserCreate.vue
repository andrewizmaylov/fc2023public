<template>
    <Head :title="$t('pages.' + MODEL.toLowerCase())"/>
	
    <div>
        <section class="form_wrapper">
            <FormHeader :model="MODEL"
                        :input="user"
                        :tabs="tabs"
                        @tab_changed="selectTab">

                <ProfilePhoto :user="user"
                              :use_id=true
                              @profile_photo_updated="updateProfilePhotoField"/>
            </FormHeader>

            <!-- main block -->
            <div v-if="tab_selected === 1">
                <CreateUserForm :user="user"
                                :roles="roles"/>
            </div>

            <UserRoles :user="user"
                       :roles="roles"
                       v-if="tab_selected === 2"/>

            <UserTeams :user="user"
                       :active="show_command_component"
                       v-if="tab_selected === 3"/>

            <AddressBlock :input="user?.address ?? []"
                          :id="user.id"
                          :model="MODEL"
                          v-if="tab_selected === 4"/>

        </section>
    </div>
</template>
<script setup>
import {useI18n} from 'vue-i18n';
const { t } = useI18n();
import {Head, router} from '@inertiajs/vue3';

import {computed, onMounted, ref} from 'vue';
import UserRoles from '@/Pages/User/Components/UserRoles.vue';
import UserTeams from '@/Pages/User/Components/UserTeams.vue';
import FormHeader from '@/Components/FormHeader.vue';
import ProfilePhoto from '@/Pages/Profile/Partials/ProfilePhoto.vue';
import AddressBlock from '@/Pages/Shared/AddressBlock.vue';
import {RolesEnum} from '@/Enums/RolesEnum.js';
import CreateUserForm from '@/Pages/User/Components/CreateUserForm.vue';

const props = defineProps(['roles', 'user']);
const MODEL = 'User';

function updateProfilePhotoField(file) {
    Event.emit('update_profile_photo', file);
}
function reload() {
    router.reload({only: ['user']});
}

const tabs = ref([
    {id: 1, name: t('tabs.main_info')},
    {id: 2, name: t('tabs.roles')},
    {id: 3, name: t('tabs.team')},
    {id: 4, name: t('tabs.address')},
]);
let tab_selected = ref(1);
function selectTab(tab) {
    tab_selected.value = tab;
}

let show_command_component = computed(() => props.user.roles.map(role => role.id).some(role => [
    RolesEnum.IGROK,
    RolesEnum.TRENER,
].includes(role)));

onMounted(() => {
    Event.on('form_updated', () => reload());
});
</script>