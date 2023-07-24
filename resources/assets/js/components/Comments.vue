<template>
  <div>
    <button
        class="btn btn-danger"
        @click="showCommentsForm"
        v-text="text"
    ></button>
    <div class="modal fade" :id=dialog tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              评论列表
            </h4>
          </div>
          <div class="modal-body">
            <div v-if="comments.length >0">
              <div class="media" v-for="comment in comments">
                <div class="media-left">
                  <a href="#" class="a-avatar2">
                    <img :src="comment.user.avatar" class="media-object avatar" width="50">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">{{comment.user.name}}</h4>
                  {{comment.content}}
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="text" class="form-control" v-model="content">
            <button type="button" class="btn btn-primary" @click="store">评论</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props:['type','model','count'],
  data() {
    return {
      content:'',
      comments:[]
    }
  },
  computed:{
    dialog() {
      return 'comments-dialog-' + this.type + '-' + this.model
    },
    dialogId() {
      return '#' + this.dialog
    },
    text() {
      return this.count + '评论'
    }
  },
  methods: {
    store() {
      this.$http.post('/api/comment/store',{'type':this.type,'model':this.model,'content':this.content}).then(response => {
        let comment = {
          user:{
            name: Zhihu.name,
            avatar: Zhihu.avatar,
          },
          content: response.data.content
        }
        this.comments.push(comment)
        this.content = ''
        this.count ++
      })
    },
    showCommentsForm() {
      this.getComments()
      $(this.dialogId).modal('show')
    },
    getComments() {
      this.$http.post('/api/comments',{'type':this.type,'model':this.model}).then(response => {
        this.comments = response.data
      })
    }
  }
}
</script>


