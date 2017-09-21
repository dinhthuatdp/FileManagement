@extends('layouts.master')

@section('title', 'Dash board')

@section('content')
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
@stop

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