@extends('layout.master')

@section('content')
    {{-- time css --}}
    <style>
        #progressBar {
            width: 90%;
            margin: 10px auto;
            height: 22px;
            background-color: #0A5F44;
        }

        #progressBar div {
            height: 100%;
            text-align: right;
            padding: 0 10px;
            line-height: 22px;
            /* same as #progressBar height if we want text middle aligned */
            width: 0;
            background-color: #CBEA00;
            box-sizing: border-box;
        }
        .cursor-pointer{
        cursor: pointer;
    }
    </style>



<div class="whole_page">
    <div class="card shadow ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h6 class="m-0 font-weight-bold text-primary pt-2 ">{{ $exam_name }}</h6>

                </div>
                <div class="col-md-3">

                    <h6 class="m-0 font-weight-bold text-primary pt-2  text-center ">
                        Total Question
                        <br>
                      <span id="total_question"> 40</span> 
                    </h6>
                </div>

                <div class="col-md-3">
                    <h6 class="m-0 font-weight-bold text-primary pt-2 text-center">
                        Remaining Question
                        <br>
                      <span id="remaining_question">  0</span>
                    </h6>
                </div>

                <div class="col-md-3">
                    <h6 class="m-0 font-weight-bold text-primary pt-2 text-center">
                        Time
                        <br>
                        <div id="progressBar">
                            <div class="bar"></div>
                        </div>

                    </h6>
                </div>
            </div>
        </div>

        <div class="card-body all_question">
          
                   

                    </div>
                </div>

               
              

            </div>
        </div>
    </div>

        <script>
  


            $(document).ready(function(){

            function progress(timeleft, timetotal, $element) {
                var progressBarWidth = timeleft * $element.width() / timetotal;
                $element.find('div').animate({
                    width: progressBarWidth
                }, 500).html(Math.floor(timeleft / 60) + ":" + timeleft % 60);
                if (timeleft > 0) {
                    setTimeout(function() {
                        progress(timeleft - 1, timetotal, $element);
                    }, 1000);
                }
            };

            setTimeout(() => {
            progress(30000, 30000, $('#progressBar'));
                
            }, 2000);

        



            // load single question 
            $(document).on('click','.load-question',function(){
                let eid=$(this).data('exam_id');
                let qid=$(this).data('qns_id');

                if(eid==null||qid==null){
                eid=$('#base_question').data('exam_id');
                 qid=$('#base_question').data('qns_id');
                }
                loadSinglequestion(eid,qid)
            })


           
         // loading data after loading page 
            $(window).on('load',function(){
         <?php
         session()->forget('answers');
         session()->forget('questions');
         session()->forget('visited_qns')
         ?>
                loadallquestion()
            })
            $(document).on('click','.back_top_question_list',function(){
                    loadallquestion()
             })


        })


// loading all question 
        function loadallquestion(){
            $.ajax({
                    url:'{{url('load-all-question')}}',
                    dataType:'html',
                    type:'GET',
                    beforeSend:function(){
                        $('.all_question').html('<div class="text-center"><div class="spinner-border" role="status">  <span class="sr-only">Loading...</span></div></div>')
                    },
                    success:function(res){
                        $('.all_question').html(res)
                    }
                })
        }


        // go back on clicking prev btn 
        $(document).on('click','.go_prev',function(){
            let eid=$(this).data('exam_id');
          let qid=$(this).data('qns_id');
            loadSinglequestion(eid,qid-1);
        })


        
        // go next on clicking next btn 
        $(document).on('click','.go_next',function(){
            let eid=$(this).data('exam_id');
          let qid=$(this).data('qns_id');
            loadSinglequestion(eid,qid+1);
        })




        // loading single question 
        function loadSinglequestion(eid,qid){
             
            $.ajax({
                    url:'{{url('load-question')}}',
                    dataType:'html',
                    data:{eid:eid,qid:qid},
                    type:'GET',
                    success:function(res){
                        $('.all_question').html(res)
                    }
                })
        }

     
        //  on clciking submit answer button
         $(document).on('click','.submit-ans',function(){
            $.ajax({
                    url:'{{url('submit-ans')}}',
                    dataType:'html',
                    type:'GET',
                    success:function(res){
                        $('.whole_page').html(res)
                    }
                })
        })

        </script>

        <script>

    $(document).on('click','.view_ans',function(){
        $.ajax({
                    url:'{{url('view-ans')}}',
                    dataType:'html',
                    type:'GET',
                    success:function(res){
                        $('.whole_page').html(res)
                    }
                })
    })











    
    // for question audio play 
    $(document).ready(function() {
      
      let hasplayed=[];
    var audioElement = document.createElement('audio');
      function createPlay(src){
    audioElement.setAttribute('src', src);
    audioElement.play();
    
  }

  audioElement.addEventListener('ended', function() {
    $('.body_overlay').removeClass('d-block')
      $('.body_overlay').addClass('d-none')
    }, false);
    
  
    
    $(document).on('click','.play',function() {
      $id=$(this).data('id')
      if(hasplayed.includes($id)){

      }else{
        $src=$(this).data('src')
      hasplayed.push($id)
      $(this).html('<i class="fa fa-pause"></i>')
      createPlay($src)
      $('.body_overlay').removeClass('d-none')
      $('.body_overlay').addClass('d-block')

      }
     
    });
 
});

















// for question audio play 
    $(document).ready(function() {
      
      let hasAnsplayed=[];
    var audioElement = document.createElement('audio');
      function createPlay(src){
    audioElement.setAttribute('src', src);
    audioElement.play();
    
  }

  audioElement.addEventListener('ended', function() {
    $('.body_overlay').removeClass('d-block')
      $('.body_overlay').addClass('d-none')
    }, false);
    
  
    
    $(document).on('click','.ans_play',function() {
      $id=$(this).data('id')
      if(hasAnsplayed.includes($id)){

      }else{
        $src=$(this).data('src')
        hasAnsplayed.push($id)
      $(this).html('<i class="fa fa-pause"></i>')
      createPlay($src)
      $('.body_overlay').removeClass('d-none')
      $('.body_overlay').addClass('d-block')

      }
     
    });
 
});

  
   </script>
    @endsection
