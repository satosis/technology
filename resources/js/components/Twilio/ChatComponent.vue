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

    <div v-if="messages.length == 0" class="chat-messages p-4 no-message">
        <p> Không có tin nhắn</p>
    </div>
    <div class="position-relative" v-else>
        <div class="chat-messages p-4">
            <div v-for="message in messages" v-bind:key="message.id">
                <div class="chat-message-right pb-4" v-if="message.author === authUser.email">
                    <div>
                        <img :src="authUser.avatar" class="rounded-circle mr-1" :alt="authUser.name" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{ message.created_at}}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                        <div class="font-weight-bold mb-1">You</div>
                        <img :src="message.mediaUrl" v-if="message.type=='media'" class="h200" />
                        <p v-else>{{ message.body }}</p>
                    </div>
                    <div class="remove" v-on:click="remove(message.sid)">X</div>
                </div>

                <div class="chat-message-left pb-4" v-else>
                    <div>
                        <img :src="otherUser.avatar" class="rounded-circle mr-1" :alt="otherUser.name" width="40" height="40">
                        <div class="text-muted small text-nowrap mt-2">{{ message.created_at | formatDate }}</div>
                    </div>
                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                        <div class="font-weight-bold mb-1">{{ otherUser.name}}</div>
                        <img :src="message.mediaUrl" v-if="message.type=='media'" class="h200" />
                        <p v-else>{{ message.body }}</p>
                    </div>
                    <div class="remove" v-on:click="remove(message.sid)">X</div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow-0 py-3 px-4 border-top">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message" autofocus v-on:keyup.enter="sendMessage" v-model="newMessage">
            <label for="img"><img src="/img/picture.png" class="img-2"></label>
            <input type="file" id="img" class="d-none" accept="image/*" @change="sendMediaMessage">
            <button class="btn btn-primary" v-on:click="sendMessage">Send</button>
        </div>
    </div>

</div>
</template>

<script>
import {
    Client as ConversationsClient
} from "@twilio/conversations";
export default {
    name: "ConversationComponent",
    props: {
        authUser: {
            type: Object,
            required: true
        },
        otherUser: {
            type: Object,
            required: true
        },
        chat: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            messages: [],
            newMessage: "",
            activeConversation: null,
        };
    },
    async created() {
        const token = await this.fetchToken();
        await this.initializeClient(token, this.chat.room);
        await this.fetchMessages();
    },
    methods: {
        async remove(id) {
            console.log(id);
            var messages = (await this.activeConversation.getMessages()).items;
            messages.map(function (value) {
                console.log(value.sid);
                if (value.state.sid == id) {
                    value.remove();
                }
            });
        },
        hidden(id) {
            document.getElementById(id).classList.add("d-none");
        },
        async fetchToken() {
            const {
                data
            } = await axios.post("/api/chat/twilio/token", {
                email: this.authUser.email
            });
            return data.token;
        },
        async initializeClient(token, room) {
            //conversation
            window.conversationsClient = ConversationsClient
            this.conversationsClient = await ConversationsClient.create(token)
            this.activeConversation = await (this.conversationsClient.getConversationByUniqueName(room));
            this.activeConversation.getMessages()
                .then((newMessage) => {
                    this.messages = [...this.messages, ...newMessage.items]
                })
            this.activeConversation.on("messageAdded", message => {
                this.pushToArray(message)
            });
        },
        async fetchMessages() {
            this.messages = (await this.activeConversation.getMessages()).items;
            // const { data } = await axios.get("/twilio/list/chat/"+this.otherUser.room);
            //  this.messages  = data;
        },
        async sendMessage() {
            this.activeConversation.sendMessage(this.newMessage)
                .then(() => {
                    this.newMessage = ""
                })
        },
        async sendMediaMessage({
            target
        }) {
            const formData = new FormData();
            formData.append('file', target.files[0]);
            this.activeConversation.sendMessage(formData);
            target.value = "";
        },
        async pushToArray(message) {
            if (message.type === 'media') {
                const mediaUrl = await message.media.getContentTemporaryUrl()
                this.messages.push({
                    type: message.type,
                    author: message.author,
                    body: mediaUrl,
                    mediaUrl
                })
            } else {
                this.messages.push({
                    type: message.type,
                    author: message.author,
                    body: message.body,
                })
            }
        },

    }
};
</script>
