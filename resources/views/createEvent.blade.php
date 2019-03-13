<?= 'create dat event yo' ?>

<?= 'An addition has been made' ?>

<?= 'Another addition' ?>

<html>
    <head>
        <title>Event Poster V3</title>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <h2>Create dat Event cher</h2>
        <form method="post" action="/">
            <input type='text' name='title' placeholder="title">
            <input type='text' name='location' placeholder="location">
            <textarea type='text' name='description' placeholder="description"></textarea>
            <input type='submit' value="submit">
        </form>
        <button onclick="notify()">Notify</button>
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!Notification) {
                alert('Desktop notifications not available in your browser. Try Chromium.'); 
                return;
            }

            if (Notification.permission !== "granted") {
                Notification.requestPermission();
            }
        });
        let notify = () => {
            let newNot = new Notification('A title', {
                body: "Hey, this is a notification",
            });
        }

    </script>


</html>