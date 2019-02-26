@extends('layouts.admin')

@section('content')

    <style type="text/css">
        .searchresults {
            
        }

        .searchresult {

        }
    </style>

    <div class="container">
    
        <h4 style="text-align: center;">Manage Users</h4>

        <br>

        <p style="text-align: center;">
            This panel enables you to disable or enable user accounts.
        </p>
        
        <p>
            <input type="text" name="" class="form-control" placeholder="Search" onkeyup="searchforusers()" id="name">
        </p>

        <div style="width: 80%; position: relative; left: 10%;" class="searchresults">

            
            
        </div>
        
        
        <script type="text/javascript">
            
                function searchforusers(){
                    var name = $('#name').val();
                    if(name == '')
                        return clearsearch();

        $.ajax({
            type: 'POST',
            url: '/admin/searchforusers',
            data: {_token: $('#meta-csrf').val(), name: name },
            success: function(users) {

                clearsearch();
                var $contents = '';
                console.log(users);

                for(var i=0; i<users.length; i++)
                {
                    var user = users[i];
                    $contents += ''+
                    '<div style="margin: 0.5em 2.5%; width: 44%;float: left;">'+
                        '<h5>'+
                            user.name;
                            if(user.status == 'active')
                            {
                                $contents += ''+
                                '<button class="btn btn-sm btn-danger right-side" onclick="disableuser('+user.id+')">Disable</button>';
                            }
                            else
                            {
                                $contents += ''+
                                '<button class="btn btn-sm btn-success right-side" onclick="enableuser('+user.id+')">Enable</button>';
                            }
                        $contents += ''+
                        '</h5>'+
                        '<p>Email: '+user.email+'<br>'+
                        'Phone: '+user.phone+'<br>'+
                        'Balance: KES '+user.balance+'<br>'+
                        user.role+'</p>'+
                    '</div>';
                }

                $('.searchresults').append($contents);
                    
            },
            error: function(e) {
                
                alert("Failed to submit search");
                console.log(e);
                
            },
        });


                }

                function clearsearch(){

                    $('.searchresults').children().remove();
                    //$('#name').val('');
                    console.log("Search cleared");

                }

                function enableuser(user_id){

                    $.ajax({
                        type: 'POST',
                        url: '/admin/enableuser',
                        data: {_token: $('#meta-csrf').val(), user_id: user_id },
                        success: function(users) {

                            clearsearch();
                            alert("User activated");
                        },
                        error: function(e) {
                            
                            alert("Failed to send request");
                            console.log(e);
                            
                        },
                    });

                }

                function disableuser(user_id){

                    $.ajax({
                        type: 'POST',
                        url: '/admin/disableuser',
                        data: {_token: $('#meta-csrf').val(), user_id: user_id },
                        success: function(users) {

                            clearsearch();
                            alert("User deactivated");
                        },
                        error: function(e) {
                            
                            alert("Failed to send request");
                            console.log(e);
                            
                        },
                    });

                }
            
        </script>
                    
    </div>
                    
@endsection
