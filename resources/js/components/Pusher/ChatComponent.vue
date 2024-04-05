<template>
<div class="col-12 col-lg-7 col-xl-9">
    <div class="py-2 px-4 border-bottom d-none d-lg-block">
        <div class="d-flex align-items-center py-1">
            <div class="position-relative">
                <img :src="otherUser.avatar" class="rounded-circle mr-1" :alt="otherUser.name" width="40" height="40">
            </div>
            <div class="flex-grow-1 pl-3">
                <strong>{{ otherUser.name}}</strong>
                <div class="text-muted small"><em>Typing...</em></div>
            </div>

        </div>
    </div>
    <div v-if="chats.length == 0" class="chat-messages p-4 no-message">
        <p> Không có tin nhắn</p>
    </div>
    <div class="position-relative" v-else ref="chat">
        <div class="chat-messages p-4">
            <div v-for="(message,index) in chats" :key="index">
                <div class="chat-message-right pb-4" v-if="message.author == authUser.id">
                    <div>
                        <img :src="authUser.avatar" class="rounded-circle mr-1" :alt="authUser.name" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{message.created_at}}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                        <div class="font-weight-bold mb-1">You</div>
                        <img :src="message.chat" v-if="message.type=='image'" class="h200" />
                        <p v-else>{{ message.chat }}</p>
                    </div>
                </div>

                <div class="chat-message-left pb-4" v-else>
                    <div>
                        <img :src="otherUser.avatar" class="rounded-circle mr-1" :alt="otherUser.name" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{message.created_at }}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                        <div class="font-weight-bold mb-1">{{ otherUser.name}}</div>
                        <img :src="message.chat" v-if="message.type=='image'" class="h200" />
                        <p v-else>{{ message.chat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-0 py-3 px-4 border-top">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message" autofocus @keyup.enter="sendChat" v-model="message">
            <label for="img"><img src="/img/picture.png" class="img-2"></label>
            <input ref="photo" type="file" id="img" class="d-none" accept="image/*" @change="update('image')">
            <button class="btn btn-primary" @click="sendChat">Send</button>
        </div>
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
        otherUser: {
            type: Object,
            required: true
        },
        chats: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            message: "",
        };
    },
    mounted() {
        Echo.private('Chat.' + this.otherUser.id + '.' + this.authUser.id)
            .listen('BroadcastChat', (e) => {
                this.chats.push(e.chat);
            });
    },
    methods: {
        async sendChat() {
            if (this.message != '') {
                var data = {
                    chat: this.message,
                    other: this.otherUser.id,
                    type: 'text',
                    author: this.authUser.id,
                    created_at: new Date().toLocaleString()
                }
                this.message = '';
                await axios.post('/api/chat/pusher/store', data).then((response) => {
                    this.chats.push(response.data)
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
        scrollToElement() {
            const el = this.$refs.chat;
            console.log(el);
            if (el) {
                // Use el.scrollIntoView() to instantly scroll to the element
                el.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    }
}
</script>
