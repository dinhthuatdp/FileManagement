@extends('layouts.master')

@section('title', 'Dash board')

@section('content')
<div class="form-group col-lg-6">
    <div class="box-body">
        <div class="form-group">
            <label>Category name</label>
            <input type="text" id="txtCategoryName" class="form-control" placeholder="Enter category name ...">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="txtCategoryDescription" rows="3" placeholder="Enter ..."></textarea>
        </div>
        <div class="">
            <button type="submit" class="btn btn-info">Add</button>
            <button type="submit" class="btn btn-default pull-right">Cancel</button>
        </div>
    </div>
</div>
@stop