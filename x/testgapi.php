<?php
/* 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="810890085192-8v2rq5u42m4bsf3c3hk0ndf8a9oqjmgj.apps.googleusercontent.com">
    </head>
    <body>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <script type="text/javascript">
            function onSign(googleUser){
                var profile = googleUser.getBasicProfile();
                var msg = 'ID: ' + profile.getId() + "\n" + 
                    'Name: ' + profile.getName() + "\n" + 
                    'Image URL: ' + profile.getImageUrl() + "\n" +
                    'Email: ' + profile.getEmail();
                 alert(msg);
            }
        </script>

        <a href="#" onclick="signOut();">Sign out</a>
        <script>
            function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                    alert('User signed out.');
                });
            }
        </script>        
    </body>
</html>


