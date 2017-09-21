<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 22</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>
        <script source="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        </div>
        <div style="width: 20%; min-height: 500px; background-color: bisque;float: left"></div>

        <div style="float: left;align-items: center; width: 60%;background-color: #f5f5f5; min-height: 500px">
            <section class="panel panel-heading panel-primary">
                <div class="panel-heading">
                    File management
                </div>
                <div class="panel-body">
                    <table class="tabel table-bordered" style="border-collapse: collapse;width:100%">
                        <tr style="background-color: #AEAEAE">
                            <th style="width: 25%; text-align:left; border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; "><a href="{{action('YoloController@sortByFileName', ['id' => 1])}}">File name</a></th>
                            <th style="width: 25%; text-align:left; border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; "><span onclick='sortTable("major_name", {{$files}});'>Major type</span></th>
                            <th style="width: 25%; text-align:left; border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">User upload</th>
                            <th style="width: 25%; text-align:left; border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">Upload date</th>
                            <th style="width: 25%; text-align:left; border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">Action</th>
                        </tr>
                        @foreach($files as $file)
                            <tr>
                                <td style="border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">{{ $file->file_name}}</td>
                                <td style="border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">{{$file->major_name}}</td>
                                <td style="border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">{{ $file->user_name }}</td>
                                <td style="border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">{{$file->update_date}}</td>
                                <td style="border-top: 1pt solid #9d9d9d; border-bottom: 1pt solid #9d9d9d; ">
                                    <a target="_blank" download="{{$file->file_name}}" href="../../storage\app\uploads\/{{$file->major_name}}/{{$file->name_gen}}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-download">
                                                Download
                                            </i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div style="text-align: center;padding-top: 20px;">
                    {{ $files->appends(array('numberPerPage' => $numberPerPage))->links('pagination.custom') }}
                </div>
            </section>
        </div>
        <div style="width: 20%; min-height: 500px; background-color: bisque; float: right">

        </div>

    </body>
</html>
<script>
    function sortTable(columnName, files){
        $.ajax({
            type: "POST",
            url: '/orderdata', // This is what I have updated
            data: { id: 7 }
        }).done(function( msg ) {
            alert( msg );
        });
    }
function sortTable1(columnName, files){
 alert(columnName);
 alert('$files');
 var sort = $("#sort").val();
 $.ajax({
  url:'fetch_details.php',
  type:'post',
  data:{columnName:columnName,sort:sort},
  success: function(response){
 
   $("#empTable tr:not(:first)").remove();
 
   $("#empTable").append(response);
   if(sort == "asc"){
     $("#sort").val("desc");
   }else{
     $("#sort").val("asc");
   }
 
  }
 });
}
</script>