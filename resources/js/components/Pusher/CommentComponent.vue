<template>
<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
        <h1>Comments</h1>
        <div v-for="(list,index) in comments" :key="index">
            <div class="comment mt-4 text-justify float-left" v-if="list.user_id == authUser.id">
                <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                <h4>Bạn</h4>
                <span>- {{ list.created_at }}</span>
                <br>
                <p>{{ list.content }}</p>
            </div>
            <div class="text-justify darker mt-4 float-right" v-else>
                <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                <h4>{{ list.users.name }}</h4>
                <span>- {{ list.created_at }}</span>
                <br>
                <p>{{ list.content }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
        <form id="algin-form">
            <div class="form-group">
                <h4>Leave a comment</h4>
                <label for="message">Message</label>
                <textarea cols="30" rows="5" v-model="message" class="form-control" style="background-color: black;color: white" @keyup.enter="sendChat"></textarea>
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
    created() {
        Echo.channel('Comment.' + authUser.id)
            .listen('CommentSend', (e) => {
                console.log(e);
                this.comments.push(e.comment);
            });
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
                    user_id: this.authUser.id,
                    comment: this.message,
                }
                this.message = "";
                await axios.post('/api/comment/pusher/store', data).then((response) => {
                    console.log(response.data);
                    this.comments.push(response.data);
                })
            }
        },
    }
}
</script>
