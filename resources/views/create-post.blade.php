<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Post</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <!-- Js -->
    <script src="{{ asset('/js/app.js') }}"></script>

</head>

<body class="">
    <div class="container">
        <form action="/store-post" method="post">
            @csrf

            <div class="jumbotron">

                <div class="form-group ">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter Title" />
                    <small id="helpId" class="form-text text-muted">Title Help</small>
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" name="body" id="body" rows="3" placeholder="Enter Body"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary mb-2">Save Post</button>

            </div>

        </form>
    </div>

</body>

</html>