

<style>
    
    .btn_group{
        position: fixed;
        bottom: 0%;
        z-index: 999;
width: 98%;
left: 2%;
    }
    .cursor-pointer{
        cursor: pointer;
    }

    .boxed label {
    display: inline-block;
    width: 33px;
    height: 33px;
    border: solid 2px #ccc;
    transition: all 0.3s;
    border-radius: 50%;
    text-align: center;
    cursor: pointer;
    line-height: 2
  }
  
  .boxed input[type="radio"] {
    display: none;
  }
  
  .boxed input[type="radio"]:checked + label {
    border: solid 2px rgb(0, 51, 128);
    background:  rgb(0, 51, 128);
    color: #fff;

  }
  
</style>

<div class="card">



<input type="hidden" value="{{$question->qsn_number}}" id="qsn_visited">
       
        <div class="row">
            <div class="col-md-5 offset-md-1 " style="height: 48vh;overflow-y:scroll">
<div class="card-body ">

                    <div class="py-4 my-2 bg-light px-2 question cursor-pointer" >
                        <h6 class="m-0 font-weight-bold text-primary  ">
                            {{$question->qsn_number}}. {{$question->heading}}
                        </h6>
                        <h6 class="m-0  text-primary pt-2">
                            {{-- checking if text question or question file or audiofile  --}}
                            @if (!empty($question->question))
                            {{$question->question}}
                            @endif
                        </h6>
                    
                        @if (!empty($question->textbox))
                        <div class="card" style="width: 80%">
                            <div class="card-body">
                        {{$question->textbox}}
                    </div>
                    
                        </div>
                        @endif
                            
                    
                           @if (str_contains($question->questionfile,'.png')||str_contains($question->questionfile,'.jpg')||str_contains($question->questionfile,'.jpeg')||str_contains($question->questionfile,'.gig')||str_contains($question->questionfile,'.pdf')||str_contains($question->questionfile,'.JPEG')||str_contains($question->questionfile,'.JPG'))
                           <img src="{{$question->questionfile}}" alt="image" class="img-fluid" width="180">
                           <br>

                           @endif
                    
                           @if (str_contains($question->qsnAudiofile,'.mp3')||str_contains($question->qsnAudiofile,'.mp4')||str_contains($question->qsnAudiofile,'.audio'))
                           <br>

                           <span class="play mt-1  px-5 py-2 cursor-pointer" data-src="{{$question->qsnAudiofile}}" data-id="{{$question->qsn_number}}">
                            <i class="fa fa-headphones"> </i>
                           </span>
                               
                                    @endif 
                    </div>
                    
                </div>

                    
            </div>
            <div class="col-md-5 " style="height:48vh;overflow-y:scroll">
                <div class="card-body ">


                <div class="answer mt-3"  >
                    @php
                        $ans1=$question;
                    @endphp
                      
                      <div class="d-flex  align-items-center">
                      <span class="boxed">
                        <input type="radio" id="1" name="skills" value="1">
                    <label for="1" data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}" data-aid="1" class="ans_click">1</label>
                    </span>
                    &nbsp;
                    &nbsp;

                          {{-- answer for question  1 --}}
                    <div class="circle card border bg-light my-2 py-2 px-3 w-100">

                       
                        <span>

                        @if (!empty($ans1->option1))
                
                                {{$ans1->option1}}
                        @endif
                        @if (str_contains($ans1->image1,'.png')||str_contains($ans1->image1,'.jpg')||str_contains($ans1->image1,'.jpeg')||str_contains($ans1->image1,'.gig')||str_contains($ans1->image1,'.pdf')||str_contains($ans1->image1,'.JPEG')||str_contains($ans1->image1,'.JPG'))
                        <img src="{{$ans1->image1}}" alt="image" class="img-fluid" width="80" >
                        @endif
                 
                        @if (str_contains($ans1->image1,'.mp3')||str_contains($ans1->image1,'.mp4')||str_contains($ans1->image1,'.audio'))
                        <div class="ans_play cursor-pointer mt-1" data-src="{{$ans1->image1}}" data-id="{{$ans1->qsn_number}}_1">
                          <i class="fa fa-play"></i>
                         </div>
                                 @endif 
                                </span>
                
                        </div>
                    </div>


                    <div class="d-flex  align-items-center">
                        <span class="boxed">
                          <input type="radio" id="2" name="skills" value="2">
                      <label for="2" data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}" data-aid="2" class="ans_click">2</label>
                      </span>
                      &nbsp;
                      &nbsp;
                    
                    <div class="circle card border bg-light my-2 py-2 px-3 w-100">
                        <span>
                        @if (!empty($ans1->option1))
                
                                {{$ans1->option1}}
                        @endif
                        @if (str_contains($ans1->image2,'.png')||str_contains($ans1->image2,'.jpg')||str_contains($ans1->image2,'.jpeg')||str_contains($ans1->image2,'.gig')||str_contains($ans1->image2,'.pdf')||str_contains($ans1->image2,'.JPEG')||str_contains($ans1->image2,'.JPG'))
                        <img src="{{$ans1->image2}}" alt="image" class="img-fluid" width="80" >
                        @endif
                 
                        @if (str_contains($ans1->image2,'.mp3')||str_contains($ans1->image2,'.mp4')||str_contains($ans1->image2,'.audio'))
                        <div class="ans_play cursor-pointer mt-1" data-src="{{$ans1->image2}}" data-id="{{$ans1->qsn_number}}_2">
                          <i class="fa fa-play"></i>
                         </div>
                                 @endif 
                                </span>
                        </div>
                    </div>


            
             <div class="d-flex  align-items-center">
                      <span class="boxed">
                        <input type="radio" id="3" name="skills" value="3">
                    <label for="3" data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}" data-aid="3" class="ans_click">3</label>
                    </span>
                    &nbsp;
                    &nbsp;
                        <div class="circle card border bg-light my-2 py-2 px-3 w-100">
                            <span>
                            @if (!empty($ans1->option3))
                    
                                    {{$ans1->option3}}
                            @endif
                            @if (str_contains($ans1->image3,'.png')||str_contains($ans1->image3,'.jpg')||str_contains($ans1->image3,'.jpeg')||str_contains($ans1->image1,'.gig')||str_contains($ans1->image3,'.pdf')||str_contains($ans1->image3,'.JPEG')||str_contains($ans1->image3,'.JPG'))
                            <img src="{{$ans1->image3}}" alt="image" class="img-fluid" width="80" >
                            @endif
                     
                            @if (str_contains($ans1->image3,'.mp3')||str_contains($ans1->image3,'.mp4')||str_contains($ans1->image3,'.audio'))
                            <div class="ans_play cursor-pointer mt-1" data-src="{{$ans1->image3}}" data-id="{{$ans1->qsn_number}}_3">
                              <i class="fa fa-play"></i>
                             </div>
                                     @endif 
                                    </span>
                            </div>
            
             </div>



            
             <div class="d-flex  align-items-center">
                      <span class="boxed">
                        <input type="radio" id="4" name="skills" value="4">
                    <label for="4" data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}" data-aid="4" class="ans_click">4</label>
                    </span>
                    &nbsp;
                    &nbsp;
                            <div class="circle card border bg-light my-2 py-2 px-3 w-100">
                                <span>
                                @if (!empty($ans1->option4))
                        
                                        {{$ans1->option4}}
                                @endif
                                @if (str_contains($ans1->image4,'.png')||str_contains($ans1->image4,'.jpg')||str_contains($ans1->image4,'.jpeg')||str_contains($ans1->image4,'.gig')||str_contains($ans1->image4,'.pdf')||str_contains($ans1->image4,'.JPEG')||str_contains($ans1->image4,'.JPG'))
                                <img src="{{$ans1->image4}}" alt="image" class="img-fluid" width="80" >
                                @endif
                         
                                @if (str_contains($ans1->image4,'.mp3')||str_contains($ans1->image4,'.mp4')||str_contains($ans1->image4,'.audio'))
                                <div class="ans_play cursor-pointer mt-1" data-src="{{$ans1->image4}}" data-id="{{$ans1->qsn_number}}_4">
                                  <i class="fa fa-play"></i>
                                 </div>
                                         @endif 
                                        </span>
                                </div>
             </div>
            
            
            
                   </div>
                </div>


        </div>

        {{-- btn group  --}}
        <div class="btn_group">
            <div class="card pl-3 ">
    <div class="row mt-4 ">
        <div class="col-md-2 my-1 col-3">
                
            <button class="btn btn-primary go_prev 
            @if ($question->qsn_number==1)
            d-none
            @endif
            " data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}"> <i class="fas fa-backward "></i> Prev </button>
        </div>
        <div class="col-md-4 offset-md-2 my-1 col-6 text-center">
            <button class="btn btn-primary back_top_question_list"><i class="fab fa-windows "></i> Total Question 40</button>
        </div>
        <div class="col-md-2 offset-md-2 my-1 col-3">

            <button class="btn btn-primary go_next 
              @if ($question->qsn_number==40)
            d-none
            @endif
            " data-exam_id="{{$question->exam_id}}" data-qns_id="{{$question->qsn_number}}">Next <i class="fas fa-forward "></i></button>

        </div>
    </div>
</div>
</div>
</div>
</div>



    {{-- saving the answer in session --}}

    <script>
        $(document).on('click','.ans_click',function(){
        let eid=$(this).data('exam_id');
          let qid=$(this).data('qns_id');
          let aid=$(this).data('aid');
          $.ajax({
                    url:'{{url('save-answer')}}',
                    dataType:'html',
                    data:{eid:eid,qid:qid,aid:aid},
                    type:'GET',
                    success:function(res){
                        $('.total_question').html(40)
            $('.solved_question').html(res)
            $('.remaining_question').html(40-res)

                    }
                })

        })



         qid=$('#qsn_visited').val();
          $.ajax({
                    url:'{{url('qsn-visited')}}',
                    dataType:'html',
                    data:{qid:qid},
                    type:'GET',
                    success:function(res){
                    }
                })




    </script>