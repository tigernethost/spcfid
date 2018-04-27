<template>
    <data-message :msg="message"></data-message>
</template>

<script>
    import DataMessage from './DataMessage.vue';

    export default {
        data() {
            return {
                message: 'Hello'
            }
        },
        component: {
            'data-message': DataMessage
        }
    }
</script>
