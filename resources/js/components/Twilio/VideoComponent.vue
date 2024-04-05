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
    <div class="video">
        <div id="video-chat-window" class="d-flex"></div>
        <div id="video-preview"></div>
    </div>
</div>
</template>

<script>
export default {
    name: 'video-call',
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
    data: function () {
        return {
            accessToken: ''
        }
    },
    methods: {
        getAccessToken: function () {
            const _this = this
            const axios = require('axios')

            // Request a new token
            axios.post('/api/video/twilio/token')
                .then(function (response) {
                    _this.accessToken = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    _this.connectToRoom()
                });
        },
        connectToRoom: async function () {
            const _this = this
            const {
                connect,
                createLocalVideoTrack
            } = require('twilio-video');

            // Join to the Room with the given AccessToken and ConnectOptions.
            const room = await connect(this.accessToken, {
                audio: true,
                video: {
                    width: 640,
                    height: 640
                }
            });

            // Make the Room available in the JavaScript console for debugging.
            window.room = room;
            this.addLocalParticipant(room.localParticipant)
            // Subscribe to the media published by RemoteParticipants already in the Room.
            room.participants.forEach(participant => this.addRemoteParticipant(participant));
            room.on('participantConnected', participant => this.addRemoteParticipant(participant));
        },
        addLocalParticipant: function (participant) {

            // Create the video container
            this.createVideoContainer(participant)
            // Attach the
            participant.tracks.forEach(publication => {

                if ('audio' == publication.kind)
                    return
                this.publishTrack(publication.track, participant)
            })
        },
        addRemoteParticipant: function (participant) {
            this.createVideoContainer(participant)
            // Set up listener to monitor when a track is published and ready for use
            participant.on('trackSubscribed', track => {
                this.publishTrack(track, participant);
            });
        },
        createVideoContainer: function (participant) {
            // Add a container for the Participant's media.
            const div = document.createElement('div');
            div.id = participant.sid;
            div.classList.add("text-center");
            document.getElementById('video-chat-window').appendChild(div);
        },
        publishTrack: (track, participant) => {
            const videoContainer = document.getElementById(participant.sid);
            videoContainer.appendChild(track.attach())
        }
    },
    mounted: function () {
        this.getAccessToken()
    }
}
</script>
