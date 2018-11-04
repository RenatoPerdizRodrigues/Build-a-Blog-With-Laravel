<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Post;
    use Session;
    use Mail;

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

        public function postContact(Request $request){

            //Valida os campos do email
            $this->validate($request, array(
                'email' => 'required|email',
                'subject' => 'required|min:3',
                'message' => 'required|min:10'
            ));

            //Compila os campos da request para enviar para a view do email
            $data = array('email' => $request->email, 'subject' => $request->subject, 'bodyMessage' => $request->message );

            //Função de envio de email (view do email, dados a serem passados à view, função que define o header)
            Mail::send('emails.contact', $data, function($message) use ($data){
                $message->from($data['email']);
                $message->to('renato@gmail.com');
                $message->subject($data['subject']);
            });

            Session::flash('success', 'Your Email was Sent!');
            return redirect()->route('index');
        }
    }
?>