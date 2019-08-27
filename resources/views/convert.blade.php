<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Convert</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100%;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
                background: url('{{url('image/add.png')}}') no-repeat center;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .hover {
                background:#d7f3e3 url('{{url('image/add.png')}}') no-repeat center;
            }

            ul {
                list-style:none;
            }

            li.list {
                padding: 1px;
                width: 300px;
                height: 50px;
                border: 1px #3495e3 solid;
                margin: 5px;
            }

            div#detail {
                position:absolute;
                top: 20px;
                left:10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height" id="drop-zone">
        </div>
    <div id="detail">
        <ul id="list">
            <li style="display:none;"></li>
        </ul>
    </div>
    </body>
    <script>
        $(function () {
            var index = 1;
            var $drop = $("#drop-zone");

            function stopEvent(evt) {
                evt.stopPropagation();
                evt.preventDefault();
            }

            $drop.bind("dragover", function (e) {
                stopEvent(e);
                $(e.target).addClass("hover");
            }).bind("dragleave", function (e) {
                stopEvent(e);
                $(e.target).removeClass("hover");
            }).bind("drop", function (e) {
                stopEvent(e);
                $(e.target).removeClass("hover");
                $('ul#list').prepend('<li id="li_list' + index + '" class="list"></li>')

                var files = e.originalEvent.dataTransfer.files;
                var xhr = new XMLHttpRequest();
                var fd = new FormData();
                var li = $('#li_list' + index);


                xhr.open('post', '{{url('convert')}}');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        // alert(xhr.responseText);
                    }
                };

                xhr.onload = function() {
                    li.text('Done');
                };

                xhr.upload.onprogress = function (evt) {
                    if (evt.lengthComputable) {
                        var complete = (evt.loaded / evt.total * 100 | 0);
                        if(100==complete){
                            complete=99.9;
                        }
                        li.text(complete + ' %');
                    }
                };
                for (var i in files) {
                    fd.append('files[]', files[i]);
                }
                xhr.send(fd);
            });
        });
    </script>
</html>
