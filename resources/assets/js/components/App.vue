<template>
    <div id="wrapper">
        <navigation></navigation>
        <div id="page-wrapper" class="gray-bg">
            <navbar></Navbar>
            <router-view></router-view>
            <footers></footers>
        </div>
    </div>
</template>

<script>
import Navbar from './administration/layouts/topnavbar.vue'
import Navigation from './administration/layouts/navigation.vue'
import Footer from './administration/layouts/footer.vue'

    export default {    
        components:{
            'navbar': Navbar,
            'navigation': Navigation,
            'footers': Footer,
        }
    }
</script>