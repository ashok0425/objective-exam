<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{




    public function index()
    {

        $user = session()->get('user');
        $ex_type = $user->exam_type == 'CBT' ? 2 : 1;

        $url = "https://hangukapi.nitlegend.com/login/catwise_exam_list1";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Bearer 393|woEcPMnz2ycSaX6amRu1LppexklHP3nEIUZ8veKh",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data =
            [
                "category_id" => $ex_type

            ];


        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($resp);

        if ($res->status) {
            $exams = $res->data;
            return view('exam.index', compact('exams'));
        } else {
            $notification = array(
                'alert-type' => 'error',
                'messege' => 'Something went  wrong.Try again later',

            );
            return redirect()->back()->with($notification);
        }
    }


   public  function detail($id,$name){
    $user = session()->get('user');
  $ex_type = $user->exam_type == 'CBT' ? 2 : 1;
    $exam_name =Request()->segment(3);
    session()->put('allquestion',['category_id'=>$ex_type,'exam_id'=>$id]);
    return view('exam.detail', compact('exam_name'));



    }



public function loadQuestion(Request $request){

    
$url = "https://hangukapi.nitlegend.com/login/examwise_singleqsn";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Authorization: Bearer 393|woEcPMnz2ycSaX6amRu1LppexklHP3nEIUZ8veKh",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = 
[
    "qsn_number" =>$request->qid, 
    "exam_id"=>$request->eid
];

curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

$res=json_decode($resp);
$question=$res->data[0];
return view('exam.question-answer',compact('question'));
}






public  function loadAllquestion(){
    $exam_id=session()->get('allquestion')['exam_id'];
    $category_id=session()->get('allquestion')['category_id'];
$res=$this->loadexam($exam_id,$category_id);
if ($res->status) {
    $questions = $res->data;
    return view('exam.question_list', compact('questions'));
}

    }



    public function loadexam($exam_id,$category_id){
    
        $url = "https://hangukapi.nitlegend.com/login/examwise_qsn";
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array(
        //    "Authorization: Bearer 393|woEcPMnz2ycSaX6amRu1LppexklHP3nEIUZ8veKh",
           "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $data = 
        [
            "category_id" =>$category_id, 
            "exam_id"=>$exam_id
        ];
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($resp);
        return $res;
        }



    public function saveAnswer(Request $request){

        $qid=$request->qid;
        $aid=$request->aid;
        // session()->forget('answers');
        //  session()->forget('questions');
        if(session()->has('answers') && session()->has('questions')){
            $ans=  session()->get('answers');
            $qns=  session()->get('questions');
            if(in_array($qid,$qns)){
                foreach($qns as $key => $value){
                    if($value==$qid){
                     $ans[$key]=$aid;
                    }
                  }
            }else{
                $ans[]=$aid;
                $qns[]=$qid;
            }
          
           

            session()->put('answers',$ans);
            session()->put('questions',$qns);



        }else{
                if($qid!=null){
                    $ans[]=$aid;
                    $qns[]=$qid;
                    session()->put("answers",$ans);
                  session()->put("questions",$qns);
                }
        
        }

return count(session()->get('questions'));
    }







    public  function SubmitAns(){
        $exam_id=session()->get('allquestion')['exam_id'];
        $category_id=session()->get('allquestion')['category_id'];
        $attempt_question=session()->get('questions');
        $ans=session()->get('answers');
        $res=$this->loadexam($exam_id,$category_id);
        $questions = $res->data;
        $att=0;
        $suc_att=0;
        if($attempt_question){
            foreach ($questions as $key => $value) {
                if(in_array($value->qsn_number,$attempt_question)){
                    $current_q=array_search($value->qsn_number,$attempt_question);
                    if($ans[$current_q]==$value->answer){
                        $suc_att=$suc_att+1;
                    }else{
                        $att=$att+1;
    
                    }
    
                }
            }
        }
       
        return view('exam.summary',compact('att','suc_att'));
  
    }
    
    


    public function qsnVisisted(Request $request){
        $qid=$request->qid;
        if(session()->has('visited_qns')){
            $qns=  session()->get('visited_qns');
            if(in_array($qid,$qns)){
                foreach($qns as $key => $value){
                    if($value==$qid){
                     $qns[$key]=$qid;
                    }
                  }
            }else{
                $qns[]=$qid;
            }
                      session()->put('visited_qns',$qns);
        }else{
                if($qid!=null){
                    $qns[]=$qid;
                  session()->put("visited_qns",$qns);
                }
        
        }

return count(session()->get('visited_qns'));
    }





    public  function viewAns(){
        $exam_id=session()->get('allquestion')['exam_id'];
        $category_id=session()->get('allquestion')['category_id'];
    $res=$this->loadexam($exam_id,$category_id);
        $questions = $res->data;
        $exam_name =Request()->segment(3);
        return view('exam.answers', compact('questions','exam_name'));
    
    }
    
    


    
public function SingleAns(Request $request){

    
    $url = "https://hangukapi.nitlegend.com/login/examwise_singleqsn";
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Authorization: Bearer 393|woEcPMnz2ycSaX6amRu1LppexklHP3nEIUZ8veKh",
       "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    $data = 
    [
        "qsn_number" =>$request->qid, 
        "exam_id"=>$request->eid
    ];
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    
    $res=json_decode($resp);
    $ans1=$res->data[0];
    return view('exam.single_ans',compact('ans1'));
    }
    

}
