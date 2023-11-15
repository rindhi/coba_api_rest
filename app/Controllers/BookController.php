<?php 
namespace App\Controllers;

use App\Models\Book;

//the model it is the adapter for  make commands to the databse in MVC arquitecture

class BookController extends BaseController{

     
    public function index(){

        $books=new Book();

        // get query database
        $data['Books']=$books->orderBy('id','ASC')->findAll();

        // pass to the view the header and footer
        $data['Header']=view('Templates/Header');
        $data['Footer']=view('Templates/Footer');

        return view('Books/list',$data);
    }

    public function createBook(){

        // Add to associative array header and footer 
        $data['Header']=view('Templates/Header');
        $data['Footer']=view('Templates/Footer');

        // pass to the view the header and footer
        return view('Books/create',$data);
    }

    public function saveBook(){
        
        $book=new Book();

        //Validate data input

        $validation=$this->validate(
            [
                'name'=>'required|min_length[3]',
                'image'=>[
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,1024]'
                ]
            ]
        );

        if(!$validation){
            $session=session();
            $session->setFlashdata('message','please validate the information entered');
            return redirect()->back()->withInput();
        }


        if($image=$this->request->getFile('image')){

            //Get image Name from the request Post

            $name=$this->request->getVar('name');

            //move file upload to local folder

            $newNameFile=$image->getRandomName();
            $image->move('../public/uploads',$newNameFile);

            $data=[
                'name'=>$name,
                'image'=>$newNameFile
            ];

            //Save in dataBase

            $book->insert($data);
            
        }

        return $this->response->redirect(site_url('/getBooks'));
    }

    public function deleteBook($id=null){
        $book=new Book();

        // Get book of Database
        $bookFound=$book->where('id',$id)->first();

        if($bookFound!=null){
            //Delete file of the path
            $localPath=('../public/uploads/'.$bookFound['image']);
             unlink($localPath);

             //Delete path of Database
             $book->where('id',$id)->delete($id);
             
             return $this->response->redirect(site_url('/getBooks'));
        }
        
    }

    public function editBook($id=null){

        $books=new Book();

        // Add to associative array header , footer and book
        $data['Header']=view('Templates/Header');
        $data['Footer']=view('Templates/Footer');
        $data['book']=$books->where('id',$id)->first();

        return view('Books/edit',$data);
    }

    public function updateBook(){

        //update name Book-part1

        $books=new Book();

        $data=[
            'name'=>$this->request->getVar('name') 
        ];

        //get id  of the  request post of user interface(view edit book)

        $id=$this->request->getVar('id');


        //Validate data input

        $validation=$this->validate(
            [
                'name'=>'required|min_length[3]'
            ]
        );

        if(!$validation){
            $session=session();
            $session->setFlashdata('message','please validate the information entered');
            return redirect()->back()->withInput();
        }

        $books->update($id,$data);

        //update image Book -part2

        $validation=$this->validate(
            [
                'image'=>[
                    'uploaded[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,1024]'
                ]
            ]
        );

        if($validation){

            if($image=$this->request->getFile('image')){

                //get Book database
                $bookFound=$books->where('id',$id)->first();

               //Delete file of the path
                $localPath=('../public/uploads/'.$bookFound['image']);
                unlink($localPath);
        
    
                //move file upload to local folder
    
                $newNameFile=$image->getRandomName();
                $image->move('../public/uploads',$newNameFile);
    
                $data=[
                    'image'=>$newNameFile
                ];
    
                //Save in dataBase
    
                $books->update($id,$data);
                
            }

        }

        return $this->response->redirect(site_url('/getBooks'));

    }

}