<template>
	<div class="page">
	    <Header :router="router" :user="user" :isLoggedIn="isLoggedIn" />
	    
	    <div class="content">
        	<router-view :router="router" :isLoggedIn="isLoggedIn"></router-view>
        </div>
	</div>	
</template>

<script>
import Header from '@/views/components/Header';
import { mapGetters } from 'vuex';
import router from '@/routes/web';

export default {
    data() {
        return {
            router
        }
    },
    components: {
        Header
    },
    computed: {
    	...mapGetters([
    		'isLoggedIn',
            'user'
    	])
    }
}
</script>