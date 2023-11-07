<template>
    <div class="w-3/4 mx-auto">
        <my-navigation></my-navigation>
        <slot></slot>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import MyNavigation from '@/Components/MyNavigation.vue';

export default {
    name: 'MainLayout',
    components: { 
        Link,
        MyNavigation,
    }
}
</script>

<style>

</style>