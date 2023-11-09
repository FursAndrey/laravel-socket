<template>
    <div>User '{{ personal.name }}'</div>
    <div class="pt-4 flex items-center">
        <span @click="sendPersonalMessage()" class="block w-36 text-center text-white border border-sky-700 rounded-lg ml-4 p-2 bg-sky-400 cursor-pointer">Send</span>
    </div>
    <div v-if="personalMessage">
        {{ personalMessage }}
    </div>
</template>

<script>
import MyLayoutVue from '@/Layouts/MyLayout.vue'
export default {
    name: 'Show',
    layout: MyLayoutVue,
    props: [
        'personal'
    ],
    data() {
        return {
            personalMessage: ''
        }
    },
    created() {
        window.Echo.private('personal-message-channel-'+this.$page.props.auth.user.id)
        .listen('.personal-message-channel', res => {
            this.personalMessage = res.personalMessage;
        })
    },
    methods: {
        sendPersonalMessage() {
            axios.post('/personal/'+this.personal.id)
            .then( res => {
                // console.log(res.data.personalMessage);
                this.personalMessage = res.data.personalMessage;
            })
        }
    }
}
</script>

<style>

</style>