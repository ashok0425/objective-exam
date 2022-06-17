@extends('layout.master')

@section('content')
    {{-- <h4></h4> --}}


    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary pt-2">List of Exam</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-center" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Type</th>
                            <th>Exam name</th>
                            <th>Is Free</th>

                            <th>Take Exam</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @php
                                        echo $exam->category_id =='1' ? 'UBT' : 'CBT';
                                        
                                    @endphp
                                </td>
                                <td>{{ $exam->exam_name }}</td>


                                <td>
                                
                                    @if ($exam->exam_type == 1)
                                        <span class="badge bg-success text-white">

                                            Free
                                        </span>
                                    @else
                                        <span class="badge badge-danger text-white">

                                            Paid
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a 
                                    @if ($exam->exam_type == 1)
                                    href="{{ route('exam', ['id' => $exam->id,'name'=>$exam->exam_name]) }}"
                                    @else 
                                    onclick="alert('Please contact with the administration to proceed further')"
                                    @endif
                                    
                                     class="btn btn-primary"><i
                                            class="fa fa-edit"></i> </a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
