<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <title>Chatra</title>
    <!-- Start of LiveChat (www.livechat.com) code -->
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 18170754;
        window.__lc.integration_name = "manual_onboarding";
        window.__lc.product_name = "livechat";
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechat.com/chat-with/18170754/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    <!-- End of LiveChat code -->

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-9">
            <a href="/chat">Quay lại</a>
        </div>
        <div class="col-3 d-flex" style="justify-content: space-around;">
            <a href="https://my.livechatinc.com/install-code">Tutorial</a>
        </div>
        <div class="col-12 mt-4">
            <div class="card p-3">
                <img src="{{ asset('img/livechat-logo.svg') }}" class="h50">
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/bootstrap.js') }}"></script>

</body>
</html>
