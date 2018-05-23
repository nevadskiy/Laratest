<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <style>
            body {
                font-family: Raleway;
            }
        </style>

    </head>
    <body>
        <div class="container pt-5">
            <div class="row">
                <form action="{{ route('questionnaire') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                            Your name <input type="text" class="form-control">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            Your age <input type="text" class="form-control">
                        </label>
                    </div>
                    <button class="btn btn--info">Send</button>
                </form>
            </div>

            <div class="row">
                <form action="{{ route('booking') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>
                            Your name <input type="text" class="form-control">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            Your phone <input type="phone" class="form-control">
                        </label>
                    </div>
                    <button class="btn btn--info">Send</button>
                </form>
            </div>
        </div>
    </body>
</html>
