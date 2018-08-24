@extends('layouts.app')

@section('page_title') | Products @endsection
@section('content')
    <div class="container">
        <h2>Add Product</h2>
        <form class="form-add" method="post">
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="" placeholder="Enter Product Name">
            </div>
            <div class="form-group">
                <label for="">Quantity in stock</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
            </div>
            <div class="form-group">
                <label for="">Price per Item</label>
                <input type="number" class="form-control" id="price" placeholder="Price per Item" name="price">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
@section('page_script')
    <script type="text/javascript">
        jQuery( document ).ready( function () {
            jQuery( ".form-add" ).submit( function (e) {
                e.preventDefault();
                jQuery.ajax( {
                    type    : "POST",
                    url     : "/",
                    data    : {
                        "name"    : jQuery( "input[name=name]" ).val(),
                        "quantity": jQuery( "input[name=quantity]" ).val(),
                        "price"   : jQuery( "input[name=price]" ).val(),
                    },
                    dataType: 'json',
                    success : function (data) {
                        console.log( data )

                    },
                    error   : function (data) {
                        if ( typeof data.responseJSON !== 'undefined' ) {
                            if ( typeof data.responseJSON.message !== 'undefined' ) {
                                alert( data.responseJSON.message );
                            }
                        }
                    }
                } );
                return false;
            } )
        } );
    </script>
@endsection
