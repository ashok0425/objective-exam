
   <div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary pt-2 ">
                Your result summary
                </h6>
            </div>
        <div class="card-body">

        <table class="table">
<tr>
    <th>
        Number of question visited
    </th>
    <th>
        @if (session()->has('visited_qns'))
        {{count(session()->get('visited_qns'))}}
            
        @else    
        0
        @endif
    
    </th>
</tr>

<tr>
    <th>
        Number of successful attempts
    </th>
    <th>
@if (session()->get('questions'))
{{$suc_att}}
    @else  
    0
@endif
    </th>
</tr>


<tr>
    <th>
        Number of incorrect attempts
    </th>
    <th>{{$att}}</th>
</tr>

<tr>
    <th>
        Number of unattempted question
    </th>
    <th>
        @if (session()->get('questions'))
        {{40-count(session()->get('questions'))}}
            @else  
            40
        @endif
    </th>
</tr>



<tr class="border-bottom">
    <th>
        Total percent
    </th>
    <th>

        @php

          $perct=($suc_att/40)*100
        @endphp

        {{number_format($perct,1)}}
    </th>
</tr>


        </table>
        <div class="text-center">
            <button class="btn btn-primary view_ans"><i class="fas fa-eye"></i> View Answer</button>

        </div>

    </div>
</div>

    </div>
   </div>

   