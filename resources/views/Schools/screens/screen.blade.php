<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--style css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">


    <!---google-font--->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        ul{
            height: 260px;
            overflow-y: hidden;
        }
    </style>
</head>


<body>
    <div class="main-container">
        <header></header>

        <div class="container-fluid row names-container">

            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف الأول</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade1-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade1-col2">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف الثاني</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade2-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade2-col2">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف الثالث</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade3-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade3-col2">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف الرابع</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade4-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade4-col2">
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف الخامس</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade5-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade5-col2">
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 names-wrap">
                <h5 class="grade">الصف السادس</h5>
                <div class="students-div">
                    <div class="col-lg-6 names-col">
                        <ul class="names-list"  id="grade6-col1">
                        </ul>
                    </div>
                    <div class="col-lg-6 names-col"> 
                        <ul class="names-list"  id="grade6-col2">
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
    
    <audio controls>
        <source id="source" src="{{ asset('welcome.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('560e577752080460bf19', {
            cluster: 'eu'
        }); 
    </script>
    
<script>
    var channel = pusher.subscribe('call_student');

    channel.bind('App\\Events\\CallStudent',function(obj){ 
        var rand = Math.floor(Math.random() * 10) + 1;
        if(obj['school_id'] == '{{$school->id}}'){
            var ul = '<div class="name" id="' + obj['student_id'] + '"> <p class="bullet">' + obj['class_number'] + '</p> <li>' + obj['name'] + rand + '</li> </div>';
            
            var col1_length = $('#grade'+obj['academic_level']+'-col1 > div').length;
            var col2_length = $('#grade'+obj['academic_level']+'-col2 > div').length;

            if(col1_length > col2_length){
                $('#grade'+obj['academic_level']+'-col2').prepend(ul);
            }else{
                $('#grade'+obj['academic_level']+'-col1').prepend(ul);
            }

            var repeat = 0;

            $('audio #source').attr('src', obj['voice']);

            repeat++;
            
            if($('audio').get(0).paused){ 
                $('audio').get(0).load();
                $('audio').get(0).play(); 
            }else{  
                $('audio').on("ended", function() {  
                    if(repeat > 0){
                        $('audio').get(0).load();
                        $('audio').get(0).play(); 
                        repeat--;
                    } 
                });   
            } 
            
            setTimeout(function(){ 
                $('#'+ obj['student_id']).fadeOut(300, function(){ $(this).remove();});
            }, 5000);
        }
    });
</script>

</body>

</html>
