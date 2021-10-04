<?php

namespace App\Http\Controllers;

use App\Subject_category as Category;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectCategoryController extends Controller
{
    


    public function index()
    {
        $categories = Category::with('subjects')->get();
        

        return view('subjects.category',compact('categories'));
    }






    public function create($subject_school_id){


        /*Collecting junior secondary school subjects*/
        if($subject_school_id == 2){

            $subjects = Subject::whereRaw('subjects.id NOT IN (SELECT subject_id FROM subject_subject_category WHERE subject_school_id = '.$subject_school_id.'  ) 
                            AND subjects.subject_school_id <> 3 ')
                            ->orderBy('name','ASC')
                            ->get(['id','name']);

        }

        /*Collect senior secondary school subjects*/
        else if($subject_school_id == 3){

            $subjects = Subject::whereRaw('subjects.subject_school_id <> 2 ')
                            ->orderBy('name','ASC')
                            ->get(['id','name']);
        }

        return view('subjects.create-category',compact('subjects','subject_school_id'));
    }








    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required'
        ]);



        /*Collect form data*/
        $name = $request->name;
        $subject_ids = $request->subject_id;
        $subject_school_id = $request->subject_school_id;



        /*Database transaction to ensure all data are properly inserted*/
        $transaction = DB::transaction(function() use($name,$subject_school_id,$subject_ids){

            /*Create new subject category and get the id*/
            $category_id = DB::table('subject_categories') ->insertGetId(
                            ['name' => $name,
                            'subject_school_id' => $subject_school_id
                        ]);

            /*Empty array to collect subject category query*/
            $insert = array();

            /*Looping through selected subjects to generate query*/
            foreach($subject_ids as $subject_id) {

                $insert[count($insert)] = [
                    'subject_category_id' => $category_id, 
                    'subject_id' => $subject_id,
                    'subject_school_id' => $subject_school_id

                ];
            }


            /*Send query into database*/
            DB::table('subject_subject_category')->insert($insert);


        });

        

        
        /*Check if transaction was successfully committed*/
        if(is_null($transaction)){

            /*Redirect user to appropriate page and tab pane */
            if($subject_school_id==2)

                return redirect(url('subjects#junior-school'));

            else
                return redirect(url('subjects#senior-school'));
        }
    

        return response(['status'=>0,'message'=>'Connection error!']);

    }







    
    public function edit($id)
    {
        $category = Category::find($id);
        $subjects = $category->subjects;

        return response(compact('category','subjects'));
    }

    





      
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'id' => 'numeric|required',
        ]);


        /*Collect form data*/
        $id = $request->id;
        $subject_school_id = $request->subject_school_id;
        $name = $request->name;
        $subject_ids = $request->subject_id;

        /*Ensure that at least a subject is in subject category*/
        if(count($subject_ids) == 0)

            return response(['status'=>0,'message'=>'Subject category cannot be empty, please select a subject!']);




        /*Database transaction to ensure all data are properly inserted*/
        $transaction = DB::transaction(function() use($id,$subject_school_id,$name,$subject_ids){

            /*Remove all mapped subject and also delete the category*/
            DB::table('subject_subject_category')->where('subject_category_id',$id)->delete();
            Category::destroy($id);


            /*Create new subject category and get the id*/
            DB::table('subject_categories')->insert([

                        'id' => $id, 'name' => $name,
                        'subject_school_id' => $subject_school_id

                    ]);


            /*Empty array to collect subject category query*/
            $insert = array();

            /*Looping through selected subjects to generate query*/
            foreach($subject_ids as $subject_id) {

                $insert[count($insert)] = [

                    'subject_category_id' => $id, 
                    'subject_id' => $subject_id,
                    'subject_school_id' => $subject_school_id
                ];
            }


            /*Send query into database*/
            DB::table('subject_subject_category')->insert($insert);


        });

        

        

        if(is_null($transaction))

            return response(['status'=>1,'message'=>$name.' updated!','retain'=>301]);
            // return redirect(url('subjects#junior-school'));

        else

            return response(['status'=>0,'message'=>'Connection error!']);
    }






    public function addupCreate($id,$subject_school_id){

        /*Collect category details*/
        $category = Category::find($id);


        /*Collecting junior secondary school subjects*/
        if($subject_school_id == 2){

            $subjects = Subject::whereRaw('subjects.id NOT IN (SELECT subject_id FROM subject_subject_category WHERE subject_school_id = '.$subject_school_id.'  ) 
                            AND subjects.subject_school_id <> 3 ')
                            ->orderBy('name','ASC')
                            ->get(['id','name']);

        }

        /*Collect senior secondary school subjects*/
        else if($subject_school_id == 3){

            $subjects = Subject::whereRaw('subjects.id NOT IN (SELECT subject_id FROM subject_subject_category WHERE subject_category_id = '.$id.'  ) 
                            AND subjects.subject_school_id <> 2 ')
                            ->orderBy('name','ASC')
                            ->get(['id','name']);
        }

        

        return view('subjects.category-addup',compact('category','subject_school_id','subjects'));
    }





    /*Add new subjects to a selected category*/
    public function addupStore(Request $request)
    {
        $request->validate([
            'id' => 'numeric|required'
        ]);



        /*Collect form data*/
        $id = $request->id;
        $subject_ids = $request->subject_id;
        $subject_school_id = $request->subject_school_id;



        /*Database transaction to ensure all data are properly inserted*/
        $transaction = DB::transaction(function() use($id,$subject_school_id,$subject_ids){


            /*Empty array to collect subject category query*/
            $insert = array();

            /*Looping through selected subjects to generate query*/
            foreach($subject_ids as $subject_id) {

                $insert[count($insert)] = [
                    'subject_category_id' => $id, 
                    'subject_id' => $subject_id,
                    'subject_school_id' => $subject_school_id
                ];
            }


            /*Send query into database*/
            DB::table('subject_subject_category')->insert($insert);


        });

        

        

          
        /*Check if transaction was successfully committed*/
        if(is_null($transaction)){

            /*Redirect user to appropriate page and tab pane */
            if($subject_school_id==2)

                return redirect(url('subjects#junior-school'));

            else
                return redirect(url('subjects#senior-school'));
        }
    

        return response(['status'=>0,'message'=>'Connection error!']);

        
    }



    



    /*Delete category and unmap mapped subjects*/
    public function destroy(Request $request)
    {
        $id = $request->id;

        if(Category::destroy($id))


            return response(['status'=>1,'message'=>'Subject category deleted!','retain'=>301]);


        else


            return response(['status'=>0,'message'=>'Connection error!']);


    }



}
