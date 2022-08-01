<template>
  <div class="row">
    <h1>dd</h1>
    <div v-for="(list,index) in comments" :key="index">
      <div class="comment mt-4 text-justify float-left" v-if="list.user_id == authUser.id">
        <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
        <h4>{{ authUser.name }}</h4>
        <span>- {{ list.created_at }}</span>
        <br>
        <p>{{ list.content }}</p>
      </div>
      <div class="text-justify darker mt-4 float-right" v-else>
        <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
        <h4>{{ list.users }}</h4>
        <span>- {{ list.created_at }}</span>
        <br>
        <p>{{ list.content }}</p>
      </div>
    </div>
    @endforeach

    <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
      <form id="algin-form">
        <div class="form-group">
          <h4>Leave a comment</h4>
          <label for="message">Message</label>
          <textarea name="msg" id="" msg cols="30" rows="5" class="form-control"
                    style="background-color: black;" @keyup.enter="sendChat" v-model="message"></textarea>
        </div> 
        <div class="form-group">
          <p class="text-secondary">If you have a <a href="#" class="alert-link">gravatar account</a> your address will
            be used to display your profile picture.</p>
        </div>
        <div class="form-inline">
          <input type="checkbox" name="check" id="checkbx" class="mr-1">
          <label for="subscribe">Subscribe me to the newlettter</label>
        </div>
        <div class="form-group">
          <button type="button" id="post" class="btn" @click="sendChat">Post Comment</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "ChatComponent",
  props: {
    authUser: {
      type: Object,
      required: true
    },
    comments: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      message: "",
    };
  },
  methods: {
    async sendChat() {
      if (this.message != '') {
        var data = {
          comment: this.message,
        }
        this.message = '';
        await axios.post('/api/chat/pusher/store', data).then((response) => {
          this.chats.push(response)
        })
      }
    },
    async update(type) {
      const data = new FormData();
      if (type == 'image')
        data.append('message', this.$refs.photo.files[0]);
      data.append('other', this.otherUser.id);
      data.append('author', this.authUser.id);
      data.append('type', type);
      await axios.post('/api/chat/pusher/upload', data).then((response) => {
        this.chats.push(response.data)
      })
    },
  }
}
</script>
