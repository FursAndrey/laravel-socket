<script>
import MyLayout from '@/Layouts/MyLayout.vue';
import axios from 'axios';
export default {
    name: 'Index',
    layout: MyLayout,
    props: [
        'messages'
    ],
    data() {
        return {
            body: ''
        }
    },
    created() {
        window.Echo.channel('store-message')
        .listen('.store-message-listen', res => {
            this.messages.unshift(res.message);
        })
    },
    methods: {
        store() {
            axios.post('/messages', {body: this.body})
            .then( res => {
                this.messages.unshift(res.data);
                this.body = '';
            })
        }
    }
}
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Your messages</div>
            </div>
            <div class="pt-4 flex items-center">
                <input type="text" v-model="body" class="border border-sky-700 rounded-lg p-2 w-4/5" placeholder="Your new message"/>
                <span @click="store()" class="block w-36 text-center text-white border border-sky-700 rounded-lg ml-4 p-2 bg-sky-400 cursor-pointer">Send</span>
            </div>
            <div v-if="messages.length > 0">
                <div v-for="message in messages" :key="message.id" class="mt-4">
                    <p class="text-sm text-neutral-500 text-right">{{ message.created }}</p>
                    <p>{{ message.body }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>

</style>