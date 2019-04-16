<template>
    <div id="root">
        <div class="loadding">
            <img src="/images/logo.gif" alt="">
        </div>
        <Header/>
		<router-view/>
        <Footer/>
        <vue-progress-bar></vue-progress-bar>
	</div>
</template>
<script>
    import Header from './partials/Header.vue';
    import Footer from './partials/Footer.vue';
    import { EventBus }  from '../../EventBus';
    export default {
        name: 'main-app',
        components: {
            Header,
            Footer,
        },
        created() {
            EventBus.$emit('redirect-page')
        },
        mounted() {
        this.$Progress.finish()            
        $(document).ready(() => {
            setTimeout(() => {
            $('.loadding').fadeOut();
        }, 1000);
        })

        },

        created () {
            //  [App.vue specific] When App.vue is first loaded start the progress bar
            this.$Progress.start()
            //  hook the progress bar to start before we move router-view
            this.$router.beforeEach((to, from, next) => {
            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress
                // parse meta tags
                this.$Progress.parseMeta(meta)
            }
            //  start the progress bar
            this.$Progress.start()
            //  continue to next page
            next()
            })
            //  hook the progress bar to finish after we've finished moving router-view
            this.$router.afterEach((to, from) => {
            //  finish the progress bar
            this.$Progress.finish()
            })
        }
    }
</script>
<style lang="scss">
.loadding{
    height: 100%;
    background: rgba(255, 255, 255, .95);
    width: 100%;
    position: fixed;
    z-index: 10000;
    img{
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -50px 0 0 -50px;
        border: 3px solid transparent;
    }
}
body{
    font-family: "Josefin Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    background: url('https://colorlib.com/preview/theme/wordify/images/photography.png');
}
</style>



