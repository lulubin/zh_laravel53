<template>
  <div style="text-align: center">
    <my-upload field="img"
               @crop-success="cropSuccess"
               @crop-upload-success="cropUploadSuccess"
               @crop-upload-fail="cropUploadFail"
               v-model="show"
               :width="50"
               :height="50"
               url="/avatar"
               :params="params"
               :headers="headers"
               img-format="png"></my-upload>
    <img :src="imgDataUrl" style="width: 60px">
    <div style="margin-top: 20px;">
      <button class="btn btn-default" @click="toggleShow">修改头像</button>
    </div>
  </div>
</template>

<script>
    import 'babel-polyfill';
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    export default {
      props: ['avatar'],
      data() {
        return {
          show: false,
          params: {
            _token: Laravel.csrfToken,
            name: 'img'
          },
          headers: {
            smail: '*_~'
          },
          imgDataUrl: this.avatar
        }
      },
      components: {
        'my-upload': myUpload
      },
      methods: {
        toggleShow() {
          this.show = !this.show;
        },
        cropSuccess(imgDataUrl, field){
          this.imgDataUrl = imgDataUrl;
        },
        cropUploadSuccess(response, field){
          this.imgDataUrl = response.url
          this.toggleShow()
        },
        cropUploadFail(status, field){
          console.log(status);
          console.log('field: ' + field);
        }
      }
    }
</script>
