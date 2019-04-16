<template>
<div id="new-teacher">
  <div class="container pdt-6">
    <div class="row m-y-2">
        <div class="col-md-12">
            <h4 class="m-y-2 text-center mb-5 tab-content">Create New Post</h4>
        </div>
        
        <div class="col-lg-8 push-lg-4">
            <div class="tab-pane" id="edit">
                <form role="form" @submit.prevent="addTeacher">
                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label">Title</label>
                            <input v-model="post.title" class="form-control" type="text" placeholder="Jane">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label">Categories</label>
                            <!-- <input v-model="post.title" class="form-control" type="text" placeholder="Jane"> -->
                            <multiselect
                                v-model="post.categories"
                                :options="categories"
                                :multiple="true"
                                placeholder="Select categories"
                                :clear-on-select="false"
                                :close-on-select="false"
                                label="name"
                                track-by="name"
                                >
                            </multiselect>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label">Tags</label>
                            <!-- <input v-model="post.title" class="form-control" type="text" placeholder="Jane"> -->
                            <multiselect
                                v-model="post.tags"
                                :options="tags"
                                :multiple="true"
                                placeholder="Select tags"
                                :clear-on-select="false"
                                :close-on-select="false"
                                label="name"
                                track-by="name"
                                >
                            </multiselect>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label">Description</label>
                            <textarea v-model="post.description" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label">Content</label>
                            <quill-editor
                                v-model="post.content">
                            </quill-editor>
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <div class="col-lg-12">
                        <label class="col-lg- col-form-label form-control-label"></label>
                            <input type="reset" class="btn btn-secondary" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Add my teacher">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
            <div v-if="loadding" class="loadding-avt">
                <div class="loader"></div>
            </div>
            <img :src="post.image ||'//placehold.it/150'" class="m-x-auto img-fluid img-circle" alt="avatar">
            <h6 class="m-t-2">Upload a different photo</h6>
            <label class="custom-file">
                <input type="file" @change="onFileChange($event)" id="file" class="custom-file-input">
                <span class="custom-file-control  btn btn-primary">Choose file</span>
            </label>
        </div>
    </div>
  </div>
</div>
</template>
<script>
import { post,get } from '../../helpers/api'
import noty from '../../helpers/noty'
import { postPost,uploadFile, getAllCategories, tags } from '../../router/router'
import { editorOption } from '../../config'
import Multiselect from 'vue-multiselect'

export default {
    name: 'app-new-post',
    data(){
        return{
            post:{
                title:'',
                description:'',
                content:'',
                image:'',
                categories:'',
                tags:''
            },
            categories:[],
            tags:[],
            loadding : false,
        }   
    },
    components:{
        Multiselect
    },
    created() {
        get(getAllCategories)
        .then(res => {
            this.categories = res.data.categories.map(function(value, key) {
                        return {
                            name: value.name,
                            id: value.id
                        }
                    })
                })
        .catch(err=>{
                    noty({type: 'error', text: "Don't get categories", force: true})
                })
        get(tags)
        .then(res => {
                    this.tags = res.data.tags.map(function(value, key) {
                        return {
                            name: value.name,
                            id: value.id
                        }
                    })
                })
                .catch(err => {
                    noty({type: 'error', text: "Don't get categories", force: true})
                    // this.tags.push(this.$i18n.t('messages.empty'))
                })
    },
    methods:{
        addTeacher(){
            // this.$validator.ValidateAll().then((res)=>{
                this.$Progress.start()
                console.log(this.post);
                
                post(postPost ,this.post ).then((res)=>{
                    const message = res.data.message
                    noty({type: 'success', text: message, force: true})
                    this.$Progress.finish()
                }).catch(err=>{
                    noty({type: 'error', text: "Don't create your post", force: true})
                    this.$Progress.fail()
                })
 
            // })
        },
        
        onFileChange(event){
            this.loadding = true;
            let formData = new FormData()
            $.each(event.currentTarget.files, (i, file) => {
                formData.append('file', file)
            })
            post(uploadFile,formData)       
            .then(res=>{
                this.post.image = 'images/'+res.data
                this.loadding = false;
            })
            .catch((err) =>{
                console.log(err)
            })
        },
        

    }
}
</script>
<style>
.m-x-auto.img-fluid.img-circle{
    width:150px;
    height:150px;
}
.loadding-avt {
    height: 150px;
    background: rgba(255,255,255,0.5);
    width: 150px;
    position: absolute;
}

#loader,
.loader {
    display: block;
    position: absolute;
    left: 50%;
    top: 50%;
    width: 100px;
    height: 100px;
    margin: -50px 0 0 -50px;
    border-radius: 80%;
    border: 3px solid transparent;
    border-top-color: #5ecd6b;
    -webkit-animation: 2s linear infinite spin;
    animation: 2s linear infinite spin
}

#loader:before,
.loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #4190dc;
    -webkit-animation: 3s linear infinite spin;
    animation: 3s linear infinite spin
}

#loader:after,
.loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #262a32;
    -webkit-animation: 1.5s linear infinite spin;
    animation: 1.5s linear infinite spin
}
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0);
        transform: rotate(0)
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}

@keyframes spin {
    0% {
        -webkit-transform: rotate(0);
        transform: rotate(0)
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg)
    }
}
.custom-file-input{
    display: none;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>