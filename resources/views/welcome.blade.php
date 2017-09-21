<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 22</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div style="background-color: #EEE; height: 200px">
            
            <div style="float: right">
                
                @if (Session::has('sessionLogin'))
                    <a>{{ Session::get('sessionLogin')[0] }}</a> ||
                    <a href="signout"> Sign out</a> ||
                @endif
                <a href=""> Sign up</a>
            </div>
            <br>
            <div style="float: right">
                <a href="files"> Files</a>
            </div>
        </div>
        <div style="width: 20%; min-height: 500px; background-color: bisque;float: left"></div>

        <div style="float: left;align-items: center; width: 60%;background-color: #f5f5f5; min-height: 500px">

            <h1>WELCOME TO ME</h1>
            <form action="upload" method="post" enctype='multipart/form-data' >
        
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <label>Marjo type file:</label>
                @if(isset($items))
                    <select name="m_major">
                        @foreach($items as $item)
                        <option value="{{ $item->name.'|'.$item->id }}" id="{{$item->id}}">{{ $item->name }}</option>
                        @endforeach
                    </select>                                   
                @else
                    
                @endif
                
                <br/>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="file" id="files" name="files[]" multiple required="true" />
                <label for="files">Choose a file</label>
                <br>
                <label id="filesSelected">Files You Selected:</label>
                <ul id="fileList"><li>No Files Selected</li></ul>
                <input type="submit"/>
            </form>
        </div>

        <div style="width: 20%; min-height: 500px; background-color: bisque; float: right"></div>

    </body>
    <script>
        document.addEventListener("DOMContentLoaded", init, false);
        function init() {
            document.querySelector('#files').addEventListener('change', makeFileList, false);

        }
        function makeFileList() {
            var input = document.getElementById("files");
            var ul = document.getElementById("fileList");
            while (ul.hasChildNodes()) {
                ul.removeChild(ul.firstChild);
            }
            for (var i = 0; i < input.files.length; i++) {
                var li = document.createElement("li");
                li.innerHTML = input.files[i].name;
                ul.appendChild(li);
            }
            if (!ul.hasChildNodes()) {
                var li = document.createElement("li");
                li.innerHTML = 'No Files Selected';
                ul.appendChild(li);
            }
        }
    </script>
</html>
