<?php
class quantoxController extends baseController
{
    public function __construct()
    {
        Loader::loadModel($this, 'quantox');
    }

    public function index()
    {
        Loader::loadView('home');
    }

    public function register()
    {
        if(isset($_POST['registerBtn']))
        {
            $email = trim($_POST['email']);
            $name = filter_var(trim($_POST['name']),FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_SPECIAL_CHARS);
            $password_rep = filter_var(trim($_POST['reppass']),FILTER_SANITIZE_SPECIAL_CHARS);

            if($email == '' || $name == '' || $password == '' || $password_rep == ''){
                echo "Please fill in all fields in the form.";
            } else {

                if(!$this->validateEmail($email))
                {
                    echo "$email is not a valid email address!";
                    // die;
                } else if(strlen($password) < 6 || strlen($password) > 25) {
                    echo "Password must be between 6 and 25 chracters long!";
                    // die;
                }
                else if($password!=$password_rep)
                {
                    echo "Password and repeated password must be the same";
                    // die;

                }
                else
                {
                    $data = array($email, $name, md5($password));

                    if($this->models['quantox']->insertUser($data))
                    {
                        echo "Registration successful <a href='index.php?c=quantox&f=login'>Login</a>";
                    } else {
                        echo "Something went wrong during registration process, probably user with same email exists.";
                    }
                }
            }
        }

        Loader::loadView('register');

    }

    private function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        }

        return false;
    }

    public function login()
    {
        if(isset($_POST['loginBtn'])) {

            $email = trim($_POST['email']);
            $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_SPECIAL_CHARS);

            if($email == "" || $password == "") {
                echo "Please fill in all fields in the form.";
            } else {
                if(!$this->validateEmail($email))
                {
                    echo "$email is not a valid email address!";
                    // die;
                }
                else
                {
                    $data = array($email, md5($password));

                    if(!$name = $this->models['quantox']->loginUser($data)) {
                        echo "Wrong combination of username and password.";
                    } else {
                        $_SESSION['email'] = $name[0]->email;
                        echo "Welcome {$name[0]->name}, go to homepage <a href='index.php'>Home page</a>";
                    }
                }
            }

        }

        Loader::loadView('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        echo "Logged out. Go to home page <a href='index.php'>Home page</a>";
    }

    public function searchResults()
    {
        if(!isset($_SESSION['email'])) {
            $template['message'] = 'Please login...<br/><br/>';
            Loader::loadView('login',$template);

        } else {
            $template = array();

            if(isset($_POST['searchBtn'])) {

                $search = filter_var(trim($_POST['searchFor']),FILTER_SANITIZE_SPECIAL_CHARS);

                if($search=='')
                {
                    echo "Enter a term you are searching for.";
                    $template['results'] = array();
                } else {
                    if(!$results=$this->models['quantox']->search($search))
                    {
                        $template['message'] = "No results for search criteria.";
                    }
                    $template['results'] = $results;
                }

            }

            Loader::loadView('searchresults', $template);
        }
    }
}

