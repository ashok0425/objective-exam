

<div class="container-fluid">
    <div class="row">

        <div class="col-md-5">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
        <h6  class="m-0 font-weight-bold text-primary pt-2 load-question text-decoration-none cursor-pointer" >
            <i class="fab fa-readme"></i> Reading <strong>(Q.{{count($questions)/2}})</strong>
        </h6>
    </div>
<input type="hidden"  id="base_question"    data-exam_id="{{$questions[0]->exam_id}}" data-qns_id="{{$questions[0]->qsn_number}}" >

    <div class="col-md-4 offset-md-2">
        <h6  class="m-0 font-weight-bold text-primary pt-2 load-question text-decoration-none cursor-pointer">
            <i class="fab fa-readme"></i> Preview
        </h6>
    </div>
    </div>
            </div>
            
            <div class="row">
                {{-- {{ dd() }} --}}
                    @for ($i =0 ; $i <20 ; $i++)
                        <div class="col-md-3 col-4 my-1">
                            
                          
                            <h6 data-exam_id="{{$questions[$i]->exam_id}}" data-qns_id="{{$questions[$i]->qsn_number}}" class="text-decoration-none cursor-pointer load-question  
                                @if (session()->has('questions'))
                            @if (in_array($questions[$i]->qsn_number,session()->get('questions')))
                                bg-success text-white
                            @endif
                            @endif
                                ">
                            <div class=" card bg-transparent py-3 text-center">
                               {{ $questions[$i]->qsn_number}}
                            </div>
                        </h6>
                        </div>
                    @endfor

            </div>
        </div>




        <div class="col-md-5 offset-md-1">


            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
        <h6  class="m-0 font-weight-bold text-primary pt-2 cursor-pointer  text-decoration-none load-question">
            <i class="fab fa-readme"></i> Listening <strong>(Q.{{count($questions)/2}})</strong>
        </h6>
    </div>


    <div class="col-md-4 offset-md-2">
        <h6 href="" class="m-0 font-weight-bold text-primary pt-2  text-decoration-none cursor-pointer load-question">
            <i class="fab fa-readme"></i> Preview
        </h6>
    </div>
    </div>
            </div>



            <div class="row">
                {{-- {{ dd() }} --}}
                    @for ($i =20 ; $i <40 ; $i++)
                        <div class="col-md-3 col-4 my-1">
                            <h6 data-exam_id="{{$questions[$i]->exam_id}}" data-qns_id="{{$questions[$i]->qsn_number}}" class="text-decoration-none cursor-pointer load-question  
                                @if (session()->has('questions'))
                            @if (in_array($questions[$i]->qsn_number,session()->get('questions')))
                                bg-success text-white
                            @endif
                            @endif
                                ">
                            <div class=" card bg-transparent py-3 text-center">
                               {{ $questions[$i]->qsn_number}}
                            </div>
                        </h6>
                        </div>
                    @endfor

            </div>
            <div class="row mt-2">
                <div class="col-md-6 offset-md-6">
                    <button class="btn btn-primary submit-ans">Submit Answer <i class="fas fa-paper-plane"></i></button>

                </div>
            </div>
        </div>
      