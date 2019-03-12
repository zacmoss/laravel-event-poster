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
    </body>


</html>