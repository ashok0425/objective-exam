
<style>
    .circle{
        border-radius: 50px;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>

<input type="hidden" value="{{$questions[0]->exam_id}}" id="exam_id">
   <div class="card">
    <div class="card-body">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary pt-2 ">
                Answer of exam {{$exam_name}}
            </h6>
        </div>
        <div class="row">
            <div class="col-md-6" style="height: 450px;overflow:scroll">
@foreach ($questions as $key=> $question)
<div class="py-4 my-2 bg-light px-2 click_question cursor-pointer" data-qid="{{$question->qsn_number}}"
    <h6 class="m-0 font-weight-bold text-primary ">
        {{$loop->iteration}}. {{$question->heading}}
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
       <img src="{{$question->questionfile}}" alt="image" class="img-fluid" >
       @endif

       @if (str_contains($question->qsnAudiofile,'.mp3')||str_contains($question->qsnAudiofile,'.mp4')||str_contains($question->qsnAudiofile,'.audio'))
            <audio controls src="{{$question->qsnAudiofile}}" controlsList="nodownload">
              </audio>
                @endif 
</div>
@endforeach
  </div>

            {{-- answer sectioon  --}}
            <div class="col-md-6" style="height: 450px;overflow:scroll">
<div class="answer mt-3">
</div>

    </div>
        </div>
    </div>
   </div>


   <script>
    $('.click_question').on('click',function(){
    let eid=$('#exam_id').val();
    let qid=$(this).data('qid');
    $(this).siblings().css('border','0')
    $(this).css('border','1px solid blue')
    loadSingleAnswer(eid,qid)

    

    })
    let eid=$('#exam_id').val();
    let qid=1
    loadSingleAnswer(eid,qid)
    function loadSingleAnswer(eid,qid){
        $.ajax({
                    url:'{{url('single-ans')}}',
                    dataType:'html',
                    data:{eid:eid,qid:qid},
                    type:'GET',
                    success:function(res){
                        $('.answer').html(res)
                    }
                })
    }
       
   </script>