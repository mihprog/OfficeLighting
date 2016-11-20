<?php
session_start();
//класс для регистрации и авторизации, а также валидации некоторых типов входных данных
class RegAuth
{

    /*вход - строка с именем юзера
     * выход - true или тип ошибки
     */
    static public function validName($name)
    {
        if(strlen($name)===0)return 'name_zero';
        elseif (strlen($name)>30)return 'name_long';
        else return true;
    }

    /*вход - строка с email
     * выход - true или false
     */
    static public function validEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    /**
     * @param $dbc
     * @param $field
     * @param $value
     * @return bool
     * проверка емейла на уникальность
     */
    static public function isUnique($dbc,$field,$value)
    {
        $query = "SELECT * FROM users WHERE $field = '$value'";
        $result = $dbc->query($query);
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr['name'] = $row['name'];
        }
        return empty($arr);
    }

    /**
     * @return mysqli
     */
    static public function getConnection()
    {
        $params = include ('config.php');
        $dbc = new mysqli($params['host'],$params['user'],$params['password'],$params['dbname']);
        if ($dbc->connect_errno) {
            echo "Не удалось подключиться к MySQL: " . $dbc->connect_error;
        }
        return $dbc;
    }

    /**
     * @param int $length
     * @return string
     * функция для генерации рандомной строки
     */
    function generateCode($length)
    {
        $chars = 'abdefhiknrstyz1234567890';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++)
        {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    /*валидация номера телефона
    *вход - 10 цифр подряд выход - bool
     */
    static public function validNumber($tel)
    {
        return is_numeric($tel);
    }

    /*валидация пароля. Вход - строка
     * выход - true или название ошибки
     */
    static public function validPassword($password)
    {
        if(strlen($password)===0)return 'password_zero';
        elseif (strlen($password)>30)return 'password_long';
        else return true;
    }

    //функция для обеспечения безопасности данных - удаление html-тегов и экранирование
    static private function secure($dbc,$data)
    {
        $data = strip_tags($data);
        $data = mysqli_real_escape_string($dbc,$data);
        return $data;
    }
    //функция для регистрации и отправки письма для подтверждения
    public static function register($userJson)
    {
        $params = include ('config.php');
        $dbc = self::getConnection();

        //достаем из json все данные
        //и экранируем их
        $userJson = json_decode($userJson);

        $name = $userJson->reg_name;
        $name = self::secure($dbc,$name);

        $email = $userJson->reg_email;
        $email = self::secure($dbc,$email);

        $telephone = $userJson->reg_telephone;
        $telephone = self::secure($dbc,$telephone);

        $password = $userJson->reg_password;
        $password = self::secure($dbc,$password);
        $password = md5($password);

        $hash=self::generateCode(8);

        if(!self::isUnique($dbc,'email',$email))
        {
            echo 'emailInUse';
        }

        else
        {
            $query1 = "INSERT INTO users(name, email, password, telephone, hash, status) ".
                "VALUES ('$name','$email','$password','$telephone','$hash','unconfirmed')";
            $dbc->query($query1);
            $messageLink = "http://".$params['host']."/AccepticTestTask/php/confirm.php?hash=".md5($hash)."&md5=".md5($email);
            $message = "Hello, '$name'! Are you sure to confirm your registration?\n If you are sure ".
                "please, click to this link\n ".$messageLink;
            mail($email, 'Registration', $message);
            echo 'complete';
        }
    }
    /*функция для подтверждения регистрации по ссылке, отправленной на почту
    принимает хеш рандомной строки юзера и хеш его емейла*/
    public static function confirmReg($hash,$md5Email)
    {
        $dbc = self::getConnection();
        $hash = self::secure($dbc,$hash);
        $md5Email = self::secure($dbc,$md5Email);
        $query = "UPDATE users SET status='confirmed' WHERE MD5(email)='$md5Email' AND MD5(hash)='$hash'";
        $dbc->query($query);
    }
    /*функция для аутентификации
     * возвращает ошибку в случае невалидности данных, неудачу в случае несовпадения данных
     * пользователя с базой и url перехода в случае успешной аутентификации
     * */
    public static function auth($email,$password)
    {
        if(self::validEmail($email)&&self::validPassword($password))
        {
            $dbc = self::getConnection();
            $email = self::secure($dbc,$email);
            $password = self::secure($dbc,$password);
            $password = md5($password);
            $query = "SELECT * FROM users WHERE email ='$email' AND password = '$password'";
            $result = $dbc->query($query);
            $arr = array();

            while ($row = $result->fetch_assoc()) {
                $arr['hash'] = $row['hash'];
                $arr['status'] = $row['status'];
            }
            if (!empty($arr))
            {
                if($arr['status']=='confirmed') {
                    $hash = $arr['hash'];
                    $hash = md5($hash);
                    $_SESSION['emailHash'] = md5($email);
                    $_SESSION['hash'] = $hash;
                    setcookie('emailHash',md5($email),time() + 3600*24*30*12, "/");
                    setcookie('hash',$hash,time() + 3600*24*30*12, "/");
                    echo 'user.php?hash=' . $hash;
                }
                else echo 'status';
            }
            else
            {
                echo 'wrong';
            }
        }
        else echo 'invalidData';
    }
    public static function isLogIn()
    {
        $dbc = self::getConnection();
        if(isset($_SESSION['hash'])&&isset($_SESSION['emailHash']))
        {
            $emailHash = $_SESSION['emailHash'];
            $hash = $_SESSION['hash'];
            setcookie('emailHash',$emailHash,time() + 3600*24*30*12, "/");
            setcookie('hash',$hash,time() + 3600*24*30*12, "/");
        }
        else
        {
            $emailHash = $_COOKIE['emailHash'];
            $hash = $_COOKIE['hash'];
            $_SESSION['emailHash'] = $emailHash;
            $_SESSION['hash'] = $hash;
        }

        $query = "SELECT * FROM users WHERE MD5(email) ='$emailHash' AND MD5(hash) = '$hash'";
        $result = $dbc->query($query);
        $arr = array();

        while ($row = $result->fetch_assoc()) {
            $arr['hash'] = $row['hash'];
        }
        return !empty($arr);
    }

    //функция для возврата всех пользовательских данных
    public static function getUserData()
    {
        $dbc = self::getConnection();
        $emailHash = $_SESSION['emailHash'];
        $query = "SELECT * FROM users WHERE MD5(email) ='$emailHash'";
        $result = $dbc->query($query);
        $arr = array();

        while ($row = $result->fetch_assoc()) {
            $arr['name'] = $row['name'];
            $arr['email'] = $row['email'];
            $arr['telephone'] = $row['telephone'];
        }
        return $arr;
    }
    //редактирование пользовательских данных
    //вход - json с именем, телефоном и паролями
    //выход - сообщение об ошибке, или успешном завершении
    public static function editData($userJson)
    {
        $dbc = self::getConnection();
        $userJson = json_decode($userJson);

        $name = $userJson->edt_name;
        $name = self::secure($dbc,$name);

        $email = $_SESSION['emailHash'];

        $telephone = $userJson->edt_telephone;
        $telephone = self::secure($dbc,$telephone);

        $password = $userJson->edt_passwd;
        $rptPassword = $userJson->rpt_passwd;
        if($password!=''&&$rptPassword!=''&&$password==$rptPassword)
        {
            if(self::validName($name)&&self::validNumber($telephone)&&self::validPassword($password)) {
                $password = self::secure($dbc, $password);
                $password = md5($password);
                $query = "UPDATE users SET name='$name',telephone='$telephone',password='$password' ".
                    "WHERE MD5(email)='$email'";
                $dbc->query($query);
                echo 'EditComplete';

            }
            else echo 'invalidData';
        }
        else
        {
            if(self::validName($name)&&self::validNumber($telephone)) {
                $query = "UPDATE users SET name='$name',telephone='$telephone' WHERE MD5(email)='$email'";
                $dbc->query($query);
                echo 'EditComplete';
            }
            else echo 'invalidData';
        }
    }
}