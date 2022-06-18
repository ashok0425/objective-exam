@extends('layout.master')

@section('content')

    {{-- time css --}}
    <style>

/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #005596; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #00b3b3; 
}







         .sidebar{
        display: none!important;
    }
        .progressBar {
            width: 90%;
            height: 22px;
            background-color: #0A5F44;
        }

        .progressBar div {
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

    <div class="row mb-3">
        <div class="col-md-10 offset-md-1">
            <div class="card">

                <div class="card-body py-0 ">
                    <div class="all_qns">
                    <div class="row border-bottom py-2 ">
                        <div class="col-md-4 text-center">lorem 40 ipsum</div>
                        <div class="col-md-4 text-center">{{session()->get('exam_name')}}</div>
                        <div class="col-md-4 text-center">Name: {{session()->get('user')->first_name . session()->get('user')->last_name}}</div>
        
                    </div>
                </div>

                    <div class="row py-2 ">
                        <div class="col-md-4 text-center all_qns">{{session()->get('user')->exam_type}} test room {{rand(1,10)}}</div>
                        
                        <div class="col-md-4 text-center d-none detail_qns">{{session()->get('exam_name')}}</div>

                        <div class="col-md-2 text-center border-left">
                
                                    Total Question
                                  <span id="total_question"> 40</span> 
                        </div>
                        <div class="col-md-2 text-center border-left ">

                            Solved Question
                            <span id="solved_question">  0</span>
                        </div>
                        <div class="col-md-2 text-center border-left">
                            Unsolved Question
                            <span id="remaining_question">  0</span>
                        
                        </div>
                        <div class="col-md-2 text-center border-left">  
                             <div class="progressBar">
                            <div class="bar"></div>
                        </div>
         </div>

        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="all_question py-2">
        
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
            progress(3000, 3000, $('.progressBar'));
                
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
            // $(window).on('load',function(){
         <?php
         session()->forget('answers');
         session()->forget('questions');
         session()->forget('visited_qns')
         ?>
                loadallquestion()
            })
            $(document).on('click','.back_top_question_list',function(){
           
              loadallquestion()

              $('.detail_qns').removeClass('d-block')
            $('.detail_qns').addClass('d-none')
            $('.all_qns').removeClass('d-none')
            $('.all_qns').addClass('d-block')
             })


        // })


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
$('.all_qns').removeClass('d-block')
$('.all_qns').addClass('d-none')
 $('.detail_qns').removeClass('d-none')
$('.detail_qns').addClass('d-block')
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
