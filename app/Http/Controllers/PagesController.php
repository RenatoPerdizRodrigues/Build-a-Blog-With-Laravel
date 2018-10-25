<?php
    namespace App\Http\Controllers;
    use App\Post;

    class PagesController extends Controller{
       
        public function getIndex(){
            $posts = Post::orderBy('created_at', 'desc')->take(4)->get();
            return view('pages/welcome')->withPosts($posts);
        }

        public function getAbout(){
            $first = "Renato";
            $last = "Perdiz Rodrigues";

            $full = $first." ".$last;
            $email = "rebsunderline@hotmail.com";

            $data = array('fullname' => $full, 'email' => $email);

            return view('pages/about')->withData($data);
        }

        public function getContact(){
            return view('pages/contact');
        }
    }
?>