<template>
    <div class="col-12 col-lg-7 col-xl-9">
	<div class="py-2 px-4 border-bottom d-none d-lg-block">
		<div class="d-flex align-items-center py-1">
			<div class="position-relative">
				<img :src="otherUser.avatar" class="rounded-circle mr-1" :alt="otherUser.name" width="40" height="40">
			</div>
			<div class="flex-grow-1 pl-3">
				<strong>{{ otherUser.name}}</strong>
			</div>
							 
		</div>
	</div>
<div class="chat-messages p-4 no-message">
           <p> Không có tin nhắn</p>
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
    },
    data() { 
        return {
        };
    },
       
    }
</script>
