<style>
   
    .bg-success{
        background:green!important;
    }

    .bg-danger{
        background:red;
    }
</style>
@php
        $attempt_question=session()->get('questions');
        $ans=session()->get('answers');
        $correct=0;
        $wrong=0;
     if( $attempt_question){
        $correct=$ans1->answer;

                if(in_array($ans1->qsn_number,$attempt_question)){
                    $current_q=array_search($ans1->qsn_number,$attempt_question);
                    if($ans[$current_q]==$ans1->answer){
                        $correct=$ans1->answer;
                    }else{
                        $wrong=$ans[$current_q];
    
                    }
    
                }else{
                    $wrong=888;

                }
     }else{
        $correct=$ans1->answer;

     }
         
       
@endphp

          
          {{-- answer for question  1 --}}
        <div class="circle card border  my-2 py-2 px-3 
        @if ($correct==1)
            bg-success text-white
        @endif
        
        @if ($wrong==1)
            bg-danger text-white
        @endif
        
        ">
        @if (!empty($ans1->option1))

                {{$ans1->option1}}
        @endif
        @if (str_contains($ans1->image1,'.png')||str_contains($ans1->image1,'.jpg')||str_contains($ans1->image1,'.jpeg')||str_contains($ans1->image1,'.gig')||str_contains($ans1->image1,'.pdf')||str_contains($ans1->image1,'.JPEG')||str_contains($ans1->image1,'.JPG'))
        <img src="{{$ans1->image1}}" alt="image" class="img-fluid" width="100" width="100">
        @endif
 
        @if (str_contains($ans1->image1,'.mp3')||str_contains($ans1->image1,'.mp4')||str_contains($ans1->image1,'.audio'))
             <audio controls src="{{$ans1->image1}}" controlsList="nodownload">
               </audio>
                 @endif 

        </div>

        <div class="circle card border  my-2 py-2 px-3
        @if ($correct==2)
        bg-success text-white
    @endif
    
    @if ($wrong==2)
        bg-danger text-white
    @endif
        
        ">
            @if (!empty($ans1->option2))
    
                    {{$ans1->option2}}
            @endif
            @if (str_contains($ans1->image2,'.png')||str_contains($ans1->image2,'.jpg')||str_contains($ans1->image2,'.jpeg')||str_contains($ans1->image2,'.gig')||str_contains($ans1->image2,'.pdf')||str_contains($ans1->image2,'.JPEG')||str_contains($ans1->image2,'.JPG'))
            <img src="{{$ans1->image2}}" alt="image" class="img-fluid" width="100" >
            @endif
     
            @if (str_contains($ans1->image2,'.mp3')||str_contains($ans1->image2,'.mp4')||str_contains($ans1->image2,'.audio'))
                 <audio controls src="{{$ans1->image2}}" controlsList="nodownload">
                   </audio>
                     @endif 
    
            </div>



            <div class="circle card border  my-2 py-2 px-3
            @if ($correct==3)
            bg-success text-white
        @endif
        
        @if ($wrong==3)
            bg-danger text-white
        @endif
            
            ">
                @if (!empty($ans1->option3))
        
                        {{$ans1->option3}}
                @endif
                @if (str_contains($ans1->image3,'.png')||str_contains($ans1->image3,'.jpg')||str_contains($ans1->image3,'.jpeg')||str_contains($ans1->image1,'.gig')||str_contains($ans1->image3,'.pdf')||str_contains($ans1->image3,'.JPEG')||str_contains($ans1->image3,'.JPG'))
                <img src="{{$ans1->image3}}" alt="image" class="img-fluid" width="100" >
                @endif
         
                @if (str_contains($ans1->image3,'.mp3')||str_contains($ans1->image3,'.mp4')||str_contains($ans1->image3,'.audio'))
                     <audio controls src="{{$ans1->image3}}" controlsList="nodownload">
                       </audio>
                         @endif 
        
                </div>




                <div class="circle card border  my-2 py-2 px-3
                
                @if ($correct==4)
                bg-success text-white
            @endif
            
            @if ($wrong==4)
                bg-danger text-white
            @endif
                ">
                    @if (!empty($ans1->option4))
            
                            {{$ans1->option4}}
                    @endif
                    @if (str_contains($ans1->image4,'.png')||str_contains($ans1->image4,'.jpg')||str_contains($ans1->image4,'.jpeg')||str_contains($ans1->image4,'.gig')||str_contains($ans1->image4,'.pdf')||str_contains($ans1->image4,'.JPEG')||str_contains($ans1->image4,'.JPG'))
                    <img src="{{$ans1->image4}}" alt="image" class="img-fluid" width="100" >
                    @endif
             
                    @if (str_contains($ans1->image4,'.mp3')||str_contains($ans1->image4,'.mp4')||str_contains($ans1->image4,'.audio'))
                         <audio controls src="{{$ans1->image4}}" controlsList="nodownload">
                           </audio>
                             @endif 
            
                    </div>


                    @if ($wrong==0)
                    <strong style="color: green">Solved & Correct</strong>

                        
                    @elseif ($wrong==888)
                    <strong style="color: red">Unsolved</strong>

                    @else    
                    <strong style="color: red">Solved but incorrect </strong>

                    @endif


